@extends('layout.index')

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Edit Galeri</h3>
            </div>
            <div class="module-body">
                <form id="editGaleriForm" method="POST" action="{{ route('galeri.update', $galeri->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="{{ $galeri->judul }}" required>
                    </div>

                    <div class="form-group">
                        <label for="gambar_galeri">Gambar</label>
                        <input type="file" class="form-control-file" id="gambar_galeri" name="gambar_galeri">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $galeri->deskripsi }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-inverse" onclick="editGaleri()">Simpan</button>
                    <a href="{{ route('galeri.manage') }}" class="btn btn-inverse">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function editGaleri() {
            // Menggunakan AJAX untuk mengirim permintaan POST
            $.ajax({
                url: "{{ route('galeri.update', $galeri->id) }}",
                type: "POST",
                data: $('#editGaleriForm').serialize(), // Mengambil data dari formulir
                success: function(response) {
                    // Jika permintaan berhasil
                    Swal.fire({
                        title: "Berhasil!",
                        text: "Galeri Berhasil Diperbarui!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000 // Mengatur timer selama 2 detik (2000 milidetik)
                    });
                    setTimeout(function() {
                        // Redirect ke halaman profil setelah 2 detik
                        window.location.href = "{{ route('galeri.manage') }}";
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Gagal!",
                        text: "Galeri gagal diperbarui!",
                        icon: "error",
                        showConfirmButton: true,
                    });
                }

            });
        }
    </script>
@endsection
