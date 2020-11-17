-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2020 at 12:51 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `admin_user` varchar(200) NOT NULL,
  `admin_password` varchar(200) NOT NULL,
  `vendor_show_password` varchar(200) DEFAULT NULL,
  `admin_role` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` bigint(15) NOT NULL,
  `admin_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `admin_user`, `admin_password`, `vendor_show_password`, `admin_role`, `email`, `mobile`, `admin_status`) VALUES
(1, 'piyush', 'a1d52fb9e6adfb2d64eaa229d64df5bddcd2201f', '', 0, 'admin@gmail.com', 5555555555, 1),
(7, 'vendor', '5cb2c992ee64f4e98c951a31381b5a0ed9eac805', 'vendor', 1, 'vendor@gmail.com', 4556789456, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories_name`, `status`, `created`) VALUES
(2, 'apple', 0, '2020-08-01 12:51:21'),
(3, 'motorola', 1, '2020-08-01 12:51:40'),
(4, 'samsung', 1, '2020-08-01 12:51:46'),
(5, 'nokia', 1, '2020-08-01 12:51:52'),
(6, 'redmi', 1, '2020-08-01 12:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `mobile` bigint(12) NOT NULL,
  `comment` text NOT NULL,
  `contact_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `fname`, `email_id`, `mobile`, `comment`, `contact_at`) VALUES
(1, 'piyush', 'piyush.d.shyam@gmail.com', 1234567894, 'sdvdsvv', '2020-08-26 18:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_address` text NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `user_post_code` bigint(8) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payu_status` varchar(200) NOT NULL,
  `order_status` varchar(200) NOT NULL,
  `txnid` varchar(200) NOT NULL,
  `mihpayid` varchar(200) NOT NULL,
  `total_price` float NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `user_address`, `user_city`, `user_post_code`, `payment_type`, `payment_status`, `payu_status`, `order_status`, `txnid`, `mihpayid`, `total_price`, `added_on`) VALUES
(1, 5, 'wegfgf', 'egfgf', 4535, 'chash_on_delivery', 'pending', '', '1', '0', '', 121, '2020-11-16 08:09:50'),
(2, 5, 'srgvrg', 'tyijt', 4535, 'chash_on_delivery', 'pending', '', '1', '0', '', 4, '2020-11-16 10:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(1, 1, 10, 1, 121),
(2, 2, 37, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_status_data`
--

CREATE TABLE `order_status_data` (
  `id` int(11) NOT NULL,
  `status_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status_data`
--

INSERT INTO `order_status_data` (`id`, `status_name`) VALUES
(1, 'Pending'),
(2, 'Processing'),
(3, 'Shipped'),
(4, 'Canceled'),
(5, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `best_seller` int(11) NOT NULL DEFAULT 0,
  `product_mrp` float NOT NULL,
  `product_sale_price` float NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `short_desc` varchar(100) NOT NULL,
  `long_desc` varchar(100) NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `meta_desc` varchar(100) NOT NULL,
  `meta_keyword` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `added_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `category_name`, `product_name`, `best_seller`, `product_mrp`, `product_sale_price`, `product_qty`, `product_image`, `short_desc`, `long_desc`, `meta_title`, `meta_desc`, `meta_keyword`, `created_at`, `status`, `added_by`) VALUES
(1, 4, 'samsung', 'galaxy s6 edge', 1, 644, 50, 10, '780317976_1.png', 'sdvd', 'sdvdsvvvsdvvsdv sdvvdsvv sdvvdvv sdvdvdsv', 'sdvds', 'sdvd', 'sdvdv', '2020-08-01 13:04:02', 1, 1),
(2, 5, 'nokia', 'nokia 6600', 1, 200, 90, 50, '119354896_2.png', 'dvdvdv', 'sdvdsv', 'vdv', 'dvdv', 'sdvv', '2020-08-01 13:26:51', 1, 1),
(3, 6, 'redmi', 'redmi note 7 pro', 1, 562, 20, 20, '824297576_3.png', 'dvd', 'sdvdsv', 'vddsvds', 'sdvdsv', 'dvdsvdv', '2020-08-01 13:28:54', 1, 1),
(4, 6, 'redmi', 'redmi note 8', 1, 544, 56, 125, '221186570_4.png', 'dvdsv', 'sdvdsvdv', 'sdvdsv', 'sdvdsv', 'sdvdsv', '2020-08-01 13:30:33', 1, 1),
(5, 6, 'redmi', 'redmi note 9 pro', 0, 57786, 145, 32, '180652189_5.png', 'dvdsv', 'sdvdsv', 'sdvdsv', 'dvdsv', 'sdvds', '2020-08-01 13:31:30', 1, 1),
(6, 6, 'redmi', 'redmi 8a', 0, 25454, 4432, 14, '289883457_6.png', 'dddv', 'dvds', 'sdvdsvdv', 'sdvsd', 'svdsv', '2020-08-01 13:34:04', 0, 1),
(7, 6, 'redmi', 'xiaomi mi 10 pro', 0, 4878, 44, 24, '481485932_8.png', 'sfvf', 'ffvfb', 'fvf', 'ff', 'dfbfb', '2020-08-01 13:36:50', 1, 1),
(8, 5, 'nokia', 'nokia 6.1 plus', 0, 4548, 144, 54, '898523016_10.png', 'hgg', 'hug', 'dvdsvv', 'sdvd', 'sdvdsv', '2020-08-01 13:39:06', 1, 1),
(10, 4, 'samsung', 'samsung galaxy s6', 0, 1354, 121, 321, '883084647_11.png', 'addd', 'sdvdsvv', 'svfsv', 'sddvd', 'vdvd', '2020-08-01 13:43:49', 1, 1),
(11, 4, 'samsung', 'samsung galaxy s7', 0, 5445, 1545, 44, '485544493_12.png', 'svsv', 'sdvds', 'svvbfbfs', 'svffv', 'sdvsdvv', '2020-08-01 13:45:43', 1, 1),
(12, 3, 'motorola', 'moto g8 power lite', 0, 54454, 2454, 121, '626772845_13.png', 'sdvdsvdv', 'sdvdsdv', 'sdvdsvdv', 'sdvdsvdv', 'svsdvdsv', '2020-08-01 13:47:37', 1, 1),
(13, 3, 'motorola', 'motorola es6', 0, 35454, 5455, 221, '805654220_14.png', 'dvdv', 'sdvdvdsv', 'dvdvv', 'dvdv', 'dvdsv', '2020-08-01 13:49:03', 1, 1),
(14, 2, 'apple', 'apple iphone 7', 0, 2154, 554, 45, '416297338_15.png', 'dvdvv', 'vdsvdv', 'acdv', 'sdvdsv', 'sdvdsv', '2020-08-01 13:51:52', 1, 1),
(37, 2, 'apple', 'test vendor 1', 0, 4, 4, 4, '865598543_1.png', 'rrghy', 'trhg', 'rgg', 'th', 'th', '2020-11-16 06:27:26', 1, 2),
(38, 3, 'motorola', 'vendor 2', 1, 453, 3465, 543, '413971740_6.png', 'trht', 'th', 're', 'th', 'th', '2020-11-16 06:57:22', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `id` int(11) NOT NULL,
  `u_name` varchar(200) NOT NULL,
  `u_email` varchar(200) NOT NULL,
  `u_password` varchar(200) NOT NULL,
  `u_mobile` bigint(12) NOT NULL,
  `encrypt_email` varchar(255) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`id`, `u_name`, `u_email`, `u_password`, `u_mobile`, `encrypt_email`, `added_on`) VALUES
(5, 'piyush shyam', 'piyush.d.shyam@gmail.com', '$2y$10$dAFnooz1nX0LnATFaeboRu6znIdckWrRiwQRUBbTvoZqZ2iWArM0S', 4545454545, '91ec7ceae1acccb28a07dbf541732f23', '2020-08-27 11:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `added_on`) VALUES
(17, 1, 7, '2020-08-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_user` (`admin_user`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name` (`categories_name`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status_data`
--
ALTER TABLE `order_status_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_email` (`u_email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_status_data`
--
ALTER TABLE `order_status_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `registered_users`
--
ALTER TABLE `registered_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
