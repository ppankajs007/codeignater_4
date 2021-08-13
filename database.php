-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2021 at 07:15 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codi4`
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
(4, 'Orders', '2021-02-11 20:19:26', '0000-00-00 00:00:00'),
(5, 'hellow', '2021-08-13 16:53:03', '0000-00-00 00:00:00');

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
(11, 4, 'View Orders', 'view_orders', '2021-02-11 20:19:53', NULL),
(12, 5, 'new hello', 'llllllllllll', '2021-08-13 16:55:04', NULL);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permission_modules`
--
ALTER TABLE `permission_modules`
  MODIFY `pmodules_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `phoneotp`
--
ALTER TABLE `phoneotp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
