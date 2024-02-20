@extends('anggota.index')
@section('custom_top_script')
<script>
    function filterBooks() {
        var input, filter, table, tr, td, i, txtValue, selectedCategory, selectedYear;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("bookTable");
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
            tdPengarang = tr[i].getElementsByTagName("td")[3];
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
        var table = document.getElementById("bookTable");
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
            var table = document.getElementById("bookTable");
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
                        <th>Tersedia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $nomorUrut = 0; @endphp <!-- Inisialisasi nomor urut -->
                    @foreach ($daftarBukuTersedia as $buku)
                    @if ($buku->kondisi == 1) <!-- Hanya tampilkan buku yang aktif -->
                    @php $nomorUrut++; @endphp <!-- Tingkatkan nomor urut hanya jika buku aktif -->
                    <tr>
                        <td>{{ $nomorUrut }}</td>
                        <td>{{ $buku->isbn }}</td>
                        <td>{{ $buku->judul_buku }}</td>
                        <td>{{ $buku->pengarang }}</td>
                        <td>{{ $buku->penerbit }}</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                        <td>{{ $buku->kategori->kategori }}</td>
                        <td><a class="btn btn-success">{{ $buku->tersedia }}</td>
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
                    @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection