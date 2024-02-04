@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Anggota</h2>

    <form method="POST" action="{{ route('list-anggota-updateAnggota', ['id' => $anggota->id_anggota]) }}">
        @csrf
        @method('PUT')

        <!-- Tambahkan input fields sesuai kebutuhan -->
        <div class="form-group">
            <label for="nomor_anggota">Nomor Anggota:</label>
            <input type="text" class="form-control" id="nomor_anggota" name="nomor_anggota" value="{{ $anggota->nomor_anggota }}" required>
        </div>

        <div class="form-group">
            <label for="nama_anggota">Nama Anggota:</label>
            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" value="{{ $anggota->nama_anggota }}" required>
        </div>

        <!-- Tambahkan input fields lain sesuai kebutuhan -->

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection