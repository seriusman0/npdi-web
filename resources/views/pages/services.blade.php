@extends('layouts.app')

@section('title', 'Layanan — Nano Project Dev Indonesia')
@section('meta_description', 'Layanan resmi NPDI: pengembangan perangkat lunak, jasa akses internet, gerbang akses jaringan, e-commerce, dan konsultasi IoT.')

@section('content')

<section class="border-b hairline">
    <div class="mx-auto max-w-[1180px] px-5 sm:px-8 pt-14 pb-12 lg:pt-20">
        <p class="eyebrow">Layanan</p>
        <h1 class="display-lg mt-4 max-w-3xl">Lima bidang pekerjaan, satu tim yang sama</h1>
        <p class="mt-4 max-w-2xl text-[15px] leading-relaxed text-muted">
            Setiap layanan di bawah ini adalah kegiatan usaha resmi perusahaan. Lingkup pekerjaan,
            estimasi waktu, dan biaya disepakati tertulis sebelum dimulai.
        </p>
    </div>
</section>

<div class="mx-auto max-w-[1180px] px-5 sm:px-8 py-14 lg:py-16">

    @php
        $services = [
            [
                'kbli'    => '62199',
                'title'   => 'Pengembangan perangkat lunak',
                'sub'     => 'Aktivitas pemrograman komputer lainnya',
                'summary' => 'Perancangan dan pengembangan perangkat lunak yang mengikuti proses bisnis Anda. Cocok untuk sistem internal, dasbor operasional, aplikasi pelanggan, maupun API yang menghubungkan layanan yang sudah ada.',
                'items'   => [
                    'Aplikasi web dan sistem informasi manajemen',
                    'REST API dan integrasi layanan pihak ketiga',
                    'Migrasi sistem lama dan perbaikan performa',
                    'Pemeliharaan dan pembaruan keamanan',
                ],
                'deliverables' => ['Kode sumber penuh', 'Dokumentasi teknis', 'Panduan pengguna'],
                'estimate'     => '4–12 minggu',
            ],
            [
                'kbli'    => '61104',
                'title'   => 'Jasa akses internet',
                'sub'     => 'Aktivitas jasa akses internet',
                'summary' => 'Koneksi internet untuk rumah, usaha, dan institusi di wilayah Kepulauan Nias, termasuk pemasangan perangkat dan dukungan teknis bila terjadi gangguan.',
                'items'   => [
                    'Koneksi dedicated maupun shared',
                    'Bandwidth simetris untuk kebutuhan bisnis',
                    'Pemantauan jaringan dan dukungan teknis',
                    'Pendampingan saat terjadi gangguan',
                ],
                'deliverables' => ['Instalasi perangkat', 'Konfigurasi jaringan', 'Kontak dukungan'],
                'estimate'   => '3–14 hari kerja',
            ],
            [
                'kbli'    => '61107',
                'title'   => 'Gerbang akses jaringan',
                'sub'     => 'Aktivitas jasa gerbang akses internet',
                'summary' => 'Perancangan dan pengelolaan infrastruktur network access point: dari penataan topologi, segmentasi jaringan, aturan firewall, sampai penyeimbangan beban antar jalur.',
                'items'   => [
                    'Instalasi dan konfigurasi perangkat',
                    'Manajemen routing, switching, dan VLAN',
                    'Keamanan jaringan dan aturan firewall',
                    'Optimasi bandwidth dan QoS',
                ],
                'deliverables' => ['Dokumen topologi', 'Konfigurasi tersimpan', 'Prosedur pemulihan'],
                'estimate'   => '1–4 minggu',
            ],
            [
                'kbli'    => '62191',
                'title'   => 'Pengembangan e-commerce',
                'sub'     => 'Pengembangan aplikasi perdagangan melalui internet',
                'summary' => 'Toko daring yang aman dan mudah dikelola, dengan pembayaran lokal, manajemen stok, dan laporan penjualan yang benar-benar dipakai tim operasional.',
                'items'   => [
                    'Katalog produk dan manajemen stok',
                    'Integrasi pembayaran (Xendit, Midtrans)',
                    'Perhitungan ongkos kirim dan pelacakan pesanan',
                    'Dasbor admin dan laporan penjualan',
                ],
                'deliverables' => ['Toko online siap jual', 'Panel admin', 'Panduan operasional'],
                'estimate'   => '3–8 minggu',
            ],
            [
                'kbli'    => '62204',
                'title'   => 'Konsultasi & rancang IoT',
                'sub'     => 'Konsultansi dan perancangan Internet of Things',
                'summary' => 'Perancangan sistem sensor dan konektivitas untuk memantau kondisi nyata — suhu, kelembapan, konsumsi daya, atau status perangkat — lalu menyajikannya dalam dasbor yang bisa dibaca staf non-teknis.',
                'items'   => [
                    'Pemilihan sensor dan perangkat yang sesuai',
                    'Protokol komunikasi dan gerbang data',
                    'Dasbor pemantauan real-time',
                    'Notifikasi otomatis saat nilai di luar batas',
                ],
                'deliverables' => ['Rancangan teknis', 'Prototipe terpasang', 'Dasbor pemantauan'],
                'estimate'   => '4–10 minggu',
            ],
        ];
    @endphp

    <div class="space-y-5">
        @foreach ($services as $service)
            <article class="panel p-6 sm:p-8">
                <div class="grid lg:grid-cols-12 gap-8">
                    <div class="lg:col-span-7">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="tag">KBLI {{ $service['kbli'] }}</span>
                            <span class="text-[12px] text-muted">{{ $service['estimate'] }}</span>
                        </div>

                        <h2 class="mt-3 text-[21px] sm:text-[23px] font-semibold tracking-[-0.025em] text-ink">{{ $service['title'] }}</h2>
                        <p class="mt-1 text-[12.5px] text-muted">{{ $service['sub'] }}</p>
                        <p class="mt-4 text-[14.5px] leading-relaxed text-ink-soft max-w-2xl">{{ $service['summary'] }}</p>

                        <ul class="mt-5 grid sm:grid-cols-2 gap-x-6 gap-y-2">
                            @foreach ($service['items'] as $item)
                                <li class="flex gap-2.5 text-[13.5px] leading-relaxed text-ink-soft">
                                    <svg class="mt-[3px] h-3.5 w-3.5 shrink-0 text-accent" fill="none" stroke="currentColor" stroke-width="2.25" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 12l5 5L20 6"/>
                                    </svg>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="lg:col-span-5 lg:border-l lg:hairline lg:pl-8 flex flex-col">
                        <p class="eyebrow !text-[10px] mb-3">Yang Anda terima</p>
                        <ul class="space-y-2 text-[13.5px] text-ink-soft flex-1">
                            @foreach ($service['deliverables'] as $deliverable)
                                <li class="border-b hairline pb-2 last:border-0">{{ $deliverable }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('contact') }}?layanan={{ urlencode($service['title']) }}"
                           class="btn btn-primary mt-6 w-full !py-2.5 !text-[13px]">
                            Minta penawaran
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    <div class="mt-10 panel p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div>
            <h2 class="text-[19px] font-semibold tracking-tight text-ink">Kebutuhan Anda tidak ada di daftar?</h2>
            <p class="mt-2 text-[14px] text-muted max-w-xl">
                Kirimkan deskripsi singkat masalahnya. Kami akan memberi tahu apakah itu bisa kami
                kerjakan, dan bila tidak, kami arahkan ke pihak yang tepat.
            </p>
        </div>
        <div class="flex flex-wrap gap-3 shrink-0">
            <a href="{{ route('contact') }}" class="btn btn-primary">Hubungi kami</a>
            <a href="{{ route('projects') }}" class="btn btn-ghost">Lihat proyek</a>
        </div>
    </div>

</div>

@endsection
