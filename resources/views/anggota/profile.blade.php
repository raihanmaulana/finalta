@extends('anggota.index')
@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Profile Anggota</h3>
        </div>
        <div class="module-body">
            <table class="table table-bordered table-condensed">
                <tbody>
                    <tr>
                        <td style="width: 200px; text-align: center;"><img src="{{ asset('storage/' . $user->gambar) }}" alt="Foto Profil" style="width:150px; height:200px;">
                        </td>
                        <td>
                            <h2>{{ $user->nama_anggota }}</h2>
                            <p>Nomor Anggota: {{ $user->nomor_anggota }}</p>
                            <p>Nama Panggilan: {{ $user->username }}</p>
                            <p>Nomor HP: {{ $user->nomor_hp }}</p>
                            <p>Email: {{ $user->email }}</p>
                            <p>Jurusan: {{ $user->jurusan }}</p>
                            <p>Kelas: {{ $user->kelas }}</p>
                            <p>
                                <a href="{{ route('anggota.profile.change-password') }}" style="margin-top: 10px">Ganti
                                    Kata Sandi</a>
                            </p>
                        </td>
                </tbody>
            </table>
            <div class="row">
                <a href="{{ route('edit_profil', $user->id_anggota) }}" class="btn btn-inverse pull-right" style="margin-top: 10px;">Edit
                    Profil</a>
            </div>
        </div>
    </div>
</div>
@endsection