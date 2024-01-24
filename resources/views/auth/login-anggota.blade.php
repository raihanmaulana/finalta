<!DOCTYPE html>
<html>

<head>
    <title>Login Anggota Perpustakaan</title>
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
</body>

</html>