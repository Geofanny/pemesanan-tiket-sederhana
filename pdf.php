<?php

// Hubungkan ke file koneksi database
require 'koneksi.php';

// Ambil ID pesanan dari query string, default 0 jika tidak ada
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Query untuk mengambil data pesanan berdasarkan ID
    $query = "SELECT * FROM pesanan WHERE id_pesanan = $id";
    $result = mysqli_query($con, $query);
    
    if (!$result) {
        die("Query gagal: " . mysqli_error($con));
    }

    // Ambil data pesanan dari hasil query
    $pesanan = mysqli_fetch_assoc($result);

    if (!$pesanan) {
        echo "Pesanan tidak ditemukan.";
        exit;
    }

    // Hitung diskon berdasarkan jumlah peserta
    $jumlahPeserta = $pesanan['jumlahPeserta'];
    $diskon = ($jumlahPeserta >= 5 && $jumlahPeserta <= 10) ? 10 :
              (($jumlahPeserta > 10 && $jumlahPeserta <= 15) ? 15 :
              (($jumlahPeserta > 15 && $jumlahPeserta <= 20) ? 20 :
              (($jumlahPeserta > 20) ? 25 : 0)));

    // Diskon spesial jika memenuhi kondisi tertentu
    if (strtolower($pesanan['pelayanan']) == 'penginapan,transportasi,makan' && $jumlahPeserta > 40) {
        $diskon = 35;
    }

    // Hitung total tagihan setelah diskon
    $hargaPaket = $pesanan['hargaPaket'];
    $jumlahTagihan = $pesanan['jumlahTagihan'];
    $diskonAmount = ($diskon / 100) * $jumlahTagihan;
    $jumlahTagihanDiskon = $jumlahTagihan - $diskonAmount;
} else {
    // Redirect jika ID tidak valid
    header("Location: pakwis.php");
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

// Inisialisasi MPDF dengan ukuran kertas khusus
$mpdf = new \Mpdf\Mpdf([
    'format' => [80, 150],  // Lebar 80mm dan tinggi 150mm
    'margin_left' => 5,
    'margin_right' => 5,
    'margin_top' => 5,
    'margin_bottom' => 5
]);

// HTML untuk struk bukti pendaftaran
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pdf.css">
</head>
<body>
    <div class="header">
        <h1>Struk Pendaftaran</h1>
        <p>Paket Wisata</p>
    </div>

    <div class="details">
        <p><strong>Nama Pemesan:</strong> ' . htmlspecialchars($pesanan['namaPemesan']) . '</p>
        <p><strong>Jumlah Peserta:</strong> ' . htmlspecialchars($pesanan['jumlahPeserta']) . '</p>
        <p><strong>Lama Hari:</strong> ' . htmlspecialchars($pesanan['waktuPelaksanaan']) . ' Hari</p>
        <p><strong>Tanggal Pemesanan:</strong> ' . date('d-m-Y', strtotime($pesanan['tanggalPesan'])) . '</p>
    </div>

    <div class="summary">
        <p><strong>Nama Paket:</strong> ' . htmlspecialchars($pesanan['namaPaket']) . '</p>
        <p><strong>Harga Paket:</strong> Rp' . number_format($hargaPaket, 0, ',', '.') . '</p>
        <p><strong>Jumlah Tagihan:</strong> Rp' . number_format($jumlahTagihan, 0, ',', '.') . '</p>
        <p><strong>Diskon:</strong> ' . $diskon . '%</p>
        <p><strong>Total Setelah Diskon:</strong> Rp' . number_format($jumlahTagihanDiskon, 0, ',', '.') . '</p>
    </div>

    <div class="total">
        <p>Total Bayar: Rp' . number_format($jumlahTagihanDiskon, 0, ',', '.') . '</p>
    </div>

    <div class="footer">
        <p>Terima kasih atas pendaftaran Anda!</p>
        <p>Hubungi kami jika ada pertanyaan.</p>
    </div>
</body>
</html>';

// Tulis HTML ke PDF dan unduh
$mpdf->WriteHTML($html);
$namaFile = 'bukti_pendaftaran_' . urlencode($pesanan['namaPemesan']) . '.pdf';
$mpdf->Output($namaFile, \Mpdf\Output\Destination::DOWNLOAD);

?>
