@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')

    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Riwayat Peminjaman</h3>
            </div>
            <div class="module-body">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Anggota</th>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukuDikembalikan as $data)
                            @if ($data->status == 2)
                                {{-- Hanya tampilkan buku yang telah dikembalikan --}}
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td> {{-- Tambahkan +1 untuk menghindari nomor 0 --}}
                                    <td>{{ $data->anggota->nomor_anggota }}</td>
                                    <td>{{ $data->anggota->nama_anggota }}</td>
                                    <td>{{ $data->buku->judul_buku }}</td>
                                    <td>{{ $data->tanggal_peminjaman ? $data->tanggal_peminjaman->format('Y-m-d H:i:s') : 'Belum Dikembalikan' }}
                                    </td>
                                    <td>{{ $data->tanggal_pengembalian ? $data->tanggal_pengembalian->format('Y-m-d H:i:s') : 'Belum Dikembalikan' }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{ $bukuDikembalikan->links() }}
            </div>
        </div>
    </div>
@endsection
