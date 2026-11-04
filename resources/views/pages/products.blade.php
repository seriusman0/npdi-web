@extends('layouts.app')

@section('title', 'Produk Digital — Nano Project Dev Indonesia')
@section('meta_description', 'Produk digital siap pakai dari NPDI. Platform SaaS, tools bisnis, dan solusi teknologi untuk mendorong pertumbuhan bisnis Anda.')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-brand-navy to-brand-navy-dark text-white py-20 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <span class="inline-block bg-brand-teal/30 text-brand-teal-light text-sm font-medium px-3 py-1 rounded-full mb-4">Produk Digital NPDI</span>
        <h1 class="text-4xl sm:text-5xl font-bold mb-5 leading-tight">Solusi Digital Siap Pakai</h1>
        <p class="text-brand-teal-light/90 text-lg max-w-2xl mx-auto">
            Produk SaaS dan tools yang dibangun sendiri oleh tim NPDI. Bayar sekali, langsung pakai, tanpa kerumitan instalasi.
        </p>
    </div>
</section>

{{-- Products Grid --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        {{-- NanoHub Card --}}
        @foreach($products as $product)
        <a href="{{ route('products.show', $product['slug']) }}"
           class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
            {{-- Card Header --}}
            <div class="bg-gradient-to-br {{ $product['color'] }} p-8 text-white">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <span class="text-xs font-medium bg-white/20 px-2 py-1 rounded-full">{{ $product['badge'] }}</span>
                    </div>
                    <svg class="w-5 h-5 opacity-70 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold mb-1">{{ $product['name'] }}</h2>
                <p class="text-white/80 text-sm leading-relaxed">{{ $product['tagline'] }}</p>
            </div>

            {{-- Card Body --}}
            <div class="p-6 flex-1 flex flex-col">
                <p class="text-gray-600 text-sm leading-relaxed mb-5">{{ $product['description'] }}</p>

                {{-- Key Features (first 4) --}}
                <ul class="space-y-2 mb-6 flex-1">
                    @foreach(array_slice($product['features'], 0, 4) as $feature)
                    <li class="flex items-start gap-2 text-sm text-gray-700">
                        <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                    @if(count($product['features']) > 4)
                    <li class="text-sm text-brand-teal-text font-medium">+{{ count($product['features']) - 4 }} fitur lainnya</li>
                    @endif
                </ul>

                {{-- Pricing Start --}}
                <div class="border-t border-gray-100 pt-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500">Mulai dari</p>
                            <p class="text-xl font-bold text-gray-900">Rp {{ number_format($product['plans'][0]['price'], 0, ',', '.') }}<span class="text-sm font-normal text-gray-500">/bln</span></p>
                        </div>
                        <span class="text-sm font-semibold text-brand-teal-text group-hover:underline">Lihat Paket →</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach

        {{-- Coming Soon Card --}}
        <div class="bg-gray-50 rounded-2xl border border-dashed border-gray-200 p-8 flex flex-col items-center justify-center text-center min-h-[320px]">
            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <h3 class="text-gray-500 font-semibold mb-2">Produk Baru Segera Hadir</h3>
            <p class="text-gray-400 text-sm">Tim NPDI sedang membangun produk digital baru. Pantau terus!</p>
        </div>

    </div>
</section>

{{-- CTA Section --}}
<section class="bg-brand-navy text-white py-16 px-4">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">Butuh Solusi Custom?</h2>
        <p class="text-gray-300 mb-8">Tim NPDI juga menerima proyek pengembangan software, website, dan aplikasi sesuai kebutuhan bisnis Anda.</p>
        <a href="{{ route('contact') }}" class="inline-block bg-brand-teal text-brand-navy font-bold px-8 py-3 rounded-xl hover:bg-brand-teal-dark transition">
            Diskusikan Proyek Anda
        </a>
    </div>
</section>

@endsection
