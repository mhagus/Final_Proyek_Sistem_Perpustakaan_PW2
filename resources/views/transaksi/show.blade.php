@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="bi bi-receipt"></i>
        Detail Transaksi
    </h1>
    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
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

{{-- Warning jika terlambat (Tugas 3: Reminder) --}}
@if ($transaksi->status == 'Dipinjam' && $transaksi->terlambat > 0)
    <div class="alert alert-danger border-danger" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill fs-3 me-3 text-danger"></i>
            <div>
                <h5 class="alert-heading mb-1">
                    <i class="bi bi-clock-history"></i> Peringatan: Buku Terlambat Dikembalikan!
                </h5>
                <p class="mb-0">
                    Buku ini sudah <strong>terlambat {{ $transaksi->terlambat }} hari</strong> dari tanggal kembali 
                    (<strong>{{ $transaksi->tanggal_kembali->format('d F Y') }}</strong>).
                    Estimasi denda saat ini: <strong class="text-danger">Rp {{ number_format($transaksi->terlambat * 5000, 0, ',', '.') }}</strong>
                    (Rp 5.000/hari).
                </p>
            </div>
        </div>
    </div>
@endif

<div class="row">
    {{-- Info Transaksi --}}
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle"></i> Informasi Transaksi
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Kode Transaksi</th>
                        <td><code>{{ $transaksi->kode_transaksi }}</code></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($transaksi->status == 'Dipinjam')
                                <span class="badge bg-warning text-dark fs-6">
                                    <i class="bi bi-hourglass-split"></i> Dipinjam
                                </span>
                                @if ($transaksi->terlambat > 0)
                                    <span class="badge bg-danger fs-6 ms-1">
                                        <i class="bi bi-exclamation-triangle"></i> Terlambat {{ $transaksi->terlambat }} hari
                                    </span>
                                @endif
                            @else
                                <span class="badge bg-success fs-6">
                                    <i class="bi bi-check-circle"></i> Dikembalikan
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <td>{{ $transaksi->tanggal_pinjam->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Harus Kembali</th>
                        <td>
                            {{ $transaksi->tanggal_kembali->format('d F Y') }}
                            @if ($transaksi->status == 'Dipinjam' && now() > $transaksi->tanggal_kembali)
                                <span class="text-danger ms-2">
                                    <i class="bi bi-exclamation-circle"></i> Sudah melewati batas
                                </span>
                            @endif
                        </td>
                    </tr>
                    @if ($transaksi->tanggal_dikembalikan)
                    <tr>
                        <th>Tanggal Dikembalikan</th>
                        <td>{{ $transaksi->tanggal_dikembalikan->format('d F Y') }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Durasi Peminjaman</th>
                        <td>{{ $transaksi->durasi_peminjaman }} hari</td>
                    </tr>
                    @if ($transaksi->terlambat > 0)
                    <tr>
                        <th>Keterlambatan</th>
                        <td><span class="text-danger fw-bold">{{ $transaksi->terlambat }} hari</span></td>
                    </tr>
                    @endif
                    <tr>
                        <th>Denda</th>
                        <td>
                            @if ($transaksi->status == 'Dikembalikan' && $transaksi->denda > 0)
                                <span class="text-danger fw-bold fs-5">Rp {{ number_format($transaksi->denda, 0, ',', '.') }}</span>
                            @elseif ($transaksi->status == 'Dipinjam' && $transaksi->terlambat > 0)
                                <span class="text-danger fw-bold fs-5">
                                    Rp {{ number_format($transaksi->terlambat * 5000, 0, ',', '.') }}
                                </span>
                                <small class="text-muted">(estimasi, akan dihitung saat pengembalian)</small>
                            @else
                                <span class="text-success">Tidak ada denda</span>
                            @endif
                        </td>
                    </tr>
                    @if ($transaksi->keterangan)
                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $transaksi->keterangan }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    {{-- Sidebar: Info Anggota & Buku --}}
    <div class="col-md-4">
        {{-- Info Anggota --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="bi bi-person"></i> Anggota Peminjam</h6>
            </div>
            <div class="card-body">
                <p class="mb-1"><strong>{{ $transaksi->anggota->nama ?? '-' }}</strong></p>
                <p class="mb-1 text-muted small">
                    <i class="bi bi-hash"></i> {{ $transaksi->anggota->kode_anggota ?? '-' }}
                </p>
                <p class="mb-1 text-muted small">
                    <i class="bi bi-envelope"></i> {{ $transaksi->anggota->email ?? '-' }}
                </p>
                <p class="mb-0 text-muted small">
                    <i class="bi bi-telephone"></i> {{ $transaksi->anggota->telepon ?? '-' }}
                </p>
            </div>
        </div>

        {{-- Info Buku --}}
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="bi bi-book"></i> Buku Dipinjam</h6>
            </div>
            <div class="card-body">
                <p class="mb-1"><strong>{{ $transaksi->buku->judul ?? '-' }}</strong></p>
                <p class="mb-1 text-muted small">
                    <i class="bi bi-hash"></i> {{ $transaksi->buku->kode_buku ?? '-' }}
                </p>
                <p class="mb-1 text-muted small">
                    <i class="bi bi-person"></i> {{ $transaksi->buku->pengarang ?? '-' }}
                </p>
                <p class="mb-0 text-muted small">
                    <i class="bi bi-building"></i> {{ $transaksi->buku->penerbit ?? '-' }}
                </p>
            </div>
        </div>

        {{-- Aksi Kembalikan Buku (Tugas 1) --}}
        @if ($transaksi->status == 'Dipinjam')
        <div class="card border-success">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="bi bi-arrow-return-left"></i> Pengembalian Buku</h6>
            </div>
            <div class="card-body">
                @if ($transaksi->terlambat > 0)
                    <div class="alert alert-warning mb-3">
                        <small>
                            <i class="bi bi-exclamation-triangle"></i>
                            Terlambat <strong>{{ $transaksi->terlambat }} hari</strong>.<br>
                            Estimasi denda: <strong>Rp {{ number_format($transaksi->terlambat * 5000, 0, ',', '.') }}</strong>
                        </small>
                    </div>
                @else
                    <div class="alert alert-success mb-3">
                        <small>
                            <i class="bi bi-check-circle"></i>
                            Belum melewati batas waktu pengembalian. Tidak ada denda.
                        </small>
                    </div>
                @endif

                <form action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success w-100 btn-lg"
                            onclick="return confirm('Konfirmasi pengembalian buku ini?\n\n{{ $transaksi->terlambat > 0 ? 'Denda: Rp ' . number_format($transaksi->terlambat * 5000, 0, ',', '.') : 'Tidak ada denda' }}')">
                        <i class="bi bi-arrow-return-left"></i> Kembalikan Buku
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="card border-secondary">
            <div class="card-body text-center text-muted">
                <i class="bi bi-check-circle-fill fs-1 text-success"></i>
                <p class="mt-2 mb-0">Buku sudah dikembalikan pada<br>
                    <strong>{{ $transaksi->tanggal_dikembalikan->format('d F Y') }}</strong>
                </p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
