<x-mail::message>
# Pesan Baru dari Formulir Kontak

Anda menerima pesan baru dari website **{{ config('app.name') }}**.

---

**Nama:** {{ $contactMessage->name }}

**Email:** {{ $contactMessage->email }}

**No. HP:** {{ $contactMessage->phone ?: '-' }}

**Subjek:** {{ $contactMessage->subject }}

**Pesan:**

{{ $contactMessage->message }}

---

Waktu dikirim: {{ $contactMessage->created_at->setTimezone('Asia/Jakarta')->format('d F Y, H:i') }} WIB

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
