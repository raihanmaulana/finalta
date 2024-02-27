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
                                <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
                                    rel="stylesheet">
                                <form class="form-vertical" id="loginForm" action="{{ URL::route('anggota.login') }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nomor_anggota" class="form-label">Nomor Anggota</label>
                                        <input type="text" class="form-control" id="nomor_anggota" name="nomor_anggota"
                                            placeholder="Masukkan Nomor Anggota Anda" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Kata Sandi</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Masukkan Kata Sandi Anda" required />

                                        </div>

                                        <div class="text-end"><a class="content-card text-end"
                                                href="{{ URL::route('password.request') }}" style="text-decoration: none;">
                                                Lupa Kata Sandi?</a> </div>
                                        <div id="passwordError" class="invalid-feedback" style="display: none;">Kata sandi
                                            salah. Silakan coba lagi.</div>
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



    @stop
