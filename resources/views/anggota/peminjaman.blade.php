@extends('anggota.index')
@section('custom_top_script')
<script>
    // Fungsi untuk melakukan filter pada tabel berdasarkan input pencarian
    function searchBooks() {
        // Mendapatkan nilai input pencarian
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("bookTable");
        tr = table.getElementsByTagName("tr");

        // Melakukan iterasi pada setiap baris tabel
        for (i = 0; i < tr.length; i++) {
            // Mendapatkan sel data pada kolom judul buku dan nomor buku
            tdPengarang = tr[i].getElementsByTagName("td")[3]; // Kolom nomor buku
            tdTitle = tr[i].getElementsByTagName("td")[2]; // Kolom judul buku
            tdNumber = tr[i].getElementsByTagName("td")[1]; // Kolom nomor buku


            if (tdTitle || tdNumber || tdPengarang) {
                // Mendapatkan teks dari sel data
                txtValuePengarang = tdPengarang.textContent || tdPengarang.innerText;
                txtValueTitle = tdTitle.textContent || tdTitle.innerText;
                txtValueNumber = tdNumber.textContent || tdNumber.innerText;

                // Mengecek apakah teks pada kolom judul buku atau nomor buku cocok dengan input pencarian
                if (txtValueTitle.toUpperCase().indexOf(filter) > -1 || txtValueNumber.toUpperCase().indexOf(filter) > -1 || txtValuePengarang.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = ""; // Menampilkan baris jika cocok
                } else {
                    tr[i].style.display = "none"; // Menyembunyikan baris jika tidak cocok
                }
            }
        }
    }
</script>
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Form Peminjaman Buku</h3>
        </div>
        <div class="module-body">
            <!-- Input form untuk pencarian -->
            <input type="text" id="searchInput" onkeyup="searchBooks()" placeholder="Cari berdasarkan judul buku atau nomor buku" style="width: 60%;">

            <!-- Tabel Daftar Buku -->
            <table id="bookTable" class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ISBN</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarBukuTersedia as $index => $buku)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $buku->nomor_buku }}</td>
                        <td>{{ $buku->judul_buku }}</td>
                        <td>{{ $buku->pengarang }}</td>
                        <td>{{ $buku->penerbit }}</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                        <td>{{ $buku->kategori->kategori }}</td>
                        <td>
                            <form action="{{ route('anggota.peminjaman.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_buku" value="{{ $buku->id_buku }}">
                                @if ($buku->status_buku === 'Not Available')
                                <button type="button" class="btn btn-danger" disabled>Tidak Tersedia</button>
                                @else
                                <button type="submit" class="btn btn-warning">Pinjam</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('custom_bottom_script')