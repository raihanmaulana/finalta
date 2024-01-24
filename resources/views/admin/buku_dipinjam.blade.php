<!-- resources/views/admin/buku_dipinjam.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buku yang Dipinjam</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Nomor Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bukuDipinjam as $index => $peminjaman)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $peminjaman->anggota->nama_anggota }}</td>
                <td>{{ $peminjaman->anggota->nomor_anggota }}</td>
                <td>{{ $peminjaman->buku->judul_buku }}</td>
                <td>{{ $peminjaman->created_at }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Tidak ada buku yang dipinjam.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection