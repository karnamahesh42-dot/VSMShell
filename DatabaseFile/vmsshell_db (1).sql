-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2025 at 12:34 PM
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
-- Database: `vmsshell_db`
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
(6, 'Security'),
(5, 'Stores');

-- --------------------------------------------------------

--
-- Table structure for table `expired_visitor_passes`
--

CREATE TABLE `expired_visitor_passes` (
  `id` int(11) NOT NULL,
  `visitor_request_id` int(11) NOT NULL,
  `v_code` varchar(50) DEFAULT NULL,
  `header_code` varchar(50) DEFAULT NULL,
  `expired_at` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expired_visitor_passes`
--

INSERT INTO `expired_visitor_passes` (`id`, `visitor_request_id`, `v_code`, `header_code`, `expired_at`, `created_at`) VALUES
(1, 2, NULL, 'GV000002', '2025-12-13 00:02:05', '2025-12-13 00:02:05'),
(2, 3, NULL, 'GV000003', '2025-12-13 00:02:05', '2025-12-13 00:02:05'),
(3, 5, NULL, 'GV000004', '2025-12-14 12:00:26', '2025-12-14 12:00:26'),
(4, 6, NULL, 'GV000005', '2025-12-14 12:00:26', '2025-12-14 12:00:26'),
(5, 8, NULL, 'GV000007', '2025-12-16 10:37:23', '2025-12-16 10:37:23'),
(6, 9, NULL, 'GV000008', '2025-12-16 10:37:23', '2025-12-16 10:37:23'),
(7, 10, NULL, 'GV000008', '2025-12-16 10:37:23', '2025-12-16 10:37:23'),
(8, 12, NULL, 'GV000010', '2025-12-16 10:37:23', '2025-12-16 10:37:23'),
(9, 13, NULL, 'GV000011', '2025-12-16 10:37:23', '2025-12-16 10:37:23'),
(10, 14, NULL, 'GV000012', '2025-12-16 10:37:23', '2025-12-16 10:37:23'),
(11, 15, NULL, 'GV000013', '2025-12-16 10:37:23', '2025-12-16 10:37:23'),
(12, 17, NULL, 'GV000015', '2025-12-17 10:32:27', '2025-12-17 10:32:27'),
(13, 18, NULL, 'GV000016', '2025-12-17 10:32:27', '2025-12-17 10:32:27'),
(14, 19, NULL, 'GV000016', '2025-12-17 10:32:27', '2025-12-17 10:32:27'),
(15, 22, NULL, 'GV000019', '2025-12-19 11:21:38', '2025-12-19 11:21:38'),
(16, 24, NULL, 'GV000021', '2025-12-20 09:37:29', '2025-12-20 09:37:29'),
(17, 25, NULL, 'GV000022', '2025-12-20 09:37:29', '2025-12-20 09:37:29'),
(18, 26, NULL, 'GV000023', '2025-12-20 09:37:29', '2025-12-20 09:37:29'),
(19, 27, NULL, 'GV000024', '2025-12-20 09:37:29', '2025-12-20 09:37:29'),
(20, 28, NULL, 'GV000024', '2025-12-20 09:37:29', '2025-12-20 09:37:29'),
(21, 29, NULL, 'GV000025', '2025-12-20 09:37:29', '2025-12-20 09:37:29'),
(22, 30, NULL, 'GV000025', '2025-12-20 09:37:29', '2025-12-20 09:37:29'),
(23, 31, NULL, 'GV000026', '2025-12-20 09:37:29', '2025-12-20 09:37:29');

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
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(5) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `security_gate_logs`
--

INSERT INTO `security_gate_logs` (`id`, `visitor_request_id`, `v_code`, `check_in_time`, `check_out_time`, `verified_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'V000001', '2025-12-13 02:20:51', '2025-12-13 03:38:49', 13, '2025-12-13 02:20:51', NULL, NULL),
(2, 4, 'V000004', '2025-12-13 11:13:39', NULL, 11, '2025-12-13 11:13:39', NULL, NULL),
(3, 7, 'V000007', '2025-12-13 15:16:18', '2025-12-13 15:19:43', 13, '2025-12-13 15:16:18', NULL, NULL),
(4, 11, 'V000011', '2025-12-15 13:11:17', NULL, 13, '2025-12-15 13:11:17', NULL, NULL),
(5, 16, 'V000016', '2025-12-16 15:09:20', NULL, 13, '2025-12-16 15:09:20', NULL, NULL),
(6, 20, 'V000020', '2025-12-17 10:57:01', '2025-12-18 11:00:02', 13, '2025-12-17 10:57:01', NULL, NULL),
(7, 21, 'V000021', '2025-12-18 14:58:16', NULL, 13, '2025-12-18 14:58:16', NULL, NULL),
(8, 23, 'V000023', '2025-12-18 15:40:52', NULL, 13, '2025-12-18 15:40:52', NULL, NULL),
(9, 1, 'V000001', '2025-12-18 15:41:35', '2025-12-18 15:41:55', 13, '2025-12-18 15:41:35', NULL, '2025-12-18 10:11:55'),
(10, 1, 'V000001', '2025-12-18 15:42:06', NULL, 13, '2025-12-18 15:42:06', NULL, NULL),
(11, 32, 'V000032', '2025-12-19 15:31:37', NULL, 1, '2025-12-19 15:31:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
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

INSERT INTO `users` (`id`, `priority`, `name`, `company_name`, `department_id`, `username`, `password`, `role_id`, `active`, `hash_key`, `created_at`, `created_by`, `email`, `employee_code`) VALUES
(1, 0, 'Superadmin', 'UKMPL', 1, 'superadmin', '274d015c638f62ba24b19ca23c9c9503', 1, 1, 'HASHKEY123', '2025-11-20 09:28:43', NULL, 'maheshkarna42@gmail.com', '2523011'),
(5, 2, 'Sreenivas', 'UKMPL', 1, 'sreenivas', '4afcb80b6e9cd9a83efdf1ec48a1c856', 2, 1, 'HASHKEY123', '2025-11-21 05:54:24', 1, 'ukmledp@ramojifilmcity.com', '12345678'),
(6, 10, 'Prakash', 'UKMPL', 3, 'hruser2', '1b0041377a27ec89d4ff989d048f5e85', 3, 1, 'HASHKEY123', '2025-11-21 22:15:08', 1, 'prakash@gmail.com', '789654159'),
(7, 0, 'Prasad ', 'UKMPL', 3, 'hrhod', 'f271d1efdfba760f7145d4436f845b8e', 2, 1, 'HASHKEY123', '2025-11-22 05:56:17', 1, 'prasad@gmail.com', '951357456'),
(8, 10, 'Sury kumar', 'UKMPL', 1, 'suryakumar', '45b97ac60ca6e41341d1bfe4f39d5227', 3, 1, 'HASHKEY123', '2025-11-24 00:22:13', 1, 'kumar@gmail.com', '87456321'),
(9, 10, 'Radhika', 'UKMPL', 2, 'radhika', '2a14558094169ea7f79f928213fd9a20', 3, 1, 'HASHKEY123', '2025-11-24 03:40:59', 1, 'radhika@gmail.com', '951456357'),
(10, 10, 'Sailesh Kumar', 'UKMPL', 2, 'sailesh', '439dd07182ce0dcd1f225293d85be464', 2, 1, 'HASHKEY123', '2025-11-27 23:56:49', 5, 'miscentraloffice@ramojifilmcity.com', '741963258'),
(11, 2, 'Satish Kumar', 'UKMPL', 2, 'satish', '135c44d20155d3a67bc984f17492a3d3', 2, 1, 'HASHKEY123', '2025-11-30 09:57:12', 5, 'gmaccounts@ramojifilmcity.com', '321987456'),
(12, 10, 'pallam raju', 'UKMPL', 3, 'hruser', '5980d6ad05354bd8681adff071323804', 3, 1, 'HASHKEY123', '2025-11-30 15:37:58', 5, 'raju@gmail.com', '456812397'),
(13, 10, 'khan', 'UKMPL', 6, 'security', '7f56499c9bcb7018d17adba024f12b36', 4, 1, NULL, '2025-12-01 10:32:56', 5, 'khan@gmail.com', '89595875'),
(14, 10, 'Kumar', 'UKMPL', 5, 'kumar', 'b9b580e1f1d30f72a52c9696dfa3c1a3', 3, 0, NULL, '2025-12-02 03:46:21', 5, 'kumar@gmail.com', '53532581'),
(15, 10, 'Mahesh Karna', 'UKMPL', 1, 'mahesh', 'b9a7b941299a521d0a5abb9cee30bfec', 3, 1, 'HASHKEY123', '2025-12-09 11:46:10', 1, 'karnamahesh42@gmail.com', '123456'),
(16, 3, 'Lokesh', 'UKMPL', 2, 'lokesh', 'd273c8b0aa7f42e27fe0ea75f896167a', 2, 1, 'HASHKEY123', '2025-12-12 15:37:09', 1, 'lokesh@gmail.com', '87456321'),
(18, 1, 'K Ravindara Rao', 'UKMPL', 2, 'kravindra', '6c185769e88bffa03bed6a8129277205', 2, 1, 'HASHKEY123', '2025-12-13 09:29:06', 1, 'ravindra@gmail.com', '789564264'),
(19, 1, 'Krishna Vasireddy', 'UKMPL', 1, 'krishna', '130f10ca4711756506b4ac65a3e002c6', 2, 1, 'HASHKEY123', '2025-12-16 08:54:25', 1, 'krishna@gmail.com', '12345678');

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
  `meeting_status` tinyint(1) NOT NULL DEFAULT 0,
  `meeting_completed_at` datetime DEFAULT NULL,
  `validity` int(2) NOT NULL DEFAULT 1,
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

INSERT INTO `visitors` (`id`, `request_header_id`, `v_code`, `group_code`, `visitor_name`, `visitor_email`, `visitor_phone`, `purpose`, `visit_date`, `description`, `expected_from`, `expected_to`, `host_user_id`, `reference_id`, `status`, `meeting_status`, `meeting_completed_at`, `validity`, `securityCheckStatus`, `spendTime`, `created_by`, `created_at`, `updated_at`, `proof_id_type`, `proof_id_number`, `qr_code`, `vehicle_no`, `vehicle_type`, `vehicle_id_proof`, `visitor_id_proof`, `visit_time`) VALUES
(1, 1, 'V000001', 'GV000001', 'Ravikumar', 'karnamahesh42@gmail.com', '8919146333', 'General Visit', '2025-12-13', 'Testing Purpose ', NULL, NULL, 1, NULL, 'approved', 1, '2025-12-13 03:36:28', 1, 1, '00:00:20', 1, '2025-12-12 22:19:39', '2025-12-18 15:42:06', 'Aadhar Card', '852369741123', 'visitor_V000001_qr.png', 'AP123AD52', 'Bike', '', '', '10:30:00'),
(2, 2, 'V000002', 'GV000002', 'Rakesh', 'karnamahesh42@gmail.com', '7894561234', 'Meeting', '2025-12-12', 'Test Visit Purpose  ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-12 22:34:33', '2025-12-13 04:01:35', 'Aadhar Card', '74185296388', 'visitor_V000002_qr.png', 'TS55DF5F5', 'Bike', '', '', '22:33:00'),
(3, 3, 'V000003', 'GV000003', 'Rahul', 'karnamahesh42@gmail.com', '7894561237', 'Meeting', '2025-12-12', 'Test Meeting Visit', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-12 22:36:16', '2025-12-14 12:04:28', 'PAN Card', '1D55D54F8', 'visitor_V000003_qr.png', '465SDD54', 'Bike', '', '', '22:35:00'),
(4, 4, 'V000004', 'GV000004', 'Prakash', 'karnamahesh42@gmail.com', '9876543210', 'Vendor Visit', '2025-12-13', 'Test Visit', NULL, NULL, 9, NULL, 'approved', 1, '2025-12-20 10:26:06', 1, 1, NULL, 9, '2025-12-13 10:48:10', '2025-12-20 10:26:06', 'Aadhaar Card', '123456789012', 'visitor_V000004_qr.png', 'TN10AB1234', 'Car', '', '', '10:50:00'),
(5, 4, 'V000005', 'GV000004', 'Sharath', 'karnamahesh42@gmail.com', '9876501234', 'Vendor Visit', '2025-12-13', 'Test Visit', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-13 10:48:10', '2025-12-14 12:00:26', 'PAN Card', 'ABCDE1234F', 'visitor_V000005_qr.png', 'TN10AB1234', 'Car', '', '', '10:50:00'),
(6, 5, 'V000006', 'GV000005', 'Tarun Tota', 'ukmledp@ramojifilmcity.com', '6789543256', 'Event Visit', '2025-12-13', 'Client Planning For Event', NULL, NULL, 9, NULL, 'rejected', 0, NULL, 0, 0, NULL, 9, '2025-12-13 13:57:28', '2025-12-16 14:25:34', 'Aadhar Card', '234567890', 'visitor_V000006_qr.png', 'TS26EF4567', 'Car', '', '', '14:30:00'),
(7, 6, 'V000007', 'GV000006', 'Raja', 'karnamahesh42@gmail.com', '8919146333', 'Location Recci', '2025-12-13', 'Test Description ', NULL, NULL, 9, NULL, 'approved', 1, '2025-12-13 15:19:19', 1, 2, '00:03:25', 9, '2025-12-13 14:54:13', '2025-12-13 15:19:43', 'Aadhar Card', 'AP3524685', 'visitor_V000007_qr.png', 'AS545788S', 'Bike', '', '', '15:53:00'),
(8, 7, 'V000008', 'GV000007', 'Ramesh', 'karnamahesh42@gmail.com', '7894561234', 'Vendor Visit', '2025-12-15', 'Test Visit\r\n', NULL, NULL, 9, NULL, 'rejected', 0, NULL, 0, 0, NULL, 9, '2025-12-15 10:00:36', '2025-12-16 10:37:23', 'PAN Card', 'ABC125PAN', 'visitor_V000008_qr.png', ' AP25TST232', 'Bike', '', '', '10:00:00'),
(9, 8, 'V000009', 'GV000008', 'Praveen K', 'karnamahesh42@gmail.com', '9876543210', 'Meeting', '2025-12-15', 'Test Meeting Purpose', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-15 10:05:43', '2025-12-16 10:37:23', 'Aadhaar Card', '123456789012', 'visitor_V000009_qr.png', 'TN10AB1234', 'Car', '', '', '11:03:00'),
(10, 8, 'V000010', 'GV000008', 'Pavan P', 'karnamahesh42@gmail.com', '9876501234', 'Meeting', '2025-12-15', 'Test Meeting Purpose', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-15 10:05:43', '2025-12-16 10:37:23', 'PAN Card', 'ABCDE1234F', 'visitor_V000010_qr.png', 'TN10AB1234', 'Car', '', '', '11:03:00'),
(11, 9, 'V000011', 'GV000009', 'Sathwick', 'maheshkarna@gmail.com', '7894561234', 'Personal Visit', '2025-12-15', 'To Meet Mr Lokesh', NULL, NULL, 9, NULL, 'approved', 0, NULL, 1, 1, NULL, 9, '2025-12-15 10:09:35', '2025-12-15 13:11:17', 'PAN Card', '1234856', 'visitor_V000011_qr.png', ' AP25TST232', 'Bike', '', '', '11:08:00'),
(12, 10, 'V000012', 'GV000010', 'Sreenivas', 'ukmledp@ramojifilmcity.com', '8919146333', 'Event Visit', '2025-12-15', 'Lime Lite Garden ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-15 15:32:12', '2025-12-16 10:37:23', 'PAN Card', '1111111', 'visitor_V000012_qr.png', '', '', '', '', '16:31:00'),
(13, 11, 'V000013', 'GV000011', 'Ravikumar', 'ukmledp@ramojifilmcity.com', '1593574568', 'General Visit', '2025-12-15', 'Test', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-15 15:49:41', '2025-12-16 10:37:23', 'PAN Card', '78945612332', 'visitor_V000013_qr.png', ' AP25TST236', 'Bike', '', '', '15:49:00'),
(14, 12, 'V000014', 'GV000012', 'Raghava', 'developers@ramojifilmcity.com', '7894561234', 'General Visit', '2025-12-15', 'Test 2', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-15 15:50:22', '2025-12-16 10:37:23', 'Voter ID', '1234856', 'visitor_V000014_qr.png', ' AP25TST236', 'Bike', '', '', '15:49:00'),
(15, 13, 'V000015', 'GV000013', 'Praveen', 'karnamahesh42@gmail.com', '7894561234', 'Delivery', '2025-12-15', 'Test 3', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-15 15:51:04', '2025-12-16 10:37:23', 'PAN Card', '1234856', 'visitor_V000015_qr.png', ' AP25TST232', 'Bike', '', '', '15:50:00'),
(16, 14, 'V000016', 'GV000014', 'Ramesh Babu', 'karnamahesh42@gmail.com', '7894561234', 'Meeting', '2025-12-16', 'Sap Meating Purpose', NULL, NULL, 15, NULL, 'approved', 0, NULL, 1, 1, NULL, 15, '2025-12-16 14:39:48', '2025-12-16 15:09:20', 'Aadhar Card', '  12345678922', 'visitor_V000016_qr.png', ' AP25TST232', 'Van', '', '', '14:38:00'),
(17, 15, 'V000017', 'GV000015', 'Kiran Kumar', 'karnamahesh42@gmail.com', '7894561234', 'Delivery', '2025-12-16', 'Delivery Purpose ', NULL, NULL, 15, NULL, 'approved', 0, NULL, 0, 0, NULL, 15, '2025-12-16 14:42:31', '2025-12-19 15:28:18', 'Aadhar Card', '582369745244', 'visitor_V000017_qr.png', ' AP25TST232', 'Car', '', '', '14:40:00'),
(18, 16, 'V000018', 'GV000016', 'Raj Praksh', 'karnamahesh42@gmail.com', '9876543210', 'Interview', '2025-12-16', 'Interview Purpose', NULL, NULL, 15, NULL, 'approved', 0, NULL, 0, 0, NULL, 15, '2025-12-16 14:55:00', '2025-12-19 15:24:49', 'Aadhaar Card', '123456789012', 'visitor_V000018_qr.png', 'TN10AB1234', 'Car', '', '', '14:52:00'),
(19, 16, 'V000019', 'GV000016', 'Sundhar Kumar', 'karnamahesh42@gmail.com', '9876501234', 'Interview', '2025-12-16', 'Interview Purpose', NULL, NULL, 15, NULL, 'approved', 0, NULL, 0, 0, NULL, 15, '2025-12-16 14:55:00', '2025-12-19 15:24:50', 'Aadhaar Card', '212635432162', 'visitor_V000019_qr.png', 'TN09XY9876', 'Bike', '', '', '14:52:00'),
(20, 17, 'V000020', 'GV000017', 'Krishna Vasireddy', 'krishna.vasireddy@gmail.com', '9100060606', 'Location Recci', '2025-12-17', 'Location Visit', NULL, NULL, 9, NULL, 'approved', 1, '2025-12-17 14:01:41', 1, 2, '00:03:01', 9, '2025-12-17 10:43:46', '2025-12-18 11:00:02', 'Aadhar Card', '565468-8878629-987727', 'visitor_V000020_qr.png', 'TS07HS5099', 'Car', '', '', '11:00:00'),
(21, 18, 'V000021', 'GV000018', 'Ramakrishna', 'karnamahesh42@gmail.com', '7894561234', 'Tourism Visit', '2025-12-18', 'Test Visit ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 1, 1, NULL, 9, '2025-12-18 11:08:02', '2025-12-18 14:58:16', 'PAN Card', '  12345678922', 'visitor_V000021_qr.png', ' AP25TST232', 'Bike', '', '', '11:07:00'),
(22, 19, 'V000022', 'GV000019', 'Mahesh', 'maheshkarna@gmail.com', '7894561234', 'Location Recci', '2025-12-18', 'Test Description ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-18 11:08:56', '2025-12-19 11:21:38', 'PAN Card', '1234856', 'visitor_V000022_qr.png', ' AP25TST232', 'Car', '', '', '11:08:00'),
(23, 20, 'V000023', 'GV000020', 'Kiran ', 'karnamahesh42@gmail.com', '7894561234', 'General Visit', '2025-12-18', 'General Visit Purpose ', NULL, NULL, 9, NULL, 'approved', 0, NULL, 1, 1, NULL, 9, '2025-12-18 11:09:46', '2025-12-19 14:50:21', 'Aadhar Card', '1234856', 'visitor_V000023_qr.png', ' AP25TST232', 'Car', '', '', '11:09:00'),
(24, 21, 'V000024', 'GV000021', ' Rakesh', 'karnamahesh42@gmail.com', '7894561234', 'General Visit', '2025-12-19', 'Tersdt', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-19 14:41:38', '2025-12-20 09:37:29', 'PAN Card', 'D32165DF65', 'visitor_V000024_qr.png', 'TEST23451SF', 'Bike', '', '', '14:41:00'),
(25, 22, 'V000025', 'GV000022', 'Praveen', 'karnamahesh42@gmail.com', '1593574568', 'Location Recci', '2025-12-19', 'Tttttttt', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-19 14:44:22', '2025-12-20 09:37:29', 'Aadhar Card', '1234856', 'visitor_V000025_qr.png', ' AP25TST236', 'Car', '', '', '14:43:00'),
(26, 23, 'V000026', 'GV000023', 'Mahesh', 'maheshkarna@gmail.com', '1593574568', 'Location Recci', '2025-12-19', 'Rrrrrr', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-19 14:45:13', '2025-12-20 09:37:29', 'Aadhar Card', '78945612332', 'visitor_V000026_qr.png', ' AP25TST232', 'Car', '', '', '14:44:00'),
(27, 24, 'V000027', 'GV000024', 'Prakash', 'karnamahesh42@gmail.com', '9876543210', 'Location Recci', '2025-12-19', 'Testt', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-19 15:01:23', '2025-12-20 09:37:29', 'Aadhaar Card', '123456789012', 'visitor_V000027_qr.png', 'TN10AB1234', 'Car', '', '', '15:00:00'),
(28, 24, 'V000028', 'GV000024', 'Sharath', 'karnamahesh42@gmail.com', '9876501234', 'Location Recci', '2025-12-19', 'Testt', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-19 15:01:23', '2025-12-20 09:37:29', 'PAN Card', 'ABCDE1234F', 'visitor_V000028_qr.png', 'TN09XY9876', 'Bike', '', '', '15:00:00'),
(29, 25, 'V000029', 'GV000025', 'Prakash', 'karnamahesh42@gmail.com', '9876543210', 'Location Recci', '2025-12-19', 'Testt', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-19 15:01:23', '2025-12-20 09:37:29', 'Aadhaar Card', '123456789012', 'visitor_V000029_qr.png', 'TN10AB1234', 'Car', '', '', '15:00:00'),
(30, 25, 'V000030', 'GV000025', 'Sharath', 'karnamahesh42@gmail.com', '9876501234', 'Location Recci', '2025-12-19', 'Testt', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-19 15:01:23', '2025-12-20 09:37:29', 'PAN Card', 'ABCDE1234F', 'visitor_V000030_qr.png', 'TN09XY9876', 'Bike', '', '', '15:00:00'),
(31, 26, 'V000031', 'GV000026', 'Prakash', 'john@example.com', '9876543210', 'Location Recci', '2025-12-19', 'Asds', NULL, NULL, 9, NULL, 'approved', 0, NULL, 0, 0, NULL, 9, '2025-12-19 15:05:26', '2025-12-20 09:37:29', 'Aadhaar Card', '123456789012', 'visitor_V000031_qr.png', 'TN10AB1234', 'Car', '', '', '15:04:00'),
(32, 26, 'V000032', 'GV000026', 'Sharath', 'mary@example.com', '9876501234', 'Location Recci', '2025-12-19', 'Asds', NULL, NULL, 9, NULL, 'approved', 0, NULL, 1, 1, NULL, 9, '2025-12-19 15:05:26', '2025-12-19 15:31:37', 'PAN Card', 'ABCDE1234F', 'visitor_V000032_qr.png', 'TN09XY9876', 'Bike', '', '', '15:04:00');

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
(1, 1, 'Created', NULL, 'approved', '--', 1, '2025-12-12 22:19:39'),
(2, 2, 'Created', NULL, 'pending', '--', 9, '2025-12-12 22:34:33'),
(3, 3, 'Created', NULL, 'pending', '--', 9, '2025-12-12 22:36:16'),
(4, 2, 'approved', 'pending', 'approved', NULL, 11, '2025-12-13 04:01:35'),
(5, 4, 'Created', NULL, 'pending', '--', 9, '2025-12-13 10:48:10'),
(6, 5, 'Created', NULL, 'pending', '--', 9, '2025-12-13 10:48:10'),
(7, 4, 'approved', 'pending', 'approved', NULL, 11, '2025-12-13 10:54:29'),
(8, 5, 'approved', 'pending', 'approved', NULL, 11, '2025-12-13 10:54:30'),
(9, 6, 'Created', NULL, 'pending', '--', 9, '2025-12-13 13:57:28'),
(10, 7, 'Created', NULL, 'pending', '--', 9, '2025-12-13 14:54:13'),
(11, 7, 'approved', 'pending', 'approved', NULL, 16, '2025-12-13 15:13:47'),
(12, 3, 'approved', 'pending', 'approved', NULL, 1, '2025-12-14 12:04:28'),
(13, 8, 'Created', NULL, 'pending', '--', 9, '2025-12-15 10:00:36'),
(14, 9, 'Created', NULL, 'pending', '--', 9, '2025-12-15 10:05:43'),
(15, 10, 'Created', NULL, 'pending', '--', 9, '2025-12-15 10:05:43'),
(16, 11, 'Created', NULL, 'pending', '--', 9, '2025-12-15 10:09:35'),
(17, 11, 'approved', 'pending', 'approved', NULL, 16, '2025-12-15 12:52:31'),
(18, 11, 'approved', 'pending', 'approved', NULL, 16, '2025-12-15 12:52:32'),
(19, 12, 'Created', NULL, 'pending', '--', 9, '2025-12-15 15:32:12'),
(20, 8, 'rejected', 'pending', 'rejected', 'Not A Valid Details', 18, '2025-12-15 15:43:03'),
(21, 12, 'approved', 'pending', 'approved', NULL, 18, '2025-12-15 15:44:31'),
(22, 9, 'approved', 'pending', 'approved', NULL, 11, '2025-12-15 15:47:28'),
(23, 10, 'approved', 'pending', 'approved', NULL, 11, '2025-12-15 15:47:31'),
(24, 13, 'Created', NULL, 'pending', '--', 9, '2025-12-15 15:49:41'),
(25, 14, 'Created', NULL, 'pending', '--', 9, '2025-12-15 15:50:22'),
(26, 15, 'Created', NULL, 'pending', '--', 9, '2025-12-15 15:51:04'),
(27, 15, 'approved', 'pending', 'approved', NULL, 11, '2025-12-15 15:53:36'),
(28, 14, 'approved', 'pending', 'approved', '', 11, '2025-12-15 15:54:49'),
(29, 13, 'approved', 'pending', 'approved', '', 11, '2025-12-15 16:03:14'),
(30, 6, 'rejected', 'pending', 'rejected', 'Time Over', 1, '2025-12-16 14:25:34'),
(31, 16, 'Created', NULL, 'pending', '--', 15, '2025-12-16 14:39:48'),
(32, 17, 'Created', NULL, 'pending', '--', 15, '2025-12-16 14:42:31'),
(33, 18, 'Created', NULL, 'pending', '--', 15, '2025-12-16 14:55:00'),
(34, 19, 'Created', NULL, 'pending', '--', 15, '2025-12-16 14:55:00'),
(35, 16, 'approved', 'pending', 'approved', '', 1, '2025-12-16 15:06:34'),
(36, 20, 'Created', NULL, 'pending', '--', 9, '2025-12-17 10:43:46'),
(37, 20, 'approved', 'pending', 'approved', NULL, 18, '2025-12-17 10:48:00'),
(38, 20, 'approved', 'approved', 'approved', NULL, 18, '2025-12-17 10:48:01'),
(39, 21, 'Created', NULL, 'pending', '--', 9, '2025-12-18 11:08:02'),
(40, 22, 'Created', NULL, 'pending', '--', 9, '2025-12-18 11:08:56'),
(41, 23, 'Created', NULL, 'pending', '--', 9, '2025-12-18 11:09:46'),
(42, 22, 'approved', 'pending', 'approved', NULL, 18, '2025-12-18 11:41:12'),
(43, 21, 'approved', 'pending', 'approved', NULL, 18, '2025-12-18 11:45:11'),
(44, 24, 'Created', NULL, 'pending', '--', 9, '2025-12-19 14:41:38'),
(45, 25, 'Created', NULL, 'pending', '--', 9, '2025-12-19 14:44:22'),
(46, 26, 'Created', NULL, 'pending', '--', 9, '2025-12-19 14:45:13'),
(47, 24, 'approved', 'pending', 'approved', NULL, 18, '2025-12-19 14:48:53'),
(48, 23, 'approved', 'pending', 'approved', NULL, 11, '2025-12-19 14:50:21'),
(49, 23, 'approved', 'pending', 'approved', NULL, 11, '2025-12-19 14:50:22'),
(50, 25, 'approved', 'pending', 'approved', NULL, 11, '2025-12-19 14:52:21'),
(51, 26, 'approved', 'pending', 'approved', NULL, 11, '2025-12-19 14:53:53'),
(52, 27, 'Created', NULL, 'pending', '--', 9, '2025-12-19 15:01:23'),
(53, 28, 'Created', NULL, 'pending', '--', 9, '2025-12-19 15:01:23'),
(54, 29, 'Created', NULL, 'pending', '--', 9, '2025-12-19 15:01:23'),
(55, 30, 'Created', NULL, 'pending', '--', 9, '2025-12-19 15:01:23'),
(56, 31, 'Created', NULL, 'pending', '--', 9, '2025-12-19 15:05:26'),
(57, 32, 'Created', NULL, 'pending', '--', 9, '2025-12-19 15:05:26'),
(58, 31, 'approved', 'pending', 'approved', NULL, 1, '2025-12-19 15:24:00'),
(59, 32, 'approved', 'pending', 'approved', NULL, 1, '2025-12-19 15:24:00'),
(60, 29, 'approved', 'pending', 'approved', NULL, 1, '2025-12-19 15:24:12'),
(61, 30, 'approved', 'pending', 'approved', NULL, 1, '2025-12-19 15:24:12'),
(62, 27, 'approved', 'pending', 'approved', NULL, 1, '2025-12-19 15:24:28'),
(63, 28, 'approved', 'pending', 'approved', NULL, 1, '2025-12-19 15:24:29'),
(64, 18, 'approved', 'pending', 'approved', NULL, 1, '2025-12-19 15:24:49'),
(65, 19, 'approved', 'pending', 'approved', NULL, 1, '2025-12-19 15:24:50'),
(66, 17, 'approved', 'pending', 'approved', NULL, 1, '2025-12-19 15:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_request_header`
--

CREATE TABLE `visitor_request_header` (
  `id` int(11) NOT NULL,
  `header_code` varchar(50) NOT NULL,
  `requested_by` varchar(100) NOT NULL,
  `referred_by` int(11) DEFAULT NULL,
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

INSERT INTO `visitor_request_header` (`id`, `header_code`, `requested_by`, `referred_by`, `requested_date`, `requested_time`, `department`, `purpose`, `description`, `email`, `total_visitors`, `status`, `updated_by`, `remarks`, `created_at`, `updated_at`, `company`) VALUES
(1, 'GV000001', '1', 5, '2025-12-13', '10:30:00', 'IT', 'General Visit', 'Testing Purpose ', 'karnamahesh42@gmail.com', 1, 'approved', NULL, '', '2025-12-12 22:19:39', '2025-12-12 22:19:39', 'UKMPL'),
(2, 'GV000002', '9', 11, '2025-12-12', '22:33:00', 'Finance', 'Meeting', 'Test Visit Purpose  ', 'karnamahesh42@gmail.com', 1, 'approved', NULL, NULL, '2025-12-12 22:34:33', '2025-12-13 04:01:35', 'UKMPL'),
(3, 'GV000003', '9', 16, '2025-12-12', '22:35:00', 'Finance', 'Meeting', 'Test Meeting Visit', 'karnamahesh42@gmail.com', 1, 'approved', NULL, NULL, '2025-12-12 22:36:16', '2025-12-14 12:04:28', 'UKMPL'),
(4, 'GV000004', '9', 11, '2025-12-13', '10:50:00', 'Finance', 'Vendor Visit', 'Test Visit', 'karnamahesh42@gmail.com', 2, 'approved', NULL, NULL, '2025-12-13 10:48:10', '2025-12-13 10:54:30', 'UKMPL'),
(5, 'GV000005', '9', 16, '2025-12-13', '14:30:00', 'Finance', 'Event Visit', 'Client Planning For Event', 'ukmledp@ramojifilmcity.com', 1, 'rejected', NULL, 'Time Over', '2025-12-13 13:57:28', '2025-12-16 14:25:34', 'UKMPL'),
(6, 'GV000006', '9', 16, '2025-12-13', '15:53:00', 'Finance', 'Location Recci', 'Test Description ', 'karnamahesh42@gmail.com', 1, 'approved', NULL, NULL, '2025-12-13 14:54:13', '2025-12-13 15:13:47', 'UKMPL'),
(7, 'GV000007', '9', 18, '2025-12-15', '10:00:00', 'Finance', 'Vendor Visit', 'Test Visit\r\n', 'karnamahesh42@gmail.com', 1, 'rejected', NULL, 'Not A Valid Details', '2025-12-15 10:00:36', '2025-12-15 15:43:03', 'UKMPL'),
(8, 'GV000008', '9', 11, '2025-12-15', '11:03:00', 'Finance', 'Meeting', 'Test Meeting Purpose', 'karnamahesh42@gmail.com', 2, 'approved', NULL, NULL, '2025-12-15 10:05:43', '2025-12-15 15:47:31', 'UKMPL'),
(9, 'GV000009', '9', 16, '2025-12-15', '11:08:00', 'Finance', 'Personal Visit', 'To Meet Mr Lokesh', 'maheshkarna@gmail.com', 1, 'approved', NULL, NULL, '2025-12-15 10:09:35', '2025-12-15 12:52:32', 'UKMPL'),
(10, 'GV000010', '9', 18, '2025-12-15', '16:31:00', 'Finance', 'Event Visit', 'Lime Lite Garden ', 'ukmledp@ramojifilmcity.com', 1, 'approved', NULL, NULL, '2025-12-15 15:32:12', '2025-12-15 15:44:31', 'UKMPL'),
(11, 'GV000011', '9', 11, '2025-12-15', '15:49:00', 'Finance', 'General Visit', 'Test', 'ukmledp@ramojifilmcity.com', 1, 'approved', NULL, '', '2025-12-15 15:49:41', '2025-12-15 16:03:14', 'UKMPL'),
(12, 'GV000012', '9', 11, '2025-12-15', '15:49:00', 'Finance', 'General Visit', 'Test 2', 'developers@ramojifilmcity.com', 1, 'approved', NULL, '', '2025-12-15 15:50:22', '2025-12-15 15:54:49', 'UKMPL'),
(13, 'GV000013', '9', 11, '2025-12-15', '15:50:00', 'Finance', 'Delivery', 'Test 3', 'karnamahesh42@gmail.com', 1, 'approved', NULL, NULL, '2025-12-15 15:51:04', '2025-12-15 15:53:36', 'UKMPL'),
(14, 'GV000014', '15', 19, '2025-12-16', '14:38:00', 'IT', 'Meeting', 'Sap Meating Purpose', 'karnamahesh42@gmail.com', 1, 'approved', NULL, '', '2025-12-16 14:39:48', '2025-12-16 15:06:34', 'UKMPL'),
(15, 'GV000015', '15', 5, '2025-12-16', '14:40:00', 'IT', 'Delivery', 'Delivery Purpose ', 'karnamahesh42@gmail.com', 1, 'approved', NULL, NULL, '2025-12-16 14:42:31', '2025-12-19 15:28:18', 'UKMPL'),
(16, 'GV000016', '15', 5, '2025-12-16', '14:52:00', 'IT', 'Interview', 'Interview Purpose', 'karnamahesh42@gmail.com', 2, 'approved', NULL, NULL, '2025-12-16 14:55:00', '2025-12-19 15:24:50', 'UKMPL'),
(17, 'GV000017', '9', 18, '2025-12-17', '11:00:00', 'Finance', 'Location Recci', 'Location Visit', 'krishna.vasireddy@gmail.com', 1, 'approved', NULL, NULL, '2025-12-17 10:43:46', '2025-12-17 10:48:01', 'UKMPL'),
(18, 'GV000018', '9', 18, '2025-12-18', '11:07:00', 'Finance', 'Tourism Visit', 'Test Visit ', 'karnamahesh42@gmail.com', 1, 'approved', NULL, NULL, '2025-12-18 11:08:02', '2025-12-18 11:45:11', 'UKMPL'),
(19, 'GV000019', '9', 18, '2025-12-18', '11:08:00', 'Finance', 'Location Recci', 'Test Description ', 'maheshkarna@gmail.com', 1, 'approved', NULL, NULL, '2025-12-18 11:08:56', '2025-12-18 11:41:12', 'UKMPL'),
(20, 'GV000020', '9', 11, '2025-12-18', '11:09:00', 'Finance', 'General Visit', 'General Visit Purpose ', 'karnamahesh42@gmail.com', 1, 'approved', NULL, NULL, '2025-12-18 11:09:46', '2025-12-19 14:50:22', 'UKMPL'),
(21, 'GV000021', '9', 18, '2025-12-19', '14:41:00', 'Finance', 'General Visit', 'Tersdt', 'karnamahesh42@gmail.com', 1, 'approved', NULL, NULL, '2025-12-19 14:41:38', '2025-12-19 14:48:53', 'UKMPL'),
(22, 'GV000022', '9', 11, '2025-12-19', '14:43:00', 'Finance', 'Location Recci', 'Tttttttt', 'karnamahesh42@gmail.com', 1, 'approved', NULL, NULL, '2025-12-19 14:44:22', '2025-12-19 14:52:21', 'UKMPL'),
(23, 'GV000023', '9', 11, '2025-12-19', '14:44:00', 'Finance', 'Location Recci', 'Rrrrrr', 'maheshkarna@gmail.com', 1, 'approved', NULL, NULL, '2025-12-19 14:45:13', '2025-12-19 14:53:53', 'UKMPL'),
(24, 'GV000024', '9', 18, '2025-12-19', '15:00:00', 'Finance', 'Location Recci', 'Testt', 'karnamahesh42@gmail.com', 2, 'approved', NULL, NULL, '2025-12-19 15:01:23', '2025-12-19 15:24:29', 'UKMPL'),
(25, 'GV000025', '9', 18, '2025-12-19', '15:00:00', 'Finance', 'Location Recci', 'Testt', 'karnamahesh42@gmail.com', 2, 'approved', NULL, NULL, '2025-12-19 15:01:23', '2025-12-19 15:24:12', 'UKMPL'),
(26, 'GV000026', '9', 11, '2025-12-19', '15:04:00', 'Finance', 'Location Recci', 'Asds', 'karnamahesh42@gmail.com', 2, 'approved', NULL, NULL, '2025-12-19 15:05:26', '2025-12-19 15:24:00', 'UKMPL');

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
-- Indexes for table `expired_visitor_passes`
--
ALTER TABLE `expired_visitor_passes`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expired_visitor_passes`
--
ALTER TABLE `expired_visitor_passes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_hashkeys`
--
ALTER TABLE `user_hashkeys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `visitor_request_header`
--
ALTER TABLE `visitor_request_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
