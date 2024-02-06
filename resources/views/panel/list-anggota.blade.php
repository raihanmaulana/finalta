<!-- @extends('layout.index') -->
@section('custom_top_script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function deleteAnggota(id) {
        // Show a confirmation popup
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
            // If the user confirms, send the DELETE request
            if (result.isConfirmed) {
                // Send the DELETE request to the server
                fetch('/list-anggota/' + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add the CSRF token to the header
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        // Handle the response from the server
                        if (response.ok) {
                            // If the deletion was successful, show a success message
                            Swal.fire({
                                title: "Berhasil!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000, // Mengatur timer selama 2 detik (2000 milidetik)
                                onClose: () => {
                                    // Reload the page after the timer finishes
                                    location.reload();
                                }
                            });

                        } else {
                            // If there was an error, show an error message
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus anggota.', 'error');
                        }
                    })
                    .catch(error => {
                        // Handle any errors that occur during the request
                        console.error('Error:', error);
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus anggota.', 'error');
                    });
            } else {
                // If the user cancels, show a cancel message
                Swal.fire('Dibatalkan!', 'Penghapusan anggota dibatalkan.', 'info');
            }
        });
    }
</script>
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <form id="deleteAnggota{{ $anggota->id_anggota }}" action="{{ route('list-anggota-delete', $anggota->id_anggota) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-success" onclick="deleteAnggota('{{ $anggota->id_anggota }}')">Hapus</button>
                            </form>

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
@endsection