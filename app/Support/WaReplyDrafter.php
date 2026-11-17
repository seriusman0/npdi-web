<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Menyusun draf balasan WhatsApp berbahasa Indonesia formal memakai Gemini
 * (kuota gratis Google AI Studio). Konteks percakapan diambil dari gateway
 * supaya balasan menyambung percakapan, bukan jawaban generik.
 */
class WaReplyDrafter
{
    public function __construct(private WaGateway $gateway) {}

    /**
     * @return array{draft: ?string, model: ?string}
     */
    public function draft(string $chatId, string $latestBody): array
    {
        $key = (string) config('services.gemini.key');

        if ($key === '') {
            return ['draft' => null, 'model' => null];
        }

        $model = (string) config('services.gemini.model');

        $history = $this->gateway->history($chatId, 14);

        if ($history === []) {
            return ['draft' => null, 'model' => null];
        }

        $transcript = '';

        foreach ($history as $message) {
            // Pesan terbaru ditambahkan terpisah di bawah agar tidak tercatat dua kali.
            if ($message['direction'] === 'in' && $message['body'] === $latestBody && $message === end($history)) {
                continue;
            }

            $speaker = $message['direction'] === 'out' ? 'NPDI' : 'Klien';
            $transcript .= $speaker.': '.$message['body']."\n";
        }

        $prompt = "Riwayat percakapan WhatsApp terbaru (hanya konteks):\n\n"
            .(trim($transcript) !== '' ? trim($transcript) : '(belum ada riwayat sebelumnya)')
            ."\n\nPesan terakhir klien yang harus dijawab:\n".trim($latestBody)
            ."\n\nTulis balasan WhatsApp untuk pesan terakhir tersebut. Setiap pertanyaan di dalamnya harus dijawab.";

        return $this->complete($prompt, $model, $key);
    }

    /**
     * Draf balasan untuk pesan yang masuk lewat formulir kontak situs web
     * (bukan percakapan WhatsApp, jadi tidak ada riwayat untuk dijadikan konteks).
     *
     * @return array{draft: ?string, model: ?string}
     */
    public function draftInquiry(string $name, string $subject, string $message): array
    {
        $key = (string) config('services.gemini.key');

        if ($key === '') {
            return ['draft' => null, 'model' => null];
        }

        $model = (string) config('services.gemini.model');
        $sales = config('company.sales_email');

        $prompt = "Pesan baru dari formulir kontak situs web:\n\n"
            .'Nama: '.trim($name)."\n"
            .'Subjek: '.trim($subject)."\n"
            ."Isi pesan:\n".trim($message)
            ."\n\nTulis balasan email resmi untuk pesan tersebut. Aturan tambahan: "
            ."ucapkan terima kasih atas pesan yang dikirim, jawab inti pertanyaannya, "
            ."sampaikan bahwa tim akan menindaklanjuti paling lambat 1x24 jam kerja, "
            ."dan bila menyangkut lingkup atau biaya, arahkan penawaran resmi ke {$sales}. "
            .'Sebut nama penerima sekali di awal bila diperlukan. Jangan membuat janji jadwal pertemuan.';

        return $this->complete($prompt, $model, $key);
    }

    /**
     * @return array{draft: ?string, model: ?string}
     */
    private function complete(string $prompt, string $model, string $key): array
    {
        $generationConfig = [
            'temperature' => 0.4,
            'maxOutputTokens' => 2000,
        ];

        // Model Gemini 3 memakai token untuk "berpikir"; matikan agar isi draf tidak terpotong.
        if (str_contains($model, 'gemini-3')) {
            $generationConfig['thinkingConfig'] = ['thinkingLevel' => 'low'];
        }

        try {
            $response = Http::timeout(30)
                ->post('https://generativelanguage.googleapis.com/v1beta/models/'.$model.':generateContent?key='.$key, [
                    'systemInstruction' => ['parts' => [['text' => $this->instructions()]]],
                    'contents' => [['role' => 'user', 'parts' => [['text' => $prompt]]]],
                    'generationConfig' => $generationConfig,
                ]);

            if ($response->failed()) {
                Log::warning('Gemini gagal membuat draf balasan', [
                    'status' => $response->status(),
                    'body' => mb_substr($response->body(), 0, 300),
                ]);

                return ['draft' => null, 'model' => $model];
            }

            $text = (string) ($response->json('candidates.0.content.parts.0.text') ?? '');

            return ['draft' => $this->clean($text), 'model' => $model];
        } catch (\Throwable $e) {
            Log::warning('Gemini gagal membuat draf balasan', ['error' => $e->getMessage()]);

            return ['draft' => null, 'model' => $model];
        }
    }

    private function instructions(): string
    {
        $company = config('company');

        return <<<TEXT
        Anda adalah staf korespondensi resmi {$company['name']} ({$company['short_name']}), perusahaan di Nias, Sumatera Utara.

        Profil perusahaan:
        - Layanan dan estimasi durasi:
          * Pengembangan perangkat lunak (website, sistem informasi, aplikasi web, REST API): 4-12 minggu.
          * Jasa akses internet: 3-14 hari kerja.
          * Gerbang akses jaringan: 1-4 minggu.
          * Pengembangan e-commerce (toko daring): 3-8 minggu.
          * Konsultasi dan rancang IoT: 4-10 minggu.
        - Kontak: {$company['email']} (umum), {$company['sales_email']} (penawaran kerja sama), {$company['support_email']} (dukungan teknis).
        - Alamat: {$company['address']['street']}, {$company['address']['locality']}, {$company['address']['region']}.
        - Harga tidak dipublikasikan: lingkup dan harga disepakati tertulis sebelum pekerjaan dimulai, penawaran resmi dikirim melalui {$company['sales_email']} setelah kebutuhan jelas.

        Aturan menulis balasan (berlaku untuk WhatsApp maupun email):
        1. Bahasa Indonesia baku, formal, sopan, dan ringkas (2-4 kalimat). Sapa dengan "Bapak/Ibu" tanpa nama panggilan WhatsApp dan tanpa menebak gender.
        2. Jawab SETIAP pertanyaan pada pesan terakhir klien, termasuk bila klien menanyakan dua hal sekaligus (misalnya biaya dan durasi). Jangan mengganti jawaban dengan permintaan detail saja.
        3. Bila klien menanyakan durasi: tentukan layanan yang paling cocok (website/company profile/aplikasi = pengembangan perangkat lunak) lalu sebutkan angka estimasinya secara eksplisit, misal "sekitar 4-12 minggu". Bila klien menanyakan biaya: nyatakan bahwa penawaran resmi disusun setelah lingkup disepakati dan dikirim melalui {$company['sales_email']}, lalu sebutkan data yang perlu dilengkapi (jenis layanan, lingkup, tenggat).
        4. Jangan mengarang harga, angka, jadwal, atau janji di luar profil di atas.
        5. Jangan menyebut diri sebagai AI atau bot. Jangan memakai markdown, tanda bintang, atau emoji.
        6. Jangan memakai sapaan waktu ("selamat pagi/siang/sore") bila percakapan sudah berjalan; langsung jawab pesan terakhir. Bila perlu sapaan, cukup "Bapak/Ibu".
        7. Keluarkan HANYA teks balasan siap kirim, tanpa pembuka seperti "Berikut adalah", tanpa tanda kutip, tanpa catatan tambahan.
        TEXT;
    }

    private function clean(string $text): ?string
    {
        $text = trim($text);

        if ($text === '') {
            return null;
        }

        // Buang pembuka khas model yang tidak pantas dikirim ke klien.
        $text = preg_replace('/^(berikut (adalah )?|ini adalah |tentu,? )/i', '', $text) ?? $text;
        $text = trim($text, " \t\n\r\0\x0B\"'*");

        if (mb_strlen($text) > 900) {
            $text = mb_substr($text, 0, 900).'…';
        }

        return $text !== '' ? $text : null;
    }
}
