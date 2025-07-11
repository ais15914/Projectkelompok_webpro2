-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2025 at 03:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `spesialis` varchar(100) DEFAULT NULL,
  `jadwal_praktek` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `spesialis`, `jadwal_praktek`) VALUES
(1, 'dr. Siti Aminah', 'Umum ', 'Senin - Jumat 08.00-12.00'),
(2, 'dr. Budi Santoso', 'Anak', 'Selasa & Kamis 10.00-14.00'),
(3, 'dr. Susi', 'Jantung', 'Senin-Kamis 19.00-21.00'),
(4, 'dr.SShi', 'hati', 'Senin-Kamis 19.00-21.00'),
(5, 'didin', 'jantung', 'minggu 09.00 - 12.00');

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id_kunjungan` int(11) NOT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `id_dokter` int(11) DEFAULT NULL,
  `keluhan` text DEFAULT NULL,
  `tanggal_kunjungan` date DEFAULT NULL,
  `status` enum('Selesai','Belum') DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kunjungan`
--

INSERT INTO `kunjungan` (`id_kunjungan`, `id_pasien`, `id_dokter`, `keluhan`, `tanggal_kunjungan`, `status`) VALUES
(1, 1, 1, 'Demam dan batuk', '2025-06-26', 'Selesai'),
(4, 1, 2, 'gatal', '2025-12-07', 'Belum'),
(5, 1, 1, 'sakit pinggang', '2025-12-07', 'Selesai'),
(8, 1, 2, 'pusing ini', '2022-02-02', 'Belum'),
(9, 4, 1, 'sakit gak tau', '2024-02-11', 'Belum'),
(10, 5, 2, 'sakit hati bgt', '2025-08-08', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `alamat` text DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `nik`, `alamat`, `tanggal_lahir`, `jenis_kelamin`) VALUES
(1, 'Ahmad Yani', '3201123456789001', 'Jl. Merdeka No.1', '1990-05-01', 'Laki-laki'),
(2, 'adalah', '887777466646', 'mana aja', '2022-06-01', 'Perempuan'),
(4, 'led', '13477654323333', 'mgl', '2002-02-02', 'Perempuan'),
(5, 'dudu', '45678900298765', 'mgll', '2024-02-02', 'Laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `role` enum('admin','dokter','pasien') NOT NULL,
  `id_dokter` int(11) DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `password`, `nama`, `role`, `id_dokter`, `id_pasien`) VALUES
(1, NULL, 'setiya', NULL, '5c7105867f2351c9863e0882bcf220c9', 'Setiya Admin', 'admin', NULL, NULL),
(2, NULL, 'nugroho', NULL, '77f5f3e6944139e8437279a63b2817c9', 'Nugroho Operator', '', NULL, NULL),
(3, NULL, 'shi', 'shindy@gmail.com', 'c5221563adc26a897f076d874666d2cd', '', 'admin', NULL, NULL),
(4, NULL, 'ledu', 'shindy12@gmail.com', 'c5221563adc26a897f076d874666d2cd', '', '', NULL, NULL),
(5, 'Ahmad Yani', 'ahmad', 'ahmad@klinik.com', '43b39eea8ff4885aa49ec46c39a08178', 'Ahmad Yani', 'pasien', NULL, 1),
(6, 'dr. Siti Aminah', 'siti', 'siti@klinik.com', 'cab2d8232139ee4f469a920732578f71', 'dr. Siti Aminah', 'dokter', 1, NULL),
(7, 'dr. Siti Admin', 'admin', 'admin@klinik.com', '0192023a7bbd73250516f069df18b500', 'Admin Klinik', 'admin', 1, NULL),
(8, NULL, 'budi', 'budi@klinik.com', 'cab2d8232139ee4f469a920732578f71', 'dr. Budi Santoso', 'dokter', 2, NULL),
(12, 'dr. Susi', 'susi', 'susi@gmail.com', 'cab2d8232139ee4f469a920732578f71', 'dr. Susi', 'dokter', 3, NULL),
(13, 'led', 'led', 'led@gmail.com', 'be2e7893c8828ebdb057421354faf747', 'led', 'pasien', NULL, 4),
(14, 'dr.SShi', 'sldu', 'shindy@gmail.com', 'fab675aeb569ee777484ab17d5ac9044', 'dr.SShi', 'dokter', 4, NULL),
(15, 'dudu', 'dudu', 'dud@gmail.com', 'ad76ab5f59370d89120e1c231124d525', 'dudu', 'pasien', NULL, 5),
(16, '', 'dinda', 'fitryais123@gmail.com', 'a1b7b1ddfd296af4899e8ba338657e9d', '', 'pasien', NULL, NULL),
(17, 'didin', 'didin', 'didin@gmail.com', 'ec466937bff612f5d72823b703595d60', 'didin', 'dokter', 5, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_dokter` (`id_dokter`),
  ADD KEY `fk_users_pasien` (`id_pasien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD CONSTRAINT `kunjungan_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kunjungan_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
