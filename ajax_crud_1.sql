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
-- Database: `ajax_crud_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `phone`, `status`, `create_at`, `update_at`) VALUES
(3, 'Cameron', 'Gemma', 'bejucu@mailinator.com', '78788 89855', 1, '2025-07-08 06:10:31', '2025-07-08 15:59:08'),
(4, 'Gisela', 'Cecilia', 'xepoqi@mailinator.com', '9852 36741', 1, '2025-07-08 12:14:38', '2025-07-08 15:59:22'),
(5, 'Zahir', 'Karen', 'giwipyriz@mailinator.com', '90590 77272', 1, '2025-07-08 14:26:26', '2025-07-08 15:59:41'),
(6, 'Guinevere', 'Kristen', 'fazim@mailinator.com', '78541 36852', 1, '2025-07-08 14:26:32', '2025-07-08 16:00:00'),
(8, 'Serena', 'Lee', 'terajoxig@mailinator.com', '98545 63215', 1, '2025-07-08 14:26:37', '2025-07-08 16:00:18'),
(9, 'Cameron', 'Gemma', 'bejucu@mailinator.com', '78451 36985', 1, '2025-07-08 14:38:14', '2025-07-08 16:00:32'),
(10, 'Harsh', 'Chavda ', 'hc270373@gmail.com', '98257 60259', 1, '2025-07-08 14:45:38', '2025-07-08 15:58:10'),
(11, 'Patrick', 'Jennifer', 'xuhegeku@mailinator.com', '', 1, '2025-10-06 11:32:16', '2025-10-06 11:32:16');

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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
