<!DOCTYPE html>
<html>

<head>
    <title>Unggah Gambar</title>
</head>

<body>
    <h2>Unggah Gambar</h2>
    @if ($errors->any())
    <div>
        <strong>Whoops!</strong> Ada masalah dengan inputan Anda.<br><br>
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
            <strong>Judul:</strong>
            <input type="text" name="judul" required>
        </div>
        <div>
            <strong>Gambar:</strong>
            <input type="file" name="gambar_galeri" required>
        </div>
        <button type="submit">Unggah</button>
    </form>
</body>

</html>