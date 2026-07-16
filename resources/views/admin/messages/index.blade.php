@extends('layouts.admin')

@section('title', 'Pesan Kontak')
@section('page_title', 'Pesan Kontak')
@section('page_subtitle', 'Kelola semua pesan yang dikirimkan oleh pengunjung melalui form kontak.')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Daftar Pesan Masuk</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade text-sm mb-4">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Subjek</th>
                        <th>Tanggal</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                    <tr>
                        <td><span class="font-bold text-sm">{{ $msg->name }}</span></td>
                        <td><small>{{ $msg->email }}</small></td>
                        <td><small>{{ $msg->phone ?? '-' }}</small></td>
                        <td><span class="text-sm font-semibold">{{ $msg->subject }}</span></td>
                        <td><small class="text-muted">{{ $msg->created_at->format('d M Y, H:i') }}</small></td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-primary">Detail</a>
                                <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada pesan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection
