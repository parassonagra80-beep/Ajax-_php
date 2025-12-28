-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2025 at 02:41 PM
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
-- Database: `multiple_image`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `description`, `status`, `create_at`, `update_at`) VALUES
(1, 'moon', 'dfdfddc   uv poivakscvsvi gvgsv yugyusic vugsyu ', 0, '2025-06-16 07:46:51', '2025-06-22 12:44:39'),
(2, '887878', 'quwijcn nnnwninwicn', 0, '2025-06-16 10:22:15', '2025-06-16 12:11:32'),
(3, 'Amet tempora perspi', 'Deleniti velit non ', 0, '2025-06-22 12:45:10', '2025-06-22 12:45:10'),
(4, 'Neque officia volupt', 'Autem molestias qui ', 0, '2025-07-16 06:26:12', '2025-07-16 06:26:12'),
(5, 'Assumenda impedit q', 'Dolor dolore aut fac', 0, '2025-07-16 11:14:21', '2025-07-16 11:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `post_image`
--

CREATE TABLE `post_image` (
  `id` int(20) NOT NULL,
  `post_id` int(20) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_image`
--

INSERT INTO `post_image` (`id`, `post_id`, `image`, `create_at`, `update_at`) VALUES
(4, 2, 'Vivo-Logo.png', '2025-06-16 10:22:15', '2025-06-16 10:22:15'),
(5, 2, 'download.png', '2025-06-16 10:22:15', '2025-06-16 10:22:15'),
(6, 2, 'images (1).png', '2025-06-16 10:22:15', '2025-06-16 10:22:15'),
(26, 1, 'IMG_20250620_101047.jpg', '2025-06-22 12:10:14', '2025-06-22 12:10:14'),
(30, 1, 'IMG_20250620_101117.jpg', '2025-06-22 12:10:31', '2025-06-22 12:10:31'),
(31, 3, 'download (1).jpg', '2025-06-22 12:45:10', '2025-06-22 12:45:10'),
(33, 3, 'download.jpg', '2025-06-22 12:45:10', '2025-06-22 12:45:10'),
(34, 1, 'download (1).jpg', '2025-06-23 05:25:43', '2025-06-23 05:25:43'),
(35, 1, 'download.jpg', '2025-06-23 05:25:43', '2025-06-23 05:25:43'),
(36, 4, '12X18-010( 01 copy).jpg', '2025-07-16 06:26:12', '2025-07-16 06:26:12'),
(37, 4, '12X18-009( 01 copy).jpg', '2025-07-16 06:26:12', '2025-07-16 06:26:12'),
(38, 4, '12X18-006( 01 copy).jpg', '2025-07-16 06:26:12', '2025-07-16 06:26:12'),
(39, 5, '12X18-15( 01 copy).jpg', '2025-07-16 11:14:21', '2025-07-16 11:14:21'),
(40, 5, 'DSC_0973 copy.png', '2025-07-16 11:14:21', '2025-07-16 11:14:21'),
(41, 5, '8X12-02( 02 copy).jpg', '2025-07-16 11:14:22', '2025-07-16 11:14:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_image`
--
ALTER TABLE `post_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post_image`
--
ALTER TABLE `post_image`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post_image`
--
ALTER TABLE `post_image`
  ADD CONSTRAINT `post_image_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
