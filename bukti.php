<?php
require 'koneksi.php';

// Ambil ID pesanan dari query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $result = mysqli_query($con, "SELECT * FROM pesanan WHERE id_pesanan = $id");
    $pesanan = mysqli_fetch_assoc($result);
    
    // Hitung diskon
    $jumlahPeserta = $pesanan['jumlahPeserta'];
    $diskon = 0;

    if ($jumlahPeserta >= 5 && $jumlahPeserta <= 10) {
        $diskon = 10;
    } elseif ($jumlahPeserta > 10 && $jumlahPeserta <= 15) {
        $diskon = 15;
    } elseif ($jumlahPeserta > 15 && $jumlahPeserta <= 20) {
        $diskon = 20;
    } elseif ($jumlahPeserta > 20) {
        $diskon = 25;
    }
    
    // Diskon spesial jika full pelayanan dan lebih dari 40 orang
    if (strtolower($pesanan['pelayanan']) == 'penginapan,transportasi,makan' && $jumlahPeserta > 40) {
        $diskon = 35;
    }

    // Hitung total harga setelah diskon
    $hargaPaket = $pesanan['hargaPaket'];
    $jumlahTagihan = $pesanan['jumlahTagihan'];
    $diskonAmount = ($diskon / 100) * $jumlahTagihan;
    $jumlahTagihanDiskon = $jumlahTagihan - $diskonAmount;
} else {
    // echo "ID pesanan tidak valid.";
    header("Location: pemesanan.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta SEO -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Bukti Pendaftaran Paket Wisata</title>

    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
    <div id="banner-container" class="container-fluid gallery">
        <div class="row">
            <div class="col list-img"></div>
        </div>
    </div>

    <!-- Menu -->
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container-fluid">
            <a class="navbar-brand text-white">Taman Safari Bogor</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link  text-white" aria-current="page" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="pemesanan.php">Daftar Paket Wisata</a>
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

    <div class="container mt-4">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="text-success">Pendaftaran Paket Wisata Berhasil!</h1>
            <p class="lead">Terima kasih telah melakukan pendaftaran di Taman Safari Bogor.</p>
        </div>

        <!-- Detail Pemesan -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h5 class="text-success">Detail Pemesan</h5>
                <p><strong>Nama:</strong> <?= htmlspecialchars($pesanan['namaPemesan']); ?></p>
                <p><strong>No. Telepon:</strong> <?= htmlspecialchars($pesanan['noHp']); ?></p>
                <p><strong>Tanggal Pemesanan:</strong> <?= htmlspecialchars($pesanan['tanggalPesan']); ?></p>
            </div>
            <div class="col-md-6">
                <h5 class="text-success">Detail Paket</h5>
                <p><strong>Nama Paket:</strong> <?= htmlspecialchars($pesanan['namaPaket']); ?></p>
                <p><strong>Pelayanan:</strong> <span class="text-capitalize"><?= htmlspecialchars($pesanan['pelayanan']); ?></span></p>
                <p><strong>Jumlah Peserta:</strong> <?= htmlspecialchars($pesanan['jumlahPeserta']); ?></p>
                <p><strong>Jumlah Hari:</strong> <?= htmlspecialchars($pesanan['waktuPelaksanaan']); ?> hari</p>
            </div>
        </div>

        <!-- Rincian Biaya -->
        <h5 class="text-success">Rincian Biaya</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>Item</th>
                        <th>Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Harga Paket</td>
                        <td class="fw-bold"><?= "Rp. " . number_format($hargaPaket, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Tagihan</td>
                        <td class="text-danger fw-bold"><?= "Rp. " . number_format($jumlahTagihan, 0, ',', '.'); ?></td>
                    </tr>
                    <?php if ($diskon > 0): ?>
                        <tr>
                            <td>Diskon (<?= $diskon; ?>%)</td>
                            <td class="fw-bold"><?= "Rp. " . number_format($diskonAmount, 0, ',', '.'); ?></td>
                        </tr>
                        <tr>
                            <td>Total Setelah Diskon</td>
                            <td class="text-danger fw-bold"><?= "Rp. " . number_format($jumlahTagihanDiskon, 0, ',', '.'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Tanya Pembelian Lagi -->
        <div class="text-center mt-4">
            <p class="lead">Apakah Anda ingin melakukan pembelian lagi?</p>
            <a href="pemesanan.php" class="btn btn-success">Ya, Lanjutkan Pembelian</a>
            <a href="pakwis.php" class="btn btn-secondary">Tidak</a>
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
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-4 border-top text-center pt-3">
                <p class="copyright">&copy; 2024 JWD Geofanny &bull; Destinasi Paket Wisata &bull; Taman Safari Bogor</p>
            </div>
        </div>
    </footer>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
