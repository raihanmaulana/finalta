@extends('public.index')
@section('css')
<link rel="stylesheet" href="{{ asset('css/galeri.css') }}" />
@endsection
@section('content')
<section id="header">
    <div class="container">
        <div class="middle pb-5" data-aos="zoom-in-up">
            <h1 class="text-white text-shadow fw-bold">Galeri</h1>
            <p class="text-shadow text-white">Perpustakaan SMA Negeri 1 Tunjungan</p>
        </div>
    </div>
</section>
<div class="container px-3 pt-2 pb-5">
    {{-- <p align="center">Dokumentasi Perpustakaan SMA Negeri 1 Tunjungan</p> --}}
    <div class="row g-3 mt-3">
        @foreach ($galeriItems as $item)
        <div class="col-md-4">
            <div class="card h-100">
                <img src="{{ asset($item->path_gambar) }}" class="card-img-top" width="100%" height="240px" alt="{{ $item->judul }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection