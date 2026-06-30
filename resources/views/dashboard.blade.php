@extends('layouts.app')
 
@section('title', 'Dashboard')
 
@section('content')
<div class="mb-4">
    <h2 class="fw-bold d-flex align-items-center">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard Perpustakaan
    </h2>
</div>

<!-- 4 Top Cards -->
<div class="row g-3 mb-4">
    <!-- Total Buku -->
    <div class="col-md-3">
        <div class="card text-white h-100 border-0 shadow-sm" style="background-color: #6366f1;">
            <div class="card-body position-relative pb-4">
                <p class="mb-1 fw-semibold opacity-75">Total Buku</p>
                <h2 class="display-5 fw-bold mb-0">{{ $totalBuku }}</h2>
                <i class="bi bi-book position-absolute opacity-25" style="font-size: 3.5rem; right: 1rem; top: 50%; transform: translateY(-50%);"></i>
            </div>
        </div>
    </div>
    <!-- Total Anggota -->
    <div class="col-md-3">
        <div class="card text-white h-100 border-0 shadow-sm" style="background-color: #10b981;">
            <div class="card-body position-relative pb-4">
                <p class="mb-1 fw-semibold opacity-75">Total Anggota</p>
                <h2 class="display-5 fw-bold mb-0">{{ $totalAnggota }}</h2>
                <i class="bi bi-people position-absolute opacity-25" style="font-size: 3.5rem; right: 1rem; top: 50%; transform: translateY(-50%);"></i>
            </div>
        </div>
    </div>
    <!-- Dipinjam -->
    <div class="col-md-3">
        <div class="card text-white h-100 border-0 shadow-sm" style="background-color: #f59e0b;">
            <div class="card-body position-relative pb-4">
                <p class="mb-1 fw-semibold opacity-75">Dipinjam</p>
                <h2 class="display-5 fw-bold mb-0">{{ $sedangDipinjam }}</h2>
                <i class="bi bi-box-arrow-up position-absolute opacity-25" style="font-size: 3.5rem; right: 1rem; top: 50%; transform: translateY(-50%);"></i>
            </div>
        </div>
    </div>
    <!-- Buku Terlambat -->
    <div class="col-md-3">
        <div class="card text-white h-100 border-0 shadow-sm" style="background-color: #f43f5e;">
            <div class="card-body position-relative pb-4">
                <p class="mb-1 fw-semibold opacity-75">Buku Terlambat</p>
                <h2 class="display-5 fw-bold mb-0">{{ $jumlahTerlambat }}</h2>
                <i class="bi bi-exclamation-triangle position-absolute opacity-25" style="font-size: 3.5rem; right: 1rem; top: 50%; transform: translateY(-50%);"></i>
            </div>
        </div>
    </div>
</div>

<!-- Buku Terlambat Dikembalikan Section -->
@if($jumlahTerlambat > 0)
<div class="card border-0 shadow-sm mb-4" style="border-left: 5px solid #f43f5e !important;">
    <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #e11d48;">
        <h5 class="mb-0 fw-bold">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Buku Terlambat Dikembalikan 
            <span class="badge bg-white text-danger ms-2 rounded-pill">{{ $jumlahTerlambat }}</span>
        </h5>
        <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-light">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Anggota</th>
                        <th>Buku</th>
                        <th>Batas Kembali</th>
                        <th>Terlambat</th>
                        <th>Estimasi Denda</th>
                        <th class="pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksiTerlambat as $terlambat)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-fill text-secondary me-2"></i>
                                <div>
                                    <div class="fw-bold">{{ $terlambat->anggota->nama ?? '-' }}</div>
                                    <div class="text-muted small">{{ $terlambat->anggota->nomor_anggota ?? 'AGT-...' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $terlambat->buku->judul ?? '-' }}</td>
                        <td class="text-danger">{{ $terlambat->tanggal_kembali->format('d M Y') }}</td>
                        <td>
                            <span class="badge rounded-pill bg-danger" style="background-color: #f43f5e !important;">
                                {{ $terlambat->terlambat }} hari
                            </span>
                        </td>
                        <td class="fw-bold text-danger">
                            Rp {{ number_format($terlambat->terlambat * 5000, 0, ',', '.') }}
                        </td>
                        <td class="pe-4">
                            <a href="{{ route('transaksi.show', $terlambat->id) }}" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<!-- Aksi Cepat Section -->
<div class="mb-4">
    <h5 class="fw-bold mb-3 d-flex align-items-center text-warning" style="color: #d97706 !important;">
        <i class="bi bi-lightning-charge-fill me-2"></i> Aksi Cepat
    </h5>
    <div class="row g-3">
        <div class="col-md-3">
            <a href="{{ route('buku.create') }}" class="card text-decoration-none border-primary text-primary h-100 text-center hover-shadow transition-all" style="border-width: 2px;">
                <div class="card-body py-4">
                    <i class="bi bi-book display-4 mb-3"></i>
                    <h6 class="fw-bold mb-0">Tambah Buku</h6>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('anggota.create') }}" class="card text-decoration-none border-success text-success h-100 text-center hover-shadow transition-all" style="border-width: 2px; border-color: #10b981 !important; color: #10b981 !important;">
                <div class="card-body py-4">
                    <i class="bi bi-person-plus display-4 mb-3"></i>
                    <h6 class="fw-bold mb-0">Tambah Anggota</h6>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('transaksi.create') }}" class="card text-decoration-none border-warning text-warning h-100 text-center hover-shadow transition-all" style="border-width: 2px; border-color: #f59e0b !important; color: #f59e0b !important;">
                <div class="card-body py-4">
                    <i class="bi bi-journal-plus display-4 mb-3"></i>
                    <h6 class="fw-bold mb-0">Pinjam Buku</h6>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('transaksi.laporan') }}" class="card text-decoration-none border-info text-info h-100 text-center hover-shadow transition-all" style="border-width: 2px; border-color: #0ea5e9 !important; color: #0ea5e9 !important;">
                <div class="card-body py-4">
                    <i class="bi bi-file-earmark-bar-graph display-4 mb-3"></i>
                    <h6 class="fw-bold mb-0">Laporan Transaksi</h6>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transform: translateY(-2px);
    }
    .transition-all {
        transition: all .2s ease-in-out;
    }
</style>
@endsection