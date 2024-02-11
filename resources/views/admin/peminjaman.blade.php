@extends('layout.index')
@section('custom_top_script')
<!-- Tambahkan SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Konfirmasi Peminjaman</h3>
        </div>
        <div class="module-body">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Judul Buku</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Tampilkan daftar permintaan peminjaman -->
                    @forelse($permintaanPeminjaman as $index => $peminjaman)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peminjaman->anggota->id_anggota ?? 'Default ID' }}</td>
                        <td>{{ $peminjaman->anggota->nama_anggota ?? 'Default Name' }}</td>
                        <td>{{ $peminjaman->buku->judul_buku ?? 'Default Title' }}</td>

                        <td>
                            @if ($peminjaman->status == 0)
                            'Belum Disetujui'
                            @else
                            'Disetujui'
                            @endif
                        </td>
                        <td>
                            @if ($peminjaman->status == 0)
                            <!-- Tombol Setujui -->
                            <form id="approveForm{{ $peminjaman->id }}" action="{{ route('admin.peminjaman.approve', $peminjaman->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="button" class="btn btn-success" onclick="approvePeminjaman({{ $peminjaman->id }})">Setujui</button>
                            </form>
                            @else
                            <span class="text-success">Sudah Disetujui</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Tidak ada permintaan peminjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambahkan SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- JavaScript untuk menampilkan SweetAlert2 saat tombol Setujui ditekan -->
<script>
    function approvePeminjaman(id) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menyetujui peminjaman ini?',
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
                    document.getElementById('approveForm' + id).submit();
                }, 2000); // Menunda submit form selama 2 detik setelah tampilan SweetAlert muncul
            }
        });
    }
</script>
@endsection