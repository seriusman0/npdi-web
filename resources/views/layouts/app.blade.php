<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $pageTitle = trim($__env->yieldContent('title')) ?: 'Nano Project Dev Indonesia';
        $pageDescription = trim($__env->yieldContent('meta_description'))
            ?: 'Nano Project Dev Indonesia — studio pengembangan perangkat lunak di Nias, Sumatera Utara. Membangun aplikasi web, platform belajar, e-commerce, dan infrastruktur jaringan untuk perusahaan dan lembaga.';
        $canonical = url()->current();
        $ogImage = asset('assets/icon/favicon-512x512.png');
    @endphp

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta name="theme-color" content="#0A1526">
    <meta name="robots" content="index, follow">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Nano Project Dev Indonesia">
    <meta property="og:locale" content="id_ID">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $ogImage }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- Favicons --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/icon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/icon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/icon/favicon-48x48.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/icon/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/icon/favicon-180x180.png') }}">

    {{-- Font lokal: preload dua bobot yang paling sering dipakai --}}
    <link rel="preload" href="{{ asset('assets/fonts/instrument-sans-400.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets/fonts/instrument-sans-600.woff2') }}" as="font" type="font/woff2" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        // Disusun sebagai array lalu di-encode, agar simbol "@" pada kunci
        // schema.org tidak dibaca sebagai direktif Blade.
        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => 'Nano Project Dev Indonesia',
            'alternateName' => 'NPDI',
            'url' => 'https://nanoprojectdevindonesia.com',
            'logo' => $ogImage,
            'description' => 'Studio pengembangan perangkat lunak: aplikasi web, platform pembelajaran, e-commerce, IoT, dan infrastruktur jaringan.',
            'email' => config('company.email'),
            'telephone' => '+'.config('company.phone_e164'),
            'founder' => ['@type' => 'Person', 'name' => 'Seriusman Waruwu'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Lahemo, Gido',
                'addressLocality' => 'Kabupaten Nias',
                'addressRegion' => 'Sumatera Utara',
                'addressCountry' => 'ID',
            ],
            'areaServed' => ['@type' => 'Country', 'name' => 'Indonesia'],
            'sameAs' => ['https://instagram.com/seriusman0'],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
</head>
<body class="min-h-screen flex flex-col">

    <a href="#konten" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[60] focus:bg-ink focus:text-white focus:px-4 focus:py-2 focus:rounded">
        Lompat ke konten
    </a>

    {{-- ── Header ─────────────────────────────────────── --}}
    <header class="sticky top-0 z-50 bg-paper/90 backdrop-blur border-b hairline">
        <div class="mx-auto max-w-[1180px] px-5 sm:px-8">
            <div class="flex h-16 items-center justify-between gap-6">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5" aria-label="Nano Project Dev Indonesia — Beranda">
                    <img src="{{ asset('assets/logo/logo.png') }}" alt="" class="h-8 w-8 object-contain">
                    <span class="leading-tight">
                        <span class="block text-[13px] font-semibold tracking-tight text-ink">Nano Project Dev</span>
                        <span class="block text-[10px] font-mono uppercase tracking-[0.18em] text-muted">Indonesia</span>
                    </span>
                </a>

                {{-- Desktop --}}
                <nav class="hidden md:flex items-center gap-7 text-[13.5px] font-medium" aria-label="Navigasi utama">
                    @foreach ([
                        ['services', 'layanan', 'Layanan'],
                        ['projects', 'proyek', 'Proyek'],
                        ['about', 'tentang-kami', 'Tentang'],
                    ] as [$routeName, $uri, $label])
                        @php $active = request()->is($uri) || request()->is($uri . '/*'); @endphp
                        <a href="{{ route($routeName) }}"
                           class="transition-colors {{ $active ? 'text-ink' : 'text-muted hover:text-ink' }}"
                           @if ($active) aria-current="page" @endif>{{ $label }}</a>
                    @endforeach
                    <a href="{{ route('contact') }}"
                       class="transition-colors {{ request()->is('hubungi-kami') ? 'text-ink' : 'text-muted hover:text-ink' }}"
                       @if (request()->is('hubungi-kami')) aria-current="page" @endif>Kontak</a>
                    <a href="{{ route('contact') }}" class="btn btn-primary !py-2.5 !px-4 !text-[13px]">Mulai proyek</a>
                </nav>

                {{-- Mobile toggle --}}
                <button type="button" data-nav-toggle aria-expanded="false" aria-controls="nav-mobile"
                        class="md:hidden inline-flex items-center justify-center h-10 w-10 -mr-2 rounded-md text-ink hover:bg-paper-soft transition">
                    <span class="sr-only">Buka menu</span>
                    <svg data-icon-open class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/>
                    </svg>
                    <svg data-icon-close hidden class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile panel --}}
        <div id="nav-mobile" data-nav-panel hidden class="md:hidden border-t hairline bg-paper">
            <nav class="mx-auto max-w-[1180px] px-5 sm:px-8 py-3 flex flex-col" aria-label="Navigasi seluler">
                @foreach ([
                    ['home', 'Beranda'],
                    ['services', 'Layanan'],
                    ['projects', 'Proyek'],
                    ['about', 'Tentang Kami'],
                    ['contact', 'Kontak'],
                ] as [$routeName, $label])
                    <a href="{{ route($routeName) }}" class="py-2.5 text-[15px] text-ink-soft border-b hairline last:border-0">{{ $label }}</a>
                @endforeach
                <a href="{{ route('contact') }}" class="btn btn-primary mt-3 mb-1 w-full">Mulai proyek</a>
            </nav>
        </div>
    </header>

    <main id="konten" class="flex-1">
        @yield('content')
    </main>

    {{-- ── Footer ─────────────────────────────────────── --}}
    <footer class="bg-ink text-white/70 mt-24">
        <div class="mx-auto max-w-[1180px] px-5 sm:px-8 py-14">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">
                <div class="lg:col-span-4">
                    <div class="flex items-center gap-2.5 mb-4">
                        <img src="{{ asset('assets/logo/logo.png') }}" alt="" class="h-8 w-8 object-contain">
                        <span class="text-white text-[13px] font-semibold leading-tight">
                            Nano Project Dev<br><span class="font-mono text-[10px] uppercase tracking-[0.18em] text-white/50">Indonesia</span>
                        </span>
                    </div>
                    <p class="text-[13.5px] leading-relaxed text-white/55 max-w-xs">
                        Studio pengembangan perangkat lunak dan infrastruktur jaringan. Berbasis di Nias, Sumatera Utara.
                    </p>
                    <p class="mt-4 text-[12px] text-white/35">
                        Perseroan Perorangan · KBLI 62199, 61104, 61107, 62191, 62204
                    </p>
                </div>

                <div class="lg:col-span-2">
                    <h4 class="font-mono text-[10px] uppercase tracking-[0.18em] text-white/40 mb-4">Navigasi</h4>
                    <ul class="space-y-2.5 text-[13.5px]">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition-colors">Layanan</a></li>
                        <li><a href="{{ route('projects') }}" class="hover:text-white transition-colors">Proyek</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Tentang</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-3">
                    <h4 class="font-mono text-[10px] uppercase tracking-[0.18em] text-white/40 mb-4">Yang kami kerjakan</h4>
                    <ul class="space-y-2.5 text-[13.5px]">
                        <li>Aplikasi web &amp; sistem internal</li>
                        <li>Platform belajar &amp; e-commerce</li>
                        <li>Integrasi API &amp; otomasi</li>
                        <li>Jaringan, ISP &amp; IoT</li>
                    </ul>
                </div>

                <div class="lg:col-span-3">
                    <h4 class="font-mono text-[10px] uppercase tracking-[0.18em] text-white/40 mb-4">Kontak</h4>
                    <ul class="space-y-2.5 text-[13.5px]">
                        <li><a href="mailto:{{ config('company.email') }}" class="hover:text-white transition-colors">{{ config('company.email') }}</a></li>
                        <li><a href="{{ config('company.whatsapp_url') }}" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors">{{ config('company.phone_display') }}</a></li>
                        <li><a href="https://instagram.com/seriusman0" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors">@seriusman0</a></li>
                        <li class="text-white/45 pt-1 leading-relaxed">{{ config('company.address.street') }}<br>{{ config('company.address.locality') }}, {{ config('company.address.region') }}</li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-6 border-t border-white/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-[12px] text-white/35">
                <span>&copy; {{ date('Y') }} Nano Project Dev Indonesia. Seluruh hak cipta dilindungi.</span>
                <span>Didirikan oleh Seriusman Waruwu, S.Kom</span>
            </div>
        </div>
    </footer>

</body>
</html>
