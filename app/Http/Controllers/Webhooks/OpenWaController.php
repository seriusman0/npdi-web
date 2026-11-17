<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\WhatsappMessage;
use App\Support\Telegram;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Menerima event dari gateway WhatsApp (OpenWA) lalu meneruskannya ke Telegram.
 * Keaslian payload diverifikasi dengan HMAC-SHA256 (header X-OpenWA-Signature).
 */
class OpenWaController extends Controller
{
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
        $phone = preg_replace('/\D+/', '', explode('@', $chatId)[0] ?? '');
        $body = trim((string) ($data['body'] ?? ''));
        $type = (string) ($data['type'] ?? 'text');
        $name = $data['contact']['pushName'] ?? $data['contact']['name'] ?? null;

        if ($chatId === '' || ($body === '' && $type === 'text')) {
            return;
        }

        $message = WhatsappMessage::firstOrCreate(
            ['wa_message_id' => (string) ($data['id'] ?? '')],
            [
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

        $preview = $body !== '' ? $body : '['.$type.']';
        $text = "💬 <b>Pesan WhatsApp masuk</b>\n\n"
            .'<b>Dari:</b> '.Telegram::escape($name ?: 'Tanpa nama')."\n"
            .'<b>Nomor:</b> '.Telegram::escape('+'.$phone)."\n\n"
            .Telegram::escape(mb_substr($preview, 0, 900));

        $buttons = [];

        if ($phone !== '') {
            $buttons[] = [[
                'text' => 'Balas di WhatsApp',
                'url' => 'https://wa.me/'.$phone,
            ]];
        }

        Telegram::send($text, $buttons);
    }
}
