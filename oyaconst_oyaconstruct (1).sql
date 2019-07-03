-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2019 at 10:12 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oyaconst_oyaconstruct`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartproducts`
--

CREATE TABLE `cartproducts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cartid` bigint(20) DEFAULT '0',
  `productid` bigint(20) DEFAULT '0',
  `userid` bigint(20) DEFAULT '0',
  `storeid` bigint(20) DEFAULT '0',
  `categoryid` bigint(20) DEFAULT '0',
  `cost` double(12,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) DEFAULT '0',
  `invoice` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymenttype` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentstatus` tinyint(4) DEFAULT '0',
  `paymentdate` date DEFAULT NULL,
  `invoiccedate` date DEFAULT NULL,
  `totalamount` double(12,2) DEFAULT '0.00',
  `cartstatus` tinyint(4) DEFAULT '0',
  `deliverstatus` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `servicetype` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `servicetype`, `catname`, `created_at`, `updated_at`) VALUES
(1, 'shop', 'General Building Materials', '2019-05-25 05:04:01', '2019-05-25 05:04:01'),
(2, 'shop', 'Doors and WIndows', '2019-05-25 05:38:10', '2019-05-25 05:38:10'),
(3, 'shop', 'Plumbing and Sanitary wares', '2019-05-27 13:17:16', '2019-05-27 13:17:16'),
(4, 'real estate', 'Rent', '2019-05-27 13:17:33', '2019-05-27 13:17:33'),
(5, 'real estate', 'Lease', '2019-05-27 13:17:46', '2019-05-27 13:17:46'),
(6, 'real estate', 'Buy', '2019-05-27 13:18:59', '2019-05-27 13:18:59'),
(7, 'professional services', 'Artisans', '2019-05-27 13:21:30', '2019-05-27 13:21:30'),
(8, 'professional services', 'Architects', '2019-05-27 13:22:08', '2019-05-27 13:22:08'),
(9, 'professional services', 'Building Engineers', '2019-05-27 13:22:28', '2019-05-27 13:22:28'),
(10, 'professional services', 'Civil Engineers', '2019-05-27 13:22:45', '2019-05-27 13:22:45'),
(11, 'professional services', 'Estate Surveyors', '2019-05-27 13:23:11', '2019-05-27 13:23:11'),
(12, 'professional services', 'Mechanical Engineers', '2019-05-27 13:23:28', '2019-05-27 13:23:28'),
(13, 'professional services', 'Land surveyors', '2019-05-27 13:23:52', '2019-05-27 13:23:52'),
(14, 'professional services', 'Project Managers', '2019-05-27 13:24:12', '2019-05-27 13:24:12'),
(15, 'professional services', 'Quantity Surveyors', '2019-05-27 13:24:31', '2019-05-27 13:24:31'),
(16, 'shop', 'Furniture', '2019-05-27 13:24:51', '2019-05-27 13:24:51'),
(17, 'shop', 'Electrical', '2019-05-27 13:25:13', '2019-05-27 13:25:13'),
(18, 'shop', 'Roofing', '2019-05-27 13:25:27', '2019-05-27 13:25:27'),
(19, 'shop', 'TImber & Wood', '2019-05-27 13:25:54', '2019-05-27 13:25:54'),
(20, 'shop', 'Interior & Exterior Decorations', '2019-05-27 13:26:25', '2019-05-27 13:26:25'),
(21, 'shop', 'External works and security', '2019-05-27 13:26:50', '2019-05-27 13:26:50'),
(22, 'shop', 'Work wear and General Safety', '2019-05-27 13:27:26', '2019-05-27 13:27:26'),
(23, 'shop', 'Plants and Equipments', '2019-05-27 13:27:51', '2019-05-27 13:27:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_05_17_124314_create_categories_table', 1),
(4, '2019_05_17_124626_create_subcategories_table', 1),
(5, '2019_05_17_124647_create_stores_table', 1),
(6, '2019_05_17_124746_create_products_table', 1),
(7, '2019_05_17_124812_create_carts_table', 1),
(8, '2019_05_17_124837_create_cartproducts_table', 1),
(9, '2019_05_17_124905_create_payments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('anyebeevelyn@gmail.com', '1558624453', '2019-05-23 10:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid` bigint(20) DEFAULT NULL,
  `username` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart` bigint(20) DEFAULT NULL,
  `paydate` date DEFAULT NULL,
  `paystatus` tinyint(4) DEFAULT '0',
  `dateapproved` date DEFAULT NULL,
  `approvedby` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortdesc` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productpic` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic4` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(12,2) DEFAULT '0.00',
  `quantity` float(10,2) DEFAULT '0.00',
  `category` bigint(20) DEFAULT '0',
  `subcategory` bigint(20) DEFAULT '0',
  `storeid` bigint(20) DEFAULT '0',
  `discount` int(10) DEFAULT '0',
  `featured` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nosold` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productname`, `shortdesc`, `productpic`, `pic1`, `pic2`, `pic3`, `pic4`, `price`, `quantity`, `category`, `subcategory`, `storeid`, `discount`, `featured`, `nosold`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Inter Door', 'Turkey Luxury Door.Dimensions 1200 X 2100', '1.jpg', '11.jpg', '12.jpg', NULL, NULL, 250000.00, 1.00, 2, 1, 1, 30, 'yes', 0, 0, '2019-05-27 13:45:04', '2019-05-27 13:45:04'),
(2, 'Modern White block', 'Modern white blocks for wall building. Use this for firm solid structures.', '2.jpg', '24.jpg', '22.jpg', '23.jpg', '24.jpg', 1500.00, 20000.00, 1, 13, 1, 0, 'yes', 0, 0, '2019-05-28 11:35:28', '2019-05-28 11:35:28'),
(3, 'Red Brick', 'Reb brick for building walls.', '3.jpg', NULL, NULL, NULL, NULL, 1000.00, 1000000.00, 1, 13, 1, 0, 'yes', 0, 0, '2019-06-05 11:18:54', '2019-06-05 11:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ownername` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ownerphone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owneraddress` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owneremail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idcard` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idcardno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idcardtype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approvedby` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateapproved` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `ownername`, `ownerphone`, `owneraddress`, `owneremail`, `city`, `state`, `idcard`, `idcardno`, `idcardtype`, `approvedby`, `dateapproved`, `status`, `created_at`, `updated_at`) VALUES
(1, 'OyaConstruct.com', '+234803 000000', 'Plot 590F, 1025 Adetokunbo Ademola Crescent, Wuse II, Abuja FCT, Nigeria', 'info@oyaconstruct.com', 'Abuja', 'FCT', NULL, '6789076543', 'national id', NULL, NULL, 0, '2019-05-25 07:30:39', '2019-06-09 05:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `servicetype` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catname` bigint(20) NOT NULL,
  `subcat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `servicetype`, `catname`, `subcat`, `created_at`, `updated_at`) VALUES
(1, 'shop', 2, 'Doors', '2019-05-25 05:41:26', '2019-05-25 05:41:26'),
(2, 'shop', 2, 'Windows', '2019-05-25 05:42:43', '2019-05-25 05:42:43'),
(3, 'shop', 2, 'Doors and windows', '2019-05-25 05:44:13', '2019-05-25 05:44:13'),
(4, 'real estate', 6, 'Residential', '2019-05-27 13:19:25', '2019-05-27 13:19:25'),
(5, 'real estate', 6, 'Commercial', '2019-05-27 13:19:42', '2019-05-27 13:19:42'),
(6, 'real estate', 6, 'Others', '2019-05-27 13:19:55', '2019-05-27 13:19:55'),
(7, 'real estate', 5, 'Residential', '2019-05-27 13:20:08', '2019-05-27 13:20:08'),
(8, 'real estate', 5, 'Commercial', '2019-05-27 13:20:24', '2019-05-27 13:20:24'),
(9, 'real estate', 5, 'Others', '2019-05-27 13:20:33', '2019-05-27 13:20:33'),
(10, 'real estate', 4, 'Residential', '2019-05-27 13:20:46', '2019-05-27 13:20:46'),
(11, 'real estate', 4, 'Commercial', '2019-05-27 13:21:01', '2019-05-27 13:21:01'),
(12, 'real estate', 4, 'Others', '2019-05-27 13:21:10', '2019-05-27 13:21:10'),
(13, 'shop', 1, 'Blocks and Bricks', '2019-05-27 13:29:21', '2019-05-27 13:29:21'),
(14, 'shop', 1, 'Cement', '2019-05-27 13:29:31', '2019-05-27 13:29:31'),
(15, 'shop', 1, 'Cleansing and Chemicals', '2019-05-27 13:29:52', '2019-05-27 13:29:52'),
(16, 'shop', 1, 'Glasses', '2019-05-27 13:30:04', '2019-05-27 13:30:04'),
(17, 'shop', 1, 'Gravel and Stones', '2019-05-27 13:30:26', '2019-05-27 13:30:26'),
(18, 'shop', 22, 'Face masks', '2019-05-28 11:40:33', '2019-05-28 11:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mstatus` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lga` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bvn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankacct` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cardtype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cardnum` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ccv` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `address`, `phone`, `dob`, `gender`, `mstatus`, `lga`, `state`, `bvn`, `bankacct`, `bankname`, `bankcode`, `cardtype`, `cardnum`, `ccv`, `lastlogin`, `status`, `remember_token`, `created_at`, `updated_at`, `last_login`) VALUES
(13, 'EVELYN ANYEBE', 'anyebeevelyn@gmail.com', '2019-05-22 11:52:28', '$2y$10$FnEaWgpHctVYK7E7gpxwouaGcwQWecVua2/ooNtf8MkDOc/9KsnGW', 'admin', 'No 12 Bem hotel road Makurdi', '08135596516', '2019-06-02', 'female', 'single', 'Makurdi', 'Benue State', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '2019-05-22 11:47:37', '2019-06-09 04:50:21', '10/06/2019'),
(15, 'Emani Mary', 'mary@gmail.com', '2019-05-23 08:47:21', '$2y$10$Q3gwp4PD12MVPDrvjFlT7Ox5eYHCshrtoGsPcdoNcwsKkqB3CsLXm', 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, '2019-05-23 08:42:57', '2019-05-23 08:42:57', NULL),
(21, 'Mary Emani', 'maryemani@gmail.com', NULL, '$2y$10$kAy4v9.eItKtfw2roh4GE.gcapERxYNRgG.69is6LxL/Z.tuojM6a', 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-06 09:55:46', '2019-06-06 09:55:46', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartproducts`
--
ALTER TABLE `cartproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartproducts`
--
ALTER TABLE `cartproducts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
