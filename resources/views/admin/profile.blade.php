<!-- resources/views/admin/profile.blade.php -->

@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')
<h1>Profil Admin: {{ $user->username }}</h1>
<p>ID: {{ $user->id }}</p>
<p>Username: {{ $user->username }}</p>

<a href="{{ route('admin.profile.change-password') }}">Ganti Kata Sandi</a>
@stop

@section('custom_bottom_script')
<script type="text/javascript">
    var kategori_list = $('#kategori_list').val();
</script>
<script type="text/javascript" src="{{ asset('static/custom/js/script.addbook.js') }}"></script>
<script type="text/template" id="allbooks_show">
    @include('underscore.allbooks_show')
    @stop