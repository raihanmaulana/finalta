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
                                    <img src="{{ asset('css/images/header/loginadmin.png') }}" class="img-fluid" />
                                </div>
                                <form class="form-vertical" action="{{ URL::route('account-sign-in-post') }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username"
                                            placeholder="Masukkan Nomor Anggota Anda" value="{{ Request::old('login') }}" />
                                        @if ($errors->has('user_login'))
                                            {{ $errors->first('login') }}
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Kata Sandi</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Masukkan Kata Sandi Anda" />
                                        @if ($errors->has('password'))
                                            {{ $errors->first('password') }}
                                        @endif
                                        <div class="text-end"><a class="content-card text-end"
                                                href="{{ URL::route('password.request') }}" style="text-decoration: none;">
                                                Lupa Kata Sandi?</a> </div>
                                    </div>
                                    <div class="row px-2">
                                        <button type="submit"
                                            class="btn btn-dark btn-lg btn-block content-card">Login</button>
                                    </div>
                                    <div class="mt-3 text-center content-card">
                                        Tidak memiliki akun?
                                        <a class="content-card" href="{{ URL::route('account-create') }}"
                                            style="text-decoration: none;">Daftar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop
