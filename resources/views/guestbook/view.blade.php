@extends('account.layout')
@section('index')

<body>
    <div class="page page1">
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('css/images/logo.png') }}" class="img-fluid" />
                                </div>
                                <div class="col-9">
                                    <h2>PERPUSTAKAAN SMA NEGERI 1 TUNJUNGAN</h2>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="{{ route('guestbook.store') }}" class="row-6">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama Anda" />
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Asal Daerah</label>
                                <input type="text" name="message" class="form-control" id="message" placeholder="Masukkan Asal Daerah Anda" />
                            </div>
                            <div class="row-6 text-center center-content">
                                <button type="submit" class="btn btn-dark btn-lg btn-block">Masuk</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

@stop