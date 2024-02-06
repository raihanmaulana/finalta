@extends('layout.index')
@section('custom_top_script')

@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Kelola Katalog</h3>
        </div>
        <div class="module-body">
            <div class="controls">
                <div class="d-flex align-items-center mb-3">

                    <!-- Input form untuk pencarian -->
                    <input type="text" id="searchInput" onkeyup="searchBooks()" placeholder="Cari berdasarkan judul buku atau nomor buku" style="width: 45%;">

                    <select id="kategoriFilter" onchange="filterBooks()" style="margin-bottom: 10px;">
                        <option value="ALL">Semua Kategori</option>
                        @foreach ($kategoriBuku as $kategori)
                        <option value="{{ $kategori->kategori }}">{{ $kategori->kategori }}</option>
                        @endforeach
                    </select>

                    <!-- Dropdown untuk filter tahun_terbit -->
                    <select id="tahunFilter" onchange="filterBooks()" style="margin-bottom: 10px;">
                        <option value="ALL">Semua Tahun</option>
                        @foreach ($tahunTerbit as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                    <!-- Tombol tambah kategori dan tambah buku -->
                    <a href="{{ URL::route('add-book-category') }}" style="margin-bottom:10px" class="btn btn-inverse mr-2">Tambah Kategori</a>
                    <a href="{{ URL::route('add-books') }}" style="margin-bottom:10px" class="btn btn-inverse mr-2">Tambah Buku</a>
                </div>
                <!-- Tabel daftar buku -->
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
                            <th>Stok</th>
                            <th>Tersedia</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="all-books">
                        @forelse($books as $index => $book)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $book->nomor_buku }}</td>
                            <td>{{ $book->judul_buku }}</td>
                            <td> {{ $book->penerbit }}</td>
                            <td> {{ $book->pengarang }}</td>
                            <td>{{ $book->tahun_terbit }}</td>
                            <td>{{ $book->kategori->kategori }}</td>
                            <td><a class="btn btn-success">{{ $book->stok }}</td>
                            <td><a class="btn btn-warning">{{ $book->tersedia}}</td>
                            <td>
                                <div class="center-block" style="display: flex; flex-direction: column; align-items: center;">
                                    <!-- Tombol edit, detail, hapus -->
                                    <button class="btn btn-primary btn-sm edit-btn" style="margin-bottom: 2px; width: 60px;" data-id="{{ $book->id_buku }}">Edit</button>
                                    <button class="btn btn-info btn-sm detail-btn" style="margin-bottom: 2px; width: 60px;" data-id="{{ $book->id_buku }}">Detail</button>
                                    <button class="btn btn-danger btn-sm delete-btn" style="width: 60px;" data-id="{{ $book->id_buku }}">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada buku</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


@section('custom_bottom_script')
<script type="text/javascript" src="{{ asset('static/custom/js/script.allbook.js') }}"></script>
@stop