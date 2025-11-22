-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2025 at 12:46 PM
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
-- Database: `vsmshell_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`) VALUES
(2, 'Finance'),
(3, 'HR'),
(1, 'IT'),
(4, 'Procurement'),
(5, 'Stores');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(2, 'admin'),
(1, 'superadmin'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `hash_key` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_name`, `department_id`, `username`, `password`, `role_id`, `hash_key`, `created_at`, `created_by`) VALUES
(1, 'UKMPL', 1, 'superadmin', 'df151ee318beb897bc7fa8d067b25d76', 1, 'HASHKEY123', '2025-11-20 09:28:43', NULL),
(5, 'UKMPL', 1, 'admin', 'e27f4a867eaceaa81eca368d175a7716', 2, 'HASHKEY123', '2025-11-21 05:54:24', 1),
(6, 'UKMPL', 3, 'user2', 'e27f4a867eaceaa81eca368d175a7716', 3, 'HASHKEY123', '2025-11-21 22:15:08', 1),
(7, 'UKMPL', 3, 'admin2', 'bde72de2ac7798197faa307a4df2db69', 2, 'HASHKEY123', '2025-11-22 05:56:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_hashkeys`
--

CREATE TABLE `user_hashkeys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `visitor_name` varchar(200) NOT NULL,
  `visitor_email` varchar(200) NOT NULL,
  `visitor_phone` varchar(50) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `visit_date` date NOT NULL,
  `expected_from` time DEFAULT NULL,
  `expected_to` time DEFAULT NULL,
  `host_user_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected','checked_in','checked_out','closed','no_show') DEFAULT 'pending',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `proof_id_type` varchar(100) DEFAULT NULL,
  `proof_id_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `visitor_name`, `visitor_email`, `visitor_phone`, `purpose`, `visit_date`, `expected_from`, `expected_to`, `host_user_id`, `status`, `created_by`, `created_at`, `updated_at`, `proof_id_type`, `proof_id_number`) VALUES
(4, 'mahesh', 'maheshkarna@gmail.com', '7894561234', 'test', '2025-11-22', '10:23:00', '11:23:00', 6, 'pending', NULL, '2025-11-22 10:24:05', '2025-11-22 10:24:05', NULL, NULL),
(5, 'ravi', 'ravi@gmail.com', '1593574568', 'General Visit', '2025-11-29', '10:56:00', '00:00:00', 6, 'pending', NULL, '2025-11-22 10:56:47', '2025-11-22 10:56:47', 'PAN Card', '1111111'),
(6, 'ravi', 'ravi@gmail.com', '1593574568', 'General Visit', '2025-11-29', '10:56:00', '00:00:00', 6, 'pending', NULL, '2025-11-22 10:57:01', '2025-11-22 10:57:01', 'PAN Card', '1111111'),
(7, 'praveen', 'praveen@gmail.com', '7894561236', 'General Visit', '2025-11-29', '00:00:00', '00:00:00', 6, 'pending', NULL, '2025-11-22 11:01:36', '2025-11-22 11:01:36', 'Aadhar Card', '1234856'),
(8, 'praveen', 'praveen@gmail.com', '7894561236', 'General Visit', '2025-11-29', '00:00:00', '00:00:00', 6, 'pending', NULL, '2025-11-22 11:01:50', '2025-11-22 11:01:50', 'Aadhar Card', '1234856'),
(9, 'ravi', 'ravi@gmail.com', '7894561236', 'Document Submission', '0000-00-00', NULL, NULL, 6, 'pending', 6, '2025-11-22 11:16:55', '2025-11-22 11:16:55', 'PAN Card', '1234856'),
(10, 'mahesh', 'maheshkarna@gmail.com', '7894561234', 'Meeting', '0000-00-00', NULL, NULL, 6, 'pending', 6, '2025-11-22 11:21:00', '2025-11-22 11:21:00', 'Voter ID', '1234856'),
(11, 'mahesh', 'maheshkarna@gmail.com', '1593574568', 'Meeting', '0000-00-00', NULL, NULL, 6, 'pending', 6, '2025-11-22 11:23:45', '2025-11-22 11:23:45', 'Passport', '1234856'),
(12, 'mahesh', 'maheshkarna@gmail.com', '7894561234', 'Meeting', '0000-00-00', NULL, NULL, 6, 'pending', 6, '2025-11-22 11:36:42', '2025-11-22 11:36:42', 'PAN Card', '1234856'),
(13, 'sreenivas', 'sreenivas@gmail.com', '7894561234', 'Event Visit', '0000-00-00', NULL, NULL, 1, 'pending', 1, '2025-11-22 17:02:05', '2025-11-22 17:02:05', 'PAN Card', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `host_user_id` (`host_user_id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  ADD CONSTRAINT `user_hashkeys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_ibfk_1` FOREIGN KEY (`host_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `visitors_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
