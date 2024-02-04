@extends('anggota.index') <!-- Sesuaikan dengan layout yang Anda gunakan -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profil') }}</div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('update_profil', $anggota->id_anggota) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="nama_anggota" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="nama_anggota" type="text" class="form-control" name="nama_anggota" value="{{ old('nama', $anggota->nama_anggota) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $anggota->email) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gambar" class="col-md-4 col-form-label text-md-right">{{ __('Foto Profil') }}</label>

                            <div class="col-md-6">
                                <input id="gambar" type="file" class="form-control-file" name="gambar">
                            </div>
                        </div>

                        <!-- Tambahkan atribut lainnya sesuai kebutuhan -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection