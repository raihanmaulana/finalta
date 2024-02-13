@extends('public.index') <!-- Meng-extend template utama -->

@section('css')
<link rel="stylesheet" href="{{ asset('css/katalog.css') }}" />
@endsection

@section('content')
<section id="katalog" class="py-5">
    <div class="container">
        <div class="title text-center">
            <h2 class="position-relative d-inline-block mb-3" data-aos="fade-right">Katalog Buku</h2>
        </div>
        <!-- Form Pencarian -->
        <form action="{{ route('cari-buku') }}" method="GET" class="custom-form mb-0 mx-auto" data-aos="fade-left">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Cari buku..." aria-label="Search">
                <!-- <button type="submit" class="btn btn-primary">Cari</button> -->
            </div>
        </form>
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

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
</script>
<!-- jquery -->
<script src="js/code.jquery.com_jquery-3.7.1.js"></script>
<!-- boostrap js and popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>
<!-- Tambahkan skrip SweetAlert2 dari CDN -->
<script>
    // Fungsi untuk menampilka        rd deta        uku
    functio tail(bu
            const detailCard = document.get yId("detail                    detai        d.s        .display = "
                k ";         }

                // Fungsi        uk menyembunyikan card d               uku
                function hideDet
                const detai document.getElementById(
                    "detail                            detailCard.style.display =         e               }

                    // Fungsi u            akukan pencari        uku
                    f searchBo // Ambil nilai input pe                    var sear            = document.getElement            archInput').value.toLowerC                               Ambil daft                    var        ks = {
                    !!$ s!!
                };

                /             buku berdasarka        dul
                var filteredBooks = books.fi(func(
                        return.judul_buku.toLowerCase().includes(s h y);
                    );

                    // Tampilk        asil pe        ian
                    displayB teredBooks);
            }

            // Fungsi untuk menampilkan daft             ku
            function displayBooks(b
                var bookListContainer = documen mentById(
                    'book                                  ntainer.innerHTML                    // Tampilkan buku yang telah d                    books.forEach(function (                        var html = ` <
                    div class = "col-6 col-md-4 col-lg-2" >
                    <
                    div class = "card h-100" >
                    <
                    img src = "${book.image ? asset('storage/' + book.image) : 'img/130x190.png'}"
                    class = "card-img-top mt-3 mx-auto"
                    alt = "Book Image"
                    data - bs - toggle = "modal"
                    data - bs - target = "#detailModal${book.id_buku}" >
                    <
                    div class = "card-body text-center" >
                    <
                    h6 class = "card-title" > $ {
                        book.judul_buku
                    } < /h6> <
                    button class = "btn btn-dark"
                    data - bs - toggle = "modal"
                    data - bs - target = "#detailModal${book.id_buku}"
                    onclick = "showBookDetai                d_buku}')" > Detail < /button>
                    div < /div> < /
                    div > bookListContainer.innerHTML +
                }
                document.getElementById('searchInput').addEventListener('input', searchBooks);
</script>
<script>
    function filterBooks(kategori) {
        // Ambil semua elemen buku
        var books = document.getElementsByClassName('book');

        // Loop melalui semua elemen buku
        for (var i = 0; i < books.length; i++) {
            var book = books[i];

            // Jika kategori buku tidak sama dengan kategori yang dipilih atau 'Semua' yang dipilih, sembunyikan buku tersebut
            if (kategori !== 'Semua' && book.dataset.kategori !== kategori) {
                book.style.display = 'none';
            } else {
                book.style.display = 'block'; // Tampilkan buku jika sesuai dengan kategori yang dipilih
            }
        }
    }
</script>
@endsection