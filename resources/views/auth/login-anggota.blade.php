<!DOCTYPE html>
<html>

<head>
    <title>Login Anggota Perpustakaan</title>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="public\css\dashboard.css">
</head>
</head>

<body>
    <h2>Login Anggota Perpustakaan</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('anggota.login') }}">
        @csrf
        <label for="nomor_anggota">Nomor Anggota:</label>
        <input type="text" id="nomor_anggota" name="nomor_anggota" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>

    <form class="d-flex">
                    <a class="btn btn-outline-primary" href="anggota.register" role="button">Register</a>
                    <ul>
    </form>
</body>

</html>