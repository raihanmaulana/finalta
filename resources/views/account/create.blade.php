@extends('account.layout')
@section('create')

<div class="page page2">
  <div class="container d-flex justify-content-end align-items-center vh-100">
    <div class="col-12 col-md-12 col-lg-6">
      <div class="card">
        <div class="card-body">
          <div class="card-title">
            <div class="row">
              <div class="col-2">
                <img src="{{asset('css/images/logo.png')}}" class="img-fluid img-logo" />
              </div>
              <div class="col-10">
                <h2>PERPUSTAKAAN SMA NEGERI 1 TUNJUNGAN</h2>
              </div>
            </div>
          </div>
          <form class="row-6" action="{{ URL::route('account-create-post') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Nama</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Nama Anda" name="nama" value="{{ Request::old('nama') }}" />
              @if($errors->has('nama'))
              {{ $errors->first('nama')}}
              @endif
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Username</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Username Anda" name="username" value="{{ Request::old('username') }}" />
              @if($errors->has('username'))
              {{ $errors->first('username')}}
              @endif
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Email</label>
              <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Email Anda" name="email" value="{{ Request::old('email') }}" />
              @if($errors->has('email'))
              {{ $errors->first('email')}}
              @endif
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Kata Sandi</label>
              <input type="password" class="form-control" name="password" placeholder="Masukkan Kata Sandi Anda" />
              @if($errors->has('password'))
              {{ $errors->first('password')}}
              @endif
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Konfirmasi Kata Sandi</label>
              <input type="password" class="form-control" name="password_again" placeholder="Masukkan Kembali Kata Sandi Anda" />
              @if($errors->has('password_again'))
              {{ $errors->first('password_again')}}
              @endif
            </div>
            <div class="row-6 text-center center-content">
              <button type="submit" class="btn btn-dark btn-lg btn-block">Buat Akun</button>
            </div>
            <a href="{{ URL::route('account-sign-in') }}">Already A User?</a>
            <a href="{{ route('password.request') }}">Forgot Your Password?</a>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

@stop