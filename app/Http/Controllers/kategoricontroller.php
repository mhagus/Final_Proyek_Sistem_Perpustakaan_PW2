<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        
        $kategori_list = [
            [
                'id' => 1,
                'nama' => 'Artificial Intelligence',
                'deskripsi' => 'Buku kecerdasan buatan, machine learning, dan sistem pakar',
                'jumlah_buku' => 9
            ],
            [
                'id' => 2,
                'nama' => 'Cloud Computing',
                'deskripsi' => 'Buku arsitektur cloud, komputasi awan, dan devops',
                'jumlah_buku' => 14
            ],
            [
                'id' => 3,
                'nama' => 'Cyber Security',
                'deskripsi' => 'Buku keamanan siber, ethical hacking, dan kriptografi',
                'jumlah_buku' => 22
            ],
            [
                'id' => 4,
                'nama' => 'Software Engineering',
                'deskripsi' => 'Buku rekayasa perangkat lunak, analisis sistem, dan UML',
                'jumlah_buku' => 11
            ],
            [
                'id' => 5,
                'nama' => 'Data Science',
                'deskripsi' => 'Buku analisis data, statistik, big data, dan visualisasi',
                'jumlah_buku' => 17
            ],
        ];

        return view('kategori.index', compact('kategori_list'));
    }

    public function show($id)
    {
        $kategori_list = [
            [
                'id' => 1,
                'nama' => 'Artificial Intelligence',
                'deskripsi' => 'Buku kecerdasan buatan, machine learning, dan sistem pakar',
                'jumlah_buku' => 9
            ],
            [
                'id' => 2,
                'nama' => 'Cloud Computing',
                'deskripsi' => 'Buku arsitektur cloud, komputasi awan, dan devops',
                'jumlah_buku' => 14
            ],
            [
                'id' => 3,
                'nama' => 'Cyber Security',
                'deskripsi' => 'Buku keamanan siber, ethical hacking, dan kriptografi',
                'jumlah_buku' => 22
            ],
            [
                'id' => 4,
                'nama' => 'Software Engineering',
                'deskripsi' => 'Buku rekayasa perangkat lunak, analisis sistem, dan UML',
                'jumlah_buku' => 11
            ],
            [
                'id' => 5,
                'nama' => 'Data Science',
                'deskripsi' => 'Buku analisis data, statistik, big data, dan visualisasi',
                'jumlah_buku' => 17
            ],
        ];

        
        if ($id < 1 || $id > count($kategori_list)) {
            abort(404);
        }

        $kategori = $kategori_list[$id - 1];

        // Data list buku baru
        $buku_list = [
            ['id' => 1, 'judul' => 'Python untuk Machine Learning', 'penulis' => 'Guido van Rossum', 'tahun' => 2024],
            ['id' => 2, 'judul' => 'Panduan Arsitektur Cloud AWS', 'penulis' => 'Andy Jassy', 'tahun' => 2023],
            ['id' => 3, 'judul' => 'Dasar Pentesting & Keamanan Jaringan', 'penulis' => 'Linus Torvalds', 'tahun' => 2025],
        ];

        return view('kategori.show', compact('kategori', 'buku_list'));
    }

    public function search($keyword)
    {
        
        $kategori_list = [
            [
                'id' => 1,
                'nama' => 'Artificial Intelligence',
                'deskripsi' => 'Buku kecerdasan buatan, machine learning, dan sistem pakar',
                'jumlah_buku' => 9
            ],
            [
                'id' => 2,
                'nama' => 'Cloud Computing',
                'deskripsi' => 'Buku arsitektur cloud, komputasi awan, dan devops',
                'jumlah_buku' => 14
            ],
            [
                'id' => 3,
                'nama' => 'Cyber Security',
                'deskripsi' => 'Buku keamanan siber, ethical hacking, dan kriptografi',
                'jumlah_buku' => 22
            ],
            [
                'id' => 4,
                'nama' => 'Software Engineering',
                'deskripsi' => 'Buku rekayasa perangkat lunak, analisis sistem, dan UML',
                'jumlah_buku' => 11
            ],
            [
                'id' => 5,
                'nama' => 'Data Science',
                'deskripsi' => 'Buku analisis data, statistik, big data, dan visualisasi',
                'jumlah_buku' => 17
            ],
        ];

        $hasil = collect($kategori_list)->filter(function ($kategori) use ($keyword) {
            return stripos($kategori['nama'], $keyword) !== false ||
                   stripos($kategori['deskripsi'], $keyword) !== false;
        })->values()->all();

        return view('kategori.search', compact('hasil', 'keyword'));
    }
}