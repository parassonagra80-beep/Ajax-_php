-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2025 at 02:40 PM
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
-- Database: `ajax_crud_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` enum('MALE','FEMALE') NOT NULL DEFAULT 'MALE',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `gender`, `status`, `create_at`, `update_at`) VALUES
(2, 'Hector Vincent', 'posycobar@mailinator.com', '+1 (761) 538-5532', 'MALE', 0, '2025-07-11 05:42:43', '2025-07-11 10:26:04'),
(3, 'Hector Vincent', 'posycobar@mailinator.com', '+1 (761) 538-5532', 'MALE', 0, '2025-07-11 05:42:52', '2025-07-11 05:42:52'),
(4, 'Orson Glover', 'moxega@mailinator.com', '+1 (737) 957-9754', 'MALE', 1, '2025-07-11 05:43:26', '2025-07-11 05:43:26'),
(5, 'Alika Mccormick', 'rofynimy@mailinator.com', '+1 (955) 478-4419', 'MALE', 1, '2025-07-11 07:10:53', '2025-07-11 07:10:53'),
(6, 'Guinevere Romero', 'tudak@mailinator.com', '+1 (765) 944-7885', 'FEMALE', 1, '2025-07-11 07:11:00', '2025-07-11 07:11:00'),
(7, 'Scarlet Schmidt', 'becegasig@mailinator.com', '+1 (456) 547-8247', 'FEMALE', 1, '2025-07-11 07:11:05', '2025-07-11 07:11:05'),
(11, 'Lilah Snider', 'wufedifuja@mailinator.com', '+1 (182) 441-4553', 'FEMALE', 1, '2025-07-11 07:15:45', '2025-07-11 07:15:45'),
(19, 'Kennan Medina', 'zygu@mailinator.com', '+1 (112) 442-7645', 'FEMALE', 1, '2025-10-06 11:32:36', '2025-10-06 11:32:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
