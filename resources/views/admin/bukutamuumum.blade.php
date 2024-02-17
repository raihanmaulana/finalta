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
            @if (count($guests) > 0)
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    // Hitung nomor urut untuk tabel bukutamu
                    $currentPage = $guests->currentPage();
                    $perPage = $guests->perPage();
                    $startNumber = ($currentPage - 1) * $perPage + 1;
                    @endphp
                    @foreach ($guests as $index => $guest)
                    <tr>
                        <td>{{ $startNumber + $index }}</td> <!-- Tambahkan nomor urut disini -->
                        <td>{{ $guest->name }}</td>
                        <td>{{ $guest->message }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Tampilkan pagination links -->
            {{ $guests->links() }}
            @else
            <p>No guestbook entries found.</p>
            @endif
        </div>
    </div>
</div>
@stop

@section('custom_bottom_script')
@stop