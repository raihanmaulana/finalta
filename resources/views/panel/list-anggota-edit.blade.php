@extends('layout.index')

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Edit Anggota</h3>
            </div>
            <div class="module-body">
                <form method="POST" action="{{ route('list-anggota-updateAnggota', ['id' => $anggota->id_anggota]) }}">
                    @csrf
                    @method('PUT')

                    <!-- Tambahkan input fields sesuai kebutuhan -->
                    <div class="form-group">
                        <label for="nomor_anggota">Nomor Anggota:</label>
                        <input type="text" class="form-control" id="nomor_anggota" name="nomor_anggota"
                            value="{{ $anggota->nomor_anggota }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_anggota">Nama Anggota:</label>
                        <input type="text" class="form-control" id="nama_anggota" name="nama_anggota"
                            value="{{ $anggota->nama_anggota }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ $anggota->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan:</label>
                        <select name="jurusan" class="form-control" id="jurusan" required>
                            <option value="" disabled>Pilih Jurusan</option>
                            <option value="IPA" {{ $anggota->jurusan == 'IPA' ? 'selected' : '' }}>IPA</option>
                            <option value="IPS" {{ $anggota->jurusan == 'IPS' ? 'selected' : '' }}>IPS</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas:</label>
                        <select name="kelas" class="form-control" id="kelas" required>
                            <!-- Opsi kelas akan ditambahkan melalui JavaScript -->
                        </select>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-inverse">Simpan</button>
                            <a href="{{ URL::route('list-anggota') }}" class="btn btn-inverse">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Menggunakan jQuery untuk menampilkan opsi kelas berdasarkan pilihan jurusan
        $(document).ready(function() {
            // Ketika pilihan jurusan diubah, tampilkan opsi kelas yang sesuai
            $('#jurusan').change(function() {
                updateKelasOptions();
            });

            // Fungsi untuk menampilkan opsi kelas yang sesuai dengan jurusan yang dipilih
            function updateKelasOptions() {
                var selectedJurusan = $('#jurusan').val();
                $('#kelas').empty(); // Kosongkan opsi kelas terlebih dahulu
                // Tambahkan opsi kelas sesuai dengan jurusan yang dipilih
                if (selectedJurusan === 'IPA') {
                    $('#kelas').append(`
                    <option value="10 IPA 1">10 IPA 1</option>
                    <option value="10 IPA 2">10 IPA 2</option>
                    <option value="11 IPA 1">11 IPA 1</option>
                    <option value="11 IPA 2">11 IPA 2</option>
                    <option value="12 IPA 1">12 IPA 1</option>
                    <option value="12 IPA 2">12 IPA 2</option>
                `);
                } else if (selectedJurusan === 'IPS') {
                    $('#kelas').append(`
                    <option value="10 IPS 1">10 IPS 1</option>
                    <option value="10 IPS 2">10 IPS 2</option>
                    <option value="11 IPS 1">11 IPS 1</option>
                    <option value="11 IPS 2">11 IPS 2</option>
                    <option value="12 IPS 1">12 IPS 1</option>
                    <option value="12 IPS 2">12 IPS 2</option>
                `);
                }
            }
        });
    </script>
@endsection
