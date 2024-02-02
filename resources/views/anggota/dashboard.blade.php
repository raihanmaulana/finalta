@extends('anggota.index')
@section('custom_top_script')
@stop

@section('content')

<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Cari Buku</h3>
        </div>
        <div class="module-body">
            <div class="controls">

                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ISBN</th>
                            <th>Judul Buku</th>
                            <th>Penerbit</th>
                            <th>Pengarang</th>
                            <th>Tahun Terbit</th>
                            <th>Kategori</th>
                            <!-- <th>Stok</th> -->
                            <!-- <th>Status</th> Kolom baru untuk menampilkan status_buku -->
                            <th>Available</th>
                            <th>Gambar</th> <!-- New column for displaying images -->
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody id="all-books">
                        <tr class="text-center">
                            <td colspan="99"> <i class="icon-spinner icon-spin"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @stop