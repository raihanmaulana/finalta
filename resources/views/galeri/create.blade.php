<!DOCTYPE html>
<html>

<head>
    <title>Tambah Gambar Galeri</title>
</head>

<body>
    <h2>Tambah Gambar Galeri</h2>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="judul">Judul Gambar:</label><br>
            <input type="text" id="judul" name="judul"><br>
        </div>
        <div>
            <label for="gambar_galeri">Gambar:</label><br>
            <input type="file" id="gambar_galeri" name="gambar_galeri"><br>
        </div>
        <div>
            <button type="submit">Tambah Gambar</button>
        </div>
    </form>
</body>

</html>