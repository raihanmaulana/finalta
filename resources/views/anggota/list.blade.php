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
                @php
                $startIndex = $daftarPeminjaman->firstItem(); // Menggunakan firstItem() untuk mendapatkan nomor awal
                $showNextButton = $daftarPeminjaman->count() > 10;
                @endphp

                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Anggota</th>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th>Status</th>
                            <th>Batas Pengembalian</th> <!-- Kolom baru -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarPeminjaman as $index => $peminjaman)
                        @if($peminjaman->status == 0 || $peminjaman->status == 1 || $peminjaman->status == 3)
                        <tr>
                            <td>{{ $startIndex + $index }}</td>
                            <td>{{ $peminjaman->anggota->nomor_anggota ?? 'Default Name' }}</td>
                            <td>{{ $peminjaman->anggota->nama_anggota ?? 'Default Name' }}</td>
                            <td>{{ optional($peminjaman->buku)->judul_buku }}</td>
                            <td>
                                @if($peminjaman->status == 0)
                                Belum Disetujui
                                @elseif($peminjaman->status == 1)
                                Sudah Disetujui
                                @elseif($peminjaman->status == 3)
                                Harap Dikembalikan
                                @endif
                            </td>
                            <td>
                                @if($peminjaman->status == 1)
                                {{ $peminjaman->tanggal_peminjaman->addDays(7)->isoFormat('D MMMM YYYY') }}
                                @elseif($peminjaman->status == 0)
                                -
                                @endif
                            </td>
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada peminjaman</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
                @if($showNextButton)
                {{ $daftarPeminjaman->links() }}
                @endif

            </div>
        </div>
    </div>
</div>
@stop