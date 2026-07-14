@extends('layouts.app')

@section('title', 'Tentang Kami — Nano Project Dev Indonesia')
@section('meta_description', 'Profil perusahaan, visi misi, legalitas, dan profil founder Nano Project Dev Indonesia.')

@section('content')

{{-- Page Header --}}
<section class="bg-gradient-to-br from-blue-700 to-blue-900 text-white py-16 px-4">
    <div class="max-w-5xl mx-auto text-center">
        <h1 class="text-4xl font-bold mb-4">Tentang Kami</h1>
        <p class="text-blue-100 text-lg max-w-2xl mx-auto">Mengenal lebih dekat Nano Project Dev Indonesia — identitas, legalitas, dan visi kami.</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Visi & Misi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <div class="bg-blue-50 rounded-2xl p-8">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center mb-4">
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
        <div class="bg-gray-50 rounded-2xl p-8">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center mb-4">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-3">Misi</h2>
            <ul class="text-gray-700 space-y-2 leading-relaxed">
                <li class="flex gap-2"><span class="text-blue-600 font-bold mt-0.5">·</span> Menghadirkan layanan teknologi berkualitas tinggi yang sesuai kebutuhan bisnis lokal maupun nasional.</li>
                <li class="flex gap-2"><span class="text-blue-600 font-bold mt-0.5">·</span> Membangun infrastruktur jaringan internet yang andal dan terjangkau di daerah terpencil.</li>
                <li class="flex gap-2"><span class="text-blue-600 font-bold mt-0.5">·</span> Mengedepankan transparansi, profesionalisme, dan inovasi dalam setiap proyek.</li>
            </ul>
        </div>
    </div>

    {{-- Founder --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-8 mb-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Profil Founder</h2>
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8">
            <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center shrink-0">
                <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">Seriusman Waruwu</h3>
                <p class="text-blue-600 font-medium mb-3">Founder & Direktur — Nano Project Dev Indonesia</p>
                <p class="text-gray-600 leading-relaxed">
                    Seriusman Waruwu adalah pendiri Nano Project Dev Indonesia, sebuah perusahaan teknologi informasi yang bergerak di bidang pengembangan perangkat lunak, jaringan internet, e-commerce, dan Internet of Things. Dengan semangat memajukan digitalisasi di wilayah Kepulauan Nias, beliau mendirikan perusahaan ini sebagai wujud nyata kontribusi terhadap pembangunan teknologi di daerah.
                </p>
            </div>
        </div>
    </div>

    {{-- Legalitas --}}
    <div class="bg-gradient-to-r from-blue-700 to-blue-900 rounded-2xl p-8 text-white">
        <h2 class="text-2xl font-bold mb-2 text-center">Legalitas Resmi</h2>
        <p class="text-blue-100 text-center text-sm mb-8">Nano Project Dev Indonesia terdaftar dan beroperasi secara sah sesuai hukum Republik Indonesia.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['Bentuk Badan Usaha', 'Perseroan Perorangan (Usaha Mikro)'],
                ['Pendiri', 'Seriusman Waruwu'],
                ['Domisili', 'Lahemo, Gido, Kabupaten Nias, Sumatera Utara'],
                ['Kode KBLI', '62199, 61104, 61107, 62191, 62204'],
                ['Kontak Email', 'admin@mulaisekarang.com'],
                ['Status', 'Aktif & Terdaftar'],
            ] as $item)
            <div class="bg-white/10 rounded-xl p-4">
                <div class="text-blue-200 text-xs font-semibold uppercase tracking-wide mb-1">{{ $item[0] }}</div>
                <div class="text-white font-medium">{{ $item[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection
