@extends('layouts.app')

@section('title', 'Detail Anggota - ' . $anggota['nama'])

@section('content')
    <h1 class="mb-4">Detail Anggota</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ $anggota['nama'] }}</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">Kode Anggota</th>
                    <td>{{ $anggota['kode'] }}</td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $anggota['nama'] }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $anggota['email'] }}</td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td>{{ $anggota['telepon'] }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $anggota['alamat'] }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if ($anggota['status'] == 'Aktif')
                            <span class="badge bg-success">{{ $anggota['status'] }}</span>
                        @else
                            <span class="badge bg-danger">{{ $anggota['status'] }}</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
@endsection