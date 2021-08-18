-- phpMyAdmin SQL Dump
-- version 7.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2020 at 04:43 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homestead`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Kimberly Thomas', 'kimberly-thomas', '2021-08-07 23:48:52', '2021-08-17 09:34:27'),
(2, 'Wendy Stark', 'wendy-stark', '2021-08-07 23:48:52', '2021-08-17 09:34:37'),
(3, 'Demetrius Clemons', 'demetrius-clemons', '2021-08-07 23:48:52', '2021-08-17 09:34:53'),
(4, 'Hector Alford', 'hector-alford', '2021-08-07 23:48:52', '2021-08-17 09:35:04'),
(5, 'Susan Short', 'susan-short', '2021-08-07 23:48:52', '2021-08-17 09:35:14'),
(6, 'Donovan Sharp', 'donovan-sharp', '2021-08-07 23:48:52', '2021-08-17 09:35:27'),
(7, 'Amity Shepherd', 'amity-shepherd', '2021-08-07 23:48:52', '2021-08-17 09:35:41'),
(8, 'Colt Stevenson', 'colt-stevenson', '2021-08-07 23:48:52', '2021-08-17 09:35:54'),
(9, 'Cheryl Ferguson', 'cheryl-ferguson', '2021-08-07 23:48:52', '2021-08-17 09:36:10'),
(10, 'Mufutau Dean', 'mufutau-dean', '2021-08-07 23:48:52', '2021-08-17 09:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_time` tinyint(1) NOT NULL DEFAULT 1,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `slug`, `email`, `role_id`, `full_time`, `street`, `town`, `city`, `country`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Aron Aufderhar', 'aron-aufderhar', 'eugenia29@example.net', '1', 0, '81026 Grayson Divide', 'Kling Burgs', 'Washington', 'Timor-Leste', '2021-08-12 01:59:36', '2021-08-07 23:48:52', '2021-08-07 23:48:52'),
(3, 'Talon Rowland', 'talon-rowland', 'hizotofyr@mailinator.com', '2', 0, 'Similique suscipit q', 'Elit laboriosam ad', 'Voluptatem Quae rer', 'Illum impedit cons', NULL, '2021-08-07 23:48:52', '2021-08-17 09:39:23'),
(4, 'Stella Galloway', 'stella-galloway', 'dibu@mailinator.com', '9', 0, 'Ratione autem quae c', 'Consequatur Minim l', 'Qui delectus delect', 'Qui aliquam neque in', NULL, '2021-08-07 23:48:52', '2021-08-17 09:38:47'),
(6, 'Michelle Buck', 'michelle-buck', 'gaxenovisi@mailinator.com', '3', 1, 'Quisquam nostrud exp', 'Commodi quasi deseru', 'Deleniti consequatur', 'Do consectetur praes', NULL, '2021-08-07 23:48:52', '2021-08-17 09:38:56'),
(7, 'Price Donaldson', 'price-donaldson', 'fijagama@mailinator.com', '3', 0, 'Harum voluptatem Ad', 'Molestiae tempore p', 'Fuga Optio nihil d', 'Sit est consequuntu', NULL, '2021-08-07 23:48:52', '2021-08-17 09:39:14'),
(8, 'Walton Mosciski', 'walton-mosciski', 'santina.hilpert@example.net', '8', 0, '5056 Dannie Squares Apt. 037', 'Ledner Station', 'Maryland', 'Luxembourg', NULL, '2021-08-07 23:48:52', '2021-08-07 23:48:52'),
(9, 'Allan Bartoletti', 'allan-bartoletti', 'lsawayn@example.org', '9', 0, '584 Wilkinson Passage', 'Price Meadows', 'Alaska', 'Malawi', NULL, '2021-08-07 23:48:52', '2021-08-07 23:48:52'),
(10, 'Nestor Emmerich MD', 'nestor-emmerich-md', 'kmayert@example.net', '10', 0, '62355 Romaine Turnpike', 'Adams Place', 'Connecticut', 'Latvia', NULL, '2021-08-07 23:48:52', '2021-08-07 23:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_08_08_000000_create_users_table', 1),
(2, '2021_08_08_100000_create_password_resets_table', 1),
(3, '2021_08_08_084854_create_employees_table', 1),
(4, '2021_08_08_085037_create_departments_table', 1),
(5, '2021_08_08_085056_create_roles_table', 1),
(6, '2021_08_08_085116_create_payrolls_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `over_time` tinyint(1) NOT NULL DEFAULT 0,
  `notified` tinyint(1) NOT NULL DEFAULT 0,
  `hours` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `gross` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `employee_id`, `over_time`, `notified`, `hours`, `rate`, `gross`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 0, 13, 100, 5746, NULL, '2021-08-07 23:48:52', '2021-08-07 23:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` bigint(20) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `salary`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Space Sciences Teacher', 'space-sciences-teacher', 4900, 1, '2021-08-07 23:48:52', '2021-08-07 23:48:52'),
(2, 'Agricultural Equipment Operator', 'agricultural-equipment-operator', 4455, 2, '2021-08-07 23:48:52', '2021-08-07 23:48:52'),
(3, 'Building Cleaning Worker', 'building-cleaning-worker', 4446, 3, '2021-08-07 23:48:52', '2021-08-07 23:48:52'),
(4, 'Freight and Material Mover', 'freight-and-material-mover', 3376, 4, '2021-08-07 23:48:52', '2021-08-07 23:48:52'),
(6, 'Automotive Body Repairer', 'automotive-body-repairer', 2367, 6, '2021-08-07 23:48:52', '2021-08-07 23:48:52'),
(7, 'Milling Machine Operator', 'milling-machine-operator', 4657, 7, '2021-08-07 23:48:52', '2021-08-07 23:48:52'),
(8, 'Biochemist or Biophysicist', 'biochemist-or-biophysicist', 4438, 8, '2021-08-07 23:48:52', '2021-08-07 23:48:52'),
(9, 'Tailor', 'tailor', 2951, 9, '2021-08-07 23:48:52', '2021-08-07 23:48:52'),
(10, 'Director Of Marketing', 'director-of-marketing', 1114, 10, '2021-08-07 23:48:52', '2021-08-07 23:48:52'),
(11, 'ssss', 'ssss', 12222, 2, '2021-08-07 23:48:52', '2021-08-07 23:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Swasti', 'adhikariswastika228@gmail.com', '$2y$10$sf7mQfMEKOCpOr.XgizeR.Nn9vemG8KiD.HdMeY1kVReC5HPo4ALu', 'qNYjvPt5hAe027oJLPTXbA7gNaeU9peIhhi68Bs5YESZCH3kIB0nbgrXMrxB', '2021-08-17 09:13:19', '2021-08-17 09:13:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
