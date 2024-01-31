<!-- resources/views/admin/profile.blade.php -->

@extends('anggota.index')
@section('custom_top_script')
@stop

@section('content')
<h1>Profil Anggota: {{ $user->nama_anggota }}</h1>
<p>Nomor Anggota: {{ $user->nomor_anggota }}</p>
<p>Email: {{ $user->email }}</p>
<p>Jurusan: {{ $user->jurusan }}</p>
<p>Kelas: {{ $user->kelas }}</p>

<a href="{{ route('anggota.profile.change-password') }}">Ganti Kata Sandi</a>
@stop

@section('custom_bottom_script')
<script type="text/javascript">
    var kategori_list = $('#kategori_list').val();
</script>
<script type="text/javascript" src="{{ asset('static/custom/js/script.addbook.js') }}"></script>
<script type="text/template" id="allbooks_show">
    @include('underscore.allbooks_show')
    @stop