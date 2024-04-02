-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2024 at 10:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productName` varchar(100) DEFAULT NULL,
  `sku` varchar(100) NOT NULL,
  `stockQty` int(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `regularPrice` decimal(6,1) DEFAULT NULL,
  `salePrice` decimal(6,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productName`, `sku`, `stockQty`, `image`, `category`, `regularPrice`, `salePrice`) VALUES
('plant', '1233573', 5, 'https://en.wikipedia.org/wiki/File:Magnolia.jpg', 'grocery', 3.0, 33.0),
('plant6', '12335732', 22, 'https://en.wikipedia.org/wiki/File:Magnolia.jpg', 'misc', 4.0, 0.0),
('plant3', '12335734', 22, 'https://en.wikipedia.org/wiki/File:Magnolia.jpg', 'grocery', 0.0, 0.0),
('plant23', 'w', 99, 'https://en.wikipedia.org/wiki/File:Magnolia.jpg', 'grocery', 0.0, 0.0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userName`, `password`, `admin`) VALUES
('admin', 'admin', 1),
('admin3', 'admin3', 1),
('user', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`sku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userName`),
  ADD UNIQUE KEY `user_name` (`userName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
