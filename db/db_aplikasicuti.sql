-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2017 at 04:11 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simpeg`
--

-- --------------------------------------------------------

--
-- Table structure for table `dt_pengajuan_cuti`
--

CREATE TABLE `dt_pengajuan_cuti` (
  `no_pengajuan` varchar(50) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `cuti` varchar(50) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `approval` int(11) NOT NULL,
  `validasi` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dt_pengajuan_cuti`
--

INSERT INTO `dt_pengajuan_cuti` (`no_pengajuan`, `nik`, `departemen`, `cuti`, `tgl_awal`, `tgl_akhir`, `jumlah`, `tgl_pengajuan`, `approval`, `validasi`, `keterangan`) VALUES
('ISC.04.16.11.001', '38040.01.10.01.15', 'D.01.16.11.001', 'JC.03.16.11.001', '2015-12-05', '2015-12-07', 3, '2015-11-28', 2, 0, 'Urusan Keluarga'),
('ISC.04.16.11.002', '16840.09.21.01.16', 'D.01.16.11.001', 'JC.03.16.11.001', '2016-12-14', '2016-12-16', 3, '2016-11-28', 1, 1, 'Urusan Keluarga'),
('ISC.04.16.12.001', '38040.01.10.01.15', 'D.01.16.11.001', 'JC.03.16.11.001', '2016-12-20', '2016-12-23', 3, '2016-12-13', 1, 0, 'Urusan Keluarga');

-- --------------------------------------------------------

--
-- Table structure for table `ms_cuti`
--

CREATE TABLE `ms_cuti` (
  `kode_cuti` varchar(50) NOT NULL,
  `nm_cuti` text NOT NULL,
  `jumlah_max` int(11) NOT NULL,
  `grup` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_cuti`
--

INSERT INTO `ms_cuti` (`kode_cuti`, `nm_cuti`, `jumlah_max`, `grup`, `status`) VALUES
('JC.03.16.11.001', 'Tahunan', 12, 0, 1),
('JC.03.16.11.002', 'Menikah', 3, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_departemen`
--

CREATE TABLE `ms_departemen` (
  `kode_dptm` varchar(50) NOT NULL,
  `nm_dptm` varchar(50) NOT NULL,
  `inisial_dptm` varchar(50) NOT NULL,
  `status_dptm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_departemen`
--

INSERT INTO `ms_departemen` (`kode_dptm`, `nm_dptm`, `inisial_dptm`, `status_dptm`) VALUES
('D.01.16.11.001', 'Direktorat', 'Direktorat', 1),
('D.01.16.11.002', 'Human Resources', 'HRD', 1),
('D.01.16.11.003', 'Information Technology', 'ITD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_jabatan`
--

CREATE TABLE `ms_jabatan` (
  `kode_jabatan` varchar(50) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `inisial_jabatan` varchar(50) NOT NULL,
  `prioritas_jabatan` int(11) NOT NULL,
  `status_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_jabatan`
--

INSERT INTO `ms_jabatan` (`kode_jabatan`, `nama_jabatan`, `inisial_jabatan`, `prioritas_jabatan`, `status_jabatan`) VALUES
('J.02.16.11.001', 'Kepala Divisi', 'Kadiv', 1, 1),
('J.02.16.11.002', 'Kepala Bagian', 'Kabag', 1, 1),
('J.02.16.11.003', 'Officer', 'Officer', 0, 1),
('J.02.16.11.004', 'Direktur', 'Direktur', 1, 1),
('J.02.16.11.005', 'Staf', 'Staf', 0, 1),
('J.02.16.11.006', 'Administrator', 'Admin', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_karyawan`
--

CREATE TABLE `ms_karyawan` (
  `nik` varchar(50) NOT NULL,
  `nm_lengkap` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(30) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `status_nikah` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `ttd` varchar(50) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status_karyawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_karyawan`
--

INSERT INTO `ms_karyawan` (`nik`, `nm_lengkap`, `alamat`, `tgl_lahir`, `tmpt_lahir`, `jenis_kelamin`, `agama`, `status_nikah`, `no_telp`, `tgl_masuk`, `email`, `password`, `foto`, `ttd`, `departemen`, `jabatan`, `status_karyawan`) VALUES
('16840.09.21.01.16', 'Budiman Sanjaya', 'Jakarta', '1990-09-21', 'Jakarta', 'pria', 'Islam', 'belum menikah', '082373338986', '2016-01-01', 'budiman@cestoria.com', 'c4ca4238a0b923820dcc509a6f75849b', '1684009210116_FOTO.png', '', 'D.01.16.11.001', 'J.02.16.11.004', 1),
('38040.01.10.01.15', 'Admin e-Employee', 'Jakarta', '1989-01-10', 'Jakarta', 'pria', 'Islam', 'belum menikah', '021-123456', '2015-01-01', 'admin@qpro.com', '21232f297a57a5a743894a0e4a801fc3', '3804001100115_FOTO.png', '3804001100115_TTD.png', 'D.01.16.11.001', 'J.02.16.11.006', 1),
('42819.07.16.06.12', 'Jikuni', 'Jl. Ampera Raya No.11, Ragunan - Pasar Minggu', '1986-07-16', 'Jakarta', 'pria', 'Islam', 'menikah', '12344556677', '2012-06-06', 'jikuni@qpro.com', 'c4ca4238a0b923820dcc509a6f75849b', '', '', 'D.01.16.11.002', 'J.02.16.11.002', 1),
('82995.10.10.11.16', 'Santi Lorena', 'Jakarta			', '1989-10-10', 'Jakarta', 'wanita', 'Islam', 'belum menikah', '082373338986', '2016-11-08', 'santi@qpro.com', '202cb962ac59075b964b07152d234b70', '8299510101116_FOTO.png', '', 'D.01.16.11.002', 'J.02.16.11.001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_posisi_karyawan`
--

CREATE TABLE `ms_posisi_karyawan` (
  `nik` varchar(50) NOT NULL,
  `kode_jabatan` varchar(50) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `atasan_1` varchar(50) NOT NULL,
  `atasan_2` varchar(50) NOT NULL,
  `tgl_kontrak` date NOT NULL,
  `no_kontrak` varchar(50) NOT NULL,
  `file_kontrak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_posisi_karyawan`
--

INSERT INTO `ms_posisi_karyawan` (`nik`, `kode_jabatan`, `departemen`, `atasan_1`, `atasan_2`, `tgl_kontrak`, `no_kontrak`, `file_kontrak`) VALUES
('16840.09.21.01.16', 'J.02.16.11.001', 'D.01.16.11.002', 'J.02.16.11.004', '', '2010-01-01', 'KT.01.01.2010.001', ''),
('38040.01.10.01.15', 'J.02.16.11.006', 'D.01.16.11.001', 'J.02.16.11.002', 'J.02.16.11.001', '2015-01-01', 'KT.01.01.2015.001', ''),
('16840.09.21.01.16', 'J.02.16.11.004', 'D.01.16.11.001', '', '', '2016-01-01', 'KT.01.01.2016.001', ''),
('42819.07.16.06.12', 'J.02.16.11.002', 'D.01.16.11.002', 'J.02.16.11.001', 'J.02.16.11.004', '2012-07-06', 'KT.01.06.2012.001', ''),
('82995.10.10.11.16', 'J.02.16.11.001', 'D.01.16.11.002', 'J.02.16.11.004', '', '2016-11-16', 'KT.01.11.2016.001', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dt_pengajuan_cuti`
--
ALTER TABLE `dt_pengajuan_cuti`
  ADD PRIMARY KEY (`no_pengajuan`);

--
-- Indexes for table `ms_cuti`
--
ALTER TABLE `ms_cuti`
  ADD PRIMARY KEY (`kode_cuti`);

--
-- Indexes for table `ms_departemen`
--
ALTER TABLE `ms_departemen`
  ADD PRIMARY KEY (`kode_dptm`);

--
-- Indexes for table `ms_jabatan`
--
ALTER TABLE `ms_jabatan`
  ADD PRIMARY KEY (`kode_jabatan`);

--
-- Indexes for table `ms_karyawan`
--
ALTER TABLE `ms_karyawan`
  ADD PRIMARY KEY (`nik`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `ms_posisi_karyawan`
--
ALTER TABLE `ms_posisi_karyawan`
  ADD PRIMARY KEY (`no_kontrak`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
