<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerpustakaanController extends Controller
{
    // Method untuk halaman index
    public function index()
    {
        $nama_sistem = "Sistem Perpustakaan Digital Informatika";
        $versi = "12.x";
        $total_buku = 5;
        
        $buku_list = [
            [
                'id' => 1,
                'judul' => 'Pengenalan Deep Learning',
                'pengarang' => 'Dr. Indah Lestari',
                'harga' => 95000,
                'stok' => 15
            ],
            [
                'id' => 2,
                'judul' => 'Arsitektur Cloud & Microservices',
                'pengarang' => 'Kevin Sanjaya',
                'harga' => 145000,
                'stok' => 7
            ],
            [
                'id' => 3,
                'judul' => 'Ethical Hacking & Keamanan Siber',
                'pengarang' => 'Ahmad Faisal',
                'harga' => 115000,
                'stok' => 0
            ],
            [
                'id' => 4,
                'judul' => 'Analisis & Desain Sistem dengan UML',
                'pengarang' => 'Rian Kurniawan',
                'harga' => 88000,
                'stok' => 9
            ],
            [
                'id' => 5,
                'judul' => 'Big Data & Visualisasi Data',
                'pengarang' => 'Mega Utami',
                'harga' => 130000,
                'stok' => 12
            ]
        ];
        
        return view('perpustakaan.index', compact('nama_sistem', 'versi', 'total_buku', 'buku_list'));
    }
    
    // Method untuk detail buku
    public function show($id)
    {
        
        $buku_list = [
            1 => [
                'id' => 1,
                'judul' => 'Pengenalan Deep Learning',
                'pengarang' => 'Dr. Indah Lestari',
                'penerbit' => 'TechPress Indonesia',
                'tahun' => 2024,
                'harga' => 95000,
                'stok' => 15,
                'deskripsi' => 'Panduan praktis memahami jaringan saraf tiruan dan implementasinya menggunakan framework modern Python.'
            ],
            2 => [
                'id' => 2,
                'judul' => 'Arsitektur Cloud & Microservices',
                'pengarang' => 'Kevin Sanjaya',
                'penerbit' => 'Media Komputindo',
                'tahun' => 2025,
                'harga' => 145000,
                'stok' => 7,
                'deskripsi' => 'Mendesain arsitektur sistem skala besar yang reliable, scalable, dan deployable di lingkungan cloud.'
            ],
            3 => [
                'id' => 3,
                'judul' => 'Ethical Hacking & Keamanan Siber',
                'pengarang' => 'Ahmad Faisal',
                'penerbit' => 'SiberMedia',
                'tahun' => 2023,
                'harga' => 115000,
                'stok' => 0,
                'deskripsi' => 'Eksplorasi teknik penetration testing tepercaya untuk menemukan celah keamanan dan proteksi infrastruktur TI.'
            ],
            4 => [
                'id' => 4,
                'judul' => 'Analisis & Desain Sistem dengan UML',
                'pengarang' => 'Rian Kurniawan',
                'penerbit' => 'Penerbit Andi',
                'tahun' => 2024,
                'harga' => 88000,
                'stok' => 9,
                'deskripsi' => 'Pendekatan analisis berorientasi objek menggunakan diagram Use Case, Activity, Sequence, hingga Class diagram.'
            ],
            5 => [
                'id' => 5,
                'judul' => 'Big Data & Visualisasi Data',
                'pengarang' => 'Mega Utami',
                'penerbit' => 'Informatika Utama',
                'tahun' => 2025,
                'harga' => 130000,
                'stok' => 12,
                'deskripsi' => 'Strategi mengolah dataset bervolume tinggi menjadi insight bisnis yang interaktif melalui visualisasi data eksekutif.'
            ]
        ];
        
        
        if (!isset($buku_list[$id])) {
            abort(404, 'Buku tidak ditemukan');
        }
        
        $buku = $buku_list[$id];
        
        return view('perpustakaan.show', compact('buku'));
    }
    
    // Method untuk halaman about
    public function about()
    {
        $info = [
            'nama' => 'Sistem Perpustakaan Laravel',
            'versi' => '1.0.0',
            'deskripsi' => 'Sistem manajemen perpustakaan berbasis arsitektur MVC menggunakan framework Laravel.',
            'developer' => 'Muhammad Agus',
            'tahun' => date('Y')
        ];
        
        return view('perpustakaan.about', compact('info'));
    }
}