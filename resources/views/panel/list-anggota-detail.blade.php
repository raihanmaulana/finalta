@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Detail Anggota</h3>
        </div>
        <div class="module-body">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Nomor Anggota</th>
                    <td>{{ $anggota->nomor_anggota }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $anggota->nama_anggota }}</td>
                </tr>
                <tr>
                    <th>Nomor HP</th>
                    <td>{{ $anggota->nomor_hp }}</td>
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
            <div class="row-fluid" style="margin-top: 10px">
                <div class="span12">
                    <a href="{{ URL::route('list-anggota') }}" class="btn btn-inverse">Kembali</a>
                    <a href="{{ route('list-anggota-edit', ['id' => $anggota->id_anggota]) }}" class="btn btn-inverse">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection