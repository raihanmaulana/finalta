<!-- resources/views/public/all_books.blade.php -->

@extends('layouts.layout')

@section('customcss')


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Perpustakaan SMAN 1 Tunjungan</title>
    <!-- bootsrap css and js -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- my css -->
    <link rel="stylesheet" href="{{asset('css/utama/katalog.css')}}" />
    <link rel="stylesheet" href="{{asset('css/utama/search.css')}}" />
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">

    <!--
            CSS
            ============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
</head>

@endsection

@section('content')
<div <!-- header -->
    <!-- Form Pencarian -->
    <form action="{{ route('cari-buku') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Cari buku..." aria-label="Search">
            <!-- <button type="submit" class="btn btn-primary">Cari</button> -->
        </div>
    </form>
    @if ($books->isEmpty())
    <p>Tidak ada buku.</p>
    @else
    <!-- end header -->


    <!-- <div class=""> -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <ul class="main-categories">
                        <li class="main-nav-list"><a data-toggle="collapse" href="#fruitsVegetable" aria-expanded="false" aria-controls="fruitsVegetable"><span class="lnr lnr-arrow-right"></span>Semua Kategori<span class="number">(53)</span></a>
                            <ul class="collapse" id="fruitsVegetable" data-toggle="collapse" aria-expanded="false" aria-controls="fruitsVegetable">
                                <li class="main-nav-list child"><a href="#">Umum<span class="number">(13)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Sains<span class="number">(09)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Agama<span class="number">(17)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Bahasa<span class="number">(01)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Sejarah<span class="number">(11)</span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="main-nav-list"><a data-toggle="collapse" href="#meatFish" aria-expanded="false" aria-controls="meatFish"><span class="lnr lnr-arrow-right"></span>Umum<span class="number">(53)</span></a>
                            <ul class="collapse" id="meatFish" data-toggle="collapse" aria-expanded="false" aria-controls="meatFish">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="main-nav-list"><a data-toggle="collapse" href="#cooking" aria-expanded="false" aria-controls="cooking"><span class="lnr lnr-arrow-right"></span>Sains<span class="number">(53)</span></a>
                            <ul class="collapse" id="cooking" data-toggle="collapse" aria-expanded="false" aria-controls="cooking">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="main-nav-list"><a data-toggle="collapse" href="#beverages" aria-expanded="false" aria-controls="beverages"><span class="lnr lnr-arrow-right"></span>Agama<span class="number">(24)</span></a>
                            <ul class="collapse" id="beverages" data-toggle="collapse" aria-expanded="false" aria-controls="beverages">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="main-nav-list"><a data-toggle="collapse" href="#homeClean" aria-expanded="false" aria-controls="homeClean"><span class="lnr lnr-arrow-right"></span>Bahasa<span class="number">(53)</span></a>
                            <ul class="collapse" id="homeClean" data-toggle="collapse" aria-expanded="false" aria-controls="homeClean">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="main-nav-list"><a data-toggle="collapse" href="#officeProduct" aria-expanded="false" aria-controls="officeProduct"><span class="lnr lnr-arrow-right"></span>Sejarah<span class="number">(77)</span></a>
                            <ul class="collapse" id="officeProduct" data-toggle="collapse" aria-expanded="false" aria-controls="officeProduct">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a>
                                </li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- katalog -->
                <!-- <div class="col-xl-9 col-lg-8 col-md-7"> -->
                <section id="katalog">
                    <div class="container" style="padding-bottom: 10px">
                        <div class="row g-2">
                            @foreach ($books as $book)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="card h-100">
                                    <!-- Gambar buku -->
                                    <img src="{{ $book->image ? asset('storage/' . $book->image) : 'img/130x190.png' }}" class="card-img-top mt-3 mx-auto" alt="Book Image" data-bs-toggle="modal" data-bs-target="#detailModal{{ $book->id_buku }}">
                                    <div class="card-body text-center">
                                        <!-- Judul buku -->
                                        <h6 class="card-title">{{ $book->judul_buku }}</h6>
                                        <!-- Tombol detail -->
                                        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#detailModal{{ $book->id_buku }}" onclick="showBookDetails('{{ $book->id_buku }}')">Detail</button>
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
                                            <p>ISBN: {{ $book->isbn }}</p>
                                            <p>Penerbit: {{ $book->penerbit }}</p>
                                            <p>Pengarang: {{ $book->pengarang }}</p>
                                            <p>Tahun Terbit: {{ $book->tahun_terbit }}</p>
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
                    </div>
                </section>
                @endif
            </div>
            <!-- end katalog -->
        </div>
    </div>
    <!-- </div> -->

    <!-- end -->
    <!-- jquery -->
    <script src="js/code.jquery.com_jquery-3.7.1.js"></script>
    <!-- boostrap js and popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- Tambahkan skrip SweetAlert2 dari CDN -->
    <script>
        // Fungsi untuk menampilka        rd deta        uku
        functio tail(bu
                const detailCard = document.get yId("detail                    detai        d.s        .display = "
                    k ";         }

                    // Fungsi        uk menyembunyikan card d               uku
                    function hideDet
                    const detai document.getElementById("detail                            detailCard.style.display =         e               }

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
                    var bookListContainer = documen mentById('book                                  ntainer.innerHTML                    // Tampilkan buku yang telah d                    books.forEach(function (                        var html = ` <
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
    </body>
    @endsection