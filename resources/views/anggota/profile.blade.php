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

            <h2>{{ $user->nama_anggota }}</h2>
            <p>Nomor Anggota: {{ $user->nomor_anggota }}</p>
            <p>Email: {{ $user->email }}</p>
            <p>Jurusan: {{ $user->jurusan }}</p>
            <p>Kelas: {{ $user->kelas }}</p>
            <p>
                <img src="{{ asset('storage/' . $user->gambar) }}" alt="Foto Profil">
            <p>
                <a href="{{ route('anggota.profile.change-password') }}">Ganti Kata Sandi</a>

                <a href="{{ route('edit_profil', $user->id_anggota) }}" class="btn btn-primary">Edit Profil</a> <!-- Tambahkan tombol Edit Profil -->



        </div>
    </div>
</div>
@endsection
@section('custom_bottom_script')