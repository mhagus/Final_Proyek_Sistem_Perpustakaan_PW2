<div class="card mb-3 shadow-sm border-0" style="border-left: 4px solid #0d6efd !important;">
    <div class="card-body">
        <div class="row align-items-center">
            
            <div class="col-md-2 text-center">
                <i class="bi bi-book text-primary" style="font-size: 3rem;"></i>
                <div class="mt-2">
                    <span class="badge bg-primary">{{ $buku->kategori ?? 'Umum' }}</span>
                </div>
            </div>
            
            <div class="col-md-7">
                <h5 class="card-title fw-bold mb-1">
                    <a href="{{ route('buku.show', $buku->id) }}" class="text-decoration-none text-dark">
                        {{ $buku->judul }}
                    </a>
                </h5>
                <p class="card-text text-muted small mb-2">
                    <i class="bi bi-person"></i> {{ $buku->pengarang }} | 
                    <i class="bi bi-building"></i> {{ $buku->penerbit }} | 
                    <i class="bi bi-calendar"></i> {{ $buku->tahun_terbit }}
                </p>
            </div>
            
            <div class="col-md-3 text-md-end text-start mt-3 mt-md-0">
                <h5 class="text-primary fw-bold mb-2">
                    Rp {{ number_format($buku->harga, 0, ',', '.') }}
                </h5>
                <div>
                    @if ($buku->stok > 0)
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle"></i> Tersedia ({{ $buku->stok }})
                        </span>
                    @else
                        <span class="badge bg-danger">
                            <i class="bi bi-x-circle"></i> Habis
                        </span>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</div>