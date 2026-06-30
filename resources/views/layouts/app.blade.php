<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Perpustakaan Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <!-- SweetAlert2 -->
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
    </head>
    <body class="font-sans antialiased d-flex flex-column min-vh-100 bg-light">
        <div class="d-flex flex-column flex-grow-1">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow-1">
                @if(trim($__env->yieldContent('content')))
                    {{-- Section-based content (Bootstrap views) --}}
                    <div class="py-4">
                        <div class="container">
                            @yield('content')
                        </div>
                    </div>
                @else
                    {{-- Component-based content (Tailwind views) --}}
                    <div class="py-4">
                        <div class="container">
                            {{ $slot ?? '' }}
                        </div>
                    </div>
                @endif
            </main>
        </div>

        <footer class="bg-white py-5 mt-auto border-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h5 class="fw-bold"><i class="bi bi-book-fill text-primary me-2"></i>Sistem Perpustakaan</h5>
                        <p class="text-muted small">Sistem Manajemen Perpustakaan menggunakan Laravel 12</p>
                    </div>
                    <div class="col-md-3 mb-4 mb-md-0">
                        <h5 class="fw-bold">Menu</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('dashboard') }}" class="text-decoration-none text-primary">Home</a></li>
                            <li class="mb-2"><a href="{{ route('buku.index') }}" class="text-decoration-none text-primary">Buku</a></li>
                            <li class="mb-2"><a href="{{ route('anggota.index') }}" class="text-decoration-none text-primary">Anggota</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5 class="fw-bold">Kontak</h5>
                        <ul class="list-unstyled text-muted small">
                            <li class="mb-2"><i class="bi bi-envelope me-2"></i>perpustakaan@example.com</li>
                            <li class="mb-2"><i class="bi bi-telephone me-2"></i>(021) 1234-5678</li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @stack('scripts')
    </body>
</html>
