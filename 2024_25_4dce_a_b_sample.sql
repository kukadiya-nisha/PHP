-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2025 at 06:43 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2024_25_4dce_a_b_sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int NOT NULL,
  `firstname` char(20) NOT NULL,
  `lastname` char(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint NOT NULL,
  `password` varchar(30) NOT NULL,
  `profile_picture` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `role` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'User',
  `status` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Inactive',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `firstname`, `lastname`, `email`, `mobile`, `password`, `profile_picture`, `role`, `status`, `token`) VALUES
(1, 'Janki', 'Kansagra', 'jankikansagra12@gmail.com', 8155825235, 'Janki@1234', '67c88774c767716.jpg', 'Admin', 'Active', '0000-00-00 00:00:00'),
(3, 'Janki', 'Kansagra', 'janki.kansagra@rku.ac.in', 8155825235, 'Janki@1234', '67c887b31ea2d16.jpg', 'User', 'Inactive', '0000-00-00 00:00:00'),
(4, 'Janki', 'Kansagra', 'pratyushf31@northstar.edu.in', 9437987804, 'Janki@123456', '67c88b15dcbe514.jpg', 'User', 'Inactive', '0000-00-00 00:00:00'),
(5, 'Janki', 'Kansagra', 'denishfaldu@gmail.com', 8155825235, 'Janki@123', '67c88da215d0412.jpg', 'User', 'Inactive', '1741196706'),
(9, 'janki', 'kansagra', 'kansagrajanki@gmail.com', 4756912242, 'Janki@1234', '67c916f499e7815.jpg', 'User', 'Inactive', ''),
(11, 'NAnera', 'Punit', 'pnanera073@rku.ac.in', 8528528523, 'Punit@1234', '67c91cb67241314.jpg', 'User', 'Active', ''),
(13, 'Nisha', 'Kukadiya', 'nisha.kukadiya@rku.ac.in', 1231231234, 'Nisha@1234', '67c947d2a385f14.jpg', 'User', 'Inactive', '67c947d2a38631741244370'),
(14, 'Kirtan', 'Poshiya', 'kposhiya476@rku.ac.in', 8528528526, 'Kirtan@1234', '67ce76f2d1ed413.jpg', 'User', 'Active', '67ce76f2d1ed71741584114');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
