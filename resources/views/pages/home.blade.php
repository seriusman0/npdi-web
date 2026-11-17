@extends('layouts.app')

@section('title', 'Nano Project Dev Indonesia — Pengembangan perangkat lunak & sistem bisnis')
@section('meta_description', 'Studio pengembangan perangkat lunak di Nias, Sumatera Utara. Kami membangun dan merawat aplikasi web, platform belajar, e-commerce, otomasi, dan infrastruktur jaringan untuk perusahaan dan lembaga.')

@section('content')

{{-- ── Hero ─────────────────────────────────────────────── --}}
<section class="border-b hairline">
    <div class="mx-auto max-w-[1180px] px-5 sm:px-8 pt-16 pb-16 lg:pt-24 lg:pb-20">
        <div class="grid lg:grid-cols-12 gap-10 lg:gap-16 items-start">
            <div class="lg:col-span-7">
                <p class="eyebrow rise">Studio pengembangan perangkat lunak · Nias, Sumatera Utara</p>

                <h1 class="display-xl mt-5 rise rise-2">
                    Kami membangun sistem yang dipakai bisnis setiap hari.
                </h1>

                <p class="mt-6 max-w-xl text-[15.5px] leading-relaxed text-muted rise rise-3">
                    Nano Project Dev Indonesia merancang, membangun, dan merawat aplikasi web,
                    platform pembelajaran, e-commerce, serta infrastruktur jaringan. Pekerjaan
                    kami berjalan di produksi — bukan sekadar konsep di presentasi.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-3 rise rise-4">
                    <a href="{{ route('contact') }}" class="btn btn-primary">
                        Diskusikan proyek
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </a>
                    <a href="{{ route('projects') }}" class="btn btn-ghost">Lihat proyek kami</a>
                </div>

                <p class="mt-6 text-[12.5px] text-muted">
                    Konsultasi awal tanpa biaya · Dikerjakan langsung oleh engineer, bukan perantara.
                </p>
            </div>

            {{-- Fact sheet --}}
            <div class="lg:col-span-5 lg:pl-10 lg:border-l lg:hairline">
                <div class="panel divide-y hairline">
                    @foreach ([
                        ['Badan usaha', 'Perseroan Perorangan, terdaftar & aktif'],
                        ['Bidang usaha', 'KBLI 62199 · 61104 · 61107 · 62191 · 62204'],
                        ['Fokus teknis', 'Laravel, Node.js, Vue/React, MySQL, Redis'],
                        ['Cara kerja', 'Remote untuk seluruh Indonesia, on-site untuk Nias & sekitarnya'],
                        ['Respons awal', 'Maksimal 1 hari kerja'],
                    ] as $fact)
                        <div class="px-5 py-4">
                            <dt class="eyebrow !text-[10px]">{{ $fact[0] }}</dt>
                            <dd class="mt-1.5 text-[13.5px] leading-snug text-ink-soft">{{ $fact[1] }}</dd>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Proyek ───────────────────────────────────────────── --}}
<section class="mx-auto max-w-[1180px] px-5 sm:px-8 py-16 lg:py-20">
    <div class="flex flex-wrap items-end justify-between gap-6 mb-10">
        <div class="max-w-2xl">
            <p class="eyebrow">01 — Proyek</p>
            <h2 class="display-lg mt-3">Sistem yang sudah berjalan di produksi</h2>
            <p class="mt-3 text-[15px] text-muted">
                Produk dan sistem internal perusahaan yang kami bangun, deployed, dan rawat sendiri —
                dari pengembangan sampai pemeliharaan harian.
            </p>
        </div>
        <a href="{{ route('projects') }}" class="link-underline text-[13.5px] font-medium text-ink">
            Semua proyek →
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-px bg-[rgba(10,21,38,0.12)] border hairline rounded-lg overflow-hidden">
        @foreach ($projects as $project)
            <article class="bg-white p-6 sm:p-7 flex flex-col">
                <div class="flex items-start justify-between gap-4">
                    <p class="eyebrow !text-[10px]">{{ $project['category'] }}</p>
                    <span class="tag">Produksi</span>
                </div>

                <h3 class="mt-3 text-[19px] font-semibold tracking-tight text-ink">{{ $project['name'] }}</h3>
                <p class="mt-2 text-[14px] leading-relaxed text-muted">{{ $project['summary'] }}</p>

                <ul class="mt-4 space-y-1.5 text-[13px] text-ink-soft flex-1">
                    @foreach (array_slice($project['scope'], 0, 3) as $item)
                        <li class="flex gap-2">
                            <span class="mt-[7px] h-1 w-1 shrink-0 rounded-full bg-accent"></span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-5 pt-4 border-t hairline flex flex-wrap items-center justify-between gap-3">
                    <div class="flex flex-wrap gap-1.5">
                        @foreach (array_slice($project['stack'], 0, 3) as $tech)
                            <span class="tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                    <a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer"
                       class="text-[13px] font-medium text-accent hover:text-accent-deep transition-colors inline-flex items-center gap-1">
                        Kunjungi situs
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M9 7h8v8"/>
                        </svg>
                    </a>
                </div>
            </article>
        @endforeach
    </div>
</section>

{{-- ── Layanan ──────────────────────────────────────────── --}}
<section class="border-y hairline bg-white">
    <div class="mx-auto max-w-[1180px] px-5 sm:px-8 py-16 lg:py-20">
        <div class="max-w-2xl mb-10">
            <p class="eyebrow">02 — Layanan</p>
            <h2 class="display-lg mt-3">Yang kami kerjakan</h2>
            <p class="mt-3 text-[15px] text-muted">
                Lima bidang usaha resmi kami, diterjemahkan menjadi pekerjaan yang bisa dipesan
                dengan lingkup dan estimasi yang jelas.
            </p>
        </div>

        @php
            $services = [
                ['62199', 'Pengembangan perangkat lunak', 'Aplikasi web, sistem informasi, dasbor operasional, dan API. Mulai dari pemetaan proses sampai rilis dan pemeliharaan.', 'Laravel · Vue · React · PostgreSQL/MySQL'],
                ['61104', 'Jasa akses internet', 'Koneksi internet untuk rumah, usaha, dan institusi di wilayah Kepulauan Nias beserta dukungan teknisnya.', 'Instalasi · Monitoring · Dukungan'],
                ['61107', 'Gerbang akses jaringan', 'Perancangan dan pengelolaan network access point: routing, segmentasi, firewall, dan optimasi bandwidth.', 'Mikrotik · VLAN · QoS · Firewall'],
                ['62191', 'Pengembangan e-commerce', 'Toko daring dan marketplace dengan pembayaran lokal, manajemen stok, serta laporan penjualan.', 'Xendit · Midtrans · Integrasi logistik'],
                ['62204', 'Konsultasi & rancang IoT', 'Perancangan sensor, konektivitas, dan dasbor monitoring untuk otomasi dan efisiensi operasional.', 'MQTT · Sensor · Dasbor real-time'],
            ];
        @endphp

        <div class="border-t hairline">
            @foreach ($services as $i => $service)
                <div class="grid md:grid-cols-12 gap-3 md:gap-6 py-6 border-b hairline">
                    <div class="md:col-span-1 font-mono text-[12px] text-muted pt-0.5">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="md:col-span-4">
                        <h3 class="text-[16.5px] font-semibold tracking-tight text-ink">{{ $service[1] }}</h3>
                        <p class="mt-1 font-mono text-[10.5px] uppercase tracking-[0.12em] text-muted">KBLI {{ $service[0] }}</p>
                    </div>
                    <p class="md:col-span-4 text-[14px] leading-relaxed text-muted">{{ $service[2] }}</p>
                    <div class="md:col-span-3 md:text-right">
                        <p class="text-[12.5px] text-ink-soft">{{ $service[3] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex flex-wrap items-center gap-4">
            <a href="{{ route('services') }}" class="btn btn-primary !py-2.5 !text-[13px]">Detail layanan</a>
            <a href="{{ route('contact') }}" class="link-underline text-[13.5px] font-medium text-ink">Minta penawaran →</a>
        </div>
    </div>
</section>

{{-- ── Proses ───────────────────────────────────────────── --}}
<section class="mx-auto max-w-[1180px] px-5 sm:px-8 py-16 lg:py-20">
    <div class="max-w-2xl mb-10">
        <p class="eyebrow">03 — Proses</p>
        <h2 class="display-lg mt-3">Cara kami mengerjakan proyek</h2>
        <p class="mt-3 text-[15px] text-muted">
            Empat tahap yang sama untuk setiap proyek, dengan hasil yang bisa diperiksa di setiap akhir tahap.
        </p>
    </div>

    <ol class="grid sm:grid-cols-2 lg:grid-cols-4 gap-px bg-[rgba(10,21,38,0.12)] border hairline rounded-lg overflow-hidden">
        @foreach ([
            ['01', 'Diskusi & pemetaan', 'Kami pelajari proses bisnis Anda, tentukan ruang lingkup, prioritas, dan batas pekerjaan secara tertulis.'],
            ['02', 'Rancangan & estimasi', 'Alur layar, struktur data, dan rencana teknis disusun sebelum baris kode pertama ditulis — beserta estimasi waktu dan biaya.'],
            ['03', 'Pengembangan & uji', 'Pengerjaan bertahap dengan demo rutin. Setiap fitur diuji sebelum masuk ke lingkungan produksi.'],
            ['04', 'Rilis & pendampingan', 'Deploy, pelatihan pengguna, dokumentasi, dan masa pendampingan setelah sistem dipakai.'],
        ] as [$num, $title, $desc])
            <li class="bg-white p-6">
                <p class="font-mono text-[11px] tracking-[0.12em] text-accent">{{ $num }}</p>
                <h3 class="mt-3 text-[15.5px] font-semibold tracking-tight text-ink">{{ $title }}</h3>
                <p class="mt-2 text-[13.5px] leading-relaxed text-muted">{{ $desc }}</p>
            </li>
        @endforeach
    </ol>

    <div class="mt-10 grid sm:grid-cols-3 gap-6">
        @foreach ([
            ['Kode dan aset menjadi milik Anda', 'Repositori, domain, dan server diserahkan atas nama perusahaan Anda saat proyek selesai.'],
            ['Dokumentasi serah terima', 'Alur kerja, konfigurasi server, dan panduan operasional ditulis agar sistem tidak bergantung pada satu orang.'],
            ['Dukungan setelah rilis', 'Pemeliharaan, pembaruan keamanan, dan perbaikan bug tetap tersedia setelah proyek dianggap selesai.'],
        ] as $value)
            <div class="flex gap-3">
                <svg class="mt-0.5 h-4 w-4 shrink-0 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 12l5 5L20 6"/>
                </svg>
                <div>
                    <p class="text-[14px] font-semibold text-ink">{{ $value[0] }}</p>
                    <p class="mt-1 text-[13.5px] leading-relaxed text-muted">{{ $value[1] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- ── CTA ──────────────────────────────────────────────── --}}
<section class="mx-auto max-w-[1180px] px-5 sm:px-8 pb-4">
    <div class="rounded-xl bg-ink px-7 py-12 sm:px-12 sm:py-14">
        <div class="grid lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8">
                <h2 class="text-[26px] sm:text-[32px] font-semibold tracking-[-0.03em] leading-tight text-white">
                    Ada sistem yang perlu dibangun atau diperbaiki?
                </h2>
                <p class="mt-3 max-w-xl text-[14.5px] leading-relaxed text-white/60">
                    Ceritakan kebutuhan Anda. Kami akan memberi pendapat jujur soal kelayakan,
                    perkiraan biaya, dan waktu pengerjaan — sebelum ada komitmen.
                </p>
            </div>
            <div class="lg:col-span-4 flex flex-wrap gap-3 lg:justify-end">
                <a href="{{ route('contact') }}" class="btn btn-accent">Hubungi kami</a>
                <a href="{{ config('company.whatsapp_url') }}?text=Halo%20NPDI%2C%20saya%20ingin%20mendiskusikan%20sebuah%20proyek."
                   target="_blank" rel="noopener noreferrer"
                   class="btn !text-white border border-white/25 hover:bg-white/10">WhatsApp</a>
            </div>
        </div>
    </div>
</section>

@endsection
