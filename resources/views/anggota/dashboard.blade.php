@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Selamat datang di Halaman Anggota</h1>
            <p>Selamat datang, {{ auth()->user()->name }}!</p>

            <!-- Tambahkan konten tambahan untuk halaman anggota di sini -->
        </div>
    </div>
</div>
@endsection