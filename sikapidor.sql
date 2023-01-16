-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jan 2023 pada 11.49
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikapidor`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot`
--

CREATE TABLE `bobot` (
  `kd_bobot` char(20) NOT NULL,
  `nilai_bobot` int(11) NOT NULL,
  `bobot` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bobot`
--

INSERT INTO `bobot` (`kd_bobot`, `nilai_bobot`, `bobot`, `status`) VALUES
('B001', 5, 'Sangat Cocok', 1),
('B002', 4, 'Cocok', 1),
('B003', 3, 'Cukup Cocok', 1),
('B004', 2, 'Kurang Cocok', 1),
('B005', 1, 'Sangat Tidak Cocok', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_soal_tes`
--

CREATE TABLE `nilai_soal_tes` (
  `kd_nilai` int(11) NOT NULL,
  `kd_soal` int(11) NOT NULL,
  `kd_paket` char(20) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_soal_tes`
--

INSERT INTO `nilai_soal_tes` (`kd_nilai`, `kd_soal`, `kd_paket`, `nilai`) VALUES
(1, 1, 'P001', 5),
(2, 1, 'P002', 3),
(3, 1, 'P003', 1),
(4, 2, 'P002', 5),
(5, 2, 'P003', 3),
(6, 2, 'P001', 1),
(7, 5, 'P003', 5),
(8, 5, 'P002', 3),
(9, 5, 'P001', 1),
(10, 3, 'P001', 5),
(11, 3, 'P002', 3),
(12, 3, 'P003', 1),
(13, 4, 'P002', 5),
(14, 4, 'P003', 3),
(15, 4, 'P001', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_spk`
--

CREATE TABLE `nilai_spk` (
  `kd_spk` int(11) NOT NULL,
  `kd_pelanggan` char(20) NOT NULL,
  `kd_paket` char(20) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `kd_paket` char(20) NOT NULL,
  `paket` varchar(200) NOT NULL,
  `harga` int(20) NOT NULL,
  `kru` int(20) NOT NULL,
  `harga_wo` int(20) NOT NULL,
  `dekorasi` varchar(200) NOT NULL,
  `harga_dekorasi` int(20) NOT NULL,
  `brp` varchar(200) NOT NULL,
  `harga_brp` int(20) NOT NULL,
  `catering` varchar(200) NOT NULL,
  `harga_catering` int(20) NOT NULL,
  `dokumentasi` varchar(200) NOT NULL,
  `harga_dokumentasi` int(20) NOT NULL,
  `ah` varchar(200) NOT NULL,
  `harga_ah` int(20) NOT NULL,
  `jumlah_tamu` int(20) NOT NULL,
  `jumlah_tamu2` int(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`kd_paket`, `paket`, `harga`, `kru`, `harga_wo`, `dekorasi`, `harga_dekorasi`, `brp`, `harga_brp`, `catering`, `harga_catering`, `dokumentasi`, `harga_dokumentasi`, `ah`, `harga_ah`, `jumlah_tamu`, `jumlah_tamu2`, `status`) VALUES
('P001', 'Paket Rubby', 105050000, 5, 5000000, 'Dekorasi Out Door', 50000000, 'Busana Dan Pengantin Rias', 25000000, 'Catering', 50000, 'Dokumentasi', 5000000, 'Akomodasi Dan Hiburan', 20000000, 500, 1000, 1),
('P002', 'Paket Safir', 100000000, 0, 0, 'Dekorasi Gedung', 35000000, 'Busana Dan Rias Pengantin', 20000000, 'Catering', 50000, 'Dokumentasi', 5000000, 'Akomondasi Dan Hiburan', 15000000, 300, 500, 1),
('P003', 'Paket Safir 2', 100000000, 0, 0, 'Dekorasi Gedung', 35000000, 'Busana Dan Rias Pengantin', 20000000, 'Catering', 50000, 'Dokumentasi', 5000000, 'Akomondasi Dan Hiburan', 15000000, 300, 500, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kd_pelanggan` char(20) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `no_hp` int(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `responden`
--

CREATE TABLE `responden` (
  `kd_respon` int(11) NOT NULL,
  `kd_pelanggan` char(20) NOT NULL,
  `kd_tes` char(20) NOT NULL,
  `kd_soal` int(11) NOT NULL,
  `nilai` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `responden`
--

INSERT INTO `responden` (`kd_respon`, `kd_pelanggan`, `kd_tes`, `kd_soal`, `nilai`) VALUES
(1, 'P001', 'T001', 1, '5'),
(2, 'P001', 'T001', 2, '5'),
(3, 'P001', 'T002', 3, '4'),
(4, 'P001', 'T002', 4, '3'),
(5, 'P001', 'T001', 5, '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_tes`
--

CREATE TABLE `soal_tes` (
  `kd_soal` int(11) NOT NULL,
  `kd_tes` char(20) NOT NULL,
  `soal` varchar(250) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `soal_tes`
--

INSERT INTO `soal_tes` (`kd_soal`, `kd_tes`, `soal`, `status`) VALUES
(1, 'T001', 'apakah budget melebihi di atas < Rp 150.000.000', 1),
(2, 'T001', 'apakah anda suka dekorasi dalamapakah budget rata rata Rp 150.000.000', 1),
(3, 'T002', 'Apakah anda suka dekorasi terbuka', 1),
(4, 'T002', 'Apakah anda suka dekorasi di dalam gedung', 1),
(5, 'T001', 'apakah budget kurang dari > Rp 150.000.000', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tes_minat`
--

CREATE TABLE `tes_minat` (
  `kd_tes` char(20) NOT NULL,
  `kriteria` varchar(200) NOT NULL,
  `atribut` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tes_minat`
--

INSERT INTO `tes_minat` (`kd_tes`, `kriteria`, `atribut`, `status`) VALUES
('T001', 'Budget', 'Cost', 1),
('T002', 'Dekorasi', 'Benefit', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Administrator', 'admin', 'sayakaorganizer@gmail.com', 'default.png', '$2y$10$yunSzMoO5uFDVZpBtn5La.sMmCgZ8cxVn317tqxGEsKfnrN8B2Pfi', 1, 1, 1655427300),
(17, 'Owner 1', 'owner', 'owner1@gmail.com', 'default.png', '$2y$10$yunSzMoO5uFDVZpBtn5La.sMmCgZ8cxVn317tqxGEsKfnrN8B2Pfi', 2, 1, 1673401274);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 8),
(6, 2, 2),
(7, 1, 4),
(8, 2, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_google`
--

CREATE TABLE `user_google` (
  `user_id` int(11) NOT NULL,
  `login_oauth_uid` varchar(128) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(4, 'Management'),
(8, 'ManagementUser');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Owner');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'mdi mdi-view-dashboard', 1),
(2, 2, 'My Profile', 'user', 'mdi mdi-account', 1),
(3, 2, 'Edit Profile', 'user/edit', 'mdi mdi-account-alert', 1),
(4, 3, 'Menu Management', 'menu', 'mdi mdi-folder', 1),
(5, 3, 'Sub Menu Management', 'menu/subMenu', 'mdi mdi-folder-multiple', 1),
(6, 1, 'Role', 'admin/role', 'mdi mdi-account-star', 1),
(7, 2, 'Change Password', 'user/changePassword', 'mdi mdi-account-key', 1),
(13, 8, 'Data User Admin', 'ManagementUser', 'mdi mdi-account-multiple-plus', 1),
(27, 4, 'Pelanggan', 'management', 'mdi mdi-account-multiple', 1),
(29, 4, 'Bobot', 'management/bobot', 'mdi mdi-clipboard-text', 1),
(30, 4, 'Paket Wedding', 'management/paket', 'mdi mdi-sitemap', 1),
(31, 4, 'Tes Minat', 'management/tesMinat', 'mdi mdi-clipboard-text', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`kd_bobot`);

--
-- Indeks untuk tabel `nilai_soal_tes`
--
ALTER TABLE `nilai_soal_tes`
  ADD PRIMARY KEY (`kd_nilai`);

--
-- Indeks untuk tabel `nilai_spk`
--
ALTER TABLE `nilai_spk`
  ADD PRIMARY KEY (`kd_spk`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`kd_paket`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kd_pelanggan`);

--
-- Indeks untuk tabel `responden`
--
ALTER TABLE `responden`
  ADD PRIMARY KEY (`kd_respon`);

--
-- Indeks untuk tabel `soal_tes`
--
ALTER TABLE `soal_tes`
  ADD PRIMARY KEY (`kd_soal`);

--
-- Indeks untuk tabel `tes_minat`
--
ALTER TABLE `tes_minat`
  ADD PRIMARY KEY (`kd_tes`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `user_google`
--
ALTER TABLE `user_google`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `nilai_soal_tes`
--
ALTER TABLE `nilai_soal_tes`
  MODIFY `kd_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `nilai_spk`
--
ALTER TABLE `nilai_spk`
  MODIFY `kd_spk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `responden`
--
ALTER TABLE `responden`
  MODIFY `kd_respon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `soal_tes`
--
ALTER TABLE `soal_tes`
  MODIFY `kd_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_google`
--
ALTER TABLE `user_google`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
