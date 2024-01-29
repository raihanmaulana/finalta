<!-- resources/views/public/all_books.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Semua Buku</h2>
    <!-- Form Pencarian -->
    <form action="{{ route('cari-buku') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Cari buku...">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
    @if ($books->isEmpty())
    <p>Tidak ada buku.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Nomor Buku</th>
                <th>Judul Buku</th>
                <th>Penerbit</th>
                <th>Pengarang</th>
                <th>Tahun Terbit</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{ $book->nomor_buku }}</td>
                <td>{{ $book->judul_buku }}</td>
                <td>{{ $book->penerbit }}</td>
                <td>{{ $book->pengarang }}</td>
                <td>{{ $book->tahun_terbit }}</td>
                <td>
                    @if ($book->image_path)
                    <img src="{{ asset($book->image_path) }}" alt="Book Image" style="max-width: 100px; max-height: 100px;">
                    @else
                    No Image
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection