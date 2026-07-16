@extends('layouts.app')

@section('title', 'Layanan — Nano Project Dev Indonesia')
@section('meta_description', 'Lima layanan teknologi bersertifikat KBLI: software development, ISP, network access point, e-commerce, dan IoT consulting.')

@section('content')

{{-- Page Header --}}
<section class="bg-gradient-to-br from-brand-navy to-brand-navy-dark text-white py-16 px-4">
    <div class="max-w-5xl mx-auto text-center">
        <h1 class="text-4xl font-bold mb-4">Layanan Kami</h1>
        <p class="text-brand-teal-light/90 text-lg max-w-2xl mx-auto">Lima pilar layanan teknologi bersertifikat yang siap mendukung kebutuhan digital bisnis Anda.</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">

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
            'color' => 'blue',
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
            'color' => 'green',
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
            'color' => 'purple',
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
            'color' => 'orange',
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
            'color' => 'teal',
        ],
    ];
    @endphp

    @foreach($services as $i => $service)
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center {{ $i % 2 === 1 ? 'lg:flex-row-reverse' : '' }}">
        <div class="{{ $i % 2 === 1 ? 'lg:order-2' : '' }}">
            <span class="inline-block text-xs font-mono bg-brand-teal-light text-brand-teal border border-brand-teal/20 px-2 py-1 rounded mb-3">KBLI {{ $service['kbli'] }}</span>
            <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $service['title'] }}</h2>
            <p class="text-sm text-gray-500 mb-4">{{ $service['subtitle'] }}</p>
            <p class="text-gray-700 leading-relaxed mb-6">{{ $service['description'] }}</p>
            <ul class="space-y-2 mb-8">
                @foreach($service['features'] as $feature)
                <li class="flex items-center gap-3 text-gray-700">
                    <svg class="w-5 h-5 text-brand-teal shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ $feature }}
                </li>
                @endforeach
            </ul>
            <a href="{{ route('contact') }}" class="inline-block bg-brand-teal text-white font-semibold px-6 py-3 rounded-xl hover:bg-brand-teal-dark transition shadow-md shadow-brand-teal/10">
                Konsultasi Gratis
            </a>
        </div>
        <div class="{{ $i % 2 === 1 ? 'lg:order-1' : '' }} bg-brand-teal-light/35 border border-brand-teal/5 rounded-2xl p-12 flex items-center justify-center">
            <div class="w-24 h-24 bg-brand-teal-light rounded-2xl flex items-center justify-center border border-brand-teal/10">
                <svg class="w-12 h-12 text-brand-teal" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $service['icon'] }}"/>
                </svg>
            </div>
        </div>
    </div>
    @if(!$loop->last)
    <hr class="border-gray-100">
    @endif
    @endforeach

</div>

{{-- CTA --}}
<section class="bg-gray-50 py-16 px-4">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Tidak menemukan layanan yang sesuai?</h2>
        <p class="text-gray-600 mb-6">Hubungi kami untuk diskusi kebutuhan khusus Anda. Tim kami siap membantu menemukan solusi yang tepat.</p>
        <a href="{{ route('contact') }}" class="inline-block bg-brand-teal text-white font-semibold px-8 py-3 rounded-xl hover:bg-brand-teal-dark transition shadow-md shadow-brand-teal/10">
            Hubungi Kami Sekarang
        </a>
    </div>
</section>

@endsection
