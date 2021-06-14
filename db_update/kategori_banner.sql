-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2021 at 09:16 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xpro-shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_banner`
--

CREATE TABLE `kategori_banner` (
  `id_kategori_banner` int(11) NOT NULL,
  `nama_kategori_banner` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_banner`
--

INSERT INTO `kategori_banner` (`id_kategori_banner`, `nama_kategori_banner`) VALUES
(1, 'Contact us'),
(2, 'Related Links'),
(3, 'Buy'),
(4, 'Seller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_banner`
--
ALTER TABLE `kategori_banner`
  ADD PRIMARY KEY (`id_kategori_banner`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_banner`
--
ALTER TABLE `kategori_banner`
  MODIFY `id_kategori_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
