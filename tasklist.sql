-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2016 at 05:28 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasklist`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(200) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(240) DEFAULT NULL,
  `remember_token` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'kees', 'kees@gmail.com', '$2y$10$irbW5hQOzXHFXJUQrdGbIOpVpj88OPMgg0vrn84uWR/J.UfkXisV2', '566xu2Zed7waIi5Me0pjvqX5IkzldKrsmZ2HBU3M5JsipmeMG4JMnGPoKJZ8', '2016-07-28 15:25:22', '2016-07-28 13:25:22'),
(2, 'Guido', 'guido@gmail.com', '$2y$10$/HB0dHEHyycDFtDgk64nGeWbEqOVdWrwnMnoi./mjytAhTzEnxo1a', 'W8du22q57nZbo6ywB5f76FqYhWhRgZ69xY6HrcDvke7plWRvJEI2eEZZAHKS', '2016-07-28 15:24:48', '2016-07-28 13:24:48'),
(3, 'Jan', 'jan@gmail.com', '$2y$10$fpP8erU29UNGv4Wa9u8uPuSyeQM8rmf7h6p1ceqzXaovvs7Q0xW6.', '40rGyg3A37qb9pbjAs9PAhSnfbilLXGsQ0ZPrvKUm5cfSSiB2JYBRcWNz8u1', '2016-07-20 21:37:03', '2016-07-20 19:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `id` int(200) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `employee_id` int(200) DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`id`, `name`, `employee_id`, `completed_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(45, 'Producten inkopen', 1, NULL, NULL, '2016-07-28 13:24:24', '2016-07-28 13:24:24'),
(46, 'Project opzetten', 3, NULL, NULL, '2016-07-28 13:24:42', '2016-07-28 13:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(266) NOT NULL,
  `batch` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(200) NOT NULL,
  `list_id` int(200) DEFAULT NULL,
  `content` text,
  `completed_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `list_id`, `content`, `completed_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(65, 45, 'Taak 1', '2016-07-28 13:25:16', NULL, '2016-07-28 13:24:58', '2016-07-28 13:25:16'),
(66, 45, 'taak 2', '2016-07-28 13:25:18', NULL, '2016-07-28 13:25:04', '2016-07-28 13:25:18'),
(67, 45, 'taak 3', '2016-07-28 13:25:19', NULL, '2016-07-28 13:25:10', '2016-07-28 13:25:19'),
(68, 45, 'taak 4', NULL, NULL, '2016-07-28 13:25:15', '2016-07-28 13:25:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_employee` (`employee_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_List` (`list_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `fk_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_List` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
