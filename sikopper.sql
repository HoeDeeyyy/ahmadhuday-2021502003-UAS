-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2023 at 11:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikopper`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kdbuku` int(7) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `kdrak` int(7) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kdbuku`, `judul_buku`, `pengarang`, `kdrak`, `status`) VALUES
(111, 'Peta Dunia', 'Nami', 2, 'Ada');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `kdpegawai` int(7) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`kdpegawai`, `nama_pegawai`, `jabatan`) VALUES
(456, 'Irfan', 'Kepala'),
(789, 'Hamid', 'Staf');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `kdpeminjaman` int(7) NOT NULL,
  `kdpegawai` int(7) NOT NULL,
  `kdsiswa` int(7) NOT NULL,
  `kdbuku` int(7) NOT NULL,
  `tgl_peminjaman` varchar(50) NOT NULL,
  `tgl_pengembalian` varchar(50) NOT NULL,
  `ket_telat` varchar(50) NOT NULL,
  `ket_denda` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`kdpeminjaman`, `kdpegawai`, `kdsiswa`, `kdbuku`, `tgl_peminjaman`, `tgl_pengembalian`, `ket_telat`, `ket_denda`) VALUES
(90, 789, 456, 111, '21 Mei 2003', '21 Mei 2004', 'Di pinjam teman', 'sanksi 20k');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `kdrak` int(7) NOT NULL,
  `nama_rak` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`kdrak`, `nama_rak`) VALUES
(1, 'Sains'),
(2, 'Novel');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `kdsiswa` int(7) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `pendidikan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`kdsiswa`, `nama_siswa`, `kelas`, `pendidikan`) VALUES
(123, 'Ahmad', '11', 'SMA'),
(456, 'Huday', '12', 'SMA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kdbuku`),
  ADD KEY `kdrak` (`kdrak`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`kdpegawai`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`kdpeminjaman`),
  ADD KEY `kdbuku` (`kdbuku`),
  ADD KEY `kdpegawai` (`kdpegawai`),
  ADD KEY `kdsiswa` (`kdsiswa`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`kdrak`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`kdsiswa`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kdrak`) REFERENCES `rak` (`kdrak`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`kdbuku`) REFERENCES `buku` (`kdbuku`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`kdpegawai`) REFERENCES `pegawai` (`kdpegawai`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`kdsiswa`) REFERENCES `siswa` (`kdsiswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
