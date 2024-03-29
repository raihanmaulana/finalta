@extends('layout.index')
@section('custom_top_script')

@stop

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <h3>Kelola Katalog</h3>
            </div>
            <div class="module-body">
                <div class="controls">
                    <div class="d-flex align-items-center mb-3">

                        <!-- Input form untuk pencarian -->
                        <input type="text" id="searchInput" onkeyup="searchBooks()"
                            placeholder="Cari berdasarkan Judul Buku atau ISBN" style="width: 45%;">

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
                        <a href="{{ URL::route('list-pengarang') }}" style="margin-bottom:10px"
                            class="btn btn-inverse">Kelola Pengarang</a>
                        <a href="{{ URL::route('list-kategori') }}" style="margin-bottom:10px"
                            class="btn btn-inverse">Kelola Kategori</a>
                        <a href="{{ URL::route('add-books') }}" style="margin-bottom:10px" class="btn btn-inverse">Tambah
                            Buku</a>
                        <a href="{{ URL::route('tidakaktif.index') }}" style="margin-bottom:10px"
                            class="btn btn-inverse">Buku Nonaktif</a>
                    </div>
                    <!-- Tabel daftar buku -->
                    <!-- Tabel daftar buku -->
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ISBN</th>
                                <th>Judul Buku</th>
                                <th class="hide-on-small">Penerbit</th>
                                <th class="hide-on-small">Tahun Terbit</th>
                                <th class="hide-on-small">Kategori</th>
                                <th class="hide-on-small">Stok</th>
                                <th>Tersedia</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="all-books">
                            @php
                                $activeBooksCount = 0;
                            @endphp
                            @forelse($books as $book)
                                @if ($book->kondisi == 1)
                                    <!-- Filter buku yang aktif -->
                                    @php
                                        $activeBooksCount++;
                                    @endphp
                                    <tr>
                                        <td>{{ $activeBooksCount }}</td>
                                        <!-- Menggunakan variabel $activeBooksCount sebagai nomor urutan -->
                                        <td>{{ $book->isbn }}</td>
                                        <td>{{ $book->judul_buku }}</td>
                                        <td class="hide-on-small"> {{ $book->penerbit }}</td>
                                        <td class="hide-on-small">{{ $book->tahun_terbit }}</td>
                                        <td class="hide-on-small">{{ $book->kategori->kategori }}</td>
                                        <td class="hide-on-small"><a class="btn btn-warning">{{ $book->stok }}</td>
                                        <td><a class="btn btn-success">{{ $book->tersedia }}</td>
                                        <td>
                                            <div class="center-block"
                                                style="display: flex; flex-direction: column; align-items: center;">
                                                <!-- Tombol edit, detail, hapus -->

                                                <button class="btn btn-primary detail-btn"
                                                    style="margin-bottom: 2px; width: 75px;"
                                                    data-id="{{ $book->id_buku }}">Detail</button>
                                                <button class="btn btn-info edit-btn"
                                                    style="margin-bottom: 2px; width: 75px;"
                                                    data-id="{{ $book->id_buku }}">Edit</button>
                                                <form id="nonaktifForm{{ $book->id_buku }}"
                                                    action="{{ route('books.deactivate', $book->id_buku) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="deactivateBook({{ $book->id_buku }})">Nonaktif</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@stop
