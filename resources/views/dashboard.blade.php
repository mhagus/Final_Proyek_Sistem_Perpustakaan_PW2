@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4 fw-bold"><i class="bi bi-speedometer2 me-2"></i>Dashboard Perpustakaan</h2>

    {{-- Statistics Cards --}}
    <div class="row g-3 mb-4">
        {{-- Total Buku --}}
        <div class="col-xl-3 col-md-6">
            <div class="card text-white border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body d-flex align-items-center position-relative overflow-hidden">
                    <i class="bi bi-book position-absolute opacity-25" style="font-size: 4rem; right: 1rem; top: 50%; transform: translateY(-50%);"></i>
                    <div>
                        <p class="mb-1 fw-semibold opacity-75 small text-uppercase">Total Buku</p>
                        <h3 class="fw-bold mb-0">{{ $stats['total_buku'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Anggota Aktif --}}
        <div class="col-xl-3 col-md-6">
            <div class="card text-white border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <div class="card-body d-flex align-items-center position-relative overflow-hidden">
                    <i class="bi bi-people position-absolute opacity-25" style="font-size: 4rem; right: 1rem; top: 50%; transform: translateY(-50%);"></i>
                    <div>
                        <p class="mb-1 fw-semibold opacity-75 small text-uppercase">Anggota Aktif</p>
                        <h3 class="fw-bold mb-0">{{ $stats['total_anggota'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sedang Dipinjam --}}
        <div class="col-xl-3 col-md-6">
            <div class="card text-white border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="card-body d-flex align-items-center position-relative overflow-hidden">
                    <i class="bi bi-journal-arrow-up position-absolute opacity-25" style="font-size: 4rem; right: 1rem; top: 50%; transform: translateY(-50%);"></i>
                    <div>
                        <p class="mb-1 fw-semibold opacity-75 small text-uppercase">Sedang Dipinjam</p>
                        <h3 class="fw-bold mb-0">{{ $stats['sedang_dipinjam'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Terlambat --}}
        <div class="col-xl-3 col-md-6">
            <div class="card text-white border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #f5576c 0%, #ff6a88 100%);">
                <div class="card-body d-flex align-items-center position-relative overflow-hidden">
                    <i class="bi bi-exclamation-triangle position-absolute opacity-25" style="font-size: 4rem; right: 1rem; top: 50%; transform: translateY(-50%);"></i>
                    <div>
                        <p class="mb-1 fw-semibold opacity-75 small text-uppercase">Terlambat</p>
                        <h3 class="fw-bold mb-0">{{ $stats['terlambat'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Transaksi Hari Ini --}}
        <div class="col-xl-3 col-md-6">
            <div class="card text-white border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <div class="card-body d-flex align-items-center position-relative overflow-hidden">
                    <i class="bi bi-calendar-check position-absolute opacity-25" style="font-size: 4rem; right: 1rem; top: 50%; transform: translateY(-50%);"></i>
                    <div>
                        <p class="mb-1 fw-semibold opacity-75 small text-uppercase">Transaksi Hari Ini</p>
                        <h3 class="fw-bold mb-0">{{ $stats['transaksi_hari_ini'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Buku Tersedia --}}
        <div class="col-xl-3 col-md-6">
            <div class="card text-white border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);">
                <div class="card-body d-flex align-items-center position-relative overflow-hidden">
                    <i class="bi bi-bookshelf position-absolute opacity-25" style="font-size: 4rem; right: 1rem; top: 50%; transform: translateY(-50%);"></i>
                    <div>
                        <p class="mb-1 fw-semibold opacity-75 small text-uppercase">Buku Tersedia</p>
                        <h3 class="fw-bold mb-0">{{ $stats['buku_tersedia'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Transaksi --}}
        <div class="col-xl-3 col-md-6">
            <div class="card text-white border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #2b5876 0%, #4e4376 100%);">
                <div class="card-body d-flex align-items-center position-relative overflow-hidden">
                    <i class="bi bi-receipt position-absolute opacity-25" style="font-size: 4rem; right: 1rem; top: 50%; transform: translateY(-50%);"></i>
                    <div>
                        <p class="mb-1 fw-semibold opacity-75 small text-uppercase">Total Transaksi</p>
                        <h3 class="fw-bold mb-0">{{ $stats['total_transaksi'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Denda Bulan Ini --}}
        <div class="col-xl-3 col-md-6">
            <div class="card text-white border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #ff0844 0%, #ffb199 100%);">
                <div class="card-body d-flex align-items-center position-relative overflow-hidden">
                    <i class="bi bi-cash position-absolute opacity-25" style="font-size: 4rem; right: 1rem; top: 50%; transform: translateY(-50%);"></i>
                    <div>
                        <p class="mb-1 fw-semibold opacity-75 small text-uppercase">Denda Bulan Ini</p>
                        <h3 class="fw-bold mb-0">Rp {{ number_format($stats['denda_bulan_ini'], 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold border-0 pt-3">
                    <i class="bi bi-graph-up me-2 text-primary"></i>Transaksi 6 Bulan Terakhir
                </div>
                <div class="card-body">
                    <canvas id="chartTransaksi" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold border-0 pt-3">
                    <i class="bi bi-pie-chart me-2 text-success"></i>Top 5 Buku Populer
                </div>
                <div class="card-body">
                    <canvas id="chartBuku" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Top 5 Tables --}}
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="bi bi-star-fill me-2"></i>Top 5 Buku Populer
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">No</th><th>Judul</th><th class="pe-3">Total Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bukuPopuler as $i => $buku)
                            <tr>
                                <td class="ps-3">{{ $i + 1 }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td class="pe-3">
                                    <span class="badge rounded-pill" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                                        {{ $buku->transaksis_count }} pinjam
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                    <i class="bi bi-people-fill me-2"></i>Top 5 Anggota Aktif
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">No</th><th>Nama</th><th class="pe-3">Total Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggotaAktif as $i => $anggota)
                            <tr>
                                <td class="ps-3">{{ $i + 1 }}</td>
                                <td>{{ $anggota->nama }}</td>
                                <td class="pe-3">
                                    <span class="badge rounded-pill" style="background: linear-gradient(135deg, #11998e, #38ef7d);">
                                        {{ $anggota->transaksis_count }} pinjam
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Widget: Buku Terlambat --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header text-white border-0 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #f5576c 0%, #ff6a88 100%);">
                    <div>
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Buku Terlambat
                    </div>
                    <span class="badge bg-white text-danger fw-bold fs-6">
                        {{ $bukuTerlambat->count() }} Transaksi
                    </span>
                </div>
                <div class="card-body">
                    @if($bukuTerlambat->count() > 0)
                        {{-- Summary Alert --}}
                        <div class="alert border-0 mb-3 d-flex align-items-center" style="background: linear-gradient(135deg, rgba(245,87,108,0.08) 0%, rgba(255,106,136,0.08) 100%); border-left: 4px solid #f5576c !important;">
                            <i class="bi bi-bell-fill text-danger me-3 fs-4 terlambat-pulse"></i>
                            <div>
                                <strong class="text-danger">Perhatian!</strong>
                                Terdapat <strong>{{ $bukuTerlambat->count() }} transaksi</strong> yang melewati batas waktu pengembalian.
                                Total estimasi denda: <strong class="text-danger">Rp {{ number_format($bukuTerlambat->sum(fn($t) => $t->terlambat * 5000), 0, ',', '.') }}</strong>
                            </div>
                        </div>

                        {{-- Table List Anggota Terlambat --}}
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">No</th>
                                        <th>Anggota</th>
                                        <th>Buku</th>
                                        <th>Tgl Harus Kembali</th>
                                        <th>Keterlambatan</th>
                                        <th>Estimasi Denda</th>
                                        <th class="pe-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bukuTerlambat as $i => $trx)
                                    <tr>
                                        <td class="ps-3">{{ $i + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
                                                    <i class="bi bi-person-fill text-danger"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-semibold">{{ $trx->anggota->nama ?? '-' }}</span>
                                                    <br>
                                                    <small class="text-muted">{{ $trx->anggota->kode_anggota ?? '' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-semibold">{{ $trx->buku->judul ?? '-' }}</span>
                                            <br>
                                            <small class="text-muted"><code>{{ $trx->kode_transaksi }}</code></small>
                                        </td>
                                        <td>
                                            <span class="text-danger">
                                                <i class="bi bi-calendar-x me-1"></i>{{ $trx->tanggal_kembali->format('d M Y') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill bg-danger px-3 py-2">
                                                <i class="bi bi-clock-fill me-1"></i>Terlambat {{ $trx->terlambat }} hari
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-danger fw-bold">
                                                Rp {{ number_format($trx->terlambat * 5000, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="pe-3">
                                            <a href="{{ route('transaksi.show', $trx->id) }}" class="btn btn-sm btn-outline-danger" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2 mb-0">Tidak ada buku yang terlambat dikembalikan. Semua peminjaman berjalan lancar!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #2b5876 0%, #4e4376 100%);">
            <i class="bi bi-clock-history me-2"></i>Transaksi Terbaru
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Kode</th><th>Anggota</th><th>Buku</th>
                        <th>Tgl Pinjam</th><th class="pe-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTransaksi as $trx)
                    <tr>
                        <td class="ps-3"><code>{{ $trx->kode_transaksi }}</code></td>
                        <td>{{ $trx->anggota->nama }}</td>
                        <td>{{ $trx->buku->judul }}</td>
                        <td>{{ $trx->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td class="pe-3">
                            @if($trx->status === 'Dipinjam')
                                <span class="badge rounded-pill bg-warning text-dark">
                                    <i class="bi bi-hourglass-split me-1"></i>{{ $trx->status }}
                                </span>
                            @else
                                <span class="badge rounded-pill bg-success">
                                    <i class="bi bi-check-circle me-1"></i>{{ $trx->status }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,.12) !important;
    }
    .terlambat-pulse {
        animation: pulseAlert 1.5s ease-in-out infinite;
    }
    @keyframes pulseAlert {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.15); }
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Line chart — Transaksi 6 bulan terakhir
new Chart(document.getElementById('chartTransaksi'), {
    type: 'line',
    data: {
        labels: @json($chartData->pluck('bulan')),
        datasets: [
            {
                label: 'Peminjaman',
                data: @json($chartData->pluck('pinjam')),
                borderColor: '#667eea',
                backgroundColor: 'rgba(102,126,234,0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#667eea',
                pointBorderWidth: 2,
                pointRadius: 5
            },
            {
                label: 'Pengembalian',
                data: @json($chartData->pluck('kembali')),
                borderColor: '#11998e',
                backgroundColor: 'rgba(17,153,142,0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#11998e',
                pointBorderWidth: 2,
                pointRadius: 5
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' }
        },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 } }
        }
    }
});

// Doughnut chart — Buku Populer
new Chart(document.getElementById('chartBuku'), {
    type: 'doughnut',
    data: {
        labels: @json($bukuPopuler->pluck('judul')),
        datasets: [{
            data: @json($bukuPopuler->pluck('transaksis_count')),
            backgroundColor: ['#667eea','#11998e','#fa709a','#4facfe','#a18cd1'],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        cutout: '55%',
        plugins: { legend: { position: 'bottom', labels: { padding: 12 } } }
    }
});
</script>
@endpush
@endsection