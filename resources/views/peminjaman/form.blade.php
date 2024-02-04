{{-- <div class="module">
    <div class="module-head">
        <h3>Form Peminjaman</h3>
    </div>
    <div class="module-body">
        <!-- Form Peminjaman -->
        <form method="post" action="{{ route('peminjaman.pinjam') }}">
            @csrf
            <label for="nomor_anggota">Nomor Anggota:</label>
            <input type="text" name="nomor_anggota" required>
            <br>
            <label for="nomor_buku">Nomor Buku:</label>
            <input type="text" name="nomor_buku" required>
            <br>
            <button type="submit">Pinjam Buku</button>
        </form>

        <!-- Feedback setelah peminjaman -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
</div> --}}

@extends('peminjaman.index')

@section('content')
    <div class="content">
        <div class="btn-controls">
            <div class="btn-box-row row-fluid">
                <button class="btn-box span12" style="background: #025E9B; ">
                    <b style="color:#fff">Perpustakaan SMA Negeri 1 Tunjungan</b>
                </button>
            </div>

            <div class="btn-box-row row-fluid">
                <button class="btn-box big span6 homepage-form-box btn-hover" id="findbookbox">
                    <i class="icon-search" style="color: #025E9B"></i>
                    <b>Cari Buku</b>
                </button>

                <button class="btn-box big span6 homepage-form-box btn-hover" id="findissuebox">
                    <i class="icon-book" style="color: #025E9B"></i>
                    <b>Pinjam Buku</b>
                </button>
            </div>
            <div class="module-body">
                <!-- Form Peminjaman -->
                <form method="post" action="{{ route('peminjaman.pinjam') }}">
                    @csrf
                    <label for="nomor_anggota">Nomor Anggota:</label>
                    <input type="text" name="nomor_anggota" required>
                    <br>
                    <label for="nomor_buku">Nomor Buku:</label>
                    <input type="text" name="nomor_buku" required>
                    <br>
                    <button type="submit">Pinjam Buku</button>
                </form>

                <!-- Feedback setelah peminjaman -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </div>

        </div>
    </div>
@endsection
