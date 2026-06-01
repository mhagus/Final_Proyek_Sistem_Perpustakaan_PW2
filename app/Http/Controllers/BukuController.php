<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::latest()->get();
        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', 0)->count();
        
        return view('buku.index', compact('bukus', 'totalBuku', 'bukuTersedia', 'bukuHabis'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
    }

    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.show', compact('buku'));
    }

    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
    }
    
    public function filterKategori($kategori)
    {
        $bukus = Buku::where('kategori', $kategori)->latest()->get();
        $totalBuku = $bukus->count();
        $bukuTersedia = $bukus->where('stok', '>', 0)->count();
        $bukuHabis = $bukus->where('stok', 0)->count();
        
        return view('buku.index', compact('bukus', 'totalBuku', 'bukuTersedia', 'bukuHabis', 'kategori'));
    }

    public function search(Request $request)
    {
        $query = Buku::query();

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->keyword . '%')
                  ->orWhere('pengarang', 'like', '%' . $request->keyword . '%')
                  ->orWhere('penerbit', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun_terbit', $request->tahun);
        }

        if ($request->filled('ketersediaan')) {
            if ($request->ketersediaan === 'Tersedia') {
                $query->where('stok', '>', 0);
            } elseif ($request->ketersediaan === 'Habis') {
                $query->where('stok', 0);
            }
        }

        $bukus = $query->latest()->get();
        $totalBuku = $bukus->count();
        $bukuTersedia = $bukus->where('stok', '>', 0)->count();
        $bukuHabis = $bukus->where('stok', 0)->count();

        return view('buku.index', compact('bukus', 'totalBuku', 'bukuTersedia', 'bukuHabis'));
    }
}