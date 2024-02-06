@extends('layouts.layout')

@section('customcss')
<!----======== CSS ======== -->
<link rel="stylesheet" href="{{asset('css/utama/style.css')}}" />
<link rel="stylesheet" href="{{asset('css/utama/dashboard.css')}}" />


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('css/images/logo.png') }}" type="image/x-icon">
    <script src="https://kit.fontawesome.com/d94b3a5809.js" crossorigin="anonymous"></script>
    <title>Perpustakaan SMAN 1 Tunjungan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

@endsection

@section('content')
<!-- Two content sections -->
<div class="container-fluid">
    <div class="row">
        <!-- Left Content -->
        <div class="col-md-6">
            <div class="container-fluid banner d-flex justify-content-center align-items-center">
                <div class="container1"> <!-- Mengubah text-align menjadi left -->
                    <p>Selamat Datang!</p>
                    <dd>Perpustakaan SMA Negeri 1 Tunjungan</dd>
                    <a href="katalog">
                        <button type="button" href="katalog" class="btn btn-dark">Katalog Buku</button>
                    </a>
                    <div class="s">
                        <h6 class="page-title">Ikuti Kami</h6>
                        <div class="social-icons">
                            <a href="https://web.facebook.com/sman1tunjungan" title="Facebook"><i
                                    class="fa-brands fa-facebook fa-2xl" style="color: #0f7dd2;"></i></a>
                            <a href="https://twitter.com" title="Twitter"><i class="fa-brands fa-x-twitter fa-2xl"
                                    style="color: #101010;"></i></a>
                            <a href="https://www.instagram.com" title="Instagram"><i class="fab fa-instagram fa-2xl"
                                    style="color: #0f7dd2;"></i></a>
                            <a href="https://www.youtube.com" title="Youtube"><i class="fa-brands fa-youtube fa-2xl"
                                    style="color: #ff0000;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Right Content -->
        <div class="col-md-6"
            style="display: flex; flex-direction: column; align-items: stretch; background: url({{ asset('css/images/bg.jpg') }}) no-repeat center center fixed; background-size: cover;">

        </div>


    </div>
</div>
<!-- end -->
@endsection

@include('layout.template_footer')