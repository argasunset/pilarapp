-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Agu 2024 pada 13.29
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
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `paket_wifi` varchar(50) NOT NULL,
  `tanggal_aktivasi` date NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `no_wa`, `alamat`, `paket_wifi`, `tanggal_aktivasi`, `status`) VALUES
(1, 'Bapak Samsudin', '-', 'Sumursiat', '10Mbps', '2021-09-15', 'Aktif'),
(2, 'Pak Rt Sumursiat', '088220427088', 'Sumursiat', '10Mbps', '2021-09-15', 'Aktif'),
(3, 'Tuari', '-', 'Sampiran', '10Mbps', '0000-00-00', 'Aktif'),
(4, 'Lia', '-', 'Melangse', '10Mbps', '0000-00-00', 'Aktif'),
(5, 'Ang Esi', '08977049350', 'Kepompong', '10Mbps', '0000-00-00', 'Aktif'),
(6, 'pak pendi', '089513897715', 'GSI (sampiran indah)', '10Mbps', '2021-08-02', 'Aktif'),
(7, 'Ibu Efa', '-', 'Sampiran', '10Mbps', '0000-00-00', 'Aktif'),
(8, 'Prass', '-', 'Sampiran', '10Mbps', '0000-00-00', 'Aktif'),
(9, 'Kalitanjung ( Ferdy )', '-', 'Kalitanjung', '2Mbps', '0000-00-00', 'Aktif'),
(10, 'Riska', '-', 'Kalitanjung', '10Mbps', '2021-07-08', 'Aktif'),
(11, 'Sigit', '-', 'Sampiran', '10Mbps', '0000-00-00', 'Aktif'),
(12, 'Pak Makbul', '-', 'Majasem', '-', '2021-06-09', 'Aktif'),
(13, 'Mas dian', '-', 'Bojong', '15Mbps', '0000-00-00', 'Aktif'),
(14, 'Indah', '081321472016', 'Sumursiat', '10Mbps', '2021-08-11', 'Aktif'),
(15, 'Mas Bowo', '081312694511', 'Sumursiat', '10Mbps', '2021-08-16', 'Aktif'),
(16, 'Warung Sumursiat/Bu Tevi', '08999999558', 'Sumursiat', '5Mbps', '2021-08-16', 'Aktif'),
(17, 'DKM Sumutsiat', '089686179104', 'Sumursiat', '10Mbps', '2021-08-16', 'Aktif'),
(18, 'Dani', '-', 'Kepompongan', '20Mbps', '2021-07-18', 'Aktif'),
(19, 'Arman', '08231627407', 'sumursiat', '8Mbps', '2022-03-19', 'Aktif'),
(20, 'Mawi', '-', 'Sampiran', '5Mbps', '0000-00-00', 'Aktif'),
(21, 'KB Al-hidayah', '08976239229', 'Grenjeng', '10Mbps', '2021-06-28', 'Aktif'),
(22, 'Fazri', '-', 'Sampiran', '10Mbps', '0000-00-00', 'Aktif'),
(23, 'Pak H Munandar', '-', 'Taman Kota Ciperna', '10Mbps', '0000-00-00', 'Aktif'),
(24, 'Pak Madi', '-', 'Melangse', '10Mbps', '0000-00-00', 'Aktif'),
(25, 'Tasya', '-', 'Melangse', '10Mbps', '0000-00-00', 'Aktif'),
(26, 'AAN', '-', 'Sampiran', '-', '2021-03-01', 'Aktif'),
(27, 'Masjid', '085321108911', 'Sumursiat', '10Mbps', '0000-00-00', 'Aktif'),
(28, 'Mang Herman', '-', 'sampiran', '10Mbps', '2022-09-08', 'Aktif'),
(29, 'Ade', '-', 'sampiran', '11Mbps', '2022-09-08', 'Aktif'),
(30, 'Fahmi', '085353462474', 'Asix Residen', '10Mbps', '2022-10-10', 'Aktif'),
(31, 'Farhan', '-', 'Lebakngok', '10Mbps', '2022-10-18', 'Aktif'),
(32, 'Vina', '081312301825', 'Krutug', '10Mbps', '2023-06-06', 'Tidak Aktif'),
(33, 'Mang Mustofa/Ibu Iyus', '+628986765475', 'Kepongpongan', '10Mbps', '2023-04-15', 'Aktif'),
(34, 'Wahyu/Gilang', '-', 'Kalitanjung', '10Mbps', '2023-05-10', 'Aktif'),
(35, 'Ibu Atin', '+6289665250677', 'Sumursiat', '10Mbps', '2023-05-16', 'Aktif'),
(36, 'Ibu Novi', '087722678158', 'Kepongpongan', '10Mbps', '2023-05-16', 'Aktif'),
(37, 'Farhan Asix', '0895391900503', 'Asix Residen', '10Mbps', '2023-07-11', 'Aktif'),
(38, 'Bu desi', '081221837802', 'Kepongpongan', '10Mbps', '2023-07-22', 'Aktif'),
(39, 'Mang Ole', '-', 'Tanjakan', '10Mbps', '2023-07-28', 'Aktif'),
(40, 'Pak Budi', '+62 383-9191-2038', 'Puri Gita Kepongpongan', '10Mbps', '2023-09-19', 'Aktif'),
(41, 'safik', '-', '-', '-', '2023-09-27', 'Aktif'),
(42, 'Baperkam Sijopak', '-', '-', 'Voucher', '0000-00-00', 'Aktif'),
(43, 'Pak Marjo', '085864317555', 'Lebakngok', '10Mbps', '2023-10-02', 'Aktif'),
(44, 'Lilis/Dedi Kurniawan', '+62 815-6405-463', 'Lebakngok', '10Mbps', '2023-10-06', 'Aktif'),
(45, 'Kusnia', '+62 878-2214-2108', 'Krutug', '10Mbps', '2023-01-21', 'Aktif'),
(46, 'Mila', '+62 896-8402-2060', 'Krutug', '5Mbps', '2023-03-15', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `nominal_bayar` decimal(10,2) DEFAULT NULL,
  `kurang_bayar` decimal(10,2) DEFAULT NULL,
  `terbilang` varchar(255) DEFAULT NULL,
  `untuk_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `bukti_tf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `pelanggan_id`, `nominal_bayar`, `kurang_bayar`, `terbilang`, `untuk_pembayaran`, `tanggal_pembayaran`, `bukti_tf`) VALUES
(17, 1, 120.00, 80.00, 'SERATUS DUA PULUH RIBU', 'WIFI', '2024-08-08 17:44:02', 'Kwintasi.png');

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
(3, 'teknisi', '968804b0281d865a7fc03a3cfb15933f', 'teknisi');

--
-- Indexes for dumped tables
--

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
  ADD UNIQUE KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2927;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
