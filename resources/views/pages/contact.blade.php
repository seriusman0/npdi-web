@extends('layouts.app')

@section('title', 'Hubungi Kami — Nano Project Dev Indonesia')
@section('meta_description', 'Hubungi Nano Project Dev Indonesia untuk konsultasi layanan teknologi, software development, ISP, IoT, dan e-commerce.')

@section('content')

{{-- Page Header --}}
<section class="bg-gradient-to-br from-brand-navy to-brand-navy-dark text-white py-16 px-4">
    <div class="max-w-5xl mx-auto text-center">
        <h1 class="text-4xl font-bold mb-4">Hubungi Kami</h1>
        <p class="text-brand-teal-light/90 text-lg max-w-2xl mx-auto">Kami siap membantu. Kirimkan pesan Anda dan tim kami akan merespons secepatnya.</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

        {{-- Contact Form --}}
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 mb-6 flex items-start gap-3">
                <svg class="w-5 h-5 text-green-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                @csrf
                {{-- Honeypot + timing token --}}
                <div style="position:absolute;left:-9999px;top:-9999px;" aria-hidden="true" tabindex="-1">
                    <label for="website">Website</label>
                    <input type="text" id="website" name="website" value="" autocomplete="off" tabindex="-1">
                </div>
                <input type="hidden" name="_form_time" id="_form_time" value="">
                <script>document.getElementById('_form_time').value=Math.floor(Date.now()/1000);</script>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-transparent transition @error('name') border-red-400 @enderror"
                            placeholder="Masukkan nama lengkap Anda">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-transparent transition @error('email') border-red-400 @enderror"
                            placeholder="email@contoh.com">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP <span class="text-gray-400 text-xs">(opsional)</span></label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-transparent transition"
                            placeholder="+62 812 xxxx xxxx">
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek <span class="text-red-500">*</span></label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-transparent transition @error('subject') border-red-400 @enderror"
                            placeholder="Perihal pesan Anda">
                    </div>
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan <span class="text-red-500">*</span></label>
                    <textarea id="message" name="message" rows="6" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-teal focus:border-transparent transition resize-none @error('message') border-red-400 @enderror"
                        placeholder="Tuliskan pesan, pertanyaan, atau kebutuhan Anda di sini...">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="w-full sm:w-auto bg-brand-teal text-brand-navy font-bold px-8 py-3 rounded-xl hover:bg-brand-teal-dark transition shadow-md shadow-brand-teal/10">
                    Kirim Pesan
                </button>
            </form>
        </div>

        {{-- Contact Info --}}
        <div class="space-y-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>
                <div class="space-y-4">
                    <div class="flex gap-3">
                        <div class="w-10 h-10 bg-brand-teal-light rounded-xl flex items-center justify-center shrink-0 border border-brand-teal/10">
                            <svg class="w-5 h-5 text-brand-teal" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Alamat</p>
                            <p class="text-sm text-gray-600">Lahemo, Gido<br>Kabupaten Nias, Sumatera Utara<br>Indonesia</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="w-10 h-10 bg-brand-teal-light rounded-xl flex items-center justify-center shrink-0 border border-brand-teal/10">
                            <svg class="w-5 h-5 text-brand-teal" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Email</p>
                            <a href="mailto:serius2906@gmail.com" class="text-sm text-brand-teal-text hover:underline font-medium">serius2906@gmail.com</a>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="w-10 h-10 bg-brand-teal-light rounded-xl flex items-center justify-center shrink-0 border border-brand-teal/10">
                            <svg class="w-5 h-5 text-brand-teal" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Instagram</p>
                            <a href="https://instagram.com/seriusman0" target="_blank" rel="noopener noreferrer" class="text-sm text-brand-teal-text hover:underline font-medium">@seriusman0</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- WhatsApp CTA --}}
            <a href="https://wa.me/6285189447121" target="_blank" rel="noopener noreferrer"
                class="flex items-center gap-3 bg-green-500 text-white rounded-xl px-5 py-4 hover:bg-green-600 transition shadow-md shadow-green-500/10">
                <svg class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                <div>
                    <p class="font-semibold text-sm">Chat via WhatsApp</p>
                    <p class="text-green-100 text-xs">Respons cepat</p>
                </div>
            </a>

            {{-- Map --}}
            <div>
                <p class="text-sm font-semibold text-gray-900 mb-3">Lokasi Kantor</p>
                <div class="rounded-xl overflow-hidden border border-gray-200">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15965.123456!2d97.5!3d1.12!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sGido%2C+Kabupaten+Nias%2C+Sumatera+Utara!5e0!3m2!1sid!2sid!4v1234567890"
                        width="100%"
                        height="200"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi Nano Project Dev Indonesia, Gido, Kabupaten Nias">
                    </iframe>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
