<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Pengirim pesan sederhana ke bot Telegram pemilik (Hermes).
 * Dipakai untuk notifikasi instan dan laporan harian.
 */
class Telegram
{
    public static function enabled(): bool
    {
        return filled(config('services.telegram.token')) && filled(config('services.telegram.chat_id'));
    }

    /**
     * @param  array<int, array<int, array{text:string,url?:string}>>  $inlineKeyboard
     */
    public static function send(string $text, array $inlineKeyboard = []): bool
    {
        if (! self::enabled()) {
            Log::warning('Telegram: TELEGRAM_BOT_TOKEN / TELEGRAM_CHAT_ID belum diisi.');

            return false;
        }

        $payload = [
            'chat_id' => config('services.telegram.chat_id'),
            'text' => $text,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
        ];

        if ($inlineKeyboard !== []) {
            $payload['reply_markup'] = ['inline_keyboard' => $inlineKeyboard];
        }

        try {
            $response = Http::timeout(10)
                ->post('https://api.telegram.org/bot'.config('services.telegram.token').'/sendMessage', $payload);

            if (! $response->successful()) {
                Log::error('Telegram sendMessage gagal: '.$response->body());

                return false;
            }

            return true;
        } catch (\Throwable $e) {
            Log::error('Telegram sendMessage error: '.$e->getMessage());

            return false;
        }
    }

    public static function escape(?string $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
