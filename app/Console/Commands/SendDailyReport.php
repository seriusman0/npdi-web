<?php

namespace App\Console\Commands;

use App\Models\ContactMessage;
use App\Models\PageView;
use App\Models\WhatsappMessage;
use App\Support\Telegram;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * Laporan harian situs: pengunjung, halaman terpopuler, sumber kunjungan,
 * pesan masuk dari form dan WhatsApp — dikirim ke Telegram pemilik.
 */
class SendDailyReport extends Command
{
    protected $signature = 'report:daily {--date= : Tanggal laporan (Y-m-d), default hari ini WIB}';

    protected $description = 'Kirim ringkasan harian trafik situs dan pesan masuk ke Telegram';

    public function handle(): int
    {
        $tz = 'Asia/Jakarta';
        $day = $this->option('date')
            ? Carbon::parse($this->option('date'), $tz)->startOfDay()
            : Carbon::now($tz)->startOfDay();

        $start = $day->copy()->utc();
        $end = $day->copy()->endOfDay()->utc();
        $yesterdayStart = $start->copy()->subDay();
        $yesterdayEnd = $end->copy()->subDay();

        $views = PageView::whereBetween('created_at', [$start, $end]);
        $pageviews = (clone $views)->count();
        $visitors = (clone $views)->distinct()->count('visitor_id');
        $topPages = (clone $views)
            ->selectRaw('path, count(*) as hits')
            ->groupBy('path')
            ->orderByDesc('hits')
            ->limit(5)
            ->get();
        $topReferrers = (clone $views)
            ->whereNotNull('referrer')
            ->selectRaw('referrer, count(*) as hits')
            ->groupBy('referrer')
            ->orderByDesc('hits')
            ->limit(5)
            ->get();

        $yesterdayVisitors = PageView::whereBetween('created_at', [$yesterdayStart, $yesterdayEnd])
            ->distinct()->count('visitor_id');

        $inquiries = ContactMessage::whereBetween('created_at', [$start, $end])->get();
        $waMessages = WhatsappMessage::whereBetween('received_at', [$start, $end])->count();

        $lines = [];
        $lines[] = '📊 <b>Laporan Harian Situs</b>';
        $lines[] = Telegram::escape(config('company.name'));
        $lines[] = '<b>'.Telegram::escape($day->translatedFormat('l, d F Y')).'</b>';
        $lines[] = '';
        $lines[] = '👥 <b>Pengunjung unik:</b> '.$visitors.' (kemarin '.$yesterdayVisitors.')';
        $lines[] = '📄 <b>Halaman dibuka:</b> '.$pageviews.' kali';
        $lines[] = '📩 <b>Pesan form:</b> '.$inquiries->count();
        $lines[] = '💬 <b>WhatsApp masuk:</b> '.$waMessages;

        if ($topPages->isNotEmpty()) {
            $lines[] = '';
            $lines[] = '<b>Halaman terpopuler</b>';

            foreach ($topPages as $page) {
                $lines[] = '• '.Telegram::escape($page->path).' — '.$page->hits;
            }
        }

        if ($topReferrers->isNotEmpty()) {
            $lines[] = '';
            $lines[] = '<b>Sumber kunjungan</b>';

            foreach ($topReferrers as $ref) {
                $lines[] = '• '.Telegram::escape($ref->referrer).' — '.$ref->hits;
            }
        }

        if ($inquiries->isNotEmpty()) {
            $lines[] = '';
            $lines[] = '<b>Pesan masuk</b>';

            foreach ($inquiries->take(5) as $inquiry) {
                $lines[] = '• '.Telegram::escape($inquiry->name).' — '.Telegram::escape($inquiry->subject);
            }

            if ($inquiries->count() > 5) {
                $lines[] = '• …dan '.($inquiries->count() - 5).' lainnya di panel admin';
            }
        }

        if ($visitors === 0 && $inquiries->isEmpty()) {
            $lines[] = '';
            $lines[] = '<i>Tidak ada kunjungan tercatat hari ini.</i>';
        }

        $buttons = [[
            [
                'text' => 'Buka panel admin',
                'url' => route('admin.dashboard'),
            ],
        ]];

        $sent = Telegram::send(implode("\n", $lines), $buttons);

        $this->info($sent ? 'Laporan terkirim ke Telegram.' : 'Laporan GAGAL dikirim, cek log.');

        return $sent ? self::SUCCESS : self::FAILURE;
    }
}
