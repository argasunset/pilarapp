-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 10:45 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_satuan` varchar(1000) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` varchar(1000) GENERATED ALWAYS AS (`harga_satuan` * `qty`) STORED,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangiringiring`
--

CREATE TABLE `barangiringiring` (
  `id_iringiring` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_satuan` varchar(1000) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` varchar(1000) GENERATED ALWAYS AS (`harga_satuan` * `qty`) STORED,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangkaligandu`
--

CREATE TABLE `barangkaligandu` (
  `id_kaligandu` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_satuan` varchar(1000) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` varchar(1000) GENERATED ALWAYS AS (`harga_satuan` * `qty`) STORED,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangkalitanjung`
--

CREATE TABLE `barangkalitanjung` (
  `id_kalitanjung` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_satuan` varchar(1000) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` varchar(1000) GENERATED ALWAYS AS (`harga_satuan` * `qty`) STORED,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `baranglebok`
--

CREATE TABLE `baranglebok` (
  `id_lebok` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_satuan` varchar(1000) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` varchar(1000) GENERATED ALWAYS AS (`harga_satuan` * `qty`) STORED,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangoneqid`
--

CREATE TABLE `barangoneqid` (
  `id_oneqid` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_satuan` varchar(1000) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` varchar(1000) GENERATED ALWAYS AS (`harga_satuan` * `qty`) STORED,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangtransformer`
--

CREATE TABLE `barangtransformer` (
  `id_transformer` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_satuan` varchar(1000) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` varchar(1000) GENERATED ALWAYS AS (`harga_satuan` * `qty`) STORED,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `eventsiringiring`
--

CREATE TABLE `eventsiringiring` (
  `id_iringiring` int(11) NOT NULL,
  `evengt_date` date NOT NULL,
  `event_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `eventskaligandu`
--

CREATE TABLE `eventskaligandu` (
  `id_kaligandu` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `eventskalitanjung`
--

CREATE TABLE `eventskalitanjung` (
  `id_kalitanjung` int(11) NOT NULL,
  `evengt_date` date NOT NULL,
  `event_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `eventslebok`
--

CREATE TABLE `eventslebok` (
  `id_lebok` int(11) NOT NULL,
  `evengt_date` date NOT NULL,
  `event_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `eventsoneqid`
--

CREATE TABLE `eventsoneqid` (
  `id_oneqid` int(11) NOT NULL,
  `evengt_date` date NOT NULL,
  `event_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `eventstransformer`
--

CREATE TABLE `eventstransformer` (
  `id_transformer` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `paket_wifi` varchar(50) NOT NULL,
  `tanggal_aktivasi` date NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
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
(45, 'Barepkan Sipopak', 'Voucher', 'Voucher', 'Voucher', '0000-00-00', 'Aktif'),
(46, 'Pak Marjo', '085864317555', '-', '10Mbps', '2023-10-02', 'Aktif'),
(47, 'Lilis / Dedi Kurniawan', '62-815-6405-463', 'Lebakngok', '10Mbps', '2023-12-06', 'Aktif'),
(48, 'Kusnia', '62-878-2215-4100', 'Krutug', '10Mbps', '2024-01-21', 'Aktif'),
(49, 'Mila', '62-896-2402-0600', 'Krutug', '5Mbps', '2023-03-15', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pelangganiringiring`
--

CREATE TABLE `pelangganiringiring` (
  `id_pelangganiringiring` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `paket_wifi` varchar(50) NOT NULL,
  `tanggal_aktivasi` date NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggankaligandu`
--

CREATE TABLE `pelanggankaligandu` (
  `id_kaligandu` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `paket_wifi` varchar(50) NOT NULL,
  `tanggal_aktivasi` date NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggankalitanjung`
--

CREATE TABLE `pelanggankalitanjung` (
  `id_pelanggankalitanjung` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `paket_wifi` varchar(50) NOT NULL,
  `tanggal_aktivasi` date NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelangganlebok`
--

CREATE TABLE `pelangganlebok` (
  `id_pelangganlebok` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `paket_wifi` varchar(50) NOT NULL,
  `tanggal_aktivasi` date NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelangganoneqid`
--

CREATE TABLE `pelangganoneqid` (
  `id_pelangganOneqid` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `paket_wifi` varchar(50) NOT NULL,
  `tanggal_aktivasi` date NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggantransformer`
--

CREATE TABLE `pelanggantransformer` (
  `id_pelangganTransformer` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `paket_wifi` varchar(50) NOT NULL,
  `tanggal_aktivasi` date NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaraniringiring`
--

CREATE TABLE `pembayaraniringiring` (
  `id_iringiring` int(11) NOT NULL,
  `id_pelangganIringIring` int(11) DEFAULT NULL,
  `nominal_bayar` varchar(50) DEFAULT NULL,
  `kurang_bayar` varchar(50) DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `terbilang` varchar(255) DEFAULT NULL,
  `untuk_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_tf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayarankaligandu`
--

CREATE TABLE `pembayarankaligandu` (
  `id_kaligandu` int(11) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `nominal_bayar` varchar(50) DEFAULT NULL,
  `kurang_bayar` varchar(50) DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `terbilang` varchar(255) DEFAULT NULL,
  `untuk_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_tf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayarankalitanjung`
--

CREATE TABLE `pembayarankalitanjung` (
  `id_kalitanjung` int(11) NOT NULL,
  `id_pelangganKalitanjung` int(11) DEFAULT NULL,
  `nominal_bayar` varchar(50) DEFAULT NULL,
  `kurang_bayar` varchar(50) DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `terbilang` varchar(255) DEFAULT NULL,
  `untuk_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_tf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaranlebok`
--

CREATE TABLE `pembayaranlebok` (
  `id_lebok` int(11) NOT NULL,
  `id_pelangganLebok` int(11) DEFAULT NULL,
  `nominal_bayar` varchar(50) DEFAULT NULL,
  `kurang_bayar` varchar(50) DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `terbilang` varchar(255) DEFAULT NULL,
  `untuk_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_tf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaranoneqid`
--

CREATE TABLE `pembayaranoneqid` (
  `id_oneqid` int(11) NOT NULL,
  `id_pelangganOneqid` int(11) DEFAULT NULL,
  `nominal_bayar` varchar(50) DEFAULT NULL,
  `kurang_bayar` varchar(50) DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `terbilang` varchar(255) DEFAULT NULL,
  `untuk_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_tf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayarantransformer`
--

CREATE TABLE `pembayarantransformer` (
  `id_transformer` int(11) NOT NULL,
  `id_pelangganTransformer` int(11) DEFAULT NULL,
  `nominal_bayar` varchar(50) DEFAULT NULL,
  `kurang_bayar` varchar(50) DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `terbilang` varchar(255) DEFAULT NULL,
  `untuk_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_tf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','manajemen','teknisi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
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
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangiringiring`
--
ALTER TABLE `barangiringiring`
  ADD PRIMARY KEY (`id_iringiring`);

--
-- Indexes for table `barangkaligandu`
--
ALTER TABLE `barangkaligandu`
  ADD PRIMARY KEY (`id_kaligandu`);

--
-- Indexes for table `barangkalitanjung`
--
ALTER TABLE `barangkalitanjung`
  ADD PRIMARY KEY (`id_kalitanjung`);

--
-- Indexes for table `baranglebok`
--
ALTER TABLE `baranglebok`
  ADD PRIMARY KEY (`id_lebok`);

--
-- Indexes for table `barangoneqid`
--
ALTER TABLE `barangoneqid`
  ADD PRIMARY KEY (`id_oneqid`);

--
-- Indexes for table `barangtransformer`
--
ALTER TABLE `barangtransformer`
  ADD PRIMARY KEY (`id_transformer`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventsiringiring`
--
ALTER TABLE `eventsiringiring`
  ADD PRIMARY KEY (`id_iringiring`);

--
-- Indexes for table `eventskaligandu`
--
ALTER TABLE `eventskaligandu`
  ADD PRIMARY KEY (`id_kaligandu`);

--
-- Indexes for table `eventskalitanjung`
--
ALTER TABLE `eventskalitanjung`
  ADD PRIMARY KEY (`id_kalitanjung`);

--
-- Indexes for table `eventslebok`
--
ALTER TABLE `eventslebok`
  ADD PRIMARY KEY (`id_lebok`);

--
-- Indexes for table `eventsoneqid`
--
ALTER TABLE `eventsoneqid`
  ADD PRIMARY KEY (`id_oneqid`);

--
-- Indexes for table `eventstransformer`
--
ALTER TABLE `eventstransformer`
  ADD PRIMARY KEY (`id_transformer`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelangganiringiring`
--
ALTER TABLE `pelangganiringiring`
  ADD PRIMARY KEY (`id_pelangganiringiring`);

--
-- Indexes for table `pelanggankaligandu`
--
ALTER TABLE `pelanggankaligandu`
  ADD PRIMARY KEY (`id_kaligandu`);

--
-- Indexes for table `pelanggankalitanjung`
--
ALTER TABLE `pelanggankalitanjung`
  ADD PRIMARY KEY (`id_pelanggankalitanjung`);

--
-- Indexes for table `pelangganlebok`
--
ALTER TABLE `pelangganlebok`
  ADD PRIMARY KEY (`id_pelangganlebok`);

--
-- Indexes for table `pelangganoneqid`
--
ALTER TABLE `pelangganoneqid`
  ADD PRIMARY KEY (`id_pelangganOneqid`);

--
-- Indexes for table `pelanggantransformer`
--
ALTER TABLE `pelanggantransformer`
  ADD PRIMARY KEY (`id_pelangganTransformer`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `pembayaraniringiring`
--
ALTER TABLE `pembayaraniringiring`
  ADD PRIMARY KEY (`id_iringiring`),
  ADD KEY `id_pelangganIringIring` (`id_pelangganIringIring`);

--
-- Indexes for table `pembayarankaligandu`
--
ALTER TABLE `pembayarankaligandu`
  ADD PRIMARY KEY (`id_kaligandu`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `pembayarankalitanjung`
--
ALTER TABLE `pembayarankalitanjung`
  ADD PRIMARY KEY (`id_kalitanjung`),
  ADD KEY `id_pelangganKalitanjung` (`id_pelangganKalitanjung`);

--
-- Indexes for table `pembayaranlebok`
--
ALTER TABLE `pembayaranlebok`
  ADD PRIMARY KEY (`id_lebok`),
  ADD KEY `id_pelangganLebok` (`id_pelangganLebok`);

--
-- Indexes for table `pembayaranoneqid`
--
ALTER TABLE `pembayaranoneqid`
  ADD PRIMARY KEY (`id_oneqid`),
  ADD KEY `id_pelangganOneqid` (`id_pelangganOneqid`);

--
-- Indexes for table `pembayarantransformer`
--
ALTER TABLE `pembayarantransformer`
  ADD PRIMARY KEY (`id_transformer`),
  ADD KEY `id_pelangganTransformer` (`id_pelangganTransformer`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barangiringiring`
--
ALTER TABLE `barangiringiring`
  MODIFY `id_iringiring` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangkaligandu`
--
ALTER TABLE `barangkaligandu`
  MODIFY `id_kaligandu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangkalitanjung`
--
ALTER TABLE `barangkalitanjung`
  MODIFY `id_kalitanjung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `baranglebok`
--
ALTER TABLE `baranglebok`
  MODIFY `id_lebok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangoneqid`
--
ALTER TABLE `barangoneqid`
  MODIFY `id_oneqid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangtransformer`
--
ALTER TABLE `barangtransformer`
  MODIFY `id_transformer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `eventsiringiring`
--
ALTER TABLE `eventsiringiring`
  MODIFY `id_iringiring` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventskaligandu`
--
ALTER TABLE `eventskaligandu`
  MODIFY `id_kaligandu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventskalitanjung`
--
ALTER TABLE `eventskalitanjung`
  MODIFY `id_kalitanjung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventslebok`
--
ALTER TABLE `eventslebok`
  MODIFY `id_lebok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventsoneqid`
--
ALTER TABLE `eventsoneqid`
  MODIFY `id_oneqid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventstransformer`
--
ALTER TABLE `eventstransformer`
  MODIFY `id_transformer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `pelangganiringiring`
--
ALTER TABLE `pelangganiringiring`
  MODIFY `id_pelangganiringiring` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggankaligandu`
--
ALTER TABLE `pelanggankaligandu`
  MODIFY `id_kaligandu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggankalitanjung`
--
ALTER TABLE `pelanggankalitanjung`
  MODIFY `id_pelanggankalitanjung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelangganlebok`
--
ALTER TABLE `pelangganlebok`
  MODIFY `id_pelangganlebok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelangganoneqid`
--
ALTER TABLE `pelangganoneqid`
  MODIFY `id_pelangganOneqid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggantransformer`
--
ALTER TABLE `pelanggantransformer`
  MODIFY `id_pelangganTransformer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pembayaraniringiring`
--
ALTER TABLE `pembayaraniringiring`
  MODIFY `id_iringiring` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayarankaligandu`
--
ALTER TABLE `pembayarankaligandu`
  MODIFY `id_kaligandu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayarankalitanjung`
--
ALTER TABLE `pembayarankalitanjung`
  MODIFY `id_kalitanjung` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaranlebok`
--
ALTER TABLE `pembayaranlebok`
  MODIFY `id_lebok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaranoneqid`
--
ALTER TABLE `pembayaranoneqid`
  MODIFY `id_oneqid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayarantransformer`
--
ALTER TABLE `pembayarantransformer`
  MODIFY `id_transformer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `pembayaraniringiring`
--
ALTER TABLE `pembayaraniringiring`
  ADD CONSTRAINT `pembayaraniringiring_ibfk_1` FOREIGN KEY (`id_pelangganIringIring`) REFERENCES `pelangganiringiring` (`id_pelangganiringiring`);

--
-- Constraints for table `pembayarankaligandu`
--
ALTER TABLE `pembayarankaligandu`
  ADD CONSTRAINT `pembayarankaligandu_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggankaligandu` (`id_kaligandu`);

--
-- Constraints for table `pembayarankalitanjung`
--
ALTER TABLE `pembayarankalitanjung`
  ADD CONSTRAINT `pembayarankalitanjung_ibfk_1` FOREIGN KEY (`id_pelangganKalitanjung`) REFERENCES `pelanggankalitanjung` (`id_pelanggankalitanjung`);

--
-- Constraints for table `pembayaranlebok`
--
ALTER TABLE `pembayaranlebok`
  ADD CONSTRAINT `pembayaranlebok_ibfk_1` FOREIGN KEY (`id_pelangganLebok`) REFERENCES `pelangganlebok` (`id_pelangganlebok`);

--
-- Constraints for table `pembayaranoneqid`
--
ALTER TABLE `pembayaranoneqid`
  ADD CONSTRAINT `pembayaranoneqid_ibfk_1` FOREIGN KEY (`id_pelangganOneqid`) REFERENCES `pelangganoneqid` (`id_pelangganOneqid`);

--
-- Constraints for table `pembayarantransformer`
--
ALTER TABLE `pembayarantransformer`
  ADD CONSTRAINT `pembayarantransformer_ibfk_1` FOREIGN KEY (`id_pelangganTransformer`) REFERENCES `pelanggantransformer` (`id_pelangganTransformer`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
