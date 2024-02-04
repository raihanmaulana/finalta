@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Profile Admin</h3>
            </div>
            <div class="module-body">

                <h2>{{ $user->name }}</h2>
                <p>Username: {{ $user->username }}</p>
                <p>Email: {{ $user->email }}</p>

                <a href="{{ route('admin.profile.change-password') }}">Ganti Kata Sandi</a>



            </div>
        </div>
    </div>
@endsection
@section('custom_bottom_script')

    {{-- @extends('layout.index')
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
    @stop --}}
