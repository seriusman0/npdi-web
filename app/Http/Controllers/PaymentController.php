<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function checkout(string $productSlug, string $planSlug)
    {
        $product = ProductController::$products[$productSlug] ?? null;
        if (!$product) abort(404);

        $plan = collect($product['plans'])->firstWhere('slug', $planSlug);
        if (!$plan) abort(404);

        return view('pages.checkout', compact('product', 'plan'));
    }

    public function createInvoice(Request $request, string $productSlug, string $planSlug)
    {
        $product = ProductController::$products[$productSlug] ?? null;
        if (!$product) abort(404);

        $plan = collect($product['plans'])->firstWhere('slug', $planSlug);
        if (!$plan) abort(404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $orderId = 'NPDI-' . strtoupper(Str::random(10)) . '-' . time();

        $response = Http::withBasicAuth(config('services.xendit.secret_key'), '')
            ->post('https://api.xendit.co/v2/invoices', [
                'external_id' => $orderId,
                'amount' => $plan['price'],
                'payer_email' => $validated['email'],
                'description' => "{$product['name']} — Paket {$plan['name']} (1 Bulan)",
                'currency' => 'IDR',
                'items' => [[
                    'name' => "{$product['name']} {$plan['name']}",
                    'quantity' => 1,
                    'price' => $plan['price'],
                    'category' => 'Software as a Service',
                    'url' => $product['url'],
                ]],
                'customer' => [
                    'given_names' => $validated['name'],
                    'email' => $validated['email'],
                    'mobile_number' => $validated['phone'] ?? null,
                ],
                'customer_notification_preference' => [
                    'invoice_created' => ['email'],
                    'invoice_reminder' => ['email'],
                    'invoice_paid' => ['email'],
                ],
                'success_redirect_url' => route('payment.success'),
                'failure_redirect_url' => route('products.show', $productSlug),
                'invoice_duration' => 86400,
            ]);

        if (!$response->successful()) {
            Log::error('Xendit invoice creation failed', ['response' => $response->body()]);
            return back()->withErrors(['payment' => 'Gagal membuat invoice pembayaran. Coba lagi atau hubungi kami.'])->withInput();
        }

        $invoice = $response->json();

        Order::create([
            'order_id' => $orderId,
            'product_slug' => $productSlug,
            'plan_slug' => $planSlug,
            'customer_name' => $validated['name'],
            'customer_email' => $validated['email'],
            'customer_phone' => $validated['phone'] ?? null,
            'amount' => $plan['price'],
            'status' => 'pending',
            'xendit_invoice_id' => $invoice['id'],
            'xendit_invoice_url' => $invoice['invoice_url'],
            'xendit_payload' => $invoice,
        ]);

        return redirect($invoice['invoice_url']);
    }

    public function success()
    {
        return view('pages.payment-success');
    }

    public function webhook(Request $request)
    {
        $token = $request->header('x-callback-token');
        if ($token !== config('services.xendit.webhook_token')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $payload = $request->all();
        $externalId = $payload['external_id'] ?? null;
        $status = $payload['status'] ?? null;

        if (!$externalId) {
            return response()->json(['error' => 'Missing external_id'], 400);
        }

        $order = Order::where('order_id', $externalId)->first();
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($status === 'PAID') {
            $order->update([
                'status' => 'paid',
                'paid_at' => now(),
                'xendit_payload' => $payload,
            ]);

            $this->provisionNanohubAccount($order);

        } elseif (in_array($status, ['EXPIRED', 'VOIDED'])) {
            $order->update(['status' => 'expired', 'xendit_payload' => $payload]);
        }

        return response()->json(['success' => true]);
    }

    private function provisionNanohubAccount(Order $order): void
    {
        if ($order->provisioned) return;

        $tempPassword = Str::password(12, symbols: false);
        $workspaceName = $order->customer_name . "'s Workspace";

        try {
            $response = Http::withHeaders([
                'x-internal-key' => config('services.nanohub.internal_key'),
                'Content-Type' => 'application/json',
            ])->post(config('services.nanohub.api_url') . '/internal/provision', [
                'email' => $order->customer_email,
                'name' => $order->customer_name,
                'workspaceName' => $workspaceName,
                'plan' => $order->plan_slug,
                'tempPassword' => $tempPassword,
            ]);

            if (!$response->successful()) {
                Log::error('NanoHub provision failed', [
                    'order_id' => $order->order_id,
                    'response' => $response->body(),
                ]);
                return;
            }

            $result = $response->json();

            $order->update([
                'provisioned' => true,
                'temp_password' => $tempPassword,
            ]);

            $this->sendCredentialsEmail($order, $tempPassword, $result['action'] ?? 'created');

            Log::info("NanoHub account provisioned for order {$order->order_id}", $result);

        } catch (\Throwable $e) {
            Log::error('NanoHub provision exception', [
                'order_id' => $order->order_id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function sendCredentialsEmail(Order $order, string $tempPassword, string $action): void
    {
        $product = ProductController::$products[$order->product_slug] ?? null;
        $plan = $product
            ? collect($product['plans'])->firstWhere('slug', $order->plan_slug)
            : null;
        $planName = $plan['name'] ?? ucfirst($order->plan_slug);
        $loginUrl = 'https://nanohub.nanoprojectdevindonesia.com/auth/login';
        $isNew = $action === 'created';

        $subject = $isNew
            ? "Akun NanoHub Anda Siap — Paket {$planName}"
            : "Paket NanoHub Anda Diupgrade ke {$planName}";

        $body = $isNew
            ? $this->newAccountEmailHtml($order, $tempPassword, $loginUrl, $planName)
            : $this->upgradeEmailHtml($order, $loginUrl, $planName);

        try {
            Mail::html($body, function ($message) use ($order, $subject) {
                $message->to($order->customer_email, $order->customer_name)
                    ->subject($subject)
                    ->from(config('mail.from.address', 'noreply@seriusman.shop'), 'NPDI — NanoHub');
            });

            $order->update(['temp_password' => null]);
        } catch (\Throwable $e) {
            Log::error('Failed to send credentials email', ['error' => $e->getMessage()]);
        }
    }

    private function newAccountEmailHtml(Order $order, string $tempPassword, string $loginUrl, string $planName): string
    {
        $name = htmlspecialchars($order->customer_name);
        $email = htmlspecialchars($order->customer_email);
        return <<<HTML
        <!DOCTYPE html>
        <html lang="id">
        <head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
        <body style="font-family:sans-serif;background:#f9fafb;margin:0;padding:32px 16px;">
          <div style="max-width:540px;margin:0 auto;background:#fff;border-radius:16px;border:1px solid #e5e7eb;overflow:hidden;">
            <div style="background:linear-gradient(135deg,#16a34a,#0d9488);padding:32px;text-align:center;">
              <h1 style="color:#fff;margin:0;font-size:24px;">Akun NanoHub Anda Siap!</h1>
              <p style="color:rgba(255,255,255,0.85);margin:8px 0 0;">Paket <strong>{$planName}</strong> aktif</p>
            </div>
            <div style="padding:32px;">
              <p style="color:#374151;">Halo <strong>{$name}</strong>,</p>
              <p style="color:#374151;">Pembayaran Anda berhasil dikonfirmasi. Akun NanoHub sudah siap digunakan dengan detail berikut:</p>

              <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:20px;margin:20px 0;">
                <p style="margin:0 0 8px;color:#374151;font-size:14px;"><strong>URL Login:</strong><br>
                  <a href="{$loginUrl}" style="color:#16a34a;">{$loginUrl}</a>
                </p>
                <p style="margin:8px 0;color:#374151;font-size:14px;"><strong>Email:</strong><br>{$email}</p>
                <p style="margin:8px 0 0;color:#374151;font-size:14px;"><strong>Password Sementara:</strong><br>
                  <span style="font-family:monospace;background:#dcfce7;padding:4px 10px;border-radius:6px;font-size:16px;letter-spacing:1px;">{$tempPassword}</span>
                </p>
              </div>

              <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:12px;padding:16px;margin:16px 0;">
                <p style="margin:0;color:#92400e;font-size:14px;">
                  ⚠️ <strong>Penting:</strong> Segera ubah password setelah login pertama. Anda akan diminta menggantinya secara otomatis.
                </p>
              </div>

              <a href="{$loginUrl}" style="display:block;background:#16a34a;color:#fff;text-align:center;padding:14px;border-radius:10px;text-decoration:none;font-weight:bold;margin-top:24px;">
                Login ke NanoHub →
              </a>

              <p style="color:#9ca3af;font-size:12px;margin-top:24px;text-align:center;">
                Butuh bantuan? Balas email ini atau hubungi support kami via WhatsApp.
              </p>
            </div>
          </div>
        </body>
        </html>
        HTML;
    }

    private function upgradeEmailHtml(Order $order, string $loginUrl, string $planName): string
    {
        $name = htmlspecialchars($order->customer_name);
        return <<<HTML
        <!DOCTYPE html>
        <html lang="id">
        <head><meta charset="UTF-8"></head>
        <body style="font-family:sans-serif;background:#f9fafb;margin:0;padding:32px 16px;">
          <div style="max-width:540px;margin:0 auto;background:#fff;border-radius:16px;border:1px solid #e5e7eb;overflow:hidden;">
            <div style="background:linear-gradient(135deg,#16a34a,#0d9488);padding:32px;text-align:center;">
              <h1 style="color:#fff;margin:0;font-size:24px;">Paket Diupgrade!</h1>
              <p style="color:rgba(255,255,255,0.85);margin:8px 0 0;">Sekarang aktif di paket <strong>{$planName}</strong></p>
            </div>
            <div style="padding:32px;">
              <p style="color:#374151;">Halo <strong>{$name}</strong>,</p>
              <p style="color:#374151;">Pembayaran upgrade paket NanoHub Anda berhasil. Paket <strong>{$planName}</strong> kini aktif di akun Anda — kuota dan limit sudah diperbarui otomatis.</p>
              <a href="{$loginUrl}" style="display:block;background:#16a34a;color:#fff;text-align:center;padding:14px;border-radius:10px;text-decoration:none;font-weight:bold;margin-top:24px;">
                Buka Dashboard NanoHub →
              </a>
            </div>
          </div>
        </body>
        </html>
        HTML;
    }
}
