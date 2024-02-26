@extends('layout.index')

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Kelola Galeri</h3>
        </div>
        <div class="module-body">
            <a href="{{ URL::route('galeri.create') }}" style="margin-bottom:10px" class="btn btn-inverse">Tambah Galeri</a>
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galeri as $key => $gambar)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $gambar->judul }}</td>
                        <td><img src="{{ asset('storage/' . $gambar->gambar_galeri) }}" alt="{{ $gambar->judul }}" width="100"></td>
                        <td>{{ $gambar->deskripsi }}</td>
                        <td>
                            <a href="{{ route('galeri.edit', ['id' => $gambar->id]) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('galeri.show', ['id' => $gambar->id]) }}" class="btn btn-info">Detail</a>

                            <!-- Tambahkan SweetAlert untuk konfirmasi penghapusan -->
                            <form id="deleteForm{{ $gambar->id }}" action="{{ route('galeri.destroy', ['id' => $gambar->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="deleteConfirmation({{ $gambar->id }})">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteConfirmation(id) {
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Anda tidak bisa mengurungkan tindakan ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika konfirmasi dihapus, jalankan penghapusan
                $.ajax({
                    type: 'POST',
                    url: $('#deleteForm' + id).attr('action'),
                    data: $('#deleteForm' + id).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: "Dihapus!",
                            text: "Galeri Berhasil Dihapus.",
                            icon: "success"
                        }).then(() => {
                            location.reload(); // Muat ulang halaman setelah penghapusan
                        });
                    },
                    error: function(xhr, status, error) {
                        // Menampilkan pesan kesalahan jika terjadi kesalahan
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Gagal Mengapus Galeri!',
                        });
                    }
                });
            }
        });
    }
</script>
@endsection