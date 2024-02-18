<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    @extends('account.layout')
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('css\images\logo.png') }}" alt="SMA N 1 Tunjungan" width="30" height="auto" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="perpustakaan">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="semuabuku">Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/galeri.html">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact.html">Contact</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <a class="btn btn-outline-primary" href="anggota/login" role="button">Login</a>
                    <ul>

                    </ul>
                    <a class="btn btn-outline-primary" href="anggota/register" role="button">Register</a>
                </form>
            </div>
        </div>
    </nav>
    <!-- end -->
    @section('app')
        <div id="app">
            <main class="py-4">
                @yield('content')
            </main>
        </div>

    </body>

    </html>
