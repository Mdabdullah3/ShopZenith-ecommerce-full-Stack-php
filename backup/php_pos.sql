-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2023 at 11:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created`, `updated`) VALUES
(1, 'Electronics', '2023-09-27 08:14:29', NULL),
(2, 'Automobiles', '2023-09-27 08:15:11', NULL),
(3, 'Clothing', '2023-09-27 08:15:35', NULL),
(4, 'property', '2023-09-27 08:16:45', '2023-09-27 08:19:56'),
(8, 'Fashion', '2023-10-04 08:24:05', NULL),
(9, 'ASDD', '2023-10-07 07:47:04', NULL),
(10, 'shoes', '2023-10-07 09:07:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `product_id`, `name`, `created`, `updated`) VALUES
(8, 7, '1 (7)_1696669453.jpg', '2023-10-07 09:04:13', NULL),
(9, 7, '1 (15)_1696669453.jpg', '2023-10-07 09:04:13', NULL),
(10, 7, '1 (16)_1696669453.jpg', '2023-10-07 09:04:13', NULL),
(11, 7, '1 (17)_1696669453.jpg', '2023-10-07 09:04:13', NULL),
(12, 8, 'car1_1696669638.jpg', '2023-10-07 09:07:18', NULL),
(13, 8, 'car3_1696669638.jpg', '2023-10-07 09:07:18', NULL),
(14, 9, '2_55f25ce3-c035-40d6-baf8-1643ba858390_1024x1024_1696669752.jpg', '2023-10-07 09:09:12', NULL),
(15, 9, 'download (2)_1696669752.jpg', '2023-10-07 09:09:12', NULL),
(16, 9, 'download_1696669752.jpg', '2023-10-07 09:09:12', NULL),
(21, 11, 'karthik-sreenivas-rsx-joaKYrk-unsplash_1696838549.jpg', '2023-10-09 08:02:29', NULL),
(22, 12, 'samsung-galaxy-s24-ultra-144-hz-display-geruecht-1f_1696843153.jpg', '2023-10-09 09:19:13', NULL),
(23, 12, 'hero-image.fill.size_1248x702.v1695053686_1696843153.jpg', '2023-10-09 09:19:13', NULL),
(24, 12, 'Samsung-Galaxy-S22-Ultra-5G-color-sky-500x500_1696843153.jpg', '2023-10-09 09:19:13', NULL),
(25, 13, '0010000075013_1696843167.jpg', '2023-10-09 09:19:27', NULL),
(26, 13, '0020000106276_1696843167.jpg', '2023-10-09 09:19:27', NULL),
(27, 13, '1200000023010_3_1696843167.jpg', '2023-10-09 09:19:27', NULL),
(28, 13, '1200000027224_1696843167.jpg', '2023-10-09 09:19:27', NULL),
(29, 14, 'oppo-f17-1_1696843187.jpg', '2023-10-09 09:19:47', NULL),
(31, 15, 'e6b6db26416e6ddc437ab6573c6061ab_1696843460.jpg', '2023-10-09 09:24:20', NULL),
(32, 15, 'images_1696843460.jpg', '2023-10-09 09:24:20', NULL),
(33, 15, '1182-24152-sports-collection-green-red-sports-sportz-design-52080-1-thumbnail-1080x1080-70 - Copy_1696843460.jpg', '2023-10-09 09:24:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(60) DEFAULT NULL,
  `name` varchar(512) NOT NULL,
  `details` text NOT NULL,
  `shortdesc` varchar(256) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `pprice` float(10,2) NOT NULL,
  `sprice` float(10,2) NOT NULL,
  `tags` varchar(60) NOT NULL,
  `vat` float(4,2) NOT NULL DEFAULT 5.00,
  `status` set('0','1') NOT NULL DEFAULT '1',
  `op1` varchar(30) DEFAULT NULL,
  `op2` varchar(30) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `details`, `shortdesc`, `category_id`, `quantity`, `pprice`, `sprice`, `tags`, `vat`, `status`, `op1`, `op2`, `created`, `updated`) VALUES
(2, 'sd', 'iphone 14 pro max', 'kidni phone', 'phone', 1, 32, 233.00, 253.00, 'phone', 4.00, '1', '', '', '2023-10-07 08:55:25', NULL),
(3, 'sd', 'nike shoes', 'good', 'very good', 8, 324, 223.00, 425.00, 'shoes,fashion', 4.00, '1', '', '', '2023-10-07 08:56:20', NULL),
(4, 'null', 'Lenovo', ' The best Lenovo gaming laptop we\'ve tested is the Lenovo Legion Pro 5 Gen 8 15 (2023).', ' The best Lenovo gaming....', 1, 123, 5000.00, 5000.00, '', 5.00, '0', 'ok', 'ok', '2023-10-07 08:58:32', '2023-10-07 09:00:45'),
(5, 'sd', 'Bro shirt', 'sfdf', 'sds', 3, 12, 21.00, 32.00, '', 5.00, '0', '', '', '2023-10-07 08:59:58', '2023-10-07 09:00:35'),
(7, 'test123', 'test', 'asdfdsf', 'safdsadf', 4, 123, 123.00, 123.00, 'a,b,c', 5.00, '1', '123', '123', '2023-10-07 09:04:13', NULL),
(8, 'jla7478', 'farari', 'The Prancing Horse symbolises exclusivity, performance and quality all over the world. Our prestige is built upon decades of sporting success and the inimitable style of our cars, which are unique in their innovation, technology and driving pleasure.', 'The Prancing Horse symbolises exclusivity, performance and quality all over the world. ', 2, 987, 15900000.00, 10000000.00, '', 10.00, '1', 'lj', 'glaj;', '2023-10-07 09:07:18', '2023-10-07 09:09:09'),
(9, 'null', 'slides', 'Good', 'Very Good', 10, 45, 3000.00, 2800.00, 'null', 5.00, '1', 'ok', 'ok', '2023-10-07 09:09:12', NULL),
(11, 'asdfdsfkjh', 'test', 'tes sdfg', 'dsgfdg', 4, 12, 123.00, 124.00, 'a,b,c', 5.00, '1', 'asdf', 'sadf', '2023-10-09 08:02:27', NULL),
(12, 'sd', 'samsungs23 ultra', 'go product', 'vcbcv', 1, 325, 243.00, 255.00, 'shoes,fashion', 5.00, '1', 'dds', 'dfssdf', '2023-10-09 09:19:13', NULL),
(13, 'hfg', 'Panjabi', 'very good', 'good', 3, 50, 2000.00, 1500.00, 'null', 5.00, '1', '12', '34', '2023-10-09 09:19:27', NULL),
(14, '12346', 'OPPO F17', 'Smartphone', 'oppo brand', 2, 50, 21000.00, 20000.00, 'oppo, industrial', 10.00, '1', 'abc', 'sell', '2023-10-09 09:19:47', NULL),
(15, '3425', 'cricket jersey', 'wow', 'very good', 3, 50, 2000.00, 1500.00, '', 5.00, '1', '345', '256', '2023-10-09 09:24:20', '2023-10-09 09:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `password`, `role`, `created`, `updated`) VALUES
(6, 'Rahman 2', 'Ashikur 2', 'info.co.ashik@gmail.com', '$2y$10$6xbXYCAUQBcVd36WHT23oeaz/7SN1vNt6GXfz/J9My4poJjHSBeQ6', 2, '2023-09-27 09:17:49', '2023-10-03 08:39:23'),
(8, 'Hasan', 'Mehedi ', 'info.mehedi52@gmail.com', '$2y$10$/7rVVMHn.ObWckMxLgLlzuJ3wHh/j4c8yo7GdRihWO6ej1eoSX/8O', 1, '2023-09-27 09:18:24', NULL),
(9, 'Mahafuz', 'Mister', 'mister@gmail.com', '$2y$10$X9Ffai33XuU3KmjC1ZU81.1tLHcoGD5uWqmr3hq6j1r.Gge4R.nrm', 2, '2023-09-27 09:18:33', '2023-10-07 08:49:05'),
(12, 'user1', 'user1', 'user1@gmail.com', '$2y$10$W/tuqa/ze.iPzdFFUoRmBewbGLmgnwZxkCzS9KinO7H3SdnzWaseu', 1, '2023-10-02 09:07:11', NULL),
(13, 'user2', 'user2', 'user2@gmail.com', '$2y$10$weC.4yNFv980escmzNk7o.HBq/IhJfi4s00KuEhCTwhbmSjKQ2mZO', 2, '2023-10-02 09:07:36', '2023-10-02 09:07:46'),
(14, 'def', 'abc', 'abc@def.com', '1234', 1, '2023-10-04 08:03:01', NULL),
(16, 'Rahman', 'Ashikur ', 'bca@gmail.com', '$2y$10$RGnYZ9GYdHHJ2RITjOHlH.t.FCBrQoaANCSsz96c6r2ZRQcXbNz7q', 1, '2023-10-04 09:02:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `sprice` (`sprice`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
