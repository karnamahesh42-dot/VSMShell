-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2025 at 12:40 PM
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
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `reference_person_role` enum('Supervisor','Manager','Mediator','Other') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`id`, `name`, `email`, `phone`, `address`, `description`, `reference_person_role`, `status`, `created_by`, `created_at`) VALUES
(1, 'Mahesh', 'satisht@gmail.com', '8919146333', 'Test', 'Test \r\nDescription', 'Manager', 1, 5, '2025-11-26 11:52:14'),
(2, 'Sathish', 'satish@gmail.com', '8919146333', 'kakinada', 'reference Person', 'Mediator', 1, 5, '2025-11-26 12:12:04'),
(3, 'sreenivas', 'srenivas@gmai.com', '8919146333', 'kakinada', 'abc', 'Manager', 1, 5, '2025-11-27 12:01:19'),
(4, 'Krishna V', 'krishnadvasireddy@gmail.com', '9100060606', 'abnc', 'xyz', 'Manager', 1, 5, '2025-11-28 12:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `reference_visitor_requests`
--

CREATE TABLE `reference_visitor_requests` (
  `id` int(11) NOT NULL,
  `rvr_code` varchar(10) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `visit_date` date NOT NULL,
  `visitor_count` int(11) DEFAULT 1,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reference_visitor_requests`
--

INSERT INTO `reference_visitor_requests` (`id`, `rvr_code`, `reference_id`, `purpose`, `visit_date`, `visitor_count`, `description`, `status`, `created_by`, `created_at`) VALUES
(5, 'RVR0001', 1, 'Event Purpose ', '2025-11-27', 10, 'xyz', 1, 5, '2025-11-26 10:51:35'),
(6, 'RVR0002', 3, 'Event Purpose', '2025-11-28', 50, 'trestydft', 1, 5, '2025-11-27 06:32:12'),
(7, 'RVR0003', 4, 'recce', '2025-11-28', 20, 'xxcxdkl,l,a,', 1, 5, '2025-11-28 07:18:28'),
(8, 'RVR0004', 3, 'event', '2025-11-29', 10, '', 1, 9, '2025-11-28 09:12:45'),
(9, 'RVR0005', 3, 'event', '2025-11-29', 25, '', 1, 9, '2025-11-28 09:16:17');

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
(1, 'UKMPL', 1, 'superadmin', '274d015c638f62ba24b19ca23c9c9503', 1, 'HASHKEY123', '2025-11-20 09:28:43', NULL),
(5, 'UKMPL', 1, 'admin', '457b2f73cbdf3cc57b92efc0aa80cb99', 2, 'HASHKEY123', '2025-11-21 05:54:24', 1),
(6, 'UKMPL', 3, 'user2', 'e27f4a867eaceaa81eca368d175a7716', 3, 'HASHKEY123', '2025-11-21 22:15:08', 1),
(7, 'UKMPL', 3, 'admin2', 'bde72de2ac7798197faa307a4df2db69', 2, 'HASHKEY123', '2025-11-22 05:56:17', 1),
(8, 'UKML', 1, 'user', 'd8847b1ec55e603141803c54ac610489', 3, 'HASHKEY123', '2025-11-24 00:22:13', 1),
(9, 'UKML', 2, 'userlog', 'df15e08a109a1ca36c6129c4033dff9a', 3, 'HASHKEY123', '2025-11-24 03:40:59', 1),
(10, 'UKML', 4, 'hod', 'c0da0e7607981099b9874324911d646b', 2, 'HASHKEY123', '2025-11-27 23:56:49', 5);

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
  `v_code` varchar(10) NOT NULL,
  `visitor_name` varchar(200) NOT NULL,
  `visitor_email` varchar(200) NOT NULL,
  `visitor_phone` varchar(50) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `visit_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `expected_from` time DEFAULT NULL,
  `expected_to` time DEFAULT NULL,
  `host_user_id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected','checked_in','checked_out','closed','no_show') DEFAULT 'pending',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `proof_id_type` varchar(100) DEFAULT NULL,
  `proof_id_number` varchar(100) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `vehicle_no` varchar(50) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `vehicle_id_proof` varchar(255) DEFAULT NULL,
  `visitor_id_proof` varchar(255) DEFAULT NULL,
  `visit_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `v_code`, `visitor_name`, `visitor_email`, `visitor_phone`, `purpose`, `visit_date`, `description`, `expected_from`, `expected_to`, `host_user_id`, `reference_id`, `status`, `created_by`, `created_at`, `updated_at`, `proof_id_type`, `proof_id_number`, `qr_code`, `vehicle_no`, `vehicle_type`, `vehicle_id_proof`, `visitor_id_proof`, `visit_time`) VALUES
(3, 'V00001', 'mahesh', 'maheshkarna@gmail.com', '7894561234', 'Interview', '2025-11-27', 'test', NULL, NULL, 5, NULL, 'approved', 5, '2025-11-26 17:21:16', '2025-11-27 11:59:05', 'Aadhar Card', '582369745244', 'visitor_3_qr.png', '', '', '', '', '17:23:00'),
(4, 'V00002', 'Ramesh', 'ravi@gmail.com', '7894561235', 'General Visit', '2025-11-28', 'TEST ', NULL, NULL, 5, NULL, 'approved', 5, '2025-11-27 09:25:23', '2025-11-27 09:44:35', 'PAN Card', 'TT1235', 'visitor_4_qr.png', ' AP25TST232', 'Bike', '', '', '09:26:00'),
(5, 'V00003', 'Ravi Kumar', 'karnamahesh42@gmail.com', '8959562333', 'Interview', '2025-11-28', 'Test ', NULL, NULL, 5, NULL, 'approved', 5, '2025-11-28 11:26:29', '2025-11-28 12:30:49', 'Aadhar Card', '123456', 'visitor_5_qr.png', 'AP123RT215', 'Bike', '', '', '11:26:00'),
(6, 'V00004', 'Sreenivas', 'ukmledp@ramojifilmcity.com', '1593574568', 'General Visit', '2025-11-29', 'TEST Visit', NULL, NULL, 5, NULL, 'approved', 5, '2025-11-28 11:44:53', '2025-11-28 11:45:05', 'Voter ID', '78956654', 'visitor_6_qr.png', 'AP123RT215', 'Car', '', '', '11:51:00'),
(7, 'V00005', 'Sreenivas T', 'ukmledp@ramojifilmcity.com', '1593574568', 'General Visit', '2025-11-29', 'Test', NULL, NULL, 5, NULL, 'approved', 5, '2025-11-28 12:01:42', '2025-11-28 12:01:52', 'PAN Card', '123543', 'visitor_7_qr.png', '1255DSS22', 'Car', '', '', '12:02:00'),
(8, 'V00006', 'Ramesh', 'karnamahesh42@gmail.com', '8919146333', 'Meeting', '2025-11-29', 'Test', NULL, NULL, 5, NULL, 'approved', 5, '2025-11-28 12:33:14', '2025-11-28 12:33:28', 'PAN Card', '12354685', 'visitor_8_qr.png', ' AP25TST232', 'Car', '', '', '12:33:00'),
(9, 'V00007', 'Krishna Vasireddy', 'krishna.vasireddy@gmail.com', '9100060606', 'Meeting', '2025-11-28', 'xyz', NULL, NULL, 9, NULL, 'approved', 9, '2025-11-28 12:41:40', '2025-11-28 12:42:25', 'Aadhar Card', '565468-8878629-987727', 'visitor_9_qr.png', 'TS07HS5099', 'Car', '', '', '13:40:00'),
(10, 'V00008', 'Sailesh Kumar T', 'karnamahesh42@gmail.com', '1593574568', 'Interview', '2025-11-29', 'Test', NULL, NULL, 5, NULL, 'approved', 5, '2025-11-28 14:17:06', '2025-11-28 14:21:50', 'PAN Card', '1234856', 'visitor_10_qr.png', 'TEST123456', 'Car', '', '', '14:16:00'),
(11, 'V00009', 'mahesh', 'ravi@gmail.com', '7894561234', 'Meeting', '2025-11-29', ' test', NULL, NULL, 9, NULL, 'pending', 9, '2025-11-28 16:46:25', '2025-11-28 16:46:25', 'Aadhar Card', '1111111', NULL, ' AP25TST232', 'Car', '', '', '16:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` int(11) NOT NULL,
  `visitor_request_id` int(11) NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `old_status` varchar(50) DEFAULT NULL,
  `new_status` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `performed_by` int(11) NOT NULL,
  `performed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_logs`
--

INSERT INTO `visitor_logs` (`id`, `visitor_request_id`, `action_type`, `old_status`, `new_status`, `remarks`, `performed_by`, `performed_at`) VALUES
(2, 3, 'Created', NULL, 'pending', '--', 5, '2025-11-26 17:21:16'),
(3, 4, 'Created', NULL, 'pending', '--', 5, '2025-11-27 09:25:23'),
(4, 4, 'approved', 'pending', 'approved', '', 5, '2025-11-27 09:44:34'),
(5, 3, 'approved', 'pending', 'approved', '', 5, '2025-11-27 11:59:05'),
(6, 5, 'Created', NULL, 'pending', '--', 5, '2025-11-28 11:26:29'),
(7, 5, 'approved', 'pending', 'approved', '', 5, '2025-11-28 11:27:01'),
(8, 6, 'Created', NULL, 'pending', '--', 5, '2025-11-28 11:44:53'),
(9, 6, 'approved', 'pending', 'approved', '', 5, '2025-11-28 11:45:05'),
(10, 7, 'Created', NULL, 'pending', '--', 5, '2025-11-28 12:01:42'),
(11, 7, 'approved', 'pending', 'approved', '', 5, '2025-11-28 12:01:51'),
(12, 8, 'Created', NULL, 'pending', '--', 5, '2025-11-28 12:33:14'),
(13, 8, 'approved', 'pending', 'approved', '', 5, '2025-11-28 12:33:26'),
(14, 8, 'approved', 'approved', 'approved', '', 5, '2025-11-28 12:33:28'),
(15, 9, 'Created', NULL, 'pending', '--', 9, '2025-11-28 12:41:40'),
(16, 9, 'approved', 'pending', 'approved', '', 9, '2025-11-28 12:42:25'),
(17, 10, 'Created', NULL, 'pending', '--', 5, '2025-11-28 14:17:06'),
(18, 10, 'approved', 'pending', 'approved', '', 5, '2025-11-28 14:21:49'),
(19, 10, 'approved', 'approved', 'approved', '', 5, '2025-11-28 14:21:50'),
(20, 11, 'Created', NULL, 'pending', '--', 9, '2025-11-28 16:46:25');

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
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `reference_visitor_requests`
--
ALTER TABLE `reference_visitor_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rvr_code` (`rvr_code`),
  ADD KEY `reference_id` (`reference_id`);

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
  ADD UNIQUE KEY `v_code` (`v_code`),
  ADD KEY `host_user_id` (`host_user_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_request_id` (`visitor_request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reference_visitor_requests`
--
ALTER TABLE `reference_visitor_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reference`
--
ALTER TABLE `reference`
  ADD CONSTRAINT `reference_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `reference_visitor_requests`
--
ALTER TABLE `reference_visitor_requests`
  ADD CONSTRAINT `reference_visitor_requests_ibfk_1` FOREIGN KEY (`reference_id`) REFERENCES `reference` (`id`);

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
