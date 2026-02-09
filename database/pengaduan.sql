-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 09, 2026 at 04:36 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `sarana_admin`
--

CREATE TABLE `sarana_admin` (
  `id_admin` int NOT NULL,
  `id_user` int NOT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sarana_admin`
--

INSERT INTO `sarana_admin` (`id_admin`, `id_user`, `nama`) VALUES
(1, 2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sarana_aspirasi`
--

CREATE TABLE `sarana_aspirasi` (
  `id_aspirasi` int NOT NULL,
  `id_pelaporan` int NOT NULL,
  `status` enum('Menunggu','Proses','Selesai') DEFAULT 'Menunggu',
  `feedback` text,
  `tanggal_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sarana_input_aspirasi`
--

CREATE TABLE `sarana_input_aspirasi` (
  `id_pelaporan` int NOT NULL,
  `nis` int NOT NULL,
  `id_kategori` int NOT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `ket` text,
  `foto` varchar(255) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sarana_kategori`
--

CREATE TABLE `sarana_kategori` (
  `id_kategori` int NOT NULL,
  `ket_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sarana_siswa`
--

CREATE TABLE `sarana_siswa` (
  `nis` int NOT NULL,
  `id_user` int NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sarana_siswa`
--

INSERT INTO `sarana_siswa` (`nis`, `id_user`, `nama`, `kelas`) VALUES
(123456, 1, 'siswa', 'xi'),
(1234567, 5, 'siswa1111', '1234567');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('siswa','admin') NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'siswa', '$2y$10$35DFDpJu0jz4ev62pJ2/EeCFazOKmsVZof14GaZsPUpeBFr.Xp6mS', 'siswa', '2026-02-04 11:32:22'),
(2, 'admin', '$2y$10$2DpNezW5gxTNs6yX7I4S8Oher3D5RNN2qmbS5DFwrdNzKBxrN7ACK', 'admin', '2026-02-04 11:38:41'),
(3, 'siswa1', '$2y$10$VeP2Nm.3his.3F0590vlmuezEFzeiN/PG6PjfzTJDV9WHjy3oDUsi', 'siswa', '2026-02-04 13:22:42'),
(5, 'siswa1111', '$2y$10$hWjQB374bpmsvXEn5oSbVumcff9/V9NBs53OWUJQy1RrqWm1PKj2S', 'siswa', '2026-02-04 13:23:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sarana_admin`
--
ALTER TABLE `sarana_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `sarana_aspirasi`
--
ALTER TABLE `sarana_aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD KEY `id_pelaporan` (`id_pelaporan`);

--
-- Indexes for table `sarana_input_aspirasi`
--
ALTER TABLE `sarana_input_aspirasi`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `sarana_kategori`
--
ALTER TABLE `sarana_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `sarana_siswa`
--
ALTER TABLE `sarana_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sarana_admin`
--
ALTER TABLE `sarana_admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sarana_aspirasi`
--
ALTER TABLE `sarana_aspirasi`
  MODIFY `id_aspirasi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sarana_input_aspirasi`
--
ALTER TABLE `sarana_input_aspirasi`
  MODIFY `id_pelaporan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sarana_kategori`
--
ALTER TABLE `sarana_kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sarana_admin`
--
ALTER TABLE `sarana_admin`
  ADD CONSTRAINT `sarana_admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sarana_aspirasi`
--
ALTER TABLE `sarana_aspirasi`
  ADD CONSTRAINT `sarana_aspirasi_ibfk_1` FOREIGN KEY (`id_pelaporan`) REFERENCES `sarana_input_aspirasi` (`id_pelaporan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sarana_input_aspirasi`
--
ALTER TABLE `sarana_input_aspirasi`
  ADD CONSTRAINT `sarana_input_aspirasi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `sarana_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sarana_input_aspirasi_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `sarana_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sarana_siswa`
--
ALTER TABLE `sarana_siswa`
  ADD CONSTRAINT `sarana_siswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
