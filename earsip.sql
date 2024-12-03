-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Agu 2024 pada 02.56
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `earsip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `id_dokumen` int(11) NOT NULL,
  `nama_dokumen` varchar(500) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `file` varchar(500) NOT NULL,
  `filesize` int(11) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `waktu_upload` timestamp NOT NULL DEFAULT current_timestamp(),
  `waktu_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenisdokumen`
--

CREATE TABLE `jenisdokumen` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenisdokumen`
--

INSERT INTO `jenisdokumen` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Teknik'),
(2, 'Administrasi'),
(3, 'Pelayanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoridokumen`
--

CREATE TABLE `kategoridokumen` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategoridokumen`
--

INSERT INTO `kategoridokumen` (`id_kategori`, `nama_kategori`) VALUES
(6, 'RAB'),
(7, 'LKP'),
(8, 'ABD'),
(9, 'Audit'),
(10, 'Permohonan Swadaya'),
(11, 'Permohonan Bantun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nip` varchar(200) NOT NULL,
  `foto` varchar(500) NOT NULL,
  `akses` enum('user','admin','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `password`, `nip`, `foto`, `akses`) VALUES
(123, 'admin', 'admin', '$2y$10$krEgImyd/27UoDB7JOLkxuCqCfUF2xLjENblNTf0OofuNPRdmowUO', '12345', 'ujicoba.jpg', 'admin'),
(348, 'user', 'user', '$2y$10$edHKnMk0hnEmi2xYcNRc.e4v1mof63Cvp2SniEL3/qnS6p8MTG7rm', '12345', '', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `id_jenis` (`id_jenis`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `jenisdokumen`
--
ALTER TABLE `jenisdokumen`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `kategoridokumen`
--
ALTER TABLE `kategoridokumen`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `jenisdokumen`
--
ALTER TABLE `jenisdokumen`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategoridokumen`
--
ALTER TABLE `kategoridokumen`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategoridokumen` (`id_kategori`),
  ADD CONSTRAINT `dokumen_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenisdokumen` (`id_jenis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
