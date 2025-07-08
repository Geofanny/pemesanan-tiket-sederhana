<?php
// Menghubungkan dengan database
require 'koneksi.php';

// Ambil ID dari URL dan ambil data pesanan berdasarkan ID
$id = $_GET['id'];
$query = mysqli_query($con, "SELECT * FROM pesanan WHERE id_pesanan='$id'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan, arahkan ke halaman utama
if (!$data) {
    header("Location: index.php");
    exit;
}

// array untuk menyimpan error 
$errors = [];

// Proses jika form dikirim
if (isset($_POST['update'])) {
    // Ambil data dari form
    $namaPemesan = $_POST['namaPemesan'];
    $noHp = $_POST['noHp'];
    $namaPaket = $_POST['namaPaket'];
    $tanggalPesan = $_POST['tanggalPesan'];
    $waktuPelaksanaan = $_POST['waktuPelaksanaan'];
    $pelayanan = isset($_POST['pelayanan']) ? implode(",", $_POST['pelayanan']) : '';
    $jumlahPeserta = $_POST['jumlahPeserta'];
    $hargaPaket = str_replace('.', '', $_POST['hargaPaket']);
    $jumlahTagihan = str_replace('.', '', $_POST['jumlahTagihan']);

    // Validasi input
    if (empty($namaPemesan)) $errors[] = 'Nama Pemesan harus diisi.';
    if (empty($noHp)) $errors[] = 'No. Hp/Telp harus diisi.';
    if (empty($namaPaket)) $errors[] = 'Pilih salah satu Jenis Paket ';
    if (empty($tanggalPesan)) $errors[] = 'Tanggal Pesan harus diisi.';
    if (empty($waktuPelaksanaan)) $errors[] = 'Waktu Pelaksanaan harus diisi.';
    if (empty($pelayanan)) $errors[] = 'Pilih setidaknya satu jenis pelayanan.';
    if (empty($jumlahPeserta)) $errors[] = 'Jumlah Peserta harus diisi.';
    // if (empty($hargaPaket)) $errors[] = 'Harga Paket harus diisi.';
    // if (empty($jumlahTagihan)) $errors[] = 'Jumlah Tagihan harus diisi.';

     // Jika tidak ada error, update data pesanan
    if (empty($errors)) {
        $query = mysqli_query($con, "UPDATE pesanan SET 
            namaPemesan='$namaPemesan', 
            noHp='$noHp', 
            namaPaket = '$namaPaket',
            tanggalPesan='$tanggalPesan', 
            waktuPelaksanaan='$waktuPelaksanaan', 
            pelayanan='$pelayanan', 
            jumlahPeserta='$jumlahPeserta', 
            hargaPaket='$hargaPaket', 
            jumlahTagihan='$jumlahTagihan'
            WHERE id_pesanan='$id'");
        
        // Jika update berhasil, arahkan ke halaman modifikasi pesanan
        if ($query) {
            header("Location: pakwis.php");
            exit;
        } else {
            $errors[] = 'Terjadi kesalahan saat memperbarui data.';
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
    <title>Edit Pesanan - Taman Safari Bogor</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Link CSS -->
    <link rel="stylesheet" href="css/pakwis.css">
    <!-- Icon Favicon -->
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

    <!-- Menu Navigasi -->
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


    <div class="container-fluid p-3">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-4">Edit Pesanan Paket Wisata</h4>
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
                <!-- Form untuk edit pesanan -->
                <form action="edit.php?id=<?= $id ?>" method="post">
                    <div class="mb-3">
                        <label for="namaPaket" class="form-label">Nama Paket</label>
                        <select class="form-select" name="namaPaket" id="namaPaket" required>
                            <option value="" disabled <?= empty($data['namaPaket']) ? 'selected' : ''; ?>>Pilih Paket Wisata</option>
                            <option value="Paket Serbu Safari" <?= $data['namaPaket'] == 'Paket Serbu Safari' ? 'selected' : ''; ?>>Paket Serbu Safari</option>
                            <option value="Paket Keluarga Besar" <?= $data['namaPaket'] == 'Paket Keluarga Besar' ? 'selected' : ''; ?>>Paket Keluarga Besar</option>
                            <option value="Paket Besty Safari" <?= $data['namaPaket'] == 'Paket Besty Safari' ? 'selected' : ''; ?>>Paket Besty Safari</option>
                            <option value="Paket Safari Adventure" <?= $data['namaPaket'] == 'Paket Safari Adventure' ? 'selected' : ''; ?>>Paket Safari Adventure</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="namaPemesan" class="form-label">Nama Pemesan</label>
                        <input type="text" class="form-control" name="namaPemesan" id="namaPemesan" placeholder="Masukkan Nama Pemesan" value="<?= htmlspecialchars($data['namaPemesan']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="noHp" class="form-label">No. Hp/Telp</label>
                        <input type="text" class="form-control" name="noHp" maxlength="18" id="noHp" placeholder="Masukkan No. Hp/Telp" value="<?= htmlspecialchars($data['noHp']); ?>">
                        <p id="error-message-noHp" style="color: red; display: none;">hanya angka 0-9, spasi, simbol +, dan ( )</p>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalPesan" class="form-label">Tanggal Pesan</label>
                        <input type="date" class="form-control" name="tanggalPesan" id="tanggalPesan" value="<?= htmlspecialchars($data['tanggalPesan']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="waktuPelaksanaan" class="form-label">Waktu Pelaksanaan</label>
                        <input type="text" class="form-control" placeholder="Masukkan Lama Perjalanan / hari" name="waktuPelaksanaan" id="waktuPelaksanaan" value="<?= htmlspecialchars($data['waktuPelaksanaan']); ?>" required>
                        <p id="error-message" style="color: red; display: none;">Waktu Perjalanan minimal 1 hari</p>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Pelayanan Paket Perjalanan :</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pelayanan[]" value="penginapan" id="penginapan" <?= in_array('penginapan', explode(',', $data['pelayanan'])) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="penginapan">
                                Penginapan (1.000.000)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pelayanan[]" value="transportasi" id="transportasi" <?= in_array('transportasi', explode(',', $data['pelayanan'])) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="transportasi">
                                Transportasi (1.200.000)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pelayanan[]" value="makan" id="servisMakan" <?= in_array('makan', explode(',', $data['pelayanan'])) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="servisMakan">
                                Servis / Makan (500.000)
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jumlahPeserta" class="form-label">Jumlah Peserta</label>
                        <input type="number" class="form-control" name="jumlahPeserta" id="jumlahPeserta" placeholder="Masukkan Jumlah Peserta" value="<?= htmlspecialchars($data['jumlahPeserta']); ?>">
                        <p id="error-message-2" style="color: red; display: none;">Jumlah Peserta minimal 1 orang</p>
                    </div>
                    <div class="mb-3">
                        <label for="hargaPaket" class="form-label">Harga Paket</label>
                        <input type="text" class="form-control" name="hargaPaket" id="hargaPaket" placeholder="Masukkan Harga Paket" value="<?= htmlspecialchars($data['hargaPaket']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="jumlahTagihan" class="form-label">Jumlah Tagihan</label>
                        <input type="text" class="form-control" name="jumlahTagihan" id="jumlahTagihan" placeholder="Masukkan Jumlah Tagihan" value="<?= htmlspecialchars($data['jumlahTagihan']); ?>">
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="pakwis.php" class="btn btn-danger">Kembali</a>
                        <button type="submit" name="update" class="btn btn-success">Simpan</button>
                    </div>
                </form>
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
    <!-- Script Js -->
    <script src="js/hitung.js"></script>
</body>
</html>
