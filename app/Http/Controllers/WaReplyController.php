<?php

namespace App\Http\Controllers;

use App\Models\WhatsappMessage;
use Illuminate\Http\RedirectResponse;

/**
 * Tujuan tombol "Kirim draf ke WhatsApp" di Telegram.
 *
 * Tautan ini pendek (batas URL tombol Telegram hanya 64 karakter), sekaligus
 * mencatat bahwa draf sudah dibuka sehingga pengirim otomatis tidak ikut
 * membalas percakapan yang sama.
 */
class WaReplyController extends Controller
{
    public function __invoke(string $token): RedirectResponse
    {
        return $this->openWhatsapp($token);
    }

    /**
     * Tombol "Balas manual": buka WhatsApp dengan templat draf sudah terisi
     * agar pemilik cukup menyunting sebelum mengirim.
     */
    public function manual(string $token): RedirectResponse
    {
        return $this->openWhatsapp($token);
    }

    private function openWhatsapp(string $token): RedirectResponse
    {
        $message = WhatsappMessage::where('draft_token', $token)->first();

        abort_if($message === null, 404);

        if ($message->clicked_at === null) {
            $message->forceFill(['clicked_at' => now()])->save();
        }

        $phone = $message->phone ?: preg_replace('/\D+/', '', explode('@', $message->chat_id)[0] ?? '');
        $draft = trim((string) $message->ai_draft);

        $url = 'https://wa.me/'.$phone;

        if ($draft !== '') {
            $url .= '?text='.rawurlencode($draft);
        }

        return redirect()->away($url);
    }
}
