<!-- resources/views/peminjaman/form.blade.php -->

@extends('layouts.app')

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Form Peminjaman</h3>
        </div>
        <div class="module-body">
            <!-- Form Peminjaman -->
            <form method="post" action="{{ route('peminjaman.pinjam') }}">
                @csrf
                <label for="nomor_anggota">Nomor Anggota:</label>
                <input type="text" name="nomor_anggota" required>
                <br>
                <label for="nomor_buku">Nomor Buku:</label>
                <input type="text" name="nomor_buku" required>
                <br>
                <button type="submit">Pinjam Buku</button>
            </form>

            <!-- Feedback setelah peminjaman -->
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>
    </div>
</div>
@endsection