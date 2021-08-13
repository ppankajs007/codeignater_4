-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2021 at 06:55 PM
-- Server version: 10.3.27-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demogswebtech_adminlite`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2021-02-01-105145', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1612176730, 1),
(2, '2021-02-01-105159', 'App\\Database\\Migrations\\CreateUserRolesTable', 'default', 'App', 1612176730, 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Permissions', '2021-02-11 04:53:23', '0000-00-00 00:00:00'),
(2, 'System Users', '2021-02-11 04:53:35', '0000-00-00 00:00:00'),
(3, 'Messages', '2021-02-11 04:53:44', '0000-00-00 00:00:00'),
(4, 'Orders', '2021-02-11 20:19:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(255) NOT NULL,
  `module_id` int(255) NOT NULL,
  `permission_name` varchar(255) NOT NULL,
  `permission_key` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module_id`, `permission_name`, `permission_key`, `created_at`, `updated_at`) VALUES
(1, 1, 'View Permission', 'View_Permission', '2021-02-11 04:55:35', NULL),
(3, 1, 'Edit Permission', 'Edit_Permission', '2021-02-11 04:55:05', NULL),
(4, 1, 'Delete Permission', 'Delete_Permission', '2021-02-11 04:55:24', NULL),
(5, 2, 'View User', 'View_User', '2021-02-11 04:55:57', NULL),
(6, 2, 'Add User', 'Add_User', '2021-02-11 04:56:09', NULL),
(7, 2, 'Edit User', 'Edit_User', '2021-02-11 04:56:21', NULL),
(8, 2, 'Delete User', 'Delete_User', '2021-02-11 04:56:32', NULL),
(9, 3, 'View Messages', 'View_Messages', '2021-02-11 04:56:49', NULL),
(10, 3, 'Delete Message', 'Delete_Message', '2021-02-11 04:57:05', NULL),
(11, 4, 'View Orders', 'view_orders', '2021-02-11 20:19:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_modules`
--

CREATE TABLE `permission_modules` (
  `pmodules_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission_modules`
--

INSERT INTO `permission_modules` (`pmodules_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Users', '2021-02-05 18:49:13', NULL),
(2, 'Modules', '2021-02-05 18:53:48', NULL),
(3, 'gh', '2021-02-08 12:27:59', NULL),
(4, 'aaaaa', '2021-02-08 12:58:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phoneotp`
--

CREATE TABLE `phoneotp` (
  `id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `otp` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phoneotp`
--

INSERT INTO `phoneotp` (`id`, `phone`, `otp`, `created_at`) VALUES
(7, '094778807758', 123456, '2021-02-04 14:58:09'),
(9, '', 123456, '2021-02-04 14:59:40'),
(11, '098887668190', 123456, '2021-02-04 15:01:27'),
(12, '098887668195', 123456, '2021-02-04 15:02:17'),
(14, '0988876681956', 123456, '2021-02-04 15:08:42'),
(17, ' 94778807758', 123456, '2021-02-04 15:14:38'),
(18, '9876567876', 123456, '2021-02-04 15:19:45'),
(20, ' 94773047758', 123456, '2021-02-04 15:22:24'),
(21, '0778807659', 123456, '2021-02-04 15:24:07'),
(42, ' 94778807768', 123456, '2021-02-04 16:40:26'),
(43, ' 94778807769', 123456, '2021-02-04 16:41:09'),
(45, '0718549926', 123456, '2021-02-04 16:44:34'),
(46, ' 94713047758', 123456, '2021-02-04 16:45:25'),
(47, '94776604495', 123456, '2021-02-04 16:45:53'),
(51, '0769261058', 123456, '2021-02-04 17:29:11'),
(55, '9780721006', 123456, '2021-02-04 18:13:36'),
(57, '9876543210', 123456, '2021-02-05 09:54:06'),
(66, '9988586088', 123456, '2021-02-05 13:48:58'),
(67, '09888766819', 123456, '2021-02-05 15:15:39'),
(68, '09888766810', 615524, '2021-02-05 15:16:21'),
(69, '377823798', 912870, '2021-02-05 15:28:58'),
(72, ' 91 7087671350', 950447, '2021-02-05 15:35:41'),
(74, '6787897686', 418229, '2021-02-05 17:12:40'),
(75, '0788807759', 456227, '2021-02-12 01:51:46'),
(76, '078807759', 461310, '2021-02-12 01:54:27'),
(78, '0713047758', 126558, '2021-02-12 02:12:49'),
(81, '9888898880', 690461, '2021-02-12 19:15:41'),
(83, '9888898800', 123456, '2021-02-12 19:37:03'),
(88, '8989898989', 531028, '2021-02-16 11:23:03'),
(89, '09800098000', 315211, '2021-02-16 14:49:31'),
(92, '9899998999', 296904, '2021-02-16 14:58:26'),
(93, '6786786789', 682262, '2021-02-16 15:00:39'),
(94, '0789824565', 270943, '2021-02-17 01:05:19'),
(95, '0789804512', 713071, '2021-02-17 13:35:21'),
(96, '0783154685', 132369, '2021-02-17 16:29:32'),
(97, '0783014456', 237274, '2021-02-17 16:34:49'),
(98, '09417668032', 379296, '2021-02-17 18:31:11'),
(99, '9417668032', 953787, '2021-02-17 18:32:32'),
(100, '334234', 486284, '2021-02-17 18:34:14'),
(101, '9501406707', 203086, '2021-02-17 18:35:44'),
(102, '9876543', 887203, '2021-02-17 18:36:14'),
(103, '7574534', 631971, '2021-02-17 18:37:31'),
(105, '9876543211', 570807, '2021-02-17 18:41:52'),
(106, '0769442645', 904055, '2021-02-17 18:42:20'),
(107, '654678', 123456, '2021-02-17 18:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(255) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `permissions` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `group_name`, `group_status`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Instructor', 'Active', '1|3|4|5|6|7|8|9|10', '2021-02-11 06:09:35', '0000-00-00 00:00:00'),
(3, 'Moderator', 'Active', '5|6|7|11', '2021-02-11 20:20:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(200) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `password` text NOT NULL,
  `profile` text DEFAULT NULL,
  `permission` text DEFAULT NULL,
  `role_id` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `active`, `password`, `profile`, `permission`, `role_id`, `created_at`, `update_at`) VALUES
(45, 'gsweb', 'tech', 'gsweb', 'gsweb@gmail.com', '9876543222', 1, '$2y$10$FTQ9UJxneg8l2.ICYSS6Mu03e/07InIZBgtZWXl/XnZd2FdrE0jEa', '/uploads/1612502269_cbf62b0a006d5fd380ea.jpeg', '', '', '2021-02-02 14:57:38', '0000-00-00 00:00:00'),
(90, 'Yasitha', 'Gunarathne', 'madhurasri', 'ymonline.info@gmail.com', '+94718807759', 1, '$2y$10$TIXt61y74/adWtB1FYJWn.4x9.DUwGanWAOCNVUoO3BdFen.15vTS', NULL, '', '', '2021-02-03 23:52:51', '0000-00-00 00:00:00'),
(104, 'pankajss3', 'sharma', 'Apers', 'pankajgsweb12345@gmail.com', '', 1, '$2y$10$trvb6ScryvF7lVmyD72c4.9qsDaSH1Ia7DMb4dtUgC32htv9imUI.', NULL, '', '', '2021-02-04 15:09:02', '0000-00-00 00:00:00'),
(106, 'Yasitha', 'Gunarathne', 'madhugune', 'madhurasri@yopmail.com', '+94778807768', 1, '$2y$10$nGnCJhs4nj78W2kKtiX5I.FrLheK78HE0L5OKGau4eWM66/RZMX3C', '/uploads/1613503548_880ec665bfffd7d1a592.jpeg', '', '3', '2021-02-04 15:25:57', '0000-00-00 00:00:00'),
(109, 'pankajss', 'sharma', 'pankajss', 'pankajgsweb@gmail.com', '9876543210', 0, '$2y$10$zajFb2KaGgAteGoy4K.24.rgvZjzkH3mLvz7LfxFAichXCFWEhuou', NULL, '', '', '2021-02-04 15:56:34', '0000-00-00 00:00:00'),
(110, 'fer', 'fdfgdf', 'sdsd', 'ms161660@gmail.com', '', 1, '$2y$10$.2tPNSZImG88hg6FHrJ5kuHH4Eb1N2mgp/dWj2NYL2xo210rTK1MO', NULL, '', '1', '2021-02-04 15:59:43', '0000-00-00 00:00:00'),
(111, 'Asitha', 'Madushan', 'asitha', 'asithamadhu@yopmail.com', '+94713067758', 0, '$2y$10$5DUotEO44iJGmb6HZX9smunyleLvA.UJpAgyH/5YJ.LXpHXRtzfbG', NULL, '', '', '2021-02-04 16:33:27', '0000-00-00 00:00:00'),
(112, 'Kavindu', 'Millagala', 'kavindu', 'kavindu2@yopmail.com', '', 1, '$2y$10$Q2eNWQCNdeDiUa2LqZFVyefqfGYoGLcxoI3JztxIIZZjOIVX63voG', '/uploads/1613077902_ba4ac4ea38bfb75511e8.jpg', '', '', '2021-02-04 16:44:48', '0000-00-00 00:00:00'),
(113, 'Appuwa', 'madushan', 'asithatwo', 'asitha@yomail.com', '', 0, '$2y$10$nICo989KJHoCUQbdzlfgqO4GEfLQDk1tr1yc7zUXvu1zcxHcQbZZS', NULL, '', '', '2021-02-04 16:46:43', '0000-00-00 00:00:00'),
(118, 'gsjhadg', 'sdjhjka', 'sadasd', 'gagan05k14@gmail.com', '6787897686', 1, '$2y$10$nQOwGRaEsLLrWZ39/LKkAuO0tr/DiwxfQCbgTpHrVjohnnDrETR22', NULL, '', '', '2021-02-05 17:13:01', '0000-00-00 00:00:00'),
(119, 'Taran', 'Kaur', 'tarandeep', 'taran@gmail.com', '1234567', 0, '$2y$10$cbCof/lpq3UNXGysOpzjcOOzytoiqE7ot0ggPYVpQDV7TdWIhsxqC', NULL, NULL, '', '2021-02-11 12:44:42', '0000-00-00 00:00:00'),
(120, 'Mani', 'der', 'Maninder', 'maninder1@gmail.com', '2345678', 0, '$2y$10$UGToI8oPJhCoN8HpCj8tZePRf0X160XkvShiLiPqeF6uKQ08Uxasa', NULL, NULL, '', '2021-02-11 12:45:55', '0000-00-00 00:00:00'),
(123, 'Sakshi', 'Sakshi', 'Sakshi', 'sakshi@gmail.com', '234565', 0, '$2y$10$k/9MyA85OYK52OCfhYtdXuZxV7n1BZBENe0fzavsdaAG6/27Y58UG', NULL, NULL, '', '2021-02-11 12:59:10', '0000-00-00 00:00:00'),
(124, 'Gurjeet', 'Singh', 'gurjeet', 'gurjeet@gmail.com', '2345678', 0, '$2y$10$ZHQmJP62cz.nw3qeOoNHt.u0kFkIJ4Yd/vZuNTKIwayd8XF/1isdi', NULL, NULL, '', '2021-02-11 13:04:24', '0000-00-00 00:00:00'),
(125, 'mani', 'singh', 'mani', 'mani@gmail.com', '2345678', 0, '$2y$10$vKNPOhOFJ1Ks5llGpaHJn.WskbLqmVpjot9z727NLfBTuH2iM0t3S', NULL, '', '1', '2021-02-11 13:08:49', '0000-00-00 00:00:00'),
(126, 'rano', 'rano', 'rano', 'rano@gmail.com', '23423434', 0, '$2y$10$Pu6ZPrtIFRNq8TLF0EXAUuCbdT9UZe5K443T6nQ0MXmz2B3S3qMvy', NULL, NULL, '', '2021-02-11 13:11:38', '0000-00-00 00:00:00'),
(127, 'kulwinder', 'billa', 'kulwinder', 'billa@gmail.com', '23578', 0, '$2y$10$e5fyyvKMmP3q1GjbNHwBgOJTeKMbb5BDme.7ixDjbyrsGplm1Sd/2', NULL, NULL, '', '2021-02-11 13:13:27', '0000-00-00 00:00:00'),
(128, 'kaur', 'B', 'kaurb', 'kaurb@gmail.com', '234456789', 0, '$2y$10$2ibBBwTjLFWWvC3Ac.fiTeCixkWRF5KSevRQf5DvB9NsZ.q2gslM2', NULL, NULL, '', '2021-02-11 13:15:12', '0000-00-00 00:00:00'),
(129, 'prabh', 'gill', 'prabhgill', 'prabhgill@gmail.com', '23456789', 1, '$2y$10$QNfC66qNyYTb8wUfFsOFVuQTpfJq2H1vfPWkrEk1IjcuooQpeBFFm', NULL, '', '1,3', '2021-02-11 13:17:06', '0000-00-00 00:00:00'),
(130, 'Supun', 'Bhagya', 'supunbhag', 'supun@yopmail.com', '078807759', 1, '$2y$10$3dv322BQM/MsPcXswU759eIHG62.oWmC2iSFI4UbnHh1iIcWD0eA2', NULL, NULL, '', '2021-02-12 01:55:03', '0000-00-00 00:00:00'),
(135, 'Amit', 'Kumar', 'amit', 'softworld63@gmail.com', '09800098000', 1, '$2y$10$S9Vp7ZcUAgNmlGsDbHede.9kjuo.50TxvInxmwomMjPR30IJxgj.W', NULL, NULL, '', '2021-02-16 14:49:46', '0000-00-00 00:00:00'),
(138, 'Saranga', 'Kaluarachchi', 'sarangakalu', 'sarangakalu@yopmail.com', '', 1, '$2y$10$4Soh/WrTi.qTNfxNPfdTOu1IyK1jlqadaNr6qoTvT3f9mxgZE.806', NULL, NULL, '', '2021-02-17 01:03:56', '0000-00-00 00:00:00'),
(139, 'Tharanga', 'Disasekara', 'tharangadisa', 'tharangadisa@yopmail.com', '0789635541', 0, '$2y$10$73Lct2dBLrVO5DxSBmmzme0s4YIq5ue6V13EnKNCnuGdvMruBQXSa', NULL, NULL, '', '2021-02-17 01:07:28', '0000-00-00 00:00:00'),
(140, 'dasd', 'asd', 'asd', 'sd@edsf.sdasd', '334234', 1, '$2y$10$C/7FkFjxmubR1cgqhxuj.ukry83AgaXjf4QReapUZvESpfqYWnk0u', NULL, NULL, '', '2021-02-17 18:35:06', '0000-00-00 00:00:00'),
(141, 'fhfghg', 'jhfghf', 'hfh', '', '654678', 1, '$2y$10$a.3mIwRwtU2YVlJp76hFhOl9CCYu9CjTqCXS3IPqRlqgDwCqJzSyK', NULL, NULL, '', '2021-02-17 18:39:11', '0000-00-00 00:00:00'),
(142, 'Gagan', 'K', 'gagan', '', '9876543211', 1, '$2y$10$dhv1DIoIlB/EMQ.1/ZeXB.jQ517kDT87nBO3LKpto6/cbv9Wcq/Nu', NULL, NULL, '', '2021-02-17 18:42:06', '0000-00-00 00:00:00'),
(143, 'Shumbalakada', 'Wastakka', 'wastakka', '', '0769442645', 1, '$2y$10$ZJl3iOxm2QOUUwbPy1GAQeNbQFLMAvd8GiFLcQWE8uvyAZ/1qTT3e', NULL, NULL, '', '2021-02-17 18:42:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `role_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`) VALUES
(33, 44, 3, '2021-02-02 12:01:12'),
(34, 45, 1, '2021-02-02 14:57:38'),
(37, 48, 3, '2021-02-02 16:22:03'),
(38, 49, 3, '2021-02-02 16:41:14'),
(39, 50, 3, '2021-02-02 16:42:38'),
(40, 51, 3, '2021-02-03 11:44:50'),
(41, 52, 3, '2021-02-03 11:55:05'),
(42, 53, 3, '2021-02-03 12:12:31'),
(43, 54, 3, '2021-02-03 12:28:14'),
(44, 55, 3, '2021-02-03 12:34:21'),
(45, 56, 1, '2021-02-03 12:59:51'),
(46, 57, 0, '2021-02-03 13:51:38'),
(47, 58, 3, '2021-02-03 13:52:59'),
(48, 59, 3, '2021-02-03 13:57:35'),
(49, 60, 3, '2021-02-03 13:58:56'),
(50, 0, 0, '2021-02-03 14:51:31'),
(51, 0, 0, '2021-02-03 14:51:56'),
(52, 0, 1, '2021-02-03 14:56:45'),
(53, 0, 1, '2021-02-03 14:57:08'),
(54, 0, 3, '2021-02-03 15:03:07'),
(55, 61, 3, '2021-02-03 15:03:36'),
(56, 62, 3, '2021-02-03 15:12:12'),
(58, 64, 3, '2021-02-03 15:24:45'),
(59, 65, 3, '2021-02-03 15:27:43'),
(60, 0, 2, '2021-02-03 15:28:09'),
(61, 66, 2, '2021-02-03 15:28:21'),
(62, 67, 3, '2021-02-03 15:29:28'),
(63, 68, 3, '2021-02-03 15:34:39'),
(64, 69, 3, '2021-02-03 15:36:25'),
(65, 70, 3, '2021-02-03 15:39:05'),
(66, 71, 3, '2021-02-03 15:46:24'),
(68, 73, 3, '2021-02-03 16:03:04'),
(69, 74, 3, '2021-02-03 16:04:12'),
(70, 75, 3, '2021-02-03 16:05:57'),
(72, 77, 3, '2021-02-03 17:55:52'),
(73, 78, 3, '2021-02-03 18:18:04'),
(75, 80, 3, '2021-02-03 18:25:38'),
(82, 87, 3, '2021-02-03 18:38:50'),
(83, 88, 3, '2021-02-03 19:23:45'),
(84, 89, 3, '2021-02-03 19:25:01'),
(85, 90, 3, '2021-02-03 23:52:51'),
(86, 91, 3, '2021-02-04 11:15:41'),
(87, 92, 3, '2021-02-04 11:51:55'),
(91, 96, 3, '2021-02-04 13:48:54'),
(96, 101, 3, '2021-02-04 14:56:32'),
(97, 102, 3, '2021-02-04 15:02:28'),
(98, 103, 3, '2021-02-04 15:06:22'),
(99, 104, 3, '2021-02-04 15:09:02'),
(100, 105, 3, '2021-02-04 15:11:04'),
(101, 106, 3, '2021-02-04 15:25:57'),
(102, 107, 3, '2021-02-04 15:46:31'),
(103, 108, 3, '2021-02-04 15:51:35'),
(104, 109, 3, '2021-02-04 15:56:34'),
(106, 111, 3, '2021-02-04 16:33:27'),
(107, 112, 3, '2021-02-04 16:44:48'),
(108, 113, 3, '2021-02-04 16:46:43'),
(109, 114, 3, '2021-02-04 18:14:08'),
(110, 115, 3, '2021-02-05 13:49:20'),
(111, 116, 3, '2021-02-05 15:16:21'),
(112, 117, 3, '2021-02-05 15:29:34'),
(113, 118, 3, '2021-02-05 17:13:01'),
(114, 130, 3, '2021-02-12 01:55:03'),
(115, 131, 3, '2021-02-12 19:07:12'),
(116, 132, 3, '2021-02-12 19:15:55'),
(117, 133, 3, '2021-02-12 19:36:29'),
(118, 134, 3, '2021-02-16 11:23:18'),
(119, 135, 3, '2021-02-16 14:49:46'),
(120, 136, 3, '2021-02-16 14:57:31'),
(121, 137, 3, '2021-02-16 14:59:56'),
(122, 138, 3, '2021-02-17 01:03:56'),
(123, 139, 3, '2021-02-17 01:07:28'),
(124, 140, 3, '2021-02-17 18:35:06'),
(125, 141, 3, '2021-02-17 18:39:11'),
(126, 142, 3, '2021-02-17 18:42:06'),
(127, 143, 3, '2021-02-17 18:42:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_modules`
--
ALTER TABLE `permission_modules`
  ADD PRIMARY KEY (`pmodules_id`);

--
-- Indexes for table `phoneotp`
--
ALTER TABLE `phoneotp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permission_modules`
--
ALTER TABLE `permission_modules`
  MODIFY `pmodules_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `phoneotp`
--
ALTER TABLE `phoneotp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
