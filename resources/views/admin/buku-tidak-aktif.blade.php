@extends('layout.index')
@section('custom_top_script')

@stop

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <h3>Buku Nonaktif</h3>

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
                    </div>
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <th scope="col">No</th>
                            <!-- <th scope="col">Image</th> -->
                            <th scope="col">ISBN</th>
                            <th scope="col">Judul Buku</th>
                            <th class="hide-on-small" scope="col">Penerbit</th>
                            <th class="hide-on-small" scope="col">Pengarang</th>
                            <th class="hide-on-small" scope="col">Tahun Terbit</th>
                            <th class="hide-on-small" scope="col">Kategori</th>
                            <th class="hide-on-small" scope="col">Stok</th>
                            <th scope="col">Aksi</th>
                        </thead>
                        <tbody id="buku-tidak-aktif">
                            @forelse ($bukuTidakaktif as $books)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $books->isbn }}</td>
                                    <td class="align-middle">{{ $books->judul_buku }}</td>
                                    <td class="hide-on-small">{{ $books->penerbit }}</td>
                                    <td class="hide-on-small">{{ $books->pengarang }}</td>
                                    <td class="hide-on-small">{{ $books->tahun_terbit }}</td>
                                    <td class="hide-on-small">{{ $books->kategori->kategori }}</td>
                                    <td class="hide-on-small"><a class="btn btn-warning">{{ $books->stok }}</td>
                                    <td>
                                        <form id="aktifForm{{ $books->id_buku }}"
                                            action="{{ route('books.activate', $books->id_buku) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="button" class="btn btn-success"
                                                onclick="activateBook({{ $books->id_buku }})">Aktifkan</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Tidak ada buku yang nonaktif</td>
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
    <script type="text/javascript" src="{{ asset('static/custom/js/script.statusbuku.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
