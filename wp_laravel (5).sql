-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2021 at 05:24 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wp_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `kode_kriteria` varchar(3) NOT NULL,
  `nama_kriteria` varchar(45) DEFAULT NULL,
  `bobot` float DEFAULT NULL,
  `atribut` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kode_kriteria`, `nama_kriteria`, `bobot`, `atribut`, `created_at`, `updated_at`) VALUES
('C01', 'Gaji Orangtua', 20, 'cost', NULL, NULL),
('C02', 'Scan SKTM', 15, 'benefit', NULL, '2021-08-01 03:08:34'),
('C03', 'Tagihan Air', 10, 'benefit', NULL, NULL),
('C04', 'Tagihan Listrik', 10, 'cost', NULL, NULL),
('C05', 'Piagam Penghargaan', 10, 'cost', NULL, '2021-07-28 11:20:44'),
('C06', 'Surat PBB', 10, 'cost', NULL, NULL),
('C07', 'Scan KK', 10, 'benefit', NULL, NULL),
('C08', 'Ijazah Terakhir', 5, 'benefit', NULL, NULL),
('C09', 'Scan Nilai Raport', 5, 'benefit', NULL, '2021-08-01 02:10:38'),
('C10', 'Foto Rumah', 5, 'benefit', NULL, '2021-08-01 00:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `nim` int(9) NOT NULL,
  `periode_id` int(9) NOT NULL,
  `nama_mahasiswa` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `prodi` varchar(30) DEFAULT NULL,
  `semester` int(1) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `rank` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`nim`, `periode_id`, `nama_mahasiswa`, `jenis_kelamin`, `prodi`, `semester`, `total`, `rank`, `created_at`, `updated_at`) VALUES
(183307048, 10, 'Aditya Khoirul', 'Laki-laki', 'Teknologi Informasi', 1, 1, 1, NULL, '2021-08-01 00:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_periode`
--

CREATE TABLE `tb_periode` (
  `id` int(2) NOT NULL,
  `nama_periode` varchar(45) DEFAULT NULL,
  `mulai` date DEFAULT NULL,
  `selesai` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_periode`
--

INSERT INTO `tb_periode` (`id`, `nama_periode`, `mulai`, `selesai`, `created_at`, `updated_at`) VALUES
(10, 'Periode tahun 2020', '2020-11-01', '2021-08-03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_range`
--

CREATE TABLE `tb_range` (
  `id` int(9) NOT NULL,
  `kode_kriteria` varchar(3) NOT NULL,
  `range` varchar(45) DEFAULT NULL,
  `nilai` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_range`
--

INSERT INTO `tb_range` (`id`, `kode_kriteria`, `range`, `nilai`) VALUES
(72, 'C01', 'Rp. 0 s/d Rp. 500.000', 1),
(73, 'C01', 'Rp. 500.001 s/d Rp. 1.000.000', 2),
(74, 'C01', 'Rp. 1.000.001 s/d Rp. 2.000.001', 3),
(75, 'C01', 'Rp. 2.000.001 s/d Rp. 3.000.000', 4),
(76, 'C01', '> Rp. 3.000.000', 5),
(77, 'C02', 'Punya', 5),
(78, 'C02', 'Tidak Punya', 1),
(79, 'C03', 'Rp. 0 s/d Rp. 30.000', 1),
(80, 'C03', 'Rp. 30.001 s/d Rp. 50.000', 2),
(81, 'C03', 'Rp. 50.001 s/d Rp. 70.000', 3),
(82, 'C03', 'Rp. 70.001 s/d Rp. 90.000', 4),
(83, 'C03', '> Rp. 90.000', 5),
(84, 'C04', 'Rp. 0 s/d Rp. 30.000', 1),
(85, 'C04', 'Rp. 30.001 s/d Rp. 50.000', 2),
(86, 'C04', 'Rp. 50.001 s/d Rp. 70.000', 3),
(87, 'C04', 'Rp. 70.001 s/d Rp. 90.000', 4),
(88, 'C04', '> Rp. 90.000', 5),
(91, 'C06', 'Rp. 0 s/d Rp. 30.000', 5),
(92, 'C06', 'Rp. 30.001 s/d Rp. 50.000', 4),
(93, 'C06', 'Rp. 50.001 s/d Rp. 70.000', 3),
(94, 'C06', 'Rp. 70.001 s/d Rp. 90.000', 2),
(95, 'C06', '> Rp. 90.000', 1),
(96, 'C05', 'Punya', 5),
(97, 'C05', 'Tidak Punya', 1),
(98, 'C07', NULL, 5),
(99, 'C08', NULL, 5),
(107, 'C10', NULL, 5),
(128, 'C09', '< 70', 1),
(129, 'C09', '> 70 s/d 80', 2),
(130, 'C09', '> 80 s/d 85', 3),
(131, 'C09', '> 85 s/d 90', 4),
(132, 'C09', '> 90 s/d 100', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rel_mahasiswa`
--

CREATE TABLE `tb_rel_mahasiswa` (
  `id` int(9) NOT NULL,
  `range_id` int(9) DEFAULT NULL,
  `nim` int(9) NOT NULL,
  `file` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_rel_mahasiswa`
--

INSERT INTO `tb_rel_mahasiswa` (`id`, `range_id`, `nim`, `file`) VALUES
(120, 74, 183307048, '1627778259138-Nefly-Alung.pdf'),
(121, 77, 183307048, '1627778259262-fix.pdf'),
(122, 81, 183307048, '1627778259464-268074883.pdf'),
(123, 86, 183307048, '1627778259665-261-649-2-PB.pdf'),
(124, 96, 183307048, '1627778259718-281-975-1-PB.pdf'),
(125, 92, 183307048, '1627778259765-261-649-2-PB.pdf'),
(126, 98, 183307048, '1627778259809-97-Article-Text-163-1-10-20180418.pdf'),
(127, 99, 183307048, '1627778259854-252-Article-Text-1189-1-10-20200727.pdf'),
(128, 130, 183307048, '1627778259854-252-Article-Text-1189-1-10-20200727.pdf'),
(129, 107, 183307048, '1627778259944-7-13-1-SM.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(4) NOT NULL,
  `nim` int(9) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `status_user` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nim`, `username`, `password`, `level`, `status_user`, `created_at`, `updated_at`) VALUES
(32, NULL, 'superadmin', '$2y$10$5KYV8mDt4oQeeGa7qDKR4.3QaoNpFXWZjYRVjm9srV4UYjq9Yr6VO', 'superadmin', 1, '2021-07-28 10:24:04', '2021-07-28 10:24:04'),
(33, NULL, 'pegawai', '$2y$10$w2ELwO3c4Zclzd5PNxYyHe0amAw976jHVHdlPiB4lFxqLLHVe52Pi', 'pegawai', 1, '2021-07-28 10:25:33', '2021-07-28 10:25:33'),
(48, 183307048, 'adit', '$2y$10$uQ/94gn9LssuadA26fC6oOI6BCDbSjbBKj4GXvr36Wrp4XQP4rnpG', 'mhs', 1, '2021-08-01 00:36:12', '2021-08-01 00:36:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `fk_tb_alternatif_tb_periode1_idx` (`periode_id`);

--
-- Indexes for table `tb_periode`
--
ALTER TABLE `tb_periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_range`
--
ALTER TABLE `tb_range`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_range_tb_kriteria1_idx` (`kode_kriteria`);

--
-- Indexes for table `tb_rel_mahasiswa`
--
ALTER TABLE `tb_rel_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_range_has_tb_mahasiswa_tb_mahasiswa1_idx` (`nim`),
  ADD KEY `fk_tb_rel_mahasiswa_tb_range1_idx` (`range_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_user_tb_alternatif1_idx` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_periode`
--
ALTER TABLE `tb_periode`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_range`
--
ALTER TABLE `tb_range`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `tb_rel_mahasiswa`
--
ALTER TABLE `tb_rel_mahasiswa`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD CONSTRAINT `fk_tb_alternatif_tb_periode1` FOREIGN KEY (`periode_id`) REFERENCES `tb_periode` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tb_range`
--
ALTER TABLE `tb_range`
  ADD CONSTRAINT `fk_tb_range_tb_kriteria1` FOREIGN KEY (`kode_kriteria`) REFERENCES `tb_kriteria` (`kode_kriteria`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tb_rel_mahasiswa`
--
ALTER TABLE `tb_rel_mahasiswa`
  ADD CONSTRAINT `fk_tb_range_has_tb_mahasiswa_tb_mahasiswa1` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_rel_mahasiswa_tb_range1` FOREIGN KEY (`range_id`) REFERENCES `tb_range` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `fk_tb_user_tb_alternatif1` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
