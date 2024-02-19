@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Anggota</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.tambah-anggota.submit') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nomor_anggota">Nomor Anggota</label>
                            <input id="nomor_anggota" type="text" class="form-control @error('nomor_anggota') is-invalid @enderror" name="nomor_anggota" value="{{ old('nomor_anggota') }}" required autofocus>
                            @error('nomor_anggota')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection