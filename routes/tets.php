<?php
 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
 
Route::get('/', function () {
    return view('welcome');
});
 
// Route test koneksi database
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        
        return "Koneksi database berhasil!<br />Database: <strong>{$dbName}</strong>";
    } catch (\Exception $e) {
        return "Koneksi database gagal!<br />Error: " . $e->getMessage();
    }
});