@extends('public.index') <!-- Meng-extend template utama -->

@section('css')
    <!-- Konten CSS spesifik untuk halaman ini -->
    <link rel="stylesheet" href="{{ asset('css/guest.css') }}" />
@endsection

@section('content')
    <!-- Two content sections -->

    <section id="header">
        <div class="container">
            <div class="middle" data-aos="zoom-in-up">
                <h1 class="text-black text-shadow fw-bold text-center">Selamat Datang!</h1>
                <p class="text-shadow">Perpustakaan SMA Negeri 1 Tunjungan</p>

                <div class="card round">
                    <div class="card-body">
                        <div class="social-container">
                            <div class="follow-container">
                                <p class="follow-text"><small>Ikuti Kami :</small></p>
                            </div>
                            <div class="social-icons">
                                <a href="https://web.facebook.com/sman1tunjungan" title="Facebook"><i
                                        class="fa-brands fa-facebook fa-2xl" style="color: #0f7dd2;"></i></a>
                                <a href="https://twitter.com" title="Twitter"><i class="fa-brands fa-x-twitter fa-2xl"
                                        style="color: #101010;"></i></a>
                                <a href="https://www.instagram.com" title="Instagram"><i class="fab fa-instagram fa-2xl"
                                        style="color: #ac2bac;"></i></a>
                                <a href="https://www.youtube.com" title="Youtube"><i class="fa-brands fa-youtube fa-2xl"
                                        style="color: #ff0000;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1"
                d="M0,192L60,181.3C120,171,240,149,360,133.3C480,117,600,107,720,106.7C840,107,960,117,1080,122.7C1200,128,1320,128,1380,128L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
            </path>
        </svg>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
    <!-- end -->
@endsection
