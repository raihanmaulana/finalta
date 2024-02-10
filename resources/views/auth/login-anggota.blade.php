    @extends('account.layout')
    @section('index')
        <div class="page page1">
            <div class="container d-flex justify-content-center align-items-center vh-100">
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="card">
                        <div class="card-body px-4 pt-4">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="{{ asset('css/images/header/loginanggota.png') }}" class="img-fluid" />
                                    </div>
                                    <form class="form-vertical" action="{{ URL::route('anggota.login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nomor_anggota" class="form-label">Nomor Anggota</label>
                                            <input type="text" class="form-control" id="nomor_anggota"
                                                name="nomor_anggota" placeholder="Masukkan Nomor Anggota Anda" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Kata Sandi</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                required placeholder="Masukkan Kata Sandi Anda" />
                                            <div class="text-end"><a class="content-card text-end"
                                                    href="{{ URL::route('anggota.register') }}"
                                                    style="text-decoration: none;">
                                                    Lupa Kata Sandi?</a> </div>
                                            <div id="passwordError" class="invalid-feedback" style="display: none;">Kata
                                                sandi salah. Silakan coba lagi.</div>
                                        </div>
                                        <div class="row px-2">
                                            <button type="submit"
                                                class="btn btn-dark btn-lg btn-block content-card">Login</button>
                                        </div>
                                        <div class="mt-3 text-center content-card">
                                            Tidak memiliki akun?
                                            <a class="content-card" href="{{ URL::route('anggota.register') }}"
                                                style="text-decoration: none;">Daftar</a>
                                        </div>

                                    </form>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // JavaScript to handle form submission
            document.getElementById('loginForm').addEventListener('submit', function(event) {
                // Prevent the form from submitting
                event.preventDefault();

                // Get the password input and error message elements
                var passwordInput = document.getElementById('password');
                var passwordError = document.getElementById('passwordError');

                // Validate the password (example: the correct password is "password")
                if (passwordInput.value !== 'password') {
                    // If password is invalid, display error message
                    passwordError.style.display = 'block';
                } else {
                    // If password is valid, submit the form
                    this.submit();
                }
            });

            // JavaScript to hide error message when password input changes
            document.getElementById('password').addEventListener('input', function() {
                document.getElementById('passwordError').style.display = 'none';
            });
        </script>

    @stop
