<footer class="text-white pt-5 pb-3 mt-auto" style="background-color: #0a1628;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-5 mb-4 mb-md-0">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-book-fill me-2" style="color: #4e9fff;"></i>Sistem Perpustakaan
                </h5>
                <p class="text-white-50 small mb-0">
                    Sistem Manajemen Perpustakaan menggunakan Laravel 12.<br>
                    Kelola buku, anggota, dan transaksi dengan mudah.
                </p>
            </div>
            <div class="col-md-3 mb-4 mb-md-0">
                <h6 class="fw-bold text-uppercase mb-3" style="color: #4e9fff;">Menu</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('dashboard') }}" class="text-white-50 text-decoration-none">
                            <i class="bi bi-speedometer2 me-1"></i> Home
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('buku.index') }}" class="text-white-50 text-decoration-none">
                            <i class="bi bi-book me-1"></i> Buku
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('anggota.index') }}" class="text-white-50 text-decoration-none">
                            <i class="bi bi-people me-1"></i> Anggota
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('transaksi.index') }}" class="text-white-50 text-decoration-none">
                            <i class="bi bi-arrow-left-right me-1"></i> Transaksi
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold text-uppercase mb-3" style="color: #4e9fff;">Kontak</h6>
                <ul class="list-unstyled text-white-50 small">
                    <li class="mb-2"><i class="bi bi-envelope me-2"></i>perpustakaan@example.com</li>
                    <li class="mb-2"><i class="bi bi-telephone me-2"></i>(021) 1234-5678</li>
                    <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Jl. Perpustakaan No. 1, Jakarta</li>
                </ul>
            </div>
        </div>
        <hr class="border-secondary">
        <div class="row">
            <div class="col text-center text-white-50 small">
                <p class="mb-0">
                    &copy; {{ date('Y') }} Sistem Perpustakaan.
                    Built with <i class="bi bi-heart-fill text-danger"></i> using Laravel 12.
                </p>
            </div>
        </div>
    </div>
</footer>