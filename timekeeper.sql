-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Nov 2026 pada 07.53
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timekeeper`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar`
--

CREATE TABLE `daftar` (
  `id` int(11) NOT NULL,
  `kat` varchar(30) NOT NULL DEFAULT 'Cover Song',
  `jdl` varchar(255) NOT NULL DEFAULT '',
  `pen` varchar(255) NOT NULL DEFAULT '',
  `thb` varchar(255) NOT NULL DEFAULT '',
  `tv` varchar(20) NOT NULL DEFAULT '',
  `dl` varchar(20) NOT NULL DEFAULT '',
  `ty` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `daftar`
--

INSERT INTO `daftar` (`id`, `kat`, `jdl`, `pen`, `thb`, `tv`, `dl`, `ty`) VALUES
(12, 'Cover Song', 'Tresna Lintas Planet', 'Risma', 'TRESNA LINTAS PLANET Versi Cewek: Kisah Nyentana', '', '', ''),
(13, 'Cover Song', 'Berita Buruk', 'De Lonce', '', '', '', ''),
(14, 'Cover Song', 'Tresna Sing Harus Ngelahang', 'Jody', '', '', '', ''),
(15, 'Cover Song', 'Ngerupuk Sube Paek', '', '', '', '', ''),
(16, 'Cover Song', 'Timpal Ngamah Timpal', '', '', '', '', ''),
(17, 'New Song', 'Kong X Kong', '', '', '', '', ''),
(18, 'New Song', 'Nu Happy', '', '', '', '', ''),
(19, 'New Song', 'Move On', '', '', '', '', ''),
(20, 'New Song', 'Separo Angkihan', '', '', '', '', ''),
(21, 'New Song', 'Cening', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `cj` varchar(255) NOT NULL DEFAULT '',
  `cp` varchar(255) NOT NULL DEFAULT '',
  `nj` varchar(255) NOT NULL DEFAULT '',
  `np` varchar(255) NOT NULL DEFAULT '',
  `pj` varchar(255) NOT NULL DEFAULT '',
  `pt` varchar(255) NOT NULL DEFAULT '',
  `kj` varchar(255) NOT NULL DEFAULT '',
  `kp` varchar(255) NOT NULL DEFAULT '',
  `tv` varchar(255) NOT NULL DEFAULT '',
  `dl` varchar(255) NOT NULL DEFAULT '',
  `ty` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daftar`
--
ALTER TABLE `daftar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `daftar`
--
ALTER TABLE `daftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
