@extends('anggota.index')

@section('content')
<div class="container">
    <h2>Daftar Permintaan Peminjaman</h2>

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
                <td>{{ $peminjaman->status == 0 ? 'Pending' : ($peminjaman->status == 1 ? 'Approved' : 'Sudah Dikembalikan') }}</td>
            </tr>
            @empty
            <tr class="text-center">
                <td colspan="4">Tidak ada Peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@stop

@section('custom_bottom_script')
<script type="text/javascript">
    var kategori_list = $('#kategori_list').val();
</script>
<script type="text/javascript" src="{{ asset('static/custom/js/script.addbook.js') }}"></script>
<script type="text/template" id="allbooks_show">
    @include('underscore.allbooks_show')
        @stop