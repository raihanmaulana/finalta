@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>List Anggota Detail</h3>
        </div>
        <div class="module-body">
            <table class="table table-striped">
                <tr>
                    <th>Nomor Anggota</th>
                    <td>{{ $anggota->nomor_anggota }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $anggota->nama_anggota }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $anggota->email }}</td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td>{{ $anggota->jurusan }}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>{{ $anggota->kelas }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection