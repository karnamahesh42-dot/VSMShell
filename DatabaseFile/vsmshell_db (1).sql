-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 12:37 PM
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
(1, 1, 'V000001', '2025-12-07 14:00:43', NULL, 1, '2025-12-07 14:00:43'),
(2, 2, 'V000002', '2025-12-07 14:01:03', '2025-12-07 15:14:51', 1, '2025-12-07 14:01:03'),
(3, 12, 'V000012', '2025-12-07 15:24:43', NULL, 1, '2025-12-07 15:24:43'),
(4, 24, 'V000024', '2025-12-07 22:39:16', NULL, 1, '2025-12-07 22:39:16'),
(5, 4, 'V000004', '2025-12-08 09:23:47', NULL, 1, '2025-12-08 09:23:47'),
(6, 26, 'V000026', '2025-12-08 10:49:40', '2025-12-08 12:25:42', 13, '2025-12-08 10:49:40'),
(7, 27, 'V000027', '2025-12-08 10:50:14', NULL, 13, '2025-12-08 10:50:14');

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
(1, 'mahesh', 'UKMPL', 1, 'superadmin', '274d015c638f62ba24b19ca23c9c9503', 1, 1, 'HASHKEY123', '2025-11-20 09:28:43', NULL, 'maheshkarna42@gmail.com', '2523011'),
(5, 'Sreenivas t', 'UKMPL', 1, 'itadmin', '7f26dfeae2ef1319cc069e939ce87693', 2, 1, 'HASHKEY123', '2025-11-21 05:54:24', 1, 'ukmledp@ramojifilmcity.com', '12345678'),
(6, 'Prakash', 'UKMPL', 3, 'user2', 'e27f4a867eaceaa81eca368d175a7716', 3, 1, 'HASHKEY123', '2025-11-21 22:15:08', 1, 'prakash@gmail.com', '789654159'),
(7, 'Prasad ', 'UKMPL', 3, 'hrhod', 'f271d1efdfba760f7145d4436f845b8e', 2, 1, 'HASHKEY123', '2025-11-22 05:56:17', 1, 'prasad@gmail.com', '951357456'),
(8, 'Sury kumar', 'UKMPL', 1, 'ituser', '8e3f128f3e5075f40cd8b8361cb1d24d', 3, 0, 'HASHKEY123', '2025-11-24 00:22:13', 1, 'kumar@gmail.com', '87456321'),
(9, 'ramesh', 'UKMPL', 2, 'userlog', 'df15e08a109a1ca36c6129c4033dff9a', 3, 1, 'HASHKEY123', '2025-11-24 03:40:59', 1, 'ramesh@gmail.com', '951456357'),
(10, 'sailesh kumar', 'UKMPL', 2, 'hod', 'c0da0e7607981099b9874324911d646b', 2, 1, 'HASHKEY123', '2025-11-27 23:56:49', 5, 'miscentraloffice@ramojifilmcity.com', '741963258'),
(11, 'Satish Kumar', 'UKMPL', 2, 'FINANCEHOD', 'e27f4a867eaceaa81eca368d175a7716', 2, 1, 'HASHKEY123', '2025-11-30 09:57:12', 5, 'gmaccounts@ramojifilmcity.com', '321987456'),
(12, 'pallam raju', 'UKMPL', 3, 'hruser', '5980d6ad05354bd8681adff071323804', 2, 1, 'HASHKEY123', '2025-11-30 15:37:58', 5, 'raju@gmail.com', '456812397'),
(13, 'khan', 'UKMPL', 5, 'security', '7f56499c9bcb7018d17adba024f12b36', 4, 1, NULL, '2025-12-01 10:32:56', 5, 'khan@gmail.com', '89595875'),
(14, 'Kumar', 'UKMPL', 5, 'kumar', 'b9b580e1f1d30f72a52c9696dfa3c1a3', 3, 0, NULL, '2025-12-02 03:46:21', 5, 'kumar@gmail.com', '53532581');

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
  `request_header_id` int(11) DEFAULT NULL,
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
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
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

INSERT INTO `visitors` (`id`, `request_header_id`, `v_code`, `group_code`, `visitor_name`, `visitor_email`, `visitor_phone`, `purpose`, `visit_date`, `description`, `expected_from`, `expected_to`, `host_user_id`, `reference_id`, `status`, `securityCheckStatus`, `spendTime`, `created_by`, `created_at`, `updated_at`, `proof_id_type`, `proof_id_number`, `qr_code`, `vehicle_no`, `vehicle_type`, `vehicle_id_proof`, `visitor_id_proof`, `visit_time`) VALUES
(1, 1, 'V000001', 'GV000001', 'raghavendra', 'ragavendra@gmail.com', '8919146333', 'General Visit', '2025-12-06', 'Test 1', NULL, NULL, 9, NULL, 'approved', 1, NULL, 9, '2025-12-06 15:31:07', '2025-12-07 14:00:43', 'PAN Card', '123546S', 'visitor_V000001_qr.png', ' AP25TST232', 'Bike', '', '', '15:30:00'),
(2, 2, 'V000002', 'GV000002', 'Prakash', 'john@example.com', '9876543210', 'Meeting', '2025-12-06', 'SAP Meeting Purpose ', NULL, NULL, 9, NULL, 'approved', 2, '01:13:48', 9, '2025-12-06 15:32:18', '2025-12-07 15:14:51', 'Aadhaar Card', '123456789012', 'visitor_V000002_qr.png', 'TN10AB1234', 'Car', '', '', '15:31:00'),
(3, 2, 'V000003', 'GV000002', 'Sharath', 'mary@example.com', '9876501234', 'Meeting', '2025-12-06', 'SAP Meeting Purpose ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-06 15:32:18', '2025-12-06 16:33:07', 'PAN Card', 'ABCDE1234F', 'visitor_V000003_qr.png', 'TN09XY9876', 'Bike', '', '', '15:31:00'),
(4, 3, 'V000004', 'GV000003', 'raju', 'john@example.com', '9876543210', 'Event Visit', '2025-12-05', 'test description ', NULL, NULL, 9, NULL, 'approved', 1, NULL, 9, '2025-12-06 15:43:28', '2025-12-08 09:23:47', 'Aadhaar Card', '123456789012', 'visitor_V000004_qr.png', 'TN10AB1234', 'Car', '', '', '22:00:00'),
(5, 3, 'V000005', 'GV000003', 'shyam', 'mary@example.com', '9876501234', 'Event Visit', '2025-12-05', 'test description ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-06 15:43:28', '2025-12-06 16:34:58', 'PAN Card', 'ABCDE1234F', 'visitor_V000005_qr.png', 'TN09XY9876', 'Bike', '', '', '22:00:00'),
(6, 4, 'V000006', 'GV000004', 'Prakash', 'john@example.com', '9876543210', 'General Visit', '2025-12-06', 'Test@gmail.com', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-06 16:48:41', '2025-12-06 16:50:16', 'Aadhaar Card', '123456789012', 'visitor_V000006_qr.png', 'TN10AB1234', 'Car', '', '', '16:48:00'),
(7, 4, 'V000007', 'GV000004', 'Sharath', 'mary@example.com', '9876501234', 'General Visit', '2025-12-06', 'Test@gmail.com', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-06 16:48:41', '2025-12-06 16:50:17', 'PAN Card', 'ABCDE1234F', 'visitor_V000007_qr.png', 'TN09XY9876', 'Bike', '', '', '16:48:00'),
(8, 5, 'V000008', 'GV000005', 'ravikumara', 'ravi@gmail.com', '89494568324', 'General Visit', '2025-12-06', 'Test Description ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-06 16:49:44', '2025-12-06 16:54:27', 'Aadhar Card', '7489456234586', 'visitor_V000008_qr.png', '', '', '', '', '16:48:00'),
(9, 6, 'V000009', 'GV000006', 'PRATHAP', 'prathap@gmail.com', '7894561235', 'Meeting', '2025-12-05', 'Rdfsdf', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-06 17:00:18', '2025-12-06 17:04:40', 'PAN Card', '12345687', 'visitor_V000009_qr.png', ' AP25TST232', 'Bike', '', '', '16:59:00'),
(10, 7, 'V000010', 'GV000007', 'Prakash', 'john@example.com', '9876543210', 'Meeting', '2025-12-05', 'test', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-06 17:01:08', '2025-12-06 17:05:18', 'Aadhaar Card', '123456789012', 'visitor_V000010_qr.png', 'TN10AB1234', 'Car', '', '', '17:00:00'),
(11, 7, 'V000011', 'GV000007', 'Sharath', 'mary@example.com', '9876501234', 'Meeting', '2025-12-05', 'test', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-06 17:01:08', '2025-12-06 17:05:19', 'PAN Card', 'ABCDE1234F', 'visitor_V000011_qr.png', 'TN09XY9876', 'Bike', '', '', '17:00:00'),
(12, 8, 'V000012', 'GV000008', 'Prakash etred', 'john@example.com', '9876543210', 'Meeting', '2025-12-06', 'test', NULL, NULL, 9, NULL, 'approved', 1, NULL, 9, '2025-12-06 17:01:41', '2025-12-07 15:24:43', 'Aadhaar Card', '123456789012', 'visitor_V000012_qr.png', 'TN10AB1234', 'Car', '', '', '17:01:00'),
(13, 8, 'V000013', 'GV000008', 'Sharath dfsd', 'mary@example.com', '9876501234', 'Meeting', '2025-12-06', 'test', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-06 17:01:41', '2025-12-06 17:06:24', 'PAN Card', 'ABCDE1234F', 'visitor_V000013_qr.png', 'TN09XY9876', 'Bike', '', '', '17:01:00'),
(14, 9, 'V000014', 'GV000009', 'Praveen', 'john@example.com', '9876543210', 'Document Submission', '2025-12-08', 'Document submission', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-07 14:34:19', '2025-12-08 13:01:38', 'Aadhaar Card', '123456789012', 'visitor_V000014_qr.png', 'TN10AB1234', 'Car', '', '', '10:30:00'),
(15, 9, 'V000015', 'GV000009', 'Sai', 'mary@example.com', '9876501234', 'Document Submission', '2025-12-08', 'Document submission', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-07 14:34:19', '2025-12-08 13:01:38', 'PAN Card', 'ABCDE1234F', 'visitor_V000015_qr.png', 'TN09XY9876', 'Bike', '', '', '10:30:00'),
(16, 10, 'V000016', 'GV000010', 'Venkatesh', 'venkey@gmail.com', '8919146333', 'General Visit', '2025-12-08', 'General Visit', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-07 20:46:18', '2025-12-07 22:04:56', 'Aadhar Card', '74108529696', 'visitor_V000016_qr.png', 'AP123586', 'Bike', '', '', '09:30:00'),
(17, 11, 'V000017', 'GV000011', 'Praveen', 'praveen@gmail.com', '8919146335', 'Meeting', '2025-12-08', 'SAP Meeting', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-07 20:55:37', '2025-12-08 12:08:12', 'Aadhar Card', '89191463333', 'visitor_V000017_qr.png', 'AP1235SJ', 'Car', '', '', '10:00:00'),
(18, 12, 'V000018', 'GV000012', 'Ravikumar ', 'john@example.com', '9876543210', 'Meeting', '2025-12-08', 'Event Visit Purpose ', NULL, NULL, 9, NULL, 'pending', 0, NULL, 9, '2025-12-07 21:11:51', '2025-12-07 21:11:51', 'Aadhaar Card', '123456789', '', 'TN10AB1234', 'Car', '', '', '20:00:00'),
(19, 12, 'V000019', 'GV000012', 'Sai Prakash', 'mary@example.com', '9876501234', 'Meeting', '2025-12-08', 'Event Visit Purpose ', NULL, NULL, 9, NULL, 'pending', 0, NULL, 9, '2025-12-07 21:11:51', '2025-12-07 21:11:51', 'PAN Card', 'ABCDE1234F', '', 'TN09XY9876', 'Bike', '', '', '20:00:00'),
(20, 13, 'V000020', 'GV000013', 'Murali', 'murali@gmail.com', '8959585633', 'Tourism Visit', '2025-12-08', 'Tourism Visit Purpose ', NULL, NULL, 1, NULL, 'approved', 0, NULL, 1, '2025-12-07 22:10:40', '2025-12-07 22:10:40', 'Aadhar Card', '255F15616', 'visitor_V000020_qr.png', 'AP12565SDF', 'Bike', '', '', '10:00:00'),
(21, 14, 'V000021', 'GV000014', 'Lokesh', 'lokesh@gmail.com', '7894561234', 'Maintenance / Service', '2025-12-09', 'Maintenance  Visit Purpose ', NULL, NULL, 1, NULL, 'approved', 0, NULL, 1, '2025-12-07 22:23:26', '2025-12-07 22:23:26', 'Aadhar Card', '741852963741', 'visitor_V000021_qr.png', 'AP42AS5DA', 'Bike', '', '', '10:00:00'),
(22, 15, 'V000022', 'GV000015', 'Prathap', 'prathap@gmail.com', '7894561234', 'General Visit', '2025-12-08', 'General Visit', NULL, NULL, 1, NULL, 'approved', 0, NULL, 1, '2025-12-07 22:25:16', '2025-12-07 22:25:16', 'Aadhar Card', '7417528969685', 'visitor_V000022_qr.png', 'ADS758WD85', 'Car', '', '', '12:00:00'),
(23, 16, 'V000023', 'GV000016', 'Lovaraju', 'raju@gmail.com', '1234556789', 'Meeting', '2025-12-08', 'General Meeting ', NULL, NULL, 1, NULL, 'approved', 0, NULL, 1, '2025-12-07 22:27:32', '2025-12-07 22:27:32', 'Aadhar Card', '74185296374', 'visitor_V000023_qr.png', 'SDS456', 'Car', '', '', '11:26:00'),
(24, 17, 'V000024', 'GV000017', 'Kartheek ', 'karthik@gmail.com', '1232951561', 'Event Visit', '2025-12-08', 'Testing ', NULL, NULL, 1, NULL, 'approved', 1, NULL, 1, '2025-12-07 22:38:30', '2025-12-07 22:39:16', 'Aadhar Card', '351654684854654', 'visitor_V000024_qr.png', 'TES225DS8', 'Car', '', '', '10:30:00'),
(25, 18, 'V000025', 'GV000018', 'Sreenu', 'mahesh@gmail.com', '1321635131', 'General Visit', '2025-12-08', 'General  Visit ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-08 10:02:56', '2025-12-08 10:17:26', 'Aadhar Card', '561268551684', 'visitor_V000025_qr.png', 'AT245247DSDS', 'Car', '', '', '10:30:00'),
(26, 19, 'V000026', 'GV000019', 'Sravan', 'john@example.com', '9876543210', 'Event Visit', '2025-12-08', 'Location Recci Purpose ', NULL, NULL, 9, NULL, 'approved', 2, '01:36:02', 9, '2025-12-08 10:22:42', '2025-12-08 12:25:42', 'Aadhaar Card', '123456789012', 'visitor_V000026_qr.png', 'TN10AB1234', 'Car', '', '', '12:00:00'),
(27, 19, 'V000027', 'GV000019', 'Balu', 'mary@example.com', '9876501234', 'Event Visit', '2025-12-08', 'Location Recci Purpose ', NULL, NULL, 9, NULL, 'approved', 1, NULL, 9, '2025-12-08 10:22:42', '2025-12-08 10:50:14', 'PAN Card', 'ABCDE1234F', 'visitor_V000027_qr.png', 'TN09XY9876', 'Bike', '', '', '12:00:00'),
(28, 20, 'V000028', 'GV000020', 'Ravikimar', 'ravi@gmail.com', '1234567894', 'Site Inspection', '2025-12-09', 'Test Visit Purpose ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-08 14:07:36', '2025-12-08 15:50:07', 'Aadhar Card', '123546DDS5', 'visitor_V000028_qr.png', 'AF52FE5W', 'Bike', '', '', '14:06:00'),
(29, 21, 'V000029', 'GV000021', 'laxman', 'john@example.com', '9876543210', 'Maintenance / Service', '2025-12-09', 'Test Description ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-08 14:09:13', '2025-12-08 14:20:49', 'Aadhaar Card', '123456789012', 'visitor_V000029_qr.png', 'TN10AB1234', 'Car', '', '', '15:07:00'),
(30, 21, 'V000030', 'GV000021', 'Joy', 'mary@example.com', '9876501234', 'Maintenance / Service', '2025-12-09', 'Test Description ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 9, '2025-12-08 14:09:13', '2025-12-08 14:20:50', 'PAN Card', 'ABCDE1234F', 'visitor_V000030_qr.png', 'TN09XY9876', 'Bike', '', '', '15:07:00'),
(31, 22, 'V000031', 'GV000022', 'Prakash', 'john@example.com', '9876543210', 'Document Submission', '2025-12-08', 'Test', NULL, NULL, 1, NULL, 'approved', 0, NULL, 1, '2025-12-08 15:51:23', '2025-12-08 15:51:23', 'Aadhaar Card', '123456789012', 'visitor_V000031_qr.png', 'TN10AB1234', 'Car', '', '', '15:50:00'),
(32, 22, 'V000032', 'GV000022', 'Sharath', 'mary@example.com', '9876501234', 'Document Submission', '2025-12-08', 'Test', NULL, NULL, 1, NULL, 'approved', 0, NULL, 1, '2025-12-08 15:51:23', '2025-12-08 15:51:23', 'PAN Card', 'ABCDE1234F', 'visitor_V000032_qr.png', 'TN09XY9876', 'Bike', '', '', '15:50:00'),
(33, 23, 'V000033', 'GV000023', 'Prakash Tets', 'john@example.com', '9876543210', 'General Visit', '2025-12-08', 'Test', NULL, NULL, 1, NULL, 'approved', 0, NULL, 1, '2025-12-08 15:56:29', '2025-12-08 15:56:29', 'Aadhaar Card', '123456789012', 'visitor_V000033_qr.png', 'TN10AB1234', 'Car', '', '', '15:56:00'),
(34, 23, 'V000034', 'GV000023', 'Sharath Test', 'mary@example.com', '9876501234', 'General Visit', '2025-12-08', 'Test', NULL, NULL, 1, NULL, 'approved', 0, NULL, 1, '2025-12-08 15:56:30', '2025-12-08 15:56:30', 'PAN Card', 'ABCDE1234F', 'visitor_V000034_qr.png', 'TN09XY9876', 'Bike', '', '', '15:56:00'),
(35, 24, 'V000035', 'GV000024', 'Prakash Test 1', 'john@example.com', '9876543210', 'Interview', '2025-12-09', 'Test Description ', NULL, NULL, 1, NULL, 'approved', 0, NULL, 1, '2025-12-08 16:01:28', '2025-12-08 16:01:28', 'Aadhaar Card', '123456789012', 'visitor_V000035_qr.png', 'TN10AB1234', 'Car', '', '', '16:00:00'),
(36, 24, 'V000036', 'GV000024', 'Sharath Test 2', 'mary@example.com', '9876501234', 'Interview', '2025-12-09', 'Test Description ', NULL, NULL, 1, NULL, 'approved', 0, NULL, 1, '2025-12-08 16:01:29', '2025-12-08 16:01:29', 'PAN Card', 'ABCDE1234F', 'visitor_V000036_qr.png', 'TN09XY9876', 'Bike', '', '', '16:00:00');

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
(1, 1, 'Created', NULL, 'pending', '--', 9, '2025-12-06 15:31:07'),
(2, 2, 'Created', NULL, 'pending', '--', 9, '2025-12-06 15:32:18'),
(3, 3, 'Created', NULL, 'pending', '--', 9, '2025-12-06 15:32:18'),
(4, 4, 'Created', NULL, 'pending', '--', 9, '2025-12-06 15:43:28'),
(5, 5, 'Created', NULL, 'pending', '--', 9, '2025-12-06 15:43:28'),
(6, 1, 'approved', 'pending', 'approved', '', 1, '2025-12-06 16:19:45'),
(7, 2, 'approved', 'pending', 'approved', '', 1, '2025-12-06 16:33:06'),
(8, 3, 'approved', 'pending', 'approved', '', 1, '2025-12-06 16:33:07'),
(9, 4, 'approved', 'pending', 'approved', '', 1, '2025-12-06 16:34:58'),
(10, 5, 'approved', 'pending', 'approved', '', 1, '2025-12-06 16:34:58'),
(11, 6, 'Created', NULL, 'pending', '--', 9, '2025-12-06 16:48:41'),
(12, 7, 'Created', NULL, 'pending', '--', 9, '2025-12-06 16:48:41'),
(13, 8, 'Created', NULL, 'pending', '--', 9, '2025-12-06 16:49:44'),
(14, 6, 'approved', 'pending', 'approved', '', 1, '2025-12-06 16:50:16'),
(15, 7, 'approved', 'pending', 'approved', '', 1, '2025-12-06 16:50:17'),
(16, 8, 'approved', 'pending', 'approved', '', 1, '2025-12-06 16:54:27'),
(17, 9, 'Created', NULL, 'pending', '--', 9, '2025-12-06 17:00:18'),
(18, 10, 'Created', NULL, 'pending', '--', 9, '2025-12-06 17:01:08'),
(19, 11, 'Created', NULL, 'pending', '--', 9, '2025-12-06 17:01:08'),
(20, 12, 'Created', NULL, 'pending', '--', 9, '2025-12-06 17:01:41'),
(21, 13, 'Created', NULL, 'pending', '--', 9, '2025-12-06 17:01:41'),
(22, 9, 'approved', 'pending', 'approved', '', 1, '2025-12-06 17:04:40'),
(23, 10, 'approved', 'pending', 'approved', '', 1, '2025-12-06 17:05:18'),
(24, 11, 'approved', 'pending', 'approved', '', 1, '2025-12-06 17:05:19'),
(25, 12, 'approved', 'pending', 'approved', '', 1, '2025-12-06 17:06:24'),
(26, 13, 'approved', 'pending', 'approved', '', 1, '2025-12-06 17:06:24'),
(27, 14, 'Created', NULL, 'pending', '--', 9, '2025-12-07 14:34:19'),
(28, 15, 'Created', NULL, 'pending', '--', 9, '2025-12-07 14:34:19'),
(29, 16, 'Created', NULL, 'pending', '--', 9, '2025-12-07 20:46:18'),
(30, 17, 'Created', NULL, 'pending', '--', 9, '2025-12-07 20:55:37'),
(31, 18, 'Created', NULL, 'pending', '--', 9, '2025-12-07 21:11:51'),
(32, 19, 'Created', NULL, 'pending', '--', 9, '2025-12-07 21:11:51'),
(33, 16, 'approved', 'pending', 'approved', '', 1, '2025-12-07 22:04:56'),
(34, 20, 'Created', NULL, 'approved', '--', 1, '2025-12-07 22:10:40'),
(35, 21, 'Created', NULL, 'approved', '--', 1, '2025-12-07 22:23:26'),
(36, 22, 'Created', NULL, 'approved', '--', 1, '2025-12-07 22:25:16'),
(37, 23, 'Created', NULL, 'approved', '--', 1, '2025-12-07 22:27:32'),
(38, 24, 'Created', NULL, 'approved', '--', 1, '2025-12-07 22:38:30'),
(39, 25, 'Created', NULL, 'pending', '--', 9, '2025-12-08 10:02:56'),
(40, 25, 'approved', 'pending', 'approved', '', 1, '2025-12-08 10:17:26'),
(41, 25, 'approved', 'approved', 'approved', NULL, 1, '2025-12-08 10:18:43'),
(42, 24, 'approved', 'approved', 'approved', NULL, 1, '2025-12-08 10:18:55'),
(43, 26, 'Created', NULL, 'pending', '--', 9, '2025-12-08 10:22:42'),
(44, 27, 'Created', NULL, 'pending', '--', 9, '2025-12-08 10:22:42'),
(45, 26, 'approved', 'pending', 'approved', NULL, 1, '2025-12-08 10:44:53'),
(46, 27, 'approved', 'pending', 'approved', NULL, 1, '2025-12-08 10:44:54'),
(47, 17, 'approved', 'pending', 'approved', NULL, 1, '2025-12-08 12:08:12'),
(48, 14, 'approved', 'pending', 'approved', NULL, 1, '2025-12-08 13:01:38'),
(49, 15, 'approved', 'pending', 'approved', NULL, 1, '2025-12-08 13:01:38'),
(50, 28, 'Created', NULL, 'pending', '--', 9, '2025-12-08 14:07:36'),
(51, 29, 'Created', NULL, 'pending', '--', 9, '2025-12-08 14:09:13'),
(52, 30, 'Created', NULL, 'pending', '--', 9, '2025-12-08 14:09:13'),
(53, 29, 'approved', 'pending', 'approved', NULL, 1, '2025-12-08 14:20:49'),
(54, 30, 'approved', 'pending', 'approved', NULL, 1, '2025-12-08 14:20:50'),
(55, 28, 'approved', 'pending', 'approved', NULL, 1, '2025-12-08 15:50:07'),
(56, 31, 'Created', NULL, 'approved', '--', 1, '2025-12-08 15:51:23'),
(57, 32, 'Created', NULL, 'approved', '--', 1, '2025-12-08 15:51:23'),
(58, 33, 'Created', NULL, 'approved', '--', 1, '2025-12-08 15:56:29'),
(59, 34, 'Created', NULL, 'approved', '--', 1, '2025-12-08 15:56:30'),
(60, 35, 'Created', NULL, 'approved', '--', 1, '2025-12-08 16:01:28'),
(61, 36, 'Created', NULL, 'approved', '--', 1, '2025-12-08 16:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_request_header`
--

CREATE TABLE `visitor_request_header` (
  `id` int(11) NOT NULL,
  `header_code` varchar(50) NOT NULL,
  `requested_by` varchar(100) NOT NULL,
  `requested_date` date NOT NULL,
  `requested_time` time NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `total_visitors` int(11) DEFAULT 0,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `updated_by` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `company` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_request_header`
--

INSERT INTO `visitor_request_header` (`id`, `header_code`, `requested_by`, `requested_date`, `requested_time`, `department`, `purpose`, `description`, `email`, `total_visitors`, `status`, `updated_by`, `remarks`, `created_at`, `updated_at`, `company`) VALUES
(1, 'GV000001', '9', '2025-12-06', '15:30:00', 'Finance', 'General Visit', 'Test 1', 'ragavendra@gmail.com', 1, 'approved', NULL, '', '2025-12-06 15:31:07', '2025-12-06 16:19:45', 'UKMPL'),
(2, 'GV000002', '9', '2025-12-06', '15:31:00', 'Finance', 'Meeting', 'SAP Meeting Purpose ', 'test@gmail.com', 2, 'approved', NULL, '', '2025-12-06 15:32:18', '2025-12-06 16:33:07', 'UKMPL'),
(3, 'GV000003', '9', '2025-12-05', '22:00:00', 'Finance', 'Event Visit', 'test description ', 'Test@gmail.com', 2, 'approved', NULL, '', '2025-12-06 15:43:28', '2025-12-06 16:34:58', 'UKMPL'),
(4, 'GV000004', '9', '2025-12-06', '16:48:00', 'Finance', 'General Visit', 'Test@gmail.com', 'Test@gmail.com', 2, 'approved', NULL, '', '2025-12-06 16:48:41', '2025-12-06 16:50:17', 'UKMPL'),
(5, 'GV000005', '9', '2025-12-06', '16:48:00', 'Finance', 'General Visit', 'Test Description ', 'ravi@gmail.com', 1, 'approved', NULL, '', '2025-12-06 16:49:44', '2025-12-06 16:54:27', 'UKMPL'),
(6, 'GV000006', '9', '2025-12-05', '16:59:00', 'Finance', 'Meeting', 'Rdfsdf', 'prathap@gmail.com', 1, 'approved', NULL, '', '2025-12-06 17:00:18', '2025-12-06 17:04:40', 'UKMPL'),
(7, 'GV000007', '9', '2025-12-05', '17:00:00', 'Finance', 'Meeting', 'test', 'test@gmail.com', 2, 'approved', NULL, '', '2025-12-06 17:01:08', '2025-12-06 17:05:19', 'UKMPL'),
(8, 'GV000008', '9', '2025-12-06', '17:01:00', 'Finance', 'Meeting', 'test', 'test@gmail.com', 2, 'approved', NULL, '', '2025-12-06 17:01:41', '2025-12-06 17:06:24', 'UKMPL'),
(9, 'GV000009', '9', '2025-12-08', '10:30:00', 'Finance', 'Document Submission', 'Document submission', 'test@gmail.com', 2, 'approved', NULL, '', '2025-12-07 14:34:19', '2025-12-08 13:01:38', 'UKMPL'),
(10, 'GV000010', '9', '2025-12-08', '09:30:00', 'Finance', 'General Visit', 'General Visit', 'venkey@gmail.com', 1, 'approved', NULL, '', '2025-12-07 20:46:18', '2025-12-07 22:04:56', 'UKMPL'),
(11, 'GV000011', '9', '2025-12-08', '10:00:00', 'Finance', 'Meeting', 'SAP Meeting', 'praveen@gmail.com', 1, 'approved', NULL, '', '2025-12-07 20:55:37', '2025-12-08 12:08:12', 'UKMPL'),
(12, 'GV000012', '9', '2025-12-08', '20:00:00', 'Finance', 'Meeting', 'Event Visit Purpose ', 'testmail@gmail.com', 2, 'approved', NULL, '', '2025-12-07 21:11:51', '2025-12-08 12:52:17', 'UKMPL'),
(13, 'GV000013', '1', '2025-12-08', '10:00:00', 'IT', 'Tourism Visit', 'Tourism Visit Purpose ', 'murali@gmail.com', 1, 'approved', NULL, '', '2025-12-07 22:10:40', '2025-12-07 22:10:40', 'UKMPL'),
(14, 'GV000014', '1', '2025-12-09', '10:00:00', 'IT', 'Maintenance / Service', 'Maintenance  Visit Purpose ', 'lokesh@gmail.com', 1, 'approved', NULL, '', '2025-12-07 22:23:26', '2025-12-07 22:23:26', 'UKMPL'),
(15, 'GV000015', '1', '2025-12-08', '12:00:00', 'IT', 'General Visit', 'General Visit', 'prathap@gmail.com', 1, 'approved', NULL, '', '2025-12-07 22:25:16', '2025-12-07 22:25:16', 'UKMPL'),
(16, 'GV000016', '1', '2025-12-08', '11:26:00', 'IT', 'Meeting', 'General Meeting ', 'raju@gmail.com', 1, 'approved', NULL, '', '2025-12-07 22:27:32', '2025-12-07 22:27:32', 'UKMPL'),
(17, 'GV000017', '1', '2025-12-08', '10:30:00', 'IT', 'Event Visit', 'Testing ', 'karthik@gmail.com', 1, 'approved', NULL, '', '2025-12-07 22:38:30', '2025-12-08 10:18:55', 'UKMPL'),
(18, 'GV000018', '9', '2025-12-08', '10:30:00', 'Finance', 'General Visit', 'General  Visit ', 'mahesh@gmail.com', 1, 'approved', NULL, '', '2025-12-08 10:02:56', '2025-12-08 10:18:43', 'UKMPL'),
(19, 'GV000019', '9', '2025-12-08', '12:00:00', 'Finance', 'Event Visit', 'Location Recci Purpose ', 'kasi34u@gmail.com', 2, 'approved', NULL, '', '2025-12-08 10:22:42', '2025-12-08 10:44:54', 'UKMPL'),
(20, 'GV000020', '9', '2025-12-09', '14:06:00', 'Finance', 'Site Inspection', 'Test Visit Purpose ', 'ravi@gmail.com', 1, 'approved', NULL, '', '2025-12-08 14:07:36', '2025-12-08 15:50:07', 'UKMPL'),
(21, 'GV000021', '9', '2025-12-09', '15:07:00', 'Finance', 'Maintenance / Service', 'Test Description ', 'test@gmail.com', 2, 'approved', NULL, '', '2025-12-08 14:09:13', '2025-12-08 14:20:50', 'UKMPL'),
(22, 'GV000022', '1', '2025-12-08', '15:50:00', 'IT', 'Document Submission', 'Test', 'test@gmail.com', 2, 'approved', NULL, '', '2025-12-08 15:51:22', '2025-12-08 15:51:22', 'UKMPL'),
(23, 'GV000023', '1', '2025-12-08', '15:56:00', 'IT', 'General Visit', 'Test', 'karnamahesh42@gmail.com', 2, 'approved', NULL, '', '2025-12-08 15:56:28', '2025-12-08 15:56:28', 'UKMPL'),
(24, 'GV000024', '1', '2025-12-09', '16:00:00', 'IT', 'Interview', 'Test Description ', 'test@gmail.com', 2, 'approved', NULL, '', '2025-12-08 16:01:27', '2025-12-08 16:01:27', 'UKMPL');

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
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `created_by` (`created_by`),
  ADD KEY `fk_visitors_header` (`request_header_id`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_request_id` (`visitor_request_id`);

--
-- Indexes for table `visitor_request_header`
--
ALTER TABLE `visitor_request_header`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `visitor_request_header`
--
ALTER TABLE `visitor_request_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
