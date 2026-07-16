@extends('layouts.app')

@section('title', 'Nano Project Dev Indonesia — Solusi Teknologi untuk Bisnis Anda')
@section('meta_description', 'Nano Project Dev Indonesia menyediakan layanan custom software, ISP, IoT, e-commerce, dan network access point. Berbasis di Nias, Sumatera Utara.')

@section('content')

{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-brand-navy to-brand-navy-dark text-white py-24 px-4 overflow-hidden">
    <!-- Floating decorative coder elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-15">
        <div class="absolute floating-code text-5xl font-mono" style="top: 15%; left: 8%; color: #02bec4;">&lt;/&gt;</div>
        <div class="absolute floating-code text-6xl font-mono" style="top: 60%; left: 12%; color: #02bec4;">{ }</div>
        <div class="absolute floating-code text-5xl font-mono" style="top: 20%; right: 10%; color: #02bec4;">[ ]</div>
        <div class="absolute floating-code text-4xl font-mono" style="top: 70%; right: 15%; color: #02bec4;">const</div>
        <div class="absolute floating-code text-5xl font-mono" style="top: 40%; left: 50%; color: #02bec4;">=&gt;</div>
    </div>

    <div class="max-w-5xl mx-auto text-center relative z-10">
        <span class="hero-badge inline-block bg-brand-teal/35 text-brand-teal-light text-sm font-medium px-3 py-1 rounded-full mb-4 opacity-0">Perseroan Perorangan Terdaftar · Kab. Nias, Sumatera Utara</span>
        <h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight opacity-0">
            Solusi Teknologi<br>untuk Bisnis Modern
        </h1>
        <p class="hero-subtitle text-brand-teal-light/90 text-lg sm:text-xl max-w-2xl mx-auto mb-10 leading-relaxed opacity-0">
            Nano Project Dev Indonesia menghadirkan layanan pemrograman, jaringan internet, pengembangan e-commerce, dan konsultasi IoT yang profesional dan terpercaya.
        </p>
        <div class="hero-btns flex flex-col sm:flex-row gap-4 justify-center opacity-0">
            <a href="{{ route('contact') }}" class="bg-brand-teal text-white font-semibold px-8 py-3 rounded-xl hover:bg-brand-teal-dark transition text-base shadow-lg shadow-brand-teal/20">
                Hubungi Kami
            </a>
            <a href="{{ route('services') }}" class="border-2 border-white text-white font-semibold px-8 py-3 rounded-xl hover:bg-white/10 transition text-base">
                Lihat Layanan
            </a>
        </div>
    </div>
</section>

{{-- Company Snapshot --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Tentang Nano Project Dev Indonesia</h2>
        <p class="text-gray-600 max-w-2xl mx-auto text-lg leading-relaxed">
            Perusahaan teknologi yang didirikan oleh <strong>Seriusman Waruwu, S.Kom</strong>, berbasis di Lahemo, Gido, Kabupaten Nias, Sumatera Utara. Kami berkomitmen menghadirkan solusi digital yang inovatif dan terpercaya bagi klien di seluruh Indonesia.
        </p>
        <a href="{{ route('about') }}" class="inline-block mt-4 text-brand-teal font-semibold hover:underline">Pelajari Lebih Lanjut →</a>
    </div>

    {{-- Stats --}}
    <div class="stats-container grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="stat-card bg-brand-teal-light/50 rounded-2xl p-6 text-center border border-brand-teal/10 opacity-0">
            <div class="text-3xl font-bold text-brand-navy mb-1"><span class="stat-count" data-value="5">0</span></div>
            <div class="text-sm text-gray-600">Bidang Layanan KBLI</div>
        </div>
        <div class="stat-card bg-brand-teal-light/50 rounded-2xl p-6 text-center border border-brand-teal/10 opacity-0">
            <div class="text-3xl font-bold text-brand-navy mb-1"><span class="stat-count" data-value="1">0</span></div>
            <div class="text-sm text-gray-600">Perseroan Terdaftar</div>
        </div>
        <div class="stat-card bg-brand-teal-light/50 rounded-2xl p-6 text-center border border-brand-teal/10 opacity-0">
            <div class="text-3xl font-bold text-brand-navy mb-1"><span class="stat-count" data-value="100">0</span>%</div>
            <div class="text-sm text-gray-600">Legalitas Terjamin</div>
        </div>
        <div class="stat-card bg-brand-teal-light/50 rounded-2xl p-6 text-center border border-brand-teal/10 opacity-0">
            <div class="text-3xl font-bold text-brand-navy mb-1"><span class="stat-count" data-value="24">0</span>/7</div>
            <div class="text-sm text-gray-600">Siap Konsultasi</div>
        </div>
    </div>
</section>

{{-- Services Grid --}}
<section class="bg-gray-50 py-16 px-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Lima Pilar Layanan Kami</h2>
            <p class="text-gray-600 max-w-xl mx-auto">Kegiatan usaha bersertifikat sesuai KBLI yang kami tawarkan untuk kebutuhan teknologi bisnis Anda.</p>
        </div>
        <div class="services-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['62199', 'Custom Software Development', 'Pengembangan aplikasi dan sistem perangkat lunak sesuai kebutuhan spesifik bisnis Anda.', 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
                ['61104', 'Internet Service Provider', 'Layanan akses internet yang andal dan berkecepatan tinggi untuk rumah, bisnis, dan institusi.', 'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0'],
                ['61107', 'Network Access Point', 'Infrastruktur gerbang akses internet dan manajemen jaringan untuk konektivitas optimal.', 'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01'],
                ['62191', 'E-Commerce Development', 'Pembuatan platform perdagangan elektronik yang aman, skalabel, dan mudah dikelola.', 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
                ['62204', 'IoT Consulting & Design', 'Konsultasi dan perancangan sistem Internet of Things untuk efisiensi operasional dan otomatisasi.', 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18'],
            ] as $service)
            <div class="service-card bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition opacity-0">
                <div class="w-12 h-12 bg-brand-teal-light rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-brand-teal" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $service[3] }}"/>
                    </svg>
                </div>
                <span class="text-xs font-mono text-brand-teal bg-brand-teal-light px-2 py-0.5 rounded">KBLI {{ $service[0] }}</span>
                <h3 class="text-lg font-semibold text-gray-900 mt-2 mb-2">{{ $service[1] }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $service[2] }}</p>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('services') }}" class="inline-block bg-brand-teal text-white font-semibold px-8 py-3 rounded-xl hover:bg-brand-teal-dark transition shadow-md shadow-brand-teal/10">
                Lihat Detail Layanan
            </a>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
    <div class="bg-brand-navy rounded-3xl py-16 px-8 shadow-xl shadow-brand-navy/10">
        <h2 class="text-3xl font-bold text-white mb-4">Siap Memulai Proyek Anda?</h2>
        <p class="text-brand-teal-light mb-8 max-w-xl mx-auto opacity-90">Konsultasikan kebutuhan teknologi bisnis Anda bersama kami. Gratis, tanpa komitmen.</p>
        <a href="{{ route('contact') }}" class="bg-brand-teal text-white font-semibold px-8 py-3 rounded-xl hover:bg-brand-teal-dark transition inline-block shadow-lg shadow-brand-teal/20">
            Mulai Konsultasi Gratis
        </a>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Floating decorative elements infinite loop
    anime({
        targets: '.floating-code',
        translateY: [-15, 15],
        translateX: [-10, 10],
        rotate: [0, 10],
        duration: function() { return anime.random(3500, 6000); },
        delay: function() { return anime.random(0, 1000); },
        direction: 'alternate',
        loop: true,
        easing: 'easeInOutSine'
    });

    // 2. Hero entrance staggering
    anime.timeline({
        easing: 'easeOutExpo',
    })
    .add({
        targets: '.hero-badge',
        opacity: [0, 1],
        translateY: [25, 0],
        duration: 800
    })
    .add({
        targets: '.hero-title',
        opacity: [0, 1],
        translateY: [35, 0],
        duration: 900
    }, '-=600')
    .add({
        targets: '.hero-subtitle',
        opacity: [0, 1],
        translateY: [25, 0],
        duration: 800
    }, '-=700')
    .add({
        targets: '.hero-btns',
        opacity: [0, 1],
        scale: [0.93, 1],
        duration: 600
    }, '-=600');

    // 3. Scroll Trigger for Stats
    const statsContainer = document.querySelector('.stats-container');
    if (statsContainer) {
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Stagger fade-in stat cards
                    anime({
                        targets: '.stat-card',
                        opacity: [0, 1],
                        translateY: [30, 0],
                        delay: anime.stagger(120),
                        duration: 800,
                        easing: 'easeOutQuad',
                        complete: () => {
                            // Count-up numbers after cards appear
                            anime({
                                targets: '.stat-count',
                                innerHTML: [0, function(el) { return el.getAttribute('data-value'); }],
                                round: 1,
                                easing: 'easeOutQuint',
                                duration: 1500
                            });
                        }
                    });
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        statsObserver.observe(statsContainer);
    }

    // 4. Scroll Trigger for Services Cards
    const servicesGrid = document.querySelector('.services-grid');
    if (servicesGrid) {
        const servicesObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    anime({
                        targets: '.service-card',
                        opacity: [0, 1],
                        translateY: [40, 0],
                        delay: anime.stagger(150),
                        easing: 'easeOutExpo',
                        duration: 1200
                    });
                    servicesObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        servicesObserver.observe(servicesGrid);
    }
});
</script>

@endsection
