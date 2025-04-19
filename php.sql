-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2025 at 05:32 AM
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
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `firstname` char(30) NOT NULL,
  `lastname` char(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `city` char(50) NOT NULL,
  `state` char(30) NOT NULL,
  `zip` int NOT NULL,
  `phone` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_email`, `firstname`, `lastname`, `email`, `address`, `city`, `state`, `zip`, `phone`) VALUES
(2, 'janki.kansagra@rku.ac.in', 'Pratyush', 'Faldu', 'pratyush@gmail.com', 'A-301 Bilipatra Apartment, Bapasitaram Chowk, Mavdi Gam', 'Rajkot', 'Gujarat', 360004, 8155825235),
(3, 'janki.kansagra@rku.ac.in', 'Denish', 'Faldu', 'denish@gmail.com', 'A-301 Bilipatra Apartment, Bapasitaram Chowk, Mavdi Gam', 'Rajkot', 'Gujarat', 360004, 7383654448);

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
(19, 'abcdef@gmail.com', 23, 1, 1349990.00, '2025-04-01 12:51:10', '2025-04-01 12:51:10'),
(20, 'abcdef@gmail.com', 17, 3, 74700.00, '2025-04-01 12:51:43', '2025-04-01 12:51:43');

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
(1, 'Electronic', 'active'),
(2, 'Fashion', 'Active'),
(6, 'Laptops', 'Active'),
(7, 'Clothes', 'Active'),
(10, 'Mobiles', 'Active'),
(11, 'Washing MAchines', 'Active'),
(12, 'Furniture', 'Active'),
(13, 'Crockery', 'Active'),
(15, 'Shoes', 'Active'),
(16, 'Watches', 'Active'),
(17, 'testing', 'inactive');

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
  `id` int NOT NULL,
  `address` text NOT NULL,
  `mobile` bigint NOT NULL,
  `email` varchar(50) NOT NULL,
  `maps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `address`, `mobile`, `email`, `maps`) VALUES
(1, 'RKU Rajkot', 8155825235, 'janki.kansagra@rku.ac.in', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3692.991231530346!2d70.89784381053354!3d22.24041147964513!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959b4a660019ee9%3A0x3d6254f36ed0e794!2sRK%20University%20Main%20Campus!5e0!3m2!1sen!2sin!4v1743668856252!5m2!1sen!2sin\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int NOT NULL,
  `offer_name` varchar(255) NOT NULL,
  `offer_description` text NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL,
  `cart_total` int NOT NULL,
  `max_discount` int NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `offer_name`, `offer_description`, `discount_percentage`, `cart_total`, `max_discount`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'OFF10', 'Get a 10% discount on a minimum purchase of 5000.', 10.00, 5000, 500, '2025-04-15 15:09:21', '2025-04-26 20:39:22', 'Active', '2025-04-15 20:40:25', '2025-04-15 20:40:25'),
(2, 'SUMMER5', 'Get a mximum discount of 100 Rs on a minumum purchase of 2000.', 5.00, 2000, 100, '2025-04-16 20:40:36', '2025-04-25 20:40:36', 'Active', '2025-04-15 20:41:34', '2025-04-17 09:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `sub_order_id` varchar(255) NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `review` text,
  `email` varchar(50) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `offer_name` varchar(20) DEFAULT NULL,
  `discount_amount` int NOT NULL,
  `actual_amount` int NOT NULL,
  `delivery_status` enum('Ordered','Shipped','Delivered','Return','Replaced','Confirmed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Ordered',
  `payment_status` enum('Pending','Completed','Failed') NOT NULL DEFAULT 'Pending',
  `payment_mode` char(12) NOT NULL DEFAULT 'Online',
  `order_status` char(10) NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `sub_order_id`, `product_id`, `quantity`, `rating`, `review`, `email`, `delivery_address`, `total_amount`, `offer_name`, `discount_amount`, `actual_amount`, `delivery_status`, `payment_status`, `payment_mode`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 'order_QK0DlvUdhNc3Ej', 'order_QK0DlvUdhNc3Ej-17', 17, 1, NULL, NULL, 'janki.kansagra@rku.ac.in', '2', 24400.00, 'OFF10', 500, 24400, 'Ordered', 'Completed', 'Online', 'Active', '2025-04-17 10:34:17', '2025-04-17 10:34:17'),
(2, 'order_QK0K5p6oB682IV', 'order_QK0K5p6oB682IV-19', 19, 2, NULL, NULL, 'janki.kansagra@rku.ac.in', '3', 2900.00, 'OFF10', 100, 24400, 'Ordered', 'Completed', 'Online', 'Active', '2025-04-17 10:40:14', '2025-04-17 10:40:14'),
(3, 'order_QK0XB1I0Iqgf6Q', 'order_QK0XB1I0Iqgf6Q-19', 19, 3, NULL, NULL, 'janki.kansagra@rku.ac.in', '3', 4400.00, 'OFF10', 100, 24400, 'Ordered', 'Completed', 'Online', 'Active', '2025-04-17 10:52:36', '2025-04-17 10:53:30'),
(4, 'order_68009816d87ac', 'order_68009816d87ac-19', 19, 2, NULL, NULL, 'janki.kansagra@rku.ac.in', '3', 3000.00, '', 0, 3000, 'Ordered', 'Pending', 'COD', 'Active', '2025-04-17 11:26:38', '2025-04-17 11:26:38'),
(5, 'order_QK18yXj15kaZ83', 'order_QK18yXj15kaZ83-18', 18, 1, NULL, NULL, 'janki.kansagra@rku.ac.in', '3', 28499.00, 'OFF10', 500, 24400, 'Confirmed', 'Completed', 'Online', 'Active', '2025-04-17 11:28:24', '2025-04-19 09:07:08');

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
(15, 'Redmi 14C 5G', '67e50c3a8725c2.jpg', '67e50c3a8726710.jpg,67e50c3a872688.jpg,67e50c3a872697.jpg,67e50c3a8726a6.jpg,67e50c3a8726b5.jpg,67e50c3a8726c4.jpg,67e50c3a8726d3.jpg,67e50c3a8726e1.jpg', 1, 15000.00, '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>OS</th>\r\n			<td>&lrm;Android 14</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;17.2 x 7.8 x 0.8 cm; 205 g</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Batteries</th>\r\n			<td>&lrm;1 P76 batteries required. (included)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;14C5G</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Connectivity technologies</th>\r\n			<td>&lrm;Bluetooth, Wi-Fi, USB</td>\r\n		</tr>\r\n		<tr>\r\n			<th>GPS</th>\r\n			<td>&lrm;True</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Special features</th>\r\n			<td>&lrm;50MP Dual camera, f/1.8, Portrait | Video | HDR | Short Video | Time-Lapse | Film filters, Side Fingerprint sensor for enhanced security, Dedicated MicroSD card slot with upto 1TB support</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Other display features</th>\r\n			<td>&lrm;Wireless</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Device interface - primary</th>\r\n			<td>&lrm;Touchscreen</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Resolution</th>\r\n			<td>&lrm;720 x 1640</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Other camera features</th>\r\n			<td>&lrm;Rear, Front</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Audio Jack</th>\r\n			<td>&lrm;3.5 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Form factor</th>\r\n			<td>&lrm;Bar</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Starlight Blue</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Battery Power Rating</th>\r\n			<td>&lrm;5160</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Whats in the box</th>\r\n			<td>&lrm;Power Adapter, SIM Tray Ejector, USB Cable</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Redmi</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;India</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;205 g</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 10, 'Active', 0, 14250, '2025-03-27 13:58:42', '2025-04-17 10:49:57'),
(16, 'Zebronics Companion 110 Wireless Keyboard and Mouse Set', '67e511399d6912_1.jpg', '67e511399d69d2_7.jpg,67e511399d69f2_3.jpg,67e511399d6a02_5.jpg,67e511399d6a12_6.jpg,67e511399d6a22_2.jpg,67e511399d6a32_4.jpg', 1, 5000.00, '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;ZEBRONICS</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;13,7, Smith Road, Royapettah CHENNAI-600002</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Series</th>\r\n			<td>&lrm;Zebronics Zeb-Companion 110 Wireless Keyboard and Mouse Combo with Nano Receiver (Black)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Black</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Height</th>\r\n			<td>&lrm;19.8 Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Width</th>\r\n			<td>&lrm;44 Millimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;47.7 x 4.4 x 19.8 cm; 750 g</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Power Source</th>\r\n			<td>&lrm;Battery Powered</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Operating System</th>\r\n			<td>&lrm;Linux, Windows Vista, Chrome OS, Windows 7, Raspberry Pi OS, Mac OS, Windows 2000, Windows 10</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Are Batteries Included</th>\r\n			<td>&lrm;No</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>&lrm;Keyboard - 1 unit, Mouse - 1 unit, Nano receiver - 1 unit</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;13,7</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;750 g</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 10, 'Active', 10, 4500, '2025-03-27 14:20:01', '2025-04-15 20:37:33'),
(17, 'Apple Watch SE', '67e51406dc5433_1.jpg', '67e51406dc5513_4.jpg,67e51406dc5533_5.jpg,67e51406dc5543_3.jpg,67e51406dc5553_1.jpg,67e51406dc5563_6.jpg,67e51406dc5573_2.jpg', 1, 24900.00, '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;Apple</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Apple, Apple Inc, One Apple Park Way, Cupertino, CA 95014, USA. or Apple India Private Limited No.24, 19th floor, Concorde Tower C, UB City, Vittal Mallya Road, Bangalore - 560 001</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Series</th>\r\n			<td>&lrm;Apple Watch SE</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Silver/Denim</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Standing screen display size</th>\r\n			<td>&lrm;40 Millimetres</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Package Dimensions</th>\r\n			<td>&lrm;23.5 x 7.5 x 2.9 cm; 26.4 g</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Batteries</th>\r\n			<td>&lrm;1 Lithium Ion batteries required. (included)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;MXED3HN/A</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Connectivity Type</th>\r\n			<td>&lrm;Cellular</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Wireless Carrier</th>\r\n			<td>&lrm;Unlocked for All Carriers</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Wattage</th>\r\n			<td>&lrm;40 Watt Hours</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Operating System</th>\r\n			<td>&lrm;iOS, Android</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Are Batteries Included</th>\r\n			<td>&lrm;Yes</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Lithium Battery Energy Content</th>\r\n			<td>&lrm;0.81 Watt Hours</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Lithium Ion Cells</th>\r\n			<td>&lrm;1</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>&lrm;1m Magnetic Charging Cable, Band, Case</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Apple</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;26.4 g</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 9, 'Active', 5, 23655, '2025-03-27 14:31:58', '2025-04-17 10:34:17'),
(18, 'iQOO Neo 10R 5G (Moonknight Titanium, 8GB RAM, 256GB Storage)', '67e515557f1594_1.jpg', '67e515557f1664_4.jpg,67e515557f1684_2.jpg,67e515557f1694_3.jpg,67e515557f16a4_5.jpg', 1, 28999.00, '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>OS</th>\r\n			<td>&lrm;Funtouch OS 15 based on Android 15</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;16.4 x 7.6 x 0.8 cm; 196 g</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Batteries</th>\r\n			<td>&lrm;1 Lithium Ion batteries required. (included)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;I2221</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Connectivity technologies</th>\r\n			<td>&lrm;Wi-Fi, Bluetooth 5.4, USB 2.0</td>\r\n		</tr>\r\n		<tr>\r\n			<th>GPS</th>\r\n			<td>&lrm;True</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Special features</th>\r\n			<td>&lrm;Fast Charging Support, IR Blaster</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Other display features</th>\r\n			<td>&lrm;Wireless</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Device interface - primary</th>\r\n			<td>&lrm;Touchscreen</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Resolution</th>\r\n			<td>&lrm;2800 x 1260</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Form factor</th>\r\n			<td>&lrm;Bar</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Moonknight Titanium</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Battery Power Rating</th>\r\n			<td>&lrm;6400</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Whats in the box</th>\r\n			<td>&lrm;Cell phone, Eject Tool, Warranty card, Quick Start Guide, Phone case, Charger, USB cable</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;vivo Mobile India Private Limited</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;India</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;196 g</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 4, 'Active', 10, 26099, '2025-03-27 14:37:33', '2025-04-17 11:28:24'),
(19, 'The Souled Store Men Official Scooby Doo', '67e51653669775_1.jpg', '67e51653669865_4.jpg,67e51653669885_5.jpg,67e51653669895_2.jpg,67e516536698a5_3.jpg', 7, 1500.00, '<ul>\r\n	<li>Product Dimensions &rlm; : &lrm;&nbsp;30 x 25 x 3 cm; 500 g</li>\r\n	<li>Date First Available &rlm; : &lrm;&nbsp;13 September 2022</li>\r\n	<li>Manufacturer &rlm; : &lrm;&nbsp;The Souled Store</li>\r\n	<li>ASIN &rlm; : &lrm;&nbsp;B0BF5D3W1V</li>\r\n	<li>Item model number &rlm; : &lrm;&nbsp;210061</li>\r\n	<li>Country of Origin &rlm; : &lrm;&nbsp;India</li>\r\n	<li>Department &rlm; : &lrm;&nbsp;Men</li>\r\n	<li>Manufacturer &rlm; : &lrm;&nbsp;The Souled Store, The Souled Store, F6 - 202, Bhumi World-Industrial Park, Pimplas Village, Pimplas, Thane, Maharashtra - 421302. Contact: 022-68493328, connect@thesouledstore.com</li>\r\n	<li>Packer &rlm; : &lrm;&nbsp;The Souled Store, F6 - 202, Bhumi World-Industrial Park, Pimplas Village, Pimplas, Thane, Maharashtra - 421302. Contact: 022-68493328, connect@thesouledstore.com</li>\r\n	<li>Importer &rlm; : &lrm;&nbsp;The Souled Store, F6 - 202, Bhumi World-Industrial Park, Pimplas Village, Pimplas, Thane, Maharashtra - 421302. Contact: 022-68493328, connect@thesouledstore.com</li>\r\n	<li>Item Weight &rlm; : &lrm;&nbsp;500 g</li>\r\n	<li>Item Dimensions LxWxH &rlm; : &lrm;&nbsp;30 x 25 x 3 Centimeters</li>\r\n	<li>Net Quantity &rlm; : &lrm;&nbsp;1.00 count</li>\r\n	<li>Generic Name &rlm; : &lrm;&nbsp;T-Shirt</li>\r\n</ul>\r\n', 3, 'Active', 10, 1500, '2025-03-27 14:41:47', '2025-04-17 11:26:38'),
(20, 'The Souled Store Captain America: Comic Mens Regular Fit Graphic Printed Half Sleeve Cotton Navy Blue Men Utility Shirts', '67e516e2d08516_1.jpg', '67e516e2d086c6_2.jpg,67e516e2d08716_3.jpg,67e516e2d08726_4.jpg,67e516e2d08746_5.jpg', 7, 1500.00, '<ul>\r\n	<li>Product Dimensions &rlm; : &lrm;&nbsp;21 x 22 x 3 cm; 250 g</li>\r\n	<li>Date First Available &rlm; : &lrm;&nbsp;28 July 2023</li>\r\n	<li>Manufacturer &rlm; : &lrm;&nbsp;The Souled Store</li>\r\n	<li>ASIN &rlm; : &lrm;&nbsp;B0CD1NPPTH</li>\r\n	<li>Item model number &rlm; : &lrm;&nbsp;215464</li>\r\n	<li>Country of Origin &rlm; : &lrm;&nbsp;India</li>\r\n	<li>Department &rlm; : &lrm;&nbsp;Men</li>\r\n	<li>Manufacturer &rlm; : &lrm;&nbsp;The Souled Store, The Souled Store, F6 - 202, Bhumi World-Industrial Park, Pimplas Village, Pimplas, Thane, Maharashtra - 421302. Contact: 022-68493328, connect@thesouledstore.com</li>\r\n	<li>Packer &rlm; : &lrm;&nbsp;The Souled Store, F6 - 202, Bhumi World-Industrial Park, Pimplas Village, Pimplas, Thane, Maharashtra - 421302. Contact: 022-68493328, connect@thesouledstore.com</li>\r\n	<li>Importer &rlm; : &lrm;&nbsp;The Souled Store, F6 - 202, Bhumi World-Industrial Park, Pimplas Village, Pimplas, Thane, Maharashtra - 421302. Contact: 022-68493328, connect@thesouledstore.com</li>\r\n	<li>Item Weight &rlm; : &lrm;&nbsp;250 g</li>\r\n	<li>Item Dimensions LxWxH &rlm; : &lrm;&nbsp;21 x 22 x 3 Centimeters</li>\r\n	<li>Net Quantity &rlm; : &lrm;&nbsp;1 Count</li>\r\n	<li>Generic Name &rlm; : &lrm;&nbsp;Shirt</li>\r\n</ul>\r\n', 10, 'Active', 5, 1425, '2025-03-27 14:44:10', '2025-03-27 14:44:10'),
(21, 'ASUS ROG Strix G16 (2023) Gaming Laptop', '67e517d873b2d7_1.jpg', '67e517d873b467_3.jpg,67e517d873b497_4.jpg,67e517d873b4a7_7.jpg,67e517d873b4b7_8.jpg,67e517d873b4c7_5.jpg,67e517d873b4d7_6.jpg,67e517d873b4e7_2.jpg', 6, 160999.00, '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;ASUS</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;ASUS, INVENTEC (CHONGQING) CORPORATION, NO.66, WEST DISTRICT 2ND RD, SHAPINGBA DISTRICT, CHONGQING, CHINA 401331</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Series</th>\r\n			<td>&lrm;ROG Strix G16 (2023)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Eclipse Gray, With Offer</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Form Factor</th>\r\n			<td>&lrm;Gaming Laptop</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Height</th>\r\n			<td>&lrm;44.5 Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Width</th>\r\n			<td>&lrm;10.4 Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Standing screen display size</th>\r\n			<td>&lrm;16 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Screen Resolution</th>\r\n			<td>&lrm;2560 x 1600 pixels</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Resolution</th>\r\n			<td>&lrm;2560 x 1600 Pixels</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;44.5 x 10.4 x 44.5 cm; 2.5 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Batteries</th>\r\n			<td>&lrm;1 Lithium Ion batteries required. (included)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;G614JV-N4141WS_WO</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Processor Brand</th>\r\n			<td>&lrm;Intel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Processor Type</th>\r\n			<td>&lrm;Core i9</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Processor Speed</th>\r\n			<td>&lrm;5.6 GHz</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Processor Count</th>\r\n			<td>&lrm;24</td>\r\n		</tr>\r\n		<tr>\r\n			<th>RAM Size</th>\r\n			<td>&lrm;16 GB</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Memory Technology</th>\r\n			<td>&lrm;SODIMM, SODIMM, SODIMM</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Computer Memory Type</th>\r\n			<td>&lrm;SODIMM</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Memory Supported</th>\r\n			<td>&lrm;32 GB</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Memory Clock Speed</th>\r\n			<td>&lrm;5.6 GHz</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Hard Drive Size</th>\r\n			<td>&lrm;1 TB</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Hard Disk Description</th>\r\n			<td>&lrm;SSD</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Hard Drive Interface</th>\r\n			<td>&lrm;PCIE x 4</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Audio Details</th>\r\n			<td>&lrm;Headphones, Speakers</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Graphics Coprocessor</th>\r\n			<td>&lrm;NVIDIA GeForce RTX 4060</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Graphics Chipset Brand</th>\r\n			<td>&lrm;NVIDIA</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Graphics Card Description</th>\r\n			<td>&lrm;Dedicated</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Graphics RAM Type</th>\r\n			<td>&lrm;GDDR6</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Graphics Card Ram Size</th>\r\n			<td>&lrm;8 GB</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Graphics Card Interface</th>\r\n			<td>&lrm;PCI Express</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Connectivity Type</th>\r\n			<td>&lrm;Bluetooth, Wi-Fi</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Wireless Type</th>\r\n			<td>&lrm;Bluetooth, 802.11ax</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of USB 2.0 Ports</th>\r\n			<td>&lrm;1</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of USB 3.0 Ports</th>\r\n			<td>&lrm;3</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of HDMI Ports</th>\r\n			<td>&lrm;1</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Voltage</th>\r\n			<td>&lrm;20 Volts</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Wattage</th>\r\n			<td>&lrm;280 Watts</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Optical Drive Type</th>\r\n			<td>&lrm;No Optical Storage</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Power Source</th>\r\n			<td>&lrm;Battery Powered</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Hardware Platform</th>\r\n			<td>&lrm;PC</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Operating System</th>\r\n			<td>&lrm;Windows 11 Home</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Are Batteries Included</th>\r\n			<td>&lrm;Yes</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Lithium Ion Cells</th>\r\n			<td>&lrm;4</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>&lrm;Laptop, Adapter &amp; User Manual</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;ASUS</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;2 kg 500 g</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 4, 'Active', 50, 80500, '2025-03-27 14:48:16', '2025-03-27 14:48:16'),
(22, 'MSI Katana A17 AI, AMD 8th Gen. Ryzen 9 8945HS,Built-in AI, 44CM Laptop', '67e518c0615578_1.jpg', '67e518c0615698_7.jpg,67e518c06156d8_2.jpg,67e518c06156e8_5.jpg,67e518c06156f8_3.jpg,67e518c0615708_6.jpg,67e518c0615718_4.jpg', 6, 114999.00, '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;MSI</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;MSI, MICRO-STAR INTERNATIONAL CO., LTDNo.88, East Qianjin Road Kunshan City Jiangsu China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Series</th>\r\n			<td>&lrm;Katana A17 AI</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour</th>\r\n			<td>&lrm;Black</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Form Factor</th>\r\n			<td>&lrm;Laptop</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Height</th>\r\n			<td>&lrm;53 Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Width</th>\r\n			<td>&lrm;33.2 Centimeters</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Standing screen display size</th>\r\n			<td>&lrm;44 Centimetres</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Screen Resolution</th>\r\n			<td>&lrm;1920 x 1080 pixels</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Resolution</th>\r\n			<td>&lrm;1920 x 1080</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;9.2 x 33.2 x 53 cm; 4.65 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Batteries</th>\r\n			<td>&lrm;1 Lithium Polymer batteries required. (included)</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item model number</th>\r\n			<td>&lrm;426230</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Processor Brand</th>\r\n			<td>&lrm;AMD</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Processor Type</th>\r\n			<td>&lrm;Ryzen 9</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Processor Speed</th>\r\n			<td>&lrm;4 GHz</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Processor Count</th>\r\n			<td>&lrm;1</td>\r\n		</tr>\r\n		<tr>\r\n			<th>RAM Size</th>\r\n			<td>&lrm;16</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Memory Technology</th>\r\n			<td>&lrm;DDR5</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Computer Memory Type</th>\r\n			<td>&lrm;DDR5 RAM</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Memory Supported</th>\r\n			<td>&lrm;64 GB</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Memory Clock Speed</th>\r\n			<td>&lrm;5600 MHz</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Hard Drive Size</th>\r\n			<td>&lrm;1 TB</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Hard Disk Description</th>\r\n			<td>&lrm;SSD</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Hard Drive Interface</th>\r\n			<td>&lrm;PCIE x 4</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Hard Disk Rotational Speed</th>\r\n			<td>&lrm;1 RPM</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Audio Details</th>\r\n			<td>&lrm;Headphones</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Graphics Coprocessor</th>\r\n			<td>&lrm;NVIDIA GeForce RTX 4050</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Graphics Chipset Brand</th>\r\n			<td>&lrm;Intel</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Graphics Card Description</th>\r\n			<td>&lrm;Dedicated</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Graphics RAM Type</th>\r\n			<td>&lrm;GDDR6</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Graphics Card Ram Size</th>\r\n			<td>&lrm;6 GB</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Graphics Card Interface</th>\r\n			<td>&lrm;PCI Express</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Connectivity Type</th>\r\n			<td>&lrm;Wi-Fi</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of USB 2.0 Ports</th>\r\n			<td>&lrm;1</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of USB 3.0 Ports</th>\r\n			<td>&lrm;2</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Voltage</th>\r\n			<td>&lrm;230 Volts</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Operating System</th>\r\n			<td>&lrm;Windows 11 Home</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Are Batteries Included</th>\r\n			<td>&lrm;Yes</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Lithium Battery Energy Content</th>\r\n			<td>&lrm;53.5 Watt Hours</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of Lithium Ion Cells</th>\r\n			<td>&lrm;3</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Included Components</th>\r\n			<td>&lrm;Laptop</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;MSI</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;China</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;4 kg 650 g</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 5, 'Active', 50, 57500, '2025-03-27 14:52:08', '2025-03-27 14:52:08'),
(23, 'Samsung 214 cm (85 inches) 8K Ultra HD Smart Neo QLED TV QA85QN900AKXXL (Steel)', '67e51ab06a2369_1.jpg', '67e51ab06a2559_6.jpg,67e51ab06a2599_4.jpg,67e51ab06a25b9_3.jpg,67e51ab06a25c9_2.jpg', 1, 1349990.00, '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Brand</th>\r\n			<td>&lrm;Samsung</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Samsung India Pvt Ltd, Samsung India Pvt Ltd, 180040 7267864 , 1800 5 7267864</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Model Name</th>\r\n			<td>&lrm;QA85QN900AKXXL</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Model Year</th>\r\n			<td>&lrm;2021</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Product Dimensions</th>\r\n			<td>&lrm;34.4 x 187.7 x 114.5 cm; 54.1 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Operating System</th>\r\n			<td>&lrm;Tizen</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Hardware Interface</th>\r\n			<td>&lrm;USB, HDMI</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Tuner Technology</th>\r\n			<td>&lrm;DVB-T2</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Resolution</th>\r\n			<td>&lrm;8K</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Special Features</th>\r\n			<td>&lrm;Smart Remote | Remote With Voice Assistant | Far Field Voice Interaction | Tizen | 100% Color Volume | Supported Applications : Netflix, Amazon Prime, Sony Liv, Zee5, Youtube</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Mounting Hardware</th>\r\n			<td>&lrm;1 LED TV, 2 Table Stand Base, 1 User Manual, 1 Warranty Card, 1 Remote Control</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Number of items</th>\r\n			<td>&lrm;1</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Remote Control Description</th>\r\n			<td>&lrm;One Click Amazon Prime Video Button Remote | Bixby | Alexa |</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Remote control technology</th>\r\n			<td>&lrm;IR</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Display Technology</th>\r\n			<td>&lrm;QLED</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Standing screen display size</th>\r\n			<td>&lrm;85 Inches</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Display Type</th>\r\n			<td>&lrm;HDR10+</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Colour Screen</th>\r\n			<td>&lrm;Yes</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Viewing Angle</th>\r\n			<td>&lrm;178 Degrees</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Image Aspect Ratio</th>\r\n			<td>&lrm;16:09</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Aspect Ratio</th>\r\n			<td>&lrm;16:9</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Screen Resolution</th>\r\n			<td>&lrm;7680 x 4320</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Resolution</th>\r\n			<td>&lrm;7680 x 4320 Pixels</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Audio input compatible with the item</th>\r\n			<td>&lrm;Auxiliary</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Audio output mode</th>\r\n			<td>&lrm;Surround</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Supported audio formats</th>\r\n			<td>&lrm;mp3_audio, wma</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Speaker Surround Sound Channel Configuration</th>\r\n			<td>&lrm;Dolby Digital Plus</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Audio Wattage</th>\r\n			<td>&lrm;80 Watts</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Wattage</th>\r\n			<td>&lrm;80 Watts</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Power Source</th>\r\n			<td>&lrm;AC</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Batteries Required</th>\r\n			<td>&lrm;No</td>\r\n		</tr>\r\n		<tr>\r\n			<th>GSM frequencies</th>\r\n			<td>&lrm;120 Hz</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Refresh Rate</th>\r\n			<td>&lrm;120 Hz</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Total USB ports</th>\r\n			<td>&lrm;3</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Connector Type</th>\r\n			<td>&lrm;Wi-Fi, USB, Ethernet, HDMI</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Maximum Operating Distance</th>\r\n			<td>&lrm;9 Feet</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Mounting Type</th>\r\n			<td>&lrm;Wall Mount &amp; Table Mount</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Includes remote</th>\r\n			<td>&lrm;Yes</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Supports Bluetooth Technology</th>\r\n			<td>&lrm;Yes</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Manufacturer</th>\r\n			<td>&lrm;Samsung India Pvt Ltd</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Country of Origin</th>\r\n			<td>&lrm;Vietnam</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Item Weight</th>\r\n			<td>&lrm;54 kg 100 g</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 3, 'Active', 50, 674995, '2025-03-27 15:00:24', '2025-03-27 15:00:24'),
(24, 'P.C. Chandra Jewellers 22k (916) Metal Yellow Gold Necklace for Women', '67e51b9ee3bfc10_1.jpg', '67e51b9ee3c0a10_2.jpg,67e51b9ee3c0c10_3.jpg,67e51b9ee3c0d10_4.jpg', 2, 99999.99, '<ul>\r\n	<li>Package Dimensions &rlm; : &lrm;&nbsp;25 x 15 x 10 cm; 10.23 g</li>\r\n	<li>Date First Available &rlm; : &lrm;&nbsp;11 September 2019</li>\r\n	<li>ASIN &rlm; : &lrm;&nbsp;B07XS8RH4Q</li>\r\n	<li>Item part number &rlm; : &lrm;&nbsp;GLN 683</li>\r\n	<li>Department &rlm; : &lrm;&nbsp;Women</li>\r\n	<li>Item Weight &rlm; : &lrm;&nbsp;10.2 g</li>\r\n	<li>Net Quantity &rlm; : &lrm;&nbsp;1 count</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Best Sellers Rank:&nbsp;#19,032 in Jewellery (<a href=\"https://www.amazon.in/gp/bestsellers/jewelry/ref=pd_zg_ts_jewelry\">See Top 100 in Jewellery</a>)</li>\r\n</ul>\r\n', 2, 'Active', 20, 80000, '2025-03-27 15:04:22', '2025-03-27 15:04:22');

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
(1, 'Janki', 'Kansagra', 'jankikansagra12@gmail.com', 8155825235, 'Pratyush@1234', '1.jpeg', 'Admin', 'Active', '0000-00-00 00:00:00'),
(3, 'Janki', 'Kansagra', 'janki.kansagra@rku.ac.in', 8155825235, 'Janki@123456', '2.jpeg', 'User', 'Active', '0000-00-00 00:00:00'),
(4, 'Janki', 'Kansagra', 'pratyushf31@northstar.edu.in', 9437987804, 'Janki@123456', '3.jpeg', 'User', 'Active', '0000-00-00 00:00:00'),
(5, 'Janki', 'Kansagra', 'denishfaldu@gmail.com', 8155825235, 'Janki@123', '4.jpeg', 'User', 'Inactive', '1741196706'),
(9, 'Janki', 'Kansagra', 'kansagrajanki@gmail.com', 9347987804, 'Janki@123', '5.jpeg', 'User', 'Active', ''),
(11, 'NAnera', 'Punit', 'pnanera073@rku.ac.in', 8528528523, 'Punit@1234', '6.jpeg', 'User', 'Active', ''),
(13, 'Nisha', 'Kukadiya', 'nisha.kukadiya@rku.ac.in', 1231231234, 'Nisha@1234', '7.jpeg', 'User', 'Inactive', '67c947d2a38631741244370'),
(14, 'Kirtan', 'Poshiya', 'kposhiya476@rku.ac.in', 8528528526, 'Kirtan@1234', '8.jpeg', 'User', 'Active', '67ce76f2d1ed71741584114'),
(16, 'Janki', 'Kansagra', 'abcdef@gmail.com', 1478523691, 'JAnki@12345', '67ed6dcf5b3dd12.jpeg', 'Admin', 'Inactive', '67eb92a93fdd61743491753'),
(17, 'Pratyush', 'Faldu', 'pratyush@gmail.com', 8956741230, 'Pratyush@1234', '11.jpeg', 'Admin', 'Active', '67ebe9f79f3f91743514103');

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
(5, 'Product_of_the_Year_USA_2017_Winners.jpg'),
(7, '9_1.jpg');

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
(7, 'abcdef@gmail.com', 17, '2025-04-01 12:51:28', '2025-04-01 12:51:28'),
(9, 'janki.kansagra@rku.ac.in', 18, '2025-04-01 15:33:04', '2025-04-01 15:33:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email_Foreign_key` (`user_email`);

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
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contact_inquiry`
--
ALTER TABLE `contact_inquiry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `password_token`
--
ALTER TABLE `password_token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `user_email_Foreign_key` FOREIGN KEY (`user_email`) REFERENCES `registration` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

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
