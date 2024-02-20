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
            <form id="changePasswordForm" action="{{ route('admin.profile.change-password.post') }}" method="POST">
                @csrf
                @method('POST')

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
                        <button type="button" style="margin-right:10px" class="btn btn-inverse" onclick="changePassword()">Ganti Kata Sandi</button>

                        <a href="{{ URL::route('admin.profile') }}" class="btn btn-inverse">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- JavaScript untuk menampilkan SweetAlert2 saat berhasil atau gagal mengubah kata sandi -->
<script>
    function changePassword() {
        // Menggunakan AJAX untuk mengirim permintaan POST
        $.ajax({
            url: "{{ route('admin.profile.change-password.post') }}",
            type: "POST",
            data: $('#changePasswordForm').serialize(), // Mengambil data dari formulir
            success: function(response) {
                // Jika permintaan berhasil
                Swal.fire({
                    title: "Berhasil!",
                    text: "Kata sandi berhasil diubah.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000 // Mengatur timer selama 2 detik (2000 milidetik)
                });
                setTimeout(function() {
                    // Redirect ke halaman profil setelah 2 detik
                    window.location.href = "{{ route('admin.profile') }}";
                }, 2000);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: "Gagal!",
                    text: "Password gagal diubah!",
                    icon: "error",
                    showConfirmButton: true,
                });
            }

        });
    }
</script>
@endsection