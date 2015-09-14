-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2012 at 07:47 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `kepegawaian_deden_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_golongan`
--

CREATE TABLE IF NOT EXISTS `mst_golongan` (
  `id_golongan` varchar(5) NOT NULL,
  `nama_golongan` varchar(20) NOT NULL,
  PRIMARY KEY  (`id_golongan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_golongan`
--

INSERT INTO `mst_golongan` (`id_golongan`, `nama_golongan`) VALUES
('1', 'IA');

-- --------------------------------------------------------

--
-- Table structure for table `mst_jabatan`
--

CREATE TABLE IF NOT EXISTS `mst_jabatan` (
  `kode_jab` char(2) collate latin1_general_ci NOT NULL,
  `nama_jabatan` varchar(50) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`kode_jab`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_jabatan`
--

INSERT INTO `mst_jabatan` (`kode_jab`, `nama_jabatan`) VALUES
('1', 'Manager'),
('2', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `mst_jamkerja`
--

CREATE TABLE IF NOT EXISTS `mst_jamkerja` (
  `kode_ship` char(2) collate latin1_general_ci NOT NULL,
  `nama_ship` varchar(50) collate latin1_general_ci default NULL,
  `jam_masuk` time default NULL,
  `jam_pulang` time default NULL,
  PRIMARY KEY  (`kode_ship`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_jamkerja`
--

INSERT INTO `mst_jamkerja` (`kode_ship`, `nama_ship`, `jam_masuk`, `jam_pulang`) VALUES
('1', 'PAGI', '08:00:00', '16:00:00'),
('2', 'SORE', '13:00:00', '20:00:00'),
('3', 'SUBUH', '24:00:00', '05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mst_karyawan`
--

CREATE TABLE IF NOT EXISTS `mst_karyawan` (
  `id` int(11) NOT NULL auto_increment,
  `nip` char(50) collate latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) collate latin1_general_ci default NULL,
  `tempat_lahir` varchar(50) collate latin1_general_ci default NULL,
  `tanggal_lahir` date default NULL,
  `jenis_kelamin` varchar(50) collate latin1_general_ci NOT NULL,
  `alamat_ktp` varchar(100) collate latin1_general_ci default NULL,
  `alamat_domisili` varchar(100) collate latin1_general_ci default NULL,
  `telp_hp` char(20) collate latin1_general_ci default NULL,
  `agama` char(15) collate latin1_general_ci default NULL,
  `pendidikan` varchar(5) collate latin1_general_ci NOT NULL,
  `status` varchar(20) collate latin1_general_ci NOT NULL,
  `alamat_email` varchar(100) collate latin1_general_ci default NULL,
  `jumlah_keluarga` tinyint(4) NOT NULL,
  `kode_jab` char(2) collate latin1_general_ci default NULL,
  `id_golongan` tinyint(4) default NULL,
  `photo` varchar(255) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `mst_karyawan`
--

INSERT INTO `mst_karyawan` (`id`, `nip`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat_ktp`, `alamat_domisili`, `telp_hp`, `agama`, `pendidikan`, `status`, `alamat_email`, `jumlah_keluarga`, `kode_jab`, `id_golongan`, `photo`) VALUES
(6, '198811-201111-0-002', 'arief', 'Cimahi', '1988-01-01', 'pria', 'Jl. Indonesia', 'Jl. Indonesia', '099388839', 'Islam', 'S1', 'Belum Kawin', 'amiew.isme@gmail.com', 0, '1', 1, 'IMG00015-20111011-2026.jpg'),
(5, '198811-201111-0-001', 'Yudi Azhar', 'Cimahi', '1988-01-01', 'pria', 'Jl. pancasila', 'Jl. pancasila', '0813445889', 'Islam', 'S1', 'Kawin', 'uddie@yahoo.com', 0, '1', 1, 'IMG00001-20111017-1944.jpg'),
(7, '201111-201112-0-003', 'Reza', 'Cimahi', '2011-01-01', 'Pria', 'Jl.Babakan Jeruk', 'ciamis', '0813445889', 'Islam', 'S1', 'Kawin', 'amiew.isme@gmail.com', 0, '2', 1, 'IMG00015-20111011-2026.jpg'),
(8, '198811-201112-0-004', 'Ayank', 'Bandung', '1988-01-01', 'Wanita', 'Jl.Babakan Jeruk', 'Jl. Babakan Jeruk', '0813445889', 'Islam', 'S1', 'Kawin', 'amiew.isme@gmail.com', 0, '1', 1, 'Hydrangeas.jpg'),
(9, '23423423423423', 'adasda', 'adas', '2012-01-01', 'Pria', 'asdas', 'adas', 'ada', 'Islam', 'S1', 'Belum Kawin', 'uddie@yahoo.com', 23, '1', 1, 'nenek.jpg'),
(10, '23432423', 'Devianti', 'Bandung', '1988-01-01', 'Wanita', 'Jl. Indonesia', 'Jl. pancasila', '0813445889', 'Islam', 'S1', 'Kawin', 'devianti_pp@yahoo.co.id', 3, '1', 1, 'Hydrangeas.jpg'),
(11, '198811-201201-1-001', 'dini', 'Kalender', '1988-01-01', 'Pria', 'Jl.Babakan Jeruk', 'Jl. Indonesia', '234324324', 'Islam', 'S1', 'Kawin', 'devianti_pp@yahoo.co.id', 2, '1', 1, 'IMG_0079.JPG'),
(12, '198742-201201-2-002', 'mira', 'Cimahi', '1987-04-02', 'Wanita', 'Jl. Indonesia', 'Jl. pancasila', '0813445889', 'Hindu', 'S1', 'Kawin', 'amiew.isme@gmail.com', 3, '1', 1, 'IMG_0083.JPG'),
(13, '19871214-201201-2-003', 'fsgfdh', 'Bandung', '1987-12-14', 'pria', 'bandung', 'bandung', '08676555557', 'Katolik', 'S1', 'Belum Kawin', 'sjshg@gmail.com', 0, '1', 1, ''),
(14, '19881020-201201-1-004', 'ricky', 'medan', '1988-10-20', 'pria', 'bandung', 'bandung', '08676555557', 'Islam', 'S1', 'Belum Kawin', 'sjshg@gmail.com', 0, '2', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kenaikan_pangkat`
--

CREATE TABLE IF NOT EXISTS `mst_kenaikan_pangkat` (
  `id` int(11) NOT NULL auto_increment,
  `nip` varchar(30) character set latin1 collate latin1_general_ci NOT NULL,
  `jabatan_lama` varchar(50) character set latin1 collate latin1_general_ci NOT NULL,
  `jabatan_baru` varchar(50) character set latin1 collate latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mst_kenaikan_pangkat`
--

INSERT INTO `mst_kenaikan_pangkat` (`id`, `nip`, `jabatan_lama`, `jabatan_baru`, `tanggal`, `keterangan`) VALUES
(3, '19881020-201201-1-004', '2', '1', '2012-09-18', '-'),
(2, '198742-201201-2-002', '1', '2', '2012-09-01', '-');

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE IF NOT EXISTS `mst_user` (
  `nama_user` char(20) collate latin1_general_ci NOT NULL,
  `kata_kunci` varchar(100) collate latin1_general_ci default NULL,
  `nama` varchar(100) collate latin1_general_ci default NULL,
  `bagian` varchar(20) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`nama_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`nama_user`, `kata_kunci`, `nama`, `bagian`) VALUES
('rafli', 'sabarudin', 'Rafli', 'HRD'),
('diah', 'diah', 'diyah tea', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_karyawan`
--

CREATE TABLE IF NOT EXISTS `mutasi_karyawan` (
  `id` int(11) NOT NULL auto_increment,
  `nip` varchar(30) character set latin1 collate latin1_general_ci NOT NULL,
  `darimana` varchar(255) NOT NULL,
  `kemana` varchar(255) NOT NULL,
  `alasan` text NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mutasi_karyawan`
--

INSERT INTO `mutasi_karyawan` (`id`, `nip`, `darimana`, `kemana`, `alasan`, `tanggal`) VALUES
(5, '19881020-201201-1-004', 'Bandung', 'jakarta', 'value=''1. orantua\r\n2. istri''\r\n3.hagsdhjasgda', '2012-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `t_absensi`
--

CREATE TABLE IF NOT EXISTS `t_absensi` (
  `kode` int(11) NOT NULL auto_increment,
  `nip` char(25) collate latin1_general_ci default NULL,
  `tanggal` date default NULL,
  `masuk` time default NULL,
  `pulang` time default NULL,
  `keterangan` varchar(100) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `t_absensi`
--

INSERT INTO `t_absensi` (`kode`, `nip`, `tanggal`, `masuk`, `pulang`, `keterangan`) VALUES
(2, '198811-201111-0-001', '2011-11-09', '18:33:39', NULL, 'telat'),
(3, '198742-201201-2-002', '2012-01-23', '11:19:26', '17:30:00', 'telat');

-- --------------------------------------------------------

--
-- Table structure for table `t_cuti`
--

CREATE TABLE IF NOT EXISTS `t_cuti` (
  `id` int(11) NOT NULL auto_increment,
  `nip` char(50) collate latin1_general_ci default NULL,
  `tanggal_awal` datetime default NULL,
  `tanggal_akhir` datetime default NULL,
  `keperluan` tinytext collate latin1_general_ci,
  `relasi_nama` varchar(100) collate latin1_general_ci default NULL,
  `relasi_telepon` char(20) collate latin1_general_ci default NULL,
  `relasi_hubungan` varchar(100) collate latin1_general_ci default NULL,
  `nip_pengganti` char(50) collate latin1_general_ci default NULL,
  `sisa` int(11) NOT NULL,
  `jenis_cuti` varchar(50) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `t_cuti`
--

INSERT INTO `t_cuti` (`id`, `nip`, `tanggal_awal`, `tanggal_akhir`, `keperluan`, `relasi_nama`, `relasi_telepon`, `relasi_hubungan`, `nip_pengganti`, `sisa`, `jenis_cuti`) VALUES
(18, '23423423423423', '2012-09-15 19:36:27', '2012-09-18 19:36:27', 'makan - makan', 'andre', '08562416610', 'Orang Tua', '198811-201111-0-001', 3, 'tahunan'),
(17, '198811-201112-0-004', '2012-03-17 12:13:59', '2012-03-20 12:13:59', 'makan - makan', 'asdas', '234324', 'Kakak', '201111-201112-0-003', 3, 'tahunan'),
(5, '23423423423423', '2012-07-01 15:41:12', '2012-07-05 15:41:12', 'asdas', 'adas', '343434', 'Paman', '198811-201201-1-001', 3, 'tahunan'),
(14, '198811-201112-0-004', '2012-06-01 16:00:23', '2012-06-05 16:00:23', 'makan - makan', 'asdas', '234324', 'Paman', '198811-201111-0-002', 4, 'tahunan'),
(15, '23432423', '2012-01-01 00:00:00', '2012-03-30 00:00:00', 'Hamil', 'asdasd', '34345', 'Paman', '198811-201112-0-004', 0, 'hamil'),
(16, '19871214-201201-2-003', '2012-01-01 00:00:00', '2012-03-30 00:00:00', 'makan - makan', 'asdasd', '343434', 'Paman', '198811-201111-0-001', 0, 'hamil'),
(19, '23423423423423', '2012-12-18 19:36:59', '2012-12-19 19:36:59', 'ada', 'andre', '08344455454', 'Kakak', '198811-201111-0-001', 1, 'tahunan');

-- --------------------------------------------------------

--
-- Table structure for table `t_ijin`
--

CREATE TABLE IF NOT EXISTS `t_ijin` (
  `id` int(11) NOT NULL auto_increment,
  `tanggal` date default NULL,
  `nip` char(30) collate latin1_general_ci default NULL,
  `ijin_untuk` varchar(100) collate latin1_general_ci default NULL,
  `sampai` time NOT NULL,
  `keperluan` varchar(100) collate latin1_general_ci default NULL,
  `relasi_nama` varchar(100) collate latin1_general_ci default NULL,
  `relasi_alamat` varchar(100) collate latin1_general_ci default NULL,
  `relasi_hubungan` varchar(100) collate latin1_general_ci default NULL,
  `relasi_telepon` varchar(100) collate latin1_general_ci default NULL,
  `jenis_ijin` varchar(50) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `t_ijin`
--

INSERT INTO `t_ijin` (`id`, `tanggal`, `nip`, `ijin_untuk`, `sampai`, `keperluan`, `relasi_nama`, `relasi_alamat`, `relasi_hubungan`, `relasi_telepon`, `jenis_ijin`) VALUES
(1, '2012-01-01', '23432423', 'adsas', '00:00:00', 'adasd', 'adas', 'adsa', 'adsas', 'asdasa', 'harian'),
(2, '2012-01-01', '201111-201112-0-003', 'adasda', '00:00:00', 'aaaa', 'asdas', 'adas', 'asdas', 'asdasa', 'ijin'),
(3, '2012-01-01', '198811-201112-0-004', 'ada', '00:00:00', 'adsasd', 'asdasd', 'xcvcxv', 'xvcxv', 'xcvcx', 'sakit'),
(4, '2012-01-01', '23423423423423', 'dgdf', '00:00:00', 'dfgdf', 'dfgdf', 'dfgdf', 'dg', 'dfgd', 'sakit'),
(7, '2012-01-07', '198742-201201-2-002', 'asdasd', '00:00:00', 'gggg', 'asdasd', 'adasd', 'Bibi', '343434', 'ijin'),
(6, '2012-01-01', '23423423423423', 'dgdf', '00:00:00', 'dfgdf', 'dfgdf', 'dfgdf', 'dg', 'dfgd', 'sakit'),
(8, '2012-10-30', '19881020-201201-1-004', 'fhdh', '00:00:00', 'keluarga', 'asdasd', 'bandung', 'Adik', '08567342424', 'sakit');
