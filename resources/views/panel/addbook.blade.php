@extends('layout.index')

@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add Books</h3>
        </div>
        <div class="module-body">
            <form class="form-horizontal row-fluid">
                <div class="control-group">
                    <label class="control-label">Judul Buku</label>
                    <div class="controls">
                        <input type="text" id="judul_buku" data-form-field="judul_buku" placeholder="Masukkan Judul Buku" class="span8">
                        <input type="hidden" data-form-field="token" value="{{ csrf_token() }}">
                        <input type="hidden" data-form-field="auth_user" value="{{ auth()->user()->id }}">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Penerbit</label>
                    <div class="controls">
                        <input type="text" id="penerbit" data-form-field="penerbit" placeholder="Masukkan Nama Penerbit" class="span8">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Pengarang</label>
                    <div class="controls">
                        <input type="text" id="pengarang" data-form-field="pengarang" placeholder="Masukkan Nama Pengarang" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Tahun Terbit</label>
                    <div class="controls">
                        <input type="text" id="tahun_terbit" data-form-field="tahun_terbit" placeholder="Masukkan Tahun Terbit" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="basicinput">Kategori</label>
                    <div class="controls">
                        <select tabindex="1" id="kategori" data-form-field="kategori" data-placeholder="Select kategori.." class="span8">
                            @foreach($kategori_list as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Stok</label>
                    <div class="controls">
                        <input type="number" id="stok" data-form-field="stok" placeholder="How many issues are there?" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Tersedia</label>
                    <div class="controls">
                        <input type="number" id="tersedia" data-form-field="tersedia" placeholder="How many issues are there?" class="span8">
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="button" class="btn btn-inverse" id="addbooks">Add Books</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('custom_bottom_script')

<script type="text/javascript" src="{{ asset('static/custom/js/script.addbook.js') }}"></script>

@stop