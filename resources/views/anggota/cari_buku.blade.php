<!-- resources/views/anggota/cari_buku.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Hasil Pencarian Buku</h2>

    <form action="{{ route('anggota.cariBuku') }}" method="GET">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari Buku" name="keyword" value="{{ $keyword }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>ISBN</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Kategori</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($result as $index => $buku)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $buku->nomor_buku }}</td>
                <td>{{ $buku->judul_buku }}</td>
                <td>{{ $buku->pengarang }}</td>
                <td>{{ $buku->penerbit }}</td>
                <td>{{ $buku->tahun_terbit }}</td>
                <td>{{ $buku->kategori }}</td>
                <!-- Tambahkan kolom stok -->
                <td>{{ $buku->stok }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8">Tidak ada hasil yang ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection