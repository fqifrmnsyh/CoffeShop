-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 12:11 PM
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
-- Database: `cafe3`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(5) NOT NULL,
  `kategori` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `kode`) VALUES
(1, 'Junk Food', 'JF'),
(2, 'Drink', 'DR'),
(3, 'Snack', 'SK'),
(17, 'Makanan Berat', 'MB');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(14) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_item` int(11) NOT NULL,
  `total_harga` int(8) NOT NULL,
  `status` enum('InOrder','Complete','Canceled') NOT NULL DEFAULT 'InOrder',
  `Pembayaran` varchar(15) NOT NULL,
  `NominalBayar` int(11) NOT NULL,
  `tgl_pesanan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_user`, `total_item`, `total_harga`, `status`, `Pembayaran`, `NominalBayar`, `tgl_pesanan`) VALUES
('CX202406210001', 33, 1, 5000, 'Complete', '', 10000, '2024-06-21 13:58:57'),
('CX202406210002', 34, 3, 15000, 'InOrder', '', 0, '2024-06-21 15:22:58'),
('CX202406210003', 34, 4, 45000, 'Complete', '', 50000, '2024-06-21 15:29:49'),
('CX202406210004', 34, 1, 7500, 'InOrder', '', 0, '2024-06-21 15:40:09'),
('CX202406210005', 35, 1, 7500, 'InOrder', '', 0, '2024-06-21 15:47:26'),
('CX202406210006', 36, 2, 15000, 'InOrder', '', 0, '2024-06-21 15:48:18'),
('CX202406230001', 32, 1, 7500, 'InOrder', '', 0, '2024-06-23 20:32:56'),
('CX202406240001', 32, 1, 5000, 'InOrder', '', 0, '2024-06-24 00:05:18'),
('CX202406240002', 32, 1, 5000, 'InOrder', '', 0, '2024-06-24 13:02:16'),
('CX202406250001', 32, 2, 17000, 'InOrder', '', 0, '2024-06-25 10:36:08'),
('CX202406250002', 32, 1, 7500, 'InOrder', '', 0, '2024-06-25 10:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id` int(11) NOT NULL,
  `id_pesanan` varchar(14) NOT NULL,
  `id_user` varchar(12) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `jml_item` int(3) NOT NULL,
  `harga` int(6) NOT NULL,
  `status` enum('Pending','Complete','Canceled') NOT NULL DEFAULT 'Pending',
  `sub_total` int(7) NOT NULL,
  `tgl_pesanan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id`, `id_pesanan`, `id_user`, `id_produk`, `nama`, `image`, `catatan`, `jml_item`, `harga`, `status`, `sub_total`, `tgl_pesanan`) VALUES
(160, 'CX202406210001', '33', 1, 'Black Coffee', 'img1714708973.jpg', NULL, 1, 5000, 'Complete', 5000, '2024-06-21 13:58:57'),
(161, 'CX202406210002', '34', 1, 'Black Coffee', 'img1714708973.jpg', 'less sugar', 3, 5000, 'Canceled', 15000, '2024-06-21 15:22:58'),
(162, 'CX202406210003', '34', 4, 'French Fries', 'img1714724833.jpg', NULL, 2, 7500, 'Complete', 15000, '2024-06-21 15:29:49'),
(163, 'CX202406210003', '34', 5, 'Avocado Juice', 'img1714759135.jpg', NULL, 2, 15000, 'Complete', 30000, '2024-06-21 15:29:49'),
(164, 'CX202406210004', '34', 4, 'French Fries', 'img1714724833.jpg', 'tanpa garam', 1, 7500, 'Pending', 7500, '2024-06-21 15:40:09'),
(165, 'CX202406210005', '35', 4, 'French Fries', 'img1714724833.jpg', NULL, 1, 7500, 'Pending', 7500, '2024-06-21 15:47:26'),
(166, 'CX202406210006', '36', 4, 'French Fries', 'img1714724833.jpg', NULL, 2, 7500, 'Pending', 15000, '2024-06-21 15:48:18'),
(167, 'CX202406230001', '32', 4, 'French Fries', 'img1714724833.jpg', NULL, 1, 7500, 'Pending', 7500, '2024-06-23 20:32:56'),
(168, 'CX202406240001', '32', 1, 'Black Coffee', 'img1714708973.jpg', NULL, 1, 5000, 'Pending', 5000, '2024-06-24 00:05:18'),
(169, 'CX202406240002', '32', 1, 'Black Coffee', 'img1714708973.jpg', '', 1, 5000, 'Pending', 5000, '2024-06-24 13:02:16'),
(170, 'CX202406250001', '32', 1, 'Black Coffee', 'img1714708973.jpg', NULL, 1, 5000, 'Pending', 5000, '2024-06-25 10:36:08'),
(171, 'CX202406250001', '32', 2, 'Burger', 'img1714709337.jpg', NULL, 1, 12000, 'Pending', 12000, '2024-06-25 10:36:08'),
(172, 'CX202406250002', '32', 4, 'French Fries', 'img1714724833.jpg', NULL, 1, 7500, 'Pending', 7500, '2024-06-25 10:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode` varchar(6) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga` int(6) NOT NULL,
  `stok` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `image` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `nama_kategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `kode`, `id_kategori`, `harga`, `stok`, `sold`, `image`, `deskripsi`, `nama_kategori`) VALUES
(1, 'Black Coffee', 'BCF', 2, 5000, 64, 41, 'img1714708973.jpg', 'Lorem ipsummmmmmmm dolor sit amet', 'Minuman'),
(2, 'Burger', 'BGR', 1, 12000, 97, 34, 'img1714709337.jpg', 'Burger', 'Makanan'),
(3, 'Strawberry Juice', 'SSM', 2, 14000, 0, 15, 'img1714709661.jpg', NULL, 'Minuman'),
(4, 'French Fries', 'FFR', 1, 7500, 380, 22, 'img1714724833.jpg', 'kntng', 'Makanan'),
(5, 'Avocado Juice', 'AVJ', 2, 15000, 15, 4, 'img1714759135.jpg', NULL, 'Minuman'),
(6, 'Dimsum Ayam', 'DSA', 3, 10000, 60, 6, 'img1714901798.jpg', 'dmsm', 'Snack'),
(36, 'Moccacino', 'MCN', 2, 12000, 0, 12, 'img1716615898.jpg', NULL, NULL),
(37, 'Cilok', 'CLK', 3, 5000, 97, 3, 'img1716615968.jpg', NULL, NULL),
(39, 'Americano', 'ARN', 2, 10000, 30, 0, 'img1718722201.jpg', 'America yaa--', NULL),
(40, 'Hot Dog', 'HDG', 1, 15000, 50, 0, 'img1718722453.png', 'Hot dawg', NULL),
(42, 'Chocolate Smoothies', 'CST', 2, 10000, 50, 0, 'img1718876869.jpg', 'minuman rasa coklat', NULL),
(43, 'Vanilla Latte', 'VLT', 2, 10000, 200, 0, 'img1718958359.jpeg', 'Minuman rasa vanilla dengan tambahan kopi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'administrator'),
(2, 'cashier'),
(3, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `id_user` varchar(12) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `harga` int(128) NOT NULL,
  `catatan` text DEFAULT NULL,
  `jml_item` int(3) NOT NULL,
  `sub_total` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id`, `id_user`, `id_produk`, `nama`, `image`, `harga`, `catatan`, `jml_item`, `sub_total`) VALUES
(334, '36', 2, 'Burger', 'img1714709337.jpg', 12000, NULL, 1, 12000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `email` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `image` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `tanggal_input` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `alamat`, `telepon`, `email`, `image`, `password`, `role_id`, `is_active`, `tanggal_input`) VALUES
(5, 'Haidar Ihsan', 'Jakarta', '080802367176', 'san333@gmail.com', 'pro1715749517.gif', '$2y$10$Trmz8wXM7QCyICH7euhqZ.IUBJS3FDQrZRw6NWsee/G.jgCjb3wJC', 1, 1, 1710754891),
(21, 'Admin', 'cengkarengprc', '', 'admin@gmail.com', 'pro1717246463.png', '$2y$10$9A9fduU1YlBQjnimnRNcr.RUDxClzkS2.bEDKLjpXEA7aeJeAt4gO', 1, 1, 1712116318),
(23, 'faqih firmansyah', 'jln.petir utama', NULL, 'faqih@gamil.com', 'default.jpg', '$2y$10$w63sX/7svQl2IN.o.eLdK.b6qYHHcenPs0G0pFREfw8eVrUKti/AC', 2, 1, 1712117486),
(24, 'arbian', 'gondrong', NULL, 'arbian@gmail.com', 'default.jpg', '$2y$10$9A9fduU1YlBQjnimnRNcr.RUDxClzkS2.bEDKLjpXEA7aeJeAt4gO', 2, 1, 1712117653),
(25, 'Pelanggan Pertama', '-', NULL, 'customer@gmail.com', 'default.jpg', '$2y$10$F/RRw35JzkySzyLy24MA8uEo7dW5ZyF2GVv1MSj7ErNE2v453BhDG', 3, 1, 1714709815),
(26, 'Anton Awewe', 'Grogol', NULL, 'ton@gmail.com', 'default.jpg', '$2y$10$NbS6PPqdZoFmTmhUPWIH3ueNVwEJr36qArQcZ2zUVBkR5sxxZOaLS', 2, 1, 1715751306),
(28, 'asera', NULL, NULL, 'asera@gmail.com', 'default.jpg', '$2y$10$PvdRClOHl745ql6jOe2tZ.1gbGAfgFMVIJcSEj2wK.8GMvNffuqC.', 3, 1, 1718438407),
(29, 'Mani', NULL, NULL, 'mani69@gmail.com', 'default.jpg', '$2y$10$Ks2c9rr.dqkEeR.2B2At.Ohha5mHz2ts3yAFZuAXj6Hl6Fj0goSwm', 3, 1, 1718707008),
(30, 'Ilman Fahmi', NULL, NULL, 'ilmanfahmi123@gmail.com', 'default.jpg', '$2y$10$VeMMqfIcNfffkeeD64FLxuyLHPCfwRZ73P035TBV7dw76B3OTocA6', 3, 1, 1718768785),
(31, 'asera123', NULL, NULL, 'asera@gmail.com', 'default.jpg', '$2y$10$lO6VGV8ryTP48gjqCF8gZO2Jy2FWmsMoaZRME/KipWAyO/XLj2Sxa', 3, 1, 1718876526),
(32, 'Pelanggan', NULL, NULL, 'cust@gmail.com', 'default.jpg', '$2y$10$zI7E.mSP2grzSgQYKmGy7.UCB3AJBRKhvUVD8WAJDpwxmzWQshH8G', 3, 1, 1718892939),
(33, 'haidar', NULL, NULL, 'haidar@gmail.com', 'default.jpg', '$2y$10$1520ubAJpQoZayN545Fy1eOtKTTA0IXHmJzoTWKIo5md8lrIh5JhS', 3, 1, 1718951967),
(34, 'Ilman Fahmi', NULL, NULL, 'fahmi48@gmail.com', 'default.jpg', '$2y$10$kW8SESdC4UeU89TCNEa1Eu7WgIEgpBsN72xAfixj5.SddssPMDyji', 3, 1, 1718958096),
(35, 'new user 1', NULL, NULL, 'newuser1@gmail.com', 'default.jpg', '$2y$10$7ZaRHSTeJGv0nQoYRyO.WuIYjGMf.5DswDaEnEQoSv582leDjEClG', 3, 1, 1718959624),
(36, 'new user 2', NULL, NULL, 'newuser2@gmail.com', 'default.jpg', '$2y$10$ew8O89P9COFYshhC1BatYu/t2gz7GiMTX3DMSrlpU.ZPy5jj4wQfu', 3, 1, 1718959673),
(37, 'dar', 'aaa', NULL, 'dar@gmail.com', 'default.jpg', '$2y$10$4bY.OlA3l8yf49ZzhTlqhO1Ia9/BelrYSJJCknXJjidqwoqqLyBxW', 2, 1, 1719396325);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
