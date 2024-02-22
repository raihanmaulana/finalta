@extends('layout.index')

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Edit Galeri</h3>
        </div>
        <div class="module-body">
            <form method="POST" action="{{ route('galeri.update', $galeri->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $galeri->judul }}" required>
                </div>

                <div class="form-group">
                    <label for="gambar_galeri">Gambar</label>
                    <input type="file" class="form-control-file" id="gambar_galeri" name="gambar_galeri">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $galeri->deskripsi }}</textarea>
                </div>

                <button type="submit" class="btn btn-inverse">Simpan Perubahan</button>
                <a href="{{ route('galeri.manage') }}" class="btn btn-inverse">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection