@extends('layouts.layout')

@section('customcss')
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{asset('css/utama/style.css')}}" />
    <link rel="stylesheet" href="{{asset('css/utama/dashboard.css')}}" />


    <head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="{{ asset('css/images/logo.png') }}" type="image/x-icon">
  <title>Perpustakaan SMAN 1 Tunjungan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>
    
    @endsection

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