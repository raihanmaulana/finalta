@extends('layout.index')

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
                    <p>{{ $book->nomor_buku }}</p>

                    <h5>Penerbit:</h5>
                    <p>{{ $book->penerbit }}</p>

                    <h5>Pengarang:</h5>
                    <p>{{ $book->pengarang }}</p>

                    <h5>Tahun Terbit:</h5>
                    <p>{{ $book->tahun_terbit }}</p>

                    <h5>Kategori:</h5>
                    <p>{{ $category->kategori }}</p>

                    <h5>Stok Buku:</h5>
                    <p>{{ $book->stok }}</p>
                </div>
            </div>
            <div class="row-fluid mt-3">
                <div class="span12">
                    <a href="{{ URL::route('all-books') }}" class="btn btn-inverse">Kembali ke Semua Buku</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection