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
                <th>Aksi</th> <!-- Tambah kolom untuk tombol kembalikan -->
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
                <td>
                    @if($peminjaman->status == 1)
                    <!-- Tombol Kembalikan -->
                    <form action="{{ route('admin.peminjaman.kembalikan', $peminjaman->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-warning">Kembalikan</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Tidak ada buku yang dipinjam.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection