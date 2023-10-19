@extends('layouts.app')

@section('content')
<h1>Buat Permintaan Peminjaman Buku</h1>
<form method="post" action="{{ route('anggota.simpan-permintaan') }}">
    @csrf
    <input type="text" name="judul_buku" placeholder="Judul Buku" required>
    <input type="date" name="tanggal_peminjaman" required>
    <button type="submit">Kirim Permintaan</button>
</form>
@endsection