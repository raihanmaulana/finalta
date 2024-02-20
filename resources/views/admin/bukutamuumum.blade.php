@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Buku Tamu Umum</h3>
        </div>
        <div class="module-body">
            @if (count($bukutamu_umum) > 0)
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Asal Daerah</th>
                        <th>Tanggal Kunjungan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    // Hitung nomor urut untuk tabel bukutamu
                    $currentPage = $bukutamu_umum->currentPage();
                    $perPage = $bukutamu_umum->perPage();
                    $startNumber = ($currentPage - 1) * $perPage + 1;
                    @endphp
                    @foreach ($bukutamu_umum as $index => $guest)
                    <tr>
                        <td>{{ $startNumber + $index }}</td> <!-- Tambahkan nomor urut disini -->
                        <td>{{ $guest->nama }}</td>
                        <td>{{ $guest->asal_daerah }}</td>
                        <td>{{ $guest->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Tampilkan pagination links -->
            {{ $bukutamu_umum->links() }}
            @else
            <p>No guestbook entries found.</p>
            @endif
        </div>
    </div>
</div>
@stop

@section('custom_bottom_script')
@stop