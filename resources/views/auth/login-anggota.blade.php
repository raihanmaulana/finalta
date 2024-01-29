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
