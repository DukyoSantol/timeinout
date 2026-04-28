-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2026 at 10:31 AM
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
-- Database: `time_in_out`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_01_01_000001_create_time_records_table', 1),
(3, '2024_01_01_000002_test_migration', 1),
(4, '2024_01_01_000003_create_users_table', 1),
(5, '2026_01_06_133241_add_has_timed_in_today_to_time_records_table', 1),
(6, '2026_01_06_133833_add_timed_in_flag_to_time_records', 1),
(7, '2026_01_06_143707_add_status_to_time_records', 1),
(8, '2026_01_09_142524_add_morning_time_in_to_time_records_table', 2),
(9, '2026_01_09_144905_alter_time_in_column_nullable_in_time_records_table', 3),
(10, '2026_01_09_145215_add_morning_time_out_to_time_records_table', 4),
(11, '2026_01_09_145418_add_session_columns_to_time_records_table', 5),
(12, '2026_01_13_071649_create_sessions_table', 6),
(13, '2026_01_13_100000_remove_old_time_columns_from_time_records', 6),
(15, '2026_01_15_144217_add_time_out_columns_for_quick_fix', 7),
(16, '2026_03_22_202318_add_target_and_accomplishment_to_time_records_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_table`
--

CREATE TABLE `test_table` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_records`
--

CREATE TABLE `time_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `division` varchar(255) NOT NULL,
  `target` text DEFAULT NULL,
  `accomplishment` text DEFAULT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `total_hours` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `has_timed_in_today` tinyint(1) NOT NULL DEFAULT 0,
  `timed_in_flag` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'NOT_STARTED',
  `morning_time_in` time DEFAULT NULL,
  `morning_time_out` time DEFAULT NULL,
  `afternoon_time_in` time DEFAULT NULL,
  `afternoon_time_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_records`
--

INSERT INTO `time_records` (`id`, `user_id`, `full_name`, `position`, `division`, `target`, `accomplishment`, `time_in`, `time_out`, `notes`, `total_hours`, `created_at`, `updated_at`, `has_timed_in_today`, `timed_in_flag`, `status`, `morning_time_in`, `morning_time_out`, `afternoon_time_in`, `afternoon_time_out`) VALUES
(30, 33, 'Socorro Oquendo', 'Chief', 'Finance Administrative Division', NULL, NULL, '2026-01-15 07:36:59', NULL, NULL, 0.00, '2026-01-09 07:36:59', '2026-01-15 14:27:50', 0, 0, 'TIMED_IN', '07:36:59', NULL, NULL, '23:59:00'),
(38, 39, 'Honey Rose B. Dayoc', 'Engineer II', 'Mine Management Division', NULL, NULL, '2026-01-15 08:00:40', NULL, NULL, 15.95, '2026-01-09 08:00:40', '2026-01-28 04:22:41', 0, 0, 'TIMED_IN', '08:00:40', '12:12:23', '12:17:41', '23:59:00'),
(39, 40, 'Mai-lyn D. Reazonda', 'COMMUNITY AFFAIRS OFFICER II', 'Mine Safety Environment and Social Development Division', NULL, NULL, '2026-01-15 08:00:49', NULL, NULL, 15.97, '2026-01-09 08:00:49', '2026-01-28 04:22:41', 0, 0, 'TIMED_IN', '08:00:49', '12:13:54', '12:16:43', '23:59:00'),
(41, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, NULL, '2026-01-15 08:13:31', '2026-01-15 17:01:10', NULL, 8.77, '2026-01-09 08:13:31', '2026-01-10 17:01:10', 0, 0, 'COMPLETED', '08:13:31', '12:37:17', '12:37:52', '17:01:10'),
(42, 41, 'Maria Julia M. Modequillo', 'Science Research Specialist I', 'Office of the Regional Director', NULL, NULL, '2026-01-15 08:15:19', NULL, NULL, 15.72, '2026-01-09 08:15:19', '2026-01-28 04:22:41', 0, 0, 'TIMED_IN', '08:15:19', '12:05:35', '12:07:54', '23:59:00'),
(43, 42, 'Leslie Neil T. Burgos', 'Science Research Specialist II', 'Geoscience Division', NULL, NULL, '2026-01-15 08:23:53', NULL, NULL, 15.57, '2026-01-09 08:23:53', '2026-01-28 04:22:41', 0, 0, 'TIMED_IN', '08:23:53', '12:15:42', '12:19:31', '23:59:00'),
(44, 43, 'Leandrew Floyd', 'SRSII', 'Office of the Regional Director', NULL, NULL, '2026-01-15 08:28:53', NULL, NULL, 15.48, '2026-01-09 08:28:53', '2026-01-28 04:22:41', 0, 0, 'TIMED_IN', '08:28:53', '12:01:07', '12:02:23', '23:59:00'),
(45, 29, 'Mizraim G. Melchor Jr.', 'Geologist II', 'Geoscience Division', NULL, NULL, '2026-01-15 08:31:16', NULL, NULL, 15.43, '2026-01-09 08:31:16', '2026-01-28 04:22:41', 0, 0, 'TIMED_IN', '08:31:16', '12:29:09', '12:29:13', '23:59:00'),
(46, 17, 'Jenny Rose S. Rojas', 'SRS II', 'Mine Management Division', NULL, NULL, '2026-01-15 08:32:02', NULL, NULL, 17.90, '2026-01-09 08:32:02', '2026-01-28 08:02:51', 0, 0, 'TIMED_IN', '06:05:00', '12:22:00', '12:25:00', '23:59:00'),
(47, 27, 'Raphael Louis Silades Ochave', 'Science Research Specialist I', 'Mine Management Division', NULL, NULL, '2026-01-15 08:36:08', NULL, NULL, 16.80, '2026-01-09 08:36:08', '2026-01-28 08:09:39', 0, 0, 'TIMED_IN', '07:11:00', '12:29:00', '12:31:00', '23:59:00'),
(48, 21, 'Ian Gabriel G. De Vera', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, '2026-01-15 08:36:29', NULL, NULL, 17.05, '2026-01-09 08:36:29', '2026-01-28 08:01:54', 0, 0, 'TIMED_IN', '06:56:00', '12:00:00', '12:12:00', '23:59:00'),
(49, 15, 'Christy Marie Anne I. Olaivar', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, '2026-01-15 08:38:08', NULL, NULL, 16.80, '2026-01-09 08:38:08', '2026-01-28 07:56:34', 0, 0, 'TIMED_IN', '07:11:00', '12:17:00', '12:19:00', '23:59:00'),
(50, 24, 'Vincent', 'SRS I', 'Office of the Regional Director', NULL, NULL, '2026-01-15 08:39:09', NULL, NULL, 16.90, '2026-01-09 08:39:09', '2026-01-28 07:55:15', 0, 0, 'TIMED_IN', '07:05:00', '12:21:00', '12:22:00', '23:59:00'),
(51, 44, 'April Lepardo', 'IOII', 'Office of the Regional Director', NULL, NULL, '2026-01-15 08:40:02', '2026-01-15 12:09:55', NULL, 3.48, '2026-01-09 08:40:02', '2026-01-15 14:28:22', 0, 0, 'COMPLETED', '08:40:02', '12:08:22', '12:09:11', '12:09:55'),
(52, 28, 'Kenneth Mark B. Nisnea', 'Science Research Specialist 1', 'Geoscience Division', NULL, NULL, '2026-01-15 08:40:48', NULL, NULL, 16.68, '2026-01-09 08:40:48', '2026-01-28 07:53:26', 0, 0, 'TIMED_IN', '07:18:00', '12:15:00', '12:17:00', '23:59:00'),
(53, 38, 'Kirk Justin Tizon', 'SEMS', 'Mine Safety Environment and Social Development Division', NULL, NULL, '2026-01-15 08:47:16', NULL, NULL, 16.13, '2026-01-09 08:47:14', '2026-01-28 07:52:29', 0, 0, 'TIMED_IN', '07:51:00', '12:34:00', '12:35:00', '23:59:00'),
(54, 36, 'Faye Yeeda A. Espinosa', 'Science Research Specialist II', 'Mine Safety Environment and Social Development Division', NULL, NULL, '2026-01-15 08:47:19', NULL, NULL, 16.18, '2026-01-09 08:47:19', '2026-01-28 07:51:14', 0, 0, 'TIMED_IN', '07:48:00', '12:09:00', '12:13:00', '23:59:00'),
(55, 31, 'Allen Mark Abanilla', 'Senior Geologists', 'Geoscience Division', NULL, NULL, '2026-01-15 08:47:23', NULL, NULL, 16.47, '2026-01-09 08:47:23', '2026-01-28 07:50:18', 0, 0, 'TIMED_IN', '07:31:00', '12:22:00', '12:23:00', '23:59:00'),
(56, 32, 'Lovely Rose L. Balili', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, '2026-01-15 08:48:17', '2026-01-15 17:08:14', NULL, 9.58, '2026-01-09 08:48:17', '2026-01-28 07:49:19', 0, 0, 'COMPLETED', '07:33:00', '12:03:00', '12:04:00', '17:08:00'),
(57, 12, 'Iris Kay L. Cortez', 'Engineer II', 'Mine Management Division', NULL, NULL, '2026-01-15 08:49:32', NULL, NULL, 16.28, '2026-01-09 08:49:32', '2026-01-28 07:47:12', 0, 0, 'TIMED_IN', '07:42:00', '12:07:00', '12:09:00', '23:59:00'),
(58, 26, 'Cris Ryann Nacua Ypil', 'Engineer II', 'Mine Management Division', NULL, NULL, '2026-01-15 08:49:32', '2026-01-15 17:04:44', NULL, 9.47, '2026-01-09 08:49:32', '2026-01-28 07:48:14', 0, 0, 'COMPLETED', '07:36:00', '12:13:00', '12:13:00', '17:04:00'),
(59, 13, 'Jomari John N. Cleofe', 'Science Research Specialist II', 'Mine Management Division', NULL, NULL, '2026-01-15 08:51:14', NULL, NULL, 16.68, '2026-01-09 08:51:14', '2026-01-28 07:46:00', 0, 0, 'TIMED_IN', '07:18:00', '12:25:00', '12:25:00', '23:59:00'),
(60, 18, 'Benedict Lejano', 'Sr. Science Research Specialist', 'Mine Safety Environment and Social Development Division', NULL, NULL, '2026-01-15 08:51:37', NULL, NULL, 17.07, '2026-01-09 08:51:37', '2026-01-28 07:43:56', 0, 0, 'TIMED_IN', '06:55:00', '12:11:00', '12:11:00', '23:59:00'),
(61, 16, 'Adonis Angelo Cañon', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, '2026-01-15 08:52:12', NULL, NULL, 18.07, '2026-01-09 08:52:12', '2026-01-28 07:42:07', 0, 0, 'TIMED_IN', '05:55:00', '12:02:00', '12:05:00', '23:59:00'),
(62, 37, 'FRANCIS ANGELO G. PARAMI', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, '2026-01-15 08:52:51', NULL, NULL, 16.18, '2026-01-09 08:52:51', '2026-01-28 07:41:01', 0, 0, 'TIMED_IN', '07:48:00', '12:01:00', '12:18:00', '23:59:00'),
(63, 34, 'Lady Rose T. Rodriguez', 'Cartographer II', 'Geoscience Division', NULL, NULL, '2026-01-15 08:55:34', NULL, NULL, 16.37, '2026-01-09 08:55:34', '2026-01-28 07:35:30', 0, 0, 'TIMED_IN', '07:37:00', '12:18:00', '12:18:00', '23:59:00'),
(64, 19, 'Khlaire Abegail Ruperez', 'Planning Officer II', 'Office of the Regional Director', NULL, NULL, '2026-01-15 08:55:52', '2026-01-15 17:07:17', NULL, 9.88, '2026-01-09 08:55:52', '2026-01-28 07:34:03', 0, 0, 'COMPLETED', '07:14:00', '12:00:00', '12:02:00', '17:07:00'),
(65, 20, 'Marie Anne Garcia', 'GIS Specialist C', 'Geoscience Division', NULL, NULL, '2026-01-15 08:56:56', NULL, NULL, 16.68, '2026-01-09 08:56:56', '2026-01-28 07:33:17', 0, 0, 'TIMED_IN', '07:18:00', '12:40:00', '12:41:00', '23:59:00'),
(66, 45, 'Lea Mae T. Oracion', 'Geologist II', 'Geoscience Division', NULL, NULL, '2026-01-15 08:58:26', NULL, NULL, 15.00, '2026-01-09 08:58:26', '2026-01-28 04:22:40', 0, 0, 'TIMED_IN', '08:58:26', '12:41:50', '12:42:14', '23:59:00'),
(67, 25, 'Lj Myah C. Dalisay', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, '2026-01-15 09:00:46', NULL, NULL, 16.88, '2026-01-09 09:00:46', '2026-01-28 07:32:01', 0, 0, 'TIMED_IN', '07:06:00', '12:00:00', '12:45:00', '23:59:00'),
(68, 23, 'Neri Mar B. Paraguya', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, '2026-01-15 09:09:22', NULL, NULL, 16.90, '2026-01-09 09:09:22', '2026-01-28 07:31:13', 0, 0, 'TIMED_IN', '07:05:00', '12:01:00', '12:07:00', '23:59:00'),
(69, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, '2026-01-15 09:11:18', NULL, NULL, 17.00, '2026-01-09 09:11:18', '2026-01-28 07:30:25', 0, 0, 'TIMED_IN', '06:59:00', '12:08:00', '12:08:00', '23:59:00'),
(70, 46, 'Ignacio C. Ortiz, Jr.', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, '2026-01-15 09:18:18', NULL, NULL, 14.67, '2026-01-09 09:18:18', '2026-01-28 04:22:40', 0, 0, 'TIMED_IN', '09:18:18', '12:05:25', '12:05:46', '23:59:00'),
(71, 47, 'Lowell C. Chicote', 'Economist II', 'Mine Management Division', NULL, NULL, '2026-01-15 09:22:42', '2026-01-15 16:31:33', NULL, 7.13, '2026-01-09 09:22:42', '2026-01-15 14:28:22', 0, 0, 'COMPLETED', '09:22:42', '12:03:26', '12:42:00', '16:31:33'),
(73, 30, 'Edmark Joseph Acilo', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, '2026-01-15 10:33:35', NULL, NULL, 16.43, '2026-01-09 10:33:35', '2026-01-28 07:27:58', 0, 0, 'TIMED_IN', '07:33:00', '12:03:00', '12:04:00', '23:59:00'),
(74, 49, 'Rheycalyn Lugtu', 'Senior Science Research Specialist', 'Mine Safety Environment and Social Development Division', NULL, NULL, '2026-01-15 12:11:00', NULL, NULL, 14.02, '2026-01-09 12:11:00', '2026-01-28 07:26:28', 0, 0, 'TIMED_IN', '09:58:00', '12:11:00', '12:12:00', '23:59:00'),
(75, 14, 'Mia Marcelle Descalsota Salo', 'GIS Specialist C', 'Geoscience Division', NULL, NULL, '2026-01-15 12:27:18', '2026-01-15 16:21:52', NULL, 10.52, '2026-01-09 12:27:18', '2026-01-28 07:24:52', 0, 0, 'COMPLETED', '05:50:00', '12:27:00', '12:27:00', '16:21:00'),
(76, 11, 'Jyreen Joy M Peñaloga', 'Senior Geologist', 'Geoscience Division', NULL, NULL, '2026-01-15 12:38:27', NULL, NULL, 16.22, '2026-01-09 12:38:27', '2026-01-28 02:59:54', 0, 0, 'COMPLETED', '07:46:00', '12:40:00', '12:41:00', '23:59:00'),
(80, 35, 'Rene Redondo Jr', 'SISS', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-15 08:57:23', '2026-01-15 08:57:47', 0, 0, 'COMPLETED', '16:57:23', '16:57:38', '16:57:43', '16:57:47'),
(81, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 0.05, '2026-01-19 07:27:03', '2026-01-19 07:31:04', 0, 0, 'COMPLETED', '15:27:03', '15:28:54', '15:30:06', '15:31:04'),
(82, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 8.45, '2026-01-20 01:06:16', '2026-01-20 09:34:27', 0, 0, 'COMPLETED', '09:06:16', '11:14:01', '13:00:11', '17:34:26'),
(83, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 11.87, '2026-01-20 21:54:15', '2026-01-21 09:47:03', 0, 0, 'COMPLETED', '05:54:15', '17:36:26', '17:36:30', '17:47:03'),
(84, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.73, '2026-01-21 22:12:19', '2026-01-22 08:57:28', 0, 0, 'COMPLETED', '06:12:19', '14:22:39', '14:22:52', '16:57:28'),
(86, 53, 'Juan2', 'Iy', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-22 07:47:28', '2026-01-22 07:47:41', 0, 0, 'COMPLETED', '15:47:28', '15:47:33', '15:47:37', '15:47:41'),
(87, 51, 'Carla Lea P. Igaran', 'ADAS II', 'Finance Administrative Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-22 07:49:06', '2026-01-22 07:49:31', 0, 0, 'COMPLETED', '15:49:06', '15:49:16', '15:49:26', '15:49:31'),
(88, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 8.88, '2026-01-23 00:40:00', '2026-01-29 09:33:50', 0, 0, 'TIMED_IN', '08:40:00', '12:13:00', '12:13:00', '17:33:00'),
(89, 54, 'MUSTANSIR V. MANJOORSA', 'Supervising Geologist', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-23 09:06:21', '2026-01-23 09:07:17', 0, 0, 'COMPLETED', '17:06:21', '17:06:58', '17:07:08', '17:07:17'),
(90, 15, 'Christy Marie Anne I. Olaivar', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-23 09:27:50', '2026-01-23 09:29:00', 0, 0, 'COMPLETED', '17:27:50', '17:28:48', '17:28:58', '17:29:00'),
(91, 11, 'Jyreen Joy M Peñaloga', 'Senior Geologist', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-23 09:29:57', '2026-01-23 09:30:08', 0, 0, 'COMPLETED', '17:29:57', '17:30:01', '17:30:04', '17:30:08'),
(92, 14, 'Mia Marcelle Descalsota Salo', 'GIS Specialist C', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-23 09:46:31', '2026-01-23 09:46:42', 0, 0, 'COMPLETED', '17:46:31', '17:46:35', '17:46:38', '17:46:42'),
(93, 25, 'Lj Myah C. Dalisay', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-23 09:59:00', '2026-01-23 09:59:12', 0, 0, 'COMPLETED', '17:59:00', '17:59:04', '17:59:07', '17:59:12'),
(94, 55, 'Kenneth Mark B. Nisnea', 'Science Research Specialist 1', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-23 10:00:59', '2026-01-23 10:01:17', 0, 0, 'COMPLETED', '18:00:59', '18:01:06', '18:01:13', '18:01:17'),
(95, 24, 'Vincent', 'SRS I', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-23 10:05:55', '2026-01-23 10:06:08', 0, 0, 'COMPLETED', '18:05:55', '18:05:59', '18:06:04', '18:06:08'),
(96, 46, 'Ignacio C. Ortiz, Jr.', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-23 10:08:09', '2026-01-23 10:08:46', 0, 0, 'COMPLETED', '18:08:09', '18:08:35', '18:08:42', '18:08:46'),
(97, 21, 'Ian Gabriel G. De Vera', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-23 10:23:39', '2026-01-23 10:23:45', 0, 0, 'COMPLETED', '18:23:39', '18:23:41', '18:23:43', '18:23:45'),
(98, 29, 'Mizraim G. Melchor Jr.', 'Geologist II', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-23 10:34:46', '2026-01-23 10:34:56', 0, 0, 'COMPLETED', '18:34:46', '18:34:48', '18:34:51', '18:34:56'),
(99, 56, 'Allen Mark Abanilla', 'Senior Geologists', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-23 10:39:16', '2026-01-23 10:39:25', 0, 0, 'COMPLETED', '18:39:16', '18:39:19', '18:39:22', '18:39:25'),
(100, 33, 'Socorro Oquendo', 'Chief', 'Finance Administrative Division', NULL, NULL, NULL, NULL, NULL, 0.03, '2026-01-27 06:58:30', '2026-01-27 07:01:35', 0, 0, 'COMPLETED', '14:58:30', '14:59:24', '15:00:07', '15:01:35'),
(101, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 11.02, '2026-01-28 22:26:48', '2026-01-29 09:28:46', 0, 0, 'COMPLETED', '06:26:48', '12:55:03', '12:55:16', '17:28:46'),
(102, 12, 'Iris Kay L. Cortez', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-01-29 09:53:55', '2026-01-29 09:54:25', 0, 0, 'TIMED_IN', '17:53:55', '17:54:25', NULL, NULL),
(103, 30, 'Edmark Joseph Acilo', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.98, '2026-01-29 22:10:52', '2026-01-30 09:11:23', 0, 0, 'COMPLETED', '06:10:52', '13:36:45', '13:37:04', '17:11:23'),
(104, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.97, '2026-01-29 22:18:31', '2026-01-30 08:17:25', 0, 0, 'COMPLETED', '06:18:31', '12:06:00', '12:08:33', '16:17:25'),
(105, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.00, '2026-01-29 22:59:11', '2026-01-30 09:00:36', 0, 0, 'COMPLETED', '06:59:11', '14:23:39', '14:23:41', '17:00:36'),
(106, 32, 'Lovely Rose L. Balili', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.42, '2026-01-29 23:01:22', '2026-01-30 08:26:56', 0, 0, 'COMPLETED', '07:01:22', '12:06:28', '12:07:25', '16:26:56'),
(107, 21, 'Ian Gabriel G. De Vera', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.47, '2026-01-29 23:01:53', '2026-01-30 08:30:33', 0, 0, 'COMPLETED', '07:01:53', '12:01:56', '12:02:14', '16:30:33'),
(108, 24, 'Vincent', 'SRS I', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.05, '2026-01-29 23:04:25', '2026-01-30 09:08:00', 0, 0, 'COMPLETED', '07:04:25', '12:20:38', '12:21:22', '17:08:00'),
(109, 12, 'Iris Kay L. Cortez', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 12.73, '2026-01-29 23:04:26', '2026-01-30 11:49:07', 0, 0, 'COMPLETED', '07:04:26', '11:56:41', '13:20:41', '19:49:07'),
(110, 57, 'Rodeljan Nuke Free S. Dalian', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.65, '2026-01-29 23:07:07', '2026-01-30 08:47:04', 0, 0, 'COMPLETED', '07:07:07', '12:02:59', '12:15:07', '16:47:04'),
(111, 15, 'Christy Marie Anne I. Olaivar', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.57, '2026-01-29 23:09:26', '2026-01-30 08:44:12', 0, 0, 'COMPLETED', '07:09:26', '12:20:01', '12:22:16', '16:44:12'),
(112, 29, 'Mizraim G. Melchor Jr.', 'Geologist II', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.15, '2026-01-29 23:22:24', '2026-01-30 08:32:35', 0, 0, 'COMPLETED', '07:22:24', '12:17:45', '12:17:48', '16:32:35'),
(113, 58, 'VILLANUEVA, RONALD P.', 'Engineer III', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 5.48, '2026-01-29 23:29:15', '2026-01-30 04:58:58', 0, 0, 'TIMED_IN', '07:29:15', '12:58:46', '12:58:58', NULL),
(114, 17, 'Jenny Rose S. Rojas', 'SRS II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.97, '2026-01-29 23:31:03', '2026-01-30 09:30:53', 0, 0, 'COMPLETED', '07:31:03', '12:06:57', '12:08:11', '17:30:53'),
(115, 23, 'Neri Mar B. Paraguya', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.60, '2026-01-29 23:31:43', '2026-01-30 09:08:31', 0, 0, 'COMPLETED', '07:31:43', '12:01:13', '12:06:55', '17:08:31'),
(116, 55, 'Kenneth Mark B. Nisnea', 'Science Research Specialist 1', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.25, '2026-01-29 23:31:57', '2026-01-30 08:48:02', 0, 0, 'COMPLETED', '07:31:57', '12:12:13', '12:14:13', '16:48:02'),
(117, 40, 'Mai-lyn D. Reazonda', 'COMMUNITY AFFAIRS OFFICER II', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 12.03, '2026-01-29 23:37:01', '2026-01-30 11:40:28', 0, 0, 'COMPLETED', '07:37:01', '12:14:47', '12:35:05', '19:40:28'),
(118, 47, 'Lowell C. Chicote', 'Economist II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.43, '2026-01-29 23:37:32', '2026-01-30 09:04:01', 0, 0, 'COMPLETED', '07:37:32', '13:20:56', '13:21:03', '17:04:01'),
(119, 59, 'Judy Ann C. Mejorada-Wenceslao', 'Mining Claims Examiner II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 11.72, '2026-01-29 23:38:26', '2026-01-30 11:22:53', 0, 0, 'COMPLETED', '07:38:26', '13:27:59', '13:28:05', '19:22:53'),
(120, 19, 'Khlaire Abegail Ruperez', 'Planning Officer II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.33, '2026-01-29 23:38:37', '2026-01-30 09:59:32', 0, 0, 'TIMED_IN', '07:38:37', '17:59:32', NULL, NULL),
(121, 42, 'Leslie Neil T. Burgos', 'Science Research Specialist II', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 10.12, '2026-01-29 23:42:41', '2026-01-30 09:50:58', 0, 0, 'COMPLETED', '07:42:41', '12:15:24', '12:20:47', '17:50:58'),
(122, 56, 'Allen Mark Abanilla', 'Senior Geologists', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.82, '2026-01-29 23:45:37', '2026-01-30 09:35:54', 0, 0, 'COMPLETED', '07:45:37', '12:45:56', '12:46:15', '17:35:54'),
(123, 43, 'Leandrew Floyd', 'SRSII', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.22, '2026-01-29 23:56:45', '2026-01-30 09:10:05', 0, 0, 'COMPLETED', '07:56:45', '12:29:55', '12:31:57', '17:10:05'),
(124, 36, 'Faye Yeeda A. Espinosa', 'Science Research Specialist II', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 9.12, '2026-01-30 00:02:50', '2026-01-30 09:10:48', 0, 0, 'COMPLETED', '08:02:50', '12:20:17', '12:24:23', '17:10:48'),
(125, 41, 'Maria Julia M. Modequillo', 'Science Research Specialist I', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 8.98, '2026-01-30 00:07:09', '2026-01-30 09:07:11', 0, 0, 'COMPLETED', '08:07:09', '12:00:55', '12:02:27', '17:07:11'),
(126, 49, 'Rheycalyn Lugtu', 'Senior Science Research Specialist', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 9.80, '2026-01-30 00:08:29', '2026-01-30 09:57:48', 0, 0, 'COMPLETED', '08:08:29', '12:02:25', '12:21:43', '17:57:48'),
(127, 26, 'Cris Ryann Nacua Ypil', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.25, '2026-01-30 00:09:09', '2026-01-30 09:25:27', 0, 0, 'COMPLETED', '08:09:09', '12:16:51', '12:18:36', '17:25:27'),
(128, 16, 'Adonis Angelo Cañon', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.27, '2026-01-30 00:12:55', '2026-01-30 09:30:25', 0, 0, 'COMPLETED', '08:12:55', '12:05:27', '13:12:14', '17:30:25'),
(129, 46, 'Ignacio C. Ortiz, Jr.', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.03, '2026-01-30 00:37:29', '2026-01-30 09:39:59', 0, 0, 'COMPLETED', '08:37:29', '13:35:36', '13:36:09', '17:39:59'),
(130, 14, 'Mia Marcelle Descalsota Salo', 'GIS Specialist C', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.05, '2026-01-30 01:01:00', '2026-01-30 10:04:09', 0, 0, 'COMPLETED', '09:01:02', '12:01:04', '12:01:18', '18:04:09'),
(131, 46, 'Ignacio C. Ortiz, Jr.', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-02-05 22:12:25', '2026-02-05 22:12:27', 0, 0, 'TIMED_IN', '06:12:25', NULL, NULL, NULL),
(132, 42, 'Leslie Neil T. Burgos', 'Science Research Specialist II', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 13.37, '2026-02-05 23:08:46', '2026-02-06 12:32:15', 0, 0, 'COMPLETED', '07:08:46', '12:15:27', '12:21:39', '20:32:15'),
(133, 11, 'Jyreen Joy M Peñaloga', 'Senior Geologist', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 11.28, '2026-02-05 23:11:49', '2026-02-06 10:29:51', 0, 0, 'COMPLETED', '07:11:49', '18:29:38', '18:29:45', '18:29:51'),
(134, 57, 'Rodeljan Nuke Free S. Dalian', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.50, '2026-02-05 23:16:17', '2026-02-06 08:47:09', 0, 0, 'COMPLETED', '07:16:17', '12:17:00', '12:40:29', '16:47:09'),
(135, 23, 'Neri Mar B. Paraguya', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.80, '2026-02-05 23:23:36', '2026-02-06 09:11:55', 0, 0, 'COMPLETED', '07:23:36', '12:09:51', '12:11:01', '17:11:55'),
(136, 19, 'Khlaire Abegail Ruperez', 'Planning Officer II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.68, '2026-02-05 23:24:41', '2026-02-06 09:07:22', 0, 0, 'COMPLETED', '07:24:41', '12:51:29', '12:52:54', '17:07:22'),
(137, 36, 'Faye Yeeda A. Espinosa', 'Science Research Specialist II', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 10.68, '2026-02-05 23:35:58', '2026-02-06 10:18:51', 0, 0, 'COMPLETED', '07:35:58', '12:51:55', '13:02:29', '18:18:51'),
(138, 39, 'Honey Rose B. Dayoc', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.75, '2026-02-05 23:37:39', '2026-02-06 09:23:13', 0, 0, 'COMPLETED', '07:37:39', '13:12:55', '13:13:06', '17:23:13'),
(139, 25, 'Lj Myah C. Dalisay', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.40, '2026-02-05 23:41:14', '2026-02-06 09:06:02', 0, 0, 'COMPLETED', '07:41:14', '12:24:21', '12:24:25', '17:06:02'),
(140, 59, 'Judy Ann C. Mejorada-Wenceslao', 'Mining Claims Examiner II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.67, '2026-02-05 23:41:43', '2026-02-06 09:22:49', 0, 0, 'COMPLETED', '07:41:43', '12:23:29', '12:24:23', '17:22:49'),
(141, 43, 'Leandrew Floyd', 'SRSII', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.33, '2026-02-05 23:43:59', '2026-02-06 09:04:21', 0, 0, 'COMPLETED', '07:43:59', '17:04:14', '17:04:18', '17:04:21'),
(142, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 11.67, '2026-02-05 23:46:10', '2026-02-06 11:27:12', 0, 0, 'COMPLETED', '07:46:10', '12:23:54', '12:23:59', '19:27:12'),
(143, 17, 'Jenny Rose S. Rojas', 'SRS II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.38, '2026-02-05 23:55:52', '2026-02-06 09:20:17', 0, 0, 'COMPLETED', '07:55:52', '16:13:33', '16:13:43', '17:20:17'),
(144, 24, 'Vincent', 'SRS I', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.95, '2026-02-06 00:24:33', '2026-02-06 11:23:28', 0, 0, 'COMPLETED', '08:24:33', '12:25:30', '12:26:20', '19:23:28'),
(145, 44, 'April Lepardo', 'IOII', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 8.87, '2026-02-06 00:35:55', '2026-02-06 09:28:52', 0, 0, 'COMPLETED', '08:35:55', '12:11:20', '12:11:41', '17:28:52'),
(146, 30, 'Edmark Joseph Acilo', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 3.55, '2026-02-06 01:01:09', '2026-02-06 04:35:11', 0, 0, 'TIMED_IN', '09:01:09', '12:34:38', '12:35:11', NULL),
(147, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 11.22, '2026-02-12 22:54:53', '2026-02-13 10:09:24', 0, 0, 'COMPLETED', '06:54:53', '12:15:32', '12:15:35', '18:09:24'),
(148, 57, 'Rodeljan Nuke Free S. Dalian', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.27, '2026-02-12 23:03:06', '2026-02-13 09:20:53', 0, 0, 'COMPLETED', '07:03:06', '13:38:01', '13:38:06', '17:20:53'),
(149, 32, 'Lovely Rose L. Balili', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.93, '2026-02-12 23:03:09', '2026-02-13 09:00:49', 0, 0, 'COMPLETED', '07:03:09', '12:05:50', '12:06:02', '17:00:49'),
(150, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.20, '2026-02-12 23:04:44', '2026-02-13 08:17:47', 0, 0, 'COMPLETED', '07:04:44', '12:11:28', '12:12:24', '16:17:47'),
(151, 19, 'Khlaire Abegail Ruperez', 'Planning Officer II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 4.67, '2026-02-12 23:22:54', '2026-02-13 04:38:22', 0, 0, 'TIMED_IN', '07:22:54', '12:02:59', '12:38:22', NULL),
(152, 24, 'Vincent', 'SRS I', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.27, '2026-02-12 23:28:50', '2026-02-13 09:45:47', 0, 0, 'COMPLETED', '07:28:50', '14:23:28', '14:23:37', '17:45:47'),
(153, 60, 'Brenice Ann Gendeve Castillo', 'Engineer V', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 10.30, '2026-02-12 23:30:38', '2026-02-13 09:50:01', 0, 0, 'COMPLETED', '07:30:42', '12:40:06', '12:40:40', '17:50:01'),
(154, 17, 'Jenny Rose S. Rojas', 'SRS II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.78, '2026-02-12 23:32:11', '2026-02-13 09:19:37', 0, 0, 'COMPLETED', '07:32:11', '12:22:32', '12:27:08', '17:19:37'),
(155, 42, 'Leslie Neil T. Burgos', 'Science Research Specialist II', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 10.35, '2026-02-12 23:44:02', '2026-02-13 10:06:01', 0, 0, 'COMPLETED', '07:44:02', '12:19:41', '12:26:36', '18:06:01'),
(156, 39, 'Honey Rose B. Dayoc', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.23, '2026-02-12 23:44:09', '2026-02-13 08:59:47', 0, 0, 'COMPLETED', '07:44:09', '12:24:08', '12:32:37', '16:59:47'),
(157, 12, 'Iris Kay L. Cortez', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 6.17, '2026-02-12 23:48:50', '2026-02-13 05:59:06', 0, 0, 'TIMED_IN', '07:48:50', '13:59:00', '13:59:06', NULL),
(158, 44, 'April Lepardo', 'IOII', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.20, '2026-02-12 23:52:31', '2026-02-13 10:05:53', 0, 0, 'COMPLETED', '07:52:31', '12:42:21', '12:42:29', '18:05:53'),
(159, 59, 'Judy Ann C. Mejorada-Wenceslao', 'Mining Claims Examiner II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 5.43, '2026-02-13 00:03:55', '2026-02-13 05:35:04', 0, 0, 'TIMED_IN', '08:03:55', '13:30:29', '13:35:04', NULL),
(160, 13, 'Jomari John N. Cleofe', 'Science Research Specialist II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.03, '2026-02-13 00:05:20', '2026-02-13 09:08:23', 0, 0, 'COMPLETED', '08:05:20', '12:01:07', '12:01:31', '17:08:23'),
(161, 43, 'Leandrew Floyd', 'SRSII', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.13, '2026-02-13 00:16:05', '2026-02-13 09:25:15', 0, 0, 'COMPLETED', '08:16:05', '12:17:46', '12:17:50', '17:25:15'),
(162, 33, 'Socorro Oquendo', 'Chief', 'Finance Administrative Division', NULL, NULL, NULL, NULL, NULL, 8.13, '2026-02-13 00:32:20', '2026-02-13 08:41:23', 0, 0, 'COMPLETED', '08:32:20', '13:03:36', '13:04:18', '16:41:23'),
(163, 61, 'Katyrhene B. Lacid', 'Engineer III', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.57, '2026-02-13 00:35:15', '2026-02-13 10:10:20', 0, 0, 'COMPLETED', '08:35:15', '12:58:53', '12:58:59', '18:10:20'),
(164, 40, 'Mai-lyn D. Reazonda', 'COMMUNITY AFFAIRS OFFICER II', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-02-13 00:37:44', '2026-02-13 00:37:47', 0, 0, 'TIMED_IN', '08:37:44', NULL, NULL, NULL),
(165, 30, 'Edmark Joseph Acilo', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 11.08, '2026-02-19 22:09:16', '2026-02-20 09:15:20', 0, 0, 'COMPLETED', '06:09:16', '12:51:57', '12:52:15', '17:15:20'),
(166, 57, 'Rodeljan Nuke Free S. Dalian', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.80, '2026-02-19 22:57:07', '2026-02-20 08:46:16', 0, 0, 'COMPLETED', '06:57:07', '13:07:20', '13:07:24', '16:46:16'),
(167, 62, 'Cordelia Ea', 'Admin Officer V', 'Finance Administrative Division', NULL, NULL, NULL, NULL, NULL, 11.37, '2026-02-19 23:01:32', '2026-02-20 10:24:31', 0, 0, 'COMPLETED', '07:01:32', '13:30:21', '13:30:34', '18:24:31'),
(168, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.22, '2026-02-19 23:02:41', '2026-02-20 08:17:28', 0, 0, 'COMPLETED', '07:02:41', '12:10:37', '12:10:41', '16:17:28'),
(169, 45, 'Lea Mae T. Oracion', 'Geologist II', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 10.78, '2026-02-19 23:09:40', '2026-02-20 09:57:54', 0, 0, 'COMPLETED', '07:09:40', '17:15:06', '17:15:10', '17:57:54'),
(170, 60, 'Brenice Ann Gendeve Castillo', 'Engineer V', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-02-19 23:15:14', '2026-02-19 23:15:15', 0, 0, 'TIMED_IN', '07:15:14', NULL, NULL, NULL),
(171, 63, 'Aisah Samson Ogatis', 'Accountant III', 'Finance Administrative Division', NULL, NULL, NULL, NULL, NULL, 10.27, '2026-02-19 23:17:45', '2026-02-20 09:34:39', 0, 0, 'COMPLETED', '07:17:45', '12:05:03', '12:08:46', '17:34:39'),
(172, 32, 'Lovely Rose L. Balili', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.60, '2026-02-19 23:22:07', '2026-02-20 08:58:56', 0, 0, 'COMPLETED', '07:22:07', '12:07:30', '12:07:37', '16:58:56'),
(173, 13, 'Jomari John N. Cleofe', 'Science Research Specialist II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 10.12, '2026-02-19 23:24:10', '2026-02-20 09:31:57', 0, 0, 'COMPLETED', '07:24:10', '14:18:16', '14:18:22', '17:31:57'),
(174, 42, 'Leslie Neil T. Burgos', 'Science Research Specialist II', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 11.03, '2026-02-19 23:30:59', '2026-02-20 10:34:40', 0, 0, 'COMPLETED', '07:30:59', '13:18:46', '14:01:34', '18:34:40'),
(175, 15, 'Christy Marie Anne I. Olaivar', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.90, '2026-02-19 23:32:39', '2026-02-20 09:26:57', 0, 0, 'COMPLETED', '07:32:39', '12:09:57', '12:11:57', '17:26:57'),
(176, 28, 'Kenneth Mark B. Nisnea', 'Science Research Specialist 1', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.82, '2026-02-19 23:44:52', '2026-02-20 09:34:48', 0, 0, 'COMPLETED', '07:44:52', '12:22:44', '12:23:43', '17:34:48'),
(177, 47, 'Lowell C. Chicote', 'Economist II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.32, '2026-02-19 23:47:43', '2026-02-20 09:08:15', 0, 0, 'COMPLETED', '07:47:43', '12:08:18', '12:08:25', '17:08:15'),
(178, 41, 'Maria Julia M. Modequillo', 'Science Research Specialist I', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.38, '2026-02-19 23:52:23', '2026-02-20 09:16:16', 0, 0, 'COMPLETED', '07:52:23', '12:18:46', '12:24:41', '17:16:16'),
(179, 33, 'Socorro Oquendo', 'Chief', 'Finance Administrative Division', NULL, NULL, NULL, NULL, NULL, 8.82, '2026-02-20 00:03:32', '2026-02-20 08:53:38', 0, 0, 'COMPLETED', '08:03:32', '12:38:14', '12:46:10', '16:53:38'),
(180, 26, 'Cris Ryann Nacua Ypil', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.23, '2026-02-20 00:03:36', '2026-02-20 09:18:37', 0, 0, 'COMPLETED', '08:03:36', '12:18:47', '12:20:05', '17:18:37'),
(181, 40, 'Mai-lyn D. Reazonda', 'COMMUNITY AFFAIRS OFFICER II', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 9.48, '2026-02-20 00:14:10', '2026-02-20 09:44:50', 0, 0, 'COMPLETED', '08:14:10', '12:21:55', '12:23:09', '17:44:50'),
(182, 59, 'Judy Ann C. Mejorada-Wenceslao', 'Mining Claims Examiner II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 11.73, '2026-02-20 00:15:22', '2026-02-20 12:00:03', 0, 0, 'COMPLETED', '08:15:22', '12:38:40', '12:45:44', '20:00:03'),
(183, 44, 'April Lepardo', 'IOII', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.53, '2026-02-20 00:23:03', '2026-02-20 09:55:26', 0, 0, 'COMPLETED', '08:23:03', '12:14:07', '12:14:20', '17:55:26'),
(184, 64, 'Oseas S. Macana', 'Engr3', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 10.20, '2026-02-20 00:34:44', '2026-02-20 12:46:15', 0, 0, 'TIMED_IN', '07:34:00', '12:46:00', '12:46:00', '17:46:00'),
(185, 18, 'Benedict Lejano', 'Sr. Science Research Specialist', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 12.57, '2026-02-26 22:56:14', '2026-02-27 11:31:59', 0, 0, 'COMPLETED', '06:56:14', '12:04:07', '12:05:49', '19:31:59'),
(186, 30, 'Edmark Joseph Acilo', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 11.05, '2026-02-26 22:57:17', '2026-02-27 10:01:16', 0, 0, 'COMPLETED', '06:57:17', '12:00:01', '12:01:43', '18:01:16'),
(187, 37, 'FRANCIS ANGELO G. PARAMI', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.70, '2026-02-26 23:01:23', '2026-02-27 08:44:34', 0, 0, 'COMPLETED', '07:01:23', '12:14:08', '12:18:01', '16:44:34'),
(188, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.18, '2026-02-26 23:03:33', '2026-02-27 08:15:33', 0, 0, 'COMPLETED', '07:03:33', '12:03:00', '12:04:02', '16:15:33'),
(189, 42, 'Leslie Neil T. Burgos', 'Science Research Specialist II', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 10.93, '2026-02-26 23:20:39', '2026-02-27 10:17:01', 0, 0, 'COMPLETED', '07:20:39', '12:15:48', '12:36:54', '18:17:01'),
(190, 24, 'Vincent', 'SRS I', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.90, '2026-02-26 23:22:36', '2026-02-27 09:17:34', 0, 0, 'COMPLETED', '07:22:36', '12:28:57', '12:31:41', '17:17:34'),
(191, 44, 'April Lepardo', 'IOII', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.05, '2026-02-26 23:31:14', '2026-02-27 09:34:29', 0, 0, 'COMPLETED', '07:31:14', '17:34:15', '17:34:22', '17:34:29'),
(192, 17, 'Jenny Rose S. Rojas', 'SRS II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 10.32, '2026-02-26 23:31:59', '2026-02-27 09:51:52', 0, 0, 'COMPLETED', '07:31:59', '12:14:44', '12:16:10', '17:51:52'),
(193, 23, 'Neri Mar B. Paraguya', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.67, '2026-02-26 23:31:59', '2026-02-27 09:12:32', 0, 0, 'COMPLETED', '07:31:59', '12:11:04', '12:21:27', '17:12:32'),
(194, 13, 'Jomari John N. Cleofe', 'Science Research Specialist II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.68, '2026-02-26 23:40:31', '2026-02-27 09:22:00', 0, 0, 'COMPLETED', '07:40:31', '14:47:44', '14:47:49', '17:22:00'),
(195, 47, 'Lowell C. Chicote', 'Economist II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.77, '2026-02-26 23:43:08', '2026-02-27 09:30:48', 0, 0, 'COMPLETED', '07:43:08', '12:16:56', '12:17:08', '17:30:48'),
(196, 57, 'Rodeljan Nuke Free S. Dalian', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.47, '2026-02-26 23:52:43', '2026-02-27 10:21:44', 0, 0, 'COMPLETED', '07:52:43', '12:18:52', '12:56:38', '18:21:44'),
(197, 39, 'Honey Rose B. Dayoc', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 10.12, '2026-02-26 23:52:48', '2026-02-27 10:00:45', 0, 0, 'COMPLETED', '07:52:48', '12:02:59', '12:04:45', '18:00:45'),
(198, 43, 'Leandrew Floyd', 'SRSII', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-02-27 00:02:32', '2026-02-27 00:02:33', 0, 0, 'TIMED_IN', '08:02:32', NULL, NULL, NULL),
(199, 28, 'Kenneth Mark B. Nisnea', 'Science Research Specialist 1', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 10.12, '2026-02-27 00:03:44', '2026-02-27 10:11:55', 0, 0, 'COMPLETED', '08:03:44', '12:04:39', '12:06:55', '18:11:55'),
(200, 12, 'Iris Kay L. Cortez', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.23, '2026-02-27 00:10:26', '2026-02-27 09:25:24', 0, 0, 'COMPLETED', '08:10:26', '12:21:01', '13:25:06', '17:25:24'),
(201, 49, 'Rheycalyn Lugtu', 'Senior Science Research Specialist', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 9.68, '2026-02-27 00:11:17', '2026-02-27 09:53:03', 0, 0, 'COMPLETED', '08:11:17', '12:33:35', '12:40:53', '17:53:03'),
(202, 26, 'Cris Ryann Nacua Ypil', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.30, '2026-02-27 00:15:12', '2026-02-27 09:34:20', 0, 0, 'COMPLETED', '08:15:12', '12:19:27', '12:22:41', '17:34:20'),
(203, 66, 'Richard U. Aquino', 'Engineer IV', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-02-27 00:16:15', '2026-02-27 00:16:16', 0, 0, 'TIMED_IN', '08:16:15', NULL, NULL, NULL),
(204, 60, 'Brenice Ann Gendeve Castillo', 'Engineer V', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 10.57, '2026-03-05 22:31:40', '2026-03-06 09:06:09', 0, 0, 'COMPLETED', '06:31:40', '17:05:58', '17:06:05', '17:06:09'),
(205, 57, 'Rodeljan Nuke Free S. Dalian', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 11.65, '2026-03-05 22:55:32', '2026-03-06 10:35:21', 0, 0, 'COMPLETED', '06:55:32', '12:24:41', '12:24:45', '18:35:21'),
(206, 61, 'Katyrhene B. Lacid', 'Engineer III', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.95, '2026-03-05 23:17:51', '2026-03-06 09:15:48', 0, 0, 'COMPLETED', '07:17:51', '13:03:21', '13:04:14', '17:15:48'),
(207, 41, 'Maria Julia M. Modequillo', 'Science Research Specialist I', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.15, '2026-03-05 23:22:39', '2026-03-06 08:32:37', 0, 0, 'COMPLETED', '07:22:39', '12:05:50', '12:07:07', '16:32:37'),
(208, 23, 'Neri Mar B. Paraguya', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.17, '2026-03-05 23:23:27', '2026-03-06 09:34:34', 0, 0, 'COMPLETED', '07:23:27', '12:10:54', '12:14:58', '17:34:34'),
(209, 24, 'Vincent', 'SRS I', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.55, '2026-03-05 23:33:55', '2026-03-06 09:07:12', 0, 0, 'COMPLETED', '07:33:55', '12:51:05', '12:51:24', '17:07:12'),
(210, 16, 'Adonis Angelo Cañon', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.25, '2026-03-05 23:45:11', '2026-03-06 09:00:59', 0, 0, 'COMPLETED', '07:45:11', '12:10:27', '12:31:51', '17:00:59'),
(211, 26, 'Cris Ryann Nacua Ypil', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.58, '2026-03-05 23:46:21', '2026-03-06 09:22:33', 0, 0, 'COMPLETED', '07:46:21', '12:58:14', '12:59:57', '17:22:33'),
(212, 19, 'Khlaire Abegail Ruperez', 'Planning Officer II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.47, '2026-03-05 23:50:52', '2026-03-06 09:19:47', 0, 0, 'TIMED_IN', '07:50:52', '17:19:46', NULL, NULL),
(213, 39, 'Honey Rose B. Dayoc', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.62, '2026-03-05 23:57:22', '2026-03-06 09:35:50', 0, 0, 'COMPLETED', '07:57:22', '12:46:53', '12:47:08', '17:35:50'),
(214, 28, 'Kenneth Mark B. Nisnea', 'Science Research Specialist 1', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 4.28, '2026-03-05 23:58:49', '2026-03-06 07:24:12', 0, 0, 'TIMED_IN', '07:58:49', '12:16:39', '15:24:12', NULL),
(215, 18, 'Benedict Lejano', 'Sr. Science Research Specialist', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 10.10, '2026-03-06 00:14:57', '2026-03-06 10:22:18', 0, 0, 'COMPLETED', '08:14:57', '12:22:26', '12:23:08', '18:22:18'),
(216, 30, 'Edmark Joseph Acilo', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.75, '2026-03-06 00:34:39', '2026-03-06 11:20:52', 0, 0, 'COMPLETED', '08:34:39', '12:08:25', '12:08:54', '19:20:52'),
(217, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.52, '2026-03-06 00:52:04', '2026-03-06 10:23:46', 0, 0, 'COMPLETED', '08:52:04', '12:17:32', '12:17:37', '18:23:46'),
(218, 45, 'Lea Mae T. Oracion', 'Geologist II', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-03-06 04:05:53', '2026-03-06 04:06:08', 0, 0, 'TIMED_IN', '12:05:53', '12:06:01', '12:06:08', NULL),
(219, 15, 'Christy Marie Anne I. Olaivar', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 4.97, '2026-03-06 04:16:41', '2026-03-06 09:15:31', 0, 0, 'COMPLETED', '12:16:41', '12:16:44', '12:16:48', '17:15:31'),
(220, 21, 'Ian Gabriel G. De Vera', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 4.45, '2026-03-06 04:18:53', '2026-03-06 08:46:10', 0, 0, 'COMPLETED', '12:18:53', '12:18:55', '12:18:57', '16:46:10'),
(221, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-03-09 05:06:34', '2026-03-09 05:06:47', 0, 0, 'COMPLETED', '13:06:34', '13:06:40', '13:06:44', '13:06:47'),
(222, 30, 'Edmark Joseph Acilo', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.48, '2026-03-12 22:32:02', '2026-03-13 09:02:00', 0, 0, 'COMPLETED', '06:32:02', '12:38:37', '12:38:42', '17:02:00'),
(223, 36, 'Faye Yeeda A. Espinosa', 'Science Research Specialist II', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 11.27, '2026-03-12 22:44:58', '2026-03-13 10:02:32', 0, 0, 'COMPLETED', '06:44:58', '12:04:34', '12:23:54', '18:02:32'),
(224, 62, 'Cordelia Ea', 'Admin Officer V', 'Finance Administrative Division', NULL, NULL, NULL, NULL, NULL, 11.83, '2026-03-12 22:47:44', '2026-03-13 10:38:48', 0, 0, 'COMPLETED', '06:47:44', '18:38:30', '18:38:40', '18:38:48'),
(225, 60, 'Brenice Ann Gendeve Castillo', 'Engineer V', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 10.57, '2026-03-12 23:00:47', '2026-03-13 09:35:56', 0, 0, 'COMPLETED', '07:00:47', '12:04:19', '12:06:01', '17:35:56'),
(226, 21, 'Ian Gabriel G. De Vera', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.07, '2026-03-12 23:04:44', '2026-03-13 08:10:01', 0, 0, 'COMPLETED', '07:04:44', '12:09:22', '12:10:14', '16:10:01'),
(227, 23, 'Neri Mar B. Paraguya', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.95, '2026-03-12 23:06:43', '2026-03-13 09:04:10', 0, 0, 'COMPLETED', '07:06:43', '12:00:59', '12:04:27', '17:04:10'),
(228, 29, 'Mizraim G. Melchor Jr.', 'Geologist II', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 10.88, '2026-03-12 23:06:44', '2026-03-13 10:00:11', 0, 0, 'COMPLETED', '07:06:44', '12:23:46', '12:23:51', '18:00:11'),
(229, 16, 'Adonis Angelo Cañon', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.88, '2026-03-12 23:09:48', '2026-03-13 09:04:34', 0, 0, 'COMPLETED', '07:09:48', '12:05:46', '12:08:17', '17:04:34'),
(230, 67, 'angel mae Cabaylo', 'Supervising Science Research Specialist', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 9.67, '2026-03-12 23:11:35', '2026-03-13 08:51:51', 0, 0, 'COMPLETED', '07:11:35', '12:21:45', '12:21:51', '16:51:51'),
(231, 19, 'Khlaire Abegail Ruperez', 'Planning Officer II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.87, '2026-03-12 23:13:32', '2026-03-13 09:06:44', 0, 0, 'COMPLETED', '07:13:32', '12:08:49', '12:11:37', '17:06:44'),
(232, 14, 'Mia Marcelle Descalsota Salo', 'GIS Specialist C', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.80, '2026-03-12 23:14:48', '2026-03-13 09:03:40', 0, 0, 'COMPLETED', '07:14:48', '12:10:23', '12:11:54', '17:03:40'),
(233, 37, 'FRANCIS ANGELO G. PARAMI', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.72, '2026-03-12 23:15:55', '2026-03-13 09:00:18', 0, 0, 'COMPLETED', '07:15:55', '12:30:49', '12:33:44', '17:00:18'),
(234, 32, 'Lovely Rose L. Balili', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 10.00, '2026-03-12 23:17:14', '2026-03-13 09:18:15', 0, 0, 'COMPLETED', '07:17:14', '12:03:11', '12:03:31', '17:18:15'),
(235, 38, 'Kirk Justin Tizon', 'SEMS', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 9.52, '2026-03-12 23:17:54', '2026-03-13 08:50:12', 0, 0, 'COMPLETED', '07:17:54', '12:16:42', '12:16:45', '16:50:12'),
(236, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 8.92, '2026-03-12 23:20:13', '2026-03-13 08:15:47', 0, 0, 'COMPLETED', '07:20:13', '12:54:37', '12:55:01', '16:15:47'),
(237, 63, 'Aisah Samson Ogatis', 'Accountant III', 'Finance Administrative Division', NULL, NULL, NULL, NULL, NULL, 9.77, '2026-03-12 23:20:39', '2026-03-13 09:07:37', 0, 0, 'COMPLETED', '07:20:39', '12:04:15', '12:25:37', '17:07:37'),
(238, 57, 'Rodeljan Nuke Free S. Dalian', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.55, '2026-03-12 23:25:40', '2026-03-13 08:59:34', 0, 0, 'COMPLETED', '07:25:40', '16:59:24', '16:59:30', '16:59:34'),
(239, 42, 'Leslie Neil T. Burgos', 'Science Research Specialist II', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 11.22, '2026-03-12 23:28:55', '2026-03-13 10:43:10', 0, 0, 'COMPLETED', '07:28:55', '12:31:47', '12:34:37', '18:43:10'),
(240, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.25, '2026-03-12 23:37:02', '2026-03-13 08:53:04', 0, 0, 'COMPLETED', '07:37:02', '12:03:32', '12:03:35', '16:53:04'),
(241, 12, 'Iris Kay L. Cortez', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 5.92, '2026-03-12 23:37:20', '2026-03-13 05:33:23', 0, 0, 'TIMED_IN', '07:37:24', '13:33:18', '13:33:23', NULL),
(242, 13, 'Jomari John N. Cleofe', 'Science Research Specialist II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.58, '2026-03-12 23:37:41', '2026-03-13 09:13:41', 0, 0, 'COMPLETED', '07:37:41', '12:20:00', '12:20:08', '17:13:41'),
(243, 46, 'Ignacio C. Ortiz, Jr.', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.12, '2026-03-12 23:38:04', '2026-03-13 08:45:47', 0, 0, 'COMPLETED', '07:38:04', '16:19:44', '16:19:56', '16:45:47'),
(244, 68, 'Bruce Santillan', 'Sr. SRS', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 9.25, '2026-03-12 23:38:26', '2026-03-13 08:53:50', 0, 0, 'COMPLETED', '07:38:26', '16:53:34', '16:53:47', '16:53:50'),
(245, 44, 'April Lepardo', 'IOII', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.83, '2026-03-12 23:41:28', '2026-03-13 09:32:25', 0, 0, 'COMPLETED', '07:41:28', '12:18:28', '12:18:34', '17:32:25'),
(246, 69, 'Danilo V. Rodriguez', 'Chief MSESDD', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 9.42, '2026-03-12 23:43:16', '2026-03-13 09:08:41', 0, 0, 'COMPLETED', '07:43:16', '12:17:38', '12:20:25', '17:08:41'),
(247, 26, 'Cris Ryann Nacua Ypil', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.97, '2026-03-12 23:45:26', '2026-03-13 09:44:05', 0, 0, 'COMPLETED', '07:45:26', '12:59:39', '13:00:45', '17:44:05'),
(248, 47, 'Lowell C. Chicote', 'Economist II', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 9.58, '2026-03-12 23:49:21', '2026-03-13 09:25:21', 0, 0, 'COMPLETED', '07:49:21', '12:13:07', '12:15:27', '17:25:21'),
(249, 64, 'Oseas S. Macana', 'Engr3', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-03-12 23:52:22', '2026-03-12 23:52:23', 0, 0, 'TIMED_IN', '07:52:22', NULL, NULL, NULL);
INSERT INTO `time_records` (`id`, `user_id`, `full_name`, `position`, `division`, `target`, `accomplishment`, `time_in`, `time_out`, `notes`, `total_hours`, `created_at`, `updated_at`, `has_timed_in_today`, `timed_in_flag`, `status`, `morning_time_in`, `morning_time_out`, `afternoon_time_in`, `afternoon_time_out`) VALUES
(250, 61, 'Katyrhene B. Lacid', 'Engineer III', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 10.57, '2026-03-12 23:57:43', '2026-03-13 10:33:08', 0, 0, 'COMPLETED', '07:57:43', '12:56:15', '12:57:04', '18:33:07'),
(251, 66, 'Richard U. Aquino', 'Engineer IV', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 0.00, '2026-03-13 00:04:17', '2026-03-13 00:04:17', 0, 0, 'TIMED_IN', '08:04:17', NULL, NULL, NULL),
(252, 49, 'Rheycalyn Lugtu', 'Senior Science Research Specialist', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, NULL, NULL, 10.10, '2026-03-13 00:06:41', '2026-03-13 10:13:36', 0, 0, 'TIMED_IN', '08:06:41', '18:13:35', NULL, NULL),
(253, 43, 'Leandrew Floyd', 'SRSII', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.40, '2026-03-13 00:09:15', '2026-03-13 09:34:18', 0, 0, 'COMPLETED', '08:09:15', '13:18:24', '13:18:30', '17:34:18'),
(254, 24, 'Vincent', 'SRS I', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 9.48, '2026-03-13 00:14:35', '2026-03-13 09:44:40', 0, 0, 'COMPLETED', '08:14:35', '12:18:22', '12:22:30', '17:44:40'),
(255, 58, 'VILLANUEVA, RONALD P.', 'Engineer III', 'Mine Management Division', NULL, NULL, NULL, NULL, NULL, 4.28, '2026-03-13 00:22:07', '2026-03-13 04:43:53', 0, 0, 'TIMED_IN', '08:22:07', '12:40:02', '12:43:53', NULL),
(256, 30, 'Edmark Joseph Acilo', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, NULL, NULL, 6.47, '2026-03-19 22:19:48', '2026-03-20 04:49:27', 0, 0, 'TIMED_IN', '06:19:48', '12:48:29', '12:49:27', NULL),
(257, 62, 'Cordelia Ea', 'Admin Officer V', 'Finance Administrative Division', NULL, NULL, NULL, NULL, NULL, 13.13, '2026-03-19 23:46:10', '2026-03-20 12:55:08', 0, 0, 'COMPLETED', '07:46:10', '20:54:42', '20:55:00', '20:55:08'),
(258, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', 'attend meting test\r\nattend Gmall\r\ncharr lang', 'Gmall only', NULL, NULL, NULL, 0.00, '2026-03-23 08:57:17', '2026-03-23 08:58:13', 0, 0, 'COMPLETED', '16:57:17', '16:57:50', '16:57:55', '16:58:13'),
(259, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', 'Test', 'None', NULL, NULL, 'None notes 1', 0.00, '2026-03-24 07:13:55', '2026-03-24 07:14:42', 0, 0, 'COMPLETED', '15:13:55', '15:14:16', '15:14:31', '15:14:42'),
(260, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', 'Attend meetings', NULL, NULL, NULL, 'Attend meeting and char', 8.02, '2026-03-25 23:43:46', '2026-03-26 07:44:59', 0, 0, 'TIMED_IN', '07:43:46', '15:44:55', '15:44:59', NULL),
(261, 29, 'Mizraim G. Melchor Jr.', 'Geologist II', 'Geoscience Division', 'Gss new calape', 'GSS of New Calape ES', NULL, NULL, NULL, 11.42, '2026-03-26 22:37:07', '2026-03-27 10:02:51', 0, 0, 'COMPLETED', '06:37:07', '12:05:31', '12:05:41', '18:02:51'),
(262, 46, 'Ignacio C. Ortiz, Jr.', 'Science Research Specialist I', 'Geoscience Division', 'Geohazard Certificates', 'GHCs', NULL, NULL, NULL, 9.58, '2026-03-26 22:58:51', '2026-03-27 08:34:58', 0, 0, 'COMPLETED', '06:58:51', '12:14:34', '12:52:23', '16:34:58'),
(263, 21, 'Ian Gabriel G. De Vera', 'Science Research Specialist I', 'Geoscience Division', 'GSS report draft, and Geohazard Certifications.', 'GSSR First Draft for document no. 2026-02-0399', NULL, NULL, NULL, 9.10, '2026-03-26 23:00:52', '2026-03-27 08:07:14', 0, 0, 'COMPLETED', '07:00:52', '12:01:59', '12:02:08', '16:07:14'),
(264, 11, 'Jyreen Joy M Peñaloga', 'Senior Geologist', 'Geoscience Division', 'GSS report writing', NULL, NULL, NULL, NULL, 5.18, '2026-03-26 23:01:29', '2026-03-27 04:12:51', 0, 0, 'TIMED_IN', '07:01:29', '12:12:48', '12:12:51', NULL),
(265, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', 'Consolidation of Reports and Data of NGP and BPP', 'Prepared the communications to the mining companies regarding the validated NGP and BPP reports and consolidating the bpp and ngp validation reports', NULL, NULL, 'Prepared the communications to the mining companies regarding the validated NGP and BPP reports', 9.02, '2026-03-26 23:02:07', '2026-03-27 08:03:50', 0, 0, 'COMPLETED', '07:02:08', '12:18:30', '12:19:33', '16:03:50'),
(266, 16, 'Adonis Angelo Cañon', 'Science Research Specialist II', 'Office of the Regional Director', 'Make a Letter regarding the result of Tenement Monitoring of AALMC.', 'Memo and Letter to the Company', NULL, NULL, NULL, 10.05, '2026-03-26 23:03:56', '2026-03-27 09:07:58', 0, 0, 'COMPLETED', '07:03:56', '12:06:30', '12:07:03', '17:07:58'),
(267, 70, 'Capter John Tubo', 'Supervising Geologist', 'Geoscience Division', '1. Review of geohazard certificates and technical reports.\r\n2. Supervise the GHEGS section.', '1. Review of GCs\r\n2. Attended GHEGS webinar', NULL, NULL, 'First use of the portal 😅\r\n1. Review of GCs.', 10.25, '2026-03-26 23:04:28', '2026-03-27 09:20:10', 0, 0, 'COMPLETED', '07:04:28', '12:11:55', '12:12:17', '17:20:10'),
(268, 15, 'Christy Marie Anne I. Olaivar', 'Science Research Specialist I', 'Geosciences Division', '- Update Karst Inventory Database\r\n- Arrange files for liquidation\r\n- Draft technical report on karst subsidence hazard assessment', '- Uploaded my part on the Karst Inventory Excel and KML File\r\n- Draft technical Report', NULL, NULL, NULL, 10.27, '2026-03-26 23:05:04', '2026-03-27 09:22:05', 0, 0, 'COMPLETED', '07:05:04', '12:03:33', '12:20:05', '17:22:05'),
(269, 24, 'Vincent', 'SRS I', 'Office of the Regional Director', 'Update the geohazard map based on the recent geohazard assessment that I conducted.', 'indicate data into the attribute of my shapefile that I delineated from my recent Geohazard assessment', NULL, NULL, NULL, 10.35, '2026-03-26 23:06:02', '2026-03-27 09:28:39', 0, 0, 'COMPLETED', '07:06:02', '12:03:41', '12:04:42', '17:28:39'),
(270, 23, 'Neri Mar B. Paraguya', 'Science Research Specialist II', 'Office of the Regional Director', 'To accomplish the geological reports of Suaon and Tibyun Cave.\r\n\r\nOther tasks to be assigned by supervisor/s.', 'Accomplished the geological reports on Sauaon Cave and Tibyun Cave', NULL, NULL, NULL, 10.07, '2026-03-26 23:06:18', '2026-03-27 09:11:19', 0, 0, 'COMPLETED', '07:06:18', '12:15:13', '12:16:43', '17:11:19'),
(271, 62, 'Cordelia Ea', 'Admin Officer V', 'Finance Administrative Division', 'Prepare the documents needed for the oath taking of two promoted personnel Macana and Lacid. ARA for Palen.', NULL, NULL, NULL, NULL, 0.00, '2026-03-26 23:11:21', '2026-03-26 23:11:21', 0, 0, 'TIMED_IN', '07:11:21', NULL, NULL, NULL),
(272, 71, 'Allen Mark Abanilla', 'Senior Geologists', 'Geoscience Division', 'Eggar review of Havens dew', 'Eggar review', NULL, NULL, NULL, 10.33, '2026-03-26 23:15:45', '2026-03-27 09:37:00', 0, 0, 'COMPLETED', '07:15:45', '13:05:26', '13:05:29', '17:37:00'),
(273, 57, 'Rodeljan Nuke Free S. Dalian', 'Science Research Specialist II', 'Office of the Regional Director', 'Prepare ppt presentation on RA 7942 & 7076 for IEC', 'Ppt presentation (50%completed)', NULL, NULL, NULL, 10.32, '2026-03-26 23:16:36', '2026-03-27 09:36:21', 0, 0, 'COMPLETED', '07:16:36', '12:08:17', '12:11:58', '17:36:21'),
(274, 61, 'Katyrhene B. Lacid', 'Engineer III', 'Mine Management Division', '1. Occupation Fee\r\n2. PPMP CY2026 and CY2027\r\n3. ARTA Report', NULL, NULL, NULL, NULL, 0.00, '2026-03-26 23:18:10', '2026-03-26 23:18:10', 0, 0, 'TIMED_IN', '07:18:10', NULL, NULL, NULL),
(275, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', 'Update website, edit the google sheet, prepare data for irise audit', 'Update website under mineral statistics and edit google sheet', NULL, NULL, NULL, 9.70, '2026-03-26 23:19:32', '2026-03-27 09:02:30', 0, 0, 'COMPLETED', '07:19:32', '12:15:33', '12:15:38', '17:02:30'),
(276, 19, 'Khlaire Abegail Ruperez', 'Planning Officer II', 'Office of the Regional Director', 'Finalize Proposed WFP FY 2027\r\nConsolidate Proposed PPMP FY 2027\r\nReview 2nd Semester FY 2026 DPCRs', 'Finalized PPMP FY 2027\r\nSubmitted initial WFP FY 2027 and TTP FY 2027', NULL, NULL, NULL, 11.05, '2026-03-26 23:22:40', '2026-03-27 10:26:49', 0, 0, 'COMPLETED', '07:22:40', '12:04:35', '12:28:45', '18:26:49'),
(277, 47, 'Lowell C. Chicote', 'Economist II', 'Mine Management Division', 'Updating Database in the MMD Google Drive', NULL, NULL, NULL, NULL, 4.63, '2026-03-26 23:34:20', '2026-03-27 04:13:07', 0, 0, 'TIMED_IN', '07:34:20', '12:13:06', NULL, NULL),
(278, 63, 'Aisah Samson Ogatis', 'Accountant III', 'Finance Administrative Division', '1. Encoding of collection and payroll for March 2026 in eNGAS\r\n2. Draft follow up letter to DPWH for the breakdown of the JEV between MGB & EMB Building expansion.', 'Recording of Journal Entry Vouchers in eNGAS for the following transactions:\r\n\r\n- Cash Collections \r\n    (March 13-25, 2026)\r\n- March payroll\r\n- Salary differential payroll\r\nDraft follow up letter to DPWH for the breakdown of the JEV between MGB & EMB Building expansion.\r\nVerify and approve loan application.\r\nReview General Journal and Disbursement Journals for March 2026', NULL, NULL, NULL, 9.55, '2026-03-26 23:38:42', '2026-03-27 09:12:44', 0, 0, 'COMPLETED', '07:38:42', '12:21:32', '12:24:11', '17:12:44'),
(279, 44, 'April Lepardo', 'IOII', 'Office of the Regional Director', 'GAD frame\r\ngAD video\r\nfb post\r\nWebsite Post\r\nmineral Infographics', 'Posted Earth Hour in the FB Page\r\nContinued working on Infographic Due on April Accomplishment \r\nmade Video for Women in Mining Awardees', NULL, NULL, NULL, 9.93, '2026-03-26 23:48:01', '2026-03-27 09:44:48', 0, 0, 'COMPLETED', '07:48:01', '12:56:12', '12:56:28', '17:44:48'),
(280, 69, 'Danilo V. Rodriguez', 'Chief MSESDD', 'Mine Safety Environment and Social Development Division', 'Supervise employees of the Division on their work tasks', 'Just waited for concerns of employees.', NULL, NULL, NULL, 9.23, '2026-03-26 23:49:46', '2026-03-27 09:04:29', 0, 0, 'COMPLETED', '07:49:46', '12:40:51', '12:45:15', '17:04:29'),
(281, 36, 'Faye Yeeda A. Espinosa', 'Science Research Specialist II', 'Mine Safety Environment and Social Development Division', '1. Finalize the SHES Monitoring Report for Hallmark Mining Corporation under MPSA No. 196-2008-XI as reviewed by the DC\r\n2. Finalize the SHES Monitoring Report for AMCI 234-XI', '1. Finalized the SHES Monitoring Report for Hallmark Mining Corporation under MPSA No. 196-2008-XI as reviewed by the DC, for printing on Monday, March 30, 2026\r\n2. Finalizing the SHES Monitoring Report for AMCI 234-XI', NULL, NULL, NULL, 9.35, '2026-03-26 23:54:07', '2026-03-27 09:16:44', 0, 0, 'COMPLETED', '07:54:07', '12:27:05', '12:32:43', '17:16:44'),
(282, 42, 'Leslie Neil T. Burgos', 'Science Research Specialist II', 'Geoscience Division', 'Script for monday’s events host GAD. Continue drafting monkayo assessment', 'Script for GAD program. Report monkayo', NULL, NULL, NULL, 12.23, '2026-03-27 01:26:16', '2026-03-27 13:41:48', 0, 0, 'COMPLETED', '09:26:16', '12:58:53', '12:59:13', '21:41:48'),
(283, 26, 'Cris Ryann Nacua Ypil', 'Engineer II', 'Mine Management Division', '1. Review the result of CY 2025 MGBCO-MTMD Tenement Audit\r\n2. Draft Letter-response to GMC\'s request for postponement of Tenement Monitoring\r\n3. Draft Letter to Hallmark re: April 14-17, 2026 Research Fieldwork', 'All stated in the targets, with additional:\r\n\r\n1. Participated in MMD Divisional Meeting\r\n2. Prepared Travel Plan for 2nd Quarter', NULL, NULL, NULL, 9.27, '2026-03-27 01:36:46', '2026-03-27 10:54:18', 0, 0, 'COMPLETED', '09:36:46', '12:48:21', '12:49:04', '18:54:18'),
(284, 72, 'Ryan C. Fernandez', 'Cmt II', 'Office of the Regional Director', 'Meeting with zoom', 'Zoom Meeting - Done', NULL, NULL, NULL, 0.00, '2026-03-31 08:25:21', '2026-03-31 08:26:08', 0, 0, 'COMPLETED', '16:25:21', '16:25:29', '16:25:37', '16:26:08'),
(285, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', 'Consolidation of BPP Submitted and Validation Reports for 1st Quarter to 4th Quarter 2025', 'Prepared the AALMC and HMC\'s BPP Consolidated Data', NULL, NULL, 'Prepared the AALMC and HMC\'s BPP Consolidated Data', 9.70, '2026-04-09 22:34:30', '2026-04-10 08:17:02', 0, 0, 'COMPLETED', '06:34:31', '12:11:00', '12:12:21', '16:17:02'),
(286, 15, 'Christy Marie Anne I. Olaivar', 'Science Research Specialist I', 'Geosciences Division', 'DPWH Geohazards Certificate', '80% of the DPWH Geohazard Certification', NULL, NULL, NULL, 10.15, '2026-04-09 22:44:11', '2026-04-10 08:54:05', 0, 0, 'COMPLETED', '06:44:11', '12:04:17', '12:07:05', '16:54:05'),
(287, 57, 'Rodeljan Nuke Free S. Dalian', 'Science Research Specialist II', 'Office of the Regional Director', 'Activity report on meeting conducted regarding alleged illegal small-scale mining in Brgy Calapagan', 'Activity report', NULL, NULL, NULL, 13.93, '2026-04-09 23:15:08', '2026-04-10 13:12:06', 0, 0, 'COMPLETED', '07:15:08', '12:46:15', '12:48:41', '21:12:06'),
(288, 37, 'FRANCIS ANGELO G. PARAMI', 'Science Research Specialist II', 'Office of the Regional Director', 'Diat Small-Scale Miner’s Cooperative Report', 'Initial Draft of Diat SSM report', NULL, NULL, NULL, 9.50, '2026-04-09 23:15:20', '2026-04-10 08:46:21', 0, 0, 'COMPLETED', '07:15:20', '12:25:18', '12:27:40', '16:46:21'),
(289, 42, 'Leslie Neil T. Burgos', 'Science Research Specialist II', 'Geoscience Division', 'Landslide inventory (Davao City)', NULL, NULL, NULL, NULL, 4.90, '2026-04-09 23:16:02', '2026-04-10 04:24:19', 0, 0, 'TIMED_IN', '07:16:02', '12:10:25', '12:24:19', NULL),
(290, 58, 'VILLANUEVA, RONALD P.', 'Engineer III', 'Mine Management Division', 'Attend Meeting Re: MOSS for CY 2025, Investigation on Austral-Asia Link Mining Corporation, Draft Letter to NIA concerning Manorigao Quarrying Activities affecting NIA Structures, Finalize Letter to National Agencies concerning MOSS for CY 2025', NULL, NULL, NULL, NULL, 0.00, '2026-04-09 23:18:35', '2026-04-09 23:18:36', 0, 0, 'TIMED_IN', '07:18:35', NULL, NULL, NULL),
(291, 36, 'Faye Yeeda A. Espinosa', 'Science Research Specialist II', 'Mine Safety Environment and Social Development Division', '1. Attend the online coordination meeting with MGB XI RD, MMD and MSESDD Technical Personnel on the Scheduled Joint and Multi Agency Investigation on AALMC and HMC in Davao Oriental on April 13-17, 2026\r\n2. Draft verification report on Hexat Mining Company\'s MFP and MWT', '1. Attended the online meeting with RD, together with the MMD and MSESDD technical Personnel on the following matters:\r\nA. DENR CO Multisectoral investigation in AALMC and HMC on Apr 13-17, 2026\r\nB. Mobile One Stop Shop (MOSS) on-going preparation for its holding in Mati City, Davao Oriental on May 27-28, 2026\r\n\r\n2. Real Time monitoring project of MGB XI and SDS scheduled next week in AALMC and HMC on Apr 13-17, 2026\r\n\r\n3. Changes in field work schedules on the conduct of Annual SHES Monitorings to  give way to the scheduled abovementioned activities\r\n\r\n4. Establishment of the linking of database between MMD and MSESDD\r\n\r\n5. Attendance and participation of EMs and Geos to MAEM Symposium CY 2026 on April 28-30, 2026\r\n\r\nOthers:\r\n1. Provision of necessary data possibly will be required by the DENR Multisectoral Investigating Team including MFP, MWT, NGP, and BPP', NULL, NULL, NULL, 10.28, '2026-04-09 23:20:10', '2026-04-10 09:38:03', 0, 0, 'COMPLETED', '07:20:10', '12:34:20', '12:35:22', '17:38:03'),
(292, 17, 'Jenny Rose S. Rojas', 'SRS II', 'Mine Management Division', 'Divisional Meeting thru Zoom for the following agenda: 1. MOSS; 2  Hallmark  investigation; 3 TQGT ; 4 Research of Real time  ; and  5. Database link of MMD and MSESDD', 'Zoom Meeting regarding the following: 1 MOSS Updates; HMC Investigations; 3 Research and Monitoring; 4 And other matters', NULL, NULL, NULL, 10.70, '2026-04-09 23:20:32', '2026-04-10 10:03:52', 0, 0, 'COMPLETED', '07:20:32', '12:13:01', '12:16:46', '18:03:52'),
(293, 70, 'Capter John Tubo', 'Supervising Geologist', 'Geoscience Division', 'Review of GSS/GVR/EGGAR', 'Reviewed EGGAR of LMTO and JJMP, GC of JJMP, Reply letter and GVR of LMTO.', NULL, NULL, NULL, 9.82, '2026-04-09 23:23:39', '2026-04-10 09:13:43', 0, 0, 'COMPLETED', '07:23:39', '12:08:14', '12:08:24', '17:13:43'),
(294, 29, 'Mizraim G. Melchor Jr.', 'Geologist II', 'Geoscience Division', 'Ground truthing report of manp uggp', 'Ground truthing report', NULL, NULL, NULL, 9.62, '2026-04-09 23:23:49', '2026-04-10 09:01:45', 0, 0, 'COMPLETED', '07:23:49', '12:30:17', '12:30:23', '17:01:45'),
(295, 30, 'Edmark Joseph Acilo', 'Science Research Specialist II', 'Office of the Regional Director', 'Shipment Monitoring/ Meeting with MMD', NULL, NULL, NULL, NULL, 4.70, '2026-04-09 23:28:30', '2026-04-10 04:11:32', 0, 0, 'TIMED_IN', '07:28:30', '12:10:42', '12:11:32', NULL),
(296, 60, 'Brenice Ann Gendeve Castillo', 'Engineer V', 'Mine Management Division', 'meeting with MSESDD and Rd re the following  1. MOSS; 2  Hallmark  investigation; 3 TQGT ; 4 Research of Real time  ; and ung 5. Database link of MMD and MSESDD, which shall start at 9:am onwards', 'done with  all the meeting and continuous reciew of the hallmark presentation', NULL, NULL, NULL, 9.98, '2026-04-09 23:29:02', '2026-04-10 09:29:20', 0, 0, 'COMPLETED', '07:29:02', '13:47:42', '13:47:49', '17:29:20'),
(297, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', 'Edit online TO', 'Still editing code travel order', NULL, NULL, NULL, 9.85, '2026-04-09 23:30:50', '2026-04-10 09:23:25', 0, 0, 'COMPLETED', '07:30:50', '12:01:42', '12:02:06', '17:23:25'),
(298, 14, 'Mia Marcelle Descalsota Salo', 'GIS Specialist C', 'Geoscience Division', 'Draft of Geohazard Certification', 'Geohazard certification (TN No. 2026-04-0067) with corresponding map sent to JJMP via email.', NULL, NULL, NULL, 9.48, '2026-04-09 23:31:52', '2026-04-10 09:02:14', 0, 0, 'COMPLETED', '07:31:52', '12:01:38', '12:02:13', '17:02:14'),
(299, 46, 'Ignacio C. Ortiz, Jr.', 'Science Research Specialist I', 'Geoscience Division', 'Geohazard Certificates', 'GHCs', NULL, NULL, NULL, 9.62, '2026-04-09 23:32:24', '2026-04-10 09:10:19', 0, 0, 'COMPLETED', '07:32:24', '12:59:11', '12:59:20', '17:10:19'),
(300, 63, 'Aisah Samson Ogatis', 'Accountant III', 'Finance Administrative Division', '1. FS - 3Q\r\n2. FAR 5 - 3Q\r\n3. Payroll for April', '1. Review and submit FAR 5 (Quarterly Report of Revenue and Other Receipts) to MGB Central Office. \r\n2. Finalize Financial statements as of 1st quarter 2026, and submit to MGB Central Office and to COA.\r\n3. Review Payroll for April 2026.', NULL, NULL, NULL, 10.50, '2026-04-09 23:33:13', '2026-04-10 10:03:37', 0, 0, 'COMPLETED', '07:33:13', '12:09:19', '12:10:26', '18:03:37'),
(301, 38, 'Kirk Justin Tizon', 'SEMS', 'Mine Safety Environment and Social Development Division', '1. CSW Briefer Presentation for DENR Multisectoral Team\r\n2. SHES Checklist Finalization', '1. Attended zoom meeting with RD in preparation for DENR Multi-Sectroral Investigation in Austral-Asia Link and Hallmark Mining Corporation\r\n\r\n2. Drafted briefer presentation to the DENR Multisectoral Team', NULL, NULL, NULL, 9.07, '2026-04-09 23:35:10', '2026-04-10 08:40:58', 0, 0, 'COMPLETED', '07:35:10', '13:50:08', '13:50:13', '16:40:58'),
(302, 19, 'Khlaire Abegail Ruperez', 'Planning Officer II', 'Office of the Regional Director', 'ERPMES Submission', 'Draft Form 1 & 2 RPMES', NULL, NULL, NULL, 9.52, '2026-04-09 23:35:22', '2026-04-10 09:07:09', 0, 0, 'COMPLETED', '07:35:22', '12:09:01', '12:24:16', '17:07:09'),
(303, 65, 'Fedelis S. Echavez', 'Supervising Science Research Specialist', 'Mine Safety Environment and Social Development Division', 'Finalize RSHI and SHES Reports', '- Attended online meeting with RD, MMD, and MSESDD\r\n- Finalized SHES and RSHI reports', NULL, NULL, NULL, 10.38, '2026-04-09 23:36:04', '2026-04-10 09:59:51', 0, 0, 'COMPLETED', '07:36:04', '12:27:50', '12:28:18', '17:59:51'),
(304, 73, 'Angel Mae Cabaylo', 'Supervising Science Research Specialist', 'Mine Safety Environment and Social Development Division', 'online meeting with mmd and msesdd.\r\nfinalization og kmc shes report', 'a. meeting with rd, msesdd and mmd for the following topics:\r\n1. hallmark/austral denr CO investigation on april 13-17.\r\n2. MOSS\r\n3. MMD/MSESDD Database and TSHES monitoring schedule.\r\nb. division meeting for the upcoming schedules and assignments.\r\nc. Finalization of SHES report\r\nd. CEMCRR evaluation report for AMCI', NULL, NULL, NULL, 9.45, '2026-04-09 23:39:21', '2026-04-10 09:07:51', 0, 0, 'COMPLETED', '07:39:21', '15:35:16', '15:35:20', '17:07:51'),
(305, 68, 'Bruce Santillan', 'Sr. SRS', 'Mine Safety Environment and Social Development Division', 'Database update', '.', NULL, NULL, 'Zoom meeting w/ mmd', 9.97, '2026-04-09 23:39:23', '2026-04-10 09:37:54', 0, 0, 'COMPLETED', '07:39:23', '12:42:39', '12:42:42', '17:37:54'),
(306, 62, 'Cordelia Ea', 'Admin Officer V', 'Finance Administrative Division', 'training design for the three traings: personnel mngt, records mngt and leadership trainings', NULL, NULL, NULL, NULL, 4.48, '2026-04-09 23:39:38', '2026-04-10 04:09:38', 0, 0, 'TIMED_IN', '07:39:38', '12:09:22', '12:09:38', NULL),
(307, 20, 'Marie Anne Garcia', 'GIS Specialist C', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.08, '2026-04-09 23:44:40', '2026-04-10 08:50:49', 0, 0, 'COMPLETED', '07:44:40', '12:51:34', '12:53:09', '16:50:49'),
(308, 74, 'Shiely Dilangalen', 'Administrative Officer III', 'Finance Administrative Division', 'Uploading & checking of ISO OTPs\r\nManage Google Drive Files\r\nCheck Official email', 'Updated OTP submission monitoring \r\nChecked emails', NULL, NULL, NULL, 9.33, '2026-04-09 23:44:56', '2026-04-10 09:05:40', 0, 0, 'COMPLETED', '07:44:56', '12:36:11', '12:36:31', '17:05:40'),
(309, 41, 'Maria Julia M. Modequillo', 'Science Research Specialist I', 'Office of the Regional Director', '-Attend divisional meeting of the MMD\r\n-Consolidate & organize information for validation report re Joseph Saucejo\'s request for extension of EP', '-Attended the meeting of MMD and MSESDD with RD\r\n-Updated the database for the MOSS activity', NULL, NULL, NULL, 9.27, '2026-04-09 23:45:37', '2026-04-10 09:02:30', 0, 0, 'COMPLETED', '07:45:37', '12:26:51', '12:27:57', '17:02:30'),
(310, 11, 'Jyreen Joy M Peñaloga', 'Senior Geologist', 'Geoscience Division', 'Technical report writing: Finish groundwater resource assessment of Carmen report', '1. Technical report Writing on Groundwater Resource Assessment Report of Carmen\r\n2. EGGAR review of JOJI Ilagan Expansion Project\r\n3. Reviewed Geohazard Certification of the proposed projects at Sunbeam Christian School of Mati,', NULL, NULL, '1. Technical report Writing on Groundwater Resource Assessment Report of Carmen\r\n2. EGGAR review of JOJI Ilagan Expansion Project\r\n3. Reviewed Geohazard Certification of the proposed projects at Sunbeam Christian School of Mati,', 9.03, '2026-04-09 23:48:01', '2026-04-10 08:50:34', 0, 0, 'COMPLETED', '07:48:01', '14:11:20', '14:11:25', '16:50:34'),
(311, 26, 'Cris Ryann Nacua Ypil', 'Engineer II', 'Mine Management Division', '1. MMD-MSESDD Meeting; 2. Finish pending Tenement Monitoring Reports', '1. MMD-MSESDD Meeting\r\n2. Powerpoint for Hallmark Investigation', NULL, NULL, NULL, 10.68, '2026-04-09 23:50:24', '2026-04-10 10:33:00', 0, 0, 'COMPLETED', '07:50:24', '12:30:18', '12:32:41', '18:33:00'),
(312, 66, 'Richard U. Aquino', 'Engineer IV', 'Mine Management Division', 'Virtual meetings with MMD and MSESDD, re: MOSS Updates, TQGT Issues and concerns', NULL, NULL, NULL, NULL, 13.73, '2026-04-09 23:50:24', '2026-04-10 13:35:09', 0, 0, 'TIMED_IN', '07:50:24', '21:35:09', NULL, NULL),
(313, 64, 'Oseas S. Macana', 'Engr3', 'Mine Management Division', '755', NULL, NULL, NULL, NULL, 0.00, '2026-04-09 23:55:17', '2026-04-09 23:55:18', 0, 0, 'TIMED_IN', '07:55:17', NULL, NULL, NULL),
(314, 47, 'Lowell C. Chicote', 'Economist II', 'Mine Management Division', 'Initial Checklist - MPP Hexat Mining Corp.\r\nEncoding available data for the Quarterly SRS Report', 'Initial Checklist - MPP of Hexat, Encoded, Davao City Production for the 1st Q SRS Report and Updated the Economic Contribution of Austral and Hallmark', NULL, NULL, 'Updating Economic Contribution Austral - Hallmark', 9.25, '2026-04-09 23:55:21', '2026-04-10 09:11:19', 0, 0, 'COMPLETED', '07:55:21', '12:34:18', '12:34:24', '17:11:19'),
(315, 39, 'Honey Rose B. Dayoc', 'Engineer II', 'Mine Management Division', 'MMD Meeting re Updates on the Upcoming MOSS', 'Layer files for the generation of HMC and AALMC Land Use Map', NULL, NULL, NULL, 9.27, '2026-04-09 23:55:52', '2026-04-10 09:13:21', 0, 0, 'COMPLETED', '07:55:52', '12:50:23', '12:51:09', '17:13:21'),
(316, 33, 'Socorro Oquendo', 'Chief', 'Finance Administrative Division', 'Meeting re MOSS; review of docs/work processes', 'Review/ replied emails of Arch Bermejo re RGC Bldg proposal adjustments; Review of FAD deliverables', NULL, NULL, NULL, 9.27, '2026-04-10 00:08:06', '2026-04-10 09:24:58', 0, 0, 'COMPLETED', '08:08:06', '17:22:54', '17:23:09', '17:24:58'),
(317, 21, 'Ian Gabriel G. De Vera', 'Science Research Specialist I', 'Geoscience Division', 'GHC', 'GHC and preparation of references for technical report', NULL, NULL, NULL, 9.05, '2026-04-10 00:09:02', '2026-04-10 09:12:54', 0, 0, 'COMPLETED', '08:09:02', '12:18:31', '12:19:01', '17:12:54'),
(318, 45, 'Lea Mae T. Oracion', 'Geologist II', 'Geoscience Division', 'EGGAR Review\r\nReply Letter', '1. GVR and EGGAR Review - submitted to OIC-Chief for review/comments.\r\n2. Drafted reply letter - submitted to supervisor for review/comments.', NULL, NULL, NULL, 9.23, '2026-04-10 00:10:40', '2026-04-10 09:26:29', 0, 0, 'COMPLETED', '08:10:40', '16:02:34', '16:02:42', '17:26:29'),
(319, 44, 'April Lepardo', 'IOII', 'Office of the Regional Director', '1.Monitor Facebook for Mining concerns in Davao Region\r\n2. Create Public Material for FB and Website Posting\r\n3. Continue working on Infographic 5 mining companies, 5 provinces', '1. Attended meeting for April 14-15 service on wheels.\r\n2. Uploaded feature article at FB page\r\n3. Public Material for 5 Provinces Mineral Profile', NULL, NULL, NULL, 9.18, '2026-04-10 00:22:45', '2026-04-10 09:34:33', 0, 0, 'COMPLETED', '08:22:45', '17:31:02', '17:31:07', '17:34:33'),
(320, 12, 'Iris Kay L. Cortez', 'Engineer II', 'Mine Management Division', 'Meeting with MOSS', 'Done with alk the meetings', NULL, NULL, NULL, 9.07, '2026-04-10 00:25:32', '2026-04-10 09:30:12', 0, 0, 'COMPLETED', '08:25:32', '17:29:38', '17:29:50', '17:30:12'),
(321, 69, 'Danilo V. Rodriguez', 'Chief MSESDD', 'Mine Safety Environment and Social Development Division', 'Meeting with MMD and RD on MOSS and other mining topics', 'meeting on line...supervisory advises and instructions to employees', NULL, NULL, 'Continue monitoring on preparation for next week activities', 9.28, '2026-04-10 00:26:17', '2026-04-10 09:44:34', 0, 0, 'COMPLETED', '08:26:17', '12:39:35', '12:42:03', '17:44:34'),
(322, 61, 'Katyrhene B. Lacid', 'Engineer III', 'Mine Management Division', 'meeting', 'database for validation fees paid by aalmc and hmc, provided geospatial dataset of aalmc, hmc and PAs, on-going generation of aalm, hmc, mhrws and pujada seascape map', NULL, NULL, NULL, 9.50, '2026-04-10 00:36:01', '2026-04-10 10:07:21', 0, 0, 'COMPLETED', '08:36:01', '13:09:43', '13:10:00', '18:07:21'),
(323, 49, 'Rheycalyn Lugtu', 'Senior Science Research Specialist', 'Mine Safety Environment and Social Development Division', 'SDMP Database', 'SDMP Database', NULL, NULL, NULL, 9.57, '2026-04-10 00:58:27', '2026-04-10 10:32:57', 0, 0, 'COMPLETED', '08:58:27', '12:17:35', '12:39:28', '18:32:57'),
(324, 18, 'Benedict Lejano', 'Sr. Science Research Specialist', 'Mine Safety Environment and Social Development Division', 'Forgot to time-in.', 'Drafted letter notices for SHES Monitoring and RSHI.', NULL, NULL, NULL, 9.15, '2026-04-10 01:11:27', '2026-04-10 10:20:37', 0, 0, 'COMPLETED', '09:11:27', '12:04:27', '12:05:19', '18:20:37'),
(325, 43, 'Leandrew Floyd', 'SRSII', 'Office of the Regional Director', 'Attend meeting for TWG for desilting operations', NULL, NULL, NULL, NULL, 0.00, '2026-04-10 01:22:07', '2026-04-10 01:22:08', 0, 0, 'TIMED_IN', '09:22:07', NULL, NULL, NULL),
(326, 12, 'Iris Kay L. Cortez', 'Engineer II', 'Mine Management Division', 'Meeting ISO and Meeting with MOSS', 'iso & moss meeting', NULL, NULL, NULL, 13.90, '2026-04-16 20:23:07', '2026-04-17 10:18:06', 0, 0, 'COMPLETED', '04:23:07', '12:08:19', '12:08:23', '18:18:06'),
(327, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', 'Validation Report for Apex Mining Corporation Inc. for 1st Quarter  of 2026 NGP and BPP', 'Started the Validation Report for the NGP and BPP of AMCI for 1st Q 2026', NULL, NULL, NULL, 9.93, '2026-04-16 22:19:13', '2026-04-17 08:16:03', 0, 0, 'COMPLETED', '06:19:13', '12:58:03', '12:58:08', '16:16:03'),
(328, 62, 'Cordelia Ea', 'Admin Officer V', 'Finance Administrative Division', 'Start assessment of applications-', 'Assessment of ADAS1 and 3 applications', NULL, NULL, 'Application assessment for ADAS1 and ADAS3', 11.82, '2026-04-16 22:31:20', '2026-04-17 10:20:58', 0, 0, 'COMPLETED', '06:31:20', '12:08:24', '12:09:01', '18:20:58'),
(329, 46, 'Ignacio C. Ortiz, Jr.', 'Science Research Specialist I', 'Geoscience Division', '*Geohazard certificates\r\n*ISO meeting (5\'s)', 'GHCs and ISO (5s) meeting done', NULL, NULL, NULL, 10.70, '2026-04-16 22:34:07', '2026-04-17 09:17:38', 0, 0, 'COMPLETED', '06:34:07', '15:31:01', '15:31:10', '17:17:38'),
(330, 30, 'Edmark Joseph Acilo', 'Science Research Specialist II', 'Office of the Regional Director', 'RSGA REPORT', 'Draft Report RSGA, ONGOING', NULL, NULL, NULL, 11.65, '2026-04-16 22:37:45', '2026-04-17 10:18:10', 0, 0, 'COMPLETED', '06:37:45', '12:33:21', '12:33:27', '18:18:10'),
(331, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', 'Enhance code', 'Still fixing and enhance the code', NULL, NULL, NULL, 10.33, '2026-04-16 22:42:03', '2026-04-17 09:03:15', 0, 0, 'COMPLETED', '06:42:03', '12:11:46', '12:11:53', '17:03:15'),
(332, 74, 'Shiely Dilangalen', 'Administrative Officer III', 'Finance Administrative Division', 'Email management, ISO docs monitoring, ISO meeting (internal audit & document controller)', 'Email management, attended ISO meetings, ISO Documents submission monitoring', NULL, NULL, NULL, 10.23, '2026-04-16 22:46:09', '2026-04-17 09:00:35', 0, 0, 'COMPLETED', '06:46:09', '12:54:09', '12:54:14', '17:00:35'),
(333, 29, 'Mizraim G. Melchor Jr.', 'Geologist II', 'Geoscience Division', 'draft geologic map of tugbok quadrangle', 'Draft map of tugbok quadrangle', NULL, NULL, NULL, 9.22, '2026-04-16 22:57:06', '2026-04-17 08:10:37', 0, 0, 'COMPLETED', '06:57:06', '12:11:17', '12:11:39', '16:10:37'),
(334, 21, 'Ian Gabriel G. De Vera', 'Science Research Specialist I', 'Geoscience Division', 'GHC', 'GHC', NULL, NULL, NULL, 9.38, '2026-04-16 23:02:36', '2026-04-17 08:26:14', 0, 0, 'COMPLETED', '07:02:36', '12:01:04', '12:03:38', '16:26:14'),
(335, 17, 'Jenny Rose S. Rojas', 'SRS II', 'Mine Management Division', 'Evaluation of Three Year Development Work Program covering CYs 2025-2027 of Austral Asia Link Mining Coporation.', 'Evaluation of Three Year Development Work Program covering CYs 2025-2027 of Austral Asia Link Mining Coporation.Forwarded to CRY and OSM for review', NULL, NULL, NULL, 10.37, '2026-04-16 23:03:03', '2026-04-17 09:25:54', 0, 0, 'COMPLETED', '07:03:03', '12:11:29', '12:17:08', '17:25:54'),
(336, 18, 'Benedict Lejano', 'Sr. Science Research Specialist', 'Mine Safety Environment and Social Development Division', 'ISO Meetings', '1. Attended 3 ISO Meetings.\r\n2. Prepared MSESDD Monthly Accomplishment Report for April.', NULL, NULL, NULL, 10.47, '2026-04-16 23:03:15', '2026-04-17 09:31:56', 0, 0, 'COMPLETED', '07:03:15', '12:04:49', '12:05:53', '17:31:56'),
(337, 20, 'Marie Anne Garcia', 'GIS Specialist C', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.17, '2026-04-16 23:05:11', '2026-04-17 08:16:10', 0, 0, 'COMPLETED', '07:05:11', '12:46:07', '12:47:03', '16:16:10'),
(338, 70, 'Capter John Tubo', 'Supervising Geologist', 'Geoscience Division', 'ISO meeting', 'ISO meeting', NULL, NULL, NULL, 10.97, '2026-04-16 23:05:41', '2026-04-17 10:03:59', 0, 0, 'COMPLETED', '07:05:41', '12:17:44', '12:17:52', '18:03:59'),
(339, 61, 'Katyrhene B. Lacid', 'Engineer III', 'Mine Management Division', 'Collate data for monthly accomplishment report', 'GE DEPUTATION database, ISO document controllers meeting via zoom', NULL, NULL, NULL, 10.18, '2026-04-16 23:11:36', '2026-04-17 09:23:51', 0, 0, 'COMPLETED', '07:11:36', '12:18:17', '12:41:24', '17:23:51'),
(340, 36, 'Faye Yeeda A. Espinosa', 'Science Research Specialist II', 'Mine Safety Environment and Social Development Division', '1. Attend online meeting for ISO Committee (Document Controller)\r\n2. Review relevant documents for MSESDD\'s ISO document control\r\n3. Draft CoA for GMC\'s EPEP/FMRDP', '1. Attended the online ISO Committee Meeting (Document Controller) via Zoom\r\n2. Finalized draft of SHES Monitoring Report for AMCI 234-2007-XI\r\n3. Reviewed ISO documents for MSESDD', NULL, NULL, NULL, 10.75, '2026-04-16 23:12:44', '2026-04-17 09:59:26', 0, 0, 'COMPLETED', '07:12:44', '12:39:35', '12:40:11', '17:59:26'),
(341, 60, 'Brenice Ann Gendeve Castillo', 'Engineer V', 'Mine Management Division', 'meeting ISO and MOSS with certain technical personnel of MMD', 'all meetings attended', NULL, NULL, NULL, 11.23, '2026-04-16 23:13:10', '2026-04-17 10:28:24', 0, 0, 'COMPLETED', '07:13:10', '18:28:06', '18:28:10', '18:28:24'),
(342, 54, 'MUSTANSIR V. MANJOORSA', 'Supervising Geologist', 'Geoscience Division', 'Attend exit conference with the DCPO on the Calinan Quad mapping updating recently accomplished last April 10, 2026.', 'Exit conference with DC Offices re Updating of Calinan Quad Mapping and RSGA review and discussion with Engr. EJ Acilo on his validation report.', NULL, NULL, NULL, 9.90, '2026-04-16 23:16:21', '2026-04-17 09:11:33', 0, 0, 'COMPLETED', '07:16:21', '12:47:57', '12:48:11', '17:11:33'),
(343, 32, 'Lovely Rose L. Balili', 'Science Research Specialist II', 'Office of the Regional Director', 'Prepare Checklist for Hexat Mining Corporation re 2026 Tenement Compliance Monitoring CY 2025', 'Tenement Monitoring Checklist for Hexat Mining Corporation CY 2025 (Partial)', NULL, NULL, NULL, 9.75, '2026-04-16 23:18:13', '2026-04-17 09:05:02', 0, 0, 'COMPLETED', '07:18:13', '12:05:04', '12:06:01', '17:05:02'),
(344, 41, 'Maria Julia M. Modequillo', 'Science Research Specialist I', 'Office of the Regional Director', '- Draft validation report re: request for extension of Mr. Joseph Saucejo\'s EP', '-Drafted validation report re: Joseph Saucejo\'s request for the extension of his EP', NULL, NULL, NULL, 9.08, '2026-04-16 23:22:27', '2026-04-17 08:28:36', 0, 0, 'COMPLETED', '07:22:27', '12:02:38', '12:11:18', '16:28:36'),
(345, 11, 'Jyreen Joy M Peñaloga', 'Senior Geologist', 'Geoscience Division', '1. ISO meeting at 8am to 10 pm\r\n2. Prepare presentation for GD ISO  meeting on Monday', NULL, NULL, NULL, NULL, 0.00, '2026-04-16 23:23:21', '2026-04-16 23:23:21', 0, 0, 'TIMED_IN', '07:23:21', NULL, NULL, NULL),
(346, 42, 'Leslie Neil T. Burgos', 'Science Research Specialist II', 'Geoscience Division', 'Geohazard certificate', 'Practiced for radio guesting. Made draft gc', NULL, NULL, NULL, 10.38, '2026-04-16 23:30:16', '2026-04-17 09:54:24', 0, 0, 'COMPLETED', '07:30:16', '12:21:02', '12:28:36', '17:54:24'),
(347, 13, 'Jomari John N. Cleofe', 'Science Research Specialist II', 'Mine Management Division', 'Updating of databases', 'Updating of database', NULL, NULL, NULL, 9.55, '2026-04-16 23:30:38', '2026-04-17 09:04:09', 0, 0, 'COMPLETED', '07:30:38', '12:14:05', '12:14:09', '17:04:09'),
(348, 39, 'Honey Rose B. Dayoc', 'Engineer II', 'Mine Management Division', 'Participate in the Documented Information Controller Committee Meeting', 'Partipated in the ISO Documented Information Controller Committee Meeting; Finalized the google sheet of MMD OTPs', NULL, NULL, NULL, 9.98, '2026-04-16 23:30:42', '2026-04-17 09:31:28', 0, 0, 'COMPLETED', '07:30:42', '12:02:35', '13:08:16', '17:31:28'),
(349, 33, 'Socorro Oquendo', 'Chief', 'Finance Administrative Division', 'Check communcations, emails and review docs ( updated/revised rgc proposal/plan) and comm for dpwh', 'Done', NULL, NULL, NULL, 9.03, '2026-04-16 23:35:06', '2026-04-17 08:38:43', 0, 0, 'COMPLETED', '07:35:06', '13:16:50', '13:17:57', '16:38:43'),
(350, 19, 'Khlaire Abegail Ruperez', 'Planning Officer II', 'Office of the Regional Director', 'ISO Committee Meetings', 'ISO Meetings', NULL, NULL, NULL, 9.68, '2026-04-16 23:36:16', '2026-04-17 09:17:49', 0, 0, 'COMPLETED', '07:36:16', '12:25:37', '12:28:16', '17:17:49'),
(351, 14, 'Mia Marcelle Descalsota Salo', 'GIS Specialist C', 'Geoscience Division', 'Parts of UGGP Report', 'Parts of UGGP report on proposed geosites', NULL, NULL, NULL, 10.48, '2026-04-16 23:36:38', '2026-04-17 10:06:32', 0, 0, 'COMPLETED', '07:36:38', '13:17:52', '13:17:57', '18:06:32'),
(352, 43, 'Leandrew Floyd', 'SRSII', 'Office of the Regional Director', 'Attend CMRB', 'CMRB meeting', NULL, NULL, NULL, 10.45, '2026-04-16 23:38:06', '2026-04-17 10:06:01', 0, 0, 'COMPLETED', '07:38:06', '13:08:37', '13:08:39', '18:06:01'),
(353, 68, 'Bruce Santillan', 'Sr. SRS', 'Mine Safety Environment and Social Development Division', 'Iqa meeting', 'Evaluation of request', NULL, NULL, NULL, 9.47, '2026-04-16 23:38:55', '2026-04-17 09:08:12', 0, 0, 'COMPLETED', '07:38:55', '12:00:47', '12:00:52', '17:08:12'),
(354, 65, 'Fedelis S. Echavez', 'Supervising Science Research Specialist', 'Mine Safety Environment and Social Development Division', '- ISO online meeting\r\n- Draft RSHI report', '- Attended online ISO meeting\r\n- Drafted RSHI report', NULL, NULL, NULL, 9.62, '2026-04-16 23:44:54', '2026-04-17 09:23:27', 0, 0, 'COMPLETED', '07:44:54', '12:08:47', '12:10:00', '17:23:27'),
(355, 69, 'Danilo V. Rodriguez', 'Chief MSESDD', 'Mine Safety Environment and Social Development Division', 'Attend/Supervise Division Personnel on their tasks and/or concerns for the day... Attend on line meeting as set by Management', 'Monitored concerns and issues raised by Division personnel', NULL, NULL, 'Continue monitoring division activities', 9.18, '2026-04-16 23:47:19', '2026-04-17 08:59:11', 0, 0, 'COMPLETED', '07:47:19', '13:01:44', '13:03:16', '16:59:11'),
(356, 49, 'Rheycalyn Lugtu', 'Senior Science Research Specialist', 'Mine Safety Environment and Social Development Division', 'Finalize KMC SHES Monitoring Report for SDS and attend ISO Meeting for Customer Service Satisfaction', 'ISO MEETING, KMC SHES REPORT', NULL, NULL, NULL, 11.93, '2026-04-16 23:53:32', '2026-04-17 11:50:35', 0, 0, 'COMPLETED', '07:53:32', '12:25:45', '12:27:14', '19:50:35'),
(357, 25, 'Lj Myah C. Dalisay', 'Science Research Specialist I', 'Geoscience Division', 'Create Geohazard Certifications, Join the exit conference for Calinan Quadrangle Mapping Activity with Davao City LGU', 'Exit Conference for the Calinan Quadrangle Mapping Activity done in Davao City', NULL, NULL, NULL, 9.13, '2026-04-16 23:54:34', '2026-04-17 09:02:40', 0, 0, 'COMPLETED', '07:54:34', '12:03:39', '12:05:02', '17:02:40'),
(358, 47, 'Lowell C. Chicote', 'Economist II', 'Mine Management Division', '1st Quarter SRS Report', 'Encoded data in the 1st Q SRS Report and posting available data in the MEIPD Teams', NULL, NULL, NULL, 9.20, '2026-04-17 00:01:20', '2026-04-17 09:14:17', 0, 0, 'COMPLETED', '08:01:20', '12:02:05', '12:17:17', '17:14:17'),
(359, 58, 'VILLANUEVA, RONALD P.', 'Engineer III', 'Mine Management Division', 'ISO Meeting and MOSS Documentation', NULL, NULL, NULL, NULL, 6.35, '2026-04-17 00:09:06', '2026-04-17 06:30:34', 0, 0, 'TIMED_IN', '08:09:06', '14:30:24', '14:30:34', NULL),
(360, 44, 'April Lepardo', 'IOII', 'Office of the Regional Director', '1. Finish Infographics for 5 Provinces\r\n2. monitor Fb and Website for Mining concerns in Davao region\r\n3. Attend Meeting fo ISO', '1. Attended ISO meeting\r\n2. posted website\r\n3. Drafter public Material for May posting\r\n4. Finished 2 provinces infographics', NULL, NULL, NULL, 9.35, '2026-04-17 00:09:38', '2026-04-17 09:31:50', 0, 0, 'COMPLETED', '08:09:38', '12:04:31', '12:04:40', '17:31:50'),
(361, 66, 'Richard U. Aquino', 'Engineer IV', 'Mine Management Division', 'ISO IAT and CMRB Meeting', NULL, NULL, NULL, NULL, 0.00, '2026-04-17 00:51:42', '2026-04-17 00:51:42', 0, 0, 'TIMED_IN', '08:51:42', NULL, NULL, NULL),
(362, 28, 'Kenneth Mark B. Nisnea', 'Science Research Specialist 1', 'Geoscience Division', 'Geologic Quadrangle Mapping of Calinan Quadrangle Exit Conference With City Planning and Development Office (9am-12pm)', '1. Exit Conference Meeting for Quadrangle Mapping with CPDO (9am-12pm)\r\n2. Geohazard Certificate of DPWH (Ongoing)', NULL, NULL, NULL, 6.40, '2026-04-17 03:46:56', '2026-04-17 10:11:44', 0, 0, 'COMPLETED', '11:46:56', '12:22:28', '12:23:21', '18:11:44'),
(363, 54, 'MUSTANSIR V. MANJOORSA', 'Supervising Geologist', 'Geoscience Division', 'Review reports and activity design for the next quad mapping schedule', 'RSGA Report reviewed, Activity Design for quad mapping reviewed, Tugbok Quad Mapping report reviewed.', NULL, NULL, NULL, 10.15, '2026-04-23 22:36:02', '2026-04-24 08:45:46', 0, 0, 'COMPLETED', '06:36:02', '12:48:36', '12:48:44', '16:45:46'),
(364, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', 'Create system for RNR and enhance code TO', 'Enhance code RNR', NULL, NULL, NULL, 10.38, '2026-04-23 22:37:55', '2026-04-24 09:01:56', 0, 0, 'COMPLETED', '06:37:55', '12:14:57', '12:15:02', '17:01:56'),
(365, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', 'Continuing the Validation Report for AMCI’s NGP and BPP 1st Quarter of 2026', 'Continuation of the Validation Report for AMCI’s NGP and BPP 1st Q 2026', NULL, NULL, NULL, 9.67, '2026-04-23 22:45:03', '2026-04-24 08:25:29', 0, 0, 'COMPLETED', '06:45:03', '12:02:22', '12:03:04', '16:25:29'),
(366, 29, 'Mizraim G. Melchor Jr.', 'Geologist II', 'Geoscience Division', 'Tugbok quadrangle mapping report draft', 'submitted tugbok quadrangle geological mapping report draft to MVM', NULL, NULL, NULL, 9.42, '2026-04-23 22:58:19', '2026-04-24 08:24:13', 0, 0, 'COMPLETED', '06:58:19', '12:00:06', '12:00:09', '16:24:13'),
(367, 14, 'Mia Marcelle Descalsota Salo', 'GIS Specialist C', 'Geoscience Division', 'Ancillary maps for the UGGp report', '-Parts of Tugbok Quadrangle \r\n-Topographic Map of MANP', NULL, NULL, NULL, 9.97, '2026-04-23 23:00:29', '2026-04-24 08:59:48', 0, 0, 'COMPLETED', '07:00:29', '12:01:19', '12:01:22', '16:59:48'),
(368, 57, 'Rodeljan Nuke Free S. Dalian', 'Science Research Specialist II', 'Office of the Regional Director', 'Prepare RSGA Validation report', 'Draft rsga report', NULL, NULL, NULL, 9.17, '2026-04-23 23:03:57', '2026-04-24 08:14:35', 0, 0, 'COMPLETED', '07:03:57', '12:36:29', '12:39:17', '16:14:35'),
(369, 42, 'Leslie Neil T. Burgos', 'Science Research Specialist II', 'Geoscience Division', 'Landslide inventory', 'Landslide inventory', NULL, NULL, NULL, 11.40, '2026-04-23 23:04:37', '2026-04-24 10:28:47', 0, 0, 'COMPLETED', '07:04:37', '12:17:47', '12:23:24', '18:28:47'),
(370, 70, 'Capter John Tubo', 'Supervising Geologist', 'Geoscience Division', 'Review of reports', 'Review of report', NULL, NULL, NULL, 9.78, '2026-04-23 23:06:20', '2026-04-24 08:54:56', 0, 0, 'COMPLETED', '07:06:20', '12:06:13', '12:06:20', '16:54:56'),
(371, 21, 'Ian Gabriel G. De Vera', 'Science Research Specialist I', 'Geoscience Division', 'Technical Report Draft', 'Technical report draft', NULL, NULL, NULL, 9.18, '2026-04-23 23:08:31', '2026-04-24 08:20:38', 0, 0, 'COMPLETED', '07:08:31', '12:52:00', '12:52:02', '16:20:38'),
(372, 33, 'Socorro Oquendo', 'Chief', 'Finance Administrative Division', 'Moss coordination with Penro Oriental', 'Puro meeting', NULL, NULL, 'Occupied wt phone calls wt penro oriental re moss concerns and attending FGD wt msesdd', 9.67, '2026-04-23 23:12:59', '2026-04-24 08:53:42', 0, 0, 'COMPLETED', '07:12:59', '14:29:02', '14:29:07', '16:53:42'),
(373, 46, 'Ignacio C. Ortiz, Jr.', 'Science Research Specialist I', 'Geoscience Division', 'GhCs', 'GhCs', NULL, NULL, NULL, 9.80, '2026-04-23 23:14:54', '2026-04-24 09:03:54', 0, 0, 'COMPLETED', '07:14:54', '13:11:08', '13:11:15', '17:03:54'),
(374, 24, 'Vincent', 'SRS I', 'Office of the Regional Director', 'Sdmp evaluation of hallmark', 'Draft sdmp evaluation of hallmark', NULL, NULL, NULL, 10.38, '2026-04-23 23:20:59', '2026-04-24 09:45:40', 0, 0, 'COMPLETED', '07:20:59', '12:03:44', '12:22:49', '17:45:40'),
(375, 19, 'Khlaire Abegail Ruperez', 'Planning Officer II', 'Office of the Regional Director', 'RMSMEDC XI Meeting', 'Online meeting', NULL, NULL, NULL, 10.48, '2026-04-23 23:21:39', '2026-04-24 09:51:48', 0, 0, 'COMPLETED', '07:21:39', '12:05:24', '12:21:12', '17:51:48'),
(376, 11, 'Jyreen Joy M Peñaloga', 'Senior Geologist', 'Geoscience Division', '1. EGGAR review on Gaisano Sto Tomas\r\n2. Process Geochem data for the proposed Andap-Manurigao MRA assay results\r\n3. Generate Anomaly Maps for the proposed Andap-Manurigao MRA', 'EGGAR Review\r\nAnomaly maps', NULL, NULL, NULL, 10.63, '2026-04-23 23:23:46', '2026-04-24 10:02:27', 0, 0, 'COMPLETED', '07:23:46', '12:09:13', '12:09:22', '18:02:27'),
(377, 60, 'Brenice Ann Gendeve Castillo', 'Engineer V', 'Mine Management Division', 'review MOSS', 'Moss review of activities - done', NULL, NULL, NULL, 10.42, '2026-04-23 23:26:08', '2026-04-24 09:51:42', 0, 0, 'COMPLETED', '07:26:08', '14:40:16', '17:51:19', '17:51:42'),
(378, 28, 'Kenneth Mark B. Nisnea', 'Science Research Specialist 1', 'Geoscience Division', 'DPWH GEOHAZARD CERTIFICATE', 'DPWH GEOHAZARD CERTIFICATE', NULL, NULL, NULL, 9.98, '2026-04-23 23:27:31', '2026-04-24 09:27:28', 0, 0, 'COMPLETED', '07:27:31', '13:24:46', '13:24:51', '17:27:28'),
(379, 74, 'Shiely Dilangalen', 'Administrative Officer III', 'Finance Administrative Division', 'Email management \r\nUploading and checking of ISO OTPs\r\nOrganize files in GDrive \r\nUpdate RnR process manual', 'Email management \r\nUploaded Scanned ISO files in Drive', NULL, NULL, NULL, 9.93, '2026-04-23 23:29:00', '2026-04-24 09:26:05', 0, 0, 'COMPLETED', '07:29:00', '14:09:54', '14:09:58', '17:26:05'),
(380, 20, 'Marie Anne Garcia', 'GIS Specialist C', 'Geoscience Division', NULL, NULL, NULL, NULL, NULL, 9.55, '2026-04-23 23:29:58', '2026-04-24 09:03:34', 0, 0, 'COMPLETED', '07:29:58', '12:51:13', '12:52:07', '17:03:34'),
(381, 62, 'Cordelia Ea', 'Admin Officer V', 'Finance Administrative Division', 'Assess adas1 aplications', 'assessment adas1 applications', NULL, NULL, NULL, 12.48, '2026-04-23 23:34:11', '2026-04-24 12:03:39', 0, 0, 'COMPLETED', '07:34:11', '12:02:20', '12:02:27', '20:03:39'),
(382, 75, 'Herbert T. Villano', 'OIC Chief Geologist', 'Geoscience Division', 'Review reports and submitted reports', 'yes', NULL, NULL, NULL, 8.53, '2026-04-23 23:41:34', '2026-04-24 08:14:42', 0, 0, 'COMPLETED', '07:41:34', '11:50:22', '12:11:34', '16:14:42'),
(383, 63, 'Aisah Samson Ogatis', 'Accountant III', 'Finance Administrative Division', '- Review Payroll for Magna Carta Jan-Mar 2026 (Hazard Pay, Subsistence and Laundry Allowance, and Longevity Pay).\r\n- Compute for the withholding tax on Magna Carta payroll\r\n- Recording of Journal Entry Vouchers in eNGAS for the following transactions:\r\n- Cash Collections \r\n    (April 16-23, 2026)\r\n- April payroll\r\n-Review bank disbursement transaction list for Payroll and TEV', '- Review Payroll for Magna Carta Jan-Mar 2026 (Hazard Pay, Subsistence and Laundry Allowance, and Longevity Pay).\r\n- Compute for the withholding tax on Magna Carta payroll\r\nRecording of Journal Entry Vouchers in eNGAS for the following transactions:\r\n- Cash Collections \r\n    (April 16-23, 2026)\r\n- April 2026 payroll\r\nReview bank disbursement transaction list for the following:\r\n - Payroll for 2nd half of April 2026\r\n - TEV of various COS', NULL, NULL, '- Review Payroll for Magna Carta Jan-Mar 2026 (Hazard Pay, Subsistence and Laundry Allowance, and Longevity Pay).\r\n- Compute for the withholding tax on Magna Carta payroll\r\nRecording of Journal Entry Vouchers in eNGAS for the following transactions:\r\n- Cash Collections \r\n    (April 16-23, 2026)\r\n- April 2026 payroll\r\nReview bank disbursement transaction list for the following:\r\n - Payroll for 2nd half of April 2026\r\n - TEV of various COS', 9.37, '2026-04-23 23:42:34', '2026-04-24 09:05:21', 0, 0, 'COMPLETED', '07:42:34', '12:05:07', '12:06:31', '17:05:21'),
(384, 69, 'Danilo V. Rodriguez', 'Chief MSESDD', 'Mine Safety Environment and Social Development Division', 'attend online meeting with MSESDD National on personnel  Plan', 'Whole afternoon meeting with MSESDD National', NULL, NULL, 'preliminaries on the MSESDD meeting.  this afternoon..breakout rooms per section', 9.63, '2026-04-23 23:45:48', '2026-04-24 09:24:56', 0, 0, 'COMPLETED', '07:45:48', '12:02:24', '12:03:43', '17:24:56'),
(385, 43, 'Leandrew Floyd', 'SRSII', 'Office of the Regional Director', 'Draft reporf', NULL, NULL, NULL, NULL, 4.33, '2026-04-23 23:47:40', '2026-04-24 04:07:57', 0, 0, 'TIMED_IN', '07:47:40', '12:07:54', '12:07:57', NULL);
INSERT INTO `time_records` (`id`, `user_id`, `full_name`, `position`, `division`, `target`, `accomplishment`, `time_in`, `time_out`, `notes`, `total_hours`, `created_at`, `updated_at`, `has_timed_in_today`, `timed_in_flag`, `status`, `morning_time_in`, `morning_time_out`, `afternoon_time_in`, `afternoon_time_out`) VALUES
(386, 25, 'Lj Myah C. Dalisay', 'Science Research Specialist I', 'Geoscience Division', 'Work on the draft technical report for the quadrangle mapping done in Calinan Quadrangle.', 'Draft technical report for the Calinan Quadrangle Mapping Activity.', NULL, NULL, NULL, 9.22, '2026-04-23 23:47:49', '2026-04-24 09:01:44', 0, 0, 'COMPLETED', '07:47:49', '12:05:12', '12:06:05', '17:01:44'),
(387, 61, 'Katyrhene B. Lacid', 'Engineer III', 'Mine Management Division', 'Updating of databases, drafting of letters', 'checked database. drafted letters', NULL, NULL, NULL, 9.02, '2026-04-24 00:04:56', '2026-04-24 09:06:48', 0, 0, 'COMPLETED', '08:04:56', '12:10:47', '12:10:59', '17:06:48'),
(388, 64, 'Oseas S. Macana', 'Engr3', 'Mine Management Division', 'Meetings', 'To comply..', NULL, NULL, NULL, 10.15, '2026-04-24 00:08:04', '2026-04-24 10:17:51', 0, 0, 'COMPLETED', '08:08:04', '12:12:49', '12:13:03', '18:17:51'),
(389, 44, 'April Lepardo', 'IOII', 'Office of the Regional Director', 'Moss update with DICT\r\nMeeting with RScig', '1.Done with meeting\r\nA. RSCiG\r\nB. MEIPD - rat plan MgB related\r\n\r\n2. Monitored FB for mining news\r\n3. Drafted pUBlat for ocean month', NULL, NULL, NULL, 9.45, '2026-04-24 00:18:35', '2026-04-24 09:47:10', 0, 0, 'COMPLETED', '08:18:35', '12:17:25', '12:17:33', '17:47:10'),
(390, 58, 'VILLANUEVA, RONALD P.', 'Engineer III', 'Mine Management Division', 'PMRB DDN, MOSS Document, ISO PM', 'PMRB Meeting, ISO PM', NULL, NULL, NULL, 7.83, '2026-04-24 01:10:53', '2026-04-24 09:01:49', 0, 0, 'COMPLETED', '09:10:53', '17:01:13', '17:01:28', '17:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `division` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `position`, `division`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@MGB.com', NULL, '$2y$12$lgdgpNNac8gbqFu1s6km1eisvFoBfSHSWrUgvZ2Ejg77E1m6o/pU.', 'Administrator', 'IT', 1, NULL, '2026-01-09 23:05:11', '2026-01-09 23:05:11'),
(10, 'Rene Redondo', 'raredondo.xi@gmail.com', NULL, '$2y$12$bhgUR75B5kfWVWdLCer/fOOxqAdmNL.xMYg7ynOYZlLsRbgKDK3q.', 'IT', 'Office of the Regional Director', 0, NULL, '2026-01-09 23:56:45', '2026-01-09 23:56:45'),
(11, 'Jyreen Joy M Peñaloga', 'jjmpenaloga.xi@gmail.com', NULL, '$2y$12$pOA7/X.vU32OLlOz7rGUMuAnzYJLrJU9YKJKYtjfwl.tMO3L/C87y', 'Senior Geologist', 'Geoscience Division', 0, NULL, '2026-01-10 00:44:20', '2026-01-10 00:44:20'),
(12, 'Iris Kay L. Cortez', 'iklc.xi@gmail.com', NULL, '$2y$12$JzoCGo08mum/Tu3zlL6QjOaiAFLjrDecnpWaM6xSm2/cpz/B1ui/C', 'Engineer II', 'Mine Management Division', 0, NULL, '2026-01-10 00:55:26', '2026-02-12 23:45:13'),
(13, 'Jomari John N. Cleofe', 'jjcleofe.xi@gmail.com', NULL, '$2y$12$KEb6g3fHF7bj0Fw4RDyk4.iS81ygVKXS0bEMyuYVHWx9om9Uau38u', 'Science Research Specialist II', 'Mine Management Division', 0, NULL, '2026-01-10 00:58:39', '2026-04-16 23:29:41'),
(14, 'Mia Marcelle Descalsota Salo', 'mmdsalo.xi@gmail.com', NULL, '$2y$12$W39bfyIiAUb2nReXAJDY6eQJiQCjQa2kA2bT8cwjzjDjvG0jaABDi', 'GIS Specialist C', 'Geoscience Division', 0, NULL, '2026-01-10 05:50:22', '2026-01-10 05:50:22'),
(15, 'Christy Marie Anne I. Olaivar', 'cmaiolaivar.xi@gmail.com', NULL, '$2y$12$7m2fJT/l9dGaw9oM1jCta.8yvvnAHaEn4ph6loAfIgMxMyQSFjkYi', 'Science Research Specialist I', 'Geosciences Division', 0, NULL, '2026-01-10 05:54:32', '2026-03-26 21:20:24'),
(16, 'Adonis Angelo Cañon', 'adonisangelo.canon@gmail.com', NULL, '$2y$12$9wi8AXj3E9.lDtJvGz0kYuGFYG0k9yuBdLCrFSHkZogmQR1sXFEwa', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-10 05:54:48', '2026-01-10 05:54:48'),
(17, 'Jenny Rose S. Rojas', 'jrbselmaro.xi@gmail.com', NULL, '$2y$12$qnAs1Lh2e8A1PKa//pvsxeps/zF9HI2K/tCC0ud4i8QQFDddvpKX6', 'SRS II', 'Mine Management Division', 0, NULL, '2026-01-10 06:05:25', '2026-01-10 06:05:25'),
(18, 'Benedict Lejano', 'benlejano.xi@gmail.com', NULL, '$2y$12$SgkMlaX3dH25gI54FNUEu.t0yR78btczTC0iRKghReQ.iKflkXmh.', 'Sr. Science Research Specialist', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-01-10 06:27:43', '2026-01-10 06:27:43'),
(19, 'Khlaire Abegail Ruperez', 'kamruperez.xi@gmail.com', NULL, '$2y$12$nNgGuGtD9CMg4BxrbquAvOxC9BlyrCF6/vsX7MDbETjxCrsIr7cUy', 'Planning Officer II', 'Office of the Regional Director', 0, NULL, '2026-01-10 06:30:36', '2026-01-10 06:30:36'),
(20, 'Marie Anne Garcia', 'maegarcia.xi@gmail.com', NULL, '$2y$12$qfep6NO4qdVPNCcmriF9X.JoR9YB.KGiHeKxXg96t03ACjvUdurl.', 'GIS Specialist C', 'Geoscience Division', 0, NULL, '2026-01-10 06:48:03', '2026-04-09 23:45:20'),
(21, 'Ian Gabriel G. De Vera', 'iggdevera.xi@gmail.com', NULL, '$2y$12$vu1YB9znWs7NTnYkiZse4.8trsOGlLDF4oWx2X6FGwa07HEst969m', 'Science Research Specialist I', 'Geoscience Division', 0, NULL, '2026-01-10 06:55:43', '2026-01-10 06:55:43'),
(22, 'Mark Angelou Ner', 'markangelouner.xi@gmail.com', NULL, '$2y$12$q.D5yEZnutEcyK/tYbwC/uEkBXjDBN97bAoP0eNuxq4oV4kD8d7/.', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-10 06:59:07', '2026-01-10 06:59:07'),
(23, 'Neri Mar B. Paraguya', 'nmbparaguya.xi@gmail.com', NULL, '$2y$12$h6xG4XxfMfvEKJxofdlqYOMq8cSxdQWcjXFBWyRNuquxcPhPsxhAa', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-10 07:04:50', '2026-01-10 07:04:50'),
(24, 'Vincent', 'vdgallera.xi@gmail.com', NULL, '$2y$12$mI4pZdpmY2y0fADn6IjT0uT1FgJqST7SmzOyEJB7NPzJ7NOoFIQ6u', 'SRS I', 'Office of the Regional Director', 0, NULL, '2026-01-10 07:05:41', '2026-01-10 07:05:41'),
(25, 'Lj Myah C. Dalisay', 'lmcdalisay.xi@gmail.com', NULL, '$2y$12$I3o7P731qnCsv4reG/nnO.yJG1grpxufNU/94K2XsG68tbfvNF/ou', 'Science Research Specialist I', 'Geoscience Division', 0, NULL, '2026-01-10 07:05:52', '2026-01-10 07:05:52'),
(26, 'Cris Ryann Nacua Ypil', 'crisryannypil@gmail.com', NULL, '$2y$12$ytUvGdbfIQot.SObPxOTVewv2VAKMh57APCX0Zs9dJxmY8TYZvphW', 'Engineer II', 'Mine Management Division', 0, NULL, '2026-01-10 07:09:46', '2026-01-10 07:09:46'),
(27, 'Raphael Louis Silades Ochave', 'paengrls.xi@gmail.com', NULL, '$2y$12$X86dD0HARe9rmNkhQg2pHeKPYpJ47O9euBG1oGLs5IJBkb//mMuQi', 'Science Research Specialist I', 'Mine Management Division', 0, NULL, '2026-01-10 07:11:15', '2026-01-10 07:11:15'),
(28, 'Kenneth Mark B. Nisnea', 'kmbnisnea.xi@gmail.com', NULL, '$2y$12$qyAu5jTRASDIa.NYKmN7r.k0pd/EdO7K/fIY17JEW6bXljoZUq8mG', 'Science Research Specialist 1', 'Geoscience Division', 0, NULL, '2026-01-10 07:17:58', '2026-01-10 07:17:58'),
(29, 'Mizraim G. Melchor Jr.', 'mgmelchor.xi@gmail.com', NULL, '$2y$12$ishX3.gem0L0wUmTLUK21.kJSZXgo6BZoI5G0djCFvUcT9Amwcahe', 'Geologist II', 'Geoscience Division', 0, NULL, '2026-01-10 07:19:02', '2026-01-10 07:19:02'),
(30, 'Edmark Joseph Acilo', 'edmarkacilo.xi@gmail.com', NULL, '$2y$12$d00hnXzE2IEpma2nYwIPK.vv9y31YJgj/1Btck7/HJ9/cnLYHLGp6', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-10 07:28:03', '2026-01-29 11:05:52'),
(31, 'Allen Mark Abanilla', 'ampabanilla.mgbxi@gmail.com', NULL, '$2y$12$jNjKRmMVUj4Whb.61nAxlOeFrbEdlcg4mokchaZozCVFrbqCRPYrS', 'Senior Geologists', 'Geoscience Division', 0, NULL, '2026-01-10 07:31:31', '2026-01-10 07:31:31'),
(32, 'Lovely Rose L. Balili', 'lovelyrosebalili12@gmail.com', NULL, '$2y$12$rftCFgabyCL5C0q7r0n7/OAvv.3Eof0oyiLFajQcHqdvmIpun9Z3.', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-10 07:33:08', '2026-01-10 07:33:08'),
(33, 'Socorro Oquendo', 'socorro.oquendo@mgb.gov.ph', NULL, '$2y$12$gXIXXbihqs3H67a/Z4Mi3O/Al0R3YP0Q7DVmZ1nXYMAByyOMU5mca', 'Chief', 'Finance Administrative Division', 0, NULL, '2026-01-10 07:36:34', '2026-04-10 00:06:26'),
(34, 'Lady Rose T. Rodriguez', 'lrvtablo.xi@gmail.com', NULL, '$2y$12$S9SjEoNWYzFjHoILbFZeAeydmB91maOg5JwrPFAg6mYmLq16lO6ai', 'Cartographer II', 'Geoscience Division', 0, NULL, '2026-01-10 07:37:07', '2026-01-10 07:37:07'),
(35, 'Rene Redondo Jr', 'dukyosantol@gmail.com', NULL, '$2y$12$LaQPDSXl8I221B/GeYCMleQZdLv8yZ2E9m.U4bUNHfReI3JYDqQYW', 'SISS', 'Office of the Regional Director', 0, NULL, '2026-01-10 07:40:29', '2026-01-10 07:40:29'),
(36, 'Faye Yeeda A. Espinosa', 'fyaespinosa.xi@gmail.com', NULL, '$2y$12$..Mew/BZxbuaVwlvl.lq4upr8Szz6kdKJI9.Z9WxyH7UzBLsPwrBm', 'Science Research Specialist II', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-01-10 07:48:00', '2026-01-10 07:48:00'),
(37, 'FRANCIS ANGELO G. PARAMI', 'fagparami.xi@gmail.com', NULL, '$2y$12$GyKFhagsNBJBHraIhvPQPOuIqgZYTY4WY6DiuJb1uqf0as8lhTyTa', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-10 07:48:01', '2026-01-10 07:48:01'),
(38, 'Kirk Justin Tizon', 'kjytizon.xi@gmail.com', NULL, '$2y$12$euiLOJ2eQvDUx4dF/ev4xujd7.RplzjSwE/X2qSniED6HlbnRL/Am', 'SEMS', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-01-10 07:51:14', '2026-01-10 07:51:14'),
(39, 'Honey Rose B. Dayoc', 'hrbdayoc.xi@gmail.com', NULL, '$2y$12$uZ9Y9Ubb/WN/p.ex7Fy5c.Z9RiOrTuYHG6FZYcBmK5LTFlETfyAJu', 'Engineer II', 'Mine Management Division', 0, NULL, '2026-01-10 08:00:24', '2026-01-10 08:00:24'),
(40, 'Mai-lyn D. Reazonda', 'reazondamailyn0531.xi@gmail.com', NULL, '$2y$12$0fiN1rg.GEbHDe4lLNx3G.57xKcAP81SP44IuTLF4jDiHryzuwH0S', 'COMMUNITY AFFAIRS OFFICER II', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-01-10 08:00:31', '2026-01-10 08:00:31'),
(41, 'Maria Julia M. Modequillo', 'mjmmodequillo.xi@gmail.com', NULL, '$2y$12$V.r7Swn4zbODoLL0PlSVPuKm7b4laJ/yx4/16AcgHlU3dvl81PX66', 'Science Research Specialist I', 'Office of the Regional Director', 0, NULL, '2026-01-10 08:14:59', '2026-01-10 08:14:59'),
(42, 'Leslie Neil T. Burgos', 'lntburgos@gmail.com', NULL, '$2y$12$VRm7mU6XqsVYRLdalzq5hOBnPoOT1XfUoMbg39TTOsGJ9RRAlHrmu', 'Science Research Specialist II', 'Geoscience Division', 0, NULL, '2026-01-10 08:23:25', '2026-01-10 08:23:25'),
(43, 'Leandrew Floyd', 'lfaarceo.mgbxi@gmail.com', NULL, '$2y$12$KqfuyXCUT0dbvVZH5kFp7.7YDt4Zdneu6L9HRzqtNlzwCJ9sjBw3m', 'SRSII', 'Office of the Regional Director', 0, NULL, '2026-01-10 08:28:45', '2026-04-24 04:08:43'),
(44, 'April Lepardo', 'ablepardo.xi@gmail.com', NULL, '$2y$12$Afpaok6G3qIoyQHSkkWXQ.rBi2YrhpBYI4hmWNP7YFYpXWEm89Qdm', 'IOII', 'Office of the Regional Director', 0, NULL, '2026-01-10 08:39:57', '2026-01-10 08:39:57'),
(45, 'Lea Mae T. Oracion', 'lmtoracion.xi@gmail.com', NULL, '$2y$12$gS/5pPeto.ZgNRqRFqhyZenVwaButI6L.KNJoYVZ3lptrc2F3DoYS', 'Geologist II', 'Geoscience Division', 0, NULL, '2026-01-10 08:58:15', '2026-01-10 08:58:15'),
(46, 'Ignacio C. Ortiz, Jr.', 'icortiz.xi@gmail.com', NULL, '$2y$12$/nqZ2mAxnQw8kKJnNC.FYe6HusuvqCjcAR91dzDwWjegMeWbgBwOm', 'Science Research Specialist I', 'Geoscience Division', 0, NULL, '2026-01-10 09:17:46', '2026-01-10 09:17:46'),
(47, 'Lowell C. Chicote', 'lcchicote.xi@gmail.com', NULL, '$2y$12$qbnM60skmZ8szV66C5.rceJJwzxBdpSPfMGLXqBogrQ2tNm/OyZ1K', 'Economist II', 'Mine Management Division', 0, NULL, '2026-01-10 09:22:23', '2026-01-29 23:35:53'),
(48, 'Rheycalyn Lugtu', 'rheycalyugtu@gmail.com', NULL, '$2y$12$dsvOIvjH9zpRNxn38NynVuUxYd.6yF8UfWYAo3FR4HErbmGZe1A8u', 'Senior Science Research Specialist', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-01-10 09:58:07', '2026-01-10 09:58:07'),
(49, 'Rheycalyn Lugtu', 'rheycalynlugtu@gmail.com', NULL, '$2y$12$daxumUvUJMN2vLLImStcce33ihP4VN8dVAbn6/yZDiDTvDJszlUrS', 'Senior Science Research Specialist', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-01-10 12:10:00', '2026-01-10 12:10:00'),
(51, 'Carla Lea P. Igaran', 'clpigaran.xi@gmail.com', NULL, '$2y$12$/4CwfKdEbKcy84mRvP1koe4woJ07hkEnRKuzoWCYwFiaM/LL3ZoeK', 'ADAS II', 'Finance Administrative Division', 0, NULL, '2026-01-22 07:12:37', '2026-01-22 07:12:37'),
(54, 'MUSTANSIR V. MANJOORSA', 'mvmanjoorsa.xi@gmail.com', NULL, '$2y$12$TdJ7Lbnwu2Uy6sD6.EEfh.asGr14xhW91nBmcxbqtIsPK6ciVAJfy', 'Supervising Geologist', 'Geoscience Division', 0, NULL, '2026-01-23 08:56:18', '2026-04-16 23:02:15'),
(55, 'Kenneth Mark B. Nisnea', 'kennethmarknisnea@gmail.com', NULL, '$2y$12$p1BXu.naetXsrCQQ9IkKyuFH9L1Z7n5A4q8NnJPsBzHal93f72/Ya', 'Science Research Specialist 1', 'Geoscience Division', 0, NULL, '2026-01-23 09:59:33', '2026-01-23 09:59:33'),
(56, 'Allen Mark Abanilla', 'allenmarkpabanilla@gmail.com', NULL, '$2y$12$hzp2FTSKzwPrFicbs1Xn5uN9iPno96UcULl5hcf4hrrBFINZhK1M2', 'Senior Geologists', 'Geoscience Division', 0, NULL, '2026-01-23 10:39:09', '2026-01-23 10:39:09'),
(57, 'Rodeljan Nuke Free S. Dalian', 'nukedalian.geo@gmail.com', NULL, '$2y$12$369NTGcG9LyZAf9q56jQo.bg6c.4sNeOajlZrceteqqz4/J21NWPW', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-29 12:02:55', '2026-01-29 12:02:55'),
(58, 'VILLANUEVA, RONALD P.', 'rpvillanueva.xi@gmail.com', NULL, '$2y$12$fLIpZyqKdxMJmwAAMA4Jtuklz9vHmQhbgPZ8FUizOKZAmvefTYqm.', 'Engineer III', 'Mine Management Division', 0, NULL, '2026-01-29 23:28:47', '2026-01-29 23:28:47'),
(59, 'Judy Ann C. Mejorada-Wenceslao', 'jacmejorada.xi@gmail.com', NULL, '$2y$12$NXbl1KKvmnSrRDLzMyGi/.iT.knKeNzuyNNk1np0SRU/O4Mw.s.eW', 'Mining Claims Examiner II', 'Mine Management Division', 0, NULL, '2026-01-29 23:37:45', '2026-01-29 23:37:45'),
(60, 'Brenice Ann Gendeve Castillo', 'minres22@gmail.com', NULL, '$2y$12$gI2BCzV.YTcUrta76JwL8u2BwCYeiTtXvldxqrt63.IvFsXyqu/Da', 'Engineer V', 'Mine Management Division', 0, NULL, '2026-02-12 23:30:29', '2026-02-12 23:30:29'),
(61, 'Katyrhene B. Lacid', 'ktbasmayor.xi@gmail.com', NULL, '$2y$12$/8PI6uMfwmdS8Mbb73Rlo.RavRkILWCO898m/OMRQcGolwebaqJuy', 'Engineer III', 'Mine Management Division', 0, NULL, '2026-02-13 00:35:06', '2026-02-13 00:35:06'),
(62, 'Cordelia Ea', 'mgbr11hr@gmail.com', NULL, '$2y$12$kgkCRax6H8mT3E7rz55uFupi5c.5LIt0adlbWaemsqgy9e6crzlQ2', 'Admin Officer V', 'Finance Administrative Division', 0, NULL, '2026-02-19 05:34:28', '2026-02-19 05:34:28'),
(63, 'Aisah Samson Ogatis', 'aisah.ogatis@gmail.com', NULL, '$2y$12$pOlHII0VsxLziSp/Xv8Jj.BXkf0a/czV4W5tnS7xFH5rXERfS/I8m', 'Accountant III', 'Finance Administrative Division', 0, NULL, '2026-02-19 23:13:21', '2026-02-19 23:13:21'),
(64, 'Oseas S. Macana', 'osmacana.xi@gmail.com', NULL, '$2y$12$jFmzmc.mFwfxwQxQcYXtvOfuK2pwB7I4GWzjTp5AUa5csoZs3OUQu', 'Engr3', 'Mine Management Division', 0, NULL, '2026-02-20 00:31:13', '2026-02-20 00:31:13'),
(65, 'Fedelis S. Echavez', 'fsechavez.xi@gmail.com', NULL, '$2y$12$ZDvldHB2vHKaut0y1X/b5e8LDr32R9fznO2.KBdzC.UY.LlVQQgPO', 'Supervising Science Research Specialist', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-02-26 23:37:17', '2026-02-26 23:37:17'),
(66, 'Richard U. Aquino', 'ruaquino.xi@gmail.com', NULL, '$2y$12$lCbzCNpHiG4BfcwQIHPEVerghTK2ajUVCBmV80EYAEHe2VITFFwtK', 'Engineer IV', 'Mine Management Division', 0, NULL, '2026-02-27 00:15:32', '2026-03-12 23:59:11'),
(67, 'angel mae Cabaylo', 'amncabaylo.mgbxi@gmail.com', NULL, '$2y$12$OuplpRl6e9DbzpNn7hOa3O8DaZ0v48G9qvugWVGbTPQEJCQQgVbYa', 'Supervising Science Research Specialist', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-03-12 23:11:24', '2026-03-12 23:11:24'),
(68, 'Bruce Santillan', 'bbsantillan2.xi@gmail.com', NULL, '$2y$12$lv9OW1CHOpyk6MieowDmKu7QmZMbOMzXRCN3N4L5HFKFfUFb8CW8a', 'Sr. SRS', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-03-12 23:38:19', '2026-03-12 23:38:19'),
(69, 'Danilo V. Rodriguez', 'dvrodriguez.xi@gmail.com', NULL, '$2y$12$88JoBpmryhVDrdRfinvlt.EDQGeeeXwUMg3qdu1yYfF3BxtXYVXgW', 'Chief MSESDD', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-03-12 23:43:04', '2026-03-12 23:43:04'),
(70, 'Capter John Tubo', 'cjmtubo.xi@gmail.com', NULL, '$2y$12$xFhSLPhyo1F3LY62Ay4lN.a8mj8CQi./FeKi91s6l.sYNq9TbUoyS', 'Supervising Geologist', 'Geoscience Division', 0, NULL, '2026-03-25 05:37:04', '2026-03-25 05:37:04'),
(71, 'Allen Mark Abanilla', 'ampabanilla.ximgb@gmail.com', NULL, '$2y$12$Ub1m6S82yA4Gu0jrnXPCqeN3BKApM9pfU59h.T9NtMfG8zNPbvORC', 'Senior Geologists', 'Geoscience Division', 0, NULL, '2026-03-26 23:15:21', '2026-03-26 23:15:21'),
(72, 'Ryan C. Fernandez', 'rcfernandez.xi@gmail.com', NULL, '$2y$12$b1UImwvj3nVm1SVV.LgNvOmEIlfTmRCmlZtfwUchEGLjWaMmH7.6m', 'Cmt II', 'Office of the Regional Director', 0, NULL, '2026-03-31 08:18:48', '2026-03-31 08:18:48'),
(73, 'Angel Mae Cabaylo', 'angelnikka88@gmail.com', NULL, '$2y$12$XsRJe4013CA6pThpAFz5Y.aakhMVIkXUKVAD/0j1H39gGCwKKUtK6', 'Supervising Science Research Specialist', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-04-09 23:38:41', '2026-04-09 23:38:41'),
(74, 'Shiely Dilangalen', 'sheydilangalen@gmail.com', NULL, '$2y$12$cNMaFZmrgPyAlpJ9vD4uYe4vTSu4JG8AeiBVSQKLkXaNVYFuj1vau', 'Administrative Officer III', 'Finance Administrative Division', 0, NULL, '2026-04-09 23:43:39', '2026-04-09 23:43:39'),
(75, 'Herbert T. Villano', 'herbert.villano@mgb.gov.ph', NULL, '$2y$12$.04Rhz1a7FWCv1ckuzNV/ObPv74sYdlEHxcn8HYSCIEiomGKZmC26', 'OIC Chief Geologist', 'Geoscience Division', 0, NULL, '2026-04-23 23:39:56', '2026-04-23 23:39:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `test_table`
--
ALTER TABLE `test_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_records`
--
ALTER TABLE `time_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_table`
--
ALTER TABLE `test_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_records`
--
ALTER TABLE `time_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
