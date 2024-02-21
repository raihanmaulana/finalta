@extends('layout.index')

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Detail Galeri</h3>
        </div>
        <div class="module-body">
            <div class="mx-auto" style="max-width: 600px;">
                <img src="{{ asset('storage/' . $galeri->gambar_galeri) }}" alt="{{ $galeri->judul }}" style="width: 100%;">
                <div class="mt-3">
                    <h5>{{ $galeri->judul }}</h5>
                    <p>{{ $galeri->deskripsi }}</p>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('galeri.manage') }}" class="btn btn-inverse">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection