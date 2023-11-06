<!-- resources/views/anggota/peminjaman.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Form Permintaan Peminjaman Buku</h1>
            <form method="POST" action="{{ route('anggota.peminjaman.submit') }}">
                @csrf

                <!-- Input untuk mencari buku -->
                <div class="form-group">
                    <label for="book_id">Judul Buku</label>
                    <input type="text" name="book_id" id="book_id" class="form-control" placeholder="Judul Buku">
                </div>

                <!-- Input untuk jumlah buku yang ingin dipinjam -->
                <div class="form-group">
                    <label for="jumlah">username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Jumlah Buku">
                </div>

                <button type="submit" class="btn btn-primary">Ajukan Permintaan</button>
            </form>
        </div>
    </div>
</div>
@endsection