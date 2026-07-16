@extends('layouts.app')

@section('title', 'Tentang Kami — Nano Project Dev Indonesia')
@section('meta_description', 'Profil perusahaan, visi misi, legalitas, dan profil founder Nano Project Dev Indonesia.')

@section('content')

{{-- Page Header --}}
<section class="bg-gradient-to-br from-brand-navy to-brand-navy-dark text-white py-16 px-4">
    <div class="max-w-5xl mx-auto text-center">
        <h1 class="text-4xl font-bold mb-4">Tentang Kami</h1>
        <p class="text-brand-teal-light/90 text-lg max-w-2xl mx-auto">Mengenal lebih dekat Nano Project Dev Indonesia — identitas, legalitas, dan visi kami.</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Visi & Misi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <div class="bg-brand-teal-light/40 rounded-2xl p-8 border border-brand-teal/5">
            <div class="w-10 h-10 bg-brand-teal rounded-xl flex items-center justify-center mb-4">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-3">Visi</h2>
            <p class="text-gray-700 leading-relaxed">
                Menjadi perusahaan teknologi terpercaya yang mendorong transformasi digital di Indonesia, khususnya di wilayah Kepulauan Nias dan Sumatera Utara, melalui solusi inovatif yang terjangkau dan berkelanjutan.
            </p>
        </div>
        <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
            <div class="w-10 h-10 bg-brand-navy rounded-xl flex items-center justify-center mb-4">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-3">Misi</h2>
            <ul class="text-gray-700 space-y-2 leading-relaxed">
                <li class="flex gap-2"><span class="text-brand-teal font-bold mt-0.5">·</span> Menghadirkan layanan teknologi berkualitas tinggi yang sesuai kebutuhan bisnis lokal maupun nasional.</li>
                <li class="flex gap-2"><span class="text-brand-teal font-bold mt-0.5">·</span> Membangun infrastruktur jaringan internet yang andal dan terjangkau di daerah terpencil.</li>
                <li class="flex gap-2"><span class="text-brand-teal font-bold mt-0.5">·</span> Mengedepankan transparansi, profesionalisme, dan inovasi dalam setiap proyek.</li>
            </ul>
        </div>
    </div>

    {{-- Founder --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-8 mb-16 shadow-sm">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Profil Founder</h2>
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8">
            <img src="{{ asset('assets/avatar/founder.png') }}" alt="Seriusman Waruwu, S.Kom" class="w-24 h-24 rounded-full object-cover shrink-0 border-2 border-brand-teal shadow-md">
            <div>
                <h3 class="text-xl font-bold text-gray-900">Seriusman Waruwu, S.Kom</h3>
                <p class="text-brand-teal font-medium mb-2">Founder & Direktur — Nano Project Dev Indonesia</p>
                <div class="flex flex-wrap items-center gap-4 mb-4 text-xs sm:text-sm text-gray-500">
                    <a href="mailto:serius2906@gmail.com" class="hover:text-brand-teal flex items-center gap-1.5 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        serius2906@gmail.com
                    </a>
                    <a href="https://instagram.com/seriusman0" target="_blank" rel="noopener noreferrer" class="hover:text-brand-teal flex items-center gap-1.5 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                        @seriusman0
                    </a>
                </div>
                <p class="text-gray-600 leading-relaxed">
                    Seriusman Waruwu, S.Kom adalah pendiri Nano Project Dev Indonesia, sebuah perusahaan teknologi informasi yang bergerak di bidang pengembangan perangkat lunak, jaringan internet, e-commerce, dan Internet of Things. Dengan semangat memajukan digitalisasi di wilayah Kepulauan Nias, beliau mendirikan perusahaan ini sebagai wujud nyata kontribusi terhadap pembangunan teknologi di daerah.
                </p>
            </div>
        </div>
    </div>

    {{-- Legalitas --}}
    <div class="bg-gradient-to-r from-brand-navy to-brand-navy-dark rounded-2xl p-8 text-white shadow-xl shadow-brand-navy/10">
        <h2 class="text-2xl font-bold mb-2 text-center">Legalitas Resmi</h2>
        <p class="text-brand-teal-light/95 text-center text-sm mb-8">Nano Project Dev Indonesia terdaftar dan beroperasi secara sah sesuai hukum Republik Indonesia.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['Bentuk Badan Usaha', 'Perseroan Perorangan (Usaha Mikro)'],
                ['Pendiri', 'Seriusman Waruwu, S.Kom'],
                ['Domisili', 'Lahemo, Gido, Kabupaten Nias, Sumatera Utara'],
                ['Kode KBLI', '62199, 61104, 61107, 62191, 62204'],
                ['Kontak Email', 'serius2906@gmail.com'],
                ['Status', 'Aktif & Terdaftar'],
            ] as $item)
            <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                <div class="text-brand-teal text-xs font-semibold uppercase tracking-wide mb-1">{{ $item[0] }}</div>
                <div class="text-white font-medium text-sm sm:text-base">{{ $item[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection
