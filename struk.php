<?php

// Menghubungkan ke file koneksi database
require 'koneksi.php';

// Ambil ID pesanan dari query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Query untuk mengambil data pesanan berdasarkan ID
    $query = "SELECT * FROM pesanan WHERE id_pesanan = $id";
    $result = mysqli_query($con, $query);
    
    // Menampilkan pesan kesalahan jika query gagal
    if (!$result) {
        die("Query gagal: " . mysqli_error($con));
    }

    // Ambil data dari hasil query
    $pesanan = mysqli_fetch_assoc($result);

    // Menampilkan pesan jika pesanan tidak ditemukan
    if (!$pesanan) {
        echo "Pesanan tidak ditemukan.";
        exit;
    }

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
    // Menampilkan pesan jika ID pesanan tidak valid
    // echo "ID pesanan tidak valid.";
    header("Location: pakwis.php");
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
    <title>Bukti Pendaftaran Paket Wisata</title>

    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Link Css -->
    <link rel="stylesheet" href="css/struk.css">
</head>
<body onload="window.print();">
    <div class="container my-5">
        <div class="receipt">
            <!-- Header -->
            <div class="text-center mb-4">
                <h1 class="text-success">Taman Safari Bogor</h1>
                <p class="lead">Bukti Pembelian Paket Wisata</p>
                <hr>
            </div>

            <!-- Detail Pemesan -->
            <div class="row mb-3">
                <div class="col-6">
                    <p><strong>Nama:</strong> <?= htmlspecialchars($pesanan['namaPemesan']); ?></p>
                    <p><strong>No. Telepon:</strong> <?= htmlspecialchars($pesanan['noHp']); ?></p>
                </div>
                <div class="col-6 text-end">
                    <p><strong>Tanggal Pemesanan:</strong> <?= htmlspecialchars($pesanan['tanggalPesan']); ?></p>
                </div>
            </div>

            <!-- Detail Paket -->
            <div class="mb-3">
                <p><strong>Nama Paket:</strong> <?= htmlspecialchars($pesanan['namaPaket']); ?></p>
                <p><strong>Pelayanan:</strong> <span class="text-capitalize"><?= htmlspecialchars($pesanan['pelayanan']); ?></span></p>
                <p><strong>Jumlah Peserta:</strong> <?= htmlspecialchars($pesanan['jumlahPeserta']); ?></p>
                <p><strong>Jumlah Hari:</strong> <?= htmlspecialchars($pesanan['waktuPelaksanaan']); ?> hari</p>
            </div>

            <!-- Rincian Biaya -->
            <table class="table">
                <tbody>
                    <tr>
                        <td>Harga Paket</td>
                        <td class="text-end  fw-bold"><?= "Rp. " . number_format($hargaPaket, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Tagihan</td>
                        <td class="text-end text-danger fw-bold"><?= "Rp. " . number_format($jumlahTagihan, 0, ',', '.'); ?></td>
                    </tr>
                    <?php if ($diskon > 0): ?>
                        <tr>
                            <td>Diskon (<?= $diskon; ?>%)</td>
                            <td class="text-end fw-bold"><?= "Rp. " . number_format($diskonAmount, 0, ',', '.'); ?></td>
                        </tr>
                        <tr>
                            <td>Total Setelah Diskon</td>
                            <td class="text-end text-danger fw-bold"><?= "Rp. " . number_format($jumlahTagihanDiskon, 0, ',', '.'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Footer -->
            <div class="text-center mt-3">
                <p class="text-muted">Terima kasih telah memilih Taman Safari Bogor. Selamat menikmati liburan Anda!</p>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
