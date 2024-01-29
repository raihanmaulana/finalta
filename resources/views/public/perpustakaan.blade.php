@extends('layouts.navbar')

@section('content')
<div class="container">
    <h2>Perpustakaan</h2>

    <!-- Tombol Login dan Register untuk Anggota -->
    <a href="{{ route('anggota.login') }}" class="btn btn-primary">Login Anggota</a>
    <a href="{{ route('anggota.register') }}" class="btn btn-success">Register Anggota</a>

    <hr>

    <!-- Tombol Login dan Register untuk Admin/User -->
    <a href="{{ route('account-sign-in') }}" class="btn btn-primary">Login Admin</a>
    <a href="{{ route('account-create') }}" class="btn btn-success">Register Admin</a>

    <hr>

    <!-- Daftar Buku -->
    <a href="{{ route('semuabuku') }}" class="btn btn-info">Daftar Buku</a>

    <hr>

    <!-- Fitur Cari Buku -->
    <form action="{{ route('search-book') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari buku..." name="keyword">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </div>
    </form>
</div>
@endsection