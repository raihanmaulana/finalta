@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Ganti Kata Sandi</h3>
            </div>
            <div class="module-body">

                @if (session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif

                @if (session('error'))
                    <p style="color: red;">{{ session('error') }}</p>
                @endif

                <form method="post" action="{{ route('admin.profile.change-password.post') }}">
                    @csrf

                    <label for="current_password">Kata Sandi Saat Ini:</label>
                    <input type="password" name="current_password" required>

                    <label for="new_password">Kata Sandi Baru:</label>
                    <input type="password" name="new_password" required>

                    <label for="new_password_confirmation">Konfirmasi Kata Sandi Baru:</label>
                    <input type="password" name="new_password_confirmation" required>

                    <div class="row">
                        <div class="span12">
                        </div>
                        <div class="span12">
                            <button type="submit" style="margin-right:10px" class="btn btn-inverse">Ganti Kata
                                Sandi</button>
                            <a href="{{ URL::route('admin.profile') }}" class="btn btn-inverse">Kembali</a>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
@endsection
