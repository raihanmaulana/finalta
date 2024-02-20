@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Daftar Peminjam</h3>
        </div>
        <div class="module-body">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Nomor Anggota</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Aksi</th> <!-- Tambah kolom untuk tombol kembalikan -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($bukuDipinjam as $index => $peminjaman)
                    <tr>
                        <td>{{ $loop->iteration + ($bukuDipinjam->perPage() * ($bukuDipinjam->currentPage() - 1)) }}</td>
                        <td>{{ $peminjaman->anggota->nama_anggota }}</td>
                        <td>{{ $peminjaman->anggota->nomor_anggota }}</td>
                        <td>{{ $peminjaman->buku->judul_buku }}</td>
                        <td>{{ $peminjaman->created_at }}</td>
                        <td>
                            @if ($peminjaman->status == 1)
                            <!-- Tombol Kembalikan -->
                            <form id="kembalikanForm{{ $peminjaman->id }}" action="{{ route('admin.peminjaman.kembalikan', $peminjaman->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="button" class="btn btn-warning" onclick="kembalikanBukuAnggota({{ $peminjaman->id }})">Kembalikan</button>
                            </form>


                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Tidak ada buku yang dipinjam.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $bukuDipinjam->links() }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function kembalikanBukuAnggota(id) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menyetujui pengembalian ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Setujui',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Berhasil!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000 // Mengatur timer selama 2 detik (2000 milidetik)
                });
                setTimeout(function() {
                    document.getElementById('kembalikanForm' + id).submit();
                }, 2000); // Menunda submit form selama 2 detik setelah tampilan SweetAlert muncul
            }
        });
    }
</script>
@endsection