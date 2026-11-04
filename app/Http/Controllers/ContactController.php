<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        // Honeypot: bots fill this hidden field, humans don't
        if ($request->filled('website')) {
            \Log::warning('ContactForm honeypot triggered', ['ip' => $request->ip(), 'email' => $request->input('email')]);
            return redirect()->route('contact')->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.');
        }

        // Timing check: manusia butuh minimal 3 detik mengisi form
        $formOpenedAt = (int) $request->input('_form_time', 0);
        if ($formOpenedAt > 0 && (time() - $formOpenedAt) < 3) {
            \Log::warning('ContactForm bot timing detected', ['ip' => $request->ip(), 'elapsed' => time() - $formOpenedAt]);
            return redirect()->route('contact')->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.');
        }

        // Block email domain yang dikenal spam/bot
        $email = $request->input('email', '');
        $emailDomain = strtolower(substr(strrchr($email, '@'), 1));
        $blockedDomains = ['search-nanoprojectdevindonesia.com', 'helpindex.pro'];
        if (in_array($emailDomain, $blockedDomains)) {
            \Log::warning('ContactForm blocked domain', ['ip' => $request->ip(), 'email' => $email]);
            return redirect()->route('contact')->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.');
        }

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $contactMessage = ContactMessage::create($validated);

        try {
            Mail::to(config('mail.admin_address'))->send(new ContactFormMail($contactMessage));
        } catch (\Exception $e) {
            \Log::error('ContactForm mail gagal: ' . $e->getMessage());
        }

        // Kirim notifikasi ke WA bot owner via queue file
        try {
            $waText = "📩 *Pesan Baru dari Website!*\n\n"
                . "*Nama:* {$validated['name']}\n"
                . "*Email:* {$validated['email']}\n"
                . "*Telepon:* " . ($validated['phone'] ?? '-') . "\n"
                . "*Subjek:* {$validated['subject']}\n"
                . "*Pesan:*\n{$validated['message']}";

            file_put_contents('/tmp/wa-notify-queue.jsonl', json_encode(['text' => $waText]) . "\n", FILE_APPEND | LOCK_EX);
        } catch (\Exception $e) {
            \Log::error('ContactForm WA notify gagal: ' . $e->getMessage());
        }

        return redirect()->route('contact')->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.');
    }
}
