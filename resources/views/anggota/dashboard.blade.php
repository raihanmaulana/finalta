@extends('anggota.index')
@section('custom_top_script')
@stop
@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h2>Perpustakaan SMA Negeri 1 Tunjungan</h2>
        </div>
        <div class="module-body text">
            <h3>Selamat Datang, {{ Auth::user()->username }}!</h3>
            <p>Silahkan untuk meminjam buku pada tab Peminjaman Buku. Anda dapat memantau buku pada
                tab Status
                Peminjaman. Buku yang ingin dipinjam dapat diambil di Perpustakaan SMA Negeri 1 Tunjungan</p>
            <p>Hubungi Admin jika Anda memiliki kendala</p>
            <p>Kontak Admin : 08XX-XXXX-XXXX</p>
        </div>
    </div>
</div>
</div>
@endsection

{{-- <div class="btn-controls">
            <div class="btn-box-row row-fluid">
                <button class="btn-box span12" style="background: #025E9B; ">
                    <b style="color:#fff">Perpustakaan SMA Negeri 1 Tunjungan</b>
                </button>
            </div>
            <div class="btn-box-row row-fluid">
                <button class="btn-box span12" id="findbookbox">
                    <b>Selamat Datang</b>
                </button>
            </div> --}}