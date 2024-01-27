<!DOCTYPE html>
<html>

<head>
    <title>Form Pendaftaran Anggota</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        <!-- Jurusan Dropdown -->
        <div>
            <label for="jurusan">Jurusan:</label>
            <select name="jurusan" id="jurusan" required>
                <option value="IPA">IPA</option>
                <option value="IPS">IPS</option>
            </select>
        </div>

        <!-- Kelas Dropdown -->
        <div>
            <label for="kelas">Kelas:</label>
            <select name="kelas" id="kelas" required>
                <option value="" selected disabled>Pilih Kelas</option>
                <!-- Opsi untuk semua kelas -->
                <optgroup label="IPA">
                    <option value="10 IPA 1">10 IPA 1</option>
                    <option value="10 IPA 2">10 IPA 2</option>
                    <option value="11 IPA 1">11 IPA 1</option>
                    <option value="11 IPA 2">11 IPA 2</option>
                    <option value="12 IPA 1">12 IPA 1</option>
                    <option value="12 IPA 2">12 IPA 2</option>
                </optgroup>
                <optgroup label="IPS">
                    <option value="10 IPS 1">10 IPS 1</option>
                    <option value="10 IPS 2">10 IPS 2</option>
                    <option value="11 IPS 1">11 IPS 1</option>
                    <option value="11 IPS 2">11 IPS 2</option>
                    <option value="12 IPS 1">12 IPS 1</option>
                    <option value="12 IPS 2">12 IPS 2</option>
                </optgroup>
            </select>
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
    <script>
        // Menggunakan jQuery untuk mengubah opsi kelas berdasarkan pilihan jurusan
        $(document).ready(function() {
            // Sembunyikan semua opsi kelas saat halaman dimuat
            $('#kelas optgroup').hide();

            // Tampilkan opsi kelas yang sesuai dengan jurusan yang dipilih
            $('#jurusan').change(function() {
                var selectedJurusan = $(this).val();
                $('#kelas optgroup').hide();
                $('#kelas optgroup[label="' + selectedJurusan + '"]').show();
            });
        });
    </script>
</body>

</html>