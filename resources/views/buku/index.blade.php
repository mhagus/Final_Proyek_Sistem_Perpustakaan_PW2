@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="bi bi-book"></i>
        Daftar Buku
    </h1>
    <a href="{{ route('buku.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Buku
    </a>
</div>

{{-- Statistik Cards --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Buku</h6>
                        <h2 class="mb-0">{{ $totalBuku }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="bi bi-book-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Tersedia</h6>
                        <h2 class="mb-0">{{ $bukuTersedia }}</h2>
                    </div>
                    <div class="text-success">
                        <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Habis</h6>
                        <h2 class="mb-0">{{ $bukuHabis }}</h2>
                    </div>
                    <div class="text-danger">
                        <i class="bi bi-x-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Form Search & Filter Advanced (Tugas 3) --}}
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h6 class="card-title fw-bold mb-3">
            <i class="bi bi-search"></i> Pencarian & Filter Advanced
        </h6>
        <form action="{{ route('buku.search') }}" method="GET" class="row g-3">
            
            <div class="col-md-4">
                <label for="keyword" class="form-label small text-muted">Kata Kunci</label>
                <input type="text" class="form-control form-control-sm" id="keyword" name="keyword" 
                       placeholder="Cari Judul, Pengarang, atau Penerbit..." 
                       value="{{ request('keyword') }}">
            </div>
            
            <div class="col-md-3">
                <label for="kategori" class="form-label small text-muted">Kategori</label>
                <select class="form-select form-select-sm" id="kategori" name="kategori">
                    <option value="">Semua Kategori</option>
                    <option value="Programming" {{ request('kategori') == 'Programming' ? 'selected' : '' }}>Programming</option>
                    <option value="Database" {{ request('kategori') == 'Database' ? 'selected' : '' }}>Database</option>
                    <option value="Web Design" {{ request('kategori') == 'Web Design' ? 'selected' : '' }}>Web Design</option>
                    <option value="Networking" {{ request('kategori') == 'Networking' ? 'selected' : '' }}>Networking</option>
                    <option value="Data Science" {{ request('kategori') == 'Data Science' ? 'selected' : '' }}>Data Science</option>
                </select>
            </div>
            
            <div class="col-md-2">
                <label for="tahun" class="form-label small text-muted">Tahun Terbit</label>
                <select class="form-select form-select-sm" id="tahun" name="tahun">
                    <option value="">Semua Tahun</option>
                    @for($i = date('Y'); $i >= 2000; $i--)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-2">
                <label for="ketersediaan" class="form-label small text-muted">Ketersediaan</label>
                <select class="form-select form-select-sm" id="ketersediaan" name="ketersediaan">
                    <option value="">Semua</option>
                    <option value="Tersedia" {{ request('ketersediaan') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Habis" {{ request('ketersediaan') == 'Habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>
            
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>
        @if(request()->anyFilled(['keyword', 'kategori', 'tahun', 'ketersediaan']))
            <div class="mt-2 text-end">
                <a href="{{ route('buku.index') }}" class="btn btn-link btn-sm text-danger text-decoration-none">
                    <i class="bi bi-x-circle"></i> Reset Filter
                </a>
            </div>
        @endif
    </div>
</div>

{{-- Daftar Buku menggunakan Blade Component (Tugas 2) --}}
@forelse ($bukus as $buku)
    <x-buku-card :buku="$buku" />
@empty
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        Tidak ada data buku yang sesuai dengan pencarian atau filter Anda.
    </div>
@endforelse

@if ($bukus->count() > 0)
    <div class="text-center mt-4">
        <p class="text-muted">
            Menampilkan {{ $bukus->count() }} buku
            @if(request()->anyFilled(['keyword', 'kategori', 'tahun', 'ketersediaan']))
                sesuai filter pencarian
            @endif
        </p>
    </div>
@endif
@endsection