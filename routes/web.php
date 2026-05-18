<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\KategoriController;
 
Route::get('/', function () {
    return view('welcome');
});
 
// Route menggunakan Controller
Route::get('/perpustakaan', [PerpustakaanController::class, 'index']);
Route::get('/buku/{id}', [PerpustakaanController::class, 'show']);
Route::get('/about', [PerpustakaanController::class, 'about']);


Route::get('/anggota', function () {
    // Data anggota 
    $anggota_list = [
        [
            'id' => 1,
            'kode' => 'AGT-011',
            'nama' => 'Hendra Wijaya',
            'email' => 'hendra.w@email.com',
            'telepon' => '082198765432',
            'alamat' => 'Medan',
            'status' => 'Aktif'
        ],
        [
            'id' => 2,
            'kode' => 'AGT-012',
            'nama' => 'Citra Lestari',
            'email' => 'citra.les@email.com',
            'telepon' => '085211223344',
            'alamat' => 'Malang',
            'status' => 'Aktif'
        ],
        [
            'id' => 3,
            'kode' => 'AGT-013',
            'nama' => 'Aditya Nugraha',
            'email' => 'aditya.nug@email.com',
            'telepon' => '087755667788',
            'alamat' => 'Makassar',
            'status' => 'Tidak Aktif'
        ],
        [
            'id' => 4,
            'kode' => 'AGT-014',
            'nama' => 'Putri Utami',
            'email' => 'putri.utami@email.com',
            'telepon' => '081399887766',
            'alamat' => 'Denpasar',
            'status' => 'Aktif'
        ],
        [
            'id' => 5,
            'kode' => 'AGT-015',
            'nama' => 'Farhan Ramadhan',
            'email' => 'farhan.r@email.com',
            'telepon' => '081922334455',
            'alamat' => 'Palembang',
            'status' => 'Tidak Aktif'
        ],
    ];

    return view('anggota.index', compact('anggota_list'));
})->name('anggota.index');

Route::get('/anggota/{id}', function ($id) {
    // Detail anggota 
    $anggota_list = [
        [
            'id' => 1,
            'kode' => 'AGT-011',
            'nama' => 'Hendra Wijaya',
            'email' => 'hendra.w@email.com',
            'telepon' => '082198765432',
            'alamat' => 'Medan',
            'status' => 'Aktif'
        ],
        [
            'id' => 2,
            'kode' => 'AGT-012',
            'nama' => 'Citra Lestari',
            'email' => 'citra.les@email.com',
            'telepon' => '085211223344',
            'alamat' => 'Malang',
            'status' => 'Aktif'
        ],
        [
            'id' => 3,
            'kode' => 'AGT-013',
            'nama' => 'Aditya Nugraha',
            'email' => 'aditya.nug@email.com',
            'telepon' => '087755667788',
            'alamat' => 'Makassar',
            'status' => 'Tidak Aktif'
        ],
        [
            'id' => 4,
            'kode' => 'AGT-014',
            'nama' => 'Putri Utami',
            'email' => 'putri.utami@email.com',
            'telepon' => '081399887766',
            'alamat' => 'Denpasar',
            'status' => 'Aktif'
        ],
        [
            'id' => 5,
            'kode' => 'AGT-015',
            'nama' => 'Farhan Ramadhan',
            'email' => 'farhan.r@email.com',
            'telepon' => '081922334455',
            'alamat' => 'Palembang',
            'status' => 'Tidak Aktif'
        ],
    ];

    
    if ($id < 1 || $id > count($anggota_list)) {
        abort(404);
    }

    
    $anggota = $anggota_list[$id - 1];

    return view('anggota.show', compact('anggota'));

})->name('anggota.show');


// Route kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/search/{keyword}', [KategoriController::class, 'search'])->name('kategori.search');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');