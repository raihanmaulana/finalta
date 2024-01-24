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
            <label for="nama_anggota">Nama:</label>
            <input type="text" name="nama_anggota" id="nama_anggota" value="{{ old('nama_anggota') }}" required>
        </div>

        <!-- Email -->
        <div>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <!-- Nomor Anggota -->
        <div>
            <label for="nomor_anggota">Nomor Anggota:</label>
            <input type="text" name="nomor_anggota" id="nomor_anggota" value="{{ old('nomor_anggota') }}" required>
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