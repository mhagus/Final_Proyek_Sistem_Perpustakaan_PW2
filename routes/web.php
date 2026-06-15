<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Fitur Search Advanced
Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

// Fitur Filter Kategori
Route::get('/buku/kategori/{kategori}', [BukuController::class, 'filterKategori'])->name('buku.kategori');

//  Export CSV 
Route::get('/buku/export/csv', [BukuController::class, 'exportCsv'])->name('buku.export');

//  Bulk Delete 
Route::delete('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])->name('buku.bulk-delete');

// custom route untuk export anggota
Route::get('/anggota/export', [AnggotaController::class, 'export'])->name('anggota.export');
Route::get('/anggota/search', [AnggotaController::class, 'search'])->name('anggota.search');

// Route Resource Utama
Route::resource('buku', BukuController::class);

Route::resource('anggota', AnggotaController::class);