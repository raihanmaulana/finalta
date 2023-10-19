<!DOCTYPE html>
<html>

<head>
    <title>Form Pendaftaran Anggota</title>
</head>

<body>
    <h2>Form Pendaftaran Anggota</h2>
    <form method="POST" action="{{ route('anggota.register') }}">
        @csrf

        <!-- Nama -->
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required>
        </div>

        <!-- Kata Sandi -->
        <div>
            <label for="password">Kata Sandi:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <!-- Konfirmasi Kata Sandi -->
        <div>
            <label for="password_confirmation">Konfirmasi Kata Sandi:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <!-- Tombol Daftar -->
        <div>
            <button type="submit">Daftar</button>
        </div>
    </form>
</body>

</html>