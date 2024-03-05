@extends('layout.index')

@section('custom_top_script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Sisipkan SweetAlert di sini jika belum dilakukan -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Tambah Buku</h3>
        </div>
        <div class="module-body">
            <form id="addBooksForm" class="form-horizontal row-fluid" method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="control-group">
                    <label class="control-label">Judul Buku</label>
                    <div class="controls">
                        <input type="text" name="judul_buku" id="judul_buku" placeholder="Masukkan Judul Buku" class="span8" required>
                    </div>
                    @error('judul_buku')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="control-group">
                    <label class="control-label">ISBN</label>
                    <div class="controls">
                        <input type="text" name="isbn" id="isbn" placeholder="Masukkan ISBN" class="span8" required maxlength="13">
                    </div>
                    @error('isbn')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="control-group">
                    <label class="control-label">Penerbit</label>
                    <div class="controls">
                        <input type="text" name="penerbit" id="penerbit" placeholder="Masukkan Nama Penerbit" class="span8" required>
                    </div>
                    @error('penerbit')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="control-group">
                    <label class="control-label">Pengarang</label>
                    <div class="controls">
                        <input type="text" name="pengarang" id="pengarang" placeholder="Masukkan Nama Pengarang" class="span8" required>
                    </div>
                    @error('pengarang')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="control-group">
                    <label class="control-label">Tahun Terbit</label>
                    <div class="controls">
                        <input type="text" name="tahun_terbit" id="tahun_terbit" placeholder="Masukkan Tahun Terbit" class="span8" required>
                    </div>
                    @error('tahun_terbit')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="control-group">
                    <label class="control-label">Deskripsi Buku</label>
                    <div class="controls">
                        <input type="text" name="deskripsi" id="deskripsi" placeholder="Masukkan Deskripsi Buku" class="span8" required>
                    </div>
                    @error('deskripsi')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="control-group">
                    <label class="control-label" for="kategori_id">Kategori</label>
                    <div class="controls">
                        <select tabindex="1" name="kategori_id" id="kategori_id" data-placeholder="Select kategori.." class="span8" required>
                            @foreach ($kategori_list as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="image">Gambar Buku</label>
                    <div class="controls">
                        <input type="file" id="image" name="image" class="span8" required>
                    </div>
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="control-group">
                    <label class="control-label">Stok Buku</label>
                    <div class="controls">
                        <input type="text" name="stok" id="stok" placeholder="Masukkan Stok Buku" class="span8" required>
                    </div>
                    @error('stok')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="control-group">
                    <label class="control-label">Tautan Buku</label>
                    <div class="controls">
                        <input type="text" name="tautan_buku" id="tautan_buku" placeholder="Masukkan Tautan Buku" class="span8">
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" style="margin-right:10px" class="btn btn-inverse">Tambah Buku</button>
                        <a href="{{ URL::route('all-books') }}" class="btn btn-inverse">Batal</a>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
@stop

@section('custom_bottom_script')

<!-- JavaScript untuk menampilkan SweetAlert2 saat berhasil atau gagal mengubah kata sandi -->
<script>
    $(document).ready(function() {
        $('#addBooksForm').submit(function(e) {
            e.preventDefault(); // Mencegah formulir dikirim menggunakan metode biasa

            // Mengumpulkan data formulir
            var formData = new FormData(this);

            // Mengirimkan data ke server menggunakan AJAX
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Menampilkan pesan sukses jika operasi berhasil
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Berhasil Menambahkan Buku!",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        // Setelah menampilkan pesan sukses, alihkan ke halaman kelola galeri
                        window.location.href = "{{ route('all-books') }}";
                    });
                },
                error: function(xhr, status, error) {
                    // Menampilkan pesan kesalahan jika terjadi kesalahan
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal Menambahkan Buku!',
                    });
                }
            });
        });
    });
</script>
@stop