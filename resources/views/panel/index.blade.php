@extends('layout.index')

@section('content')
<div class="content">
    <div class="btn-controls">
        <div class="btn-box-row row-fluid">
            <button class="btn-box span12" style="background: #025E9B; ">
                <b style="color:#fff">Perpustakaan SMA Negeri 1 Tunjungan</b>
            </button>
        </div>

        <div class="btn-box-row row-fluid">
            <button class="btn-box big span4 homepage-form-box btn-hover" id="findbookbox">
                <i class="icon-book" style="color: #025E9B"></i>
                <b>Cari Buku</b>
            </button>

            <button class="btn-box big span4 homepage-form-box btn-hover" id="findissuebox">
                <i class="icon-group" style="color: #025E9B"></i>
                <b>Cari Peminjam</b>
            </button>

            <button class="btn-box big span4 homepage-form-box btn-hover" id="findanggotabox">
                <i class="icon-user" style="color: #025E9B"></i>
                <b>Cari Anggota</b>
            </button>
        </div>

        <div class="content">
            <div class="module" style="display: none;">
                <div class="module-body">
                    <form class="form-horizontal row-fluid" id="findbookform">
                        <div class="control-group">
                            <label class="control-label">Judul Buku<br></label>
                            <div class="controls">
                                <div class="span9">
                                    <textarea class="span12" rows="2"></textarea>
                                </div>
                                <div class="span3">
                                    <a class="btn homepage-form-submit " style="background-color:  #025E9B; color:#fff"><i class="icon-search"></i>
                                        Cari</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <table class="table table-striped table-bordered table-condensed" style="display: none;">
                        <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Judul Buku</th>
                                <th>Pengarang</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Tersedia</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody id="buku-results"></tbody>
                    </table>
                </div>
            </div>



            <div class="module" style="display: none;">
                <div class="module-body">
                    <form class="form-horizontal row-fluid" id="findissueform">
                        <div class="control-group">
                            <label class="control-label">ISBN<br></label>
                            <div class="controls">
                                <div class="span9">
                                    <textarea class="span12" rows="2"></textarea>
                                </div>
                                <div class="span3">
                                    <a class="btn homepage-form-submit " style="background-color:  #025E9B; color:#fff"><i class="icon-search"></i>
                                        Cari</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <table class="table table-striped table-bordered table-condensed" style="display: none;">
                        <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Nomor Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Status Buku</th>
                            </tr>
                        </thead>
                        <tbody id="issue-results"></tbody>
                    </table>
                </div>
            </div>

            <div class="module" style="display: none;">
                <div class="module-body">
                    <form class="form-horizontal row-fluid" id="findanggotaform">
                        <div class="control-group">
                            <label class="control-label">Nomor Anggota<br></label>
                            <div class="controls">
                                <div class="span9">
                                    <textarea class="span12" rows="2"></textarea>
                                </div>
                                <div class="span3">
                                    <a class="btn homepage-form-submit " style="background-color:  #025E9B; color:#fff"><i class="icon-search"></i>
                                        Cari</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <table class="table table-striped table-bordered table-condensed" style="display: none;">
                        <thead>
                            <tr>
                                <th>Nama Anggota</th>
                                <th>Nomor Anggota</th>
                                <th>Email</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody id="anggota_perpustakaan-results"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="" id="kategori_list" value="{{ json_encode($kategori_list) }}">
    <input type="hidden" name="" id="nomor_anggota" value="{{ json_encode($nomor_anggota) }}">
    <input type="hidden" name="" id="isbn" value="{{ json_encode($isbn) }}">
    <input type="hidden" name="" id="judul_buku" value="{{ json_encode($judul_buku) }}">
    <input type="hidden" id="_token" data-form-field="token" value="{{ csrf_token() }}">

</div>
@stop


@section('custom_bottom_script')
<script type="text/javascript">
    kategori_list = $('#kategori_list').val(),
        _token = $('#_token').val();
</script>


<script type="text/javascript" src="{{ asset('static/custom/js/script.mainpage.js') }}"></script>

<script type="text/template" id="search_issue">
    @include('underscore.search_issue')
</script>
<script type="text/template" id="search_book">
    @include('underscore.search_book')
</script>
</script>
<script type="text/template" id="search_anggota">
    @include('underscore.search_anggota')
</script>
@stop