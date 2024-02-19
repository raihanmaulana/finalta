@extends('anggota.index') <!-- Sesuaikan dengan layout yang Anda gunakan -->

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Profile Anggota</h3>
        </div>

        <div class="module-body">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('update_profil', $anggota->id_anggota) }}" enctype="multipart/form-data">
                @csrf


                <label for="nama_anggota">{{ __('Nama') }}</label>


                <input id="nama_anggota" type="text" class="form-control" name="nama_anggota" value="{{ old('nama', $anggota->nama_anggota) }}" required>

                <label for="username">{{ __('Username') }}</label>

                <input id="username" type="text" class="form-control" name="username" value="{{ old('username', $anggota->username) }}" required>

                <label for="email">{{ __('Alamat Email') }}</label>


                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $anggota->email) }}" required>


                <label for="gambar">{{ __('Foto Profil') }}</label>


                <input id="gambar" type="file" class="form-control-file" name="gambar">


                <!-- Tambahkan atribut lainnya sesuai kebutuhan -->

                <div class="row" style="margin-top: 10px">
                    <div class="span12">
                        <button type="submit" class="btn btn-inverse">
                            {{ __('Simpan') }}
                        </button>
                        <a href="{{ URL::route('anggota.profile') }}" class="btn btn-inverse">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection