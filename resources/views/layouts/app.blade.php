<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Nano Project Dev Indonesia — Perseroan Perorangan di bidang teknologi informasi, ISP, IoT, e-commerce, dan pengembangan software. Lahemo, Gido, Kabupaten Nias, Sumatera Utara.')">
    <title>@yield('title', 'Nano Project Dev Indonesia')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-gray-800 antialiased">

    {{-- Navbar --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-blue-700 text-lg">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                    NPDI
                </a>
                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <a href="{{ route('home') }}" class="hover:text-blue-600 transition {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-600' }}">Beranda</a>
                    <a href="{{ route('about') }}" class="hover:text-blue-600 transition {{ request()->routeIs('about') ? 'text-blue-600' : 'text-gray-600' }}">Tentang Kami</a>
                    <a href="{{ route('services') }}" class="hover:text-blue-600 transition {{ request()->routeIs('services') ? 'text-blue-600' : 'text-gray-600' }}">Layanan</a>
                    <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Hubungi Kami</a>
                </div>
                {{-- Hamburger --}}
                <button @click="open = !open" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        {{-- Mobile Menu --}}
        <div x-show="open" x-transition class="md:hidden border-t border-gray-100 bg-white">
            <div class="px-4 py-3 flex flex-col gap-3 text-sm font-medium">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600" @click="open=false">Beranda</a>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600" @click="open=false">Tentang Kami</a>
                <a href="{{ route('services') }}" class="text-gray-700 hover:text-blue-600" @click="open=false">Layanan</a>
                <a href="{{ route('contact') }}" class="text-blue-600 font-semibold" @click="open=false">Hubungi Kami</a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-300 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-white font-bold text-lg mb-3">Nano Project Dev Indonesia</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Perseroan Perorangan (Usaha Mikro) terdaftar yang bergerak di bidang teknologi informasi, ISP, IoT, dan pengembangan software.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Layanan</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Custom Software Development</li>
                        <li>Internet Service Provider</li>
                        <li>Network Access Point</li>
                        <li>E-Commerce Development</li>
                        <li>IoT Consulting & Design</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-3">Kontak</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Lahemo, Gido, Kab. Nias</li>
                        <li>Sumatera Utara, Indonesia</li>
                        <li class="pt-1">
                            <a href="{{ route('contact') }}" class="text-blue-400 hover:text-blue-300 transition">Hubungi Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Nano Project Dev Indonesia. Didirikan oleh Seriusman Waruwu. Hak cipta dilindungi undang-undang.
            </div>
        </div>
    </footer>

</body>
</html>
