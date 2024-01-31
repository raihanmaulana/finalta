<!-- resources/views/admin/change-password.blade.php -->

@extends('anggota.index')
@section('custom_top_script')
@stop

@section('content')
<h2>Ganti Kata Sandi</h2>

@if(session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
<p style="color: red;">{{ session('error') }}</p>
@endif

<form method="post" action="{{ route('anggota.profile.change-password.post') }}">
    @csrf

    <label for="current_password">Kata Sandi Saat Ini:</label>
    <input type="password" name="current_password" required>

    <label for="new_password">Kata Sandi Baru:</label>
    <input type="password" name="new_password" required>

    <label for="new_password_confirmation">Konfirmasi Kata Sandi Baru:</label>
    <input type="password" name="new_password_confirmation" required>

    <button type="submit">Ganti Kata Sandi</button>
</form>
@stop

@section('custom_bottom_script')
<script type="text/javascript">
    var kategori_list = $('#kategori_list').val();
</script>
<script type="text/javascript" src="{{ asset('static/custom/js/script.addbook.js') }}"></script>
<script type="text/template" id="allbooks_show">
    @include('underscore.allbooks_show')
    @stop