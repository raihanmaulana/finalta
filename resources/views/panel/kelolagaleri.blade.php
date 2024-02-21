@extends('layout.index')

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Kelola Anggota</h3>
        </div>
        <div class="module-body">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galeri as $key => $gambar)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $gambar->judul }}</td>
                        <td><img src="{{ asset('storage/' . $gambar->gambar_galeri) }}" alt="{{ $gambar->judul }}" width="100"></td>
                        <td>{{ $gambar->deskripsi }}</td>
                        <td>
                            <a href="{{ route('galeri.edit', ['id' => $gambar->id]) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('galeri.show', ['id' => $gambar->id]) }}" class="btn btn-info">Detail</a>

                            <form action="{{ route('galeri.destroy', ['id' => $gambar->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection