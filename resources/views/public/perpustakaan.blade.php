@extends('public.index')

@section('css')
<!-- Konten CSS spesifik untuk halaman ini -->
<link rel="stylesheet" href="{{ asset('css/guest.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    html,
    body {
        position: relative;
        height: 100%;
    }

    body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #000;
        margin: 0;
        padding: 0;
    }

    .swiper {
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .swiper-slide {
        background-position: center;
        background-size: cover;
        width: 300px;
        height: 330px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(360, 360, 360, 0.01);
        /* Nilai Alpha 0.5 membuatnya 50% transparan */
    }

    .swiper-slide img {
        display: block;
        width: 100%;
    }

    .swiper-container {
        display: flex;
        justify-content: center;
    }
</style>
@endsection

@section('content')
<!-- Two content sections -->

<section id="header">
    <div class="container">
        <div class="middle" data-aos="zoom-in-up">
            <h1 class="text-black text-shadow fw-bold text-center">Selamat Datang!</h1>
            <p class="text-shadow">Perpustakaan SMA Negeri 1 Tunjungan</p>

            <!-- Perbaikan disini: ubah kelas dari slide-container swiper menjadi hanya swiper -->
            <div class="swiper">
                <div class="slide-content swiper-wrapper">
                    @foreach ($books as $book)
                    <div class="card swiper-slide">
                        <div class="collection-list mt-4" id="bookCollection">
                            <div class="book" data-aos="zoom-in-up">
                                <div class="card text-center" style="width: 170px;">
                                    <img src="{{ $book->image ? asset('storage/' . $book->image) : 'img/130x190.png' }}"
                                        class="card-img-top mx-auto px-2 pt-2" style="width:148px; height:210px;"
                                        alt="Book Image" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $book->id_buku }}">
                                    <div class="card-body px-2 pt-1 pb-2">
                                        <p class="card-title" style="max-height: 20px; overflow: hidden;">
                                            {{ $book->judul_buku }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
<!-- end -->
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".swiper", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });
</script>
@endsection