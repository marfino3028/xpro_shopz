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
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id_banner` int(5) NOT NULL,
  `id_kategori_banner` int(11) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pixel` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `icon` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `posisi` enum('top','footer','login','produk') COLLATE latin1_general_ci NOT NULL DEFAULT 'top',
  `tgl_posting` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id_banner`, `id_kategori_banner`, `judul`, `keterangan`, `url`, `gambar`, `pixel`, `icon`, `posisi`, `tgl_posting`) VALUES
(19, 0, 'Layanan Hadiah', 'Mendukung layanan hadiah', 'https://shop.xprogroup.com.au/', '', '', 'icon-gift', 'top', '2017-05-21'),
(20, 0, '24-hour customer support', 'helps you resolve issues as soon as possible', 'https://shop.xprogroup.com.au/', '', '', 'icon-bubbles', 'top', '2017-05-21'),
(21, 0, 'Safety payment', 'safety payment 100%', 'https://shop.xprogroup.com.au/', '', '', 'icon-credit-card', 'top', '2017-05-21'),
(22, 0, '90% money back guarantee', 'if you\'re not 100% satisfied with your order', 'https://shop.xprogroup.com.au/', '', '', 'icon-sync', 'top', '2017-05-21'),
(23, 0, 'Free delivery', 'On orders over $90', 'https://shop.xprogroup.com.au/', '', '', 'icon-rocket', 'top', '2017-05-21'),
(24, 1, 'Call us 24/7', 'Call (0751) 461692\r\n<h3>0812 6777 13xx</h3> Jl. Angkasa Puri, Perundam, Padang\r\ncontact@tajalapak.com', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(25, 2, 'About Marketpro', '', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(26, 2, 'Terms and Conditions', '', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(27, 2, 'Privacy Policy', '', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(28, 2, 'Affiliate Program', '', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(34, 4, 'How to sell', '', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(30, 3, 'How to order', '', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(31, 3, 'Payment', '', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(32, 3, 'Buyer Protection', '', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(33, 3, 'Procurement of goods & services', '', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(35, 4, 'Why sell on marketpro?', '', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(36, 4, 'Brand development index', '', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(37, 4, 'Seller center', '', 'https://shop.xprogroup.com.au/', '', '', '', 'footer', '2020-02-07'),
(38, 0, 'Pengiriman ke seluruh Pelosok Indonesia.', 'Pengiriman ke seluruh Pelosok Indonesia.', 'https://shop.xprogroup.com.au/', '', '', 'icon-network', 'produk', '2020-07-19'),
(39, 0, 'Gratis pengembalian 7 hari jika tidak memenuhi syarat.', 'Gratis pengembalian 7 hari jika tidak memenuhi syarat.', 'https://shop.xprogroup.com.au/', '', '', 'icon-3d-rotate', 'produk', '2020-07-19'),
(40, 0, 'Penjual memberikan tagihan untuk produk ini.', 'Penjual memberikan tagihan untuk produk ini.', 'https://shop.xprogroup.com.au/', '', '', 'icon-receipt', 'produk', '2020-07-19'),
(41, 0, 'Bayar online atau ketika barang diterima.', 'Bayar online atau ketika barang diterima.', 'https://shop.xprogroup.com.au/', '', '', 'icon-credit-card', 'produk', '2020-07-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id_banner` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
