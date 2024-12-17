-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 07:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `address` text DEFAULT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `date_of_birth` date NOT NULL,
  `profile_picture` varchar(250) DEFAULT NULL,
  `signature` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `mobile`, `email`, `password`, `status`, `address`, `gender`, `date_of_birth`, `profile_picture`, `signature`, `created_at`) VALUES
(1, 'kumar', '3', '75012345670099', 'sunil@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'kondapur', '', '2024-12-21', 'profile_img/676162a53e548_srikant passphoto.jpg', NULL, '2024-12-16 15:33:28'),
(2, 'Super Admin', '1', '1234567890', 'superadmin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'hyderabad', 'Male', '2024-05-14', '', NULL, '2024-12-16 18:40:33'),
(3, 'admin', '2', '1234567890', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'hitech', '', '2024-12-11', '', NULL, '2024-12-16 18:44:03'),
(4, 'ram', '3', '1234567890', 'ram@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'kondapur', 'Male', '2024-12-07', 'profile_img/6760c8b96c30c_OCIF2023CA.png', NULL, '2024-12-16 21:31:15'),
(5, 'Skumar', '3', '112334455556', 'testt@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 0, 'kondapur', 'Male', '2016-05-10', 'profile_img/6761629385136_srikant passphoto.png', NULL, '2024-12-16 23:44:12'),
(8, 'ram', '3', '1234567890', 'ram1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'kondapur', 'Male', '2024-12-07', 'profile_img/6760c8b96c30c_OCIF2023CA.png', NULL, '2024-12-16 21:31:15'),
(9, 'Skumar', '3', '112334455556', 'test2@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 0, 'kondapur', 'Male', '2016-05-10', 'profile_img/6761629385136_srikant passphoto.png', NULL, '2024-12-16 23:44:12'),
(10, 'Skumar', '3', '112334455556', 'test3@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 0, 'kondapur', 'Male', '2016-05-10', 'profile_img/6761629385136_srikant passphoto.png', NULL, '2024-12-16 23:44:12'),
(11, 'Skumar', '3', '112334455556', 'test4@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 0, 'kondapur', 'Male', '2016-05-10', 'profile_img/6761629385136_srikant passphoto.png', NULL, '2024-12-16 23:44:12'),
(12, 'Skumar', '3', '112334455556', 'test5@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 0, 'kondapur', 'Male', '2016-05-10', 'profile_img/6761629385136_srikant passphoto.png', NULL, '2024-12-16 23:44:12'),
(13, 'Skumar', '3', '112334455556', 'test6@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 0, 'kondapur', 'Male', '2016-05-10', 'profile_img/6761629385136_srikant passphoto.png', NULL, '2024-12-16 23:44:12'),
(14, 'Skumar', '3', '112334455556', 'test7@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 0, 'kondapur', 'Male', '2016-05-10', 'profile_img/6761629385136_srikant passphoto.png', NULL, '2024-12-16 23:44:12'),
(15, 'Skumar', '3', '112334455556', 'test8@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 0, 'kondapur', 'Male', '2016-05-10', 'profile_img/6761629385136_srikant passphoto.png', NULL, '2024-12-16 23:44:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
