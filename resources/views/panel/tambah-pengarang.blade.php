@extends('layout.index')

@section('custom_top_script')
@stop

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Tambah Pengarang</h3>
            </div>
            <div class="module-body">
                <form class="form-horizontal row-fluid">
                    <div class="control-group">
                        <label class="control-label">Pengarang</label>
                        <div class="controls">
                            <input type="text" name="pengarang" id="pengarang" data-form-field="pengarang"
                                placeholder="Masukkan pengarang baru..." class="span8" required>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-inverse">Tambah</button>
                            <a href="{{ URL::route('list-pengarang') }}" class="btn btn-inverse">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
