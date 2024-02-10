@extends('layout.index')

@section('custom_top_script')
@stop

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Tambah Kategori</h3>
            </div>
            <div class="module-body">
                <form class="form-horizontal row-fluid" method="POST" action="{{ route('bookcategory.store') }}">
                    @csrf
                    <div class="control-group">
                        <label class="control-label">Kategori</label>
                        <div class="controls">
                            <input type="text" name="kategori" id="kategori" data-form-field="kategori"
                                placeholder="Masukkan kategori baru..." class="span8">
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-inverse span2" id="addbookcategory">Tambah</button>
                            <a href="{{ URL::route('all-books') }}" class="btn btn-inverse span2">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('custom_bottom_script')

    <script type="text/javascript" src="{{ asset('static/custom/js/script.addbookcategory.js') }}"></script>

@stop
