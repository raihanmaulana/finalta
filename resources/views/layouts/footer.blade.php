<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sosial Media</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .text {
            font-weight: bold;
            text-align: center;
            text: black;
        }

        a {
            text-decoration: none;
        }

        .fs-5 {
            margin-bottom: 100px;
        }

        .social-container {
            display: flex;
            /* Menggunakan flex container */
            align-items: center;
            /* Memposisikan anak-anak secara vertikal di tengah */
        }

        .follow-container {
            margin-right: 10px;
            /* Menambahkan jarak antara teks dan ikon */
        }

        .social-icons {
            display: flex;
            /* Menggunakan flex container untuk ikon */
            gap: 16px;
        }
    </style>
</head>

<body>
    <footer class="p-5 text-dark" style="background-color: #d9d9d9;">
        <div class="container">
            <div class="row">
                <!-- Bagian Container Kiri -->
                <div class="col-lg-6 text-start">
                    <h5><img src="{{ asset('css/images/logo.png') }}" alt="logo" height="50"><strong>SMA NEGERI 1
                            TUNJUNGAN</strong>
                    </h5>
                </div>
                <!-- Bagian Container Kanan -->
                <div class="col-lg-6 text-end">
                    <div class="social-icons d-flex flex-column">
                        <div class="text">
                            <span class="fs-5">IKUTI KAMI</span>
                        </div>
                        <a href="https://web.facebook.com/sman1tunjungan" title="Facebook">
                            <i class="fa-brands fa-facebook fa-2xl" style="color: #0f7dd2;"></i>
                            <span class="ms-3" style="color: #101010;">sman1tunjungan</span>
                        </a>
                        <a href="https://twitter.com" title="Twitter">
                            <i class="fa-brands fa-x-twitter fa-2xl" style="color: #101010;"></i>
                            <span class="ms-3" style="color: #101010;">sman1tunjungan</span>
                        </a>
                        <a href="https://www.instagram.com" title="Instagram">
                            <i class="fab fa-instagram fa-2xl" style="color: #ac2bac;"></i>
                            <span class="ms-3" style="color: #101010;">sman1tunjungan</span>
                        </a>
                        <a href="https://www.youtube.com" title="Youtube">
                            <i class="fa-brands fa-youtube fa-2xl" style="color: #ff0000;"></i>
                            <span class="ms-3" style="color: #101010;">sman1tunjungan</span>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="mb-4 mt-5">
            <div class="row align-items-center text-center pb-5">


                <a href="perpustakaan" style="text-decoration: none;" class="text-dark">Copyright ©2024 All rights
                    reserved
                    by:
                    <strong class="text-dark">SMA Negeri 1 Tunjungan</strong>
                </a>

            </div>
        </div>
    </footer>
</body>

</html>