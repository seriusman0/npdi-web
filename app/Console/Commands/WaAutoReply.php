<?php

namespace App\Console\Commands;

use App\Models\WhatsappMessage;
use App\Support\Telegram;
use App\Support\WaGateway;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * Mengirim draf balasan otomatis ketika pemilik tidak menindaklanjuti
 * kartu Telegram (tidak menekan tombol draf maupun membalas manual).
 */
class WaAutoReply extends Command
{
    protected $signature = 'wa:auto-reply {--dry : Tampilkan rencana kirim tanpa benar-benar mengirim}';

    protected $description = 'Kirim balasan WhatsApp otomatis untuk pesan yang tidak ditanggapi';

    public function handle(WaGateway $gateway): int
    {
        if (! $gateway->enabled()) {
            $this->warn('Gateway WhatsApp belum dikonfigurasi.');

            return self::SUCCESS;
        }

        $due = WhatsappMessage::query()
            ->where('direction', 'in')
            ->whereNotNull('ai_draft')
            ->whereNotNull('auto_send_at')
            ->whereNull('auto_sent_at')
            ->whereNull('clicked_at')
            ->where('auto_send_at', '<=', now())
            ->orderBy('auto_send_at')
            ->limit(10)
            ->get();

        if ($due->isEmpty()) {
            return self::SUCCESS;
        }

        foreach ($due as $message) {
            // Sudah dibalas manual dari WhatsApp? Jangan kirim apa pun.
            if ($gateway->hasOutgoingSince($message->chat_id, (int) $message->received_at?->timestamp)) {
                $message->forceFill(['clicked_at' => now()])->save();
                $this->line("#{$message->id}: sudah dibalas manual, dilewati.");

                continue;
            }

            if ($this->option('dry')) {
                $this->line("#{$message->id} → {$message->ai_draft}");

                continue;
            }

            $sentId = $gateway->sendText($message->chat_id, (string) $message->ai_draft);

            if ($sentId === null) {
                Log::warning('Balasan otomatis gagal dikirim', ['id' => $message->id]);

                continue;
            }

            $message->forceFill(['auto_sent_at' => now()])->save();

            WhatsappMessage::create([
                'wa_message_id' => $sentId !== '' ? $sentId : null,
                'direction' => 'out',
                'chat_id' => $message->chat_id,
                'phone' => $message->phone,
                'name' => $message->name,
                'type' => 'text',
                'body' => $message->ai_draft,
                'received_at' => now(),
            ]);

            $this->info("#{$message->id}: balasan otomatis terkirim.");

            Telegram::send(
                "🤖 <b>Balasan otomatis terkirim</b>\n\n"
                .'<b>Ke:</b> '.Telegram::escape($message->name ?: 'Tanpa nama')."\n"
                .'<b>Nomor:</b> '.Telegram::escape('+'.$message->phone)."\n\n"
                .Telegram::escape((string) $message->ai_draft),
                [[['text' => '💬 Buka WhatsApp', 'url' => 'https://wa.me/'.$message->phone]]]
            );
        }

        return self::SUCCESS;
    }
}
