-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2025 at 03:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `beasiswa`
--

CREATE TABLE `beasiswa` (
  `id_beasiswa` int(11) NOT NULL,
  `nama_beasiswa` varchar(255) DEFAULT NULL,
  `penyelenggara` varchar(255) DEFAULT NULL,
  `jenjang` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `kuota` int(11) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `syarat` text DEFAULT NULL,
  `kontak` text DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT 0,
  `status_delete` tinyint(4) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status_delete` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`, `created_at`, `updated_at`, `deleted_at`, `status_delete`) VALUES
(1, 'Superadmin', '2025-12-16 18:52:17', NULL, NULL, 0),
(2, 'Admin', '2025-12-16 20:21:47', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `id_user`, `activity`, `ip_address`, `created_at`) VALUES
(1, 14, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:50:31'),
(2, 14, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:50:35'),
(3, 1, 'Berhasil login!', '::1', '2025-12-16 18:50:59'),
(4, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:50:59'),
(5, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:51:43'),
(6, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:51:46'),
(7, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:52:21'),
(8, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:54:09'),
(9, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:54:45'),
(10, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:55:15'),
(11, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:55:54'),
(12, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:56:24'),
(13, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:56:27'),
(14, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 18:59:58'),
(15, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 20:03:33'),
(16, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 20:06:38'),
(17, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 20:08:24'),
(18, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 20:08:31'),
(19, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 20:08:52'),
(20, 1, 'Mengakses data User.', '::1', '2025-12-16 20:20:48'),
(21, 1, 'Mengedit data user Kayleee dengan ID: 1', '::1', '2025-12-16 20:21:38'),
(22, 1, 'Mengakses data User.', '::1', '2025-12-16 20:21:39'),
(23, 1, 'Mengakses data Level.', '::1', '2025-12-16 20:21:41'),
(24, 1, 'Mengakses halaman Input Level.', '::1', '2025-12-16 20:21:43'),
(25, 1, 'Menambahkan level: Admin', '::1', '2025-12-16 20:21:47'),
(26, 1, 'Mengakses data Level.', '::1', '2025-12-16 20:21:47'),
(27, 1, 'Mengakses data Log Activity.', '::1', '2025-12-16 20:21:51'),
(28, 1, 'Mengakses data Log Activity.', '::1', '2025-12-16 20:28:55'),
(29, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:29:00'),
(30, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:32:10'),
(31, 1, 'Mengakses halaman Input Level.', '::1', '2025-12-16 20:32:13'),
(32, 1, 'Mengakses halaman Input Level.', '::1', '2025-12-16 20:32:26'),
(33, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:34:36'),
(34, 1, 'Mengakses halaman Input beasiswa.', '::1', '2025-12-16 20:34:39'),
(35, 1, 'Mengakses halaman Input beasiswa.', '::1', '2025-12-16 20:35:04'),
(36, 1, 'Menambahkan beasiswa: 1213242', '::1', '2025-12-16 20:36:36'),
(37, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:36:36'),
(38, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:37:14'),
(39, 1, 'Mengakses halaman Input beasiswa.', '::1', '2025-12-16 20:37:17'),
(40, 1, 'Menambahkan beasiswa: hy', '::1', '2025-12-16 20:37:31'),
(41, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:37:31'),
(42, 1, 'Mengakses halaman Input beasiswa.', '::1', '2025-12-16 20:37:39'),
(43, 1, 'Menambahkan beasiswa: hy', '::1', '2025-12-16 20:37:58'),
(44, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:37:58'),
(45, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:40:31'),
(46, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:40:51'),
(47, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:41:05'),
(48, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:42:26'),
(49, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:42:29'),
(50, 1, 'Mengakses halaman Input beasiswa.', '::1', '2025-12-16 20:43:10'),
(51, 1, 'Mengakses halaman Input beasiswa.', '::1', '2025-12-16 20:43:33'),
(52, 1, 'Menambahkan beasiswa: svdvd', '::1', '2025-12-16 20:43:47'),
(53, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:43:47'),
(54, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:46:14'),
(55, 1, 'Mengedit data beasiswa svdvd dengan ID: 4', '::1', '2025-12-16 20:47:00'),
(56, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:47:00'),
(57, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:49:06'),
(58, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:50:51'),
(59, 1, 'Mengakses data User.', '::1', '2025-12-16 20:50:52'),
(60, 1, 'Mengakses data Level.', '::1', '2025-12-16 20:50:54'),
(61, 1, 'Mengakses data Level.', '::1', '2025-12-16 20:51:39'),
(62, 1, 'Mengakses data User.', '::1', '2025-12-16 20:51:39'),
(63, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 20:53:34'),
(64, 1, 'Mengakses halaman Settings.', '::1', '2025-12-16 20:54:56'),
(65, 1, 'Mengakses halaman Settings.', '::1', '2025-12-16 20:54:56'),
(66, 1, 'Mengubah Data Foto Web', '::1', '2025-12-16 20:55:00'),
(67, 1, 'Mengakses halaman Settings.', '::1', '2025-12-16 20:55:00'),
(68, 1, 'Mengakses halaman Settings.', '::1', '2025-12-16 20:55:01'),
(69, 1, 'Mengubah Data Foto Web', '::1', '2025-12-16 20:55:04'),
(70, 1, 'Mengakses halaman Settings.', '::1', '2025-12-16 20:55:04'),
(71, 1, 'Mengakses halaman Settings.', '::1', '2025-12-16 20:55:04'),
(72, 1, 'Mengakses halaman Profile.', '::1', '2025-12-16 20:55:06'),
(73, 1, 'Mengakses halaman Profile.', '::1', '2025-12-16 20:55:07'),
(74, 1, 'Mengubah Data Profil', '::1', '2025-12-16 20:55:10'),
(75, 1, 'Mengakses halaman Profile.', '::1', '2025-12-16 20:55:10'),
(76, 1, 'Mengakses halaman Profile.', '::1', '2025-12-16 20:55:10'),
(77, 1, 'Mengubah Data Profil', '::1', '2025-12-16 20:55:12'),
(78, 1, 'Mengakses halaman Profile.', '::1', '2025-12-16 20:55:12'),
(79, 1, 'Mengakses halaman Profile.', '::1', '2025-12-16 20:55:13'),
(80, 1, 'Berhasil login!', '::1', '2025-12-16 21:09:47'),
(81, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 21:09:47'),
(82, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 21:09:49'),
(83, 1, 'Mengakses data beasiswa.', '::1', '2025-12-16 21:10:05'),
(84, 1, 'Berhasil login!', '::1', '2025-12-16 21:13:58'),
(85, 1, 'Mengakses halaman dashboard admin.', '::1', '2025-12-16 21:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_beasiswa`
--

CREATE TABLE `pendaftaran_beasiswa` (
  `id_pendaftaran` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_beasiswa` int(11) DEFAULT NULL,
  `nis_nim` varchar(50) DEFAULT NULL,
  `sekolah_kampus` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `dokumen_ijazah` text DEFAULT NULL,
  `status` enum('Menunggu','Lolos','Ditolak') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `nama`, `foto`) VALUES
(1, 'Beasiswa', '1753932978_cfd1c6c6012e8b3982be.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `status_delete` tinyint(4) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `level`, `foto`, `status_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'kaylee', 'c4ca4238a0b923820dcc509a6f75849b', 'Kayleee', 1, '1755677664_58d5974f1ee112724995.jpg', 0, '2025-12-16 18:42:23', '2025-12-16 20:21:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD PRIMARY KEY (`id_beasiswa`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `pendaftaran_beasiswa`
--
ALTER TABLE `pendaftaran_beasiswa`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beasiswa`
--
ALTER TABLE `beasiswa`
  MODIFY `id_beasiswa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `pendaftaran_beasiswa`
--
ALTER TABLE `pendaftaran_beasiswa`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
