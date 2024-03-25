@extends('layout.index')
@section('custom_top_script')

@stop

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Kelola Pengarang</h3>
            </div>
            <div class="module-body">
                <div class="controls">
                    <div class="d-flex align-items-center mb-3">
                        <!-- Tombol tambah kategori dan tambah buku -->
                        <a href="{{ URL::route('tambah-pengarang') }}" style="margin-bottom:10px"
                            class="btn btn-inverse">Tambah Pengarang</a>
                        <a href="{{ URL::route('all-books') }}" style="margin-bottom:10px"class="btn btn-inverse">Kembali</a>
                    </div>

                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pengarang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="all-books">
                            <tr>
                                <td>1</td>
                                <td>pengarang1</td>
                                <td>
                                    <button type="button" class="btn btn-danger"
                                        style="margin-bottom: 2px; width: 75px;">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
