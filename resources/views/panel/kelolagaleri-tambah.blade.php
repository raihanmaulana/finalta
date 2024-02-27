@extends('layout.index')
@section('custom_top_script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Sisipkan SweetAlert di sini jika belum dilakukan -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Tambah Galeri</h3>
            </div>
            <div class="module-body">
                <form id="tambahGaleriForm" action="{{ route('galeri.store') }}" method="POST">
                    @csrf
                    @method('POST')


                    <label for="judul">Judul Gambar:</label>
                    <input type="text" class="form-control" id="judul" name="judul">


                    <label for="deskripsi">Deskripsi Gambar:</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi">


                    <label for="gambar_galeri">Gambar:</label>
                    <input type="file" class="form-control-file" id="gambar_galeri" name="gambar_galeri">


                    <div class="row">
                        <div class="span12">
                        </div>
                        <div class="span12">
                            <button type="submit" style="margin-right:10px" class="btn btn-inverse">Ganti Kata
                                Sandi</button>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // jQuery AJAX untuk pengiriman formulir
        $(document).ready(function() {
            $('#tambahGaleriForm').submit(function(e) {
                e.preventDefault(); // Mencegah formulir dikirim menggunakan metode biasa

                // Mengumpulkan data formulir
                var formData = new FormData(this);

                // Mengirimkan data ke server menggunakan AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Menampilkan pesan sukses jika operasi berhasil
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Berhasil Menambahkan Galeri!",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            // Setelah menampilkan pesan sukses, alihkan ke halaman kelola galeri
                            window.location.href = "{{ route('galeri.manage') }}";
                        });
                    },
                    error: function(xhr, status, error) {
                        // Menampilkan pesan kesalahan jika terjadi kesalahan
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Gagal Menambahkan Galeri!',
                        });
                    }
                });
            });
        });
    </script>
@endsection
