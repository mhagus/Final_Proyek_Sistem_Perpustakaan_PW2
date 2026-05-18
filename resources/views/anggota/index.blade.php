@extends('layouts.app')

@section('title', 'Daftar Anggota Perpustakaan')

@section('content')
    <h1 class="mb-4">Daftar Anggota Perpustakaan</h1>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Kode Anggota</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggota_list as $index => $anggota)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $anggota['kode'] }}</td>
                <td>{{ $anggota['nama'] }}</td>
                <td>{{ $anggota['email'] }}</td>
                <td>
                    @if ($anggota['status'] == 'Aktif')
                        <span class="badge bg-success">{{ $anggota['status'] }}</span>
                    @else
                        <span class="badge bg-danger">{{ $anggota['status'] }}</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('anggota.show', $anggota['id']) }}" class="btn btn-info btn-sm">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection