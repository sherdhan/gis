-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2018 at 09:43 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `15650078`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_location`
--

CREATE TABLE `data_location` (
  `id` int(11) NOT NULL,
  `des` varchar(255) DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lon` float(10,6) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_location`
--

INSERT INTO `data_location` (`id`, `des`, `lat`, `lon`, `gambar`, `ket`) VALUES
(19, 'potongan 1', -7.921069, 112.545914, 'Kampus 3/Square_1.jpg', ''),
(20, 'potongan 2', -7.920420, 112.547760, 'Kampus 3/Square_2.jpg', ''),
(21, 'potongan 3', -7.920970, 112.549042, 'Kampus 3/Square_3.jpg', ''),
(22, 'potongan 4', -7.922354, 112.546097, 'Kampus 3/Square_4.jpg', ''),
(23, 'Potongan 5', -7.922318, 112.547470, 'Kampus 3/Square_5.jpg', ''),
(24, 'potongan 6', -7.922192, 112.549004, 'Kampus 3/Square_6.jpg', ''),
(25, 'potongan 7', -7.923134, 112.546463, 'Kampus 3/Square_7.jpg', ''),
(26, 'potongan 8', -7.923348, 112.547356, 'Kampus 3/Square_8.jpg', ''),
(27, 'potongan 9', -7.923239, 112.548790, 'Kampus 3/Square_9.jpg', ''),
(33, 'tes123456', -7.938139, 112.617722, 'eiger.png', 'tes123456');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'sherdhan', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_location`
--
ALTER TABLE `data_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_location`
--
ALTER TABLE `data_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
