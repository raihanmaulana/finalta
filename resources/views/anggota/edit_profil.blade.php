@extends('anggota.index')

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Profile Anggota</h3>
        </div>

        <div class="module-body">
            <form method="POST" action="{{ route('update_profil', $anggota->id_anggota) }}" enctype="multipart/form-data" id="updateForm">
                @csrf

                <label for="nama_anggota">{{ __('Nama') }}</label>
                <input id="nama_anggota" type="text" class="form-control" name="nama_anggota" value="{{ old('nama', $anggota->nama_anggota) }}" required>

                <label for="username">{{ __('Username') }}</label>
                <input id="username" type="text" class="form-control" name="username" value="{{ old('username', $anggota->username) }}" required>

                <label for="email">{{ __('Alamat Email') }}</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $anggota->email) }}" required>

                <label for="nomor_hp">{{ __('Nomor HP') }}</label>
                <input id="nomor_hp" type="nomor_hp" class="form-control" name="nomor_hp" value="{{ old('nomor_hp', $anggota->nomor_hp) }}" required>

                <label for="gambar">{{ __('Foto Profil') }} (Maksimal 2MB)</label>
                <input id="gambar" type="file" class="form-control-file" name="gambar">

                <div class="row" style="margin-top: 10px">
                    <div class="span12">
                        <button type="submit" class="btn btn-inverse">
                            {{ __('Simpan') }}
                        </button>
                        <a href="{{ URL::route('anggota.profile') }}" class="btn btn-inverse">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("updateForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get the form data
            var formData = new FormData(this);

            // Get the file input
            var gambar = document.getElementById("gambar").files[0];

            // Check the file size
            if (gambar && gambar.size > 2 * 1024 * 1024) { // Size in bytes
                // Show an error message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Ukuran gambar tidak boleh melebihi 2MB.',
                });
                return; // Stop the form submission if the size exceeds the limit
            }

            // Submit the form using AJAX
            fetch(this.action, {
                    method: this.method,
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        // If the form submission is successful, show the success popup
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Profil berhasil diperbarui.',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to profile page after OK button is clicked
                                window.location.href = "{{ route('anggota.profile') }}";
                            }
                        });
                    } else {
                        // If there is an error, show an error popup
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat memperbarui profil.',
                        });
                    }
                })
                .catch(error => {
                    // If there is an error, show an error popup
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat memperbarui profil.',
                    });
                });
        });
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@endsection