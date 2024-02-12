<!-- navbar -->
<style>
    .navbar {
        font-size: 14px;
    }

    .btn {
        font-size: 14px;
    }

    .navbar-nav li.active a {
        font-weight: bold;
        /* Atur gaya sesuai kebutuhan Anda */
        color: black;
        /* Atur warna sesuai kebutuhan Anda */
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
                <li class="nav-item" id="beranda">
                    <a class="nav-link" aria-current="page" href="perpustakaan">Beranda</a>
                </li>
                <li class="nav-item" id="katalog">
                    <a class="nav-link" href="semuabuku">Katalog</a>
                </li>
                <li class="nav-item" id="galeri">
                    <a class="nav-link" href="galeri">Galeri</a>
                </li>
                <li class="nav-item" id="kontak">
                    <a class="nav-link" href="kontak">Kontak</a>
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

<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
<script>
    $(document).ready(function() {
        // Ambil path dari URL saat ini
        var currentPath = window.location.pathname;

        // Hapus karakter '/' pertama jika ada
        currentPath = currentPath.replace(/^\/+/, '');

        // Cek setiap elemen <li> pada navbar
        $('.navbar-nav li').each(function() {
            // Ambil href dari link dalam elemen <li>
            var linkHref = $(this).find('a').attr('href');

            // Hapus karakter '/' pertama jika ada
            linkHref = linkHref.replace(/^\/+/, '');

            // Bandingkan dengan path saat ini
            if (linkHref === currentPath) {
                // Jika cocok, tambahkan kelas 'active'
                $(this).addClass('active');
            }
        });
    });
</script>
