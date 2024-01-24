<!-- resources/views/admin/daftar-peminjaman.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Permintaan Peminjaman</h2>

    <!-- Daftar Permintaan Peminjaman untuk Disetujui -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Anggota</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Tampilkan daftar permintaan peminjaman -->
            @forelse($permintaanPeminjaman as $index => $peminjaman)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $peminjaman->anggota->id_anggota ?? 'Default ID' }}</td>
                <td>{{ $peminjaman->anggota->nama_anggota ?? 'Default Name' }}</td>
                <td>{{ $peminjaman->buku->judul_buku ?? 'Default Title' }}</td>

                <td>
                    @if($peminjaman->status == 0)
                    'Pending'
                    @else
                    'Approved'
                    @endif
                </td>
                <td>
                    @if($peminjaman->status == 0)
                    <!-- Tombol Setujui -->
                    <form action="{{ route('admin.peminjaman.approve', $peminjaman->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Setujui</button>
                    </form>
                    @else
                    <span class="text-success">Sudah Disetujui</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Tidak ada permintaan peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection