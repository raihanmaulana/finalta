<!DOCTYPE html>
<html>

<head>
    <title>Galeri</title>
</head>

<body>
    <h2>Galeri</h2>
    @foreach ($galeri as $item)
    <div>
        <h3>{{ $item->judul }}</h3>
        <img src="{{ $item->gambar_galeri }}" alt="{{ $item->judul }}" width="300">
    </div>
    @endforeach
</body>

</html>