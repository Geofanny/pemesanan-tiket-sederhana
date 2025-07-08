<?php
// Menghubungkan dengan database
require 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Jika ID ada, hapus data dari database
if ($id) {
    // Query untuk menghapus data berdasarkan ID
    $query = mysqli_query($con, "DELETE FROM pesanan WHERE id_pesanan='$id'");

    // Jika query berhasil, arahkan ke halaman modifikasi pesanan
    if ($query) {
        header("Location: pakwis.php");
        exit;
    } else {
        // Jika terjadi kesalahan saat menghapus data
        echo "Terjadi kesalahan saat menghapus data.";
    }
} else {
    // Jika ID tidak ada, arahkan ke halaman modifikasi pesanan
    header("Location: pakwis.php");
    exit;
}
?>
