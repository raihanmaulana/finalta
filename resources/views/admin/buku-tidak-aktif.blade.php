@extends('layout.index')
@section('custom_top_script')

@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <h3>Buku Tidak Aktif</h3>

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
                </div>
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Nomor Buku</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Pengarang</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Aksi</th>
                    </thead>
                    <tbody id="buku-tidak-aktif">
                        @forelse ($bukuTidakaktif as $books)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/' . $books->image) }}" alt="Gambar Buku" style="max-width: 200px; max-height: 200px;"></td>
                            <td>{{ $books->nomor_buku }}</td>
                            <td class="align-middle">{{ $books->judul_buku }}</td>
                            <td>{{ $books->penerbit }}</td>
                            <td>{{ $books->pengarang }}</td>
                            <td>{{ $books->tahun_terbit }}</td>
                            <td>{{ $books->kategori->kategori }}</td>
                            <td>
                                <form action="{{ route('books.activate', $books->id_buku) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-success">Aktifkan</button>
                                </form>
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
<script type="text/javascript" src="{{ asset('static/custom/js/script.statusbuku.js') }}"></script>
@endsection