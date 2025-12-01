-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2025 at 12:32 PM
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
(4, 'security'),
(1, 'superadmin'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `security_gate_logs`
--

CREATE TABLE `security_gate_logs` (
  `id` int(11) NOT NULL,
  `visitor_request_id` int(11) NOT NULL,
  `v_code` varchar(10) NOT NULL,
  `check_in_time` datetime DEFAULT NULL,
  `check_out_time` datetime DEFAULT NULL,
  `verified_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `security_gate_logs`
--

INSERT INTO `security_gate_logs` (`id`, `visitor_request_id`, `v_code`, `check_in_time`, `check_out_time`, `verified_by`, `created_at`) VALUES
(4, 2, 'V000002', '2025-12-01 11:19:33', '2025-12-01 11:21:37', 5, '2025-12-01 11:19:33'),
(5, 3, 'V000003', '2025-12-01 11:44:51', NULL, 5, '2025-12-01 11:44:51'),
(6, 5, 'V000005', '2025-12-01 16:05:56', '2025-12-01 16:11:00', 13, '2025-12-01 16:05:56'),
(7, 6, 'V000006', '2025-12-01 16:07:15', NULL, 13, '2025-12-01 16:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `hash_key` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT current_timestamp(),
  `email` varchar(150) NOT NULL,
  `employee_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `company_name`, `department_id`, `username`, `password`, `role_id`, `active`, `hash_key`, `created_at`, `created_by`, `email`, `employee_code`) VALUES
(1, NULL, 'UKMPL', 1, 'superadmin', '274d015c638f62ba24b19ca23c9c9503', 1, 1, 'HASHKEY123', '2025-11-20 09:28:43', NULL, '', ''),
(5, NULL, 'UKMPL', 1, 'admin', '457b2f73cbdf3cc57b92efc0aa80cb99', 2, 1, 'HASHKEY123', '2025-11-21 05:54:24', 1, 'mahesh@gmail.com', '123456'),
(6, NULL, 'UKMPL', 3, 'user2', 'e27f4a867eaceaa81eca368d175a7716', 3, 1, 'HASHKEY123', '2025-11-21 22:15:08', 1, '', ''),
(7, NULL, 'UKMPL', 3, 'admin2', 'bde72de2ac7798197faa307a4df2db69', 2, 1, 'HASHKEY123', '2025-11-22 05:56:17', 1, '', ''),
(8, NULL, 'UKML', 1, 'user', 'd8847b1ec55e603141803c54ac610489', 3, 1, 'HASHKEY123', '2025-11-24 00:22:13', 1, '', ''),
(9, NULL, 'UKML', 2, 'userlog', 'df15e08a109a1ca36c6129c4033dff9a', 3, 1, 'HASHKEY123', '2025-11-24 03:40:59', 1, '', ''),
(10, NULL, 'UKML', 4, 'hod', 'c0da0e7607981099b9874324911d646b', 2, 1, 'HASHKEY123', '2025-11-27 23:56:49', 5, '', ''),
(11, NULL, 'UKML', 2, 'FINANCEHOD', 'e27f4a867eaceaa81eca368d175a7716', 2, 1, 'HASHKEY123', '2025-11-30 09:57:12', 5, 'maheshkarna42@gmail.com', '2523011'),
(12, NULL, 'UKML', 3, 'hrhod', 'f271d1efdfba760f7145d4436f845b8e', 2, 1, NULL, '2025-11-30 15:37:58', 5, 'test@gmail.com', '123456'),
(13, 'khan', 'UKML', 5, 'security', '7f56499c9bcb7018d17adba024f12b36', 4, 1, NULL, '2025-12-01 10:32:56', 5, 'khan@gmail.com', '89595875');

-- --------------------------------------------------------

--
-- Table structure for table `user_hashkeys`
--

CREATE TABLE `user_hashkeys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `pass_key` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `v_code` varchar(10) NOT NULL,
  `group_code` varchar(20) NOT NULL,
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
  `securityCheckStatus` tinyint(1) NOT NULL DEFAULT 0,
  `spendTime` varchar(20) DEFAULT NULL,
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

INSERT INTO `visitors` (`id`, `v_code`, `group_code`, `visitor_name`, `visitor_email`, `visitor_phone`, `purpose`, `visit_date`, `description`, `expected_from`, `expected_to`, `host_user_id`, `reference_id`, `status`, `securityCheckStatus`, `spendTime`, `created_by`, `created_at`, `updated_at`, `proof_id_type`, `proof_id_number`, `qr_code`, `vehicle_no`, `vehicle_type`, `vehicle_id_proof`, `visitor_id_proof`, `visit_time`) VALUES
(1, 'V000001', 'GV000001', 'mahesh', 'mahesh@gmail.com', '8959586333', 'Meeting', '2025-11-30', 'To Meet CITO ', NULL, NULL, 5, NULL, 'pending', 0, NULL, 5, '2025-11-30 21:57:29', '2025-11-30 21:57:29', 'PAN Card', '123456', NULL, '123AP', 'Bike', '', '', '21:55:00'),
(2, 'V000002', 'GV000001', 'ramesh', 'maheshkarna42@gmail.com', '8959586333', 'Meeting', '2025-11-30', 'To Meet CITO ', NULL, NULL, 5, NULL, 'approved', 2, NULL, 5, '2025-11-30 21:57:29', '2025-12-01 11:21:37', 'PAN Card', '321PAN', 'visitor_2_qr.png', '123AP', 'Bike', '', '', '21:56:00'),
(3, 'V000003', 'GV000002', 'prakash', 'prakash@gmail.com', '8965689666', 'Meeting', '2025-12-01', 'To Meet Electrical HOD', NULL, NULL, 5, NULL, 'approved', 1, NULL, 5, '2025-11-30 21:59:26', '2025-12-01 11:44:51', 'PAN Card', '1586PAN', 'visitor_3_qr.png', 'V125APA', 'Car', '', '', '21:58:00'),
(4, 'V000004', 'GV000003', 'vamsi T', 'vamsi@gmail.com', '8959563333', 'Interview', '2025-12-01', 'Project Meet Purpose ', NULL, NULL, 5, NULL, 'approved', 0, NULL, 5, '2025-11-30 22:04:49', '2025-12-01 11:15:56', 'PAN Card', '25655585', 'visitor_4_qr.png', '', 'Car', '', '', '09:09:00'),
(5, 'V000005', 'GV000004', 'prakash', 'developers@ramojifilmcity.com', '8959586333', 'Meeting', '2025-12-02', 'to Meet CITO Garu', NULL, NULL, 9, NULL, 'approved', 2, '00:05:04', 9, '2025-12-01 15:52:41', '2025-12-01 16:11:00', 'Aadhar Card', '245863696632', 'visitor_5_qr.png', 'AP123TYT366', 'Bike', '1764584561_d09a987936442c4e0eb1.png', '1764584561_e50065c48f30de3bd02a.png', '09:50:00'),
(6, 'V000006', 'GV000004', 'ravikumar', 'ukmledp@ramojifilmcity.com', '8959586333', 'Meeting', '2025-12-02', 'to Meet CITO Garu', NULL, NULL, 9, NULL, 'approved', 1, NULL, 9, '2025-12-01 15:52:41', '2025-12-01 16:07:15', 'Aadhar Card', '895958633321', 'visitor_6_qr.png', 'AP123TYT366', 'Bike', '', '', '09:52:00'),
(7, 'V000007', 'GV000005', 'mahesh  karna', 'developers@ramojifilmcity.com', '1593574568', 'Site Inspection', '2025-12-02', 'Site Inspection Purpose ', NULL, NULL, 5, NULL, 'approved', 0, NULL, 5, '2025-12-01 16:57:59', '2025-12-01 16:58:19', 'PAN Card', 'PAN2528AT', 'visitor_7_qr.png', ' AP25TST232', 'Car', '', '', '09:57:00');

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
(1, 1, 'Created', NULL, 'pending', '--', 5, '2025-11-30 21:57:29'),
(2, 2, 'Created', NULL, 'pending', '--', 5, '2025-11-30 21:57:29'),
(3, 3, 'Created', NULL, 'pending', '--', 5, '2025-11-30 21:59:26'),
(4, 4, 'Created', NULL, 'pending', '--', 5, '2025-11-30 22:04:49'),
(5, 4, 'approved', 'pending', 'approved', '', 5, '2025-11-30 22:10:14'),
(6, 3, 'approved', 'pending', 'approved', '', 5, '2025-11-30 22:14:41'),
(7, 2, 'approved', 'pending', 'approved', '', 5, '2025-11-30 22:15:44'),
(8, 5, 'Created', NULL, 'pending', '--', 9, '2025-12-01 15:52:41'),
(9, 6, 'Created', NULL, 'pending', '--', 9, '2025-12-01 15:52:41'),
(10, 6, 'approved', 'pending', 'approved', '', 5, '2025-12-01 15:54:02'),
(11, 5, 'approved', 'pending', 'approved', '', 5, '2025-12-01 15:54:10'),
(12, 7, 'Created', NULL, 'pending', '--', 5, '2025-12-01 16:57:59'),
(13, 7, 'approved', 'pending', 'approved', '', 5, '2025-12-01 16:58:18');

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
-- Indexes for table `security_gate_logs`
--
ALTER TABLE `security_gate_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_request_id` (`visitor_request_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `security_gate_logs`
--
ALTER TABLE `security_gate_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- Constraints for table `security_gate_logs`
--
ALTER TABLE `security_gate_logs`
  ADD CONSTRAINT `security_gate_logs_ibfk_1` FOREIGN KEY (`visitor_request_id`) REFERENCES `visitors` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

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
