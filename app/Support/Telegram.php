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

    /**
     * Baris tombol "salin" untuk sebuah teks. Telegram membatasi isi tombol salin
     * maksimal 256 karakter, jadi teks yang lebih panjang dipecah per kata.
     *
     * @return array<int, array<int, array{text:string,copy_text:array{text:string}}>>
     */
    public static function copyButtons(string $text): array
    {
        $rows = [];
        $chunks = self::chunks(trim($text));

        foreach ($chunks as $index => $chunk) {
            $rows[] = [[
                'text' => count($chunks) === 1
                    ? '📋 Salin draf'
                    : '📋 Salin bagian '.($index + 1).'/'.count($chunks),
                'copy_text' => ['text' => $chunk],
            ]];
        }

        return $rows;
    }

    /**
     * @return array<int, string>
     */
    private static function chunks(string $text): array
    {
        if ($text === '') {
            return [];
        }

        if (mb_strlen($text) <= 256) {
            return [$text];
        }

        $chunks = [];
        $current = '';

        foreach (preg_split('/\s+/', $text) as $word) {
            $candidate = $current === '' ? $word : $current.' '.$word;

            if (mb_strlen($candidate) > 256 && $current !== '') {
                $chunks[] = $current;
                $current = $word;
            } else {
                $current = $candidate;
            }

            // Satu kata yang sendirian melebihi batas tetap harus dipotong paksa.
            while (mb_strlen($current) > 256) {
                $chunks[] = mb_substr($current, 0, 256);
                $current = mb_substr($current, 256);
            }
        }

        if ($current !== '') {
            $chunks[] = $current;
        }

        return $chunks;
    }

    public static function escape(?string $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
