<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Klien tipis untuk REST API gateway WhatsApp (OpenWA).
 * Semua panggilan dibuat best-effort: kegagalan dicatat, bukan dilempar ke pemanggil.
 */
class WaGateway
{
    public function enabled(): bool
    {
        return $this->base() !== '' && $this->session() !== '';
    }

    /**
     * Terjemahkan identitas kontak (termasuk LID @lid) menjadi nomor asli.
     *
     * @return array{number?: string, name?: string}
     */
    public function contact(string $chatId): array
    {
        if (! $this->enabled() || $chatId === '') {
            return [];
        }

        try {
            $response = Http::withHeaders($this->headers())
                ->timeout(5)
                ->get($this->url('/contacts/'.rawurlencode($chatId)));

            if ($response->successful()) {
                $data = (array) $response->json();

                return array_filter([
                    'number' => $data['number'] ?? null,
                    'name' => $data['name'] ?? null,
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning('OpenWA: gagal mengambil kontak', ['chat_id' => $chatId, 'error' => $e->getMessage()]);
        }

        return [];
    }

    /**
     * Riwayat percakapan (masuk & keluar), terlama lebih dulu.
     *
     * @return array<int, array{direction: string, body: string, timestamp: int}>
     */
    public function history(string $chatId, int $limit = 14): array
    {
        if (! $this->enabled() || $chatId === '') {
            return [];
        }

        try {
            $response = Http::withHeaders($this->headers())
                ->timeout(8)
                ->get($this->url('/messages'), ['chatId' => $chatId, 'limit' => $limit]);

            if ($response->failed()) {
                return [];
            }

            $messages = (array) ($response->json('messages') ?? []);

            $history = [];

            foreach ($messages as $message) {
                $body = trim((string) ($message['body'] ?? ''));

                if ($body === '') {
                    continue;
                }

                $history[] = [
                    'direction' => ($message['direction'] ?? 'incoming') === 'outgoing' ? 'out' : 'in',
                    'body' => $body,
                    'timestamp' => (int) ($message['timestamp'] ?? 0),
                ];
            }

            usort($history, fn ($a, $b) => $a['timestamp'] <=> $b['timestamp']);

            return array_slice($history, -$limit);
        } catch (\Throwable $e) {
            Log::warning('OpenWA: gagal mengambil riwayat', ['chat_id' => $chatId, 'error' => $e->getMessage()]);

            return [];
        }
    }

    /**
     * Apakah sudah ada pesan keluar setelah waktu tertentu?
     * Dipakai untuk mencegah balasan otomatis menimpa balasan manual.
     */
    public function hasOutgoingSince(string $chatId, int $timestamp): bool
    {
        foreach ($this->history($chatId) as $message) {
            if ($message['direction'] === 'out' && $message['timestamp'] > $timestamp) {
                return true;
            }
        }

        return false;
    }

    public function sendText(string $chatId, string $text): ?string
    {
        if (! $this->enabled()) {
            return null;
        }

        try {
            $response = Http::withHeaders($this->headers())
                ->timeout(15)
                ->post($this->url('/messages/send-text'), [
                    'chatId' => $chatId,
                    'text' => $text,
                ]);

            if ($response->successful()) {
                return (string) ($response->json('messageId') ?? '');
            }

            Log::warning('OpenWA: gagal mengirim pesan', [
                'chat_id' => $chatId,
                'status' => $response->status(),
                'body' => mb_substr($response->body(), 0, 300),
            ]);
        } catch (\Throwable $e) {
            Log::warning('OpenWA: gagal mengirim pesan', ['chat_id' => $chatId, 'error' => $e->getMessage()]);
        }

        return null;
    }

    private function base(): string
    {
        return rtrim((string) config('services.openwa.base_url'), '/');
    }

    private function session(): string
    {
        return (string) config('services.openwa.session');
    }

    private function url(string $path): string
    {
        return $this->base().'/sessions/'.$this->session().$path;
    }

    /** @return array<string, string> */
    private function headers(): array
    {
        return ['X-API-Key' => (string) config('services.openwa.api_key')];
    }
}
