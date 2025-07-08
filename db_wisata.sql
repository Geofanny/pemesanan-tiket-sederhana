-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Agu 2024 pada 17.35
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wisata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_orders` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `duration` int(10) NOT NULL,
  `participants` int(10) NOT NULL,
  `services` varchar(30) NOT NULL,
  `packagePrice` int(50) NOT NULL,
  `totalBill` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id_orders`, `name`, `phone`, `duration`, `participants`, `services`, `packagePrice`, `totalBill`) VALUES
(1, 'Jamal', '0872883873', 2, 100, '0', 2700000, 270000000),
(2, 'Haidar', '0198929343', 2, 100, 'Penginapan,Transportasi', 2200000, 220000000),
(3, 's', '2', 2, 2, 'Penginapan,Transportasi,Makana', 2700000, 10800000),
(4, 'w', '2', 2, 2, 'Penginapan,Transportasi,Makana', 2700000, 10800000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_wisata`
--

CREATE TABLE `paket_wisata` (
  `id` int(11) NOT NULL,
  `jenis_paket` varchar(100) NOT NULL,
  `deskripsi` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `paket_wisata` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `nama_pemesan`, `email`, `no_hp`, `paket_wisata`) VALUES
(1, 'jamal', 'yuda@gmail.com', '33', 'Paket Individu'),
(2, 'Geofanny Alfareza Pratama', 'user@gmail.com', '788', 'Paket Keluarga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `namaPemesan` varchar(50) NOT NULL,
  `noHp` varchar(20) NOT NULL,
  `namaPaket` varchar(100) NOT NULL,
  `tanggalPesan` date NOT NULL,
  `waktuPelaksanaan` varchar(15) NOT NULL,
  `pelayanan` varchar(100) NOT NULL,
  `jumlahPeserta` int(15) NOT NULL,
  `hargaPaket` int(100) NOT NULL,
  `jumlahTagihan` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `namaPemesan`, `noHp`, `namaPaket`, `tanggalPesan`, `waktuPelaksanaan`, `pelayanan`, `jumlahPeserta`, `hargaPaket`, `jumlahTagihan`) VALUES
(1, 'Haidar', '081241652623', 'Paket Serbu Safari', '2024-08-17', '2', 'penginapan,transportasi,makan', 2, 2700000, 10800000),
(2, 'Rina', '(+62) 813735363', 'Paket Besty Safari', '2024-08-17', '2', 'transportasi,makan', 1, 1700000, 3400000),
(3, 'Kokoh', '082567673673', 'Paket Keluarga Besar', '2024-08-23', '1', 'penginapan,makan', 5, 1500000, 7500000),
(4, 'Jaka', '0827673733', 'Paket Safari Adventure', '2024-08-22', '1', 'penginapan,transportasi', 2, 2200000, 4400000),
(5, 'Farhan', '081525637873', 'Paket Safari Adventure', '2024-08-17', '2', 'penginapan,transportasi,makan', 3, 2700000, 16200000),
(12, 'we', '22', 'Paket Safari Adventure', '2024-08-21', '1', 'penginapan,transportasi,makan', 50, 2700000, 87750000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`);

--
-- Indeks untuk tabel `paket_wisata`
--
ALTER TABLE `paket_wisata`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `paket_wisata`
--
ALTER TABLE `paket_wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
