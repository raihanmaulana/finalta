@extends('layout.index')

@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Tambah Buku</h3>
        </div>
        <div class="module-body">
            <form class="form-horizontal row-fluid" method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="control-group">
                    <label class="control-label">Judul Buku</label>
                    <div class="controls">
                        <input type="text" name="judul_buku" id="judul_buku" placeholder="Masukkan Judul Buku" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">ISBN</label>
                    <div class="controls">
                        <input type="text" name="nomor_buku" id="nomor_buku" placeholder="Masukkan ISBN" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Penerbit</label>
                    <div class="controls">
                        <input type="text" name="penerbit" id="penerbit" placeholder="Masukkan Nama Penerbit" class="span8">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Pengarang</label>
                    <div class="controls">
                        <input type="text" name="pengarang" id="pengarang" placeholder="Masukkan Nama Pengarang" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Tahun Terbit</label>
                    <div class="controls">
                        <input type="text" name="tahun_terbit" id="tahun_terbit" placeholder="Masukkan Tahun Terbit" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="kategori_id">Kategori</label>
                    <div class="controls">
                        <select tabindex="1" name="kategori_id" id="kategori_id" data-placeholder="Select kategori.." class="span8">
                            @foreach ($kategori_list as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="image">Book Image</label>
                    <div class="controls">
                        <input type="file" id="image" name="image" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Stok Buku</label>
                    <div class="controls">
                        <input type="text" name="stok" id="stok" placeholder="Masukkan Stok Buku" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Tautan Buku</label>
                    <div class="controls">
                        <input type="text" name="tautan_buku" id="tautan_buku" placeholder="Masukkan Tautan Buku" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-inverse" id="addbooks">Add Books</button>
                        <a href="{{ URL::route('all-books') }}" class="btn btn-inverse">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('custom_bottom_script')
@stop