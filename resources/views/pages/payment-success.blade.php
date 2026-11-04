@extends('layouts.app')

@section('title', 'Pembayaran Berhasil — NPDI')

@section('content')

<section class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-20">
    <div class="max-w-md w-full text-center">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-10">
            {{-- Success Icon --}}
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-gray-900 mb-2">Pembayaran Berhasil!</h1>
            <p class="text-gray-500 mb-8 leading-relaxed">
                Terima kasih atas pembelian Anda. Invoice dan detail akses akan dikirimkan ke email yang Anda daftarkan. Mohon cek folder spam jika tidak ada di inbox.
            </p>

            <div class="bg-brand-teal/5 border border-brand-teal/20 rounded-xl p-4 mb-8 text-left">
                <h3 class="text-sm font-semibold text-brand-teal mb-2">Langkah Selanjutnya</h3>
                <ol class="space-y-1 text-sm text-gray-600 list-decimal list-inside">
                    <li>Cek email konfirmasi dari NPDI</li>
                    <li>Login ke dashboard NanoHub</li>
                    <li>Scan QR untuk connect WhatsApp pertama Anda</li>
                    <li>Mulai kirim broadcast!</li>
                </ol>
            </div>

            <div class="flex flex-col gap-3">
                <a href="https://nanohub.nanoprojectdevindonesia.com" target="_blank" rel="noopener noreferrer"
                   class="bg-brand-teal hover:bg-brand-teal-dark text-white font-semibold py-3 px-6 rounded-xl transition">
                    Buka Dashboard NanoHub
                </a>
                <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-700 text-sm transition">
                    Kembali ke Halaman Produk
                </a>
            </div>
        </div>

        <p class="text-xs text-gray-400 mt-6">
            Butuh bantuan? Hubungi kami via
            <a href="https://wa.me/6285189447121" class="text-brand-teal hover:underline">WhatsApp</a>
            atau kunjungi halaman <a href="{{ route('contact') }}" class="text-brand-teal hover:underline">Kontak</a>.
        </p>
    </div>
</section>

@endsection
