@extends('layout.index')
@section('custom_top_script')

@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <h3>Kelola Katalog</h3>
        </div>
        <div class="module-body">
            <div class="controls">
                <div class="d-flex align-items-center mb-3">

                    <!-- Input form untuk pencarian -->
                    <input type="text" id="searchInput" onkeyup="searchBooks()" placeholder="Cari berdasarkan judul buku atau nomor buku" style="width: 45%;">

                    <select id="kategoriFilter" onchange="filterBooks()" style="margin-bottom: 10px;">
                        <option value="ALL">Semua Kategori</option>
                        @foreach ($kategoriBuku as $kategori)
                        <option value="{{ $kategori->kategori }}">{{ $kategori->kategori }}</option>
                        @endforeach
                    </select>

                    <!-- Dropdown untuk filter tahun_terbit -->
                    <select id="tahunFilter" onchange="filterBooks()" style="margin-bottom: 10px;">
                        <option value="ALL">Semua Tahun</option>
                        @foreach ($tahunTerbit as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                    <!-- Tombol tambah kategori dan tambah buku -->
                    <a href="{{ URL::route('add-book-category') }}" style="margin-bottom:10px" class="btn btn-inverse">Tambah Kategori</a>
                    <a href="{{ URL::route('add-books') }}" style="margin-bottom:10px" class="btn btn-inverse">Tambah
                        Buku</a>
                    <a href="{{ URL::route('tidakaktif.index') }}" style="margin-bottom:10px" class="btn btn-inverse">Buku Non Aktif</a>
                </div>
                <!-- Tabel daftar buku -->
                <!-- Tabel daftar buku -->
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ISBN</th>
                            <th>Judul Buku</th>
                            <th>Penerbit</th>
                            <th>Pengarang</th>
                            <th>Tahun Terbit</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Tersedia</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="all-books">
                        @php
                        $activeBooksCount = 0;
                        @endphp
                        @forelse($books as $book)
                        @if($book->kondisi == 1) <!-- Filter buku yang aktif -->
                        @php
                        $activeBooksCount++;
                        @endphp
                        <tr>
                            <td>{{ $activeBooksCount }}</td> <!-- Menggunakan variabel $activeBooksCount sebagai nomor urutan -->
                            <td>{{ $book->nomor_buku }}</td>
                            <td>{{ $book->judul_buku }}</td>
                            <td> {{ $book->penerbit }}</td>
                            <td> {{ $book->pengarang }}</td>
                            <td>{{ $book->tahun_terbit }}</td>
                            <td>{{ $book->kategori->kategori }}</td>
                            <td><a class="btn btn-warning">{{ $book->stok }}</td>
                            <td><a class="btn btn-success">{{ $book->tersedia }}</td>
                            <td>
                                <div class="center-block" style="display: flex; flex-direction: column; align-items: center;">
                                    <!-- Tombol edit, detail, hapus -->

                                    <button class="btn btn-primary detail-btn" style="margin-bottom: 2px; width: 75px;" data-id="{{ $book->id_buku }}">Detail</button>
                                    <button class="btn btn-info edit-btn" style="margin-bottom: 2px; width: 75px;" data-id="{{ $book->id_buku }}">Edit</button>
                                    <form action="{{ route('books.deactivate', $book->id_buku) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Nonaktif</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada buku</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection


@section('custom_bottom_script')
<script type="text/javascript" src="{{ asset('static/custom/js/script.allbook.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function deleteBook(id) {
        // Show a confirmation popup
        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah Anda yakin ingin menghapus buku ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            // If the user confirms, send the DELETE request
            if (result.isConfirmed) {
                // Send the DELETE request to the server
                fetch("/all-books/" + id + "/delete", {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}", // Add the CSRF token to the header
                            "Content-Type": "application/json",
                        },
                    })
                    .then((response) => {
                        // Handle the response from the server
                        if (response.ok) {
                            // If the deletion was successful, show a success message
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Buku telah dihapus.",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000, // Set timer for 2 seconds
                                onClose: () => {
                                    // Reload the page after the timer finishes
                                    location.reload();
                                },
                            });
                        } else {
                            // If there was an error, show an error message
                            Swal.fire(
                                "Gagal!",
                                "Terjadi kesalahan saat menghapus buku.",
                                "error"
                            );
                        }
                    })
                    .catch((error) => {
                        // Handle any errors that occur during the request
                        console.error("Error:", error);
                        Swal.fire(
                            "Gagal!",
                            "Terjadi kesalahan saat menghapus buku.",
                            "error"
                        );
                    });
            } else {
                // If the user cancels, show a cancel message
                Swal.fire("Dibatalkan!", "Penghapusan buku dibatalkan.", "info");
            }
        });
    }
</script>
@stop