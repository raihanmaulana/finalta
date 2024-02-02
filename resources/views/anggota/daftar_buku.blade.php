@extends('anggota.index')
@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Daftar Buku</h3>
        </div>
        <div class="module-body">
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
                    @forelse ($daftarBuku as $index => $buku)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $buku->nomor_buku }}</td>
                        <td>{{ $buku->judul_buku }}</td>
                        <td>{{ $buku->pengarang }}</td>
                        <td>{{ $buku->penerbit }}</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                        <td>{{ $buku->kategori->kategori }}</td>
                        <td>{{ $buku->stok }}</td>
                        <td>
                            <form action="{{ route('anggota.daftar-buku.store', ['idBuku' => $buku->id_buku]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning">Pinjam</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">Tidak ada buku tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('custom_bottom_script')