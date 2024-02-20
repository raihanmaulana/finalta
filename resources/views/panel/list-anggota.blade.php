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
<script>
    function filterAnggota() {
        var input, filter, table, tr, td, i, txtValue, selectedJurusan, selectedKelas;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("anggotaTable");
        tr = table.getElementsByTagName("tr");
        selectedJurusan = document.getElementById("jurusanFilter").value.toUpperCase();
        selectedKelas = document.getElementById("kelasFilter").value.toUpperCase();

        var found = false;
        var noResultRow = document.getElementById("noResultRow");

        function shouldDisplayRow(txtValueNomor, txtValueNama, txtValueJurusan, txtValueKelas) {
            return (txtValueNomor.toUpperCase().indexOf(filter) > -1 || txtValueNama.toUpperCase().indexOf(filter) > -1) &&
                (selectedJurusan === "ALL" || txtValueJurusan.toUpperCase().indexOf(selectedJurusan) > -1) &&
                (selectedKelas === "ALL" || txtValueKelas.toUpperCase().indexOf(selectedKelas) > -1);
        }

        for (i = 0; i < tr.length; i++) {
            tdNomor = tr[i].getElementsByTagName("td")[1];
            tdNama = tr[i].getElementsByTagName("td")[2];
            tdJurusan = tr[i].getElementsByTagName("td")[3];
            tdKelas = tr[i].getElementsByTagName("td")[4];

            if (tdNomor || tdNama || tdJurusan || tdKelas) {
                txtValueNomor = tdNomor.textContent || tdNomor.innerText;
                txtValueNama = tdNama.textContent || tdNama.innerText;
                txtValueJurusan = tdJurusan.textContent || tdJurusan.innerText;
                txtValueKelas = tdKelas.textContent || tdKelas.innerText;

                if (shouldDisplayRow(txtValueNomor, txtValueNama, txtValueJurusan, txtValueKelas)) {
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
            noResultCell.setAttribute("colspan", "5");
            noResultCell.textContent = "Tidak ada anggota dengan kriteria tersebut";
            noResultRow.appendChild(noResultCell);
            table.appendChild(noResultRow);
        } else if (found && noResultRow) {
            table.removeChild(noResultRow);
        }
    }

    function searchAnggota() {
        filterAnggota();
    }

    document.getElementById("jurusanFilter").addEventListener("change", function() {
        var selectedJurusan = this.value;
        if (selectedJurusan === "ALL" || categoryHasAnggota(selectedJurusan)) {
            filterAnggota();
        } else {
            var table = document.getElementById("anggotaTable");
            var tbody = table.getElementsByTagName("tbody")[0];
            tbody.innerHTML = ""; // Clear table body
            var noResultRow = document.createElement("tr");
            var noResultCell = document.createElement("td");
            noResultCell.setAttribute("colspan", "5");
            noResultCell.textContent = "Tidak ada anggota dalam jurusan ini";
            noResultRow.appendChild(noResultCell);
            tbody.appendChild(noResultRow);
        }
    });

    function categoryHasAnggota(category) {
        var table = document.getElementById("anggotaTable");
        var tr = table.getElementsByTagName("tr");
        var found = false;
        var selectedCategory = category.toUpperCase();

        for (var i = 0; i < tr.length; i++) {
            var tdCategory = tr[i].getElementsByTagName("td")[3];
            var txtValueCategory = tdCategory.textContent || tdCategory.innerText;

            if (txtValueCategory.toUpperCase().indexOf(selectedCategory) > -1) {
                found = true;
                break;
            }
        }

        return found;
    }
</script>

@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <h3>Kelola Anggota</h3>
        </div>

        <div class="module-body">
            <!-- Input form untuk pencarian -->
            <input type="text" id="searchInput" onkeyup="searchAnggota()" placeholder="Cari berdasarkan nomor anggota atau nama anggota" style="width: 45%;">

            <!-- Dropdown filter jurusan -->
            <select id="jurusanFilter" onchange="filterAnggota()" style="margin-bottom: 10px;">
                <option value="ALL">Semua Jurusan</option>
                @foreach ($daftarJurusan as $jurusan)
                <option value="{{ $jurusan->jurusan }}">{{ $jurusan->jurusan }}</option>
                @endforeach
            </select>

            <!-- Dropdown filter kelas -->
            <select id="kelasFilter" onchange="filterAnggota()" style="margin-bottom: 10px;">
                <option value="ALL">Semua Kelas</option>
                @foreach ($daftarKelas as $kelas)
                <option value="{{ $kelas->kelas }}">{{ $kelas->kelas }}</option>
                @endforeach
            </select>

            <a href="{{ URL::route('admin.tambah-anggota') }}" style="margin-bottom:10px" class="btn btn-inverse">Tambah Nomor Anggota</a>
            <table id="anggotaTable" class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Anggota</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($anggotaList as $index => $anggota)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $anggota->nomor_anggota }}</td>
                        <td>{{ $anggota->nama_anggota }}</td>
                        <td>{{ $anggota->jurusan }}</td>
                        <td>{{ $anggota->kelas }}</td>

                        <td>
                            <div class="center-block" style="display: flex; flex-direction: column; align-items: center;">
                                <a href="{{ route('list-anggota-detail', ['id' => $anggota->id_anggota]) }}" class="btn btn-primary btn-block" style="width: 75px;">Detail</a>
                                <a href="{{ route('list-anggota-edit', ['id' => $anggota->id_anggota]) }}" class="btn btn-info btn-block" style="margin-bottom: 5px; width: 75px;">Edit</a>
                                <form id="deleteAnggota{{ $anggota->id_anggota }}" action="{{ route('list-anggota-delete', $anggota->id_anggota) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" style="margin-bottom: 2px; width: 75px;" onclick="deleteAnggota('{{ $anggota->id_anggota }}')">Hapus</button>
                                </form>
                            </div>

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