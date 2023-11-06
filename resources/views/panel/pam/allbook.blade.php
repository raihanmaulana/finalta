@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Books available to Students</h3>
        </div>
        <div class="module-body">
            <!--             <p>
                <strong>Combined</strong>
                -
                <small>table class="table table-striped table-bordered table-condensed"</small>
            </p> -->
            <div class="controls">
                <select class="" id="kategori_fill">
                    @foreach($kategori_list as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                    @endforeach
                </select>
            </div>
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nomor Buku</th>
                        <th>Judul Buku</th>
                        <th>Penerbit</th>
                        <th>Pengarang</th>
                        <th>Available</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="semua-buku">
                    <tr class="text-center">
                        <td colspan="99"> <i class="icon-spinner icon-spin"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" name="" id="kategori_list" value="{{ json_encode($kategori_list) }}">
</div>
@stop

@section('custom_bottom_script')
<script type="text/javascript">
    var kategori_list = $('#kategori_list').val();
</script>
<script type="text/javascript" src="{{asset('static/custom/js/script.addbook.js') }}"></script>
<script type="text/template" id="semuabuku_show">
    @include('underscore.semuabuku_show')
</script>
@stop