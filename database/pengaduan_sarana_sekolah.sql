-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 03 Feb 2026 pada 02.21
-- Versi server: 11.4.2-MariaDB-log
-- Versi PHP: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_sarana_sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `sarana_admin`
--

CREATE TABLE `sarana_admin` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sarana_aspirasi`
--

CREATE TABLE `sarana_aspirasi` (
  `id_aspirasi` varchar(5) NOT NULL,
  `id_pelaporan` int(5) NOT NULL,
  `status` enum('menunggu','proses','selesai') NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sarana_input_aspirasi`
--

CREATE TABLE `sarana_input_aspirasi` (
  `id_pelaporan` int(5) NOT NULL,
  `nis` int(10) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `ket` text NOT NULL,
  `tgl_input` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sarana_kategori`
--

CREATE TABLE `sarana_kategori` (
  `id_kategori` int(5) NOT NULL,
  `ket_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sarana_siswa`
--

CREATE TABLE `sarana_siswa` (
  `nis` int(10) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `sarana_admin`
--
ALTER TABLE `sarana_admin`
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `sarana_aspirasi`
--
ALTER TABLE `sarana_aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD UNIQUE KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `sarana_input_aspirasi`
--
ALTER TABLE `sarana_input_aspirasi`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `sarana_kategori`
--
ALTER TABLE `sarana_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `sarana_siswa`
--
ALTER TABLE `sarana_siswa`
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `sarana_aspirasi`
--
ALTER TABLE `sarana_aspirasi`
  ADD CONSTRAINT `sarana_aspirasi_ibfk_1` FOREIGN KEY (`id_aspirasi`) REFERENCES `sarana_admin` (`username`);

--
-- Ketidakleluasaan untuk tabel `sarana_input_aspirasi`
--
ALTER TABLE `sarana_input_aspirasi`
  ADD CONSTRAINT `sarana_input_aspirasi_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `sarana_aspirasi` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `sarana_kategori`
--
ALTER TABLE `sarana_kategori`
  ADD CONSTRAINT `sarana_kategori_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `sarana_aspirasi` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `sarana_siswa`
--
ALTER TABLE `sarana_siswa`
  ADD CONSTRAINT `sarana_siswa_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `sarana_input_aspirasi` (`nis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
