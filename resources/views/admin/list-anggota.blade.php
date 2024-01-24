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
                <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
            </tr>
            @empty
            <tr>
                <td colspan="4">Tidak ada anggota.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection