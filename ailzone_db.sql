-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2025 at 08:40 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ailzone_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(155) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Health'),
(2, 'Clothing'),
(3, 'Sports'),
(4, 'Women\r\n'),
(5, 'Men');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` enum('bank','paypal') NOT NULL,
  `status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `payment_method`, `status`, `created_at`) VALUES
(1, 1, 0.00, 'bank', 'pending', '2025-01-24 09:14:49'),
(2, 1, 0.00, 'paypal', 'pending', '2025-01-24 09:18:09'),
(3, 1, 12.00, 'paypal', 'pending', '2025-01-24 09:31:51'),
(4, 1, 12.00, 'bank', 'pending', '2025-01-24 18:36:54'),
(5, 3, 12.00, 'bank', 'pending', '2025-01-26 08:34:52'),
(6, 2, 2430.00, 'paypal', 'pending', '2025-01-26 08:44:41'),
(7, 3, 50.00, 'bank', 'pending', '2025-01-26 09:07:24'),
(8, 2, 244.00, 'paypal', 'pending', '2025-01-26 09:32:10'),
(9, 3, 500.00, 'bank', 'pending', '2025-01-26 09:40:33'),
(10, 3, 84000.00, 'paypal', 'pending', '2025-02-06 12:01:47'),
(11, 7, -120.00, 'bank', 'pending', '2025-03-18 21:03:43'),
(12, 8, 14020.00, 'paypal', 'pending', '2025-04-27 22:14:24'),
(13, 8, 2400.00, 'bank', 'pending', '2025-04-27 22:15:27'),
(14, 3, 20262.00, 'bank', 'pending', '2025-05-01 05:51:41'),
(15, 9, 120.00, 'paypal', 'pending', '2025-05-05 13:13:50'),
(16, 2, 244.00, 'bank', 'pending', '2025-05-05 13:36:14'),
(17, 2, 99999999.99, 'bank', 'pending', '2025-05-05 13:48:58'),
(18, 3, 99999999.99, 'bank', 'pending', '2025-05-05 13:50:10'),
(19, 3, 220000.00, 'bank', 'pending', '2025-05-09 23:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 3, 2, 1, 12.00),
(2, 4, 2, 1, 12.00),
(3, 5, 2, 1, 12.00),
(4, 6, 5, 135, 18.00),
(5, 7, 11, 1, 50.00),
(6, 8, 15, 1, 244.00),
(7, 9, 11, 10, 50.00),
(8, 10, 17, 6, 14000.00),
(9, 11, 18, -10, 12.00),
(10, 12, 6, 1, 20.00),
(11, 12, 17, 1, 14000.00),
(12, 13, 2, 200, 12.00),
(13, 14, 4, 1, 18.00),
(14, 14, 15, 1, 244.00),
(15, 14, 16, 1, 20000.00),
(16, 15, 3, 1, 55.00),
(17, 15, 7, 1, 25.00),
(18, 15, 12, 1, 40.00),
(19, 16, 15, 1, 244.00),
(20, 17, 20, 2000, 2000000.00),
(21, 18, 20, 2000, 2000000.00),
(22, 19, 16, 2, 20000.00),
(23, 19, 19, 9, 20000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `stock` int DEFAULT '0',
  `image` varchar(255) DEFAULT 'default.jpg',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `image`, `created_at`, `category`) VALUES
(16, 'Good', 'flyer-hacker', 20000.00, 120, 'IMG-20240503-WA0060.jpg', '2025-01-26 22:30:12', 'Health'),
(2, 'Laundry Basket', 'Laundry', 12.00, 0, 'IMG-20241222-WA0054.jpg', '2025-01-24 09:22:01', 'Clothing'),
(3, 'laon', 'shocking', 55.00, 5, 'Screenshot 2025-01-22 231852.png', '2025-01-24 18:45:18', 'Sports'),
(4, 'Abaya', 'nice and fit', 18.00, 100, 'IMG-20241229-WA0022.jpg', '2025-01-26 08:41:01', 'Women\r\n'),
(5, 'Caps', 'nice caps', 18.00, 100, 'IMG-20241224-WA0078.jpg', '2025-01-26 08:42:36', 'Men'),
(6, 'Glasses', 'eyes clear', 20.00, 50, 'IMG-20241227-WA0009.jpg', '2025-01-26 08:43:38', 'Clothing'),
(7, 'shoe-snickers', 'footwear', 25.00, 40, 'IMG-20241218-WA0028.jpg', '2025-01-26 08:46:12', 'Clothing'),
(8, 'Jallabiya', 'male-outfit', 30.00, 40, '1.jpg', '2025-01-26 08:47:23', 'Clothing'),
(9, 'T-shirt', 'outfit', 35.00, 80, 'IMG-20250102-WA0102.jpg', '2025-01-26 08:48:14', 'Clothing'),
(10, 'Bag', 'female-bags', 35.00, 200, 'IMG-20250116-WA0046.jpg', '2025-01-26 08:49:07', 'Clothing'),
(11, 'cloth', 'Tailored-outfit', 50.00, 100, 'j.jpg', '2025-01-26 08:50:08', 'Clothing'),
(12, 'Bag', 'bag pack', 40.00, 60, 'IMG-20250116-WA0018.jpg', '2025-01-26 08:51:02', 'Clothing'),
(13, 'iphone', 'phoning phone', 180.00, 50, 'IMG-20241227-WA0042.jpg', '2025-01-26 08:51:50', 'Electronics'),
(14, 'watch', 'wrist watch', 50.00, 100, 'IMG-20250107-WA0014.jpg', '2025-01-26 08:52:38', 'Electronics'),
(15, 'Car', 'Ride', 244.00, 454, 'IMG_1445.JPG', '2025-01-26 09:25:57', 'Electronics'),
(19, 'Robot', 'Men', 20000.00, 200, '20250113_191514.jpg', '2025-05-05 13:18:38', 'Men'),
(20, 'Abaya', 'thing', 2000000.00, 2000, '1000009900.jpg', '2025-05-05 13:47:28', 'Women\r\n'),
(24, 'Sporting', 'sports-levy', 23424.00, 1000000, 'IMG-20240503-WA0017.jpg', '2025-05-09 07:30:14', 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
CREATE TABLE IF NOT EXISTS `sellers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(155) NOT NULL,
  `email` varchar(155) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(155) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `email`, `phone`, `password`) VALUES
(4, 'ahmad', 'ahmadlabaran032@gmail.com', '0897979796962', '$2y$10$6I14V6dl6fXtQ5WtrurtLOaebjqM645.0Q3JHrbq5M8RO1mXKzUiS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_pic` varchar(255) DEFAULT 'default.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `profile_pic`) VALUES
(1, 'Splinter001', 'ainga1947@gmail.com', '$2y$10$.sBOQPZ2F.PEONp.K0M/9Os7k54WweHH0VDvzIXFwIjuUxuiR2yam', 'user', '2025-01-24 07:28:59', 'Screenshot 2024-12-18 015157.png'),
(2, 'ailszone', 'ailszone@gmail.com', '$2y$10$jeLWx7Cp.j5th30CuK1Fduk3dGcD.wg0lJFuD4T7U5c62Y.acro8S', 'admin', '2025-01-24 07:31:42', 'IMG-20220617-WA0019.jpg'),
(3, 'alex', 'alex@gmail.com', '$2y$10$osMY57ASuAmulL03drRgWO4y/DxphW9u7Xw1h1uTQ7BmaMB8DoDXG', 'user', '2025-01-26 08:33:59', '2348148116410_status_cf40635128c04c89b4e989eccef578f5 (2).jpg'),
(4, 'Aarhhmardy', 'ahmadlabaran032@gmail.com', '$2y$10$sj5Uhk0hZjxYE4HWp.qhEebZ708q1584mryTxQ6LyTZosi3J2boPC', 'user', '2025-01-26 18:07:20', 'default.png'),
(5, 'juju1212', 'juniorhassan086@gmail.com', '$2y$10$gKTBoTSwSdRaIreMgLk42OiiMRMT3uhzF5AH7XGBTRFw86UE.NfGK', 'user', '2025-02-06 11:56:59', 'default.png'),
(6, 'asd', 'dg@gmail.com', '$2y$10$Zm2NCXVLCvFI6Bd4HHAu4upEAEsagKE4hscOrwP9MHLHLZ5JCMZgW', 'user', '2025-03-18 21:02:19', 'default.png'),
(7, 'reg', 'dwe@gmail.com', '$2y$10$.fyuBY6JN7pReujZvFlxxuyUsMd3Qxvc7PwW7WZmKYWYytLD0TRza', 'user', '2025-03-18 21:03:06', 'default.png'),
(8, 'abex', 'ab@gmail.com', '$2y$10$9xuFUVrgRsYFnAVJYJw5eucj66xoDkrxFMnJpGh0lKZC.kXsSoYia', 'user', '2025-04-27 22:13:34', 'default.png'),
(9, 'Ace', 'ace@gmail.com', '$2y$10$pWNhbR7t59azTqJ6JduZGOzvJT.Zmf7JuK/aBAoAaM6.6H/X6ro52', 'user', '2025-05-05 13:12:59', 'default.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
