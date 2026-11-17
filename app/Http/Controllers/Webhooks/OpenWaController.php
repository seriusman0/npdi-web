<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\WhatsappMessage;
use App\Support\Telegram;
use App\Support\WaGateway;
use App\Support\WaReplyDrafter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Menerima event dari gateway WhatsApp (OpenWA) lalu meneruskannya ke Telegram.
 * Keaslian payload diverifikasi dengan HMAC-SHA256 (header X-OpenWA-Signature).
 */
class OpenWaController extends Controller
{
    public function __construct(
        private WaGateway $gateway,
        private WaReplyDrafter $drafter,
    ) {}

    public function handle(Request $request): JsonResponse
    {
        $secret = (string) config('services.openwa.webhook_secret');

        if ($secret !== '') {
            $expected = 'sha256='.hash_hmac('sha256', $request->getContent(), $secret);

            if (! hash_equals($expected, (string) $request->header('X-OpenWA-Signature'))) {
                Log::warning('OpenWA webhook: tanda tangan tidak valid', ['ip' => $request->ip()]);

                return response()->json(['ok' => false], 401);
            }
        }

        $event = (string) $request->input('event');
        $data = (array) $request->input('data', []);

        if ($event === 'message.received') {
            $this->onInboundMessage($data);
        } elseif ($event === 'session.status' && in_array($data['status'] ?? '', ['failed', 'disconnected'], true)) {
            Telegram::send(
                "⚠️ <b>Gateway WhatsApp terputus</b>\n"
                .'Status: '.Telegram::escape($data['status'] ?? '-')."\n"
                .'Waktu: '.now()->timezone('Asia/Jakarta')->format('d M Y H:i').' WIB'
            );
        }

        return response()->json(['ok' => true]);
    }

    private function onInboundMessage(array $data): void
    {
        if (($data['fromMe'] ?? false) === true || ($data['isGroup'] ?? false) === true) {
            return;
        }

        $chatId = (string) ($data['chatId'] ?? $data['from'] ?? '');
        $body = trim((string) ($data['body'] ?? ''));
        $type = (string) ($data['type'] ?? 'text');
        $name = $data['contact']['pushName'] ?? $data['contact']['name'] ?? null;

        if ($chatId === '' || ($body === '' && $type === 'text')) {
            return;
        }

        // WhatsApp menyamarkan nomor pengirim di balik LID (@lid). Tukar ke nomor
        // asli lewat gateway, kalau tidak tombol balas menunjuk ke nomor palsu.
        $contact = str_ends_with(strtolower($chatId), '@lid') ? $this->gateway->contact($chatId) : [];

        $phone = preg_replace('/\D+/', '', (string) ($contact['number'] ?? ''));

        if ($phone === '') {
            $phone = preg_replace('/\D+/', '', explode('@', $chatId)[0] ?? '');
        }

        $message = WhatsappMessage::firstOrCreate(
            ['wa_message_id' => (string) ($data['id'] ?? '')],
            [
                'direction' => 'in',
                'chat_id' => $chatId,
                'phone' => $phone !== '' ? $phone : null,
                'name' => $name,
                'type' => $type,
                'body' => $body,
                'received_at' => isset($data['timestamp']) ? now()->setTimestamp((int) $data['timestamp']) : now(),
            ]
        );

        if (! $message->wasRecentlyCreated) {
            return;
        }

        $this->notifyWithDraft($message, $name, $phone);
    }

    /**
     * Kirim kartu pesan masuk ke Telegram lengkap dengan draf balasan AI
     * dan tombol sekali-klik menuju WhatsApp.
     */
    private function notifyWithDraft(WhatsappMessage $message, ?string $name, string $phone): void
    {
        $draft = ['draft' => null, 'model' => null];

        // Draf hanya berguna bila percakapan sudah punya riwayat untuk dijadikan konteks.
        if ($this->gateway->enabled()) {
            $draft = $this->drafter->draft($message->chat_id, (string) $message->body);
        }

        $minutes = (int) config('services.openwa.auto_reply_minutes', 10);

        if ($draft['draft'] !== null) {
            $message->forceFill([
                'ai_draft' => $draft['draft'],
                'ai_model' => $draft['model'],
                'draft_token' => Str::random(20),
                'auto_send_at' => now()->addMinutes($minutes),
            ])->save();
        }

        // Tautan tombol Telegram dibatasi 64 karakter dan tidak boleh memakai host
        // permintaan (saat webhook datang dari container, host-nya host.docker.internal).
        $base = rtrim((string) config('app.url'), '/');

        $preview = $message->body !== '' ? $message->body : '['.$message->type.']';

        $text = "💬 <b>Pesan WhatsApp masuk</b>\n\n"
            .'<b>Dari:</b> '.Telegram::escape($name ?: 'Tanpa nama')."\n"
            .'<b>Nomor:</b> '.Telegram::escape('+'.$phone)."\n\n"
            .Telegram::escape(mb_substr($preview, 0, 700));

        if ($message->ai_draft) {
            $text .= "\n\n✍️ <b>Draf balasan</b>\n".Telegram::escape($message->ai_draft)
                ."\n\n<i>✅ membuka WhatsApp dengan draf siap kirim, 📋 menyalin draf, 💬 membuka WhatsApp dengan templat yang bisa disunting"
                .($message->auto_send_at
                    ? '. Tanpa tindakan, bot membalas otomatis pukul '
                        .$message->auto_send_at->timezone('Asia/Jakarta')->format('H:i').' WIB'
                    : '')
                .'.</i>';
        }

        $buttons = [];

        if ($message->ai_draft && $message->draft_token) {
            $buttons[] = [[
                'text' => '✅ Kirim draf ke WhatsApp',
                'url' => $base.'/wa/'.$message->draft_token,
            ]];

            // Draf panjang dipecah otomatis karena tombol salin Telegram dibatasi 256 karakter.
            $buttons = array_merge($buttons, Telegram::copyButtons((string) $message->ai_draft));

            $buttons[] = [[
                'text' => '💬 Balas manual (templat terisi)',
                'url' => $base.'/m/'.$message->draft_token,
            ]];
        } elseif ($phone !== '') {
            $buttons[] = [[
                'text' => '💬 Balas manual',
                'url' => 'https://wa.me/'.$phone,
            ]];
        }

        Telegram::send($text, $buttons);
    }

}
