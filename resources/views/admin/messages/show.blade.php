@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('page_title', 'Detail Pesan')
@section('page_subtitle', 'Melihat detail isi pesan dari pengunjung.')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Pesan dari {{ $message->name }}</h4>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="text-muted mb-1 text-xs uppercase tracking-wider">Subjek</h6>
                    <p class="fs-5 font-bold text-gray-900">{{ $message->subject }}</p>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-1 text-xs uppercase tracking-wider">Isi Pesan</h6>
                    <div class="bg-light p-4 rounded-3 text-gray-800" style="white-space: pre-wrap; line-height: 1.6; font-size: 14px; background-color: #f8f9fa;">{{ $message->message }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-transparent border-0 pb-0">
                <h5 class="mb-0">Informasi Pengirim</h5>
            </div>
            <div class="card-body mt-3">
                <div class="mb-3">
                    <small class="text-muted d-block text-xs uppercase tracking-wider mb-1">Nama</small>
                    <span class="font-bold text-sm">{{ $message->name }}</span>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block text-xs uppercase tracking-wider mb-1">Email</small>
                    <a href="mailto:{{ $message->email }}" class="text-sm font-semibold text-primary">{{ $message->email }}</a>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block text-xs uppercase tracking-wider mb-1">Telepon / HP</small>
                    <span class="text-sm font-semibold">{{ $message->phone ?? '-' }}</span>
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block text-xs uppercase tracking-wider mb-1">Dikirim Pada</small>
                    <span class="text-sm font-semibold">{{ $message->created_at->format('d F Y, H:i') }}</span>
                </div>

                <hr class="border-gray-100 my-4">

                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-full py-2">Hapus Pesan Ini</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
