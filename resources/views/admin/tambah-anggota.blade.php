@extends('layout.index')

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Tambah Kategori</h3>
        </div>
        <div class="module-body">
            <!-- Tampilkan pesan error jika ada -->
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Tampilkan pesan berhasil jika ada -->
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.tambah-anggota.submit') }}">
                @csrf

                <div class="form-group">
                    <label for="nomor_anggota">Nomor Anggota</label>
                    <input id="nomor_anggota" type="text" class="form-control @error('nomor_anggota') is-invalid @enderror" name="nomor_anggota" value="{{ old('nomor_anggota') }}" required maxlength="20" autofocus>
                    <!-- @error('nomor_anggota')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror -->
                </div>
                <button type="submit" class="btn btn-inverse">Tambah</button>
                <a href="{{ URL::route('list-anggota') }}" class="btn btn-inverse">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection