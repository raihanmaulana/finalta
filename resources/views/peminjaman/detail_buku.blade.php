@extends('peminjaman.index')

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Detail Buku</h3>
        </div>
        <div class="module-body">
            <div class="row-fluid">
                <div class="span6">
                    <h5>Judul Buku:</h5>
                    <p>{{ $book->judul_buku }}</p>

                    <h5>ISBN:</h5>
                    <p>{{ $book->isbn }}</p>

                    <h5>Penerbit:</h5>
                    <p>{{ $book->penerbit }}</p>

                    <h5>Pengarang:</h5>
                    <p>{{ $book->pengarang }}</p>

                    <h5>Tahun Terbit:</h5>
                    <p>{{ $book->tahun_terbit }}</p>

                    <h5>Kategori:</h5>
                    <p>{{ $category->kategori }}</p>


                    <h5>Tersedia:</h5>
                    <p>{{ $book->tersedia }}</p>
                </div>

                @if ($book->tautan_buku)
                <h5>Tautan Buku: <a href="{{ $book->tautan_buku }}" target="_blank">{{ $book->tautan_buku }}</a></h5>
                @else
                <h5>Tautan Buku:</h5>
                <p> Tidak Tersedia </p>
                @endif

                <h5>Gambar Buku:</h5>
                <div class="span6">
                    <img src="{{ asset('storage/' . $book->image) }}" alt="Gambar Buku" style="max-width: 200px; max-height: 200px;">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <a href="/offline" class="btn btn-primary">Kembali ke Halaman Offline</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection