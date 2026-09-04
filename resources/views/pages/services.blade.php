@extends('layouts.app')

@section('title', 'Layanan — Nano Project Dev Indonesia')
@section('meta_description', 'Lima layanan teknologi bersertifikat KBLI: software development, ISP, network access point, e-commerce, dan IoT consulting.')

@section('content')

{{-- Page Header --}}
<section class="relative overflow-hidden bg-gradient-to-br from-[#F7F8FA] to-[#EEF1F6] py-20 px-4 border-b border-black/5">
    <div class="absolute -top-24 -left-24 w-72 h-72 bg-[#00A8AD]/6 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-5xl mx-auto text-center relative z-10">
        <span class="inline-block text-xs font-display font-semibold uppercase tracking-widest text-[#006b6e] bg-[#E3F6F7] px-3 py-1 rounded-full mb-4">Layanan</span>
        <h1 class="font-display font-extrabold text-4xl sm:text-5xl text-[#071638] tracking-tight mb-4">Layanan Kami</h1>
        <p class="font-serif italic text-[#6B7280] text-lg max-w-2xl mx-auto leading-relaxed">
            Lima pilar layanan teknologi bersertifikat yang siap mendukung kebutuhan digital bisnis Anda.
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-6">

    @php
    $services = [
        [
            'kbli' => '62199',
            'title' => 'Custom Software Development',
            'subtitle' => 'Aktivitas Pemrograman Komputer Lainnya',
            'description' => 'Kami merancang dan mengembangkan perangkat lunak yang disesuaikan sepenuhnya dengan proses bisnis dan kebutuhan unik Anda. Dari aplikasi web, sistem informasi manajemen, hingga API backend yang skalabel.',
            'features' => [
                'Pengembangan aplikasi web & mobile',
                'Sistem informasi manajemen (SIM)',
                'REST API & integrasi sistem',
                'Maintenance & support pasca-produksi',
            ],
            'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
        ],
        [
            'kbli' => '61104',
            'title' => 'Internet Service Provider (ISP)',
            'subtitle' => 'Aktivitas Jasa Akses Internet',
            'description' => 'Menyediakan layanan akses internet berkecepatan tinggi yang andal untuk kebutuhan rumah tangga, bisnis kecil menengah, hingga institusi pendidikan dan pemerintahan di wilayah Kepulauan Nias.',
            'features' => [
                'Koneksi internet dedicated & shared',
                'Bandwidth simetris untuk bisnis',
                'Monitoring jaringan 24/7',
                'Dukungan teknis responsif',
            ],
            'icon' => 'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0',
        ],
        [
            'kbli' => '61107',
            'title' => 'Network Access Point',
            'subtitle' => 'Aktivitas Jasa Gerbang Akses Internet',
            'description' => 'Perancangan dan pengelolaan infrastruktur gerbang akses internet (Network Access Point) untuk menghubungkan jaringan lokal ke internet global secara efisien dan aman.',
            'features' => [
                'Instalasi & konfigurasi perangkat jaringan',
                'Manajemen routing & switching',
                'Keamanan jaringan & firewall',
                'Optimasi bandwidth & QoS',
            ],
            'icon' => 'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01',
        ],
        [
            'kbli' => '62191',
            'title' => 'E-Commerce Development',
            'subtitle' => 'Aktivitas Pengembangan Aplikasi Perdagangan melalui Internet',
            'description' => 'Membangun platform e-commerce yang profesional, aman, dan mudah dikelola. Dari toko online sederhana hingga marketplace dengan fitur lengkap, kami hadirkan solusi yang tepat untuk bisnis digital Anda.',
            'features' => [
                'Pengembangan toko online custom',
                'Integrasi payment gateway lokal & internasional',
                'Manajemen produk & inventori',
                'Dashboard admin & laporan penjualan',
            ],
            'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
        ],
        [
            'kbli' => '62204',
            'title' => 'IoT Consulting & Design',
            'subtitle' => 'Aktivitas Konsultansi dan Perancangan Internet of Things',
            'description' => 'Konsultasi dan perancangan sistem IoT untuk transformasi bisnis Anda ke era industri 4.0. Kami membantu merancang arsitektur sensor, konektivitas, dan platform data untuk otomatisasi dan efisiensi operasional.',
            'features' => [
                'Konsultasi arsitektur sistem IoT',
                'Perancangan jaringan sensor & aktuator',
                'Integrasi platform cloud IoT',
                'Dashboard monitoring real-time',
            ],
            'icon' => 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18',
        ],
    ];
    @endphp

    @foreach($services as $i => $service)
    <div class="card-soft p-8 lg:p-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div class="{{ $i % 2 === 1 ? 'lg:order-2' : '' }}">
                <span class="inline-block text-[10px] font-display font-semibold uppercase tracking-widest bg-[#E3F6F7] text-[#006b6e] border border-[#00A8AD]/15 px-2.5 py-1 rounded mb-4">KBLI {{ $service['kbli'] }}</span>
                <h2 class="font-display font-bold text-2xl text-[#071638] mb-1 tracking-tight">{{ $service['title'] }}</h2>
                <p class="text-xs font-serif italic text-[#9CA3AF] mb-4">{{ $service['subtitle'] }}</p>
                <p class="text-[#6B7280] leading-relaxed mb-6 text-sm">{{ $service['description'] }}</p>
                <ul class="space-y-2.5 mb-8">
                    @foreach($service['features'] as $feature)
                    <li class="flex items-center gap-3 text-[#6B7280] text-sm">
                        <svg class="w-4 h-4 text-[#00A8AD] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('contact') }}"
                   class="font-display font-bold inline-block bg-[#071638] text-white px-6 py-3 rounded-xl hover:bg-[#040d21] transition-all duration-200 text-sm shadow-md shadow-[#071638]/10">
                    Konsultasi Gratis
                </a>
            </div>
            <div class="{{ $i % 2 === 1 ? 'lg:order-1' : '' }} bg-[#EEF1F6] rounded-2xl p-12 flex items-center justify-center border border-black/4">
                <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center shadow-card border border-black/4">
                    <svg class="w-10 h-10 text-[#00A8AD]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $service['icon'] }}"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    @if(!$loop->last)
    <div class="h-px bg-black/4"></div>
    @endif
    @endforeach

</div>

{{-- CTA --}}
<section class="section-warm py-16 px-4">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="font-display font-bold text-2xl sm:text-3xl text-[#071638] mb-4 tracking-tight">
            Tidak menemukan layanan yang sesuai?
        </h2>
        <p class="font-serif italic text-[#6B7280] mb-8 text-lg leading-relaxed">
            Hubungi kami untuk diskusi kebutuhan khusus Anda. Tim kami siap membantu menemukan solusi yang tepat.
        </p>
        <a href="{{ route('contact') }}"
           class="font-display font-bold inline-block bg-[#071638] text-white px-8 py-3.5 rounded-xl hover:bg-[#040d21] transition-all duration-200 text-sm shadow-md shadow-[#071638]/10">
            Hubungi Kami Sekarang
        </a>
    </div>
</section>

@endsection
