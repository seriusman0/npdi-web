@extends('layouts.app')

@section('title', 'Hubungi Kami — Nano Project Dev Indonesia')
@section('meta_description', 'Hubungi Nano Project Dev Indonesia untuk konsultasi pengembangan perangkat lunak, sistem informasi, e-commerce, jaringan, dan IoT.')

@section('content')

<section class="border-b hairline">
    <div class="mx-auto max-w-[1180px] px-5 sm:px-8 pt-14 pb-12 lg:pt-20">
        <p class="eyebrow">Kontak</p>
        <h1 class="display-lg mt-4 max-w-3xl">Ceritakan kebutuhan Anda</h1>
        <p class="mt-4 max-w-2xl text-[15px] leading-relaxed text-muted">
            Isi formulir di bawah atau hubungi kami langsung. Kami membalas maksimal 1 hari kerja,
            dan konsultasi awal tidak dipungut biaya.
        </p>
    </div>
</section>

<div class="mx-auto max-w-[1180px] px-5 sm:px-8 py-14 lg:py-16">
    <div class="grid lg:grid-cols-12 gap-10 lg:gap-14">

        {{-- Form --}}
        <div class="lg:col-span-7">
            <h2 class="text-[17px] font-semibold tracking-tight text-ink mb-5">Formulir pesan</h2>

            @if (session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-lg border border-accent/25 bg-accent-soft px-4 py-3.5 text-[13.5px] text-accent-deep">
                    <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 12l5 5L20 6"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-300 bg-red-50 px-4 py-3.5 text-[13.5px] text-red-800">
                    <p class="font-medium mb-1">Pesan belum bisa dikirim:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="sr-only" aria-hidden="true">
                    <label for="website">Website</label>
                    <input type="text" id="website" name="website" value="" autocomplete="off" tabindex="-1">
                </div>
                <input type="hidden" name="_form_time" id="_form_time" value="">
                <script>document.getElementById('_form_time').value = Math.floor(Date.now() / 1000);</script>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-[13px] font-medium text-ink mb-1.5">Nama lengkap <span class="text-accent">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                               class="w-full rounded-md border hairline bg-white px-3.5 py-2.5 text-[14px] text-ink placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent @error('name') border-red-400 @enderror"
                               placeholder="Nama Anda">
                    </div>
                    <div>
                        <label for="email" class="block text-[13px] font-medium text-ink mb-1.5">Email <span class="text-accent">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                               class="w-full rounded-md border hairline bg-white px-3.5 py-2.5 text-[14px] text-ink placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent @error('email') border-red-400 @enderror"
                               placeholder="nama@perusahaan.com">
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="phone" class="block text-[13px] font-medium text-ink mb-1.5">Nomor telepon <span class="text-muted font-normal">(opsional)</span></label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel"
                               class="w-full rounded-md border hairline bg-white px-3.5 py-2.5 text-[14px] text-ink placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent"
                               placeholder="+62 812 3456 7890">
                    </div>
                    <div>
                        <label for="subject" class="block text-[13px] font-medium text-ink mb-1.5">Subjek <span class="text-accent">*</span></label>
                        <input type="text" id="subject" name="subject" required
                               value="{{ old('subject', request('layanan') ? 'Permintaan penawaran: ' . request('layanan') : '') }}"
                               class="w-full rounded-md border hairline bg-white px-3.5 py-2.5 text-[14px] text-ink placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent @error('subject') border-red-400 @enderror"
                               placeholder="Ringkasan kebutuhan Anda">
                    </div>
                </div>

                <div>
                    <label for="message" class="block text-[13px] font-medium text-ink mb-1.5">Pesan <span class="text-accent">*</span></label>
                    <textarea id="message" name="message" rows="7" required
                              class="w-full rounded-md border hairline bg-white px-3.5 py-2.5 text-[14px] leading-relaxed text-ink placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent resize-y @error('message') border-red-400 @enderror"
                              placeholder="Jelaskan singkat masalah atau kebutuhan Anda, perkiraan waktu, dan bila ada anggaran yang sudah disiapkan.">{{ old('message') }}</textarea>
                </div>

                <div class="flex flex-wrap items-center gap-4 pt-1">
                    <button type="submit" class="btn btn-primary">Kirim pesan</button>
                    <p class="text-[12px] text-muted max-w-sm">
                        Data hanya dipakai untuk membalas pesan Anda. Tidak dibagikan ke pihak lain.
                    </p>
                </div>
            </form>
        </div>

        {{-- Info --}}
        <aside class="lg:col-span-5">
            <div class="panel divide-y hairline">
                <div class="px-5 py-4">
                    <p class="eyebrow !text-[10px]">Email</p>
                    <a href="mailto:{{ config('company.email') }}" class="mt-1.5 block text-[14px] text-ink link-underline">{{ config('company.email') }}</a>
                    <a href="mailto:{{ config('company.sales_email') }}" class="mt-1 block text-[13px] text-muted link-underline">Kerja sama &amp; penawaran — {{ config('company.sales_email') }}</a>
                    <a href="mailto:{{ config('company.support_email') }}" class="mt-1 block text-[13px] text-muted link-underline">Dukungan teknis — {{ config('company.support_email') }}</a>
                </div>
                <div class="px-5 py-4">
                    <p class="eyebrow !text-[10px]">Telepon / WhatsApp</p>
                    <a href="{{ config('company.whatsapp_url') }}" target="_blank" rel="noopener noreferrer" class="mt-1.5 block text-[14px] text-ink link-underline">{{ config('company.phone_display') }}</a>
                </div>
                <div class="px-5 py-4">
                    <p class="eyebrow !text-[10px]">Alamat</p>
                    <p class="mt-1.5 text-[14px] text-ink leading-relaxed">
                        {{ config('company.address.street') }}<br>
                        {{ config('company.address.locality') }}, {{ config('company.address.region') }}<br>
                        Indonesia
                    </p>
                    <a href="https://www.google.com/maps/search/?api=1&query=Lahemo%2C+Gido%2C+Kabupaten+Nias%2C+Sumatera+Utara"
                       target="_blank" rel="noopener noreferrer" class="mt-2 inline-block text-[13px] text-accent hover:text-accent-deep transition-colors">
                        Buka di Google Maps →
                    </a>
                </div>
                <div class="px-5 py-4">
                    <p class="eyebrow !text-[10px]">Jam kerja</p>
                    <p class="mt-1.5 text-[14px] text-ink">Senin–Sabtu, 08.00–21.00 WIB</p>
                    <p class="mt-1 text-[12.5px] text-muted">Pesan di luar jam kerja dibalas hari kerja berikutnya.</p>
                </div>
            </div>

            <div class="mt-5 panel p-5">
                <p class="eyebrow !text-[10px]">Untuk respons lebih cepat</p>
                <p class="mt-2 text-[13.5px] leading-relaxed text-muted">
                    Kirim pesan WhatsApp dengan format: nama, perusahaan, layanan yang dibutuhkan,
                    dan tenggat waktu bila ada.
                </p>
                <a href="{{ config('company.whatsapp_url') }}?text=Halo%20NPDI%2C%20saya%20ingin%20berkonsultasi.%0ANama%3A%20%0APerusahaan%3A%20%0AKebutuhan%3A%20%0ATenggat%3A%20"
                   target="_blank" rel="noopener noreferrer" class="btn btn-accent mt-4 w-full !py-2.5 !text-[13px]">
                    Chat via WhatsApp
                </a>
            </div>
        </aside>

    </div>
</div>

@endsection
