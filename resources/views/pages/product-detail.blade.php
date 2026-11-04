@extends('layouts.app')

@section('title', $product['name'] . ' — ' . $product['tagline'] . ' | NPDI')
@section('meta_description', $product['description'])

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br {{ $product['color'] }} text-white py-20 px-4">
    <div class="max-w-5xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('products.index') }}" class="text-white/70 hover:text-white text-sm transition">← Kembali ke Produk</a>
        </div>
        <div class="flex flex-col lg:flex-row items-start lg:items-center gap-8">
            <div class="flex-1">
                <span class="inline-block bg-white/20 text-white text-xs font-medium px-3 py-1 rounded-full mb-4">{{ $product['badge'] }}</span>
                <h1 class="text-4xl sm:text-5xl font-bold mb-4">{{ $product['name'] }}</h1>
                <p class="text-white/85 text-xl mb-6 leading-relaxed max-w-2xl">{{ $product['tagline'] }}</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ $product['url'] }}" target="_blank" rel="noopener noreferrer"
                       class="bg-white/20 hover:bg-white/30 text-white font-semibold px-5 py-2.5 rounded-xl transition text-sm">
                        Lihat Demo Live →
                    </a>
                    <a href="#pricing" class="bg-white text-gray-900 font-semibold px-5 py-2.5 rounded-xl hover:bg-gray-50 transition text-sm">
                        Lihat Harga
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Description + Features --}}
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Apa itu {{ $product['name'] }}?</h2>
            <p class="text-gray-600 leading-relaxed text-lg">{{ $product['description'] }}</p>
            <p class="text-gray-600 leading-relaxed mt-4">
                Dibangun oleh tim <strong>Nano Project Dev Indonesia</strong>, {{ $product['name'] }} adalah platform SaaS yang bisa langsung digunakan tanpa instalasi. Cukup daftar, pilih paket, dan mulai kelola bisnis WhatsApp Anda dalam hitungan menit.
            </p>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Fitur Lengkap</h2>
            <ul class="space-y-3">
                @foreach($product['features'] as $feature)
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="text-gray-700">{{ $feature }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

{{-- Pricing --}}
<section id="pricing" class="bg-gray-50 py-20 px-4">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Pilih Paket yang Tepat</h2>
            <p class="text-gray-500 text-lg">Semua paket termasuk akses penuh ke dashboard. Bayar bulanan, batalkan kapan saja.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($product['plans'] as $plan)
            <div class="bg-white rounded-2xl border-2 {{ $plan['color'] }} p-6 flex flex-col relative">
                @if($plan['popular'])
                <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                    <span class="bg-brand-teal text-brand-navy text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">Paling Populer</span>
                </div>
                @endif

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $plan['name'] }}</h3>
                    <div class="flex items-end gap-1">
                        <span class="text-3xl font-bold text-gray-900">Rp {{ number_format($plan['price'], 0, ',', '.') }}</span>
                    </div>
                    <p class="text-gray-500 text-sm">per {{ $plan['period'] }}</p>
                </div>

                <ul class="space-y-3 mb-8 flex-1 text-sm">
                    <li class="flex items-center gap-2 text-gray-700">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ $plan['devices'] }} WA Device
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ $plan['broadcasts'] }} Broadcast/bln
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ $plan['contacts'] }} Kontak
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ $plan['members'] }} Anggota Tim
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Semua Fitur Inti
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Support via WhatsApp
                    </li>
                </ul>

                <a href="{{ route('checkout', [$product['slug'], $plan['slug']]) }}"
                   class="{{ $plan['button_color'] }} {{ str_contains($plan['button_color'], 'brand-teal') ? '' : 'text-white' }} font-semibold py-2.5 px-4 rounded-xl text-center text-sm transition block w-full">
                    Berlangganan Sekarang
                </a>
            </div>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <p class="text-gray-500 text-sm">Semua pembayaran aman diproses melalui <strong>Xendit</strong>. Tersedia transfer bank, virtual account, QRIS, dan kartu kredit.</p>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-20" x-data="{ open: null }">
    <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Pertanyaan Umum</h2>
    @foreach([
        ['q' => 'Apakah ada free trial?', 'a' => 'NanoHub menyediakan paket Free dengan fitur terbatas untuk mencoba platform. Daftar langsung di nanohub.nanoprojectdevindonesia.com untuk mulai trial.'],
        ['q' => 'Apakah bisa ganti paket kapan saja?', 'a' => 'Ya, Anda bisa upgrade atau downgrade paket kapan saja. Perubahan berlaku di siklus billing berikutnya.'],
        ['q' => 'Bagaimana cara membayar?', 'a' => 'Pembayaran diproses melalui Xendit. Tersedia metode transfer bank, virtual account BCA/BNI/Mandiri/BRI, QRIS, OVO, GoPay, ShopeePay, dan kartu kredit/debit.'],
        ['q' => 'Apakah nomor WhatsApp saya aman?', 'a' => 'NanoHub menggunakan strategi anti-banned: delay random antar pesan, validasi nomor sebelum kirim, dan auto-retry cerdas. Namun penggunaan tetap harus mematuhi syarat layanan WhatsApp.'],
        ['q' => 'Apa yang terjadi setelah bayar?', 'a' => 'Setelah pembayaran dikonfirmasi, akun NanoHub Anda akan diaktivasi dan Anda menerima email konfirmasi dengan detail akses.'],
    ] as $i => $faq)
    <div class="border-b border-gray-100 py-4">
        <button @click="open = open === {{ $i }} ? null : {{ $i }}"
                class="w-full flex items-center justify-between text-left text-gray-900 font-semibold py-3 min-h-[44px]">
            {{ $faq['q'] }}
            <svg :class="open === {{ $i }} ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 transition-transform flex-shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
        <div x-show="open === {{ $i }}" x-transition class="mt-2 text-gray-600 text-sm leading-relaxed">
            {{ $faq['a'] }}
        </div>
    </div>
    @endforeach
</section>

{{-- CTA Bottom --}}
<section class="bg-gradient-to-br {{ $product['color'] }} text-white py-16 px-4">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Mulai?</h2>
        <p class="text-white/80 mb-8 text-lg">Ribuan bisnis percayakan otomasi WhatsApp mereka ke NanoHub. Giliran Anda.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#pricing" class="bg-white text-gray-900 font-bold px-8 py-3 rounded-xl hover:bg-gray-50 transition">
                Pilih Paket
            </a>
            <a href="{{ $product['url'] }}" target="_blank" rel="noopener noreferrer"
               class="border-2 border-white text-white font-semibold px-8 py-3 rounded-xl hover:bg-white/10 transition">
                Coba Demo Gratis
            </a>
        </div>
    </div>
</section>

@endsection
