-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 12, 2020 at 06:29 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digitalschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

DROP TABLE IF EXISTS `agenda`;
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `tipe` text NOT NULL COMMENT '1 untuk rapat, 2 agenda biasa',
  `waktu_mulai` datetime NOT NULL,
  `waktu_berakhir` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `title`, `tipe`, `waktu_mulai`, `waktu_berakhir`) VALUES
(1, 'Rapat Umum Bahas Kurikulum', '2', '2020-02-06 00:00:00', '2020-02-07 00:00:00'),
(3, 'Coba Tipe Dua hehe', '1', '2020-05-19 11:40:00', '2020-08-29 13:06:00'),
(7, 'Rapat Kelulusan Siswa', '1', '2020-05-30 13:53:00', '2020-05-30 14:50:00'),
(6, 'Percobaan sekian kali', '2', '2020-05-19 09:00:00', '2020-05-18 23:07:59'),
(8, 'jehdkjhs', '2', '2020-05-19 00:49:00', '2020-05-19 00:50:00'),
(9, 'xzcv', '1', '2020-05-19 00:50:00', '2020-05-19 00:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_guru`
--

DROP TABLE IF EXISTS `daftar_guru`;
CREATE TABLE IF NOT EXISTS `daftar_guru` (
  `id_guru` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_guru`
--

INSERT INTO `daftar_guru` (`id_guru`, `id_user`, `id_mapel`) VALUES
(11, 17, 2);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_mapel`
--

DROP TABLE IF EXISTS `daftar_mapel`;
CREATE TABLE IF NOT EXISTS `daftar_mapel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mapel` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_mapel`
--

INSERT INTO `daftar_mapel` (`id`, `nama_mapel`) VALUES
(1, 'Pendidikan Agama Islam'),
(2, 'Bahasa Indonesia'),
(3, 'Matematika Wajib'),
(4, 'Matematika Peminatan'),
(5, 'IPA Fisika'),
(6, 'IPA Biologi'),
(7, 'IPA KIMIA'),
(8, 'Bahasa Inggris'),
(9, 'Penjaskes'),
(10, 'Seni Rupa'),
(11, 'Seni Musik'),
(12, 'IPS Sosiologi');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_ajar`
--

DROP TABLE IF EXISTS `jadwal_ajar`;
CREATE TABLE IF NOT EXISTS `jadwal_ajar` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_lab` int(11) NOT NULL,
  `hari` text NOT NULL,
  `jam` time NOT NULL,
  `jamselesai` time NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal_ajar`
--

INSERT INTO `jadwal_ajar` (`id_jadwal`, `id_guru`, `id_kelas`, `id_lab`, `hari`, `jam`, `jamselesai`) VALUES
(27, 17, 1, 1, 'Rabu', '12:00:00', '18:00:00'),
(28, 17, 3, 2, 'Minggu', '07:00:00', '23:23:00'),
(29, 17, 3, 5, 'Senin', '10:40:00', '11:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE IF NOT EXISTS `kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`) VALUES
(1, 'X RPL 1'),
(3, 'X TKJ 5');

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

DROP TABLE IF EXISTS `lab`;
CREATE TABLE IF NOT EXISTS `lab` (
  `id_lab` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lab` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Keterangan` text NOT NULL,
  PRIMARY KEY (`id_lab`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id_lab`, `nama_lab`, `Keterangan`) VALUES
(1, 'Lab Komputer 1', 'Lab Pemrograman Java'),
(5, 'Lab Komputer 5', 'Lab untuk pemrogaman website');

-- --------------------------------------------------------

--
-- Table structure for table `log_device`
--

DROP TABLE IF EXISTS `log_device`;
CREATE TABLE IF NOT EXISTS `log_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_device` text NOT NULL,
  `jam_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status_code` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `log_device`
--

INSERT INTO `log_device` (`id`, `id_user`, `id_device`, `jam_login`, `status`, `status_code`) VALUES
(55, 17, '1', '2020-05-17 06:05:48', 'Tidak Ada Jadwal Mengajar Hari Ini', '3'),
(54, 17, '1', '2020-05-17 06:05:21', 'Berhasil Login', '1'),
(53, 17, '1', '2020-05-17 06:04:57', 'Gagal, Telat', '0'),
(52, 99999, '1', '2020-05-17 06:03:51', 'User Tidak Dikenal', '0'),
(51, 99999, '1', '2020-05-17 06:03:33', 'User Tidak Dikenal', '0'),
(50, 17, '1', '2020-05-17 06:03:11', 'Tidak Ada Jadwal Mengajar Hari Ini', '3'),
(49, 17, '1', '2020-05-17 05:51:28', 'Tidak Ada Jadwal Mengajar Hari Ini', '2'),
(48, 17, '1', '2020-05-17 05:43:52', 'Gagal, Telat', '0'),
(47, 17, '1', '2020-05-17 05:39:55', 'Berhasil Login', '1');

-- --------------------------------------------------------

--
-- Table structure for table `mapel_perkelas`
--

DROP TABLE IF EXISTS `mapel_perkelas`;
CREATE TABLE IF NOT EXISTS `mapel_perkelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mapel` text NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu_user`
--

DROP TABLE IF EXISTS `menu_user`;
CREATE TABLE IF NOT EXISTS `menu_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_user`
--

INSERT INTO `menu_user` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Guru'),
(3, 'Kelas'),
(7, 'Menu'),
(6, 'Akun');

-- --------------------------------------------------------

--
-- Table structure for table `naskah_soal`
--

DROP TABLE IF EXISTS `naskah_soal`;
CREATE TABLE IF NOT EXISTS `naskah_soal` (
  `id_soal` int(11) NOT NULL AUTO_INCREMENT,
  `tipe_soal` enum('Pilihan Ganda','Essai') NOT NULL,
  `isi_soal` text NOT NULL,
  `pilihan_ganda` json DEFAULT NULL,
  `jawaban_essay` longtext,
  `kunci_jawaban` enum('A','B','C','D','E') DEFAULT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `presensi_siswa`
--

DROP TABLE IF EXISTS `presensi_siswa`;
CREATE TABLE IF NOT EXISTS `presensi_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` text NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` int(15) NOT NULL,
  `nisn` int(35) DEFAULT NULL,
  `nama_siswa` text NOT NULL,
  `ttl` date NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `agama` text NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status_user`
--

DROP TABLE IF EXISTS `status_user`;
CREATE TABLE IF NOT EXISTS `status_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_user`
--

INSERT INTO `status_user` (`id`, `status`) VALUES
(1, 'Admin'),
(2, 'Guru'),
(3, 'TU'),
(4, 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

DROP TABLE IF EXISTS `tahun_ajaran`;
CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun`) VALUES
(1, '2020/2021');

-- --------------------------------------------------------

--
-- Table structure for table `t_kelas_siswa`
--

DROP TABLE IF EXISTS `t_kelas_siswa`;
CREATE TABLE IF NOT EXISTS `t_kelas_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelas` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_kelas_siswa`
--

INSERT INTO `t_kelas_siswa` (`id`, `id_kelas`, `id_siswa`, `id_tahun`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` text NOT NULL,
  `agama` text NOT NULL,
  `notelp` text NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` text,
  `password` varchar(256) NOT NULL,
  `status_id` int(11) NOT NULL COMMENT '1 admin; 2 guru; 3 staff/pegawai',
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `no_kartu` varchar(128) NOT NULL,
  `key_pertanyaan` text NOT NULL,
  `value_pertanyaan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `alamat`, `tanggal_lahir`, `agama`, `notelp`, `email`, `image`, `password`, `status_id`, `is_active`, `date_created`, `no_kartu`, `key_pertanyaan`, `value_pertanyaan`) VALUES
(6, 'Bayu Zangetsu', 'Karangmoncol RT 01/01 Kec Randudongkal Kab Pemalang Jawa Tengah, 52353', '1999-11-15', 'Islam', '085155102097', 'poseidonbayu14@gmail.com', 'milos.png', '$2y$10$iGnE8w5ws0S3jiS/r0j/MuGh0vRgFjqiURrR8c82QFyKOWZXhtMjq', 1, 1, 20200103, '4881116610490128', '1', 'Sugiarti prihatin'),
(17, 'Zangetsu', '', '2020-05-15', 'islam', '098765', 'guru@guru.com', 'UAP.png', '$2y$10$R.9Wf2pgSq5xnwVXcUcbbOeY181nh5CK24ybLji0OxmywDhCsb2Zm', 2, 1, 1589200815, '1298037213', '2', 'Ngumah'),
(1, 'unknown', 'ini akun dump untuk user tidak dikenal, JANGAN DIAHPUS', '-', '-', '-', '-', '-', '-', 0, 0, 0, '', '', ''),
(5, 'Percobaan 500', '', '2020-05-30', 'budha', '123131', 'soda@kue.com', 'default.png', '$2y$10$8OyG2j5u6M77.AshmplKV.wdf78eLlD3JaI0BcyeZTD1m7HoueY.C', 2, 0, 1589840681, '', '2', 'jonggol'),
(18, 'Paman Ansley', 'qwertyhgfg', '', '', '', 'dobleh@dobleh.com', '86698033_1037112666670100_7113800915580092416_n.jpg', '$2y$10$EoWhbyVI4xqnuGsy80snv..37NnId5Xr9luATxIaJxTsEn5u84Jtq', 1, 0, 0, '', '', ''),
(21, 'Nur Hanifah', '', '2020-06-08', 'islam', '1234567', 'hanifah@gmail.com', 'default.png', '$2y$10$MpA2nZ6x7YG8R7jV9RCXTO.y9dtILuxDz/d4W2ie5patDtQDEJyd6', 2, 0, 1591619943, '', '1', 'bu taco');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

DROP TABLE IF EXISTS `user_access_menu`;
CREATE TABLE IF NOT EXISTS `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `status_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(13, 2, 2),
(14, 1, 3),
(10, 3, 3),
(19, 1, 7),
(18, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_submenu`
--

DROP TABLE IF EXISTS `user_submenu`;
CREATE TABLE IF NOT EXISTS `user_submenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_submenu`
--

INSERT INTO `user_submenu` (`id`, `menu_id`, `judul`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fa-fw fas fa-chart-line', 1),
(2, 1, 'Manajemen Akun', 'admin/manajemen_akun', 'fa-fw fas fa-users', 1),
(18, 1, 'Agenda Kegiatan', 'Admin/agenda', 'fas fa-handshake', 1),
(4, 1, 'Manajemen Lab', 'Kelas', 'fa-fw fas fa-chalkboard-teacher', 1),
(5, 2, 'Manajemen Jadwal', 'guru/jadwal', 'fas fa-calendar', 1),
(6, 3, 'Manajemen Menu', 'menu', 'fa-fw fas fa-bars', 1),
(7, 3, 'Manajemen Sub Menu', 'menu/submenu', 'fa-fw fas fa-bars', 1),
(17, 1, 'Manajemen Kelas', 'Kelas/kelas_index', 'fas fa-chalkboard fa-fw', 1),
(10, 1, 'Manajemen Akses', 'admin/manajemen_akses', 'fa-fw fas fa-user-tie', 1),
(13, 1, 'Manajemen Guru', 'admin/daftar_guru', 'fas fa-user fa-fw', 1),
(14, 5, 'Siswa Per Kelas', 'Tu/siswa_kelas', 'fas fa-user fa-fw', 1),
(16, 1, 'Log Device', 'Admin/log', 'fas fa-history', 1),
(19, 2, 'Agenda', 'Guru/agenda', 'fas fa-handshake fa-solid', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
