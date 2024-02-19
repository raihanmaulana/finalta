@extends('public.index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/katalog.css') }}" />
@endsection

@section('content')

<section id="katalog" class="py-5">
    <div class="container pt-5">
        <div class="title text-center">
            <h1 class="text-black text-shadow fw-bold text-center" data-aos="fade-right">Katalog Buku</h1>
        </div>

        <!-- Form Pencarian -->
        <form id="searchForm" class="custom-form mb-0 mx-auto" data-aos="fade-left">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" id="searchInput" placeholder="Cari buku..." aria-label="Search">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
        <script>
            document.getElementById('searchForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form
                searchBooks(); // Memanggil fungsi searchBooks
            });

            function searchBooks() {
                var searchInput = document.getElementById('searchInput').value.toLowerCase();
                // Lakukan pencarian buku dan tampilkan hasil
                // ...
            }
        </script>

        @if ($books->isEmpty())
        <p>Tidak ada buku.</p>
        @else
        <!-- end header -->
        <div class="d-flex flex-wrap justify-content-center mt-3" data-aos="zoom-out-up">
            <button type="button" class="btn btn-outline-dark round m-2" onclick="showAllBooks()">Semua Kategori</button>
            @foreach ($kategoriBuku as $kategori)
            <button type="button" class="btn btn-outline-dark round m-2" onclick="filterByCategory('{{ $kategori->kategori }}')">{{ $kategori->kategori }}</button>
            @endforeach
        </div>

        <div class="collection-list mt-4 row gx-0 gy-3" id="bookCollection">
            @foreach ($books as $book)
            <div class="col-6 col-md-4 col-lg-2 col-xl-2 book" data-aos="zoom-in-up">
                <div class="card text-center" style="width: 170px;">
                    <img src="{{ $book->image ? asset('storage/' . $book->image) : 'img/130x190.png' }}" class="card-img-top mx-auto px-2 pt-2" style="width:148px; height:210px;" alt="Book Image" data-bs-toggle="modal" data-bs-target="#detailModal{{ $book->id_buku }}">
                    <div class="card-body px-2 pt-1 pb-2">
                        <p class="card-title" style="max-height: 20px; overflow: hidden;">
                            {{ $book->judul_buku }}
                        </p>
                        <button class="btn btn-dark" style="font-size: 12px; padding: 5px 10px;" data-bs-toggle="modal" data-bs-target="#detailModal{{ $book->id_buku }}" onclick="showBookDetails('{{ $book->id_buku }}')">Detail</button>
                    </div>
                </div>
            </div>
            <!-- Modal detail buku -->
            <div class="modal fade" id="detailModal{{ $book->id_buku }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $book->judul_buku }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Informasi buku -->
                            <p>Nomor Buku: {{ $book->nomor_buku }}</p>
                            <p>Penerbit: {{ $book->penerbit }}</p>
                            <p>Pengarang: {{ $book->pengarang }}</p>
                            <p>Tahun Terbit: {{ $book->tahun_terbit }}</p>
                            <p>Kategori : {{ $book->kategori->kategori }}</p>
                            <p>Deskripsi: {{ $book->deskripsi }}</p>
                            <!-- Gambar buku -->
                            @if ($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="Gambar Buku" style="max-width: 100px; max-height: 100px;">
                            @else
                            No Image
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection

@section('custom_bottom_script')
<!-- jquery -->
<script src="js/code.jquery.com_jquery-3.7.1.js"></script>
<!-- bootstrap js and popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>

<script>
    function filterByCategory(kategori) {
        // Mengirimkan permintaan AJAX ke URL yang sesuai dengan kategori yang dipilih
        $.ajax({
            type: 'GET',
            url: '/books/by-category/' + kategori,
            success: function(response) {
                // Mengganti isi dari div dengan id 'bookCollection' dengan data buku yang baru
                $('#bookCollection').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function showAllBooks() {
        // Ambil semua elemen buku
        var books = document.getElementsByClassName('book');

        // Loop melalui semua elemen buku
        for (var i = 0; i < books.length; i++) {
            var book = books[i];
            book.style.display = 'block'; // Tampilkan semua buku
        }
    }

    // Fungsi untuk menampilkan detail buku
    function showBookDetails(bookId) {
        const detailCard = document.getElementById("detailModal" + bookId);
        detailCard.style.display = "block";
    }

    // Fungsi untuk menyembunyikan card detail buku
    function hideDetails() {
        const detailCard = document.getElementById("detailModal" + bookId);
        detailCard.style.display = "none";
    }

    // Fungsi untuk melakukan pencarian buku
    function searchBooks() {
        // Ambil nilai input pencarian
        var searchInput = document.getElementById('searchInput').value.toLowerCase();
        // Ambil daftar buku
        var books = {
            !!$books!!
        };
        // Filter buku berdasarkan input
        var filteredBooks = books.filter(function(book) {
            return book.judul_buku.toLowerCase().includes(searchInput);
        });

        // Tampilkan hasil pencarian
        displayBooks(filteredBooks);
    }

    // Fungsi untuk menampilkan daftar buku
    function displayBooks(books) {
        var bookListContainer = document.getElementById('bookCollection');
        bookListContainer.innerHTML = "";
        // Tampilkan buku yang telah difilter
        books.forEach(function(book) {
            var html = '<div class="col-6 col-md-4 col-lg-2 book" data-aos="zoom-in-up">' +
                '<div class="card text-center" style="width: 170px;">' +
                '<img src="' + (book.image ? "{{ asset('storage/') }}" + book.image : 'img/130x190.png') + '" class="card-img-top mx-auto px-2 pt-2" style="width:148px; height:210px;" alt="Book Image" data-bs-toggle="modal" data-bs-target="#detailModal' + book.id_buku + '">' +
                '<div class="card-body px-2 pt-1 pb-2">' +
                '<p class="card-title" style="max-height: 20px; overflow: hidden;">' + book.judul_buku + '</p>' +
                '<button class="btn btn-dark" style="font-size: 12px; padding: 5px 10px;" data-bs-toggle="modal" data-bs-target="#detailModal' + book.id_buku + '" onclick="showBookDetails(\'' + book.id_buku + '\')">Detail</button>' +
                '</div>' +
                '</div>' +
                '</div>';
            bookListContainer.innerHTML += html;
        });
    }

    document.getElementById('searchButton').addEventListener('click', function() {
        searchBooks();
    });
</script>

@endsection