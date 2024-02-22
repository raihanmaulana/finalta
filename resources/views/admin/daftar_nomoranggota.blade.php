@extends('layout.index')

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Daftar Nomor Anggota</h3>
        </div>
        <div class="module-body">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Anggota</th>
                        <th>Status Akun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($verifikasiAnggota as $index => $anggota)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $anggota->nomor_anggota }}</td>
                        <td>{{ $anggota->anggotaPerpustakaan ? 'Sudah memiliki akun' : 'Belum memiliki akun' }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="controls">
                <a href="{{ URL::route('list-anggota') }}" class="btn btn-inverse">Kembali</a>
            </div>

        </div>

    </div>
</div>
@endsection