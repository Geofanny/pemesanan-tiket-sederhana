<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta SEO -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taman Safari Bogor</title>

    <!-- Link Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Link CSS -->
    <link rel="stylesheet" href="css/pakwis.css">

    <!-- Link Favicon -->
    <link rel="icon" type="image/x-icon" href="img/icon_3.png">
    
</head>
<body>
    <!-- Navbar -->
    <div class="container-fluid p-3 bg-success" id="navbar-com">
        <h3 class="m-auto text-white text-center">Selamat Datang Di Taman Safari Bogor</h3>
    </div>
    <!-- Gallery -->
    <div id="banner-container" class="container-fluid gallery">
        <div class="row">
            <div class="col list-img"></div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container-fluid">
            <a class="navbar-brand text-white">Taman Safari Bogor</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="pemesanan.php">Daftar Paket Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="pakwis.php">Modifikasi Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="tentang.php">Tentang Kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Paket Wisata -->
    <div class="container-fluid py-4">
        <div class="row">
            <!-- Paket Wisata Cards -->
            <div class="col-lg-8 mb-4">
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm">
                            <img src="img/paket_7.jpg" class="card-img-top img-ket" alt="Paket Serbu Safari">
                            <div class="card-body">
                                <h5 class="card-title">Paket Serbu Safari</h5>
                                <p class="card-text">Nikmati pengalaman safari yang seru dan tak terlupakan bersama keluarga atau teman.</p>
                                <a href="pemesanan.php" class="btn btn-success">Daftar Paket</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm">
                            <img src="img/paket_6.jpg" class="card-img-top img-ket" alt="Paket Keluarga Besar">
                            <div class="card-body">
                                <h5 class="card-title">Paket Keluarga Besar</h5>
                                <p class="card-text">Rasakan keseruan bersama keluarga besar dengan berbagai aktivitas seru dan menyenangkan.</p>
                                <a href="pemesanan.php" class="btn btn-success">Daftar Paket</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm">
                            <img src="img/paket_5.jpg" class="card-img-top img-ket" alt="Paket Besty Safari">
                            <div class="card-body">
                                <h5 class="card-title">Paket Besty Safari</h5>
                                <p class="card-text">Petualangan seru bersama sahabat di Taman Safari dengan program yang menyenangkan.</p>
                                <a href="pemesanan.php" class="btn btn-success">Daftar Paket</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm">
                            <img src="img/paket_4.jpg" class="card-img-top img-ket" alt="Paket Safari Adventure">
                            <div class="card-body">
                                <h5 class="card-title">Paket Safari Adventure</h5>
                                <p class="card-text">Jelajahi petualangan seru dengan berbagai aktivitas menantang di Taman Safari.</p>
                                <a href="pemesanan.php" class="btn btn-success">Daftar Paket</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Video Section -->
            <div class="col-lg-4">
                <div class="row">
                    <!-- Video Card 1 -->
                    <div class="col-md-12 mb-3">
                        <div class="card shadow-sm rounded">
                            <div class="card-body d-flex flex-column align-items-center text-center p-3">
                                <h5 class="mb-3">Paket Wisata 1</h5>
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/85pnav0GXTY" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Video Card 2 -->
                    <div class="col-md-12 mb-3">
                        <div class="card shadow-sm rounded">
                            <div class="card-body d-flex flex-column align-items-center text-center p-3">
                                <h5 class="mb-3">Paket Wisata 2</h5>
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/8PlhjQjU_3A" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-success text-white py-4 mt-4">
        <div class="container">
            <div class="row mb-4">
                <!-- About Us -->
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5 class="fw-bold">Tentang Kami</h5>
                    <p>Kami adalah destinasi wisata yang menawarkan pengalaman luar biasa. Temukan sejarah, misi, dan visi kami.</p>
                    <a href="tentang.php" class="btn btn-light text-success">Selengkapnya</a>
                </div>

                <!-- Links -->
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5 class="fw-bold">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white">Beranda</a></li>
                        <li><a href="pemesanan.php" class="text-white">Daftar Paket Wisata</a></li>
                        <li><a href="pakwis.php" class="text-white">Modifikasi Pesanan</a></li>
                        <li><a href="tentang.php" class="text-white">Tentang Kami</a></li>
                    </ul>
                </div>

                <!-- Contact Us -->
                <div class="col-md-4 mb-4 mb-md-0 contact">
                    <h5 class="fw-bold">Hubungi Kami</h5>
                    <p><i class="bi bi-geo-alt"></i> Jalan Raya Puncak No.601, Cisarua, Bogor, Jawa Barat, Indonesia</p>
                    <p><i class="bi bi-envelope"></i> info@tamansafaribogor.com</p>
                    <p><i class="bi bi-telephone"></i> (0251) 8250000</p>
                    <!-- <div class="mt-4 sosmed">
                        <a href="#" class="text-white mx-2 icon"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#" class="text-white mx-2 icon"><i class="bi bi-twitter fs-4"></i></a>
                        <a href="#" class="text-white mx-2 icon"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="#" class="text-white mx-2 icon"><i class="bi bi-youtube fs-4"></i></a>
                    </div> -->
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-4 border-top text-center pt-3">
                <p class="copyright">&copy; 2024 JWD Geofanny &bull; Destinasi Paket Wisata &bull; Taman Safari Bogor</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>