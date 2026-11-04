@extends('layouts.app')

@section('title', 'Nano Project Dev Indonesia — Solusi Teknologi untuk Bisnis Anda')
@section('meta_description', 'Nano Project Dev Indonesia menyediakan layanan custom software, ISP, IoT, e-commerce, dan network access point. Berbasis di Nias, Sumatera Utara.')

@section('content')

{{-- Hero Section --}}
<section class="relative overflow-hidden bg-gradient-to-br from-[#F7F8FA] via-[#EEF1F6] to-[#E3F6F7] py-28 px-4">
    {{-- Subtle decorative blobs --}}
    <div class="absolute -top-32 -right-32 w-96 h-96 bg-[#00A8AD]/8 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-[#071638]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-5xl mx-auto text-center relative z-10">
        <span class="hero-badge inline-flex items-center gap-1.5 bg-white border border-[#00A8AD]/20 text-[#006b6e] text-xs font-display font-semibold px-4 py-1.5 rounded-full mb-6 shadow-sm opacity-0">
            <span class="w-1.5 h-1.5 bg-[#00A8AD] rounded-full"></span>
            Perseroan Perorangan Terdaftar · Kab. Nias, Sumatera Utara
        </span>
        <h1 class="hero-title font-display font-extrabold text-5xl sm:text-6xl lg:text-7xl text-[#071638] leading-[1.08] tracking-tight mb-5 opacity-0">
            Solusi Teknologi<br>
            <span class="text-[#00A8AD]">untuk Bisnis</span> Modern
        </h1>
        <p class="hero-subtitle font-serif italic text-[#6B7280] text-lg sm:text-xl max-w-2xl mx-auto mb-10 leading-relaxed opacity-0">
            Layanan pemrograman, jaringan internet, e-commerce, dan IoT yang profesional, terpercaya, dan terjangkau.
        </p>
        <div class="hero-btns flex flex-col sm:flex-row gap-3 justify-center opacity-0">
            <a href="{{ route('contact') }}"
               class="font-display font-bold bg-[#071638] text-white px-8 py-3.5 rounded-xl hover:bg-[#040d21] transition-all duration-200 text-sm shadow-md shadow-[#071638]/15">
                Hubungi Kami
            </a>
            <a href="{{ route('services') }}"
               class="font-display font-semibold bg-white border border-black/10 text-[#1A1D2E] px-8 py-3.5 rounded-xl hover:border-[#00A8AD]/30 hover:text-[#006b6e] transition-all duration-200 text-sm shadow-sm">
                Lihat Layanan
            </a>
        </div>
    </div>
</section>

{{-- Company Snapshot --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center mb-14">
        <h2 class="font-display font-bold text-3xl sm:text-4xl text-[#071638] mb-4 tracking-tight">
            Tentang Nano Project Dev Indonesia
        </h2>
        <p class="font-serif italic text-[#6B7280] max-w-2xl mx-auto text-lg leading-relaxed">
            Perusahaan teknologi yang didirikan oleh <strong class="not-italic font-semibold text-[#1A1D2E]">Seriusman Waruwu, S.Kom</strong>,
            berbasis di Lahemo, Gido, Kabupaten Nias, Sumatera Utara.
        </p>
        <a href="{{ route('about') }}" class="inline-block mt-5 text-[#006b6e] font-display font-semibold text-sm hover:underline underline-offset-4">
            Pelajari Lebih Lanjut →
        </a>
    </div>

    {{-- Stats --}}
    <div class="stats-container grid grid-cols-2 md:grid-cols-4 gap-5">
        @foreach([
            ['5', 'Bidang Layanan KBLI', '+'],
            ['1', 'Perseroan Terdaftar', ''],
            ['100', 'Legalitas Terjamin', '%'],
            ['24', 'Siap Konsultasi', '/7'],
        ] as $stat)
        <div class="stat-card card-soft p-6 text-center opacity-0">
            <div class="font-display font-extrabold text-3xl text-[#071638] mb-1">
                <span class="stat-count" data-value="{{ $stat[0] }}">0</span><span class="text-[#00A8AD]">{{ $stat[2] }}</span>
            </div>
            <div class="text-xs text-[#6B7280] font-medium tracking-wide">{{ $stat[1] }}</div>
        </div>
        @endforeach
    </div>
</section>

{{-- Services Grid --}}
<section class="section-warm py-20 px-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="inline-block text-xs font-display font-semibold uppercase tracking-widest text-[#006b6e] bg-[#E3F6F7] px-3 py-1 rounded-full mb-4">Layanan</span>
            <h2 class="font-display font-bold text-3xl sm:text-4xl text-[#071638] tracking-tight mb-3">Lima Pilar Layanan Kami</h2>
            <p class="text-[#6B7280] max-w-xl mx-auto text-sm leading-relaxed">
                Kegiatan usaha bersertifikat KBLI yang kami tawarkan untuk kebutuhan teknologi bisnis Anda.
            </p>
        </div>
        <div class="services-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach([
                ['62199', 'Custom Software Development', 'Pengembangan aplikasi dan sistem perangkat lunak sesuai kebutuhan spesifik bisnis Anda.', 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
                ['61104', 'Internet Service Provider', 'Layanan akses internet yang andal dan berkecepatan tinggi untuk rumah, bisnis, dan institusi.', 'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0'],
                ['61107', 'Network Access Point', 'Infrastruktur gerbang akses internet dan manajemen jaringan untuk konektivitas optimal.', 'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01'],
                ['62191', 'E-Commerce Development', 'Pembuatan platform perdagangan elektronik yang aman, skalabel, dan mudah dikelola.', 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
                ['62204', 'IoT Consulting & Design', 'Konsultasi dan perancangan sistem Internet of Things untuk efisiensi operasional dan otomatisasi.', 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18'],
            ] as $service)
            <div class="service-card card-soft p-6 opacity-0">
                <div class="w-10 h-10 bg-[#E3F6F7] rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-5 h-5 text-[#00A8AD]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $service[3] }}"/>
                    </svg>
                </div>
                <span class="text-[10px] font-display font-semibold uppercase tracking-widest text-[#006b6e] bg-[#E3F6F7] px-2 py-0.5 rounded">
                    KBLI {{ $service[0] }}
                </span>
                <h3 class="font-display font-bold text-base text-[#1A1D2E] mt-3 mb-2">{{ $service[1] }}</h3>
                <p class="text-[#6B7280] text-sm leading-relaxed">{{ $service[2] }}</p>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('services') }}"
               class="font-display font-bold inline-block bg-[#071638] text-white px-8 py-3.5 rounded-xl hover:bg-[#040d21] transition-all duration-200 text-sm shadow-md shadow-[#071638]/10">
                Lihat Detail Layanan
            </a>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="px-4 pb-24">
    <div class="max-w-5xl mx-auto">
        <div class="bg-gradient-to-br from-[#071638] to-[#040d21] rounded-3xl py-16 px-8 text-center shadow-elevated relative overflow-hidden">
            <div class="absolute inset-0 bg-[#00A8AD]/5 rounded-3xl"></div>
            <div class="relative z-10">
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-white mb-4 tracking-tight">Siap Memulai Proyek Anda?</h2>
                <p class="font-serif italic text-white/60 mb-8 max-w-xl mx-auto text-lg leading-relaxed">
                    Konsultasikan kebutuhan teknologi bisnis Anda bersama kami. Gratis, tanpa komitmen.
                </p>
                <a href="{{ route('contact') }}"
                   class="font-display font-bold inline-block bg-[#00A8AD] text-white px-8 py-3.5 rounded-xl hover:bg-[#008F94] transition-all duration-200 text-sm shadow-lg shadow-[#00A8AD]/25">
                    Mulai Konsultasi Gratis
                </a>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // ── Hero entrance (gentle, no floating elements) ──────────
    anime.timeline({ easing: 'easeOutExpo' })
        .add({ targets: '.hero-badge', opacity: [0, 1], translateY: [12, 0], duration: 600 })
        .add({ targets: '.hero-title', opacity: [0, 1], translateY: [20, 0], duration: 700 }, '-=400')
        .add({ targets: '.hero-subtitle', opacity: [0, 1], translateY: [12, 0], duration: 600 }, '-=500')
        .add({ targets: '.hero-btns', opacity: [0, 1], translateY: [8, 0], duration: 500 }, '-=400');

    // ── Scroll-triggered fade-in for .fade-up elements ────────
    const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-up').forEach(el => io.observe(el));

    // ── Stat cards + count-up ────────────────────────────────
    const statsContainer = document.querySelector('.stats-container');
    if (statsContainer) {
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    anime({
                        targets: '.stat-card',
                        opacity: [0, 1],
                        translateY: [20, 0],
                        delay: anime.stagger(100),
                        duration: 600,
                        easing: 'easeOutQuad',
                        complete: () => {
                            anime({
                                targets: '.stat-count',
                                innerHTML: [0, el => el.getAttribute('data-value')],
                                round: 1,
                                easing: 'easeOutQuart',
                                duration: 1200
                            });
                        }
                    });
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        statsObserver.observe(statsContainer);
    }

    // ── Service cards stagger ────────────────────────────────
    const servicesGrid = document.querySelector('.services-grid');
    if (servicesGrid) {
        const servicesObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    anime({
                        targets: '.service-card',
                        opacity: [0, 1],
                        translateY: [24, 0],
                        delay: anime.stagger(80),
                        easing: 'easeOutQuad',
                        duration: 500
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
