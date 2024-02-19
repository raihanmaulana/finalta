@extends('peminjaman.index')

@section('content')
<div class="content">
    <div class="btn-controls">
        <div class="btn-box-row row-fluid">
            <button class="btn-box span12" style="background: #025E9B; ">
                <b style="color:#fff">Perpustakaan SMA Negeri 1 Tunjungan</b>
            </button>
        </div>

        <div class="btn-box-row row-fluid">
            <button class="btn-box big span4 homepage-form-box btn-hover" id="bukutamubox">
                <i class="icon-group" style="color: #025E9B"></i>
                <b>Buku Tamu</b>
            </button>

            <button class="btn-box big span4 homepage-form-box btn-hover" id="findbookbox">
                <i class="icon-search" style="color: #025E9B"></i>
                <b>Cari Buku</b>
            </button>

            <button class="btn-box big span4 homepage-form-box btn-hover" id="pinjambukubox">
                <i class="icon-book" style="color: #025E9B"></i>
                <b>Pinjam Buku</b>
            </button>
        </div>

        <div class="content">
            <div class="module" style="display: none;">
                <div class="module-body">
                    <form class="form-horizontal row-fluid" method="post" action="{{ route('bukutamu_offline.store') }}" id="bukutamuform">
                        @csrf
                        <div class="control-group">
                            <label class="control-label" for="nomor_anggota">Nomor Anggota<br></label>
                            <div class="controls">
                                <div class="span9">
                                    <input class="span12" type="text" name="nomor_anggota" id="nomor_anggota" placeholder="Masukkan Nomor Anggota Anda"></input>
                                </div>
                                <div class="span3">
                                    <button type="submit" class="btn homepage-form-submit " style="background-color:  #025E9B; color:#fff">
                                        Masuk</button>
                                </div>
                            </div>

                        </div>
                    </form>
                    <hr>
                </div>
            </div>

            <div class="module" style="display: none;">
                <div class="module-body">
                    <form class="form-horizontal row-fluid" id="findbookform">
                        <div class="control-group">
                            <label class="control-label">Judul Buku<br></label>
                            <div class="controls">
                                <div class="span9">
                                    <textarea class="span12"></textarea>
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
                                <th>ID Buku</th>
                                <th>Nomor Buku</th>
                                <th>Judul Buku</th>
                                <th>Pengarang</th>
                                <th>Tahun Terbit</th>
                                <th>Kategori</th>
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
                    <form class="form-horizontal row-fluid" method="post" action="{{ route('peminjaman.pinjam') }}" id="pinjambukuform">
                        @csrf
                        <label for="nomor_anggota">Nomor Anggota:</label>
                        <input class="span6" type="text" name="nomor_anggota" required>
                        <br>
                        <label for="nomor_buku">Nomor Buku:</label>
                        <input class="span6" type="text" name="nomor_buku" required>
                        <hr>
                        <button class="btn homepage-form-submit" style="background-color:  #025E9B; color:#fff" type="submit">Pinjam Buku</button>
                    </form>
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                </div>
            </div>

        </div>
    </div>


    <input type="hidden" id="_token" data-form-field="token" value="{{ csrf_token() }}">

</div>
@stop


@section('custom_bottom_script')

<script type="text/javascript" src="{{ asset('static/custom/js/script.public.js') }}"></script>

<script type="text/template" id="search_issue">
    @include('underscore.search_issue')
</script>
<script type="text/template" id="caribuku_offline">
    @include('underscore.caribuku_offline')
</script>
</script>
<script type="text/template" id="search_anggota">
    @include('underscore.search_anggota')
</script>
@stop