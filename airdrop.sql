-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 05:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airdrop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `email` varchar(199) DEFAULT NULL,
  `notelp` varchar(200) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `reason` text DEFAULT NULL,
  `block_date` datetime DEFAULT NULL,
  `block_by` int(11) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete` enum('Y','N') DEFAULT 'N',
  `delete_by` int(11) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `notelp`, `nama`, `foto`, `password`, `status`, `reason`, `block_date`, `block_by`, `create_by`, `create_date`, `delete`, `delete_by`, `delete_date`) VALUES
(50, 'sejolilabil@gmail.com', '81333811057', 'Saka Devs 1', '66909dd103ced-1720753617.jpg', '4815862389a32794549acb1e99b3743e4eef8e815a37087c3facd903a55774a7', 'Y', NULL, NULL, NULL, NULL, '2024-07-12 10:14:27', 'N', NULL, NULL),
(51, 'admin@gmail.com', '081111111111', 'Admin Airdrop', '66909da649be0-1720753574.jpg', 'c2b7081cee60e1f60c5ed286082ecad62703d2fb4be1628c9419a7af288130d3', 'N', 'Toxic', NULL, NULL, 50, '2024-07-12 10:07:24', 'N', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  `reason` text DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`, `status`, `reason`, `create_by`, `create_date`) VALUES
(3, 'Airdrop Unggulan', 'Y', NULL, NULL, '2024-07-11 19:37:28'),
(4, 'Airdrop Premium', 'Y', NULL, NULL, '2024-07-11 19:37:53'),
(5, 'Airdrop Epic', 'Y', NULL, NULL, '2024-07-11 20:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_produk`, `id_user`, `komentar`, `create_date`) VALUES
(1, 4, 55, 'Yeayyyy i got it bro...', '2024-07-12 09:14:31'),
(2, 4, 56, 'I like this airdrop', '2024-07-12 10:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
-- (id_owner dihapus, tidak ada relasi ke owner)
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tutorial` text DEFAULT NULL,
  `verify` enum('Y','N') DEFAULT 'N',
  `link_website` varchar(100) DEFAULT NULL,
  `link_youtube` varchar(100) DEFAULT NULL,
  `status` enum('Y','N') DEFAULT 'Y',
  `reason` text DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `foto`, `nama`, `deskripsi`, `tutorial`, `verify`, `link_website`, `link_youtube`, `status`, `reason`, `create_by`, `create_date`) VALUES
(3, 3, '6690276ade87f-1720723306.jpg', 'Airdrop 1', '<p>Airdrop adalah distribusi token atau koin cryptocurrency, biasanya gratis, ke berbagai alamat dompet mata uang kripto.</p>', '<ol><li>Lorem ipsum dolor sit amet</li></ol>', 'Y', 'https://www.php.net/manual/en/function.html-entity-decode.php', 'https://youtu.be/Mhj15W23IjA?list=RD5anLPw0Efmo', 'Y', NULL, NULL, '2024-07-11 20:55:37'),
(4, 4, '6690278c12c31-1720723340.jpeg', 'Airdrop 2', '<p>Airdrop adalah distribusi token atau koin cryptocurrency, biasanya gratis, ke berbagai alamat dompet mata uang kripto.</p>', '<ul><li>Lorem ipsum dolor sit amet</li></ul>', 'N', NULL, NULL, 'Y', NULL, NULL, '2024-07-11 20:56:05'),
(5, 5, '669027a24aab6-1720723362.png', 'Airdrop 3', '<p>Airdrop adalah distribusi token atau koin cryptocurrency, biasanya gratis, ke berbagai alamat dompet mata uang kripto.</p>', '<ul><li>Lorem ipsum dolor sit amet</li></ul>', 'Y', NULL, NULL, 'Y', NULL, NULL, '2024-07-11 20:56:41'),
(7, 5, '66909f2a0e0c3-1720753962.jpeg', 'Airdrop Baru', '<p>Airdrop adalah distribusi token atau koin cryptocurrency.</p>', '<p>Tutorial airdrop baru.</p>', 'Y', NULL, NULL, 'Y', NULL, 50, '2024-07-12 10:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `icon` varchar(200) DEFAULT NULL,
  `tentang_kami` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `setting` (`id_setting`, `logo`, `icon`, `tentang_kami`) VALUES
(1, '6690067678bd5-1720714870.png', '6690067678f02-1720714870.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(199) DEFAULT NULL,
  `notelp` varchar(200) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `reason` text DEFAULT NULL,
  `block_date` datetime DEFAULT NULL,
  `block_by` int(11) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete` enum('Y','N') DEFAULT 'N',
  `delete_by` int(11) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`id_user`, `email`, `notelp`, `nama`, `foto`, `password`, `status`, `reason`, `block_date`, `block_by`, `create_by`, `create_date`, `delete`, `delete_by`, `delete_date`) VALUES
(55, 'member1@gmail.com', '82111111111', 'Member 1', '668fc4724aa43-1720697970.jpg', 'a6e7d822e67c161bf8b9480d2d145c5bdb286190b1e9db22940b7e94795b1922', 'Y', NULL, NULL, NULL, NULL, '2024-07-12 18:57:51', 'N', NULL, NULL),
(56, 'member2@gmail.com', '82222222222', 'Member 2', '668fc4a4688b1-1720698020.jpg', 'c5aa2ca97014d7e1327adabc1d8148cbd63422abf412b5b107c9b670ece2fb9f', 'Y', NULL, NULL, NULL, NULL, '2024-07-11 18:40:20', 'N', NULL, NULL),
(57, 'member3@gmail.com', '082333333333', 'Member 3', '668fcb14131b1-1720699668.jpg', '27244beda6f19de8461472298ed141891d85ad5aa7866be168365cf0e52b8b30', 'Y', NULL, NULL, NULL, NULL, '2024-07-11 19:07:48', 'N', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_produk`
--

CREATE TABLE `user_produk` (
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user_produk` (`id_user`, `id_produk`) VALUES
(55, 4),
(55, 3),
(56, 4);

--
-- Indexes for dumped tables
--

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `block_by` (`block_by`),
  ADD KEY `user_ibfk_2` (`create_by`),
  ADD KEY `delete_by` (`delete_by`);

ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `create_by` (`create_by`);

ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `create_by` (`create_by`);

ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `block_by` (`block_by`),
  ADD KEY `user_ibfk_2` (`create_by`),
  ADD KEY `delete_by` (`delete_by`);

ALTER TABLE `user_produk`
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `user_produk_ibfk_2` (`id_user`);

--
-- AUTO_INCREMENT
--

ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints
--

ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`block_by`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`create_by`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_ibfk_3` FOREIGN KEY (`delete_by`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori_ibfk_1` FOREIGN KEY (`create_by`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`create_by`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`block_by`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`create_by`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`delete_by`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `user_produk`
  ADD CONSTRAINT `user_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_produk_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
