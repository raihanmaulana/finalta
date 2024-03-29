@extends('account.layout')
@section('create')

<div class="page page1">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-12 col-md-8 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{ asset('css/images/header/regisadmin.png') }}" class="img-fluid" />
                            </div>

                        </div>
                    </div>
                    <form class="row-6" action="{{ URL::route('account-create-post') }}" method="POST" id="registrationForm">
                        @csrf
                        <div class="mt-3 text-start content-card">
                            <strong>Semua wajib diisi!</strong>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Anda" name="nama" value="{{ Request::old('nama') }}" />
                            @if ($errors->has('nama'))
                            {{ $errors->first('nama') }}
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Masukkan Username Anda" name="username" value="{{ Request::old('username') }}" />
                            @if ($errors->has('username'))
                            {{ $errors->first('username') }}
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Masukkan Email Anda" name="email" value="{{ Request::old('email') }}" />
                            @if ($errors->has('email'))
                            {{ $errors->first('email') }}
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi (min. 8
                                karakter)</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi Anda" />
                            @if ($errors->has('password'))
                            {{ $errors->first('password') }}
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="password_again" class="form-label">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control" id="password_again" name="password_again" placeholder="Masukkan Kembali Kata Sandi Anda" />
                            @if ($errors->has('password_again'))
                            {{ $errors->first('password_again') }}
                            @endif
                        </div>
                        <div class="row px-2">
                            <button type="submit" class="btn btn-dark btn-lg btn-block content-card">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@stop

@section('custom_bottom_script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const registrationForm = document.getElementById('registrationForm');
        registrationForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Submit the form data using AJAX
            fetch('{{ route("account-create-post") }}', {
                    method: 'POST',
                    body: new FormData(registrationForm)
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registrasi Berhasil!',
                            text: 'Anda berhasil membuat akun.'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('home') }}"; // Redirect to home page
                            }
                        });
                    } else {
                        throw new Error('Registrasi gagal.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>
@endsection