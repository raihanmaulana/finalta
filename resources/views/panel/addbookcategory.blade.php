@extends('layout.index')

@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Add Books kategori</h3>
        </div>
        <div class="module-body">
            <form class="form-horizontal row-fluid">
                <div class="control-group">
                    <label class="control-label">Kategori</label>
                    <div class="controls">
                        <input type="text" id="kategori" data-form-field="kategori" placeholder="Enter the kategori of the book here..." class="span8">
                        <input type="hidden" data-form-field="token" value="{{ csrf_token() }}">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button type="button" class="btn btn-inverse" id="addbookcategory">Add Books</button>
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