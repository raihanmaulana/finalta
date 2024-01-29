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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Nomor Anggota</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bukuDikembalikan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ optional($item->anggota)->nama_anggota }}</td>
                        <td>{{ optional($item->anggota)->nomor_anggota }}</td>
                        <td>{{ optional($item->buku)->judul_buku }}</td>
                        <td>{{ optional(optional($item->peminjamanBuku)->tanggal_peminjaman)->format('Y-m-d H:i:s') ?? 'N/A' }}</td>
                        <td>{{ $item->created_at ?? 'N/A' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Tidak ada buku yang dikembalikan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection