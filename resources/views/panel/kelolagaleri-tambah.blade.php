@extends('layout.index')

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Tambah Gambar Galeri</h3>
        </div>

        <div class="module-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="judul">Judul Gambar:</label>
                    <input type="text" class="form-control" id="judul" name="judul">
                </div>
                <div class="form-group">
                    <label for="judul">Deskripsi Gambar:</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                </div>
                <div class="form-group">
                    <label for="gambar_galeri">Gambar:</label>
                    <input type="file" class="form-control-file" id="gambar_galeri" name="gambar_galeri">
                </div>
                <button type="submit" class="btn btn-primary">Tambah Gambar</button>
            </form>
        </div>
    </div>
</div>
@endsection