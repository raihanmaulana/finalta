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
                                <img src="{{ asset('css/images/header/header.png') }}" class="img-fluid" />
                            </div>

                        </div>
                    </div>


                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="row px-2">
                            <button type="submit" class="btn btn-dark btn-lg btn-block content-card">
                                {{ __('Kirim Link Ubah Kata Sandi') }}
                            </button>
                        </div>
                        <div class="mt-3 text-center content-card">
                            Ingat Kata Sandi?
                            <a class="content-card" href="{{ URL::route('account-sign-in') }}" style="text-decoration: none;">Masuk Admin ||</a>
                            <a class="content-card" href="{{ URL::route('anggota.login') }}" style="text-decoration: none;">Masuk Anggota</a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection