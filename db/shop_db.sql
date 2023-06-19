-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 19, 2023 at 06:17 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'computing', 'Laptops, Tablets, Monitors, PC, Components, Gaming Consoles, Wi-Fi, Keyboards...', '2023-03-30 17:16:46', '2023-05-22 12:37:42'),
(2, 'cooker', 'Here is cookers description...', '2023-03-30 17:16:46', '2023-05-22 12:40:49'),
(3, 'gadget', 'Here is gadgets description...', '2023-03-30 17:16:46', '2023-05-22 12:41:59'),
(4, 'microwave', 'Here is microwaves description...', '2023-03-30 17:16:46', '2023-05-22 12:41:08'),
(5, 'refrigerator', 'Here is refrigerators description...', '2023-03-30 17:16:46', '2023-05-22 12:41:17'),
(6, 'vacuum cleaner', 'Here is vacuum cleaners description...', '2023-03-30 17:16:46', '2023-05-22 12:41:26'),
(7, 'washing machine', 'Here is washing machines description...', '2023-03-30 17:16:46', '2023-05-22 12:41:38'),
(8, 'TV', 'Here is TVs description...', '2023-05-22 12:42:44', '2023-05-22 12:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id_customer` int NOT NULL,
  `id_status` int DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `login` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id_customer`, `id_status`, `first_name`, `last_name`, `phone`, `email`, `login`, `password`, `created_at`, `updated_at`) VALUES
(1, 13, 'Leandra', 'Farmer', 134770523, 'vitae.purus@aol.com', 'Gray', '18', '2023-03-30 17:18:17', '2023-04-15 08:01:47'),
(2, 12, 'Chastity', 'Mcgowan', 140693186, 'id.nunc@icloud.org', 'Jonah', '12', '2023-03-30 17:18:17', '2023-04-15 08:02:00'),
(3, 12, 'Gregory', 'Eaton', 163703770, 'a.feugiat.tellus@google.ca', 'Astra', '14', '2023-03-30 17:18:17', '2023-04-15 08:02:20'),
(4, 13, 'McKenzie', 'Key', 165163170, 'duis.mi.enim@outlook.org', 'Nina', '16', '2023-03-30 17:18:17', '2023-04-15 08:06:13'),
(5, 13, 'Regina', 'Stewart', 124937449, 'sagittis.lobortis@protonmail.net', 'Macon', '14', '2023-03-30 17:18:17', '2023-04-15 08:06:13'),
(6, 12, 'Emi', 'Glass', 150825084, 'facilisis.lorem@protonmail.net', 'Baxter', '13', '2023-03-30 17:18:17', '2023-04-15 08:06:47'),
(7, 13, 'Erich', 'Gentry', 178912401, 'gravida.praesent@hotmail.edu', 'Astra', '15', '2023-03-30 17:18:17', '2023-04-15 08:07:20'),
(8, 12, 'Lionel', 'Stevenson', 126572749, 'adipiscing.fringilla.porttitor@google.net', 'Xandra', '14', '2023-03-30 17:18:17', '2023-03-30 17:18:17'),
(9, 13, 'Basia', 'Skinner', 147864868, 'sed@google.couk', 'Katell', '12', '2023-03-30 17:18:17', '2023-04-15 08:06:13'),
(10, 12, 'Rhoda', 'Myers', 194941584, 'euismod.et@icloud.com', 'Davis', '19', '2023-03-30 17:18:17', '2023-04-15 08:06:47'),
(11, 12, 'Janna', 'Glenn', 168453083, 'auctor.ullamcorper@yahoo.org', 'Hermione', '20', '2023-03-30 17:18:17', '2023-04-15 08:06:47'),
(12, 12, 'Drake', 'Bowman', 100736976, 'sed.eu@protonmail.net', 'Hyacinth', '20', '2023-03-30 17:18:17', '2023-04-15 08:06:47'),
(13, 12, 'Kim', 'Lewis', 116047257, 'eget.laoreet@protonmail.couk', 'Benjamin', '19', '2023-03-30 17:18:17', '2023-04-15 08:06:47'),
(14, 12, 'Desirae', 'Martinez', 111358174, 'ipsum.leo.elementum@aol.org', 'Ella', '12', '2023-03-30 17:18:17', '2023-04-15 08:06:47'),
(15, 12, 'Ignatius', 'Irwin', 142441690, 'scelerisque.lorem@yahoo.edu', 'Hammett', '16', '2023-03-30 17:18:17', '2023-03-30 17:18:17'),
(16, 12, 'Echo', 'Harrell', 181034059, 'netus.et@yahoo.com', 'Iris', '15', '2023-03-30 17:18:17', '2023-03-30 17:18:17'),
(17, 12, 'Suki', 'Soto', 182176927, 'a@google.couk', 'Indira', '17', '2023-03-30 17:18:17', '2023-04-15 08:06:47'),
(18, 13, 'Todd', 'Wall', 190069000, 'at@yahoo.org', 'Ezra', '19', '2023-03-30 17:18:17', '2023-04-15 08:06:13'),
(19, 12, 'Morgan', 'Perkins', 161398439, 'id@outlook.couk', 'Kasimir', '20', '2023-03-30 17:18:17', '2023-03-30 17:18:17'),
(20, 13, 'Howard', 'Mcneil', 176821336, 'amet.lorem.semper@google.org', 'Colton', '15', '2023-03-30 17:18:17', '2023-04-15 08:06:13'),
(22, 13, 'Leonard', 'Hoffstatter', 144733521, 'leon.hoff@mail.com', 'Leon', '21', '2023-04-10 07:22:11', '2023-04-15 08:06:13'),
(23, 13, 'Eaton', 'Cash', 61, 'serujesu@mailinator.com', NULL, NULL, '2023-06-06 17:26:37', '2023-06-06 17:26:37'),
(24, 13, 'Eaton', 'Cash', 61, 'serujesu@mailinator.com', NULL, NULL, '2023-06-06 17:27:06', '2023-06-06 17:27:06'),
(25, 13, 'Eaton', 'Cash', 61, 'serujesu@mailinator.com', NULL, NULL, '2023-06-06 17:27:32', '2023-06-06 17:27:32'),
(26, 13, 'Graham', 'Valencia', 38, 'doroqasy@mailinator.com', NULL, NULL, '2023-06-06 17:27:58', '2023-06-06 17:27:58'),
(27, 13, 'Plato', 'Fernandez', 40, 'kari@mailinator.com', NULL, NULL, '2023-06-06 17:28:09', '2023-06-06 17:28:09'),
(28, 13, 'Yvonne', 'Sanders', 91, 'jyjerugy@mailinator.com', NULL, NULL, '2023-06-07 12:32:24', '2023-06-07 12:32:24'),
(29, 13, 'Isadora', 'Meyer', 1703573228, 'hycecoponu@mailinator.com', NULL, NULL, '2023-06-07 12:39:17', '2023-06-07 12:39:17'),
(30, 13, 'Ori', 'Ewing', 1234567890, 'dypa@mailinator.com', NULL, NULL, '2023-06-07 12:41:49', '2023-06-07 12:41:49'),
(31, 13, 'Serena', 'Stein', 1234567890, 'jeraxadu@mailinator.com', NULL, NULL, '2023-06-07 14:59:22', '2023-06-07 14:59:22'),
(32, 13, 'Berk', 'Ruiz', 1234567890, 'vuboga@mailinator.com', NULL, NULL, '2023-06-07 15:02:28', '2023-06-07 15:02:28'),
(33, 13, 'September', 'Rosario', 1, 'renexybyhy@mailinator.com', NULL, NULL, '2023-06-07 15:04:39', '2023-06-14 10:47:57'),
(34, 13, 'Alana', 'Rhodes', 234567890, 'pasyze@mailinator.com', NULL, NULL, '2023-06-07 15:07:18', '2023-06-12 16:00:57'),
(36, 13, 'Isabelle', 'Burks', 1234567890, 'vefarewow@mailinator.com', NULL, NULL, '2023-06-07 15:08:40', '2023-06-07 15:08:40'),
(37, 13, 'Fleur', 'Mathis', 987654321, 'bufodi@mailinator.com', NULL, NULL, '2023-06-07 17:55:54', '2023-06-07 17:55:54'),
(38, 13, 'Rigel', 'Sexton', 1234567890, 'qigysydov@mailinator.com', NULL, NULL, '2023-06-08 15:40:24', '2023-06-08 15:40:24'),
(39, 13, 'Shelley', 'Nolan', 1234562890, 'byfep@mailinator.com', NULL, NULL, '2023-06-09 09:08:31', '2023-06-13 16:43:54'),
(40, 13, 'Andrew', 'Wood', 1357924680, 'pagup@mailinator.com', NULL, NULL, '2023-06-09 19:20:27', '2023-06-09 19:20:27'),
(41, 13, 'Desiree', 'Olsen', 1234467456, 'fubuh@mailinator.com', NULL, NULL, '2023-06-10 16:01:44', '2023-06-10 16:01:44'),
(43, 13, 'Chloe', 'Carey', 123456789, 'zimiketude@mailinator.com', 'Chloe', '$2y$12$w8LPo4LzKGfC5Y2vENDqRez7oUIAIPFv9.a7J5UfIPj1SMG64ffim', '2023-06-13 12:34:25', '2023-06-16 10:47:56'),
(44, 13, 'Maisie', 'Kirk', 58, 'mumogyvub@mailinator.com', NULL, NULL, '2023-06-16 09:30:09', '2023-06-16 09:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int NOT NULL,
  `id_user` int NOT NULL,
  `id_customer` int NOT NULL,
  `id_product` int NOT NULL,
  `id_status` int DEFAULT NULL,
  `total_price` float NOT NULL,
  `total_quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `id_customer`, `id_product`, `id_status`, `total_price`, `total_quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 17, 2, 67, 10000, 4, '2023-03-30 17:18:27', '2023-06-10 15:59:21'),
(2, 2, 2, 4, 67, 12000, 4, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(3, 2, 6, 3, 67, 6000, 3, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(4, 3, 13, 3, 67, 6000, 3, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(5, 3, 13, 5, 67, 7000, 2, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(6, 3, 3, 5, 67, 10500, 3, '2023-03-30 17:18:27', '2023-06-10 11:21:43'),
(7, 2, 6, 4, 67, 15000, 5, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(8, 2, 3, 7, 67, 2000, 2, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(9, 2, 16, 6, 67, 3600, 3, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(10, 3, 19, 8, 67, 6000, 4, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(11, 2, 17, 5, 67, 14000, 4, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(12, 1, 12, 2, 67, 10000, 4, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(13, 2, 16, 7, 67, 5000, 5, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(14, 2, 15, 10, 67, 6000, 2, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(15, 2, 16, 6, 67, 2400, 2, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(16, 3, 14, 7, 67, 4000, 4, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(17, 2, 19, 7, 67, 2000, 2, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(18, 2, 11, 11, 67, 6000, 4, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(19, 2, 16, 6, 67, 3600, 3, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(20, 2, 11, 11, 67, 1500, 1, '2023-03-30 17:18:27', '2023-06-09 08:39:23'),
(21, 2, 10, 9, 66, 4000, 1, '2023-03-30 17:18:27', '2023-06-09 09:52:05'),
(22, 2, 10, 8, 66, 3000, 2, '2023-03-30 17:18:27', '2023-06-09 09:52:05'),
(23, 1, 8, 11, 66, 4500, 3, '2023-03-30 17:18:27', '2023-06-09 09:52:05'),
(24, 3, 16, 6, 66, 2400, 2, '2023-03-30 17:18:27', '2023-06-09 09:52:05'),
(25, 3, 17, 2, 66, 12500, 5, '2023-03-30 17:18:27', '2023-06-09 09:52:05'),
(26, 3, 15, 9, 66, 4000, 1, '2023-03-30 17:18:27', '2023-06-09 09:52:05'),
(27, 1, 10, 1, 66, 10000, 2, '2023-03-30 17:18:27', '2023-06-09 09:52:05'),
(28, 2, 10, 2, 66, 10000, 4, '2023-03-30 17:18:27', '2023-06-09 09:52:05'),
(29, 2, 14, 8, 66, 6000, 4, '2023-03-30 17:18:27', '2023-06-09 09:52:05'),
(30, 3, 15, 7, 66, 2000, 2, '2023-03-30 17:18:27', '2023-06-09 09:52:05'),
(41, 6, 13, 2, 68, 5200, 2, '2023-06-07 12:39:17', '2023-06-09 10:41:02'),
(42, 6, 13, 1, 68, 5000, 1, '2023-06-07 12:39:17', '2023-06-09 10:42:21'),
(43, 7, 13, 3, 68, 6000, 3, '2023-06-07 12:39:17', '2023-06-09 10:47:23'),
(44, 7, 30, 6, 65, 2400, 2, '2023-06-07 12:41:49', '2023-06-09 20:07:48'),
(45, 7, 30, 7, 65, 3000, 3, '2023-06-07 12:41:49', '2023-06-09 20:10:55'),
(46, 8, 36, 1, 67, 5000, 1, '2023-06-07 15:08:40', '2023-06-09 20:19:39'),
(47, 8, 36, 2, 66, 5200, 2, '2023-06-07 15:08:40', '2023-06-09 20:19:28'),
(48, 8, 37, 4, 66, 2500, 1, '2023-06-07 17:55:54', '2023-06-09 20:19:19'),
(49, 1, 38, 7, 65, 1000, 1, '2023-06-08 15:40:24', '2023-06-08 15:40:24'),
(50, 1, 38, 37, 65, 600, 2, '2023-06-08 15:40:24', '2023-06-08 15:40:24'),
(51, 1, 38, 43, 65, 6500, 1, '2023-06-08 15:40:24', '2023-06-08 15:40:24'),
(52, 1, 39, 11, 65, 3000, 2, '2023-06-09 09:08:31', '2023-06-09 09:08:31'),
(53, 1, 40, 4, 65, 2500, 1, '2023-06-09 19:20:27', '2023-06-09 19:20:27'),
(54, 1, 41, 1, 65, 5000, 1, '2023-06-10 16:01:44', '2023-06-10 16:01:44'),
(55, 1, 41, 2, 65, 5200, 2, '2023-06-10 16:01:44', '2023-06-10 16:01:44'),
(57, 1, 34, 10, 65, 3000, 1, '2023-06-12 16:00:57', '2023-06-12 16:00:57'),
(58, 1, 31, 11, 65, 1500, 1, '2023-06-12 16:02:09', '2023-06-12 16:02:09'),
(59, 8, 44, 3, 65, 2000, 1, '2023-06-16 09:30:09', '2023-06-16 10:48:10'),
(60, 8, 43, 7, 65, 1000, 1, '2023-06-16 09:33:14', '2023-06-16 10:48:14'),
(61, 8, 43, 4, 65, 5000, 2, '2023-06-16 09:35:58', '2023-06-16 10:48:18'),
(62, 8, 43, 1, 65, 5000, 1, '2023-06-16 10:47:56', '2023-06-16 10:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id_price` int NOT NULL,
  `id_product` int NOT NULL,
  `id_status` int DEFAULT NULL,
  `price` float DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id_price`, `id_product`, `id_status`, `price`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 5000, 1, '2023-03-30 17:18:33', '2023-06-05 09:04:15'),
(2, 2, 2, 2600, 1, '2023-03-30 17:18:33', '2023-06-05 09:10:30'),
(3, 3, 2, 2000, 1, '2023-03-30 17:18:33', '2023-06-05 09:07:19'),
(4, 4, 2, 3000, 0, '2023-03-30 17:18:33', '2023-06-05 08:10:35'),
(5, 5, 2, 3500, 1, '2023-03-30 17:18:33', '2023-06-05 09:05:03'),
(6, 6, 3, 1200, 1, '2023-03-30 17:18:33', '2023-06-05 09:05:29'),
(7, 7, 2, 1000, 1, '2023-03-30 17:18:33', '2023-06-05 09:05:46'),
(8, 8, 2, 2000, 0, '2023-03-30 17:18:33', '2023-06-05 08:11:03'),
(9, 9, 2, 4000, 1, '2023-03-30 17:18:33', '2023-06-05 09:10:51'),
(10, 10, 2, 3000, 1, '2023-03-30 17:18:33', '2023-06-12 15:52:25'),
(11, 11, 2, 1500, 1, '2023-03-30 17:18:33', '2023-06-05 09:06:53'),
(12, 1, 2, 6000, 0, '2023-04-11 16:40:51', '2023-06-03 16:44:19'),
(13, 8, 3, 1500, 1, '2023-04-11 16:42:13', '2023-06-05 08:11:03'),
(14, 4, 3, 2500, 1, '2023-04-11 16:42:13', '2023-06-05 08:10:36'),
(15, 4, 1, 2000, 0, '2023-04-11 16:42:13', '2023-06-05 08:10:36'),
(44, 37, 2, 4000, 0, '2023-05-24 13:22:08', '2023-06-11 14:03:11'),
(47, 40, 2, 600, 0, '2023-05-26 09:24:09', '2023-06-17 16:35:25'),
(48, 40, 3, 500, 1, '2023-05-26 09:24:48', '2023-06-17 16:35:25'),
(51, 43, 2, 6400, 0, '2023-06-05 08:58:07', '2023-06-17 17:26:07'),
(52, 37, 3, 3750, 1, '2023-06-11 14:03:09', '2023-06-11 14:03:11'),
(53, 43, 3, 6000, 1, '2023-06-11 14:08:36', '2023-06-17 17:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int NOT NULL,
  `id_status` int DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `description` text,
  `main_image` text,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `id_status`, `name`, `description`, `main_image`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 4, 'HP 205', 'Desktop PC', 'HP 205.jpeg', 100, '2023-03-30 17:18:41', '2023-06-05 09:04:15'),
(2, 5, 'Dell G15', 'Laptop', 'Dell G15.jpeg', 200, '2023-03-30 17:18:41', '2023-06-05 09:04:32'),
(3, 5, 'Asus ROG Strix', 'Tablet', 'Asus ROG Strix.jpeg', 200, '2023-03-30 17:18:41', '2023-06-05 09:04:54'),
(4, 4, 'Electrolux LKI 6', 'Gas cooker', 'Electrolux LKI 6.gif', 150, '2023-03-30 17:18:41', '2023-05-23 12:14:06'),
(5, 6, 'Beko FSG 5', 'Electric cooker', 'Beko FSG 5.jpeg', 150, '2023-03-30 17:18:41', '2023-06-05 09:05:03'),
(6, 4, 'iPhone 14', 'Phone', 'iPhone 14.jpeg', 300, '2023-03-30 17:18:41', '2023-06-05 09:05:29'),
(7, 5, 'Samsung Galaxy S22', 'Phone', 'Samsung Galaxy S22.jpeg', 300, '2023-03-30 17:18:41', '2023-06-05 09:05:46'),
(8, 5, 'Panasonic NNGT', 'Microwave from Panasonic.', 'Panasonic NNGT.jpeg', 200, '2023-03-30 17:18:41', '2023-05-19 11:48:24'),
(9, 4, 'Bosh KGN3', 'Refrigerator', 'Bosh KGN3.jpeg', 100, '2023-03-30 17:18:41', '2023-06-05 09:06:24'),
(10, 4, 'Whirlpool FFB', 'Washing Machine', 'Whirlpool FFB.jpeg', 100, '2023-03-30 17:18:41', '2023-06-12 15:52:25'),
(11, 6, 'Philips SpeedPro', 'Vacuum cleaner', 'Philips SpeedPro.jpeg', 150, '2023-03-30 17:18:41', '2023-06-05 09:06:53'),
(37, 5, 'Beko FSG 6', 'Fridge description', 'Beko FSG.jpeg', 100, '2023-05-24 13:22:08', '2023-06-11 14:02:31'),
(40, 6, 'Samsung TV', 'This is TV from Samsung', 'Samsung TV.jpeg', 100, '2023-05-26 09:24:09', '2023-06-17 16:35:25'),
(43, 4, 'HP 206', 'Desktop PC', 'HP 206.jpeg', 70, '2023-06-05 08:58:07', '2023-06-11 14:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `id_product_category` int NOT NULL,
  `id_category` int NOT NULL,
  `id_product` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`id_product_category`, `id_category`, `id_product`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-03-30 17:18:55', '2023-03-30 17:18:55'),
(2, 1, 2, '2023-03-30 17:18:55', '2023-03-30 17:18:55'),
(3, 1, 3, '2023-03-30 17:18:55', '2023-03-30 17:18:55'),
(4, 2, 4, '2023-03-30 17:18:55', '2023-03-30 17:18:55'),
(5, 2, 5, '2023-03-30 17:18:55', '2023-03-30 17:18:55'),
(6, 3, 6, '2023-03-30 17:18:55', '2023-03-30 17:18:55'),
(7, 3, 7, '2023-03-30 17:18:55', '2023-03-30 17:18:55'),
(8, 4, 8, '2023-03-30 17:18:55', '2023-03-30 17:18:55'),
(9, 5, 9, '2023-03-30 17:18:55', '2023-03-30 17:18:55'),
(10, 7, 10, '2023-03-30 17:18:55', '2023-03-30 17:18:55'),
(11, 6, 11, '2023-03-30 17:18:55', '2023-03-30 17:18:55'),
(17, 5, 37, '2023-05-24 13:22:08', '2023-06-05 08:54:32'),
(20, 8, 40, '2023-05-26 09:24:09', '2023-06-17 16:35:13'),
(22, 1, 43, '2023-06-05 08:58:07', '2023-06-05 08:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id_status` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `category` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id_status`, `name`, `category`, `created_at`, `updated_at`) VALUES
(1, 'wholesale', 'price', '2023-03-30 17:19:05', '2023-05-04 19:09:39'),
(2, 'retail', 'price', '2023-03-30 17:19:05', '2023-05-04 19:10:03'),
(3, 'discount', 'price', '2023-03-30 17:19:05', '2023-05-04 19:10:13'),
(4, 'available', 'product', '2023-03-30 17:19:05', '2023-05-04 19:10:33'),
(5, 'ordered', 'product', '2023-03-30 17:19:05', '2023-05-04 19:10:57'),
(6, 'cancel', 'product', '2023-03-30 17:19:05', '2023-06-16 10:29:56'),
(7, 'sold', 'product', '2023-03-30 17:19:05', '2023-05-04 19:11:30'),
(8, 'sold out', 'product', '2023-03-30 17:19:05', '2023-05-04 19:11:48'),
(9, 'super_admin', 'user', '2023-03-30 17:19:05', '2023-05-04 19:13:29'),
(10, 'admin', 'user', '2023-03-30 17:19:05', '2023-05-04 19:13:57'),
(11, 'seller', 'user', '2023-03-30 17:19:05', '2023-05-04 19:14:02'),
(12, 'customer', 'customer', '2023-03-30 17:19:05', '2023-05-06 16:27:42'),
(13, 'customer_new', 'customer', '2023-03-30 17:19:05', '2023-05-06 16:31:28'),
(36, 'customer_old', 'customer', '2023-05-06 16:39:30', '2023-05-11 15:09:05'),
(38, 'user_old', 'user', '2023-05-12 15:13:06', '2023-05-12 15:13:06'),
(39, 'user_older', 'user', '2023-05-12 15:16:03', '2023-05-12 15:16:03'),
(40, 'user_oldest', 'user', '2023-05-12 15:22:51', '2023-05-18 12:03:38'),
(65, 'new_order', 'order', '2023-06-06 15:42:16', '2023-06-15 17:02:45'),
(66, 'processed', 'order', '2023-06-06 15:42:57', '2023-06-06 15:42:57'),
(67, 'completed', 'order', '2023-06-08 15:42:24', '2023-06-08 15:42:24'),
(68, 'canceled', 'order', '2023-06-08 15:42:29', '2023-06-08 15:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id_sub_category` int NOT NULL,
  `id_category` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id_sub_category`, `id_category`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'desktop', 'This is desktops description...', '2023-03-30 17:19:15', '2023-05-22 12:59:29'),
(2, 1, 'laptop', 'This is laptops description...', '2023-03-30 17:19:15', '2023-05-22 12:59:37'),
(3, 1, 'tablet', 'This is tablets description...', '2023-03-30 17:19:15', '2023-05-22 12:59:44'),
(4, 2, 'gas cooker', 'This is gas cookers description...', '2023-03-30 17:19:15', '2023-05-22 12:59:55'),
(5, 2, 'electric cooker', 'This is electric cookers description...', '2023-03-30 17:19:15', '2023-05-22 13:00:07'),
(6, 3, 'phone', 'This is phones description...', '2023-03-30 17:19:15', '2023-05-22 13:00:16'),
(7, 3, 'headphones', 'This is headphones description...', '2023-03-30 17:19:15', '2023-05-22 13:00:44'),
(8, 3, 'powerbank', 'This is powerbanks description...', '2023-03-30 17:19:15', '2023-05-22 13:00:51'),
(9, 5, 'fridge', 'This is fridges description... ', '2023-03-30 17:19:15', '2023-05-22 13:01:02'),
(10, 5, 'freezer', 'This is freezers description... ', '2023-03-30 17:19:15', '2023-05-22 13:01:09'),
(13, 1, 'wi-fi', 'This is wi-fi description', '2023-05-22 15:04:01', '2023-05-22 15:05:56'),
(14, 3, 'Watch', 'This is watch description', '2023-05-22 15:04:44', '2023-05-31 13:43:01'),
(18, 8, 'NotSmart TV', 'Any TV is NOT smart, you know, right?', '2023-05-26 09:22:23', '2023-05-26 09:22:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `id_status` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_status`, `first_name`, `last_name`, `phone`, `email`, `login`, `password`, `created_at`, `updated_at`) VALUES
(1, 10, 'Mr', 'Smith', 1234567891, 'mrsmith@mail.com', 'mrsmith', '1', '2023-03-30 17:19:19', '2023-04-15 07:53:26'),
(2, 11, 'John', 'Doe', 1234567892, 'johndoe@mail.com', 'johndoe', '2', '2023-03-30 17:19:19', '2023-04-15 07:53:33'),
(3, 11, 'Jane', 'Doe', 1234567893, 'janedoe@mail.com', 'janedoe', '3', '2023-03-30 17:19:19', '2023-04-16 15:49:41'),
(6, 11, 'Brian', 'Workman', 1522685828, 'becinaka@mailinator.com', 'Etodioquisaepeni', '$2y$12$D6GuKcdD5aKAoB1AJfTEeux11ve6PSHxQQxx8v/cq/MW/1LB1P8IG', '2023-04-17 12:54:23', '2023-04-17 12:54:23'),
(7, 10, 'Autumn', 'Freeman', 1596805772, 'tudeloc@mailinator.com', 'mrs_smith', '$2y$12$SFkNDgJvPSrirlMJFAaHIeXzVM6jVurZ7m2FbHXmLz.5zwSjNYSMq', '2023-04-17 14:33:18', '2023-06-13 12:31:39'),
(8, 9, 'Oleksandr', 'Hutsaliuk', 1234567890, 'olex@mail.com', 'Olex', '$2y$12$hY7Gh9PVxtZjAXOd6yKG.OElqPW1B95ClTXuCtUqQRrBVT8CfNCxW', '2023-04-18 10:58:50', '2023-04-18 10:58:50'),
(9, 10, 'Spring', 'Freeman', 1137266808, 'fomu@mailinator.com', 'mr_smith', '$2y$12$J00ujk1CFnHLZ/eUaWsQa.KMvdA8vHSfWd0/JgXzk8CwWyE/mqI.y', '2023-04-18 11:03:21', '2023-04-18 11:03:21'),
(10, 11, 'Stewart', 'Suarez', 1159524784, 'fyribu@mailinator.com', 'Nonfugia', '$2y$12$gmfyp6Iilago/n0R/WFrIeaI2/zSR3c44xZkUep5tpez5Sb8nVKH6', '2023-04-20 11:12:04', '2023-04-20 11:12:04'),
(13, 11, 'Ira', 'Roberson', 1256347834, 'xikidory@mailinator.com', 'Est-illo_qui', '$2y$12$Ytg0Rp9DtFBFHvmECY4j..eE.9Xz0t8TntI3vESEZblcNAO8O45oi', '2023-04-22 09:13:40', '2023-04-22 09:13:40'),
(14, 11, 'Jane', 'Winters', 1134534534, 'bubu@mailinator.com', 'Inuciana', '$2y$12$qaQFtDAIdY5xUtiqTgHGx.su4a1dYcPi.TRTd/UABUXlBAq6JqMDC', '2023-04-24 14:31:44', '2023-04-24 14:31:44'),
(15, 11, 'Alix', 'Vance', 1357924680, 'dolly@mail.com', 'Doloress', '$2y$12$O6jojU86J5rO0nfPqft85uXDK.m7HXkrqhCXGFgxa.7ZHeqpR8D6K', '2023-04-27 10:45:46', '2023-04-27 10:45:46'),
(16, 11, 'Cara', 'Freeman', 1369258470, 'wojabyrur@mailinator.com', 'Sharlotta', '$2y$12$ofoaKNHAIeiZ56/TpT2PGeXRj5Ztq8YdhDVeqSbQGqof07/h/Dnzq', '2023-04-27 10:56:21', '2023-04-27 10:56:21'),
(17, 11, 'Louis', 'Tyson', 1470258369, 'wyjivu@mailinator.com', 'Recusand', '$2y$12$lAWavmjammafCrVun67Cm.jAVTDGgCTpNxkw4zbZwAEnqiVz5OMmO', '2023-04-27 11:11:42', '2023-04-27 11:11:42'),
(18, 11, 'Bethany', 'Harris', 1234567890, 'sivyloziti@mailinator.com', 'Explicabo', '$2y$12$WPsU8JWoSa9VDzU3BBCYHeKjm0YnbRKkgm6n6mbVzKrRaTvRbwHZW', '2023-04-27 11:15:01', '2023-04-27 11:15:01'),
(19, 11, 'Orla', 'Duke', 1234567890, 'orla@mailinator.com', 'Orllanda', '$2y$12$mCcYJ0QgRfRLdDTm9z6f7uoKHvc90JiqFN9b44RA.E6bk67X19XzG', '2023-04-27 12:02:54', '2023-04-27 12:02:54'),
(21, 11, 'Illana', 'Stokes', 1234567890, 'consequatur@mailinator.com', 'Consequatur', '$2y$12$SoDU5NlEBsWq59gmEr2j3.37yFd394jcZ5zYsBk57IYBGHQ6oQGBO', '2023-04-27 13:46:16', '2023-04-27 13:46:16'),
(22, 11, 'Cailin', 'Alvarado', 1234567890, 'xydidadu@mailinator.com', 'Doloribus', '$2y$12$HOInrdSQOq4NO08luk6.OeL81FyyBsvflsEzwssym7asARICMmUue', '2023-04-27 16:10:06', '2023-04-27 16:10:06'),
(25, 11, 'Vivien', 'Wood', 1823456789, 'zifexijy@mailinator.com', 'Hicducimus', '$2y$12$GDnnSZoY5Hrc7l6mzIzc3.51qYD/E6icQNrUEG0sC9hfiL8.4X0Tq', '2023-05-01 14:22:55', '2023-06-13 12:31:04'),
(26, 11, 'Jared', 'Waters', 1234567890, 'lijenim@mailinator.com', 'Enimsitani', '$2y$12$Z.5w6rR/ePrLIaFIIn6TFeFR3bGcuPs5Lf4CxMd5E6cKYbfh0fv9K', '2023-05-01 14:24:37', '2023-06-13 12:31:13'),
(27, 11, 'Lisandra', 'Byrd', 1402356789, 'wefa@mailinator.com', 'Ipsasintma', '$2y$12$wuAD2Kf22fmq63og1SZJ7.2cd0v.ajPQhymldPczu5dXL7iW2GTt.', '2023-05-01 14:25:15', '2023-06-13 12:31:20'),
(28, 11, 'Madaline', 'Sanford', 1834567920, 'faviselo@mailinator.com', 'Namolestias', '$2y$12$PWl.mIjuz8UfvOo3fTTFnezL.iNHZyoILHD2iwbRRBGgCPGtdRC3q', '2023-05-01 14:26:57', '2023-06-13 12:31:28'),
(29, 11, 'Fulton', 'Palmer', 876543210, 'rywo@mailinator.com', 'Fulton', '$2y$12$38Z2ii4rWeI5Kxs/UjFOYuTZJ4RihbPo5kByLRiYkOIkh2uiXWYx.', '2023-06-16 09:50:10', '2023-06-16 09:50:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `customers_fk_statuses` (`id_status`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `orders_fk_users` (`id_user`),
  ADD KEY `orders_fk_customers` (`id_customer`),
  ADD KEY `orders_fk_products` (`id_product`),
  ADD KEY `orders_fk_statuses` (`id_status`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id_price`),
  ADD KEY `prices_fk_products` (`id_product`),
  ADD KEY `prices_fk_statuses` (`id_status`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `products_fk_statuses` (`id_status`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`id_product_category`),
  ADD KEY `products_categories_fk_categories` (`id_category`),
  ADD KEY `products_categories_fk_products` (`id_product`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id_sub_category`),
  ADD KEY `sub_categories_fk_categories` (`id_category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `users_fk_statuses` (`id_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id_price` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id_product_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id_status` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id_sub_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_fk_statuses` FOREIGN KEY (`id_status`) REFERENCES `statuses` (`id_status`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_fk_customers` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id_customer`),
  ADD CONSTRAINT `orders_fk_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`),
  ADD CONSTRAINT `orders_fk_statuses` FOREIGN KEY (`id_status`) REFERENCES `statuses` (`id_status`),
  ADD CONSTRAINT `orders_fk_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_fk_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`),
  ADD CONSTRAINT `prices_fk_statuses` FOREIGN KEY (`id_status`) REFERENCES `statuses` (`id_status`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_fk_statuses` FOREIGN KEY (`id_status`) REFERENCES `statuses` (`id_status`);

--
-- Constraints for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD CONSTRAINT `products_categories_fk_categories` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`),
  ADD CONSTRAINT `products_categories_fk_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_fk_categories` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk_statuses` FOREIGN KEY (`id_status`) REFERENCES `statuses` (`id_status`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
