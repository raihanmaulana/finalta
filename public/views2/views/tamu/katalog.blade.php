<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Perpustakaan SMAN 1 Tunjungan</title>
        <!-- bootsrap css and js -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link
            href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
            rel="stylesheet"
        />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- my css -->
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <!-- navbar -->
        <section id="navbar">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img
                            src="img/logo.png"
                            alt="Bootstrap"
                            width="30"
                            height="auto"
                        />
                    </a>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div
                        class="collapse navbar-collapse"
                        id="navbarSupportedContent"
                    >
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a
                                    class="nav-link active"
                                    aria-current="page"
                                    href="#"
                                    >Beranda</a
                                >
                            </li>
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="navbarDropdown"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    Katalog
                                </a>
                                <ul
                                    class="dropdown-menu"
                                    aria-labelledby="navbarDropdown"
                                >
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            >Kategori 1</a
                                        >
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            >Kategori 2</a
                                        >
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            >Kategori 3</a
                                        >
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Galeri</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Kontak</a>
                            </li>
                        </ul>

                        <div
                            class="d-grid gap-2 d-md-flex justify-content-md-end"
                        >
                            <button class="btn btn-dark me-md-2" type="button">
                                Login
                            </button>
                            <button class="btn btn-outline-dark" type="button">
                                Admin
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </section>
        <!-- end navbar -->

        <!-- header -->
        <section id="header">
            <div id="carouselExample" class="carousel slide" height="50">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img
                            src="img/1920x540.png"
                            class="d-block w-100"
                            alt="..."
                        />
                    </div>
                    <div class="carousel-item">
                        <img
                            src="img/1920x540.png"
                            class="d-block w-100"
                            alt="..."
                        />
                    </div>
                    <div class="carousel-item">
                        <img
                            src="img/1920x540.png"
                            class="d-block w-100"
                            alt="..."
                        />
                    </div>
                </div>
                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#carouselExample"
                    data-bs-slide="prev"
                >
                    <span
                        class="carousel-control-prev-icon"
                        aria-hidden="true"
                    ></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#carouselExample"
                    data-bs-slide="next"
                >
                    <span
                        class="carousel-control-next-icon"
                        aria-hidden="true"
                    ></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <!-- end header -->

        <!-- katalog -->
        <section id="katalog">
            <div class="container mt-5">
                <div class="title text-center">
                    <h2 class="position-relative d-inline-block">
                        New Collection
                    </h2>
                </div>

                <div class="row g-3">
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-90">
                            <img
                                src="img/130x190.png"
                                class="card-img-top mt-3 mx-auto"
                                alt="..."
                            />
                            <div class="card-body text-center">
                                <h6 class="card-title">Card title</h6>
                                <button class="btn btn-dark">Detail</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-90">
                            <img
                                src="img/130x190.png"
                                class="card-img-top mt-3 mx-auto"
                                alt="..."
                            />
                            <div class="card-body text-center">
                                <h6 class="card-title">Card title</h6>
                                <button class="btn btn-dark">Detail</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-90">
                            <img
                                src="img/130x190.png"
                                class="card-img-top mt-3 mx-auto"
                                alt="..."
                            />
                            <div class="card-body text-center">
                                <h6 class="card-title">Card title</h6>
                                <button class="btn btn-dark">Detail</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-90">
                            <img
                                src="img/130x190.png"
                                class="card-img-top mt-3 mx-auto"
                                alt="..."
                            />
                            <div class="card-body text-center">
                                <h6 class="card-title">Card title</h6>
                                <button class="btn btn-dark">Detail</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-90">
                            <img
                                src="img/130x190.png"
                                class="card-img-top mt-3 mx-auto"
                                alt="..."
                            />
                            <div class="card-body text-center">
                                <h6 class="card-title">Card title</h6>
                                <button class="btn btn-dark">Detail</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-90">
                            <img
                                src="img/130x190.png"
                                class="card-img-top mt-3 mx-auto"
                                alt="..."
                            />
                            <div class="card-body text-center">
                                <h6 class="card-title">Card title</h6>
                                <button class="btn btn-dark">Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end katalog -->

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
