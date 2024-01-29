@extends('anggota.index')
@section('custom_top_script')
@stop

@section('content')
<div class="container">
    <h2>Form Peminjaman Buku</h2>

    <!-- Form Peminjaman -->
    <form action="{{ route('anggota.peminjaman.store') }}" method="POST">
        @csrf

        <!-- Pilih Buku -->
        <div class="form-group">
            <label for="id_buku">Pilih Buku:</label>
            <select name="id_buku" id="id_buku" class="form-control">
                <!-- Tampilkan daftar buku yang tersedia -->
                @foreach($daftarBukuTersedia as $buku)
                <option value="{{ $buku->id_buku }}">{{ $buku->judul_buku }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
    </form>

    @endsection