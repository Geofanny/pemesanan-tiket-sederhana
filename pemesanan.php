<?php

// Menghubungkan ke file koneksi database
require 'koneksi.php';

// Menentukan harga untuk setiap jenis pelayanan
$hargaPenginapan = 1000000;
$hargaTransportasi = 1200000;
$hargaServisMakan = 500000;

// Array untuk menyimpan pesan kesalahan
$errors = [];

if (isset($_POST['submit'])) {
    // Mengambil data dari form
    $namaPemesan = $_POST['namaPemesan'];
    $noHp = $_POST['noHp'];
    $namaPaket = $_POST['namaPaket'];
    $tanggalPesan = $_POST['tanggalPesan'];
    $waktuPelaksanaan = $_POST['waktuPelaksanaan'];
    $pelayanan = isset($_POST['pelayanan']) ? implode(",", $_POST['pelayanan']) : '';
    $jumlahPeserta = $_POST['jumlahPeserta'];
    $hargaPaket = str_replace('.', '', $_POST['hargaPaket']);
    $jumlahTagihan = str_replace('.', '', $_POST['jumlahTagihan']);

    //  Validasi input
    if (empty($namaPemesan)) $errors[] = 'Nama Pemesan harus diisi.';
    if (empty($noHp)) $errors[] = 'No. Hp/Telp harus diisi.';
    if (empty($namaPaket)) $errors[] = 'Pilih salah satu Jenis Paket ';
    if (empty($tanggalPesan)) $errors[] = 'Tanggal Pesan harus diisi.';
    if (empty($waktuPelaksanaan)) $errors[] = 'Waktu Pelaksanaan harus diisi.';
    if (empty($pelayanan)) $errors[] = 'Pilih setidaknya satu jenis pelayanan.';
    if (empty($jumlahPeserta)) $errors[] = 'Jumlah Peserta harus diisi.';
    // if (empty($hargaPaket)) $errors[] = 'Harga Paket belum dihitung.';
    // if (empty($jumlahTagihan)) $errors[] = 'Jumlah Tagihan belum dihitung.';

    // Jika tidak ada kesalahan, simpan data ke database
    if (empty($errors)) {
        $query = mysqli_query($con, "INSERT INTO pesanan VALUES ('','$namaPemesan','$noHp','$namaPaket','$tanggalPesan','$waktuPelaksanaan','$pelayanan','$jumlahPeserta','$hargaPaket','$jumlahTagihan')");
        
        if ($query) {
            // Ambil ID pesanan terakhir yang baru ditambahkan
            $last_id = mysqli_insert_id($con);
            header("Location: bukti.php?id=" . $last_id);
            exit;
        } else {
            $errors[] = 'Terjadi kesalahan saat menambahkan data.';
        }
    }
}
?>
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
    
    <!-- gallery -->
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

    <!-- Formulir Pemesanan -->
    <div class="container-fluid p-3">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-4">Formulir Pemesanan Paket Wisata</h4>
                <!-- Tampilkan error jika ada -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <!-- List Promo Diskon -->
                    <div class="col-md-5 order-md-1 order-1 mb-4">
                        <div class="card shadow-sm p-4 bg-light">
                            <h4 class="mb-3 text-primary">Promo Diskon</h4>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Diskon 5-10 Peserta
                                    <span class="badge bg-success rounded-pill">10%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Diskon 10-15 Peserta
                                    <span class="badge bg-success rounded-pill">15%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Diskon 15-20 Peserta
                                    <span class="badge bg-success rounded-pill">20%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Diskon 20+ Peserta
                                    <span class="badge bg-success rounded-pill">25%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Diskon Spesial Full Pelayanan & 40+ Peserta
                                    <span class="badge bg-primary rounded-pill">35%</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-7 order-md-2 order-2">
                        <div class="card shadow-sm p-4">
                            <!-- Form untuk tambah pesanan -->
                            <form action="pemesanan.php" method="post" autocomplete="off">
                                <div class="mb-3">
                                    <label for="namaPaket" class="form-label">Nama Paket</label>
                                    <select class="form-select" name="namaPaket" id="namaPaket" required>
                                        <option value="" disabled selected>Pilih Paket Wisata</option>
                                        <option value="Paket Serbu Safari">Paket Serbu Safari</option>
                                        <option value="Paket Keluarga Besar">Paket Keluarga Besar</option>
                                        <option value="Paket Besty Safari">Paket Besty Safari</option>
                                        <option value="Paket Safari Adventure">Paket Safari Adventure</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="namaPemesan" class="form-label">Nama Pemesan</label>
                                    <input type="text" class="form-control" name="namaPemesan" id="namaPemesan" placeholder="Masukkan Nama Pemesan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="noHp" class="form-label">No. Hp/Telp</label>
                                    <input type="text" maxlength="18" class="form-control"  name="noHp"  id="noHp" placeholder="Masukkan No. Hp/Telp" required>
                                    <p id="error-message-noHp" style="color: red; display: none;">hanya angka 0-9, spasi, simbol +, dan ( )</p>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggalPesan" class="form-label">Tanggal Pesan</label>
                                    <input type="date" class="form-control" name="tanggalPesan" id="tanggalPesan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="waktuPelaksanaan" class="form-label">Waktu Pelaksanaan Perjalanan</label>
                                    <input type="number" class="form-control" placeholder="Masukkan Lama Perjalanan / hari" name="waktuPelaksanaan" id="waktuPelaksanaan" required>
                                    <p id="error-message" style="color: red; display: none;">Waktu Perjalanan minimal 1 hari</p>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Pelayanan Paket Perjalanan :</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="pelayanan[]" value="penginapan" id="penginapan">
                                        <label class="form-check-label" for="penginapan">
                                            Penginapan (1.000.000)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="pelayanan[]" value="transportasi" id="transportasi">
                                        <label class="form-check-label" for="transportasi">
                                            Transportasi (1.200.000)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="pelayanan[]" value="makan" id="servisMakan">
                                        <label class="form-check-label" for="servisMakan">
                                            Servis / Makan (500.000)
                                        </label>
                                    </div>
                                </div>
                                <label class="form-label">Makanan :</label>
                                <div class="mb-3">
                                    <label for="jumlahPeserta" class="form-label">Jumlah Peserta</label>
                                    <input type="number" class="form-control" placeholder="Masukkan Jumlah Peserta" name="jumlahPeserta" id="jumlahPeserta" required>
                                    <p id="error-message-2" style="color: red; display: none;">Jumlah Peserta minimal 1 orang</p>
                                </div>
                                <div class="mb-3">
                                    <label for="hargaPaket" class="form-label">Harga Paket Perjalanan</label>
                                    <input type="text" class="form-control" name="hargaPaket" id="hargaPaket" placeholder="0" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlahTagihan" class="form-label">Jumlah Tagihan</label>
                                    <input type="text" class="form-control" name="jumlahTagihan" id="jumlahTagihan" placeholder="0" readonly>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="index.php" class="btn btn-danger">Kembali</a>
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script JS -->
    <script src="js/hitung.js"></script>

</body>
</html>
