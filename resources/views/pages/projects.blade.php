@extends('layouts.app')

@section('title', 'Proyek — Nano Project Dev Indonesia')
@section('meta_description', 'Proyek yang kami bangun dan rawat: platform belajar online, sistem manajemen pembelajaran, SaaS otomasi pesan, dan aplikasi jurnal sekolah.')

@section('content')

<section class="border-b hairline">
    <div class="mx-auto max-w-[1180px] px-5 sm:px-8 pt-14 pb-12 lg:pt-20">
        <p class="eyebrow">Proyek</p>
        <h1 class="display-lg mt-4 max-w-3xl">Sistem yang kami bangun dan rawat sendiri</h1>
        <p class="mt-4 max-w-2xl text-[15px] leading-relaxed text-muted">
            Kami hanya menampilkan pekerjaan yang benar-benar berjalan di produksi dan bisa Anda
            kunjungi. Setiap proyek mencakup pengembangan, deployment, dan pemeliharaan server.
        </p>
    </div>
</section>

<div class="mx-auto max-w-[1180px] px-5 sm:px-8 py-14 lg:py-16 space-y-6">
    @foreach ($projects as $project)
        <article class="panel p-6 sm:p-8">
            <div class="grid lg:grid-cols-12 gap-8">
                <div class="lg:col-span-7">
                    <div class="flex flex-wrap items-center gap-3">
                        <p class="eyebrow !text-[10px]">{{ $project['category'] }}</p>
                        <span class="tag">Produksi</span>
                    </div>
                    <h2 class="mt-3 text-[22px] sm:text-[24px] font-semibold tracking-[-0.025em] text-ink">{{ $project['name'] }}</h2>
                    <p class="mt-3 text-[14.5px] leading-relaxed text-muted max-w-2xl">{{ $project['summary'] }}</p>

                    <div class="mt-5 flex flex-wrap gap-1.5">
                        @foreach ($project['stack'] as $tech)
                            <span class="tag">{{ $tech }}</span>
                        @endforeach
                    </div>

                    <a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer"
                       class="mt-6 inline-flex items-center gap-1.5 text-[13.5px] font-medium text-accent hover:text-accent-deep transition-colors">
                        Buka {{ parse_url($project['url'], PHP_URL_HOST) }}
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M9 7h8v8"/>
                        </svg>
                    </a>
                </div>

                <div class="lg:col-span-5 lg:border-l lg:hairline lg:pl-8">
                    <p class="eyebrow !text-[10px] mb-3">Lingkup pekerjaan</p>
                    <ul class="space-y-2">
                        @foreach ($project['scope'] as $item)
                            <li class="flex gap-2.5 text-[13.5px] leading-relaxed text-ink-soft">
                                <svg class="mt-[3px] h-3.5 w-3.5 shrink-0 text-accent" fill="none" stroke="currentColor" stroke-width="2.25" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 12l5 5L20 6"/>
                                </svg>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </article>
    @endforeach
</div>

<section class="mx-auto max-w-[1180px] px-5 sm:px-8 pb-6">
    <div class="rounded-xl border hairline bg-white px-6 py-10 sm:px-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div>
            <h2 class="text-[20px] font-semibold tracking-tight text-ink">Ingin proyek Anda menjadi yang berikutnya?</h2>
            <p class="mt-2 text-[14px] text-muted">Ceritakan kebutuhan Anda lewat formulir atau WhatsApp. Kami balas maksimal 1 hari kerja.</p>
        </div>
        <div class="flex flex-wrap gap-3 shrink-0">
            <a href="{{ route('contact') }}" class="btn btn-primary">Mulai diskusi</a>
            <a href="{{ route('services') }}" class="btn btn-ghost">Lihat layanan</a>
        </div>
    </div>
</section>

@endsection
