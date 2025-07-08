
# Destinasi Wisata

## Deskripsi Proyek
Proyek ini adalah sebuah aplikasi web untuk pemesanan paket wisata yang dibangun menggunakan PHP, HTML, CSS, dan JavaScript. Aplikasi ini memungkinkan pengguna untuk melihat paket wisata yang tersedia, melakukan pemesanan, dan melihat bukti pendaftaran.

## Struktur Direktori

- **`bukti.php`**: Halaman untuk menampilkan bukti pendaftaran.
- **`db_wisata.sql`**: File SQL untuk membuat database dan tabel yang diperlukan oleh aplikasi.
- **`edit.php`**: Halaman untuk mengedit data yang ada.
- **`hapus.php`**: Halaman untuk menghapus data.
- **`index.php`**: Halaman utama aplikasi.
- **`koneksi.php`**: File untuk mengatur koneksi ke database.
- **`pakwis.php`**: Halaman utama yang menampilkan paket wisata.
- **`pemesanan.php`**: Halaman untuk melakukan pemesanan paket wisata.
- **`struk.php`**: Halaman untuk menampilkan struk pemesanan.
- **`tentang.php`**: Halaman yang menjelaskan tentang aplikasi atau perusahaan.
- **`pdf.php`**: Halaman untuk menghasilkan PDF dari struk atau bukti pendaftaran menggunakan library `mpdf`.

### Direktori `css`
- **`css/pakwis.css`**: Styling khusus untuk aplikasi PakWis.
- **`css/struk.css`**: Styling khusus untuk halaman struk.

### Direktori `img`
- Berisi berbagai gambar yang digunakan di berbagai halaman, termasuk gambar banner, fasilitas, foto-foto objek wisata, dan ikon.

### Direktori `js`
- **`js/hitung.js`**: File JavaScript untuk perhitungan terkait pemesanan.

### Direktori `vendor`
- Berisi dependensi PHP yang diinstal melalui Composer, termasuk `mpdf` dan `setasign/fpdi` yang digunakan untuk manipulasi PDF.

## Cara Menggunakan

1. **Database Setup**:
   - Impor file `db_wisata.sql` ke database MySQL Anda untuk membuat tabel yang diperlukan.
   - Sesuaikan pengaturan koneksi database di file `koneksi.php` sesuai dengan konfigurasi server Anda.

2. **Menjalankan Aplikasi**:
   - Pastikan server web Anda (seperti Apache) berjalan dan mendukung PHP.
   - Letakkan semua file ini di dalam direktori root server web Anda.
   - Akses aplikasi melalui browser dengan membuka `index.php`.

3. **Generasi PDF**:
   - Untuk menghasilkan PDF dari struk atau bukti pendaftaran, buka halaman `pdf.php`. Halaman ini akan menggunakan library `mpdf` untuk membuat dan menampilkan PDF.

4. **Fitur Utama**:
   - **Pemesanan Paket Wisata**: Pengguna dapat melihat detail paket wisata dan melakukan pemesanan.
   - **Bukti Pendaftaran**: Setelah pemesanan, pengguna dapat melihat dan mencetak bukti pendaftaran.
   - **Edit dan Hapus Data**: Aplikasi ini menyediakan fitur untuk mengedit dan menghapus data pemesanan.
   - **Generasi PDF**: Aplikasi ini dapat menghasilkan struk atau bukti pendaftaran dalam format PDF.

## Catatan Tambahan
- Pastikan semua gambar dan file terkait telah diunggah dan berada di direktori yang benar.

## Lisensi
Proyek ini adalah bagian dari tugas/latihan dan tidak untuk didistribusikan secara komersial.
