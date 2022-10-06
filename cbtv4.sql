-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2021 at 10:54 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbtv4`
--

-- --------------------------------------------------------

--
-- Table structure for table `cbt_guru`
--

DROP TABLE IF EXISTS `cbt_guru`;
CREATE TABLE `cbt_guru` (
  `guru_id` int(11) NOT NULL,
  `guru_nama` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guru_jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `guru_foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `guru_agama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `guru_username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `guru_password` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_pengaturan`
--

DROP TABLE IF EXISTS `cbt_pengaturan`;
CREATE TABLE `cbt_pengaturan` (
  `pengaturan_id` int(11) NOT NULL,
  `pengaturan_name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengaturan_value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengaturan_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cbt_pengaturan`
--

INSERT INTO `cbt_pengaturan` (`pengaturan_id`, `pengaturan_name`, `pengaturan_value`, `pengaturan_key`, `user_id`) VALUES(1, 'instansi', 'SMK NEGERI 1 CANDIPURO', '1209145', 1);
INSERT INTO `cbt_pengaturan` (`pengaturan_id`, `pengaturan_name`, `pengaturan_value`, `pengaturan_key`, `user_id`) VALUES(2, 'lock_ujian', 'y', '1209145', 1);
INSERT INTO `cbt_pengaturan` (`pengaturan_id`, `pengaturan_name`, `pengaturan_value`, `pengaturan_key`, `user_id`) VALUES(3, 'welcome_message', '', '1209145', 1);
INSERT INTO `cbt_pengaturan` (`pengaturan_id`, `pengaturan_name`, `pengaturan_value`, `pengaturan_key`, `user_id`) VALUES(4, 'jumlahruangan', '12', '', 0);
INSERT INTO `cbt_pengaturan` (`pengaturan_id`, `pengaturan_name`, `pengaturan_value`, `pengaturan_key`, `user_id`) VALUES(5, 'pengaturanToken', '{\"buka\":\"00:00:00\",\"tutup\":\"24:00:00\"}', '', 0);
INSERT INTO `cbt_pengaturan` (`pengaturan_id`, `pengaturan_name`, `pengaturan_value`, `pengaturan_key`, `user_id`) VALUES(6, 'Waktu Minimal', '10', '', 0);
INSERT INTO `cbt_pengaturan` (`pengaturan_id`, `pengaturan_name`, `pengaturan_value`, `pengaturan_key`, `user_id`) VALUES(7, 'Jurusan', '[\"Teknik Komputer dan Jaringan\",\"Teknik Kendaraan Ringan Otomotif\",\"Teknik dan \n Bisnis Sepeda Motor\",\"Akutansi Keuangan Lembaga\",\"Otomatisasi dan Tata Kelola Perkantoran\",\"Multimedia\"]', '', 0);
INSERT INTO `cbt_pengaturan` (`pengaturan_id`, `pengaturan_name`, `pengaturan_value`, `pengaturan_key`, `user_id`) VALUES(8, 'Sesi', 'UTS Ganjil', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cbt_pesan`
--

DROP TABLE IF EXISTS `cbt_pesan`;
CREATE TABLE `cbt_pesan` (
  `pesan_id` int(11) NOT NULL,
  `pesan_aksi` enum('pesan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pesan',
  `pesan_text` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan_tanggal` datetime NOT NULL,
  `pesan_untuk` enum('semua','siswa','guru') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_sekarang` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruang` int(11) NOT NULL,
  `ta` year(4) NOT NULL,
  `semester` enum('genap','ganjil') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ganjil',
  `user_id` int(11) NOT NULL,
  `pengaturan_key` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cbt_pesan`
--

INSERT INTO `cbt_pesan` (`pesan_id`, `pesan_aksi`, `pesan_text`, `pesan_tanggal`, `pesan_untuk`, `kelas_sekarang`, `jurusan_id`, `ruang`, `ta`, `semester`, `user_id`, `pengaturan_key`) VALUES(2, 'pesan', '<p>tes pesan</p>', '2021-10-07 20:49:33', 'semua', '', '', 0, 0000, 'ganjil', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `cbt_peserta`
--

DROP TABLE IF EXISTS `cbt_peserta`;
CREATE TABLE `cbt_peserta` (
  `peserta_id` int(255) NOT NULL,
  `peserta_nomor` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_ruangan` int(11) NOT NULL,
  `peserta_nis` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_nama` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_jk` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_foto` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_agama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_kelas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_jurusan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_jurusan_ke` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_last_active` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_soal`
--

DROP TABLE IF EXISTS `cbt_soal`;
CREATE TABLE `cbt_soal` (
  `soal_id` int(11) NOT NULL,
  `soal_jenis` enum('optional','essay','checked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'optional',
  `soal_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_text_deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_text_jawab` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_date` datetime NOT NULL,
  `soal_date_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `soal_pelajaran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_guru` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_untuk` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_kelas` text COLLATE utf8mb4_unicode_ci NOT NULL,  
  `soal_jurusan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_soal_jawab`
--

DROP TABLE IF EXISTS `cbt_soal_jawab`;
CREATE TABLE `cbt_soal_jawab` (
  `soal_jawab_id` int(11) NOT NULL,
  `soal_jawab_list` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_jawab_list_opsi` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_jawab_tanggal` date NOT NULL,
  `soal_jawab_mulai` datetime NOT NULL,
  `soal_jawab_selesai` datetime NOT NULL,
  `soal_jawab_waktu_minimal` int(11) NOT NULL,
  `soal_jawab_waktu` int(11) NOT NULL,
  `soal_jawab_jumlah_soal` int(11) NOT NULL,
  `soal_jawab_tampil` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_jawab_benar` int(11) NOT NULL,
  `soal_jawab_salah` int(11) NOT NULL,
  `soal_jawab_nilai` int(11) NOT NULL,
  `soal_jawab_ok` int(11) NOT NULL,
  `soal_jawab_none` int(11) NOT NULL,
  `soal_jawab_ruangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_jawab_pelajaran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_jawab_last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `soal_jawab_status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_jawab_kelas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_jawab_jurusan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_jawab_jurusan_ke` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `soal_jawab_agama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_soal_parent`
--

DROP TABLE IF EXISTS `cbt_soal_parent`;
CREATE TABLE `cbt_soal_parent` (
  `soal_parent_id` int(11) NOT NULL,
  `soal_parent_text` text NOT NULL,
  `soal_parent_pelajaran` text NOT NULL,
  `soal_parent_guru` text NOT NULL,
  `soal_parent_kelas` text NOT NULL,
  `soal_parent_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_soal_pembuat`
--

DROP TABLE IF EXISTS `cbt_soal_pembuat`;
CREATE TABLE `cbt_soal_pembuat` (
  `soal_pembuat_id` int(11) NOT NULL,
  `soal_pembuat_pelajaran` text NOT NULL,
  `soal_pembuat_guru` text NOT NULL,
  `soal_pembuat_kelas` text NOT NULL,
  `soal_pembuat_jurusan` text NOT NULL,
  `soal_pembuat_untuk` text NOT NULL,
  `soal_pembuat_jumlah` int(3) NOT NULL DEFAULT 0,
  `soal_pembuat_tanggal` date NOT NULL DEFAULT current_timestamp(),
  `soal_pembuat_tanggal_dikumpulkan` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_ta`
--

DROP TABLE IF EXISTS `cbt_ta`;
CREATE TABLE `cbt_ta` (
  `ta_id` int(11) NOT NULL,
  `ta_tahun` year(4) NOT NULL,
  `ta_semester` enum('ganjil','genap') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ganjil',
  `ta_aktif` int(1) NOT NULL DEFAULT 0,
  `pengaturan_key` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cbt_ta`
--

INSERT INTO `cbt_ta` (`ta_id`, `ta_tahun`, `ta_semester`, `ta_aktif`, `pengaturan_key`) VALUES(7, 2021, 'ganjil', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `cbt_ujian`
--

DROP TABLE IF EXISTS `cbt_ujian`;
CREATE TABLE `cbt_ujian` (
  `ujian_id` int(11) NOT NULL,
  `ujian_tanggal` date NOT NULL,
  `ujian_tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ujian_mulai` time NOT NULL,
  `ujian_waktu` int(11) NOT NULL,
  `ujian_jenis` enum('Acak','Urut') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Urut',
  `ujian_jumlah_soal` int(11) NOT NULL,
  `ujian_agama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ujian_kelas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ujian_jurusan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ujian_pelajaran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ujian_guru` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ujian_untuk` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbt_ujian_token`
--

DROP TABLE IF EXISTS `cbt_ujian_token`;
CREATE TABLE `cbt_ujian_token` (
  `ujian_token_id` int(11) NOT NULL,
  `ujian_token_text` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ujian_token_tanggal` datetime NOT NULL,
  `pengaturan_key` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cbt_ujian_token`
--

INSERT INTO `cbt_ujian_token` (`ujian_token_id`, `ujian_token_text`, `ujian_token_tanggal`, `pengaturan_key`) VALUES(1, 'P4YCGV', '2021-10-10 13:28:46', '');

-- --------------------------------------------------------

--
-- Table structure for table `cbt_users`
--

DROP TABLE IF EXISTS `cbt_users`;
CREATE TABLE `cbt_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('superadmin','admin','pengawas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_active` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cbt_users`
--

INSERT INTO `cbt_users` (`user_id`, `username`, `password`, `level`, `last_active`) VALUES(1, 'admin', '12345678', 'admin', '2021-08-16 11:41:13');
INSERT INTO `cbt_users` (`user_id`, `username`, `password`, `level`, `last_active`) VALUES(2, 'pengawas', 'p1234', 'pengawas', '2021-09-23 16:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `cbt_version`
--

DROP TABLE IF EXISTS `cbt_version`;
CREATE TABLE `cbt_version` (
  `version_id` int(11) NOT NULL,
  `version_jenis` enum('android','windows') NOT NULL DEFAULT 'android',
  `version_nama` text NOT NULL,
  `version_nomor` text NOT NULL,
  `version_tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `version_hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cbt_version`
--

INSERT INTO `cbt_version` (`version_id`, `version_jenis`, `version_nama`, `version_nomor`, `version_tanggal`, `version_hits`) VALUES(1, 'android', '4.0', '400', '2021-10-06 17:59:21', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cbt_guru`
--
ALTER TABLE `cbt_guru`
  ADD PRIMARY KEY (`guru_id`);

--
-- Indexes for table `cbt_pengaturan`
--
ALTER TABLE `cbt_pengaturan`
  ADD PRIMARY KEY (`pengaturan_id`);

--
-- Indexes for table `cbt_pesan`
--
ALTER TABLE `cbt_pesan`
  ADD PRIMARY KEY (`pesan_id`);

--
-- Indexes for table `cbt_peserta`
--
ALTER TABLE `cbt_peserta`
  ADD PRIMARY KEY (`peserta_id`);

--
-- Indexes for table `cbt_soal`
--
ALTER TABLE `cbt_soal`
  ADD PRIMARY KEY (`soal_id`);

--
-- Indexes for table `cbt_soal_jawab`
--
ALTER TABLE `cbt_soal_jawab`
  ADD PRIMARY KEY (`soal_jawab_id`);

--
-- Indexes for table `cbt_soal_parent`
--
ALTER TABLE `cbt_soal_parent`
  ADD PRIMARY KEY (`soal_parent_id`);

--
-- Indexes for table `cbt_soal_pembuat`
--
ALTER TABLE `cbt_soal_pembuat`
  ADD PRIMARY KEY (`soal_pembuat_id`);

--
-- Indexes for table `cbt_ta`
--
ALTER TABLE `cbt_ta`
  ADD PRIMARY KEY (`ta_id`);

--
-- Indexes for table `cbt_ujian`
--
ALTER TABLE `cbt_ujian`
  ADD PRIMARY KEY (`ujian_id`);

--
-- Indexes for table `cbt_ujian_token`
--
ALTER TABLE `cbt_ujian_token`
  ADD PRIMARY KEY (`ujian_token_id`);

--
-- Indexes for table `cbt_users`
--
ALTER TABLE `cbt_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cbt_version`
--
ALTER TABLE `cbt_version`
  ADD PRIMARY KEY (`version_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cbt_guru`
--
ALTER TABLE `cbt_guru`
  MODIFY `guru_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbt_pengaturan`
--
ALTER TABLE `cbt_pengaturan`
  MODIFY `pengaturan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cbt_pesan`
--
ALTER TABLE `cbt_pesan`
  MODIFY `pesan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cbt_peserta`
--
ALTER TABLE `cbt_peserta`
  MODIFY `peserta_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbt_soal`
--
ALTER TABLE `cbt_soal`
  MODIFY `soal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbt_soal_jawab`
--
ALTER TABLE `cbt_soal_jawab`
  MODIFY `soal_jawab_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbt_soal_parent`
--
ALTER TABLE `cbt_soal_parent`
  MODIFY `soal_parent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbt_soal_pembuat`
--
ALTER TABLE `cbt_soal_pembuat`
  MODIFY `soal_pembuat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbt_ta`
--
ALTER TABLE `cbt_ta`
  MODIFY `ta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cbt_ujian`
--
ALTER TABLE `cbt_ujian`
  MODIFY `ujian_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbt_ujian_token`
--
ALTER TABLE `cbt_ujian_token`
  MODIFY `ujian_token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cbt_users`
--
ALTER TABLE `cbt_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cbt_version`
--
ALTER TABLE `cbt_version`
  MODIFY `version_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
