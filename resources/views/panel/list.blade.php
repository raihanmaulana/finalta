<!-- resources/views/admin/peminjaman/list.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Permintaan Peminjaman Buku</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $item)
            <tr>
                <td>{{ $item->anggota->name }}</td>
                <td>{{ $item->judul_buku }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    @if ($item->status == 'menunggu')
                    <a href="{{ route('admin.peminjaman.approve', ['id' => $item->id]) }}" class="btn btn-success">Setujui</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection