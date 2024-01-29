@extends('layout.index')
@section('custom_top_script')
@stop
@section('content')

<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Anggota Perpustakaan</h3>
        </div>
        <div class="module-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Anggota</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody>
                    @forelse ($anggotaList as $index => $anggota)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $anggota->nomor_anggota }}</td>
                        <td>{{ $anggota->nama_anggota }}</td>
                        <td>{{ $anggota->email }}</td>
                        <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Tidak ada anggota.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@stop

@section('custom_bottom_script')
<script type="text/javascript" src="{{ asset('static/custom/js/script.students.js') }}"></script>
@stop