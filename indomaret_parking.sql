-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 27, 2022 at 04:23 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indomaret_parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloks`
--

CREATE TABLE `bloks` (
  `blok_id` bigint(20) UNSIGNED NOT NULL,
  `nama_blok` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bloks`
--

INSERT INTO `bloks` (`blok_id`, `nama_blok`, `kapasitas`, `created_at`, `updated_at`) VALUES
(1, 'Blok A', '200', '2022-06-26 18:52:14', '2022-06-26 18:52:14'),
(2, 'Blok B', '200', '2022-06-26 18:52:19', '2022-06-26 18:52:19'),
(3, 'Blok C', '200', '2022-06-26 18:52:26', '2022-06-26 18:52:26'),
(4, 'Blok D', '300', '2022-06-26 18:52:32', '2022-06-26 18:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `nik_karyawan` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_polisi` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qr_code` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengendara` tinyint(1) NOT NULL,
  `jenis_kendaraan` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `nik_karyawan`, `guest_id`, `no_polisi`, `qr_code`, `pengendara`, `jenis_kendaraan`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'F1212FDU', NULL, 2, '2', '2022-06-26 19:12:54', '2022-06-26 19:12:54'),
(2, NULL, 2, 'B3901HH', NULL, 2, '1', '2022-06-26 19:13:01', '2022-06-26 19:13:01'),
(3, NULL, 3, 'F6541RZ', NULL, 2, '2', '2022-06-26 19:14:40', '2022-06-26 19:14:40'),
(4, 2015019187, NULL, 'F3224FDX', '2015019187F3224FDX', 1, '2', '2022-06-26 19:19:06', '2022-06-26 19:19:06'),
(5, 2010221012, NULL, 'F1461OPI', '2010221012F1461OPI', 1, '2', '2022-06-26 19:20:28', '2022-06-26 19:20:28'),
(6, 2011221012, NULL, 'F1711USA', '2011221012F1711USA', 1, '2', '2022-06-26 19:21:06', '2022-06-26 19:21:06'),
(7, 2013221012, NULL, 'F1511USA', '2013221012F1511USA', 1, '2', '2022-06-26 19:21:52', '2022-06-26 19:21:52'),
(8, 2015221012, NULL, 'F1781UAU', '2015221012F1781UAU', 1, '2', '2022-06-26 19:23:18', '2022-06-26 19:23:18'),
(9, 2015451012, NULL, 'F1819FAU', '2015451012F1819FAU', 1, '2', '2022-06-26 19:24:23', '2022-06-26 19:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `nik_karyawan` bigint(20) UNSIGNED NOT NULL,
  `nama_karyawan` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departemen` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`nik_karyawan`, `nama_karyawan`, `departemen`, `created_at`, `updated_at`) VALUES
(2010221012, 'Intan Selvani', 'ADM AREA / DBM ADM', '2022-06-26 19:20:28', '2022-06-26 19:20:28'),
(2011221012, 'Haniza Reza Febriana', 'Development', '2022-06-26 19:21:06', '2022-06-26 19:21:06'),
(2013221012, 'Fuad', 'FAD', '2022-06-26 19:21:52', '2022-06-26 19:21:52'),
(2015019187, 'Muhamad Fauzian S', 'Training Center / Rekrutment', '2022-06-26 19:19:06', '2022-06-26 19:19:06'),
(2015221012, 'Anas', 'HRD', '2022-06-26 19:23:18', '2022-06-26 19:23:18'),
(2015451012, 'Yoel', 'FAD', '2022-06-26 19:24:23', '2022-06-26 19:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `faults`
--

CREATE TABLE `faults` (
  `fault_id` bigint(20) UNSIGNED NOT NULL,
  `role_pelanggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelanggaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `denda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faults`
--

INSERT INTO `faults` (`fault_id`, `role_pelanggaran`, `nama_pelanggaran`, `denda`, `created_at`, `updated_at`) VALUES
(1, '1', 'Kunci Motor Hilang', '20000', '2022-06-26 18:59:30', '2022-06-26 18:59:30'),
(2, '2', 'Tiket Parkir Hilang', '20000', '2022-06-26 18:59:38', '2022-06-26 18:59:38'),
(3, '3', 'Kunci motor hilang + Tidak membawa STNK', '25000', '2022-06-26 18:59:59', '2022-06-26 18:59:59'),
(4, '4', 'Tiket Parkir Hilang + Kunci Motor Hilang + Tidak Membawa STNK', '50000', '2022-06-26 19:00:32', '2022-06-26 19:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `tipe_pengendara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guest_id`, `tipe_pengendara`, `created_at`, `updated_at`) VALUES
(1, 'PELAMAR', '2022-06-26 19:12:54', '2022-06-26 19:12:54'),
(2, 'SUPPLIER', '2022-06-26 19:13:01', '2022-06-26 19:13:01'),
(3, 'PELAMAR', '2022-06-26 19:14:40', '2022-06-26 19:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(151, '2014_10_12_000000_create_users_table', 1),
(152, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(153, '2022_05_02_235251_create_employees_table', 1),
(154, '2022_05_02_344905_create_guests_table', 1),
(155, '2022_05_03_000712_create_drivers_table', 1),
(156, '2022_05_03_001513_create_bloks_table', 1),
(157, '2022_05_03_001638_create_faults_table', 1),
(158, '2022_05_03_004001_create_parkings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parkings`
--

CREATE TABLE `parkings` (
  `kode_parkir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `blok_id` bigint(20) UNSIGNED NOT NULL,
  `fault_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time DEFAULT NULL,
  `petugas_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parkings`
--

INSERT INTO `parkings` (`kode_parkir`, `user_id`, `driver_id`, `blok_id`, `fault_id`, `jam_masuk`, `jam_keluar`, `petugas_out`, `status`, `created_at`, `updated_at`) VALUES
('IDM27062200001', 1, 1, 4, NULL, '09:12:54', NULL, 'Belum Keluar', 'Masuk', '2022-06-26 19:12:54', '2022-06-26 19:12:54'),
('IDM27062200002', 1, 2, 4, 4, '09:13:01', '09:36:30', '1', 'Fault', '2022-06-26 19:13:01', '2022-06-26 19:36:30'),
('IDM27062200003', 1, 3, 4, NULL, '09:14:40', '09:14:48', '1', 'Keluar', '2022-06-26 19:14:40', '2022-06-26 19:14:48'),
('IDM27062200004', 1, 4, 4, NULL, '09:27:11', NULL, 'Belum Keluar', 'Masuk', '2022-06-26 19:27:11', '2022-06-26 19:27:11'),
('IDM27062200005', 1, 5, 1, 2, '09:28:07', '09:38:11', '1', 'Fault', '2022-06-26 19:28:07', '2022-06-26 19:38:11'),
('IDM27062200006', 1, 7, 3, NULL, '09:28:36', NULL, 'Belum Keluar', 'Masuk', '2022-06-26 19:28:36', '2022-06-26 19:28:36'),
('IDM27062200007', 1, 8, 2, NULL, '09:28:48', '09:37:42', '1', 'Keluar', '2022-06-26 19:28:48', '2022-06-26 19:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(1) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nik`, `nama_user`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, '2015019187', 'Ucok Bastian', 1, '$2y$10$0lG8RHTKoiGcpBq6pwUKeOVVEudDC5Hm.JY6nsaxy3IedlBaI0dZO', '2022-06-26 18:39:29', '2022-06-26 18:50:04'),
(3, '2007000211', 'Iwan Efriawan', 2, '$2y$10$fZs.jfDQW96xWK0ahU/xSeqB9xoRpMpIqCxhNVi3ZeNdDpxIoI.UW', '2022-06-26 18:49:53', '2022-06-26 18:49:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloks`
--
ALTER TABLE `bloks`
  ADD PRIMARY KEY (`blok_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `drivers_nik_karyawan_foreign` (`nik_karyawan`),
  ADD KEY `drivers_guest_id_foreign` (`guest_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`nik_karyawan`);

--
-- Indexes for table `faults`
--
ALTER TABLE `faults`
  ADD PRIMARY KEY (`fault_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parkings`
--
ALTER TABLE `parkings`
  ADD KEY `parkings_user_id_foreign` (`user_id`),
  ADD KEY `parkings_driver_id_foreign` (`driver_id`),
  ADD KEY `parkings_blok_id_foreign` (`blok_id`),
  ADD KEY `parkings_fault_id_foreign` (`fault_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bloks`
--
ALTER TABLE `bloks`
  MODIFY `blok_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `nik_karyawan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2015451013;

--
-- AUTO_INCREMENT for table `faults`
--
ALTER TABLE `faults`
  MODIFY `fault_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `drivers_nik_karyawan_foreign` FOREIGN KEY (`nik_karyawan`) REFERENCES `employees` (`nik_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parkings`
--
ALTER TABLE `parkings`
  ADD CONSTRAINT `parkings_blok_id_foreign` FOREIGN KEY (`blok_id`) REFERENCES `bloks` (`blok_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parkings_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parkings_fault_id_foreign` FOREIGN KEY (`fault_id`) REFERENCES `faults` (`fault_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parkings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
