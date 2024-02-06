@extends('account.layout')

@section('index')
<body>
    <!-- Two content sections -->
    <div class="page page1">
    <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="container-fluid">
        <div class="row">
            <!-- Left Content -->
            <div class="col-md-6">
                        <!-- Grid 1: Card Buku Tamu Umum -->
                        <div class="card"> <!-- Tambahkan kelas bg-white untuk memberi background putih -->
                            <div class="card-body">
                                <div class="card-title">
                                    <div class="row">
                                        <div class="col-12">
                                            <h2>Buku Tamu Umum</h2>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" action="{{ route('guestbook.store') }}" class="row-6">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Masukkan Nama Anda" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Asal Daerah</label>
                                        <input type="text" name="message" class="form-control" id="message"
                                            placeholder="Masukkan Asal Daerah Anda" />
                                    </div>

                                    <div class="row-6 text-center center-content">
                                        <button type="submit" class="btn btn-dark btn-lg btn-block">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

            <!-- Right Content -->
            <div class="col-md-6" style="background: url({{ asset('css/images/bg.jpg') }}) no-repeat center center fixed; background-size: cover;">
                        <!-- Grid 2: Card Buku Tamu Anggota -->
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <div class="row">
                                        <div class="col-12">
                                            <h2>Buku Tamu Anggota</h2>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" action="{{ route('bukutamu_anggota.store') }}" class="row-6">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nomor_anggota" class="form-label">Nomor Anggota</label>
                                        <input type="text" name="nomor_anggota" class="form-control" id="nomor_anggota"
                                            placeholder="Masukkan Nomor Anggota Anda" />
                                    </div>

                                    <div class="row-6 text-center center-content">
                                        <button type="submit" class="btn btn-dark btn-lg btn-block">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#nomor_anggota').on('blur', function() {
                var nomorAnggota = $(this).val();

                // Pengecekan jika nomorAnggota tidak kosong
                if (nomorAnggota.trim() !== '') {
                    // Kirim AJAX request untuk mendapatkan informasi anggota
                    $.ajax({
                        url: '/getAnggotaInfo/' + nomorAnggota,
                        method: 'GET',
                        data: {
                            nomorAnggota: nomorAnggota
                        },
                        success: function(response) {
                            if (response.error) {
                                alert('Anggota tidak ditemukan!');
                            } else {
                                // Isi data otomatis pada form
                                $('#nama_anggota').val(response.nama_anggota);
                                $('#email_anggota').val(response.email_anggota);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('AJAX Error:', textStatus, errorThrown);
                            alert('Terjadi kesalahan saat mengambil data anggota.');
                        }
                    });
                }
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

@stop
