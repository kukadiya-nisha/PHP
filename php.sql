-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2025 at 08:16 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `email`, `product_id`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(11, 'janki.kansagra@rku.ac.in', 13, 3, 30000.00, '2025-03-27 12:56:45', '2025-03-27 13:46:08'),
(12, 'janki.kansagra@rku.ac.in', 14, 5, 250000.00, '2025-03-27 13:08:46', '2025-03-27 13:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_status`) VALUES
(1, 'Electronics', 'Active'),
(2, 'Fashion', 'Active'),
(6, 'Laptops', 'Active'),
(7, 'Clothes', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `contact_inquiry`
--

CREATE TABLE `contact_inquiry` (
  `id` int NOT NULL,
  `name` char(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_inquiry`
--

INSERT INTO `contact_inquiry` (`id`, `name`, `email`, `mobile`, `subject`, `message`, `reply`) VALUES
(1, 'janki', 'jankikansagra12@gmail.com', 8155825235, 'Registration', 'Error in registration', NULL),
(2, 'Janki Kansagra', 'kansagrajanki@gmail.com', 9347987804, 'error registration', 'i am not able to register', NULL),
(3, 'meet', 'gondaliyameet37@gmail.com', 7474747474, 'reset password', 'failed to generate otp for reset ppassword', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `address` text NOT NULL,
  `mobile` bigint NOT NULL,
  `email` varchar(50) NOT NULL,
  `maps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_token`
--

CREATE TABLE `password_token` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL,
  `otp_attempts` int NOT NULL,
  `last_resend` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `main_image` varchar(255) NOT NULL,
  `other_images` text,
  `category_id` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text,
  `quantity` int NOT NULL DEFAULT '0',
  `status` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Active',
  `discount` int DEFAULT '0',
  `discounted_price` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `main_image`, `other_images`, `category_id`, `price`, `description`, `quantity`, `status`, `discount`, `discounted_price`, `created_at`, `updated_at`) VALUES
(12, 'Oppo F21 Pro', '67e25f07618e2250203070019.jpg', '67e25487dacf92502021119370.jpg,67e25487dacfd2502021119371.jpg', 1, 50000.00, '<p>8GB RAM</p>\r\n\r\n<p>128 GB ROM</p>\r\n', 0, 'Active', 0, 50000, '2025-03-24 22:17:00', '2025-03-27 10:41:13'),
(13, 'Laptops', '67e18f1b848492502021114563.jpg', '67e18f1b8485b2502021119370.jpg,67e18f1b8485f2502021119371.jpg,67e18f1b848602502021119372.jpg,67e18f1b848612502021119373.jpg,67e18f1b848622502021119374.jpg,67e18f1b848632502021119375.jpg,67e18f1b84864m505.jpg', 6, 10000.00, '<p>Ideapad Slim 5</p>\r\n', 3, 'Active', 5, 9500, '2025-03-24 22:28:03', '2025-03-27 10:48:22'),
(14, 'demo', '67e4bdb20b57f2502021114561.jpg', '67e4bdb20b59b2502021114560.jpg,67e4bdb20b5a02502021114561.jpg,67e4bdb20b5a22502021114562.jpg,67e4bdb20b5a32502021114563.jpg,67e4bdb20b5a42502021114564.jpg', 1, 50000.00, '<p>demo description</p>\r\n', 10, 'Active', 10, 45000, '2025-03-27 08:23:38', '2025-03-27 08:23:38');

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
(1, 'janki', 'Kansagra', 'jankikansagra12@gmail.com', 8155825235, 'Pratyush@1234', '67d7abdd8f3d910.jpg', 'Admin', 'Active', '0000-00-00 00:00:00'),
(3, 'Janki', 'Kansagra', 'janki.kansagra@rku.ac.in', 8155825235, 'Janki@123456', '67c887b31ea2d16.jpg', 'User', 'Active', '0000-00-00 00:00:00'),
(4, 'Janki', 'Kansagra', 'pratyushf31@northstar.edu.in', 9437987804, 'Janki@123456', '67c88b15dcbe514.jpg', 'User', 'Inactive', '0000-00-00 00:00:00'),
(5, 'Janki', 'Kansagra', 'denishfaldu@gmail.com', 8155825235, 'Janki@123', '67c88da215d0412.jpg', 'User', 'Inactive', '1741196706'),
(9, 'Janki', 'Kansagra', 'kansagrajanki@gmail.com', 9347987804, 'Janki@12345', '67df9ac4c60c09.jpg', 'User', 'Active', ''),
(11, 'NAnera', 'Punit', 'pnanera073@rku.ac.in', 8528528523, 'Punit@1234', '67c91cb67241314.jpg', 'User', 'Active', ''),
(13, 'Nisha', 'Kukadiya', 'nisha.kukadiya@rku.ac.in', 1231231234, 'Nisha@1234', '67c947d2a385f14.jpg', 'User', 'Inactive', '67c947d2a38631741244370'),
(14, 'Kirtan', 'Poshiya', 'kposhiya476@rku.ac.in', 8528528526, 'Kirtan@1234', '67ce76f2d1ed413.jpg', 'User', 'Active', '67ce76f2d1ed71741584114'),
(15, 'nisha', 'kukadiya', 'kukadiyanisha@gmail.com', 7990175737, 'Nisha@123', '67cfacf2a0278WhatsApp Image 2024-11-28 at 2.27.33 PM.jpeg', 'Admin', 'Active', '1741663474');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int NOT NULL,
  `slider_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `slider_image`) VALUES
(1, 'image.jpg'),
(2, 'j2zi31lqofw1abqfrjux.jpg'),
(5, 'Product_of_the_Year_USA_2017_Winners.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `product_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `email`, `product_id`, `created_at`, `updated_at`) VALUES
(4, 'janki.kansagra@rku.ac.in', 13, '2025-03-27 12:51:32', '2025-03-27 12:51:32'),
(5, 'janki.kansagra@rku.ac.in', 14, '2025-03-27 13:42:41', '2025-03-27 13:42:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_inquiry`
--
ALTER TABLE `contact_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_token`
--
ALTER TABLE `password_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_inquiry`
--
ALTER TABLE `contact_inquiry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_token`
--
ALTER TABLE `password_token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
