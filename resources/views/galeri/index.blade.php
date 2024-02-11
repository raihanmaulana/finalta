@extends('public.index')
@section('css')
<link rel="stylesheet" href="{{ asset('css/utama/galeri.css') }}" />
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
@endsection
@section('content')
<div class="container px-3 pt-2 pb-5">
    <p align="center">Dokumentasi Perpustakaan SMA Negeri 1 Tunjungan</p>
    <div class="row">
        @foreach ($galeri as $item)
        <div class="column">
            <h3>{{ $item->judul }}</h3>
            <div class="span6">
                <img src="{{ asset('storage/' . $item->gambar_galeri) }}" alt="Gambar Buku" style="max-width: 300px; max-height: 300px;">
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="column">
            <img src="{{ asset('storage/' . $item->gambar_galeri) }}" alt="Gambar Buku" style="max-width: 300px; max-height: 300px;">
        </div>
        <div class="column">
            <img src="{{ asset('storage/' . $item->gambar_galeri) }}" alt="Gambar Buku" style="max-width: 300px; max-height: 300px;">
            <div class="column">
                <img src="{{ asset('storage/' . $item->gambar_galeri) }}" alt="Gambar Buku" style="max-width: 300px; max-height: 300px;">
            </div>
        </div>
    </div>
    @endsection