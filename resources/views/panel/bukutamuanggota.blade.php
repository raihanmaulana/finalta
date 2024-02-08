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
            <div class="controls">
            </div>
            @if (count($bukutamuAnggota) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Email</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bukutamuAnggota as $bukutamu)
                    <tr>
                        <td>{{ $loop->index + $firstNumber }}</td>
                        <td>{{ $bukutamu->nomor_anggota }}</td>
                        <td>{{ $bukutamu->nama_anggota }}</td>
                        <td>{{ $bukutamu->email }}</td>
                        <td>{{ $bukutamu->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Tampilkan pagination links -->
            {{ $bukutamuAnggota->links() }}
            @else
            <p>No guestbook entries found.</p>
            @endif
        </div>
    </div>
</div>
@stop

@section('custom_bottom_script')
@stop