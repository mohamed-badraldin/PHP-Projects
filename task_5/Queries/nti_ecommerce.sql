-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2021 at 02:24 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nti_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `street` varchar(50) NOT NULL,
  `building` varchar(50) NOT NULL,
  `floor` varchar(20) NOT NULL,
  `flat` varchar(20) NOT NULL,
  `notes` text DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `building`, `floor`, `flat`, `notes`, `user_id`, `region_id`, `created_at`, `updated_at`) VALUES
(5, '45', '54', '15', '5', NULL, 82, 18, '2021-06-27 02:04:09', '2021-06-27 02:04:09'),
(6, '18', '15', '5', '5', NULL, 82, 15, '2021-06-27 02:04:09', '2021-06-27 02:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT 'default_brand.png',
  `status` tinyint(1) DEFAULT 1 COMMENT '0->not active , 1-> active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'samsung', 'default_brand.png', 1, '2021-06-27 17:26:59', '2021-06-27 17:31:38'),
(2, 'apple', 'default_brand.png', 1, '2021-06-27 17:26:59', '2021-06-27 17:31:38'),
(3, 'oppo', 'default_brand.png', 1, '2021-06-27 17:32:55', '2021-06-27 17:32:55'),
(4, 'lenovo', 'default_brand.png', 1, '2021-06-27 17:32:55', '2021-06-27 17:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `quantities` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT 'categories_default.png',
  `status` tinyint(1) DEFAULT 0 COMMENT '0->not active , 1->active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'electronics', 'categories_default.png', 1, '2021-06-27 17:49:02', '2021-06-27 17:49:02'),
(2, 'accessories', 'categories_default.png', 1, '2021-06-27 17:49:02', '2021-06-27 17:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '0->not active , 1->active',
  `lat` mediumint(9) NOT NULL,
  `long` mediumint(9) NOT NULL,
  `rad` mediumint(9) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `status`, `lat`, `long`, `rad`, `created_at`, `updated_at`) VALUES
(1, 'Cairo', 1, 15, 31, 21, '2021-06-27 01:18:04', '2021-06-27 01:19:21'),
(2, 'Alex', 1, 55, 51, 41, '2021-06-27 01:18:04', '2021-06-27 01:19:21'),
(3, 'Giza', 1, 17, 30, 61, '2021-06-27 01:18:04', '2021-06-27 01:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `discount` int(10) NOT NULL,
  `discountType` varchar(20) NOT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0->not active , 1->active',
  `countOfUsage` int(10) DEFAULT NULL,
  `useagePerUser` tinyint(3) DEFAULT NULL,
  `minDescountPrice` decimal(6,2) DEFAULT NULL,
  `maxDescountPrice` decimal(6,2) DEFAULT NULL,
  `code` mediumint(5) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_product`
--

CREATE TABLE `coupon_product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED NOT NULL,
  `priceAfterDescount` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_user`
--

CREATE TABLE `coupon_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `coupon_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `discount` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(100) DEFAULT 'offer_default.png',
  `status` tinyint(1) DEFAULT 1 COMMENT '0->not active , 1->active',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `discount`, `title`, `details`, `image`, `status`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 20, 'white friday', NULL, 'offer_default.png', 1, '2021-06-01', '2021-06-30', '2021-06-27 22:36:06', '2021-06-27 22:36:06'),
(2, 30, 'big offers', NULL, 'offer_default.png', 1, '2021-06-30', '2021-07-22', '2021-06-27 22:36:06', '2021-06-27 22:36:06'),
(3, 20, 'big sale', NULL, 'offer_default.png', 1, '2021-06-29', '2021-07-09', '2021-06-27 22:38:07', '2021-06-27 22:38:07'),
(4, 50, 'big discount', NULL, 'offer_default.png', 0, '2021-07-15', '2021-07-30', '2021-06-27 22:38:07', '2021-06-27 22:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `offer_products`
--

CREATE TABLE `offer_products` (
  `offer_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `productOfferPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer_products`
--

INSERT INTO `offer_products` (`offer_id`, `product_id`, `productOfferPrice`) VALUES
(1, 13, 2122),
(1, 14, 1900),
(1, 16, 250),
(2, 14, 1136),
(2, 15, 1616),
(2, 17, 2500),
(3, 13, 2800),
(3, 18, 555),
(4, 15, 1200),
(4, 18, 464);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` mediumint(5) DEFAULT NULL,
  `total` decimal(6,2) NOT NULL,
  `paymentMethod` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '0->not active , 1->active',
  `lat` int(10) DEFAULT NULL,
  `log` int(10) DEFAULT NULL,
  `coupons_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `code`, `total`, `paymentMethod`, `status`, `lat`, `log`, `coupons_id`, `created_at`, `updated_at`) VALUES
(2, 61674, '1004.25', 'cash', 1, NULL, NULL, NULL, '2021-06-27 21:58:11', '2021-06-27 22:02:58'),
(3, 46864, '9999.99', 'visa', 1, NULL, NULL, NULL, '2021-06-27 21:58:49', '2021-06-27 22:02:58'),
(4, 5515, '123.00', 'visa', 1, NULL, NULL, NULL, '2021-06-27 21:59:33', '2021-06-27 22:02:58'),
(6, 97494, '1616.00', 'cash', 1, NULL, NULL, NULL, '2021-06-27 22:02:09', '2021-06-27 22:02:58'),
(7, 44466, '9471.00', 'cash', 1, NULL, NULL, NULL, '2021-06-27 22:05:43', '2021-06-27 22:05:43'),
(8, 79796, '1246.00', 'visa', 1, NULL, NULL, NULL, '2021-06-27 22:05:43', '2021-06-27 22:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `productOrderPrice` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`product_id`, `order_id`, `productOrderPrice`) VALUES
(13, 6, '3500.00'),
(15, 4, '646.00'),
(18, 4, '1644.00'),
(13, 7, '6164.00'),
(17, 3, '6461.00'),
(17, 7, '1541.00'),
(18, 6, '6161.00'),
(15, 7, '3641.00'),
(13, 2, '3500.00'),
(15, 6, '4646.00'),
(15, 4, '65.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `code` mediumint(5) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `quantity` int(5) NOT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0->not active , 1-> active',
  `brand_id` int(10) UNSIGNED NOT NULL,
  `subCategories_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `code`, `price`, `quantity`, `status`, `brand_id`, `subCategories_id`, `created_at`, `updated_at`) VALUES
(13, 'note10', '', 57354, '5000.00', 5, 1, 1, 1, '2021-06-27 16:57:23', '2021-06-27 16:58:50'),
(14, 'note9', '', 43354, '4000.00', 5, 1, 1, 1, '2021-06-27 13:57:23', '2021-06-27 13:58:50'),
(15, 'm301', '', 51454, '5050.00', 5, 1, 2, 2, '2021-06-27 10:57:23', '2021-06-27 10:58:50'),
(16, 'screen4', '', 51312, '9999.99', 5, 1, 2, 2, '2021-06-27 09:57:23', '2021-06-27 09:58:50'),
(17, 'N50', '', 51344, '5480.00', 5, 1, 2, 3, '2021-06-27 08:57:23', '2021-06-27 08:58:50'),
(18, 'b2', '', 51464, '1000.00', 5, 1, 2, 3, '2021-06-27 07:57:23', '2021-06-27 07:58:50');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT '',
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '0->not active , 1->active',
  `lat` mediumint(9) DEFAULT NULL,
  `long` mediumint(9) DEFAULT NULL,
  `rad` mediumint(9) DEFAULT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `status`, `lat`, `long`, `rad`, `city_id`, `created_at`, `updated_at`) VALUES
(15, 'naser city', 1, 55, 85, 59, 1, '2021-06-27 01:42:28', '2021-06-27 01:42:28'),
(16, 'cairo city', 1, 56, 100, 13, 1, '2021-06-27 01:42:28', '2021-06-27 01:55:11'),
(17, 'elasfra city', 1, 90, 55, 55, 2, '2021-06-27 01:42:28', '2021-06-27 01:55:58'),
(18, 'down twon', 1, 46, 45, 67, 2, '2021-06-27 01:42:28', '2021-06-27 01:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `rate_value` tinyint(1) NOT NULL COMMENT '0=min, 5=max',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `comment`, `rate_value`, `created_at`, `updated_at`) VALUES
(1, 15, 82, 'its good product', 5, '2021-06-27 20:27:04', '2021-06-27 20:27:04'),
(2, 15, 83, 'good', 5, '2021-06-27 20:27:04', '2021-06-27 20:27:04'),
(3, 17, 82, 'not good', 1, '2021-06-27 20:28:13', '2021-06-27 20:28:13'),
(4, 14, 82, 'not good', 1, '2021-06-27 20:28:13', '2021-06-27 20:28:13'),
(5, 16, 83, 'nice', 4, '2021-06-27 20:30:18', '2021-06-27 20:30:18'),
(6, 13, 82, 'nice', 3, '2021-06-27 20:30:18', '2021-06-27 20:30:18'),
(7, 15, 83, NULL, 4, '2021-06-27 20:31:28', '2021-06-27 20:31:28'),
(8, 13, 83, NULL, 3, '2021-06-27 20:31:28', '2021-06-27 20:31:28'),
(9, 17, 82, NULL, 0, '2021-06-27 20:32:19', '2021-06-27 20:32:19'),
(10, 17, 82, 'bad', 1, '2021-06-27 20:33:11', '2021-06-27 20:33:11'),
(11, 13, 83, 'very good', 5, '2021-06-27 20:33:11', '2021-06-27 20:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT 'sub_default.png',
  `status` tinyint(1) DEFAULT 0 COMMENT '0->not active , 1->active',
  `categories_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `image`, `status`, `categories_id`, `created_at`, `updated_at`) VALUES
(1, 'mobile', 'sub_default.png', 1, 1, '2021-06-27 17:51:25', '2021-06-27 17:51:25'),
(2, 'tablet', 'sub_default.png', 1, 1, '2021-06-27 17:51:25', '2021-06-27 17:51:25'),
(3, 'cover', 'sub_default.png', 1, 2, '2021-06-27 17:52:16', '2021-06-27 17:52:16'),
(4, 'screen', 'sub_default.png', 1, 2, '2021-06-27 17:52:16', '2021-06-27 17:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) DEFAULT 'supplier_default.png',
  `phone` varchar(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0->not active , 1->active',
  `password` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(5) DEFAULT NULL,
  `gender` varchar(1) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `image` varchar(100) DEFAULT 'default_user.png',
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `code`, `gender`, `status`, `image`, `order_id`, `created_at`, `updated_at`) VALUES
(82, 'Badr', '01068118614', 'm.badreldin.mohamed@gmail.com', '4bbd8d2f89258ce6124361d7a974a98a850ee438', 37659, 'm', 1, 'default_user.png', NULL, '2021-06-26 21:00:10', '2021-06-27 20:23:59'),
(83, 'Mohamed Badr', '01068118615', 'beka.standup@gmail.com', 'f04e5b6e31f76ee2046f7285472e26fa88260e8b', 89536, 'm', 1, 'default_user.png', NULL, '2021-06-27 20:14:36', '2021-06-27 20:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `user_cart_fk` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_product`
--
ALTER TABLE `coupon_product`
  ADD PRIMARY KEY (`product_id`,`coupon_id`),
  ADD KEY `order_couponProduct_fk` (`coupon_id`);

--
-- Indexes for table `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD PRIMARY KEY (`user_id`,`coupon_id`),
  ADD KEY `coupon_couponUser_fk` (`coupon_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_products`
--
ALTER TABLE `offer_products`
  ADD PRIMARY KEY (`offer_id`,`product_id`),
  ADD KEY `product_offerProduct_fk` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`,`product_id`),
  ADD KEY `user_productImage_fk` (`product_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_review_fk` (`product_id`),
  ADD KEY `user_review_fk` (`user_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `user_wishlist_fk` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `region_address_fk` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `user_address_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product_cart_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `user_cart_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `coupon_product`
--
ALTER TABLE `coupon_product`
  ADD CONSTRAINT `order_couponProduct_fk` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  ADD CONSTRAINT `user_couponProduct_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD CONSTRAINT `coupon_couponUser_fk` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`),
  ADD CONSTRAINT `user_couponUser_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `offer_products`
--
ALTER TABLE `offer_products`
  ADD CONSTRAINT `offer_offerProduct_fk` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`),
  ADD CONSTRAINT `product_offerProduct_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `brand_product_fk` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `subCategories_product_fk` FOREIGN KEY (`subCategories_id`) REFERENCES `sub_categories` (`id`);

--
-- Constraints for table `products_images`
--
ALTER TABLE `products_images`
  ADD CONSTRAINT `user_productImage_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `city_region_fk` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `product_review_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `user_review_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `categories_subCategories_fk` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `order_usre_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `product_wishlist_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `user_wishlist_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
