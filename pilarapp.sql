-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Agu 2024 pada 09.42
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
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `no_wa`, `alamat`, `paket_wifi`, `tanggal_aktivasi`, `status`) VALUES
(1, 'arga', '087877691446', 'Talun', '150mbps', '2024-09-12', 'Aktif'),
(2, 'kepin', '999988887776', 'Kota cirebon', '700mbps', '2024-09-12', 'Aktif'),
(3, 'faith', '123456789', 'Kanoman', '700mbps', '2024-09-12', 'Aktif'),
(4, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(5, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(6, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(7, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(8, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(9, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(10, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(11, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(12, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(13, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(14, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(15, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(16, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(17, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(18, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(19, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(20, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(21, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(22, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(23, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(24, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(25, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(26, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(27, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(28, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(29, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(30, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(31, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(32, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(33, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(34, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(35, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(36, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(37, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(38, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(39, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(40, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(41, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(42, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(43, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(44, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(45, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(46, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(47, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(48, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(49, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(50, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(51, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(52, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(53, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(54, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(55, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(56, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(57, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(58, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(59, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(60, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(61, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(62, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(63, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(64, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(65, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(66, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(67, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(68, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(69, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(70, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(71, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(72, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(73, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(74, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(75, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(76, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(77, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(78, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(79, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(80, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(81, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(82, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(83, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(84, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(85, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(86, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(87, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(88, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(89, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(90, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(91, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(92, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(93, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(94, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(95, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(96, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(97, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(98, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(99, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(100, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(101, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(102, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(103, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(104, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(105, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(106, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(107, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(108, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(109, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(110, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(111, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(112, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(113, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(114, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(115, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(116, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(117, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(118, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(119, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(120, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(121, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(122, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(123, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(124, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(125, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(126, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(127, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(128, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(129, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(130, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(131, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(132, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(133, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(134, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(135, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(136, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(137, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(138, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(139, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(140, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(141, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(142, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(143, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(144, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(145, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(146, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(147, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(148, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(149, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(150, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(151, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(152, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(153, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(154, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(155, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(156, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(157, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(158, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(159, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(160, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(161, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(162, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(163, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(164, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(165, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(166, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(167, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(168, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(169, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(170, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(171, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(172, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(173, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(174, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(175, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(176, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(177, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(178, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(179, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(180, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(181, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(182, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(183, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(184, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(185, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(186, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(187, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(188, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(189, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(190, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(191, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(192, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(193, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(194, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(195, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(196, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(197, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(198, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(199, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(200, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(201, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(202, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(203, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(204, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(205, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(206, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(207, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(208, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(209, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(210, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(211, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(212, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(213, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(214, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(215, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(216, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(217, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(218, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(219, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(220, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(221, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(222, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(223, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(224, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(225, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(226, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(227, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(228, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(229, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(230, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(231, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(232, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(233, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(234, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(235, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(236, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(237, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(238, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(239, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(240, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(241, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(242, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(243, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(244, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(245, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(246, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(247, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(248, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(249, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(250, '', '', '', '', '0000-00-00', 'Tidak Aktif'),
(251, '', '', '', '', '0000-00-00', 'Tidak Aktif');

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
(7, 1, 120.00, 80.00, 'SERATUS DUA PULUH RIBU', 'wifi', NULL, 'Kwitansi 2.png'),
(8, 2, 120.00, 80.00, 'SERATUS DUA PULUH RIBU', 'wifi', NULL, 'Screenshot (28).png'),
(9, 2, 120.00, 80.00, 'SERATUS DUA PULUH RIBU', 'Susu', NULL, 'Kwitansi 2.png'),
(10, 3, 120.00, 80.00, 'SERATUS DUA PULUH RIBU', 'Beras', NULL, 'Kwitansi 2.png'),
(11, 3, 120.00, 80.00, 'SERATUS DUA PULUH RIBU', 'Susu', NULL, '1722866007_Kwitansi 2.png'),
(12, 1, 120.00, 80.00, 'SERATUS DUA PULUH RIBU', 'Susu', NULL, '1722866136_Kwitansi 2.png'),
(13, 3, 120.00, 80.00, 'SERATUS DUA PULUH RIBU', 'mobil', NULL, '1722923536_Kwitansi 2.png'),
(14, 1, 120.00, 80.00, 'SERATUS DUA PULUH RIBU', 'arul', '2024-09-12 00:00:00', 'Kwitansi 2.png');

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
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
