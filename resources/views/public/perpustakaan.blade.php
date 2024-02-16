@extends('public.index')

@section('css')
    <!-- Konten CSS spesifik untuk halaman ini -->
    <link rel="stylesheet" href="{{ asset('css/perpus.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        html,
        body {
            position: relative;
            height: 100%;
        }

        body {
            background: #fff;
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
    <section id="header">
        <div class="container">
            <div class="middle text-center" data-aos="zoom-in-up">
                <h1 class="text-black text-shadow fw-bold">Selamat Datang!</h1>
                <p class="text-shadow ">Perpustakaan SMA Negeri 1 Tunjungan</p>
            </div>
        </div>
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1"
                d="M0,192L60,181.3C120,171,240,149,360,133.3C480,117,600,107,720,106.7C840,107,960,117,1080,122.7C1200,128,1320,128,1380,128L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
            </path>
        </svg>
    </section>

    <div class="container">
        <div class="row mt-3 mb-3" data-aos="zoom-out">
            <h1 class="text-black text-shadow fw-bold text-center">Profile</h1>
        </div>
        <div class="row" data-aos="zoom-in-up">
            <div class="col-12 col-md-12 col-lg-4">
                <img src="{{ asset('css/images/bg5.jpg') }}" alt="Perpustakaan" style="width: 100%; height:85%;" />
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <div style="text-align: justify; font-size: 15px;">
                    <p> Perpustakaan sekolah adalah perpustakaan yang tergabung pada sebuah sekolah dikelola sepenuhnya oleh
                        sekolah
                        yang bersangkutan dengan tujuan usaha membantu sekolah untuk mencapai tujuan khusus sekolah dan
                        tujuan
                        pendidikan pada umumnya ... (Sulistyo Basuki, 1993). Di samping itu dalam penjelasan Undang – undang
                        Pendidikan Nasional kita, di sebutkan bahwa salah satu sumber belajar di sekolah yang amat penting
                        tetapi
                        bukan satu - satunya adalah perpustakaan. Sebagai salah satu sumber belajar di sekolah perpustakaan
                        membantu
                        tercapainya visi dan misi sekolah tersebut. Mengingat pentingnya peran perpustakaan sekolah maka
                        perlu
                        adanya suatu pengelolaan atau manajemen yang tepat dan cepat sehingga tidak sedikit perpustakaan
                        sekolah
                        benar-benar terwujud. Namun masalahnya sekarang adalah tidak sedikit perpustakaan sekolah yang
                        pengelolaannya masih kurang profesional. perpustakaan sekolah mampu memenuhi kebutuhan penggunanya
                        akan
                        berbagai pengetahuan dan informasi secara mudah dan cepat di era globalisasi ini. Untuk itu
                        diperlukan
                        suatu
                        sistem informasi manajemen perpustakaan (SIM Perpustakaan) dengan memanfaatkan komputer.</p>
                </div>
            </div>
        </div>
        <div class="row" style="text-align: justify; font-size: 15px;">
            <p data-aos="zoom-in-right">Perpustakaan sebagai jantung sebuah lembaga pendidikan, sudah selayaknya mendapatkan
                porsi yang
                strategis
                guna merealisasikan visi dan misi sekolah. Semua pihak khususnya kepala sekolah harus memberi
                perhatian
                lebih akan eksistansi perpustakaan di sekolah, dan tidak lagi dianggap sebagai tempat menyimpan buku
                bekas,
                barang – barang tidak terpakai, bahkan tempat bermain saat tidak ada KBM. Hal ini tentu sangat
                ironis
                dan
                tidak mendidik.</p>

            <p data-aos="zoom-in-left">Dari berbagai sudut pemikiran diatas, Perpustakaan SMA N 1 Tunjungan berupaya
                melakukan terobosan dan
                revitalisasi peran dan fungsi perpustakaan sekolah untuk mendukung program dan visi dan misi
                sekolah.
                Berbagai program dan terobosan yang direncanakan, diharapkan dapat memberi ruang yang lebih besar
                agar
                perpustakaan sekolah sebagai center of knowledge dapat terealisasi secara optimal.</p>
        </div>
    </div>

    <!-- Perbaikan disini: ubah kelas dari slide-container swiper menjadi hanya swiper -->
    <div class="container">
        <div class="row" data-aos="zoom-in">
            <div class="col-12 col-md-6 col-lg-3 my-auto">
                <h1 class="text-black text-shadow fw-bold text-center">Katalog Buku</h1>
                <div class="text-center">
                    <a href="katalog" class="btn btn-warning">Selengkapnya ></a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-9">
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
    </div>

    <div class="container">
        <div class="row g-3 mt-5">
            <div class="col-12 col-md-12 col-lg-6 px-5">
                <h1 class="text-black text-shadow fw-bold text-center" data-aos="fade-up-right">Tujuan</h1>
                <ol data-aos="zoom-out-right" style="text-align: justify; font-size: 15px;">
                    <li>Menjadi perpustakaan sekolah berbasis ICT serta pusat IPTEK dan sumber belajar warga sekolah guna
                        mendukung
                        kegiatan belajar mengajar di sekolah dan merealisasikan visi misi sekolah</li>
                    <li>Mengembangkan minat, kemampuan, dan kebiasan membaca khususnya serta mendayagunakan budaya tulisan,
                        dalam
                        berbagai sektor kehidupan</li>
                    <li>Mendidik siswa agar memelihara dan memanfaatkan bahan pustaka secara tepat guna dan berhasil guna
                    </li>
                    <li>Meletakkan dasar kearah proses pembelajaran mandiri</li>
                    <li>Merintis E-Library untuk wider accesing informasi dan IPTEK</li>
                    <li>Mewujudkan kualitas dan kuantitas buku bacaan dan referensi</li>
                    <li>Melayani semua warga sekolah dengan layanan prima.</li>
                </ol>
            </div>
            <div class="col-12 col-md-12 col-lg-6 px-5">
                <h1 class="text-black text-shadow fw-bold text-center" data-aos="fade-up-left">Visi</h1>
                <p style="text-align: center;" data-aos="zoom-out-left">Terciptanya Peserta Didik, Guru, Karyawan SMA N 1
                    Tunjungan yang
                    Berkualitas
                    dengan Budaya Membaca
                    dan
                    Belajar</p>
                <h1 class="text-black text-shadow fw-bold text-center" data-aos="fade-up-left">Misi</h1>
                <ol style="text-align: justify; font-size: 15px;" data-aos="zoom-out-left">
                    <span class="ms-3"></span>
                    <li> Pusat Layanan Prima, Pusat Dokumentasi dan Informasi (PUSDOKINFO)</li>
                    <li>Pusat Pengembangan Minat Baca</li>
                    <li>Sarana Rekreasi Pendidikan yang Menyenangkan</li>
                    <li>Perpustakan Modern yang Berbasis Teknologi Informasi</li>

                </ol>
            </div>
        </div>
    </div>


    {{-- <span class="ms-3"></span>
    <div class="container"
        style="background: #fff; max-width: 100%; height: 80px; display: flex; justify-content: center; align-items: center;">
        <h2 class="text-black text-shadow fw-semibold text-center">Struktur Organisasi</h2>
    </div>
    <span class="ms-3"></span>
    <img src="css/images/struktur.jpg" alt="Perpustakaan" style="display: block; margin: 0 auto; width: 40%;" />
    <span class="ms-3"></span> --}}

    <div class="container py-5">
        <div class="row" data-aos="zoom-in">
            <h1 class="text-black text-shadow fw-bold text-center">Video Profile</h1>
            <p class="text-black text-shadow text-center">Perpustakaan Yasa Waskitha SMA N 1 Tunjungan</p>

            <div
                style="position: relative; width: 60%; padding-bottom: 33.75%; /* 16:9 aspect ratio */ height: 0; overflow: hidden; border-radius: 16px; margin: auto;">
                <iframe src="https://www.youtube.com/embed/C5tpb_zMOus" frameborder="0" width="100%" height="100%"
                    style="position: absolute; top: 0; left: 0; border: 0; border-radius: 16px;" allowfullscreen></iframe>
            </div>

        </div>
    </div>

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
                delay: 1500,
                disableOnInteraction: false,
            },
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            loop: true,
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
