@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Analisis ringkas dan pesan terbaru dari website.')

@section('content')
<div class="row">
    <!-- Stat Box: Total Messages -->
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                        <div class="stats-icon purple mb-2 d-flex align-items-center justify-content-center" style="width: 3rem; height: 3rem; background-color: #e8e8ff; border-radius: 0.5rem; color: #435ebe;">
                            <i class="bi bi-envelope-fill fs-4"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Total Pesan</h6>
                        <h6 class="font-extrabold mb-0 fs-4">{{ $totalMessages }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Box: Messages Today -->
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                        <div class="stats-icon blue mb-2 d-flex align-items-center justify-content-center" style="width: 3rem; height: 3rem; background-color: #e0f2fe; border-radius: 0.5rem; color: #0284c7;">
                            <i class="bi bi-calendar-event-fill fs-4"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Pesan Hari Ini</h6>
                        <h6 class="font-extrabold mb-0 fs-4">{{ $todayMessages }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Recent Messages Table -->
    <div class="col-12 col-xl-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Pesan Masuk Terbaru</h4>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary font-semibold">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-lg">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Subjek</th>
                                <th>Tanggal</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentMessages as $msg)
                            <tr>
                                <td class="col-3">
                                    <p class="font-bold mb-0 text-sm">{{ $msg->name }}</p>
                                    <small class="text-muted">{{ $msg->email }}</small>
                                </td>
                                <td class="col-5">
                                    <p class="mb-0 text-sm font-semibold">{{ $msg->subject }}</p>
                                    <small class="text-muted text-truncate d-inline-block" style="max-width: 250px;">{{ $msg->message }}</small>
                                </td>
                                <td class="col-2">
                                    <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                                </td>
                                <td class="col-2 text-end">
                                    <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-xs btn-primary font-semibold text-xs">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada pesan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Info / Founder -->
    <div class="col-12 col-xl-4">
        <div class="card shadow-sm border-0">
            <div class="card-body py-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl" style="width: 4.5rem; height: 4.5rem;">
                        <img src="{{ asset('assets/avatar/founder.png') }}" alt="Founder" class="rounded-circle object-cover" style="width: 100%; height: 100%;">
                    </div>
                    <div class="ms-3">
                        <h5 class="font-bold mb-0">Seriusman Waruwu, S.Kom</h5>
                        <small class="text-muted">Administrator</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-transparent border-0 pb-0">
                <h5 class="mb-0">Sistem Informasi</h5>
            </div>
            <div class="card-body mt-2">
                <ul class="list-group list-group-flush text-sm">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                        <span class="text-muted">Versi Laravel:</span>
                        <span class="font-bold">13.20.0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                        <span class="text-muted">Versi PHP:</span>
                        <span class="font-bold">8.5.4</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                        <span class="text-muted">Status Server:</span>
                        <span class="badge bg-success">Online</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
