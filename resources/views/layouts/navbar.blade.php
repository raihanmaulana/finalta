<!-- navbar -->
<style>
    .navbar {
        font-size: 14px;
    }

    .btn {
        font-size: 14px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('css\images\logo.png') }}" alt="SMA N 1 Tunjungan" width="30" height="auto" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link" href="galeri">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact.html">Contact</a>
                </li>
            </ul>
            <form class="d-flex">
                <a class="btn btn-primary me-2" href="anggota/login" role="button">Anggota</a>
                <a class="btn btn-outline-primary" href="signin" role="button">Admin</a>
            </form>

        </div>
    </div>
</nav>
<!-- end -->
