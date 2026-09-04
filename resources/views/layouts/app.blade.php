<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Nano Project Dev Indonesia — Perseroan Perorangan di bidang teknologi informasi, ISP, IoT, e-commerce, dan pengembangan software. Lahemo, Gido, Kabupaten Nias, Sumatera Utara.')">
    <title>@yield('title', 'Nano Project Dev Indonesia')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Preconnect Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Favicons --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/icon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/icon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/icon/favicon-48x48.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/icon/favicon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/icon/favicon-512x512.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/icon/favicon-180x180.png') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.2/anime.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F7F8FA] text-[#1A1D2E] antialiased">

    {{-- Navbar --}}
    <nav class="bg-white/80 backdrop-blur-md border-b border-black/5 sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <img src="{{ asset('assets/logo/logo.png') }}" alt="NPDI Logo" class="h-8 w-auto">
                    <span class="font-display font-bold text-[#071638] text-base tracking-tight">NPDI</span>
                </a>
                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}"
                       class="font-display font-semibold transition-colors duration-200 {{ request()->routeIs('home') ? 'text-[#006b6e]' : 'text-[#6B7280] hover:text-[#1A1D2E]' }}">
                        Beranda
                    </a>
                    <a href="{{ route('about') }}"
                       class="font-display font-semibold transition-colors duration-200 {{ request()->routeIs('about') ? 'text-[#006b6e]' : 'text-[#6B7280] hover:text-[#1A1D2E]' }}">
                        Tentang Kami
                    </a>
                    <a href="{{ route('services') }}"
                       class="font-display font-semibold transition-colors duration-200 {{ request()->routeIs('services') ? 'text-[#006b6e]' : 'text-[#6B7280] hover:text-[#1A1D2E]' }}">
                        Layanan
                    </a>
                    <a href="{{ route('products.index') }}"
                       class="font-display font-semibold transition-colors duration-200 {{ request()->routeIs('products.*') ? 'text-[#006b6e]' : 'text-[#6B7280] hover:text-[#1A1D2E]' }}">
                        Produk
                    </a>
                    <a href="{{ route('contact') }}"
                       class="font-display font-bold bg-[#071638] text-white text-sm px-5 py-2 rounded-xl hover:bg-[#040d21] transition-colors duration-200 shadow-sm">
                        Hubungi Kami
                    </a>
                </div>
                {{-- Hamburger --}}
                <button @click="open = !open" class="md:hidden p-2 rounded-lg text-[#6B7280] hover:bg-[#EEF1F6] transition">
                    <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        {{-- Mobile Menu --}}
        <div x-show="open" x-transition class="md:hidden border-t border-black/5 bg-white">
            <div class="px-5 py-4 flex flex-col gap-4 text-sm font-medium">
                <a href="{{ route('home') }}" class="text-[#1A1D2E] hover:text-[#00A8AD] transition font-display font-semibold" @click="open=false">Beranda</a>
                <a href="{{ route('about') }}" class="text-[#6B7280] hover:text-[#00A8AD] transition font-display font-semibold" @click="open=false">Tentang Kami</a>
                <a href="{{ route('services') }}" class="text-[#6B7280] hover:text-[#00A8AD] transition font-display font-semibold" @click="open=false">Layanan</a>
                <a href="{{ route('products.index') }}" class="text-[#6B7280] hover:text-[#00A8AD] transition font-display font-semibold" @click="open=false">Produk</a>
                <a href="{{ route('contact') }}" class="text-[#006b6e] font-bold font-display" @click="open=false">Hubungi Kami</a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Floating WhatsApp Button --}}
    <a href="https://wa.me/6285189447121?text=Halo%20NPDI%2C%20saya%20ingin%20info%20lebih%20lanjut%20tentang%20layanan%20di%20website%20Anda."
       target="_blank" rel="noopener noreferrer"
       class="fixed bottom-6 right-6 z-50 flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-4 py-3 rounded-full shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105 group"
       title="Chat WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.121 1.532 5.849L.057 23.486a.5.5 0 0 0 .612.612l5.637-1.475A11.94 11.94 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.686-.528-5.208-1.442l-.374-.22-3.881 1.017 1.017-3.881-.22-.374A9.96 9.96 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
        </svg>
        <span class="text-sm font-semibold whitespace-nowrap">Chat WhatsApp</span>
    </a>

    {{-- Footer --}}
    <footer class="bg-[#071638] mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <img src="{{ asset('assets/logo/logo.png') }}" alt="NPDI" class="h-7 w-auto opacity-90">
                        <span class="font-display font-bold text-white text-base tracking-tight">NPDI</span>
                    </div>
                    <p class="text-sm text-white/50 leading-relaxed max-w-xs">
                        Perseroan Perorangan terdaftar di bidang teknologi informasi, ISP, IoT, dan pengembangan software. Berbasis di Nias, Sumatera Utara.
                    </p>
                </div>
                <div>
                    <h4 class="font-display font-semibold text-white/80 text-xs uppercase tracking-widest mb-5">Layanan & Produk</h4>
                    <ul class="space-y-2.5 text-sm text-white/45">
                        <li>Custom Software Development</li>
                        <li>Internet Service Provider</li>
                        <li>Network Access Point</li>
                        <li>E-Commerce Development</li>
                        <li>IoT Consulting & Design</li>
                        <li class="pt-1">
                            <a href="{{ route('products.index') }}" class="text-[#00A8AD] hover:text-[#00A8AD]/80 transition font-medium">Produk Digital →</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-display font-semibold text-white/80 text-xs uppercase tracking-widest mb-5">Kontak</h4>
                    <ul class="space-y-2.5 text-sm text-white/45">
                        <li>Lahemo, Gido, Kab. Nias</li>
                        <li>Sumatera Utara, Indonesia</li>
                        <li class="pt-1">
                            <a href="{{ route('contact') }}" class="text-[#00A8AD] hover:text-[#00A8AD]/80 transition font-medium">Hubungi Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/8 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/30">
                <span>&copy; {{ date('Y') }} Nano Project Dev Indonesia. Hak cipta dilindungi.</span>
                <span class="font-serif italic">Didirikan oleh Seriusman Waruwu, S.Kom</span>
            </div>
        </div>
    </footer>

</body>
</html>
