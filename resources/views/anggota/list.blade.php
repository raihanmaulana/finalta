@extends('anggota.index')
@section('custom_top_script')
@stop

@section('content')

    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Status Peminjaman</h3>
            </div>
            <div class="module-body">
                <div class="controls">

                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Nama Anggota</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Tampilkan daftar permintaan peminjaman -->
                            @forelse($daftarPeminjaman as $index => $peminjaman)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ optional($peminjaman->buku)->judul_buku }}</td>
                                    <td>{{ $peminjaman->anggota->nama_anggota ?? 'Default Name' }}</td>
                                    <td>{{ $peminjaman->status == 0 ? 'Pending' : ($peminjaman->status == 1 ? 'Approved' : 'Sudah Dikembalikan') }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">Tidak ada Peminjaman.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @stop
