-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2025 at 02:40 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemesanangedungaufa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `hp_admin` varchar(15) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`, `hp_admin`, `foto`) VALUES
(1, 'Aufa Admin', 'aufaadmin', '123', '0987654321', NULL),
(2, 'Aufa Petugas', 'aufapetugas', '123', '0987654321', NULL),
(3, 'Aufa Maulidina Hanim', 'aufamaulidinahanim', '123', '0987654321', NULL),
(4, 'Aufa Admin4', 'aufaadmin', '123', '987654321', NULL),
(5, 'Aufa Admin5', 'aufaadmin', '123', '987654321', NULL),
(6, 'Aufa Admin6', 'aufaadmin', '123', '987654321', NULL),
(7, 'Aufa Admin7', 'aufaadmin', '123', '987654321', NULL),
(8, 'Aufa Admin8', 'aufaadmin', '123', '987654321', NULL),
(9, 'Aufa Admin9', 'aufaadmin', '123', '987654321', NULL),
(10, 'Aufa Admin10', 'aufaadmin', '123', '987654321', NULL),
(11, 'Aufa Admin11', 'aufaadmin', '123', '987654321', NULL),
(12, 'Aufa Admin12', 'aufaadmin', '123', '987654321', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asal`
--

CREATE TABLE `asal` (
  `id_asal` int NOT NULL,
  `nama_asal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `asal`
--

INSERT INTO `asal` (`id_asal`, `nama_asal`) VALUES
(1, 'air tenang'),
(2, 'kesehatan'),
(3, 'bundar');

-- --------------------------------------------------------

--
-- Table structure for table `detailpemesanan`
--

CREATE TABLE `detailpemesanan` (
  `id_detailpemesanan` int NOT NULL,
  `id_pemesanan` int DEFAULT NULL,
  `id_gedung` int DEFAULT NULL,
  `tanggal_sewa` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `keperluan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detailpemesanan`
--

INSERT INTO `detailpemesanan` (`id_detailpemesanan`, `id_pemesanan`, `id_gedung`, `tanggal_sewa`, `waktu_mulai`, `waktu_selesai`, `keperluan`) VALUES
(1, 1, 10, '2025-10-09', '30:35:10', '27:32:14', 'rapat'),
(2, 2, 11, '2025-10-11', '35:52:33', NULL, 'pertemuan'),
(3, 3, 12, '2025-10-12', '47:53:20', '32:53:14', 'acara maulid');

-- --------------------------------------------------------

--
-- Table structure for table `gedung`
--

CREATE TABLE `gedung` (
  `id_gedung` int NOT NULL,
  `id_kategori` int DEFAULT NULL,
  `nama_gedung` varchar(100) DEFAULT NULL,
  `kapasitas` int DEFAULT NULL,
  `harga` decimal(12,2) DEFAULT NULL,
  `fasilitas` text,
  `foto` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gedung`
--

INSERT INTO `gedung` (`id_gedung`, `id_kategori`, `nama_gedung`, `kapasitas`, `harga`, `fasilitas`, `foto`) VALUES
(10, 1, 'Gedung Serbaguna', 500, '1500000.00', 'AC, Sound System, Panggung, Kursi', ''),
(11, 2, 'Gedung Pernikahan', 300, '1200000.00', 'AC, Dekorasi, Meja, Kursi', ''),
(12, 3, 'Gedung Rapat', 200, '900000.00', 'Sound System, Lampu, Kursi', ''),
(13, 4, '', 50, '500000.00', 'kursi dan meja', '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Gedung Pernikahan'),
(2, 'Gedung Serbaguna'),
(3, 'Gedung Rapat'),
(4, 'gedung uks'),
(5, 'gedung sekolah'),
(6, 'gedung pertemuan'),
(7, ''),
(8, 'gedung hotel');

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
  `id_pemesan` int NOT NULL,
  `nama_pemesan` varchar(30) NOT NULL,
  `desa_pemesan` varchar(50) DEFAULT NULL,
  `kec_pemesan` varchar(30) DEFAULT NULL,
  `hp_pemesan` varchar(14) DEFAULT NULL,
  `id_asal` int DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`id_pemesan`, `nama_pemesan`, `desa_pemesan`, `kec_pemesan`, `hp_pemesan`, `id_asal`, `foto`) VALUES
(1, 'aufahanim', 'air tenang', 'kecamatan karang baru', '0987654321', NULL, NULL),
(2, 'rizka aulia', 'kesehatan', 'kecamatan karang baru', '0987654321', NULL, NULL),
(3, 'kasih atayya', 'bundar', 'kecamatan karang baru', '0987654321', NULL, NULL),
(4, 'aufahanim1', 'air tenang', 'kecamatan karang baru', '98765432122', NULL, NULL),
(5, 'aufahanim2', 'kesehatan', 'blangpase', '9876543213', NULL, NULL),
(6, 'aufahanim3', 'bundar', 'alurberawe', '-79012345696', NULL, NULL),
(7, 'aufahanim4', 'air tenang', 'kecamatan karang baru', '-1.67901E+11', NULL, NULL),
(8, 'aufahanim5', 'kesehatan', 'blangpase', '-2.5679E+11', NULL, NULL),
(9, 'aufahanim6', 'bundar', 'alurberawe', '-3.45679E+11', NULL, NULL),
(10, 'aufahanim7', 'air tenang', 'kecamatan karang baru', '-4.34568E+11', NULL, NULL),
(11, 'aufahanim1', 'air tenang', 'kecamatan karang baru', '98765432122', NULL, NULL),
(12, 'aufahanim2', 'kesehatan', 'blangpase', '9876543213', NULL, NULL),
(13, 'aufahanim3', 'bundar', 'alurberawe', '-79012345696', NULL, NULL),
(14, 'aufahanim4', 'air tenang', 'kecamatan karang baru', '-1.67901E+11', NULL, NULL),
(15, 'aufahanim5', 'kesehatan', 'blangpase', '-2.5679E+11', NULL, NULL),
(16, 'aufahanim6', 'bundar', 'alurberawe', '-3.45679E+11', NULL, NULL),
(17, 'aufahanim7', 'air tenang', 'kecamatan karang baru', '-4.34568E+11', NULL, NULL),
(18, 'aufa', 'air tawar', 'karang baru', '09876543211', NULL, '1761714476_2.jpg'),
(19, '', '', '', '', NULL, '1761714729_6.jpg'),
(20, 'maimunah', 'alur bemban', 'karang baru', '09876543211', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int NOT NULL,
  `id_pemesan` int DEFAULT NULL,
  `id_admin` int DEFAULT NULL,
  `tanggal_pemesanan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_pemesan`, `id_admin`, `tanggal_pemesanan`) VALUES
(1, 1, 1, '2025-10-09'),
(2, 2, 2, '2025-10-10'),
(3, 3, 3, '2025-10-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `asal`
--
ALTER TABLE `asal`
  ADD PRIMARY KEY (`id_asal`);

--
-- Indexes for table `detailpemesanan`
--
ALTER TABLE `detailpemesanan`
  ADD PRIMARY KEY (`id_detailpemesanan`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_gedung` (`id_gedung`);

--
-- Indexes for table `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id_gedung`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id_pemesan`),
  ADD KEY `fk_pemesan_asal` (`id_asal`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_pemesan` (`id_pemesan`),
  ADD KEY `id_admin` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `asal`
--
ALTER TABLE `asal`
  MODIFY `id_asal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detailpemesanan`
--
ALTER TABLE `detailpemesanan`
  MODIFY `id_detailpemesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id_gedung` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pemesan`
--
ALTER TABLE `pemesan`
  MODIFY `id_pemesan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailpemesanan`
--
ALTER TABLE `detailpemesanan`
  ADD CONSTRAINT `detailpemesanan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`),
  ADD CONSTRAINT `detailpemesanan_ibfk_2` FOREIGN KEY (`id_gedung`) REFERENCES `gedung` (`id_gedung`);

--
-- Constraints for table `gedung`
--
ALTER TABLE `gedung`
  ADD CONSTRAINT `gedung_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD CONSTRAINT `fk_pemesan_asal` FOREIGN KEY (`id_asal`) REFERENCES `asal` (`id_asal`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pemesan`) REFERENCES `pemesan` (`id_pemesan`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
