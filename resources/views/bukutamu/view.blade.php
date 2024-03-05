@extends('account.layout')

@section('index')
<style>
    .btn {
        font-size: 12px;
    }

    .text-shadow {
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        /* Bayangan teks */
    }
</style>

<body>
    <!-- Two content sections -->
    <div class="page page1">
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="container-fluid">
                <div class="row g-3">
                    <!-- Left Content -->
                    <div class="col-12 col-md-12 col-lg-6 d-flex justify-content-center align-items-center">
                        <div class="row" data-aos="zoom-in-right">
                            <div class="col-3">
                                <img src="{{ asset('css/images/logo.png') }}" alt="Logo" class="img-fluid logo-image">
                            </div>
                            <div class="col-9 text-black text-shadow">
                                <h2>Perpustakaan SMA Negeri 1 Tunjungan</h2>
                                <p class=" text-shadow" style="font-weight: 500">Silahkan mengisi Buku Tamu untuk
                                    mengakses
                                    Perpustakaan ini
                                </p>
                            </div>
                        </div>
                    </div>


                    <!-- Right Content -->
                    <div class="col-12 col-md-12 col-lg-6">
                        <!-- Grid 2: Card Buku Tamu Anggota -->
                        <div class="row mb-3">
                            <div class="card w-50 mx-auto" style="background-color: #f0f0f0;" data-aos="zoom-in-left">
                                <div class="card-body">
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 style="font-size: 20px">Buku Tamu Anggota</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="post" action="{{ route('bukutamu_anggota.store') }}" class="row-6">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nomor_anggota" class="form-label">Nomor Anggota</label>
                                            <input type="text" name="nomor_anggota" class="form-control" id="nomor_anggota" placeholder="Masukkan Nomor Anggota Anda" />
                                        </div>

                                        <div class="row-6 text-center center-content">
                                            <button type="submit" class="btn btn-dark btn-block w-100">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="card w-50 mx-auto" style="background-color: #f0f0f0;" data-aos="zoom-in-left">
                                <!-- Tambahkan kelas bg-white untuk memberi background putih -->
                                <div class="card-body">
                                    <div class="card-title">
                                        <h2 style="font-size: 20px">Buku Tamu Umum</h2>
                                    </div>
                                    <form method="post" action="{{ route('bukutamu.store') }}" class="row-6">
                                        @csrf
                                        <div class="mb-1">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Anda" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="asal_daerah" class="form-label">Asal Daerah</label>
                                            <input type="text" name="asal_daerah" class="form-control" id="asal_daerah" placeholder="Masukkan Asal Daerah Anda" />
                                        </div>

                                        <div class="row-6 text-center center-content">
                                            <button type="submit" class="btn btn-dark btn-block w-100">Masuk</button>
                                        </div>
                                    </form>
                                </div>
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


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
            </script>
</body>

@stop