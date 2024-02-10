<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('css/images/logo.png') }}" type="image/x-icon">
    <title>Perpustakaan SMAN 1 Tunjungan</title>
    <script src="https://kit.fontawesome.com/d94b3a5809.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/utama/style.css') }}" />
    @yield('css')
</head>

<body>
    @include('layouts.navbar')
    @yield('content')
    @include('layouts.footer')
</body>

</html>
