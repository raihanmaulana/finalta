@extends('layout.index')
@section('custom_top_script')

@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
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
                    <a href="{{ URL::route('add-book-category') }}" style="margin-bottom:10px" class="btn btn-inverse mr-2">Tambah Kategori</a>
                    <a href="{{ URL::route('add-books') }}" style="margin-bottom:10px" class="btn btn-inverse mr-2">Tambah Buku</a>
                </div>
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
                        @forelse($books as $index => $book)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $book->nomor_buku }}</td>
                            <td>{{ $book->judul_buku }}</td>
                            <td> {{ $book->penerbit }}</td>
                            <td> {{ $book->pengarang }}</td>
                            <td>{{ $book->tahun_terbit }}</td>
                            <td>{{ $book->kategori->kategori }}</td>
                            <td><a class="btn btn-success">{{ $book->stok }}</td>
                            <td><a class="btn btn-warning">{{ $book->tersedia}}</td>
                            <td>
                                <div class="center-block" style="display: flex; flex-direction: column; align-items: center;">
                                    <!-- Tombol edit, detail, hapus -->
                                    <button class="btn btn-primary btn-sm edit-btn" style="margin-bottom: 2px; width: 60px;" data-id="{{ $book->id_buku }}">Edit</button>
                                    <button class="btn btn-info btn-sm detail-btn" style="margin-bottom: 2px; width: 60px;" data-id="{{ $book->id_buku }}">Detail</button>
                                    <button class="btn btn-danger btn-sm delete-btn" style="width: 60px;" data-id="{{ $book->id_buku }}">Hapus</button>
                                </div>
                            </td>
                        </tr>
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
<script>
    function filterBooks() {
        var input, filter, table, tr, td, i, txtValue, selectedCategory, selectedYear;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("all-books");
        tr = table.getElementsByTagName("tr");
        selectedCategory = document.getElementById("kategoriFilter").value.toUpperCase();
        selectedYear = document.getElementById("tahunFilter").value;

        var found = false;
        var noResultRow = document.getElementById("noResultRow");

        function shouldDisplayRow(txtValueTitle, txtValueNumber, txtValuePengarang, txtValueCategory, txtValueYear) {
            return (txtValueTitle.toUpperCase().indexOf(filter) > -1 || txtValueNumber.toUpperCase().indexOf(filter) > -1 || txtValuePengarang.toUpperCase().indexOf(filter) > -1) &&
                (selectedCategory === "ALL" || txtValueCategory.toUpperCase().indexOf(selectedCategory) > -1) &&
                (selectedYear === "ALL" || txtValueYear === selectedYear);
        }

        for (i = 0; i < tr.length; i++) {
            tdPengarang = tr[i].getElementsByTagName("td")[4];
            tdTitle = tr[i].getElementsByTagName("td")[2];
            tdNumber = tr[i].getElementsByTagName("td")[1];
            tdCategory = tr[i].getElementsByTagName("td")[6];
            tdYear = tr[i].getElementsByTagName("td")[5];

            if (tdTitle || tdNumber || tdPengarang || tdCategory || tdYear) {
                txtValuePengarang = tdPengarang.textContent || tdPengarang.innerText;
                txtValueTitle = tdTitle.textContent || tdTitle.innerText;
                txtValueNumber = tdNumber.textContent || tdNumber.innerText;
                txtValueCategory = tdCategory.textContent || tdCategory.innerText;
                txtValueYear = tdYear.textContent || tdYear.innerText;

                if (shouldDisplayRow(txtValueTitle, txtValueNumber, txtValuePengarang, txtValueCategory, txtValueYear)) {
                    tr[i].style.display = "";
                    found = true;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        if (!found && !noResultRow) {
            noResultRow = document.createElement("tr");
            noResultRow.id = "noResultRow";
            var noResultCell = document.createElement("td");
            noResultCell.setAttribute("colspan", "8");
            noResultCell.textContent = "Tidak ada buku dengan kriteria tersebut";
            noResultRow.appendChild(noResultCell);
            table.appendChild(noResultRow);
        } else if (found && noResultRow) {
            table.removeChild(noResultRow);
        }
    }

    function searchBooks() {
        filterBooks();
    }

    function categoryHasBook(category) {
        var table = document.getElementById("all-books");
        var tr = table.getElementsByTagName("tr");
        var found = false;
        var selectedCategory = category.toUpperCase();

        for (var i = 0; i < tr.length; i++) {
            var tdCategory = tr[i].getElementsByTagName("td")[6];
            var txtValueCategory = tdCategory.textContent || tdCategory.innerText;

            if (txtValueCategory.toUpperCase().indexOf(selectedCategory) > -1) {
                found = true;
                break;
            }
        }

        return found;
    }

    document.getElementById("kategoriFilter").addEventListener("change", function() {
        var selectedCategory = this.value;
        if (selectedCategory === "ALL" || categoryHasBook(selectedCategory)) {
            filterBooks();
        } else {
            var table = document.getElementById("all-books");
            var tbody = table.getElementsByTagName("tbody")[0];
            tbody.innerHTML = ""; // Clear table body
            var noResultRow = document.createElement("tr");
            var noResultCell = document.createElement("td");
            noResultCell.setAttribute("colspan", "8");
            noResultCell.textContent = "Tidak ada buku dalam kategori ini";
            noResultRow.appendChild(noResultCell);
            tbody.appendChild(noResultRow);
        }
    });

    // Fungsi untuk mengedit buku
    function editBook(button) {
        var bookId = $(button).data("id");
        // Redirect ke halaman edit menggunakan bookId
        window.location.href = "/books/" + bookId + "/edit";
    }

    // Fungsi untuk menampilkan detail buku
    function showBookDetail(button) {
        var bookId = $(button).data("id");
        // Redirect ke halaman detail menggunakan bookId
        window.location.href = "/books/" + bookId + "/detail";
    }

    function destroyBook(button) {
        var bookId = $(button).data("id");

        if (confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
            var csrfToken = $('meta[name="csrf-token"]').attr("content");

            $.ajax({
                url: "/all-books/" + bookId + "/delete",
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function(result) {
                    $(button).closest("tr").remove();
                    alert("Buku berhasil dihapus.");
                },
                error: function(error) {
                    alert("Gagal menghapus buku. Silakan coba lagi.");
                },
            });
        }
    }


    // Menambahkan event listener untuk tombol-tombol aksi
    $(document).ready(function() {
        $(".edit-btn").click(function() {
            editBook(this);
        });

        $(".detail-btn").click(function() {
            showBookDetail(this);
        });

        $(".delete-btn").click(function() {
            destroyBook(this);
        });
    });
</script>
@stop