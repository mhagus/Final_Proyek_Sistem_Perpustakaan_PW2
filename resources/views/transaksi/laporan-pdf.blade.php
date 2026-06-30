<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi Perpustakaan</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #1a56db;
        }
        .header h2 {
            margin: 5px 0 0;
            font-size: 14px;
            font-weight: normal;
            color: #666;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 10px;
            color: #999;
        }
        .summary {
            margin-bottom: 20px;
        }
        .summary table {
            width: 100%;
        }
        .summary td {
            padding: 8px 12px;
            background: #f0f4ff;
            border-radius: 4px;
            text-align: center;
            width: 33.33%;
        }
        .summary .label {
            font-size: 10px;
            color: #666;
            display: block;
        }
        .summary .value {
            font-size: 16px;
            font-weight: bold;
            color: #1a56db;
        }
        .summary .value.danger {
            color: #dc2626;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.data th {
            background-color: #1a56db;
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
        }
        table.data td {
            padding: 6px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 10px;
        }
        table.data tr:nth-child(even) {
            background-color: #f9fafb;
        }
        table.data tfoot td {
            font-weight: bold;
            border-top: 2px solid #333;
            padding-top: 8px;
            background-color: #f0f4ff;
        }
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .text-danger {
            color: #dc2626;
        }
        .text-muted {
            color: #9ca3af;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #999;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PERPUSTAKAAN</h1>
        <h2>Laporan Transaksi Peminjaman Buku</h2>
        <p>Dicetak pada: {{ now()->format('d F Y H:i:s') }}</p>
    </div>

    <div class="summary">
        <table>
            <tr>
                <td>
                    <span class="label">Total Transaksi</span>
                    <span class="value">{{ $totalTransaksi }}</span>
                </td>
                <td>
                    <span class="label">Total Denda</span>
                    <span class="value danger">Rp {{ number_format($totalDenda, 0, ',', '.') }}</span>
                </td>
                <td>
                    <span class="label">Sedang Dipinjam</span>
                    <span class="value">{{ $transaksis->where('status', 'Dipinjam')->count() }}</span>
                </td>
            </tr>
        </table>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Tgl Dikembalikan</th>
                <th>Status</th>
                <th>Terlambat</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksis as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->kode_transaksi }}</td>
                    <td>{{ $transaksi->anggota->nama ?? '-' }}</td>
                    <td>{{ $transaksi->buku->judul ?? '-' }}</td>
                    <td>{{ $transaksi->tanggal_pinjam->format('d/m/Y') }}</td>
                    <td>{{ $transaksi->tanggal_kembali->format('d/m/Y') }}</td>
                    <td>
                        @if ($transaksi->tanggal_dikembalikan)
                            {{ $transaksi->tanggal_dikembalikan->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($transaksi->status == 'Dipinjam')
                            <span class="badge badge-warning">Dipinjam</span>
                        @else
                            <span class="badge badge-success">Dikembalikan</span>
                        @endif
                    </td>
                    <td>
                        @if ($transaksi->terlambat > 0)
                            <span class="text-danger">{{ $transaksi->terlambat }} hari</span>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($transaksi->denda > 0)
                            <span class="text-danger">Rp {{ number_format($transaksi->denda, 0, ',', '.') }}</span>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center; padding: 20px;">
                        Tidak ada data transaksi
                    </td>
                </tr>
            @endforelse
        </tbody>
        @if($transaksis->count() > 0)
        <tfoot>
            <tr>
                <td colspan="9" style="text-align: right;">Total Denda:</td>
                <td class="text-danger">Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="footer">
        <p>Laporan ini digenerate otomatis oleh Sistem Perpustakaan &mdash; {{ now()->format('d F Y') }}</p>
    </div>
</body>
</html>
