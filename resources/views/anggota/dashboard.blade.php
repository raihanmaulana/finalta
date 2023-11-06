@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Selamat datang di Halaman Anggota</h1>
                <a href="{{ route('anggota.logout') }}" class="btn btn-danger">Logout</a>
            </div>

            <div class="module-body">
                <p><a href="{{ URL::route('search-book') }}"><strong>Cari Buku</strong></a></p>
            </div>
        </div>
    </div>
</div>
@endsection