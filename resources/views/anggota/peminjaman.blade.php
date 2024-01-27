@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Form Peminjaman Buku</h2>

    <!-- Form Peminjaman -->
    <form action="{{ route('anggota.peminjaman.store') }}" method="POST">
        @csrf

        <!-- Pilih Buku -->
        <div class="form-group">
            <label for="id_buku">Pilih Buku:</label>
            <select name="id_buku" id="id_buku" class="form-control">
                <!-- Tampilkan daftar buku yang tersedia -->
                @foreach($daftarBukuTersedia as $buku)
                <option value="{{ $buku->id_buku }}">{{ $buku->judul_buku }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
    </form>

    <hr>

    <!-- Daftar Permintaan Peminjaman -->
    <h2>Daftar Permintaan Peminjaman</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Nama Anggota</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- Tampilkan daftar permintaan peminjaman -->
            @forelse($daftarPeminjaman as $index => $peminjaman)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ optional($peminjaman->buku)->judul_buku }}</td>
                <td>{{ $peminjaman->anggota->nama_anggota ?? 'Default Name' }}</td>
                <td>{{ $peminjaman->status == 0 ? 'Pending' : ($peminjaman->status == 1 ? 'Approved' : 'Sudah Dikembalikan') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Tidak ada permintaan peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @endsection