@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>List Anggota</h3>
        </div>
        <div class="module-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Anggota</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($anggotaList as $index => $anggota)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $anggota->nomor_anggota }}</td>
                        <td>{{ $anggota->nama_anggota }}</td>
                        <td>{{ $anggota->email }}</td>
                        <td>
                            <a href="{{ route('list-anggota-detail', ['id' => $anggota->id_anggota]) }}" class="btn btn-info btn-sm">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Tidak ada anggota.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection