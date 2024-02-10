@extends('layout.index')

@section('content')
<div class="content">
    <div class="btn-controls">
        <div class="btn-box-row row-fluid">
            <button class="btn-box span12" style="background: #025E9B; ">
                <b style="color:#fff">Buku Tamu</b>
            </button>
        </div>
        <div class="btn-box-row row-fluid">
            <button class="btn-box big span6 homepage-form-box btn-hover" onclick="window.location.href='{{ URL::route('bukutamuumum.view') }}'">
                <i class="icon-list" style="color: #025E9B"></i>
                <b>Umum</b>
            </button>

            <button class="btn-box big span6 homepage-form-box btn-hover" onclick="window.location.href='{{ URL::route('bukutamuanggota.view') }}'">
                <i class="icon-group" style="color: #025E9B"></i>
                <b>Anggota</b>
            </button>
        </div>
    </div>
</div>
@stop

@section('custom_bottom_script')
@stop