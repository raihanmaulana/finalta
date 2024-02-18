@extends('public.index')

@section('css')
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
    <section id="kontak" class="py-5">
        <div class="container py-5">
            <div class="title text-center">
                <h1 class="text-black text-shadow fw-bold text-center" data-aos="zoom-in">Kontak Kami</h1>
            </div>
            <div class="card" data-aos="zoom-in">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <p><i class="fas fa-home mr-3"></i> &nbsp; Jl. Gatot Subroto, Tamansetro, Tamanrejo, Kec. Blora,
                                Kabupaten Blora, Jawa Tengah 58252</p>
                            <p><i class="fas fa-clock mr-3"></i> &nbsp; Senin - Sabtu (08.00 - 15.00)</p>
                            <p><i class="fas fa-phone mr-3"></i> &nbsp; 0296-531564</p>
                            <p><i class="fas fa-envelope mr-3"></i> &nbsp;<a
                                    href = "mailto:sman1tunjungan@gmail.com">sman1tunjungan@gmail.com</a> </p>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15841.449400864367!2d111.3826226!3d-6.9665104!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77472c03a45f1b%3A0x7a3493af830e20f9!2sSMAN%201%20TUNJUNGAN!5e0!3m2!1sen!2sid!4v1708080212548!5m2!1sen!2sid"
                                width="100%" height="320px" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection
