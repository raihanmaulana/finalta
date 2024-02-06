@extends('anggota.index')
@section('custom_top_script')
<script>
    function filterBooks() {
        // Mendapatkan nilai input pencarian dan kategori yang dipilih
        var input, filter, table, tr, td, i, txtValue, selectedCategory;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("bookTable");
        tr = table.getElementsByTagName("tr");
        selectedCategory = document.getElementById("kategoriFilter").value.toUpperCase();

        var categoryHasBook = false; // Menandakan apakah ada buku dalam kategori yang dipilih

        // Melakukan iterasi pada setiap baris tabel
        for (i = 0; i < tr.length; i++) {
            // Mendapatkan sel data pada kolom judul buku dan nomor buku
            tdPengarang = tr[i].getElementsByTagName("td")[3]; // Kolom nomor buku
            tdTitle = tr[i].getElementsByTagName("td")[2]; // Kolom judul buku
            tdNumber = tr[i].getElementsByTagName("td")[1]; // Kolom nomor buku
            tdCategory = tr[i].getElementsByTagName("td")[6]; // Kolom kategori


            if (tdTitle || tdNumber || tdPengarang || tdCategory) {
                // Mendapatkan teks dari sel data
                txtValuePengarang = tdPengarang.textContent || tdPengarang.innerText;
                txtValueTitle = tdTitle.textContent || tdTitle.innerText;
                txtValueNumber = tdNumber.textContent || tdNumber.innerText;
                txtValueCategory = tdCategory.textContent || tdCategory.innerText;

                // Mengecek apakah teks pada kolom judul buku atau nomor buku cocok dengan input pencarian
                if ((txtValueTitle.toUpperCase().indexOf(filter) > -1 || txtValueNumber.toUpperCase().indexOf(filter) > -1 || txtValuePengarang.toUpperCase().indexOf(filter) > -1) &&
                    (selectedCategory === "ALL" || txtValueCategory.toUpperCase().indexOf(selectedCategory) > -1)) {
                    tr[i].style.display = ""; // Menampilkan baris jika cocok
                    if (selectedCategory !== "ALL" && txtValueCategory.toUpperCase().indexOf(selectedCategory) > -1) {
                        categoryHasBook = true; // Setel true jika ada buku dalam kategori yang dipilih
                    }
                } else {
                    tr[i].style.display = "none"; // Menyembunyikan baris jika tidak cocok
                }
            }

        }

        // Tampilkan pesan jika tidak ada buku dalam kategori yang dipilih
        if (!categoryHasBook && selectedCategory !== "ALL") {
            // Cek apakah pesan sudah ada sebelumnya
            var messageRowExists = document.getElementById("categoryMessageRow");
            if (!messageRowExists) {
                var messageRow = document.createElement("tr");
                messageRow.id = "categoryMessageRow";
                var messageCell = document.createElement("td");
                messageCell.colSpan = 8; // Sesuaikan dengan jumlah kolom pada tabel
                messageCell.textContent = "Tidak Ada Buku Dalam Kategori Ini";
                messageRow.appendChild(messageCell);
                table.appendChild(messageRow);
            }
        } else {
            // Hapus pesan jika sudah ada sebelumnya
            var messageRowToRemove = document.getElementById("categoryMessageRow");
            if (messageRowToRemove) {
                messageRowToRemove.remove();
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

            <select id="kategoriFilter" onchange="filterBooks()" style="margin-bottom: 10px;">
                <option value="ALL">Semua Kategori</option>
                @foreach ($kategoriBuku as $kategori)
                <option value="{{ $kategori->kategori }}">{{ $kategori->kategori }}</option>
                @endforeach
            </select>

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