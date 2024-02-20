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
                    <p>{{ $book->isbn }}</p>

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

                    <h5>Tautan Buku:</h5>
                    @php
                    // Cek apakah tautan buku tidak kosong dan merupakan URL yang valid
                    if (!empty($book->tautan_buku) && filter_var($book->tautan_buku, FILTER_VALIDATE_URL)) {
                    $url_parts = parse_url($book->tautan_buku);
                    $domain = isset($url_parts['host']) ? $url_parts['host'] : '';
                    @endphp
                    <p><a href="{{ $book->tautan_buku }}" target="_blank">{{ $domain }}</a></p>
                    @php
                    } else {
                    // Tautan buku kosong atau tidak valid, tampilkan pesan alternatif
                    echo '<p>Tautan buku tidak tersedia.</p>';
                    }
                    @endphp



                </div>
                <h5>Gambar Buku:</h5>
                <div class="span6">
                    <img src="{{ asset('storage/' . $book->image) }}" alt="Gambar Buku" style="max-width: 200px; max-height: 200px;">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <a href="{{ route('books.edit', ['id' => $book->id_buku]) }}" class="btn btn-inverse">Edit</a>
                    <a href="{{ URL::route('all-books') }}" class="btn btn-inverse">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection