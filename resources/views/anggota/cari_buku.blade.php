@extends('anggota.index')
@section('custom_top_script')
@stop

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Koleksi Buku</h3>
            </div>
            <div class="module-body">

                <form class="form-search" id="searchForm" action="{{ route('anggota.cari-buku') }}" method="GET">
                    @csrf
                    <div class="input-append">
                        <input id="searchInput" type="text" class="span8 p-2 rounded-corner" style="height: 32px"
                            placeholder="Cari Buku" name="keyword" value="{{ $keyword }}">
                </form>


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ISBN</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($result as $index => $buku)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $buku->nomor_buku }}</td>
                                <td>{{ $buku->judul_buku }}</td>
                                <td>{{ $buku->pengarang }}</td>
                                <td>{{ $buku->penerbit }}</td>
                                <td>{{ $buku->tahun_terbit }}</td>
                                <td>{{ $buku->kategori->kategori }}</td>
                                <!-- Tambahkan kolom stok -->
                                <td>{{ $buku->stok }}</td>
                                <td>
                                    <button type="submit" class="btn btn-warning">Pinjam</button>
                                    <button type="submit" class="btn btn-warning">Pinjam</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Tidak ada hasil yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchForm = document.getElementById('searchForm');
        var searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('input', function() {
            searchForm.submit();
        });
    });
</script>

@section('custom_bottom_script')
