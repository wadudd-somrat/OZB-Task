-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2023 at 06:22 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ozb_online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `status`, `created_at`, `created_by`) VALUES
(5, 'Television', 'test', '900', NULL, 1, NULL, NULL),
(6, 'HP-1', 'test-2', '600', NULL, 1, NULL, NULL),
(7, 'HP', 'test-2', '600', NULL, 1, NULL, NULL),
(8, 'HP', 'test-2', '600', NULL, 1, NULL, NULL),
(9, 'apple', 'test', '100', NULL, 1, NULL, NULL),
(10, 'HP', 'test', '600', '64f0a64ff3ae4-1693492815.jpg', 1, NULL, NULL),
(11, 'Model 5542', 'test-2', '100', '64f0a9e0d0837-1693493728.jpg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_email`, `created_at`) VALUES
(1, 'ozb_admin', '$2y$10$pr6Em7fP5m7GuVGKp46MpOkPpaMF.JiVjNOTa/eSWpg0UDjQD2Dq2', 'ozb_admin@test.com', NULL),
(2, 'ozb_admin_', '$2y$10$pr6Em7fP5m7GuVGKp46MpOkPpaMF.JiVjNOTa/eSWpg0UDjQD2Dq2', 'ozb_admin@test.com', NULL),
(3, 'ozb_admin__', '$2y$10$pr6Em7fP5m7GuVGKp46MpOkPpaMF.JiVjNOTa/eSWpg0UDjQD2Dq2', 'ozb_admin@test.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
