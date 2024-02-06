@extends('layout.index')
@section('custom_top_script')
@stop
@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>List Anggota</h3>
        </div>
        <div class="module-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Anggota</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($anggotaList as $index => $anggota)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $anggota->nomor_anggota }}</td>
                        <td>{{ $anggota->nama_anggota }}</td>
                        <td>{{ $anggota->email }}</td>
                        <td>
                            <a href="{{ route('list-anggota-detail', ['id' => $anggota->id_anggota]) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('list-anggota-edit', ['id' => $anggota->id_anggota]) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $anggota->id_anggota }}')">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Tidak ada anggota.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- JavaScript untuk menampilkan SweetAlert2 saat tombol Delete ditekan -->
<script>
    function confirmDelete(id_anggota) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus anggota ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim permintaan penghapusan ke server
                fetch('/list-anggota/' + id_anggota, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Menambahkan token CSRF ke header
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    // Periksa kode status respons
                    if (response.ok) {
                        // Jika penghapusan berhasil, tampilkan notifikasi sukses
                        Swal.fire('Berhasil!', 'Anggota telah dihapus.', 'success');
                        // Perbarui UI dengan memuat ulang halaman atau menghapus baris anggota dari tabel
                        location.reload(); // Contoh: Memuat ulang halaman untuk memperbarui daftar anggota
                    } else {
                        // Jika ada kesalahan, tampilkan notifikasi gagal
                        Swal.fire('Gagal!', 'Terdapat masalah saat menghapus anggota.', 'error');
                    }
                })
                .catch(error => {
                    // Tangani kesalahan saat melakukan permintaan penghapusan
                    console.error('Error:', error);
                    Swal.fire('Gagal!', 'Terdapat masalah saat menghapus anggota.', 'error');
                });
            }
        });
    }
</script>

@endsection
