@extends('layouts.app')

@section('title', 'Tentang Kami — Nano Project Dev Indonesia')
@section('meta_description', 'Profil perusahaan, visi misi, legalitas, dan profil founder Nano Project Dev Indonesia.')

@section('content')

{{-- Page Header --}}
<section class="relative overflow-hidden bg-gradient-to-br from-[#F7F8FA] to-[#EEF1F6] py-20 px-4 border-b border-black/5">
    <div class="absolute -top-24 -right-24 w-72 h-72 bg-[#00A8AD]/6 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-5xl mx-auto text-center relative z-10">
        <span class="inline-block text-xs font-display font-semibold uppercase tracking-widest text-[#006b6e] bg-[#E3F6F7] px-3 py-1 rounded-full mb-4">Profil Perusahaan</span>
        <h1 class="font-display font-extrabold text-4xl sm:text-5xl text-[#071638] tracking-tight mb-4">Tentang Kami</h1>
        <p class="font-serif italic text-[#6B7280] text-lg max-w-2xl mx-auto leading-relaxed">
            Mengenal lebih dekat Nano Project Dev Indonesia — identitas, legalitas, dan visi kami.
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Visi & Misi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-16">
        <div class="card-soft p-8">
            <div class="w-10 h-10 bg-[#E3F6F7] rounded-xl flex items-center justify-center mb-5">
                <svg class="w-5 h-5 text-[#00A8AD]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
            <h2 class="font-display font-bold text-xl text-[#071638] mb-3">Visi</h2>
            <p class="text-[#6B7280] leading-relaxed text-sm">
                Menjadi perusahaan teknologi terpercaya yang mendorong transformasi digital di Indonesia, khususnya di wilayah Kepulauan Nias dan Sumatera Utara, melalui solusi inovatif yang terjangkau dan berkelanjutan.
            </p>
        </div>
        <div class="card-soft p-8">
            <div class="w-10 h-10 bg-[#071638]/8 rounded-xl flex items-center justify-center mb-5">
                <svg class="w-5 h-5 text-[#071638]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h2 class="font-display font-bold text-xl text-[#071638] mb-3">Misi</h2>
            <ul class="text-[#6B7280] space-y-2.5 text-sm leading-relaxed">
                <li class="flex gap-2.5">
                    <span class="text-[#00A8AD] font-bold mt-0.5 flex-shrink-0">·</span>
                    Menghadirkan layanan teknologi berkualitas tinggi yang sesuai kebutuhan bisnis lokal maupun nasional.
                </li>
                <li class="flex gap-2.5">
                    <span class="text-[#00A8AD] font-bold mt-0.5 flex-shrink-0">·</span>
                    Membangun infrastruktur jaringan internet yang andal dan terjangkau di daerah terpencil.
                </li>
                <li class="flex gap-2.5">
                    <span class="text-[#00A8AD] font-bold mt-0.5 flex-shrink-0">·</span>
                    Mengedepankan transparansi, profesionalisme, dan inovasi dalam setiap proyek.
                </li>
            </ul>
        </div>
    </div>

    {{-- Founder --}}
    <div class="card-soft p-8 mb-16">
        <h2 class="font-display font-bold text-2xl text-[#071638] mb-8 text-center tracking-tight">Profil Founder</h2>
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8">
            <img src="{{ asset('assets/avatar/founder.png') }}" alt="Seriusman Waruwu, S.Kom"
                 class="w-24 h-24 rounded-2xl object-cover shrink-0 border border-black/5 shadow-md">
            <div>
                <h3 class="font-display font-bold text-xl text-[#071638]">Seriusman Waruwu, S.Kom</h3>
                <p class="font-serif italic text-[#006b6e] text-sm mb-3">Founder & Direktur — Nano Project Dev Indonesia</p>
                <div class="flex flex-wrap items-center gap-4 mb-4 text-xs text-[#6B7280]">
                    <a href="mailto:serius2906@gmail.com" class="hover:text-[#00A8AD] flex items-center gap-1.5 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        serius2906@gmail.com
                    </a>
                    <a href="https://instagram.com/seriusman0" target="_blank" rel="noopener noreferrer" class="hover:text-[#00A8AD] flex items-center gap-1.5 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                        @seriusman0
                    </a>
                </div>
                <p class="text-[#6B7280] leading-relaxed text-sm">
                    Seriusman Waruwu, S.Kom adalah pendiri Nano Project Dev Indonesia, perusahaan teknologi yang bergerak di bidang pengembangan perangkat lunak, jaringan internet, e-commerce, dan Internet of Things. Dengan semangat memajukan digitalisasi di Kepulauan Nias, beliau mendirikan perusahaan ini sebagai wujud nyata kontribusi teknologi di daerah.
                </p>
            </div>
        </div>
    </div>

    {{-- Legalitas --}}
    <div class="bg-gradient-to-br from-[#071638] to-[#040d21] rounded-3xl p-8 sm:p-10 shadow-elevated">
        <h2 class="font-display font-bold text-2xl text-white mb-2 text-center tracking-tight">Legalitas Resmi</h2>
        <p class="font-serif italic text-white/50 text-center text-sm mb-10">
            Nano Project Dev Indonesia terdaftar dan beroperasi secara sah sesuai hukum Republik Indonesia.
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach([
                ['Bentuk Badan Usaha', 'Perseroan Perorangan (Usaha Mikro)'],
                ['Pendiri', 'Seriusman Waruwu, S.Kom'],
                ['Domisili', 'Lahemo, Gido, Kabupaten Nias, Sumatera Utara'],
                ['Kode KBLI', '62199, 61104, 61107, 62191, 62204'],
                ['Kontak Email', 'serius2906@gmail.com'],
                ['Status', 'Aktif & Terdaftar'],
            ] as $item)
            <div class="bg-white/5 border border-white/8 rounded-2xl p-5">
                <div class="text-[#00A8AD] text-[10px] font-display font-semibold uppercase tracking-widest mb-2">{{ $item[0] }}</div>
                <div class="text-white font-medium text-sm">{{ $item[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection
