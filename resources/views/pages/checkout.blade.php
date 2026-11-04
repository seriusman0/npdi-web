@extends('layouts.app')

@section('title', 'Checkout — ' . $product['name'] . ' ' . $plan['name'] . ' | NPDI')

@section('content')

<section class="min-h-screen bg-gray-50 py-12 px-4">
    <div class="max-w-4xl mx-auto">

        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-500 mb-8 flex items-center gap-2">
            <a href="{{ route('products.index') }}" class="hover:text-brand-teal transition">Produk</a>
            <span>/</span>
            <a href="{{ route('products.show', $product['slug']) }}" class="hover:text-brand-teal transition">{{ $product['name'] }}</a>
            <span>/</span>
            <span class="text-gray-900">Checkout</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

            {{-- Form --}}
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Detail Pembeli</h1>
                    <p class="text-gray-500 text-sm mb-8">Masukkan data Anda untuk melanjutkan ke pembayaran.</p>

                    @if($errors->has('payment'))
                    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6 text-sm">
                        {{ $errors->first('payment') }}
                    </div>
                    @endif

                    <form action="{{ route('checkout.submit', [$product['slug'], $plan['slug']]) }}" method="POST">
                        @csrf

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-transparent transition @error('name') border-red-400 @enderror"
                                       placeholder="Nama sesuai identitas">
                                @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-transparent transition @error('email') border-red-400 @enderror"
                                       placeholder="email@contoh.com">
                                @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-400 mt-1">Invoice dan konfirmasi pembayaran dikirim ke email ini.</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor WhatsApp <span class="text-gray-400 font-normal">(opsional)</span></label>
                                <input type="tel" name="phone" value="{{ old('phone') }}"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-transparent transition"
                                       placeholder="+62812xxxxxxxx">
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="submit"
                                    class="w-full bg-brand-teal hover:bg-brand-teal-dark text-brand-navy font-bold py-4 rounded-xl transition text-base shadow-lg shadow-brand-teal/20">
                                Lanjutkan ke Pembayaran
                            </button>
                            <p class="text-center text-xs text-gray-400 mt-3">
                                Anda akan diarahkan ke halaman pembayaran Xendit yang aman.
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-24">
                    <h2 class="text-base font-bold text-gray-900 mb-4">Ringkasan Pesanan</h2>

                    <div class="bg-gradient-to-br {{ $product['color'] }} rounded-xl p-4 text-white mb-4">
                        <p class="text-xs font-medium opacity-75 mb-1">{{ $product['badge'] }}</p>
                        <p class="font-bold text-lg">{{ $product['name'] }}</p>
                        <p class="text-sm opacity-85">Paket {{ $plan['name'] }}</p>
                    </div>

                    <ul class="space-y-2 text-sm text-gray-600 mb-5 border-b border-gray-100 pb-5">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ $plan['devices'] }} WA Device
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ $plan['broadcasts'] }} Broadcast/bulan
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ $plan['contacts'] }} Kontak
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ $plan['members'] }} Anggota Tim
                        </li>
                    </ul>

                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-gray-500">Subtotal</span>
                        <span class="text-sm text-gray-900">Rp {{ number_format($plan['price'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-gray-500">Periode</span>
                        <span class="text-sm text-gray-900">1 Bulan</span>
                    </div>
                    <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                        <span class="font-bold text-gray-900">Total</span>
                        <span class="font-bold text-xl text-gray-900">Rp {{ number_format($plan['price'], 0, ',', '.') }}</span>
                    </div>

                    <div class="mt-5 bg-gray-50 rounded-xl p-3 text-xs text-gray-500 flex items-start gap-2">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Pembayaran aman diproses oleh Xendit. Transfer bank, virtual account, QRIS, e-wallet, dan kartu kredit tersedia.
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
