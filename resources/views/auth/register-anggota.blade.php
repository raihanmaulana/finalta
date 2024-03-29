@extends('account.layout')
@section('index')
    <div class="page page1">
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="col-12 col-md-8 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-12">
                                    <img src="{{ asset('css/images/header/regisanggota.png') }}" class="img-fluid" />
                                </div>

                            </div>
                        </div>

                        <form class="row g-3" method="POST" action="{{ route('anggota.register') }}">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    Nomor Anggota Tidak Terdaftar atau Sudah Memiliki Akun!
                                </div>
                            @endif
                            <div class="mt-4 text-start content-card">
                                <div><small>Hanya yang memiliki Nomor Anggota yang dapat melakukan
                                        registrasi</small></div>
                                <strong>Semua wajib diisi!</strong>
                            </div>
                            <div class="col-12 ">
                                <label for="nama_anggota" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama_anggota" id="nama_anggota"
                                    value="{{ old('nama_anggota') }}" required>
                            </div>
                            <div class="col-6">
                                <label for="nomor_anggota" class="form-label">Nomor Anggota</label>
                                <input type="text" class="form-control" name="nomor_anggota" id="nomor_anggota"
                                    value="{{ old('nomor_anggota') }}" required>
                            </div>
                            <div class="col-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                    value="{{ old('username') }}" required>
                            </div>
                            <div class="col-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="col-6">
                                <label for="nomor_hp" class="form-label">Nomor Hp</label>
                                <input type="text" class="form-control" name="nomor_hp" id="nomor_hp"
                                    value="{{ old('nomor_hp') }}" required>
                            </div>
                            <div class="col-6">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <select name="jurusan" class="form-control" id="jurusan" required>
                                    <option value="" selected disabled>Pilih Jurusan</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select name="kelas" class="form-control" id="kelas" required>
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
                            <div class="col-6">
                                <label for="password" class="form-label">Kata Sandi (min. 8
                                    karakter)</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password" required>

                                </div>
                            </div>
                            <div class="col-6">
                                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" required>

                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit"
                                    class="btn btn-dark btn-lg btn-block content-card full-width-button">Daftar</button>
                            </div>
                            <div class="mt-3 text-center content-card">
                                Sudah memiliki akun?
                                <a class="content-card" href="{{ URL::route('anggota.login') }}"
                                    style="text-decoration: none;">Masuk</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script>
        // Menggunakan jQuegubah opsi kelas berdasarkan pilihan jurusan
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
