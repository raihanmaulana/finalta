@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')

<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Riwayat Peminjaman</h3>
        </div>
        <div class="module-body">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bukuDikembalikan as $data)
                    @if ($data->status == 2)
                    {{-- Hanya tampilkan buku yang telah dikembalikan --}}
                    <tr>
                        <td>{{ $loop->iteration + ($bukuDikembalikan->perPage() * ($bukuDikembalikan->currentPage() - 1)) }}</td>
                        <td>{{ $data->anggota->nomor_anggota }}</td>
                        <td>{{ $data->anggota->nama_anggota }}</td>
                        <td>{{ $data->buku->judul_buku }}</td>
                        <td>{{ $data->tanggal_peminjaman ? $data->tanggal_peminjaman->format('Y-m-d H:i:s') : 'Belum Dikembalikan' }}
                        </td>
                        <td>{{ $data->tanggal_pengembalian ? $data->tanggal_pengembalian->format('Y-m-d H:i:s') : 'Belum Dikembalikan' }}
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            {{ $bukuDikembalikan->links() }}
        </div>
    </div>
</div>


@section('custom_bottom_script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.btn-kembalikan-buku');
        buttons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.getAttribute('href');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Anda akan mengembalikan buku ini.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, kembalikan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(url, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Berhasil!',
                                        'Buku berhasil dikembalikan.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        'Terjadi kesalahan saat mengembalikan buku.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat mengembalikan buku.',
                                    'error'
                                );
                            });
                    }
                });
            });
        });
    });
</script>
@endsection