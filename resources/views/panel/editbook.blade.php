<!-- File: resources/views/panel/editbook.blade.php -->

@extends('layout.index')

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Edit Book</h3>
        </div>
        <div class="module-body">
            <form class="form-horizontal row-fluid" method="POST" action="{{ route('books.update', ['id' => $book->id_buku]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nomor Buku -->
                <div class="control-group">
                    <label class="control-label" for="nomor_buku">Book Number</label>
                    <div class="controls">
                        <input type="text" id="nomor_buku" name="nomor_buku" value="{{ $book->nomor_buku }}" class="span8">
                    </div>
                </div>

                <!-- Judul Buku -->
                <div class="control-group">
                    <label class="control-label" for="judul_buku">Title Of Book</label>
                    <div class="controls">
                        <input type="text" id="judul_buku" name="judul_buku" value="{{ $book->judul_buku }}" class="span8">
                    </div>
                </div>

                <!-- Penerbit -->
                <div class="control-group">
                    <label class="control-label" for="penerbit">Publisher</label>
                    <div class="controls">
                        <input type="text" id="penerbit" name="penerbit" value="{{ $book->penerbit }}" class="span8">
                    </div>
                </div>

                <!-- Pengarang -->
                <div class="control-group">
                    <label class="control-label" for="pengarang">Author Name</label>
                    <div class="controls">
                        <input type="text" id="pengarang" name="pengarang" value="{{ $book->pengarang }}" class="span8">
                    </div>
                </div>

                <!-- Tahun Terbit -->
                <div class="control-group">
                    <label class="control-label" for="tahun_terbit">Year of Publication</label>
                    <div class="controls">
                        <input type="text" id="tahun_terbit" name="tahun_terbit" value="{{ $book->tahun_terbit }}" class="span8">
                    </div>
                </div>

                <!-- Kategori -->
                <div class="control-group">
                    <label class="control-label" for="kategori_id">Category</label>
                    <div class="controls">
                        <select id="kategori_id" name="kategori_id" class="span8">
                            @foreach ($categories_list as $category)
                            <option value="{{ $category->id }}" {{ $book->kategori_id == $category->id ? 'selected' : '' }}>
                                {{ $category->kategori }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Stok Buku -->
                <div class="control-group">
                    <label class="control-label" for="stok">Stock Of Book</label>
                    <div class="controls">
                        <input type="text" id="stok" name="stok" value="{{ $book->stok }}" class="span8">
                    </div>
                </div>

                <!-- Gambar Buku -->
                <div class="control-group">
                    <label class="control-label" for="image">Book Image</label>
                    <div class="controls">
                        <input type="file" id="image" name="image" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary">Update Book</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection