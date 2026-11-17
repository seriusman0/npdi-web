@extends('layouts.app')

@section('title', 'Tentang Kami — Nano Project Dev Indonesia')
@section('meta_description', 'Profil, legalitas, dan cara kerja Nano Project Dev Indonesia — perseroan perorangan di bidang teknologi informasi yang berbasis di Kabupaten Nias, Sumatera Utara.')

@section('content')

<section class="border-b hairline">
    <div class="mx-auto max-w-[1180px] px-5 sm:px-8 pt-14 pb-12 lg:pt-20">
        <p class="eyebrow">Tentang</p>
        <h1 class="display-lg mt-4 max-w-3xl">Perusahaan kecil dengan pekerjaan yang serius</h1>
        <p class="mt-4 max-w-2xl text-[15px] leading-relaxed text-muted">
            Nano Project Dev Indonesia adalah perseroan perorangan yang bergerak di bidang
            teknologi informasi: pengembangan perangkat lunak, jaringan internet, e-commerce,
            dan Internet of Things.
        </p>
    </div>
</section>

<div class="mx-auto max-w-[1180px] px-5 sm:px-8 py-14 lg:py-16">

    <div class="grid lg:grid-cols-12 gap-10 lg:gap-16">
        <div class="lg:col-span-7 space-y-5 text-[15px] leading-relaxed text-ink-soft">
            <p>
                Kami dibentuk dari pekerjaan nyata di lapangan: membangun sistem untuk lembaga
                pendidikan, toko daring, dan usaha lokal di Kepulauan Nias — wilayah yang sering
                terlewat oleh penyedia teknologi besar. Kondisi itu memaksa kami bekerja efisien:
                perangkat sederhana, biaya server yang wajar, dan sistem yang tetap jalan meski
                koneksi tidak selalu stabil.
            </p>
            <p>
                Sampai hari ini kami mengelola beberapa layanan yang berjalan setiap hari, mulai
                dari platform belajar, sistem manajemen pembelajaran, otomasi pesan untuk bisnis,
                hingga aplikasi jurnal sekolah. Semuanya dibangun, dipasang, dan dirawat oleh tim
                yang sama yang akan mengerjakan proyek Anda.
            </p>
            <p>
                Kami tidak menjanjikan hal yang tidak bisa dibuktikan. Ruang lingkup ditulis,
                estimasi diberikan sebelum pekerjaan dimulai, dan hasilnya bisa Anda coba sendiri
                di daftar <a href="{{ route('projects') }}" class="link-underline text-ink">proyek kami</a>.
            </p>
        </div>

        <div class="lg:col-span-5">
            <div class="panel">
                <div class="px-5 py-4 border-b hairline">
                    <p class="eyebrow !text-[10px]">Ringkasan</p>
                </div>
                <dl class="divide-y hairline">
                    @foreach ([
                        ['Nama badan', 'Nano Project Dev Indonesia'],
                        ['Bentuk usaha', 'Perseroan Perorangan (Usaha Mikro)'],
                        ['Pendiri', 'Seriusman Waruwu, S.Kom'],
                        ['Domisili', 'Lahemo, Gido, Kabupaten Nias, Sumatera Utara'],
                        ['Kode KBLI', '62199 · 61104 · 61107 · 62191 · 62204'],
                        ['Status', 'Aktif dan terdaftar'],
                    ] as $row)
                        <div class="px-5 py-3.5 grid grid-cols-3 gap-3">
                            <dt class="text-[12.5px] text-muted">{{ $row[0] }}</dt>
                            <dd class="col-span-2 text-[13.5px] text-ink">{{ $row[1] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </div>

    {{-- Visi & prinsip --}}
    <div class="mt-16 grid md:grid-cols-2 gap-6">
        <div class="panel p-6 sm:p-7">
            <p class="eyebrow !text-[10px]">Arah</p>
            <h2 class="mt-3 text-[18px] font-semibold tracking-tight text-ink">Visi</h2>
            <p class="mt-2 text-[14px] leading-relaxed text-muted">
                Menjadi mitra teknologi yang bisa diandalkan di Indonesia, khususnya di wilayah
                Kepulauan Nias dan Sumatera Utara, dengan solusi yang terjangkau dan berkelanjutan.
            </p>
        </div>
        <div class="panel p-6 sm:p-7">
            <p class="eyebrow !text-[10px]">Praktik</p>
            <h2 class="mt-3 text-[18px] font-semibold tracking-tight text-ink">Prinsip kerja</h2>
            <ul class="mt-2 space-y-2 text-[14px] leading-relaxed text-muted">
                <li class="flex gap-2.5"><span class="mt-[9px] h-1 w-1 shrink-0 rounded-full bg-accent"></span>Lingkup dan harga disepakati tertulis sebelum pekerjaan dimulai.</li>
                <li class="flex gap-2.5"><span class="mt-[9px] h-1 w-1 shrink-0 rounded-full bg-accent"></span>Kode, domain, dan server diserahkan atas nama pemilik proyek.</li>
                <li class="flex gap-2.5"><span class="mt-[9px] h-1 w-1 shrink-0 rounded-full bg-accent"></span>Transparan soal batasan: bila sesuatu tidak layak dibangun, kami katakan.</li>
            </ul>
        </div>
    </div>

    {{-- Founder --}}
    <div class="mt-6 panel p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row gap-6 sm:gap-8 items-start">
            <img src="{{ asset('assets/avatar/founder.png') }}" alt="Seriusman Waruwu, S.Kom"
                 class="h-20 w-20 rounded-lg object-cover border hairline shrink-0" loading="lazy">

            <div class="min-w-0">
                <p class="eyebrow !text-[10px]">Penanggung jawab</p>
                <h2 class="mt-2 text-[19px] font-semibold tracking-tight text-ink">Seriusman Waruwu, S.Kom</h2>
                <p class="mt-1 text-[13.5px] text-muted">Pendiri &amp; engineer utama</p>
                <p class="mt-3 max-w-2xl text-[14px] leading-relaxed text-ink-soft">
                    Menangani langsung arsitektur, pengembangan, dan operasi server untuk seluruh
                    proyek perusahaan. Latar belakang informatika, dengan pengalaman membangun
                    sistem produksi di lingkungan dengan infrastruktur terbatas.
                </p>

                <div class="mt-4 flex flex-wrap items-center gap-x-5 gap-y-2 text-[13px]">
                    <a href="mailto:{{ config('company.email') }}" class="link-underline text-ink">{{ config('company.email') }}</a>
                    <a href="{{ config('company.whatsapp_url') }}" target="_blank" rel="noopener noreferrer" class="link-underline text-ink">{{ config('company.phone_display') }}</a>
                    <a href="{{ config('company.instagram') }}" target="_blank" rel="noopener noreferrer" class="link-underline text-ink">@seriusman0</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
