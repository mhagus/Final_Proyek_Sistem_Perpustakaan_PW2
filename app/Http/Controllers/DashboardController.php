<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', '<=', 0)->count();

        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count();
        $anggotaNonaktif = Anggota::where('status', '!=', 'Aktif')->count();

        $totalTransaksi = Transaksi::count();
        $sedangDipinjam = Transaksi::where('status', 'Dipinjam')->count();
        $transaksiHariIni = Transaksi::whereDate('created_at', today())->count();

        $bukuTerbaru = Buku::latest()->take(5)->get();
        $anggotaTerbaru = Anggota::latest()->take(5)->get();

        // Tugas 3: Data buku terlambat untuk dashboard widget
        $transaksiTerlambat = Transaksi::with(['anggota', 'buku'])
            ->where('status', 'Dipinjam')
            ->where('tanggal_kembali', '<', now())
            ->latest()
            ->get();

        $jumlahTerlambat = $transaksiTerlambat->count();

        return view('dashboard', compact(
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonaktif',
            'totalTransaksi',
            'sedangDipinjam',
            'transaksiHariIni',
            'bukuTerbaru',
            'anggotaTerbaru',
            'transaksiTerlambat',
            'jumlahTerlambat'
        ));
    }
}