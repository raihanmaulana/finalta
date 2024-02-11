@extends('anggota.index')
@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Riwayat Peminjaman</h3>
        </div>
        <div class="module-body">
            <div class="controls">
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
                        @php
                        $startIndex = ($riwayatPeminjaman->currentPage() - 1) * $riwayatPeminjaman->perPage() + 1;
                        @endphp

                        @forelse($riwayatPeminjaman as $index => $peminjaman)
                        <tr>
                            <td>{{ $startIndex + $index }}</td>
                            <td>{{ $peminjaman->anggota->nomor_anggota ?? 'Default Name' }}</td>
                            <td>{{ $peminjaman->anggota->nama_anggota ?? 'Default Name' }}</td>
                            <td>{{ optional($peminjaman->buku)->judul_buku }}</td>
                            <td>{{ $peminjaman->tanggal_peminjaman->formatLocalized('%d %b %Y %H:%M') }}</td>
                            <td>{{ $peminjaman->tanggal_pengembalian->formatLocalized('%d %b %Y %H:%M') }}</td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td colspan="4">Tidak ada Peminjaman.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $riwayatPeminjaman->links() }}
            </div>
        </div>
    </div>
</div>
@endsection