
 

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 03:30 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medprolink_db`
--
CREATE DATABASE IF NOT EXISTS `medprolink_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `medprolink_db`;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `zipcode` varchar(20) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `titles` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `address`, `city`, `country`, `zipcode`, `phone_number`, `titles`) VALUES
(7, 11, '2613 Amherst Ave', 'Fullerton', 'United States', '92831', '17145152458', 'Medical Daily Necessities Suppliers,Surgical Supplies Suppliers'),
(8, 12, '2613 Amherst Ave', 'Fullerton', 'United States', '92831', '17145152458', 'Doctors,Electronic Equipment Suppliers'),
(9, 13, '2613 Amherst Ave', 'Fullerton', 'United States', '92831', '17145152458', 'Doctors,Nurses,Pharmaceutical Suppliers,Medical Daily Necessities Suppliers,Electronic Equipment Suppliers'),
(10, 14, '5555sadfafsaf ave', 'newbee', 'United States', '45687', '1896545321', 'Nurses,Pharmaceutical Suppliers,Medical Daily Necessities Suppliers'),
(11, 15, '2613 Amherst Ave', 'Fullerton', 'United States', '92831', '17145152458', 'Doctors,Medical Daily Necessities Suppliers');

-- --------------------------------------------------------

-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('online','offline') NOT NULL DEFAULT 'offline'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `status`) VALUES
(11, 'lingSao', 'wang', 'ggdasd@hotmai.com', '$2y$10$XIPTMjsI5tg/DqmYM0w.u.AupX90B1Mo57wG1s1o4nGUIUsERHO3W', 'offline'),
(12, 'Jacob', 'Xu', 'xuzhihui@csu.fullerton.edu', '$2y$10$73SgSNM4fY2jfptJFib.JuUZCGz6tooFZ5HSipu3A57qh/tBv.FU6', 'offline'),
(13, 'Zhihui', 'Xu', 'xuzhihuieateat@gmail.com', '$2y$10$4kTin.fZCZG5Bd6.eJMHbOiu59Sohj0/v4Qrupdn6EI5uFs2TUmZ.', 'offline'),
(14, 'cai', 'ji', 'caiji@uiloo.com', '$2y$10$PlDBCpVVtvX9YXkc3xtzQeM.eY5aCQR1fCVxooBrpmVqkV.TWToXW', 'offline'),
(15, 'laoshi', 'wang', 'wang@gg.com', '$2y$10$YkOeTuGvF894vUgHJanSVuvDRRJ/TL.7xGvl8lDDoKWSGZS4y/MF6', 'offline');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
COMMIT;