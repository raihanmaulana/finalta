<!DOCTYPE html>
<html>

<head>
    <title>Login Anggota Perpustakaan</title>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="public\css\dashboard.css">
</head>


<body>
    <h2>Login Anggota Perpustakaan</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('anggota.login') }}">
        @csrf
        <label for="nomor_anggota">Nomor Anggota:</label>
        <input type="text" id="nomor_anggota" name="nomor_anggota" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>

    <form class="d-flex">
        <a class="btn btn-outline-primary" href="anggota/register" role="button">Register</a>
        <ul>
    </form>
</body>
@extends('account.layout')
@section('index')
    <div class="page page1">
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="col-12 col-md-8 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('css/images/logo.png') }}" class="img-fluid" />
                                </div>
                                <div class="col-9">
                                    <h2>PERPUSTAKAAN SMA NEGERI 1 TUNJUNGAN</h2>
                                </div>
                                <form class="form-vertical" action="{{ URL::route('anggota.login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nomor_anggota" class="form-label">Nomor Anggota</label>
                                        <input type="text" class="form-control" id="nomor_anggota" name="nomor_anggota"
                                            placeholder="Masukkan Nomor Anggota Anda"required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Kata Sandi</label>
                                        <input type="password" class="form-control" id="password" name="password" required
                                            placeholder="Masukkan Kata Sandi Anda" />
                                    </div>
                                    <div class="module-foot">
                                        <div class="control-group">
                                            <div class="controls clearfix">
                                                <div class="row-6 text-center center-content">
                                                    <button type="submit"
                                                        class="btn btn-dark btn-lg btn-block">Login</button>
                                                </div>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="remember" id="remember"> Remember me
                                                </label>
                                            </div>
                                        </div>
                                        <a href="{{ URL::route('anggota.register') }}">Anggota Baru? Daftar</a>
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
