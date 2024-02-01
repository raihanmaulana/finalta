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
                <i class="icon-list" style="color: #025E9B"></i>
                <b>Find Book</b>
            </button>

            <button class="btn-box big span4 homepage-form-box btn-hover" id="findissuebox">
                <i class="icon-book" style="color: #025E9B"></i>
                <b>Find Issue Book </b>
            </button>

            <button class="btn-box big span4 homepage-form-box btn-hover" id="findanggotabox">
                <i class="icon-user" style="color: #025E9B"></i>
                <b>Find Student</b>
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
                                        Search</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <table class="table table-striped table-bordered table-condensed" style="display: none;">
                        <thead>
                            <tr>
                                <th>ID Buku</th>
                                <th>Nomor Buku</th>
                                <th>Judul Buku</th>
                                <th>Pengarang</th>
                                <th>Tahun Terbit</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody id="book-results"></tbody>
                    </table>
                </div>
            </div>

            <div class="module" style="display: none;">
                <div class="module-body">
                    <form class="form-horizontal row-fluid" id="findissueform">
                        <div class="control-group">
                            <label class="control-label">Masukkan Nomor Buku</label>
                            <div class="controls">
                                <input type="number" placeholder="" class="span9" id="search_issue">
                                <a class="btn homepage-form-submit" style="background-color: #025E9B; color: #fff" onclick="findBorrowedBook()">
                                    <i class="icon-search"></i> Search </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="module-body" id="module-body-results"></div>
            </div>


            <div class="module" style="display: none;">
                <div class="module-body">
                    <form class="form-horizontal row-fluid" id="findanggotaform">
                        <div class="control-group">
                            <label class="control-label">Masukkan Nomor Anggota</label>
                            <div class="controls">
                                <div class="span9">
                                    <textarea class="span12" rows="2"></textarea>
                                </div>

                                <input type="text" placeholder="" class="span9" id="search_anggota">
                                <a class="btn homepage-form-submit" style="background-color:  #025E9B; color:#fff" onclick="searchAnggotaByNumber()">
                                    <i class=" icon-search"></i> Search
                                </a>
                            </div>
                        </div>
                    </form>
                    <table class=" table table-striped table-bordered table-condensed" style="display: none;">
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
                        <tbody id="anggota-results"></tbody>
                    </table>
                </div>
                <div class="module-body" id="module-body-results"></div>
            </div>
        </div>
    </div>
    <input type="hidden" name="" id="branches_list" value="{{ json_encode($branch_list) }}">
    <input type="hidden" name="" id="student_categories_list" value="{{ json_encode($student_categories_list) }}">
    <input type="hidden" name="" id="kategori_list" value="{{ json_encode($kategori_list) }}">
    <input type="hidden" id="_token" data-form-field="token" value="{{ csrf_token() }}">

</div>
@stop


@section('custom_bottom_script')
<script type="text/javascript">
    var branches_list = $('#branches_list').val(),
        student_categories_list = $('#student_categories_list').val(),
        kategori_list = $('#kategori_list').val(),
        _token = $('#_token').val();
</script>


<script type="text/javascript" src="{{ asset('static/custom/js/script.mainpage.js') }}"></script>


<script type="text/template" id="search_book">
    @include('underscore.search_book')
</script>
<script type="text/template" id="search_issue">
    @include('underscore.search_issue')
</script>
<script type="text/template" id="search_anggota">
    @include('underscore.search_anggota')
</script>
@stop