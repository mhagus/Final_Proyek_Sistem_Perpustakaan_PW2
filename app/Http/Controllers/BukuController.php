<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukus = Buku::latest()->get();
        
        // Statistik untuk card
        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', 0)->count();
        
        // Return view dengan data
        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBukuRequest $request)
    {
        try {
            // Create buku baru dengan validated data
            Buku::create($request->validated());

            // Redirect dengan success message
            return redirect()->route('buku.index')
                             ->with('success', 'Buku berhasil ditambahkan!');
                             
        } catch (\Exception $e) {
            // Redirect dengan error message jika gagal
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal menambahkan buku: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);

        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBukuRequest $request, string $id)
    {
        try {
            $buku = Buku::findOrFail($id);

            // Update buku dengan validated data
            $buku->update($request->validated());

            // Redirect dengan success message
            return redirect()->route('buku.show', $buku->id)
                             ->with('success', 'Buku berhasil diupdate!');

        } catch (\Exception $e) {
            // Redirect dengan error message jika gagal
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal mengupdate buku: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $buku = Buku::findOrFail($id);
            $judulBuku = $buku->judul;
            
            // Delete buku
            $buku->delete();
            
            // Redirect dengan success message
            return redirect()->route('buku.index')
                             ->with('success', "Buku '{$judulBuku}' berhasil dihapus!");
                             
        } catch (\Exception $e) {
            // Redirect dengan error message jika gagal
            return redirect()->back()
                             ->with('error', 'Gagal menghapus buku: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus data buku terpilih secara massal (Bulk Delete).
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'buku_ids' => 'required|array',
            'buku_ids.*' => 'exists:buku,id'
        ]);

        try {
            Buku::whereIn('id', $request->buku_ids)->delete();
            return redirect()->route('buku.index')
                ->with('success', count($request->buku_ids) . ' data buku berhasil dihapus secara massal!');
        } catch (\Exception $e) {
            return redirect()->route('buku.index')
                ->with('error', 'Gagal menghapus data massal: ' . $e->getMessage());
        }
    }
    
    /**
     * Mengunduh seluruh data koleksi buku dalam bentuk file CSV.
     */
    public function exportCsv()
    {
        $bukus = Buku::all();

        $filename = 'buku_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($bukus) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Kode Buku', 'Judul', 'Kategori', 'Pengarang',
                'Penerbit', 'Tahun', 'ISBN', 'Harga', 'Stok'
            ]);

            foreach ($bukus as $buku) {
                fputcsv($file, [
                    $buku->kode_buku,
                    $buku->judul,
                    $buku->kategori,
                    $buku->pengarang,
                    $buku->penerbit,
                    $buku->tahun_terbit,
                    $buku->isbn,
                    $buku->harga,
                    $buku->stok,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Memfilter data buku berdasarkan kategori.
     */
    public function filterKategori($kategori) 
    {
        $bukus = Buku::where('kategori', $kategori)->latest()->get();

        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', 0)->count();

        return view('buku.index', compact(
            'bukus', 'totalBuku', 'bukuTersedia', 'bukuHabis', 'kategori'
        ));
    }

    /**
     * Mencari dan memfilter data buku secara advanced.
     */
    public function search(Request $request)
    {
        $query = Buku::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('pengarang', 'like', "%{$keyword}%")
                  ->orWhere('penerbit', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun_terbit', $request->tahun);
        }

        // Disinkronkan dengan name="stok" pada form blade kamu
        if ($request->filled('stok')) {
            if ($request->stok == 'tersedia') {
                $query->where('stok', '>', 0);
            } elseif ($request->stok == 'habis') {
                $query->where('stok', '<=', 0);
            }
        }

        $bukus = $query->latest()->get();

        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', 0)->count();

        // Mengirimkan kembali input agar data di form search tidak reset setelah klik "Cari"
        $searchInput = $request->all();

        return view('buku.index', compact(
            'bukus', 'totalBuku', 'bukuTersedia', 'bukuHabis', 'searchInput'
        ));
    }
}