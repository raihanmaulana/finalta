@extends('public.index')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/galeri.css') }}" />
@endsection
@section('content')
    <section id="header">
        <div class="container">
            <div class="middle pb-5" data-aos="zoom-in-up">
                <h1 class="text-white text-shadow fw-bold">Galeri</h1>
                <p class="text-shadow text-white">Perpustakaan SMA Negeri 1 Tunjungan</p>
            </div>
        </div>
    </section>
    <div class="container px-3 pt-2 pb-5">
        {{-- <p align="center">Dokumentasi Perpustakaan SMA Negeri 1 Tunjungan</p> --}}
        <div class="row g-3 mt-3">
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ asset('css/images/bg5.jpg') }}" class="card-img-top" width="100%" height="240px"
                        alt="Description for Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Image 1</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://images.pexels.com/photos/2419375/pexels-photo-2419375.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                        class="card-img-top" width="100%" height="240px"alt="Description for Image 2">
                    <div class="card-body">
                        <h5 class="card-title">Image 2</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card w-100">
                    <img src="https://images.pexels.com/photos/2326290/pexels-photo-2326290.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                        class="card-img-top" width="100%" height="240px" alt="Description for Image 3">
                    <div class="card-body">
                        <h5 class="card-title">Image 3</h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
