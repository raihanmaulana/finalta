@extends('layouts.app')

@section('content')
<div class="container">
    <h2>List Anggota</h2>

    <!-- Tabel atau daftar anggota -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Anggota</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th> <!-- Tambahkan kolom aksi -->
                <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            @forelse ($anggotaList as $index => $anggota)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $anggota->nomor_anggota }}</td>
                <td>{{ $anggota->nama_anggota }}</td>
                <td>{{ $anggota->email }}</td>
                <td>
                    <a href="{{ route('admin.showAnggota', ['id' => $anggota->id]) }}" class="btn btn-info btn-sm">Detail</a>
                    <!-- Ganti 'admin.showAnggota' dengan nama route dan parameter yang sesuai -->
                </td>
                <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
            </tr>
            @empty
            <tr>
                <td colspan="5">Tidak ada anggota.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection