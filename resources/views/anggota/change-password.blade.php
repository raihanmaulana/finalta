@extends('anggota.index')
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

            <form method="post" action="{{ route('anggota.profile.change-password.post') }}">
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
                        <a href="{{ URL::route('anggota.profile') }}" class="btn btn-inverse">Kembali</a>
                    </div>
                </div>
            </form>



        </div>
    </div>
</div>
@endsection

@section('custom_bottom_script')
<script type="text/javascript">
    var kategori_list = $('#kategori_list').val();
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector("form").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get form data
            var formData = new FormData(this);

            // Submit the form using AJAX
            fetch(this.action, {
                    method: this.method,
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        // If password change is successful, show success popup
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Kata sandi berhasil diubah.',
                        }).then((result) => {
                            // Redirect to profile page after OK button is clicked
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('anggota.profile') }}";
                            }
                        });
                    } else {
                        // If there is an error, show an error popup
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat mengubah kata sandi. Pastikan kata sandi saat ini benar dan konfirmasi kata sandi baru sesuai.',
                        });
                    }
                })
                .catch(error => {
                    // If there is an error, show an error popup
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat mengubah kata sandi. Silakan coba lagi.',
                    });
                });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" src="{{ asset('static/custom/js/script.addbook.js') }}"></script>
<script type="text/template" id="allbooks_show">
    @include('underscore.allbooks_show')
    @stop