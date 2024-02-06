@extends('anggota.index')
@section('custom_top_script')
@stop

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Form Peminjaman Buku</h3>
            </div>
            <div class="module-body">
                <!-- Tabel Daftar Buku -->
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ISBN</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Kategori</th>
                            <th>Available</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarBukuTersedia as $index => $buku)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $buku->nomor_buku }}</td>
                                <td>{{ $buku->judul_buku }}</td>
                                <td>{{ $buku->pengarang }}</td>
                                <td>{{ $buku->penerbit }}</td>
                                <td>{{ $buku->tahun_terbit }}</td>
                                <td>{{ $buku->kategori->kategori }}</td>
                                <td>{{ $buku->available }}</td>
                                <td>
                                    <form action="{{ route('anggota.peminjaman.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_buku" value="{{ $buku->id_buku }}">
                                        <button type="submit" class="btn btn-warning">Pinjam</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection

    @section('custom_bottom_script')
