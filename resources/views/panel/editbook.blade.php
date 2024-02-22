<!-- File: resources/views/panel/editbook.blade.php -->

@extends('layout.index')

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Edit Buku</h3>
        </div>
        <div class="module-body">
            <form id="editBooksForm" class="form-horizontal row-fluid" method="POST" action="{{ route('books.update', ['id' => $book->id_buku]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul Buku -->
                <div class="control-group">
                    <label class="control-label" for="judul_buku">Judul Buku</label>
                    <div class="controls">
                        <input type="text" id="judul_buku" name="judul_buku" value="{{ $book->judul_buku }}" class="span8">
                    </div>
                </div>

                <!-- Nomor Buku -->
                <div class="control-group">
                    <label class="control-label" for="isbn">ISBN</label>
                    <div class="controls">
                        <input type="text" id="isbn" name="isbn" value="{{ $book->isbn }}" class="span8">
                    </div>
                </div>

                <!-- Penerbit -->
                <div class="control-group">
                    <label class="control-label" for="penerbit">Penerbit</label>
                    <div class="controls">
                        <input type="text" id="penerbit" name="penerbit" value="{{ $book->penerbit }}" class="span8">
                    </div>
                </div>

                <!-- Pengarang -->
                <div class="control-group">
                    <label class="control-label" for="pengarang">Pengarang</label>
                    <div class="controls">
                        <input type="text" id="pengarang" name="pengarang" value="{{ $book->pengarang }}" class="span8">
                    </div>
                </div>

                <!-- Tahun Terbit -->
                <div class="control-group">
                    <label class="control-label" for="tahun_terbit">Tahun Terbit</label>
                    <div class="controls">
                        <input type="text" id="tahun_terbit" name="tahun_terbit" value="{{ $book->tahun_terbit }}" class="span8">
                    </div>
                </div>

                <!-- Penerbit -->
                <div class="control-group">
                    <label class="control-label" for="deskripsi">Deskripsi</label>
                    <div class="controls">
                        <input type="text" id="deskripsi" name="deskripsi" value="{{ $book->deskripsi }}" class="span8">
                    </div>
                </div>

                <!-- Kategori -->
                <div class="control-group">
                    <label class="control-label" for="kategori_id">Kategori</label>
                    <div class="controls">
                        <select id="kategori_id" name="kategori_id" class="span8">
                            @foreach ($categories_list as $category)
                            <option value="{{ $category->id }}" {{ $book->kategori_id == $category->id ? 'selected' : '' }}>
                                {{ $category->kategori }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Stok Buku -->
                <div class="control-group">
                    <label class="control-label" for="stok">Stok Buku</label>
                    <div class="controls">
                        <input type="text" id="stok" name="stok" value="{{ $book->stok }}" class="span8">
                    </div>
                </div>

                <!-- Gambar Buku -->
                <div class="control-group">
                    <label class="control-label" for="image">Gambar Buku</label>
                    <div class="controls">
                        <input type="file" id="image" name="image" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="tautan_buku">Tautan Buku</label>
                    <div class="controls">
                        <input type="text" id="tautan_buku" name="tautan_buku" value="{{ $book->tautan_buku }}" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button type="button" class="btn btn-inverse" onclick="editBooks()">Simpan</button>
                        <a href="{{ URL::route('all-books') }}" class="btn btn-inverse">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function editBooks() {
        // Menggunakan AJAX untuk mengirim permintaan POST
        $.ajax({
            url: "{{ route('books.update', ['id' => $book->id_buku]) }}",
            type: "POST",
            data: $('#editBooksForm').serialize(), // Mengambil data dari formulir
            success: function(response) {
                // Jika permintaan berhasil
                Swal.fire({
                    title: "Berhasil!",
                    text: "Buku Berhasil Diperbarui!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000 // Mengatur timer selama 2 detik (2000 milidetik)
                });
                setTimeout(function() {
                    // Redirect ke halaman profil setelah 2 detik
                    window.location.href = "{{ route('all-books') }}";
                }, 2000);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: "Gagal!",
                    text: "Buku gagal diperbarui!",
                    icon: "error",
                    showConfirmButton: true,
                });
            }

        });
    }
</script>
@endsection