-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Sep 2024 pada 05.41
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pilarapp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_satuan` varchar(1000) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` varchar(1000) GENERATED ALWAYS AS (`harga_satuan` * `qty`) STORED,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `tanggal`, `nama_barang`, `harga_satuan`, `qty`, `deskripsi`) VALUES
(2, '2024-09-01', 'Jenset', '12000', 2, 'ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `paket_wifi` varchar(50) NOT NULL,
  `tanggal_aktivasi` date NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `no_wa`, `alamat`, `paket_wifi`, `tanggal_aktivasi`, `status`) VALUES
(1, 'arga', '087877691446', 'Talun', '150mbps', '2024-09-12', 'Aktif'),
(2, 'kepin', '999988887776', 'Kota cirebon', '700mbps', '2024-09-12', 'Aktif'),
(3, 'faith', '123456789', 'Kanoman', '700mbps', '2024-09-12', 'Aktif'),
(4, 'Bapak Samsudin', '-', 'Sumursiat', '10Mbps', '2021-09-15', 'Aktif'),
(5, 'Pak R. Sumursiat', '088220427088', 'Sumursiat', '10Mbps', '2021-09-15', 'Aktif'),
(6, 'Tuari', '-', 'Samparin', '10Mbps', '2021-09-15', 'Aktif'),
(7, 'Lia', '-', 'Melangse', '10Mbps', '2021-09-15', 'Aktif'),
(8, 'Ang Esi', '089770493350', 'Kepompongan', '10Mbps', '2021-09-15', 'Aktif'),
(9, 'Pak Pendi', '085913897715', 'GSI (samparin indah)', '10Mbps', '2021-08-02', 'Aktif'),
(10, 'Ibu Efa', '-', 'Samparin', '10Mbps', '2021-09-15', 'Aktif'),
(11, 'Prass', '-', 'Samparin', '10Mbps', '2021-09-15', 'Aktif'),
(12, 'Kalinguting (Ferdy)', '-', 'Kaliatung', '10Mbps', '0000-00-00', 'Tidak Aktif'),
(13, 'Riska', '-', 'Kepompongan', '10Mbps', '2021-07-08', 'Aktif'),
(14, 'Sisi', '-', 'Samparin', '10Mbps', '0000-00-00', 'Tidak Aktif'),
(15, 'Pak Makbul', '-', 'Majasem', '10Mbps', '2021-06-09', 'Aktif'),
(16, 'Mas dian', '-', 'Bejeng', '15Mbps', '2021-08-11', 'Aktif'),
(17, 'Indah', '081321472016', 'Sumursiat', '10Mbps', '2021-08-11', 'Aktif'),
(18, 'Mas Bowo', '08112634511', 'Sumursiat', '10Mbps', '2021-08-16', 'Aktif'),
(19, 'Warung Sumursiat/Bu Tev', '089399395558', 'Sumursiat', '5Mbps', '2021-08-16', 'Aktif'),
(20, 'DKM Sumursiat', '089681679104', 'Sumursiat', '10Mbps', '2021-08-16', 'Aktif'),
(21, 'Dani', '-', 'Kepompongan', '20Mbps', '2021-07-18', 'Aktif'),
(22, 'Arman', '08236127407', 'Sumursiat', '8Mbps', '2022-03-19', 'Aktif'),
(23, 'Mawi', '-', 'Samparin', '5Mbps', '2021-08-16', 'Aktif'),
(24, 'KB Al-hidayah', '08976233229', 'Greneing', '10Mbps', '2021-06-28', 'Aktif'),
(25, 'Fazri', '-', 'Samparin', '10Mbps', '0000-00-00', 'Tidak Aktif'),
(26, 'Pak H Munandar', '-', 'Taman Kota Cipirena', '10Mbps', '0000-00-00', 'Tidak Aktif'),
(27, 'Pak Madi', '-', 'Melangse', '10Mbps', '0000-00-00', 'Tidak Aktif'),
(28, 'Tasya', '-', 'Melangse', '10Mbps', '0000-00-00', 'Tidak Aktif'),
(29, 'AAN', '-', 'Samparin', '10Mbps', '2022-03-01', 'Aktif'),
(30, 'Masjid', '085321108311', 'Sumursiat', '10Mbps', '0000-00-00', 'Aktif'),
(31, 'Mang Herman', '-', 'Samparin', '10Mbps', '2022-09-08', 'Aktif'),
(32, 'Ade', '-', 'Samparin', '11Mbps', '2022-09-08', 'Aktif'),
(33, 'Fahmi', '085353462474', 'Asik Residen', '10Mbps', '2022-10-10', 'Aktif'),
(34, 'Farhan', '-', 'Lebakngok', '10Mbps', '2022-10-18', 'Aktif'),
(35, 'Vina', '081513201825', 'Krutug', '10Mbps', '2023-06-06', 'Aktif'),
(36, 'Mang Mustofa/ibu lyus', '089396765475', 'Kepompongan', '10Mbps', '2023-04-15', 'Aktif'),
(37, 'Wahyu&Gilang', '-', 'Kaliatung', '10Mbps', '2023-05-10', 'Aktif'),
(38, 'Ibu Atin', '6289965250677', 'Sumursiat', '10Mbps', '2023-05-13', 'Aktif'),
(39, 'Ibu Novi', '087722678168', 'Kepompongan', '10Mbps', '2023-05-16', 'Aktif'),
(40, 'Farhan Asik', '085393950503', 'Asik Residen', '10Mbps', '2023-07-11', 'Aktif'),
(41, 'Bu desi', '08122183702', 'Kepompongan', '10Mbps', '2023-07-22', 'Aktif'),
(42, 'Mang Ole', '-', 'Tanjakan', '10Mbps', '2023-07-28', 'Aktif'),
(43, 'Pak Budi', '+6288-3191-2038', 'Puri Gita Kepongongan', '10Mbps', '2023-09-18', 'Aktif'),
(44, 'Siti', '-', '-', '10Mbps', '0000-00-00', 'Tidak Aktif'),
(45, 'Barepkan Sipopak', 'Voucher', 'Voucher', 'Voucher', '0000-00-00', 'Tidak Aktif'),
(46, 'Pak Marjo', '085864317555', '-', '10Mbps', '2023-10-02', 'Aktif'),
(47, 'Lilis / Dedi Kurniawan', '62-815-6405-463', 'Lebakngok', '10Mbps', '2023-12-06', 'Aktif'),
(48, 'Kusnia', '62-878-2215-4100', 'Krutug', '10Mbps', '2024-01-21', 'Aktif'),
(49, 'Mila', '62-896-2402-0600', 'Krutug', '5Mbps', '2023-03-15', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `nominal_bayar` varchar(50) DEFAULT NULL,
  `kurang_bayar` varchar(50) DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `terbilang` varchar(255) DEFAULT NULL,
  `untuk_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_tf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `pelanggan_id`, `nominal_bayar`, `kurang_bayar`, `bukti_transfer`, `terbilang`, `untuk_pembayaran`, `tanggal_pembayaran`, `bukti_tf`) VALUES
(4, 3, '120.00', '80.00', NULL, 'SERATUS DUA PULUH RIBU', 'Wifi', '2024-08-01 00:00:00', 'Kwitansi.png'),
(6, 2, '120.000', '80.000', NULL, 'SERATUS DUA PULUH RIBU', 'Wifi', '2024-08-21', 'Kwitansi.png'),
(7, 1, '300.000', '20.000', NULL, 'TIGA RATUS RIBU', 'Susu', '2024-09-02', 'Kwitansi.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','manajemen','teknisi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'manajemen', '7839a6a91b6a99d4c29852a0beaa18c8', 'manajemen'),
(3, 'teknisi', '968804b0281d865a7fc03a3cfb15933f', 'teknisi'),
(4, 'kevin', '1234', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
