<?php
 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
 
// Public routes (tanpa auth)
Route::get('/', function () {
    return redirect()->route('login');
});
 
// Protected routes (dengan auth middleware)
Route::middleware(['auth'])->group(function () {
    // Dashboard - menggunakan DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
 
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 
    // Buku - CRUD + Custom routes
    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
    Route::get('/buku/export', [BukuController::class, 'exportCsv'])->name('buku.export');
    Route::delete('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])->name('buku.bulk-delete');
    Route::get('/buku/kategori/{kategori}', [BukuController::class, 'filterKategori'])->name('buku.kategori');
    Route::resource('buku', BukuController::class);
 
    // Anggota - CRUD + Custom routes
    Route::get('/anggota/search', [AnggotaController::class, 'search'])->name('anggota.search');
    Route::get('/anggota/export', [AnggotaController::class, 'export'])->name('anggota.export');
    Route::resource('anggota', AnggotaController::class);
 
    // Transaksi - Custom routes BEFORE resource routes
    Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
    Route::get('/transaksi/export-pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi.export-pdf');
    Route::put('/transaksi/{id}/kembalikan', [TransaksiController::class, 'kembalikan'])->name('transaksi.kembalikan');
    
    // Transaksi - CRUD
    Route::resource('transaksi', TransaksiController::class);

    // Global Search (Praktikum 3)
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    // Laporan (Praktikum 4)
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});
 
require __DIR__.'/auth.php';