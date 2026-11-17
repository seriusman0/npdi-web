<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Analitik first-party: mencatat kunjungan halaman tanpa cookie pihak ketiga.
 * Tidak menyimpan IP mentah — hanya hash untuk menghitung pengunjung unik.
 */
class TrackPageVisit
{
    private const BOT_PATTERN = '/bot|crawl|spider|slurp|bingpreview|facebookexternalhit|embedly|quora link preview|whatsapp|telegrambot|semrush|ahrefs|mj12|dotbot|petalbot|yandex|baidu|headless|phantomjs|lighthouse|gtmetrix|uptime|monitor|preview|scraper|curl|wget|python-requests|go-http-client|axios|httpclient|node-fetch/i';

    private const IGNORED_PATHS = ['admin', 'admin/*', 'up', 'webhooks/*', 'api/*', 'build/*', 'assets/*'];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        try {
            $this->record($request, $response);
        } catch (\Throwable $e) {
            // Analitik tidak boleh pernah menggagalkan halaman pengunjung.
            Log::warning('TrackPageVisit gagal: '.$e->getMessage());
        }

        return $response;
    }

    private function record(Request $request, Response $response): void
    {
        if (! $request->isMethod('GET')) {
            return;
        }

        if ($request->is(...self::IGNORED_PATHS)) {
            return;
        }

        if ($response->getStatusCode() !== 200) {
            return;
        }

        $contentType = (string) $response->headers->get('Content-Type');

        if (! str_contains($contentType, 'text/html')) {
            return;
        }

        // Hormati permintaan "jangan lacak" dari browser.
        if ($request->header('DNT') === '1' || $request->header('Sec-GPC') === '1') {
            return;
        }

        $userAgent = (string) $request->userAgent();

        if ($userAgent === '' || preg_match(self::BOT_PATTERN, $userAgent)) {
            return;
        }

        if (! $request->hasSession()) {
            return;
        }

        $appKey = (string) config('app.key');
        $now = now();

        PageView::insert([
            'path' => mb_substr('/'.ltrim($request->path(), '/'), 0, 255),
            'referrer' => $this->referrer($request),
            'visitor_id' => hash_hmac('sha256', $request->session()->getId(), $appKey),
            'user_agent' => mb_substr($userAgent, 0, 255),
            'ip_hash' => hash_hmac('sha256', (string) $request->ip(), $appKey),
            'created_at' => $now,
        ]);
    }

    private function referrer(Request $request): ?string
    {
        $referer = (string) $request->headers->get('referer');

        if ($referer === '') {
            return null;
        }

        $parts = parse_url($referer);
        $host = $parts['host'] ?? null;

        if ($host === null || strcasecmp($host, $request->getHost()) === 0) {
            return null;
        }

        return mb_substr($host.(isset($parts['path']) ? $parts['path'] : ''), 0, 255);
    }
}
