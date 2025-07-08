<?php 

// Menghubungkan file koneksi ke database 
require 'koneksi.php';

// Tentukan jumlah data per halaman
$limit = 10;

// Ambil nomor halaman saat ini dari URL, default ke 1 jika tidak ada
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Query untuk mengambil data pesanan dari database dengan batasan
$query = mysqli_query($con, "SELECT * FROM `pesanan` ORDER BY namaPaket ASC, id_pesanan DESC LIMIT $start, $limit");


// Query untuk menghitung total data
$totalQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM `pesanan`");
$totalData = mysqli_fetch_array($totalQuery)['total'];
$totalPages = ceil($totalData / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta SEO -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taman Safari Bogor</title>

    <!-- Link Bootstrap CSS -->
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
                        <a class="nav-link text-white" aria-current="page" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="pemesanan.php">Daftar Paket Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="pakwis.php">Modifikasi Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="tentang.php">Tentang Kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Daftar Paket Wisata -->
    <div class="container-fluid">
        <h2 class="my-4">Daftar Pesanan</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>Nama Paket</th>
                        <th>Nama</th>
                        <th>Phone</th>
                        <th>Jumlah Peserta</th>
                        <th>Jumlah Hari</th>
                        <th>Akomodasi</th>
                        <th>Transportasi</th>
                        <th>Service/Makan</th>
                        <th>Harga Tiket</th>
                        <th>Total Tagihan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_array($query)) {
                        // Pisahkan layanan dengan koma
                        $dataLayanan = explode(',', $data['pelayanan']);
                        ?>
                        <tr>
                            <td>
                                <?php
                                // Ambil namaPaket
                                $namaPaket = htmlspecialchars($data['namaPaket']);

                                // Menentukan badge class berdasarkan nama paket
                                switch ($namaPaket) {
                                    case 'Paket Serbu Safari':
                                    $badgeClass = 'bg-primary';
                                    break;
                                    case 'Paket Keluarga Besar':
                                    $badgeClass = 'bg-success';
                                    break;
                                    case 'Paket Besty Safari':
                                    $badgeClass = 'bg-dark';
                                    break;
                                    case 'Paket Safari Adventure':
                                    $badgeClass = 'bg-danger';
                                    break;
                                    default:
                                    $badgeClass = 'bg-secondary';
                                }
                                ?>
                                <span class="badge rounded-pill <?= $badgeClass; ?>">
                                    <?= $namaPaket; ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($data['namaPemesan']); ?></td>
                            <td><?= htmlspecialchars($data['noHp']); ?></td>
                            <td><?= htmlspecialchars($data['jumlahPeserta']); ?></td>
                            <td><?= htmlspecialchars($data['waktuPelaksanaan']); ?></td>
                            <td><?= in_array('penginapan', $dataLayanan) ? 'Y' : 'N'; ?></td>
                            <td><?= in_array('transportasi', $dataLayanan) ? 'Y' : 'N'; ?></td>
                            <td><?= in_array('makan', $dataLayanan) ? 'Y' : 'N'; ?></td>
                            <td>
                                <span class="text-danger fw-bold">Rp.<?= htmlspecialchars(number_format($data['hargaPaket'], 0, ',', '.')); ?></span>
                            </td>
                            <td>
                                <span class="text-danger fw-bold">Rp.<?= htmlspecialchars(number_format($data['jumlahTagihan'], 0, ',', '.')); ?></span>
                            </td>
                            <td>
                                <a href="edit.php?id=<?= $data['id_pesanan'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="hapus.php?id=<?= $data['id_pesanan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');">Hapus</a>
                                <a href="pdf.php?id=<?= $data['id_pesanan'] ?>" class="btn btn-warning btn-sm">Struk</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php } ?>
                <li class="page-item <?= $page >= $totalPages ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
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

                <!-- Quick Links -->
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
