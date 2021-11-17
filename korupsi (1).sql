-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2021 at 10:47 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `korupsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `idSession` varchar(255) NOT NULL,
  `nilaiPertanyaan` varchar(255) NOT NULL,
  `dateCreate` date NOT NULL,
  `idResponden` varchar(255) NOT NULL,
  `idPertanyaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`idSession`, `nilaiPertanyaan`, `dateCreate`, `idResponden`, `idPertanyaan`) VALUES
('sesi6064023660f5b', '2', '2021-03-31', 'resp6064023660f5c', 1),
('sesi6064023660f5b', '4', '2021-03-31', 'resp6064023660f5c', 2),
('sesi6064023660f5b', '', '2021-03-31', 'resp6064023660f5c', 3),
('sesi6064023660f5b', '4', '2021-03-31', 'resp6064023660f5c', 4),
('sesi6064023660f5b', '4', '2021-03-31', 'resp6064023660f5c', 5),
('sesi6064023660f5b', '4', '2021-03-31', 'resp6064023660f5c', 6),
('sesi6064023660f5b', '4', '2021-03-31', 'resp6064023660f5c', 7),
('sesi6064023660f5b', '4', '2021-03-31', 'resp6064023660f5c', 8),
('sesi6064023660f5b', '4', '2021-03-31', 'resp6064023660f5c', 9),
('sesi606407d757b8b', '4', '2021-03-31', 'resp606407d757b8c', 1),
('sesi606407d757b8b', '4', '2021-03-31', 'resp606407d757b8c', 2),
('sesi606407d757b8b', '4', '2021-03-31', 'resp606407d757b8c', 3),
('sesi606407d757b8b', '4', '2021-03-31', 'resp606407d757b8c', 4),
('sesi606407d757b8b', '4', '2021-03-31', 'resp606407d757b8c', 5),
('sesi606407d757b8b', '4', '2021-03-31', 'resp606407d757b8c', 6),
('sesi606407d757b8b', '4', '2021-03-31', 'resp606407d757b8c', 7),
('sesi606407d757b8b', '4', '2021-03-31', 'resp606407d757b8c', 8),
('sesi606407d757b8b', '4', '2021-03-31', 'resp606407d757b8c', 9),
('sesi60640f88ed832', '4', '2021-04-24', 'resp60640f88ed833', 1),
('sesi60640f88ed832', '4', '2021-04-24', 'resp60640f88ed833', 2),
('sesi60640f88ed832', '4', '2021-04-24', 'resp60640f88ed833', 3),
('sesi60640f88ed832', '4', '2021-04-24', 'resp60640f88ed833', 4),
('sesi60640f88ed832', '4', '2021-04-24', 'resp60640f88ed833', 5),
('sesi60640f88ed832', '4', '2021-04-24', 'resp60640f88ed833', 6),
('sesi60640f88ed832', '4', '2021-04-24', 'resp60640f88ed833', 7),
('sesi60640f88ed832', '4', '2021-04-24', 'resp60640f88ed833', 8),
('sesi60640f88ed832', '4', '2021-04-24', 'resp60640f88ed833', 9);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `idKomentar` varchar(255) NOT NULL,
  `isiKomentar` varchar(255) NOT NULL,
  `dateCreate` date NOT NULL,
  `idSession` varchar(255) NOT NULL,
  `idResponden` varchar(255) NOT NULL,
  `idPertanyaan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`idKomentar`, `isiKomentar`, `dateCreate`, `idSession`, `idResponden`, `idPertanyaan`) VALUES
('koment6064023660f5d', '', '2021-03-31', 'sesi6064023660f5b', 'resp6064023660f5c', 0),
('koment606407d757b8d', '', '2021-03-31', 'sesi606407d757b8b', 'resp606407d757b8c', 0),
('koment60640f88ed834', '', '2021-03-31', 'sesi60640f88ed832', 'resp60640f88ed833', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `idPertanyaan` varchar(255) NOT NULL,
  `namaPertanyaan` varchar(255) NOT NULL,
  `jenisPertanyaan` varchar(255) NOT NULL,
  `dateCreate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`idPertanyaan`, `namaPertanyaan`, `jenisPertanyaan`, `dateCreate`) VALUES
('1', 'Prosedur pelayanan yang ditetapkan sudah memadai dan tidak berpotensi menimbulkan korupsi, kolusi, dan nepotisme (KKN)', 'pilihan', '0000-00-00'),
('2', 'Petugas pelayanan tidak memberikan pelayanan di luar prosedur yang telah ditetapkan dengan imbalan uang/barang', 'pilihan', '0000-00-00'),
('3', 'Tidak terdapat praktik percaloan/perantara yang tidak resmi', 'pilihan', '0000-00-00'),
('4', 'Petugas pelayanan tidak diskriminatif', 'pilihan', '0000-00-00'),
('5', 'Tidak terdapat pungutan liar', 'pilihan', '0000-00-00'),
('6', 'Petugas pelayanan tidak meminta/menuntut imbalan uang/barang terkait pelayanan yang diberikan', 'pilihan', '0000-00-00'),
('7', 'Petugas pelayanan menolak pemberian uang/barang terkait pelayanan yang diberikan', 'pilihan', '0000-00-00'),
('8', 'Tidak ada diskriminasi dalam penanganan pengaduan', 'pilihan', '0000-00-00'),
('9', 'Produk/jasa layanan yang diterima sesuai dengan daftar produk/jasa layanan yang tersedia', 'pilihan', '0000-00-00'),
('quiz60851c8c95061', 'Komentar dan saran', 'essai', '2021-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `responden`
--

CREATE TABLE `responden` (
  `idResponden` varchar(255) NOT NULL,
  `namaResponden` varchar(255) NOT NULL,
  `profesiResponden` varchar(255) DEFAULT NULL,
  `phoneResponden` varchar(255) NOT NULL,
  `emailResponden` varchar(255) NOT NULL,
  `perusahaanResponden` varchar(255) DEFAULT NULL,
  `dateCreate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `responden`
--

INSERT INTO `responden` (`idResponden`, `namaResponden`, `profesiResponden`, `phoneResponden`, `emailResponden`, `perusahaanResponden`, `dateCreate`) VALUES
('resp6064023660f5c', 'asa', '', '1212', 'muhammadinkamil@gmail.com', '', '2021-03-31'),
('resp606407d757b8c', 'asa', '', '1213', 'ican@dipointer.com', '', '2021-03-31'),
('resp60640f88ed833', 'as', '', '123', 'ican@dipointer.com', '', '2021-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` varchar(255) NOT NULL,
  `usernameUsers` varchar(255) NOT NULL,
  `passwordUsers` varchar(255) NOT NULL,
  `statusUsers` int(11) NOT NULL,
  `dateCreate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `usernameUsers`, `passwordUsers`, `statusUsers`, `dateCreate`) VALUES
('users60825c2d913e1', 'admin', '$2y$10$R5ARhD8yD9wWl51IZvnApuRtYn/viZPkWTbwq2Lk1WF5nRVTJlBVC', 0, '2021-04-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`idPertanyaan`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
