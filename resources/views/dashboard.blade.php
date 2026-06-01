@extends('layouts.app') 

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0 text-dark">Dashboard Perpustakaan</h2>
            <p class="text-muted mb-0">Ringkasan data dan aktivitas perpustakaan saat ini.</p>
        </div>
        
        <div class="d-flex gap-2">
            <a href="{{ url('/buku') }}" class="btn btn-primary px-4 shadow-sm" style="background-color: #0d6efd; border: none;">Kelola Buku</a>
            <a href="{{ url('/anggota') }}" class="btn btn-dark px-4 shadow-sm" style="background-color: #212529; border: none;">Kelola Anggota</a>
        </div>
    </div>

    <!-- Statistik Section -->
    <div class="row mb-4">
        <!-- Statistik Buku -->
        <div class="col-md-6 mb-3 mb-md-0">
            <h5 class="fw-bold mb-3 text-dark">Statistik Buku</h5>
            <div class="row g-3">
                <div class="col-sm-4">
                    <div class="card text-white shadow-sm border-0 h-100" style="background-color: #0d6efd;">
                        <div class="card-body">
                            <p class="card-text mb-1" style="opacity: 0.85;">Total Buku</p>
                            <h2 class="mb-0 fw-bold">{{ $totalBuku }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card text-white shadow-sm border-0 h-100" style="background-color: #198754;">
                        <div class="card-body">
                            <p class="card-text mb-1" style="opacity: 0.85;">Tersedia</p>
                            <h2 class="mb-0 fw-bold">{{ $bukuTersedia }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card text-white shadow-sm border-0 h-100" style="background-color: #dc3545;">
                        <div class="card-body">
                            <p class="card-text mb-1" style="opacity: 0.85;">Habis</p>
                            <h2 class="mb-0 fw-bold">{{ $bukuHabis }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Anggota -->
        <div class="col-md-6">
            <h5 class="fw-bold mb-3 text-dark">Statistik Anggota</h5>
            <div class="row g-3">
                <div class="col-sm-4">
                    <div class="card text-dark shadow-sm border-0 h-100" style="background-color: #f8f9fa; border-left: 4px solid #0dcaf0 !important;">
                        <div class="card-body">
                            <p class="card-text mb-1 text-muted">Total Anggota</p>
                            <h2 class="mb-0 fw-bold">{{ $totalAnggota }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card text-white shadow-sm border-0 h-100" style="background-color: #198754;">
                        <div class="card-body">
                            <p class="card-text mb-1" style="opacity: 0.85;">Aktif</p>
                            <h2 class="mb-0 fw-bold">{{ $anggotaAktif }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card text-white shadow-sm border-0 h-100" style="background-color: #6c757d;">
                        <div class="card-body">
                            <p class="card-text mb-1" style="opacity: 0.85;">Nonaktif</p>
                            <h2 class="mb-0 fw-bold">{{ $anggotaNonaktif }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- List Data Terbaru -->
    <div class="row">
        <!-- 5 Buku Terbaru -->
        <div class="col-md-6 mb-4">
            <h5 class="fw-bold mb-3 text-dark">5 Buku Terbaru</h5>
            <div class="d-flex flex-column gap-3">
                @forelse($bukuTerbaru as $buku)
                    <div class="card border-0 shadow-sm" style="border-left: 4px solid #0d6efd !important; background-color: #ffffff;">
                        <div class="card-body d-flex justify-content-between align-items-center p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center text-white fw-bold rounded shadow-sm" style="width: 45px; height: 45px; background-color: #0d6efd;">
                                    {{ strtoupper(substr($buku->judul, 0, 1)) }}
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark" style="font-size: 1rem;">{{ $buku->judul }}</h6>
                                    <small class="text-muted d-block" style="font-size: 0.85rem;">Pengarang: {{ $buku->pengarang }}</small>
                                </div>
                            </div>
                            <div>
                                {!! $buku->status_stok_badge !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center text-muted py-4">
                            Belum ada data buku terbaru.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- 5 Anggota Terbaru -->
        <div class="col-md-6 mb-4">
            <h5 class="fw-bold mb-3 text-dark">5 Anggota Terbaru</h5>
            <div class="d-flex flex-column gap-3">
                @forelse($anggotaTerbaru as $anggota)
                    <div class="card border-0 shadow-sm" style="border-left: 4px solid #6f42c1 !important; background-color: #ffffff;">
                        <div class="card-body d-flex justify-content-between align-items-center p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center justify-content-center text-white fw-bold rounded-circle shadow-sm" style="width: 45px; height: 45px; background-color: #6f42c1;">
                                    {{ strtoupper(substr($anggota->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark" style="font-size: 1rem;">{{ $anggota->nama }}</h6>
                                    <small class="text-muted d-block" style="font-size: 0.85rem;">ID: {{ $anggota->kode_anggota }}</small>
                                </div>
                            </div>
                            <div>
                                {!! $anggota->status_badge !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center text-muted py-4">
                            Belum ada data anggota terbaru.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection