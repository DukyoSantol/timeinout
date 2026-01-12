-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2026 at 11:15 PM
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
(11, '2026_01_09_145418_add_session_columns_to_time_records_table', 5);

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

INSERT INTO `time_records` (`id`, `user_id`, `full_name`, `position`, `division`, `time_in`, `time_out`, `notes`, `total_hours`, `created_at`, `updated_at`, `has_timed_in_today`, `timed_in_flag`, `status`, `morning_time_in`, `morning_time_out`, `afternoon_time_in`, `afternoon_time_out`) VALUES
(9, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, '2026-01-09 00:00:09', NULL, 23.97, '2026-01-09 23:57:32', '2026-01-10 00:00:09', 0, 0, 'COMPLETED', '23:57:32', '23:58:04', '23:59:03', '00:00:09'),
(10, 14, 'Mia Marcelle Descalsota Salo', 'GIS Specialist C', 'Geoscience Division', NULL, NULL, NULL, 16.00, '2026-01-10 05:50:36', '2026-01-10 05:50:37', 0, 0, 'TIMED_IN', '05:50:36', NULL, NULL, NULL),
(11, 16, 'Adonis Angelo Cañon', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, 17.63, '2026-01-10 05:55:35', '2026-01-10 07:33:38', 0, 0, 'TIMED_IN', '05:55:35', NULL, NULL, NULL),
(12, 17, 'Jenny Rose S. Rojas', 'SRS II', 'Mine Management Division', NULL, NULL, NULL, 16.02, '2026-01-10 06:05:50', '2026-01-10 06:07:02', 0, 0, 'TIMED_IN', '06:05:50', NULL, NULL, NULL),
(13, 18, 'Benedict Lejano', 'Sr. Science Research Specialist', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, 16.58, '2026-01-10 06:55:15', '2026-01-10 07:30:33', 0, 0, 'TIMED_IN', '06:55:15', NULL, NULL, NULL),
(14, 21, 'Ian Gabriel G. De Vera', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, 16.10, '2026-01-10 06:56:07', '2026-01-10 07:02:24', 0, 0, 'TIMED_IN', '06:56:07', NULL, NULL, NULL),
(15, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, 16.32, '2026-01-10 06:59:21', '2026-01-10 07:19:06', 0, 0, 'TIMED_IN', '06:59:21', NULL, NULL, NULL),
(16, 23, 'Neri Mar B. Paraguya', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, 16.00, '2026-01-10 07:05:18', '2026-01-10 07:05:19', 0, 0, 'TIMED_IN', '07:05:18', NULL, NULL, NULL),
(17, 24, 'Vincent', 'SRS I', 'Office of the Regional Director', NULL, NULL, NULL, 16.00, '2026-01-10 07:05:53', '2026-01-10 07:05:54', 0, 0, 'TIMED_IN', '07:05:53', NULL, NULL, NULL),
(18, 25, 'Lj Myah C. Dalisay', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, 16.42, '2026-01-10 07:06:02', '2026-01-10 07:31:59', 0, 0, 'TIMED_IN', '07:06:02', NULL, NULL, NULL),
(19, 27, 'Raphael Louis Silades Ochave', 'Science Research Specialist I', 'Mine Management Division', NULL, NULL, NULL, 16.00, '2026-01-10 07:11:25', '2026-01-10 07:11:25', 0, 0, 'TIMED_IN', '07:11:25', NULL, NULL, NULL),
(20, 15, 'Christy Marie Anne I. Olaivar', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, 16.10, '2026-01-10 07:11:26', '2026-01-10 07:18:19', 0, 0, 'TIMED_IN', '07:11:26', NULL, NULL, NULL),
(21, 19, 'Khlaire Abegail Ruperez', 'Planning Officer II', 'Office of the Regional Director', NULL, NULL, NULL, 16.00, '2026-01-10 07:14:46', '2026-01-10 07:14:47', 0, 0, 'TIMED_IN', '07:14:46', NULL, NULL, NULL),
(22, 28, 'Kenneth Mark B. Nisnea', 'Science Research Specialist 1', 'Geoscience Division', NULL, NULL, NULL, 16.00, '2026-01-10 07:18:30', '2026-01-10 07:18:30', 0, 0, 'TIMED_IN', '07:18:30', NULL, NULL, NULL),
(23, 13, 'Jomari John N. Cleofe', 'Science Research Specialist II', 'Mine Management Division', NULL, NULL, NULL, 16.00, '2026-01-10 07:18:31', '2026-01-10 07:18:31', 0, 0, 'TIMED_IN', '07:18:31', NULL, NULL, NULL),
(24, 20, 'Marie Anne Garcia', 'GIS Specialist C', 'Geoscience Division', NULL, NULL, NULL, 16.00, '2026-01-10 07:18:52', '2026-01-10 07:18:52', 0, 0, 'TIMED_IN', '07:18:52', NULL, NULL, NULL),
(25, 29, 'Mizraim G. Melchor Jr.', 'Geologist II', 'Geoscience Division', NULL, NULL, NULL, 16.00, '2026-01-10 07:19:24', '2026-01-10 07:19:24', 0, 0, 'TIMED_IN', '07:19:24', NULL, NULL, NULL),
(26, 30, 'Edmark Joseph Acilo', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, 16.05, '2026-01-10 07:28:08', '2026-01-10 07:31:20', 0, 0, 'TIMED_IN', '07:28:08', NULL, NULL, NULL),
(27, 31, 'Allen Mark Abanilla', 'Senior Geologists', 'Geoscience Division', NULL, NULL, NULL, 16.00, '2026-01-10 07:31:41', '2026-01-10 07:31:42', 0, 0, 'TIMED_IN', '07:31:41', NULL, NULL, NULL),
(28, 32, 'Lovely Rose L. Balili', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, 16.08, '2026-01-10 07:33:23', '2026-01-10 07:38:29', 0, 0, 'TIMED_IN', '07:33:23', NULL, NULL, NULL),
(29, 26, 'Cris Ryann Nacua Ypil', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, 16.00, '2026-01-10 07:36:43', '2026-01-10 07:36:43', 0, 0, 'TIMED_IN', '07:36:43', NULL, NULL, NULL),
(30, 33, 'Socorro Oquendo', 'Chief', 'Finance Administrative Division', NULL, NULL, NULL, 16.00, '2026-01-10 07:36:59', '2026-01-10 07:36:59', 0, 0, 'TIMED_IN', '07:36:59', NULL, NULL, NULL),
(31, 34, 'Lady Rose T. Rodriguez', 'Cartographer II', 'Geoscience Division', NULL, NULL, NULL, 16.00, '2026-01-10 07:37:23', '2026-01-10 07:37:24', 0, 0, 'TIMED_IN', '07:37:23', NULL, NULL, NULL),
(32, 35, 'Rene Redondo Jr', 'SISS', 'Office of the Regional Director', NULL, NULL, NULL, 16.02, '2026-01-10 07:40:35', '2026-01-10 07:42:10', 0, 0, 'TIMED_IN', '07:40:35', NULL, NULL, NULL),
(33, 12, 'Iris Kay L. Cortez', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, 16.00, '2026-01-10 07:42:08', '2026-01-10 07:42:08', 0, 0, 'TIMED_IN', '07:42:08', NULL, NULL, NULL),
(34, 11, 'Jyreen Joy M Peñaloga', 'Senior Geologist', 'Geoscience Division', NULL, NULL, NULL, 16.00, '2026-01-10 07:46:01', '2026-01-10 07:46:01', 0, 0, 'TIMED_IN', '07:46:01', NULL, NULL, NULL),
(35, 37, 'FRANCIS ANGELO G. PARAMI', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, 16.08, '2026-01-10 07:48:08', '2026-01-10 07:53:15', 0, 0, 'TIMED_IN', '07:48:08', NULL, NULL, NULL),
(36, 36, 'Faye Yeeda A. Espinosa', 'Science Research Specialist II', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, 16.00, '2026-01-10 07:48:29', '2026-01-10 07:48:30', 0, 0, 'TIMED_IN', '07:48:29', NULL, NULL, NULL),
(37, 38, 'Kirk Justin Tizon', 'SEMS', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, 16.02, '2026-01-10 07:51:19', '2026-01-10 07:52:27', 0, 0, 'TIMED_IN', '07:51:19', NULL, NULL, NULL),
(38, 39, 'Honey Rose B. Dayoc', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, 7.40, '2026-01-10 08:00:40', '2026-01-10 17:04:09', 0, 0, 'TIMED_IN', '08:00:40', '12:12:23', '12:17:41', NULL),
(39, 40, 'Mai-lyn D. Reazonda', 'COMMUNITY AFFAIRS OFFICER II', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, 7.42, '2026-01-10 08:00:49', '2026-01-10 17:04:09', 0, 0, 'TIMED_IN', '08:00:49', '12:13:54', '12:16:43', NULL),
(40, 35, 'Rene Redondo Jr', 'SISS', 'Office of the Regional Director', NULL, NULL, NULL, 0.97, '2026-01-10 08:05:35', '2026-01-10 17:04:09', 0, 0, 'TIMED_IN', '08:05:35', NULL, NULL, NULL),
(41, 10, 'Rene Redondo', 'IT', 'Office of the Regional Director', NULL, '2026-01-09 17:01:10', NULL, 8.77, '2026-01-10 08:13:31', '2026-01-10 17:01:10', 0, 0, 'COMPLETED', '08:13:31', '12:37:17', '12:37:52', '17:01:10'),
(42, 41, 'Maria Julia M. Modequillo', 'Science Research Specialist I', 'Office of the Regional Director', NULL, NULL, NULL, 6.88, '2026-01-10 08:15:19', '2026-01-10 17:04:09', 0, 0, 'TIMED_IN', '08:15:19', '12:05:35', '12:07:54', NULL),
(43, 42, 'Leslie Neil T. Burgos', 'Science Research Specialist II', 'Geoscience Division', NULL, NULL, NULL, 7.10, '2026-01-10 08:23:53', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:23:53', '12:15:42', '12:19:31', NULL),
(44, 43, 'Leandrew Floyd', 'SRSII', 'Office of the Regional Director', NULL, NULL, NULL, 6.50, '2026-01-10 08:28:53', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:28:53', '12:01:07', '12:02:23', NULL),
(45, 29, 'Mizraim G. Melchor Jr.', 'Geologist II', 'Geoscience Division', NULL, NULL, NULL, 7.37, '2026-01-10 08:31:16', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:31:16', '12:29:09', '12:29:13', NULL),
(46, 17, 'Jenny Rose S. Rojas', 'SRS II', 'Mine Management Division', NULL, NULL, NULL, 7.18, '2026-01-10 08:32:02', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:32:02', '12:22:59', '12:25:52', NULL),
(47, 27, 'Raphael Louis Silades Ochave', 'Science Research Specialist I', 'Mine Management Division', NULL, NULL, NULL, 7.33, '2026-01-10 08:36:08', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:36:08', '12:29:21', '12:31:23', NULL),
(48, 21, 'Ian Gabriel G. De Vera', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, 6.48, '2026-01-10 08:36:29', '2026-01-10 17:05:36', 0, 0, 'TIMED_IN', '08:36:29', '12:00:06', '12:12:31', NULL),
(49, 15, 'Christy Marie Anne I. Olaivar', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, 6.90, '2026-01-10 08:38:08', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:38:08', '12:17:18', '12:19:37', NULL),
(50, 24, 'Vincent', 'SRS I', 'Office of the Regional Director', NULL, NULL, NULL, 7.00, '2026-01-10 08:39:09', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:39:09', '12:21:56', '12:22:47', NULL),
(51, 44, 'April Lepardo', 'IOII', 'Office of the Regional Director', NULL, '2026-01-09 12:09:55', NULL, 3.47, '2026-01-10 08:40:02', '2026-01-10 12:09:56', 0, 0, 'COMPLETED', '08:40:02', '12:08:22', '12:09:11', '12:09:55'),
(52, 28, 'Kenneth Mark B. Nisnea', 'Science Research Specialist 1', 'Geoscience Division', NULL, NULL, NULL, 6.78, '2026-01-10 08:40:48', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:40:48', '12:15:30', '12:17:25', NULL),
(53, 38, 'Kirk Justin Tizon', 'SEMS', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, 7.28, '2026-01-10 08:47:14', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:47:16', '12:34:56', '12:35:02', NULL),
(54, 36, 'Faye Yeeda A. Espinosa', 'Science Research Specialist II', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, 6.52, '2026-01-10 08:47:19', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:47:19', '12:09:42', '12:13:57', NULL),
(55, 31, 'Allen Mark Abanilla', 'Senior Geologists', 'Geoscience Division', NULL, NULL, NULL, 6.88, '2026-01-10 08:47:23', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:47:23', '12:22:25', '12:23:07', NULL),
(56, 32, 'Lovely Rose L. Balili', 'Science Research Specialist II', 'Office of the Regional Director', NULL, '2026-01-09 17:08:14', NULL, 8.28, '2026-01-10 08:48:17', '2026-01-10 17:08:15', 0, 0, 'COMPLETED', '08:48:17', '12:03:13', '12:04:22', '17:08:14'),
(57, 12, 'Iris Kay L. Cortez', 'Engineer II', 'Mine Management Division', NULL, NULL, NULL, 6.38, '2026-01-10 08:49:32', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:49:32', '12:07:37', '12:09:14', NULL),
(58, 26, 'Cris Ryann Nacua Ypil', 'Engineer II', 'Mine Management Division', NULL, '2026-01-09 17:04:44', NULL, 8.23, '2026-01-10 08:49:32', '2026-01-10 17:04:44', 0, 0, 'COMPLETED', '08:49:32', '12:13:23', '12:13:34', '17:04:44'),
(59, 13, 'Jomari John N. Cleofe', 'Science Research Specialist II', 'Mine Management Division', NULL, NULL, NULL, 6.92, '2026-01-10 08:51:14', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:51:14', '12:25:21', '12:25:34', NULL),
(60, 18, 'Benedict Lejano', 'Sr. Science Research Specialist', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, 6.43, '2026-01-10 08:51:37', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:51:37', '12:11:36', '12:11:44', NULL),
(61, 16, 'Adonis Angelo Cañon', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, 6.12, '2026-01-10 08:52:12', '2026-01-10 17:08:22', 0, 0, 'TIMED_IN', '08:52:12', '12:02:39', '12:05:45', NULL),
(62, 37, 'FRANCIS ANGELO G. PARAMI', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, 6.37, '2026-01-10 08:52:51', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:52:51', '12:01:26', '12:18:36', NULL),
(63, 34, 'Lady Rose T. Rodriguez', 'Cartographer II', 'Geoscience Division', NULL, NULL, NULL, 6.60, '2026-01-10 08:55:34', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:55:34', '12:18:12', '12:18:20', NULL),
(64, 19, 'Khlaire Abegail Ruperez', 'Planning Officer II', 'Office of the Regional Director', NULL, '2026-01-09 17:07:17', NULL, 8.13, '2026-01-10 08:55:52', '2026-01-10 17:07:17', 0, 0, 'COMPLETED', '08:55:52', '12:00:33', '12:02:40', '17:07:17'),
(65, 20, 'Marie Anne Garcia', 'GIS Specialist C', 'Geoscience Division', NULL, NULL, NULL, 7.33, '2026-01-10 08:56:56', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:56:56', '12:40:24', '12:41:36', NULL),
(66, 45, 'Lea Mae T. Oracion', 'Geologist II', 'Geoscience Division', NULL, NULL, NULL, 7.35, '2026-01-10 08:58:26', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '08:58:26', '12:41:50', '12:42:14', NULL),
(67, 25, 'Lj Myah C. Dalisay', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, 6.67, '2026-01-10 09:00:46', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '09:00:46', '12:00:59', '12:45:07', NULL),
(68, 23, 'Neri Mar B. Paraguya', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, 5.92, '2026-01-10 09:09:22', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '09:09:22', '12:01:58', '12:07:09', NULL),
(69, 22, 'Mark Angelou Ner', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, 6.00, '2026-01-10 09:11:18', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '09:11:18', '12:08:00', '12:08:30', NULL),
(70, 46, 'Ignacio C. Ortiz, Jr.', 'Science Research Specialist I', 'Geoscience Division', NULL, NULL, NULL, 5.80, '2026-01-10 09:18:18', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '09:18:18', '12:05:25', '12:05:46', NULL),
(71, 47, 'Lowell C. Chicote', 'Economist II', 'Mine Management Division', NULL, '2026-01-09 16:31:33', NULL, 6.48, '2026-01-10 09:22:42', '2026-01-10 16:31:33', 0, 0, 'COMPLETED', '09:22:42', '12:03:26', '12:42:00', '16:31:33'),
(72, 48, 'Rheycalyn Lugtu', 'Senior Science Research Specialist', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, 0.90, '2026-01-10 09:58:13', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '09:58:13', NULL, NULL, NULL),
(73, 30, 'Edmark Joseph Acilo', 'Science Research Specialist II', 'Office of the Regional Director', NULL, NULL, NULL, 4.50, '2026-01-10 10:33:35', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '10:33:35', '12:03:42', '12:04:47', NULL),
(74, 49, 'Rheycalyn Lugtu', 'Senior Science Research Specialist', 'Mine Safety Environment and Social Development Division', NULL, NULL, NULL, 3.13, '2026-01-10 12:11:00', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '12:11:00', '12:11:05', '12:12:15', NULL),
(75, 14, 'Mia Marcelle Descalsota Salo', 'GIS Specialist C', 'Geoscience Division', NULL, '2026-01-09 16:21:52', NULL, 0.00, '2026-01-10 12:27:18', '2026-01-10 16:21:52', 0, 0, 'COMPLETED', '12:27:18', '12:27:23', '16:21:48', '16:21:52'),
(76, 11, 'Jyreen Joy M Peñaloga', 'Senior Geologist', 'Geoscience Division', NULL, NULL, NULL, 3.63, '2026-01-10 12:38:27', '2026-01-10 17:04:08', 0, 0, 'TIMED_IN', '12:38:27', '12:40:57', '12:41:05', NULL);

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
(2, 'Admin', 'admin@example.com', NULL, '$2y$12$lgdgpNNac8gbqFu1s6km1eisvFoBfSHSWrUgvZ2Ejg77E1m6o/pU.', 'Administrator', 'IT', 1, NULL, '2026-01-09 23:05:11', '2026-01-09 23:05:11'),
(10, 'Rene Redondo', 'raredondo.xi@gmail.com', NULL, '$2y$12$bhgUR75B5kfWVWdLCer/fOOxqAdmNL.xMYg7ynOYZlLsRbgKDK3q.', 'IT', 'Office of the Regional Director', 0, NULL, '2026-01-09 23:56:45', '2026-01-09 23:56:45'),
(11, 'Jyreen Joy M Peñaloga', 'jjmpenaloga.xi@gmail.com', NULL, '$2y$12$pOA7/X.vU32OLlOz7rGUMuAnzYJLrJU9YKJKYtjfwl.tMO3L/C87y', 'Senior Geologist', 'Geoscience Division', 0, NULL, '2026-01-10 00:44:20', '2026-01-10 00:44:20'),
(12, 'Iris Kay L. Cortez', 'iklc.xi@gmail.com', NULL, '$2y$12$EoKfIwF9rk321QbyywvpaOzjBEldkyW5XJyih6zDPHU5c7jBLeVQC', 'Engineer II', 'Mine Management Division', 0, NULL, '2026-01-10 00:55:26', '2026-01-10 00:55:26'),
(13, 'Jomari John N. Cleofe', 'jjcleofe.xi@gmail.com', NULL, '$2y$12$t8XDxqc8GLDfRIfJOfh/zOtIavJG3o6EDFzSsbm0vl5gfPpT9UcOG', 'Science Research Specialist II', 'Mine Management Division', 0, NULL, '2026-01-10 00:58:39', '2026-01-10 00:58:39'),
(14, 'Mia Marcelle Descalsota Salo', 'mmdsalo.xi@gmail.com', NULL, '$2y$12$W39bfyIiAUb2nReXAJDY6eQJiQCjQa2kA2bT8cwjzjDjvG0jaABDi', 'GIS Specialist C', 'Geoscience Division', 0, NULL, '2026-01-10 05:50:22', '2026-01-10 05:50:22'),
(15, 'Christy Marie Anne I. Olaivar', 'cmaiolaivar.xi@gmail.com', NULL, '$2y$12$7m2fJT/l9dGaw9oM1jCta.8yvvnAHaEn4ph6loAfIgMxMyQSFjkYi', 'Science Research Specialist I', 'Geoscience Division', 0, NULL, '2026-01-10 05:54:32', '2026-01-10 05:54:32'),
(16, 'Adonis Angelo Cañon', 'adonisangelo.canon@gmail.com', NULL, '$2y$12$9wi8AXj3E9.lDtJvGz0kYuGFYG0k9yuBdLCrFSHkZogmQR1sXFEwa', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-10 05:54:48', '2026-01-10 05:54:48'),
(17, 'Jenny Rose S. Rojas', 'jrbselmaro.xi@gmail.com', NULL, '$2y$12$qnAs1Lh2e8A1PKa//pvsxeps/zF9HI2K/tCC0ud4i8QQFDddvpKX6', 'SRS II', 'Mine Management Division', 0, NULL, '2026-01-10 06:05:25', '2026-01-10 06:05:25'),
(18, 'Benedict Lejano', 'benlejano.xi@gmail.com', NULL, '$2y$12$SgkMlaX3dH25gI54FNUEu.t0yR78btczTC0iRKghReQ.iKflkXmh.', 'Sr. Science Research Specialist', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-01-10 06:27:43', '2026-01-10 06:27:43'),
(19, 'Khlaire Abegail Ruperez', 'kamruperez.xi@gmail.com', NULL, '$2y$12$nNgGuGtD9CMg4BxrbquAvOxC9BlyrCF6/vsX7MDbETjxCrsIr7cUy', 'Planning Officer II', 'Office of the Regional Director', 0, NULL, '2026-01-10 06:30:36', '2026-01-10 06:30:36'),
(20, 'Marie Anne Garcia', 'maegarcia.xi@gmail.com', NULL, '$2y$12$cQMzp3VudTVm9kIPCxzxvOkj00OPWbgJ.bl33PIwF7K3T/h/trZEm', 'GIS Specialist C', 'Geoscience Division', 0, NULL, '2026-01-10 06:48:03', '2026-01-10 06:48:03'),
(21, 'Ian Gabriel G. De Vera', 'iggdevera.xi@gmail.com', NULL, '$2y$12$vu1YB9znWs7NTnYkiZse4.8trsOGlLDF4oWx2X6FGwa07HEst969m', 'Science Research Specialist I', 'Geoscience Division', 0, NULL, '2026-01-10 06:55:43', '2026-01-10 06:55:43'),
(22, 'Mark Angelou Ner', 'markangelouner.xi@gmail.com', NULL, '$2y$12$q.D5yEZnutEcyK/tYbwC/uEkBXjDBN97bAoP0eNuxq4oV4kD8d7/.', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-10 06:59:07', '2026-01-10 06:59:07'),
(23, 'Neri Mar B. Paraguya', 'nmbparaguya.xi@gmail.com', NULL, '$2y$12$h6xG4XxfMfvEKJxofdlqYOMq8cSxdQWcjXFBWyRNuquxcPhPsxhAa', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-10 07:04:50', '2026-01-10 07:04:50'),
(24, 'Vincent', 'vdgallera.xi@gmail.com', NULL, '$2y$12$mI4pZdpmY2y0fADn6IjT0uT1FgJqST7SmzOyEJB7NPzJ7NOoFIQ6u', 'SRS I', 'Office of the Regional Director', 0, NULL, '2026-01-10 07:05:41', '2026-01-10 07:05:41'),
(25, 'Lj Myah C. Dalisay', 'lmcdalisay.xi@gmail.com', NULL, '$2y$12$I3o7P731qnCsv4reG/nnO.yJG1grpxufNU/94K2XsG68tbfvNF/ou', 'Science Research Specialist I', 'Geoscience Division', 0, NULL, '2026-01-10 07:05:52', '2026-01-10 07:05:52'),
(26, 'Cris Ryann Nacua Ypil', 'crisryannypil@gmail.com', NULL, '$2y$12$ytUvGdbfIQot.SObPxOTVewv2VAKMh57APCX0Zs9dJxmY8TYZvphW', 'Engineer II', 'Mine Management Division', 0, NULL, '2026-01-10 07:09:46', '2026-01-10 07:09:46'),
(27, 'Raphael Louis Silades Ochave', 'paengrls.xi@gmail.com', NULL, '$2y$12$X86dD0HARe9rmNkhQg2pHeKPYpJ47O9euBG1oGLs5IJBkb//mMuQi', 'Science Research Specialist I', 'Mine Management Division', 0, NULL, '2026-01-10 07:11:15', '2026-01-10 07:11:15'),
(28, 'Kenneth Mark B. Nisnea', 'kmbnisnea.xi@gmail.com', NULL, '$2y$12$qyAu5jTRASDIa.NYKmN7r.k0pd/EdO7K/fIY17JEW6bXljoZUq8mG', 'Science Research Specialist 1', 'Geoscience Division', 0, NULL, '2026-01-10 07:17:58', '2026-01-10 07:17:58'),
(29, 'Mizraim G. Melchor Jr.', 'mgmelchor.xi@gmail.com', NULL, '$2y$12$ishX3.gem0L0wUmTLUK21.kJSZXgo6BZoI5G0djCFvUcT9Amwcahe', 'Geologist II', 'Geoscience Division', 0, NULL, '2026-01-10 07:19:02', '2026-01-10 07:19:02'),
(30, 'Edmark Joseph Acilo', 'edmarkacilo.xi@gmail.com', NULL, '$2y$12$F0w8eU44gEak8uBfgzFckOrEafNAqFXxoN8psc9/Uq5G4q8sZUgGi', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-10 07:28:03', '2026-01-10 07:28:03'),
(31, 'Allen Mark Abanilla', 'ampabanilla.mgbxi@gmail.com', NULL, '$2y$12$jNjKRmMVUj4Whb.61nAxlOeFrbEdlcg4mokchaZozCVFrbqCRPYrS', 'Senior Geologists', 'Geoscience Division', 0, NULL, '2026-01-10 07:31:31', '2026-01-10 07:31:31'),
(32, 'Lovely Rose L. Balili', 'lovelyrosebalili12@gmail.com', NULL, '$2y$12$rftCFgabyCL5C0q7r0n7/OAvv.3Eof0oyiLFajQcHqdvmIpun9Z3.', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-10 07:33:08', '2026-01-10 07:33:08'),
(33, 'Socorro Oquendo', 'socorro.oquendo@mgb.gov.ph', NULL, '$2y$12$izoC6e2ymuDGv4xYWbZ0zOcUv/8j7BTLV92UUSqJnY20T7bEHi7Ka', 'Chief', 'Finance Administrative Division', 0, NULL, '2026-01-10 07:36:34', '2026-01-10 07:36:34'),
(34, 'Lady Rose T. Rodriguez', 'lrvtablo.xi@gmail.com', NULL, '$2y$12$S9SjEoNWYzFjHoILbFZeAeydmB91maOg5JwrPFAg6mYmLq16lO6ai', 'Cartographer II', 'Geoscience Division', 0, NULL, '2026-01-10 07:37:07', '2026-01-10 07:37:07'),
(35, 'Rene Redondo Jr', 'dukyosantol@gmail.com', NULL, '$2y$12$LaQPDSXl8I221B/GeYCMleQZdLv8yZ2E9m.U4bUNHfReI3JYDqQYW', 'SISS', 'Office of the Regional Director', 0, NULL, '2026-01-10 07:40:29', '2026-01-10 07:40:29'),
(36, 'Faye Yeeda A. Espinosa', 'fyaespinosa.xi@gmail.com', NULL, '$2y$12$..Mew/BZxbuaVwlvl.lq4upr8Szz6kdKJI9.Z9WxyH7UzBLsPwrBm', 'Science Research Specialist II', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-01-10 07:48:00', '2026-01-10 07:48:00'),
(37, 'FRANCIS ANGELO G. PARAMI', 'fagparami.xi@gmail.com', NULL, '$2y$12$GyKFhagsNBJBHraIhvPQPOuIqgZYTY4WY6DiuJb1uqf0as8lhTyTa', 'Science Research Specialist II', 'Office of the Regional Director', 0, NULL, '2026-01-10 07:48:01', '2026-01-10 07:48:01'),
(38, 'Kirk Justin Tizon', 'kjytizon.xi@gmail.com', NULL, '$2y$12$euiLOJ2eQvDUx4dF/ev4xujd7.RplzjSwE/X2qSniED6HlbnRL/Am', 'SEMS', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-01-10 07:51:14', '2026-01-10 07:51:14'),
(39, 'Honey Rose B. Dayoc', 'hrbdayoc.xi@gmail.com', NULL, '$2y$12$uZ9Y9Ubb/WN/p.ex7Fy5c.Z9RiOrTuYHG6FZYcBmK5LTFlETfyAJu', 'Engineer II', 'Mine Management Division', 0, NULL, '2026-01-10 08:00:24', '2026-01-10 08:00:24'),
(40, 'Mai-lyn D. Reazonda', 'reazondamailyn0531.xi@gmail.com', NULL, '$2y$12$0fiN1rg.GEbHDe4lLNx3G.57xKcAP81SP44IuTLF4jDiHryzuwH0S', 'COMMUNITY AFFAIRS OFFICER II', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-01-10 08:00:31', '2026-01-10 08:00:31'),
(41, 'Maria Julia M. Modequillo', 'mjmmodequillo.xi@gmail.com', NULL, '$2y$12$V.r7Swn4zbODoLL0PlSVPuKm7b4laJ/yx4/16AcgHlU3dvl81PX66', 'Science Research Specialist I', 'Office of the Regional Director', 0, NULL, '2026-01-10 08:14:59', '2026-01-10 08:14:59'),
(42, 'Leslie Neil T. Burgos', 'lntburgos@gmail.com', NULL, '$2y$12$VRm7mU6XqsVYRLdalzq5hOBnPoOT1XfUoMbg39TTOsGJ9RRAlHrmu', 'Science Research Specialist II', 'Geoscience Division', 0, NULL, '2026-01-10 08:23:25', '2026-01-10 08:23:25'),
(43, 'Leandrew Floyd', 'lfaarceo.mgbxi@gmail.com', NULL, '$2y$12$PfdMcdBwa3yPSZUCWHxf6ugmaqdMEDn/hTa8jJ7RKLxD8ez7.x94W', 'SRSII', 'Office of the Regional Director', 0, NULL, '2026-01-10 08:28:45', '2026-01-10 08:28:45'),
(44, 'April Lepardo', 'ablepardo.xi@gmail.com', NULL, '$2y$12$Afpaok6G3qIoyQHSkkWXQ.rBi2YrhpBYI4hmWNP7YFYpXWEm89Qdm', 'IOII', 'Office of the Regional Director', 0, NULL, '2026-01-10 08:39:57', '2026-01-10 08:39:57'),
(45, 'Lea Mae T. Oracion', 'lmtoracion.xi@gmail.com', NULL, '$2y$12$gS/5pPeto.ZgNRqRFqhyZenVwaButI6L.KNJoYVZ3lptrc2F3DoYS', 'Geologist II', 'Geoscience Division', 0, NULL, '2026-01-10 08:58:15', '2026-01-10 08:58:15'),
(46, 'Ignacio C. Ortiz, Jr.', 'icortiz.xi@gmail.com', NULL, '$2y$12$/nqZ2mAxnQw8kKJnNC.FYe6HusuvqCjcAR91dzDwWjegMeWbgBwOm', 'Science Research Specialist I', 'Geoscience Division', 0, NULL, '2026-01-10 09:17:46', '2026-01-10 09:17:46'),
(47, 'Lowell C. Chicote', 'lcchicote.xi@gmail.com', NULL, '$2y$12$Rj1zfAVagLF02a0bYmPF3ejfH.436aclDX0NOQcRMEOwjC0s99676', 'Economist II', 'Mine Management Division', 0, NULL, '2026-01-10 09:22:23', '2026-01-10 09:22:23'),
(48, 'Rheycalyn Lugtu', 'rheycalyugtu@gmail.com', NULL, '$2y$12$dsvOIvjH9zpRNxn38NynVuUxYd.6yF8UfWYAo3FR4HErbmGZe1A8u', 'Senior Science Research Specialist', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-01-10 09:58:07', '2026-01-10 09:58:07'),
(49, 'Rheycalyn Lugtu', 'rheycalynlugtu@gmail.com', NULL, '$2y$12$daxumUvUJMN2vLLImStcce33ihP4VN8dVAbn6/yZDiDTvDJszlUrS', 'Senior Science Research Specialist', 'Mine Safety Environment and Social Development Division', 0, NULL, '2026-01-10 12:10:00', '2026-01-10 12:10:00');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
