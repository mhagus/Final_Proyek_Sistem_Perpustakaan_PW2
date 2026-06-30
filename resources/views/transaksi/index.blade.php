@extends('layouts.app')

@section('title', 'Transaksi Peminjaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="bi bi-arrow-left-right"></i>
        Daftar Transaksi Peminjaman
    </h1>
    <div>
        <a href="{{ route('transaksi.laporan') }}" class="btn btn-outline-secondary me-2">
            <i class="bi bi-file-earmark-bar-graph"></i> Laporan
        </a>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Pinjam Buku
        </a>
    </div>
</div>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Statistik Transaksi --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Transaksi</h6>
                        <h2 class="mb-0">{{ $transaksis->count() }}</h2>
                    </div>
                    <i class="bi bi-receipt text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Sedang Dipinjam</h6>
                        <h2 class="mb-0">{{ $transaksis->where('status', 'Dipinjam')->count() }}</h2>
                    </div>
                    <i class="bi bi-hourglass-split text-warning" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Dikembalikan</h6>
                        <h2 class="mb-0">{{ $transaksis->where('status', 'Dikembalikan')->count() }}</h2>
                    </div>
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Terlambat</h6>
                        <h2 class="mb-0 text-danger">{{ $transaksis->where('status', 'Dipinjam')->filter(fn($t) => $t->terlambat > 0)->count() }}</h2>
                    </div>
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Transaksi --}}
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><code>{{ $transaksi->kode_transaksi }}</code></td>
                            <td>{{ $transaksi->anggota->nama ?? '-' }}</td>
                            <td>{{ $transaksi->buku->judul ?? '-' }}</td>
                            <td>{{ $transaksi->tanggal_pinjam->format('d M Y') }}</td>
                            <td>{{ $transaksi->tanggal_kembali->format('d M Y') }}</td>
                            <td>
                                @if ($transaksi->status == 'Dipinjam')
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-hourglass-split"></i> Dipinjam
                                    </span>
                                    {{-- Tugas 3: Badge Terlambat --}}
                                    @if ($transaksi->terlambat > 0)
                                        <br>
                                        <span class="badge bg-danger mt-1">
                                            <i class="bi bi-exclamation-triangle"></i> Terlambat {{ $transaksi->terlambat }} hari
                                        </span>
                                    @endif
                                @else
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Dikembalikan
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($transaksi->denda > 0)
                                    <span class="text-danger fw-bold">Rp {{ number_format($transaksi->denda, 0, ',', '.') }}</span>
                                @elseif ($transaksi->status == 'Dipinjam' && $transaksi->terlambat > 0)
                                    <span class="text-danger">
                                        <small>~Rp {{ number_format($transaksi->terlambat * 5000, 0, ',', '.') }}</small>
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('transaksi.show', $transaksi->id) }}" 
                                       class="btn btn-sm btn-info text-white"
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if ($transaksi->status == 'Dipinjam')
                                        <form action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success" title="Kembalikan"
                                                    onclick="return confirm('Konfirmasi pengembalian buku?')">
                                                <i class="bi bi-arrow-return-left"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                <i class="bi bi-inbox"></i>
                                Belum ada data transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
