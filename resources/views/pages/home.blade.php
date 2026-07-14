@extends('layouts.app')

@section('title', 'Nano Project Dev Indonesia — Solusi Teknologi untuk Bisnis Anda')
@section('meta_description', 'Nano Project Dev Indonesia menyediakan layanan custom software, ISP, IoT, e-commerce, dan network access point. Berbasis di Nias, Sumatera Utara.')

@section('content')

{{-- Hero Section --}}
<section class="bg-gradient-to-br from-blue-700 to-blue-900 text-white py-24 px-4">
    <div class="max-w-5xl mx-auto text-center">
        <span class="inline-block bg-blue-500/30 text-blue-100 text-sm font-medium px-3 py-1 rounded-full mb-4">Perseroan Perorangan Terdaftar · Kab. Nias, Sumatera Utara</span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
            Solusi Teknologi<br>untuk Bisnis Modern
        </h1>
        <p class="text-blue-100 text-lg sm:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
            Nano Project Dev Indonesia menghadirkan layanan pemrograman, jaringan internet, pengembangan e-commerce, dan konsultasi IoT yang profesional dan terpercaya.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" class="bg-white text-blue-700 font-semibold px-8 py-3 rounded-xl hover:bg-blue-50 transition text-base">
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
            Perusahaan teknologi yang didirikan oleh <strong>Seriusman Waruwu</strong>, berbasis di Lahemo, Gido, Kabupaten Nias, Sumatera Utara. Kami berkomitmen menghadirkan solusi digital yang inovatif dan terpercaya bagi klien di seluruh Indonesia.
        </p>
        <a href="{{ route('about') }}" class="inline-block mt-4 text-blue-600 font-semibold hover:underline">Pelajari Lebih Lanjut →</a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach([
            ['5', 'Bidang Layanan KBLI'],
            ['1', 'Perseroan Terdaftar'],
            ['100%', 'Legalitas Terjamin'],
            ['24/7', 'Siap Konsultasi'],
        ] as $stat)
        <div class="bg-blue-50 rounded-2xl p-6 text-center">
            <div class="text-3xl font-bold text-blue-700 mb-1">{{ $stat[0] }}</div>
            <div class="text-sm text-gray-600">{{ $stat[1] }}</div>
        </div>
        @endforeach
    </div>
</section>

{{-- Services Grid --}}
<section class="bg-gray-50 py-16 px-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Lima Pilar Layanan Kami</h2>
            <p class="text-gray-600 max-w-xl mx-auto">Kegiatan usaha bersertifikat sesuai KBLI yang kami tawarkan untuk kebutuhan teknologi bisnis Anda.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['62199', 'Custom Software Development', 'Pengembangan aplikasi dan sistem perangkat lunak sesuai kebutuhan spesifik bisnis Anda.', 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
                ['61104', 'Internet Service Provider', 'Layanan akses internet yang andal dan berkecepatan tinggi untuk rumah, bisnis, dan institusi.', 'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0'],
                ['61107', 'Network Access Point', 'Infrastruktur gerbang akses internet dan manajemen jaringan untuk konektivitas optimal.', 'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01'],
                ['62191', 'E-Commerce Development', 'Pembuatan platform perdagangan elektronik yang aman, skalabel, dan mudah dikelola.', 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
                ['62204', 'IoT Consulting & Design', 'Konsultasi dan perancangan sistem Internet of Things untuk efisiensi operasional dan otomatisasi.', 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18'],
            ] as $service)
            <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $service[3] }}"/>
                    </svg>
                </div>
                <span class="text-xs font-mono text-blue-500 bg-blue-50 px-2 py-0.5 rounded">KBLI {{ $service[0] }}</span>
                <h3 class="text-lg font-semibold text-gray-900 mt-2 mb-2">{{ $service[1] }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $service[2] }}</p>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('services') }}" class="inline-block bg-blue-600 text-white font-semibold px-8 py-3 rounded-xl hover:bg-blue-700 transition">
                Lihat Detail Layanan
            </a>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
    <div class="bg-blue-700 rounded-3xl py-16 px-8">
        <h2 class="text-3xl font-bold text-white mb-4">Siap Memulai Proyek Anda?</h2>
        <p class="text-blue-100 mb-8 max-w-xl mx-auto">Konsultasikan kebutuhan teknologi bisnis Anda bersama kami. Gratis, tanpa komitmen.</p>
        <a href="{{ route('contact') }}" class="bg-white text-blue-700 font-semibold px-8 py-3 rounded-xl hover:bg-blue-50 transition inline-block">
            Mulai Konsultasi Gratis
        </a>
    </div>
</section>

@endsection
