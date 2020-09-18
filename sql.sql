-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2020 at 08:29 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `shift2shift`
--

-- --------------------------------------------------------

--
-- Table structure for table `breaks`
--

CREATE TABLE `breaks` (
  `id` int(11) UNSIGNED NOT NULL,
  `break_start` bigint(16) NOT NULL,
  `break_end` bigint(16) NOT NULL DEFAULT '-1',
  `timestamp_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `submitted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `breaks`
--

INSERT INTO `breaks` (`id`, `break_start`, `break_end`, `timestamp_id`, `user_id`, `submitted`) VALUES
(8, 1595866894, 1595867099, 92, 88, 1),
(9, 1595867126, 1595867137, 92, 88, 1),
(10, 1595867690, 1595867703, 95, 88, 1),
(11, 1595867721, 1595867750, 96, 88, 1),
(12, 1595868071, 1595868077, 98, 88, 1),
(13, 1595868200, 1595868207, 99, 88, 1),
(14, 1595868630, 1595868720, 101, 88, 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) UNSIGNED NOT NULL,
  `company_name` varchar(29) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`) VALUES
(1, 'Demo Company'),
(2, 'FWS'),
(3, 'FWE');

-- --------------------------------------------------------

--
-- Table structure for table `timestamps`
--

CREATE TABLE `timestamps` (
  `id` int(11) UNSIGNED NOT NULL,
  `timestamp_start` bigint(16) NOT NULL,
  `timestamp_end` bigint(16) NOT NULL DEFAULT '-1',
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `submitted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timestamps`
--

INSERT INTO `timestamps` (`id`, `timestamp_start`, `timestamp_end`, `user_id`, `company_id`, `project_id`, `submitted`) VALUES
(13, 1595321436, 1595321446, 88, 1, -1, 1),
(14, 1595321538, 1595321555, 88, 1, -1, 1),
(15, 1595435451, 1595435472, 88, 1, -1, 1),
(16, 1595435514, 1595435515, 88, 1, -1, 1),
(17, 1595435746, 1595435750, 88, 1, -1, 1),
(18, 1595436002, 1595436009, 88, 1, -1, 1),
(19, 1595436938, 1595437525, 88, 1, -1, 1),
(20, 1595437530, 1595437550, 88, 1, -1, 1),
(21, 1595552144, 1595552522, 88, 1, -1, 1),
(22, 1595552588, 1595552623, 88, 1, -1, 1),
(23, 1595552621, 1595552623, 88, 1, -1, 1),
(24, 1595552625, 1595553333, 88, 1, -1, 1),
(25, 1595553352, 1595553358, 88, 1, -1, 1),
(26, 1595553801, 1595553831, 88, 1, -1, 1),
(27, 1595555341, 1595555346, 88, 1, -1, 1),
(28, 1595557684, 1595557772, 88, 1, -1, 1),
(29, 1595557780, 1595557949, 88, 1, -1, 1),
(30, 1595557959, 1595558217, 88, 1, -1, 1),
(31, 1595558221, 1595558347, 88, 1, -1, 1),
(32, 1595558349, 1595560076, 88, 1, -1, 1),
(33, 1595560372, 1595560601, 88, 1, -1, 1),
(34, 1595565132, 1595565170, 88, 1, -1, 1),
(35, 1595565180, 1595565239, 88, 1, -1, 1),
(36, 1595565253, 1595565259, 88, 1, -1, 1),
(37, 1595565262, 1595565319, 88, 1, -1, 1),
(38, 1595565329, 1595565369, 88, 1, -1, 1),
(39, 1595827182, 1595827220, 88, 1, -1, 1),
(40, 1595827774, 1595827776, 88, 1, -1, 1),
(42, 1595827781, 1595827784, 88, 1, -1, 1),
(43, 1595827786, 1595827812, 88, 1, -1, 1),
(44, 1595827815, 1595827818, 88, 1, -1, 1),
(45, 1595827819, 1595827827, 88, 1, -1, 1),
(46, 1595827864, 1595827871, 88, 1, -1, 1),
(47, 1595827875, 1595828157, 88, 1, -1, 1),
(48, 1595828162, 1595828164, 88, 1, -1, 1),
(49, 1595828167, 1595828171, 88, 1, -1, 1),
(50, 1595828214, 1595828217, 88, 1, -1, 1),
(51, 1595828218, 1595828221, 88, 1, -1, 1),
(52, 1595828222, 1595828266, 88, 1, -1, 1),
(53, 1595828269, 1595828271, 88, 1, -1, 1),
(54, 1595828275, 1595828292, 88, 1, -1, 1),
(55, 1595828297, 1595828300, 88, 1, -1, 1),
(56, 1595828302, 1595828330, 88, 1, -1, 1),
(57, 1595828334, 1595828335, 88, 1, -1, 1),
(58, 1595828337, 1595828344, 88, 1, -1, 1),
(59, 1595828365, 1595828367, 88, 1, -1, 1),
(60, 1595828368, 1595828370, 88, 1, -1, 1),
(61, 1595828372, 1595828374, 88, 1, -1, 1),
(62, 1595828377, 1595828432, 88, 1, -1, 1),
(63, 1595828434, 1595828435, 88, 1, -1, 1),
(64, 1595828436, 1595828438, 88, 1, -1, 1),
(65, 1595828533, 1595828535, 88, 1, -1, 1),
(66, 1595828536, 1595828538, 88, 1, -1, 1),
(67, 1595828544, 1595828551, 88, 1, -1, 1),
(68, 1595828800, 1595828836, 88, 1, -1, 1),
(69, 1595828857, 1595829184, 88, 1, -1, 1),
(70, 1595829240, 1595829261, 88, 1, -1, 1),
(71, 1595829298, 1595829312, 88, 1, -1, 1),
(72, 1595829385, 1595829432, 88, 1, -1, 1),
(73, 1595829446, 1595829499, 88, 1, -1, 1),
(74, 1595829537, 1595829603, 88, 1, -1, 1),
(75, 1595829645, 1595829720, 88, 1, -1, 1),
(76, 1595829774, 1595829963, 88, 1, -1, 1),
(77, 1595829967, 1595830017, 88, 1, -1, 1),
(78, 1595830046, 1595830061, 88, 1, -1, 1),
(79, 1595830063, 1595830070, 88, 1, -1, 1),
(80, 1595830083, 1595830090, 88, 1, -1, 1),
(81, 1595830598, 1595830600, 88, 1, -1, 1),
(82, 1595830606, 1595830607, 88, 1, -1, 1),
(83, 1595830746, 1595830756, 88, 1, -1, 1),
(84, 1595830762, 1595830771, 88, 1, -1, 1),
(85, 1595830774, 1595830781, 88, 1, -1, 1),
(86, 1595830784, 1595830790, 88, 1, -1, 1),
(87, 1595830795, 1595830801, 88, 1, -1, 1),
(88, 1595830806, 1595830817, 88, 1, -1, 1),
(89, 1595865870, 1595866056, 88, 1, -1, 1),
(90, 1595866058, 1595866692, 88, 1, -1, 1),
(91, 1595866806, 1595866878, 88, 1, -1, 1),
(92, 1595866890, 1595867416, 88, 1, -1, 1),
(93, 1595867576, 1595867580, 88, 1, -1, 1),
(94, 1595867652, 1595867670, 88, 1, -1, 1),
(95, 1595867679, 1595867707, 88, 1, -1, 1),
(96, 1595867711, 1595867786, 88, 1, -1, 1),
(97, 1595867873, 1595867971, 88, 1, -1, 1),
(98, 1595868056, 1595868078, 88, 1, -1, 1),
(99, 1595868185, 1595868209, 88, 1, -1, 1),
(100, 1595868432, 1595868509, 88, 1, -1, 1),
(101, 1595868612, 1595868732, 88, 1, -1, 1),
(102, 1595868770, 1595868784, 88, 1, -1, 1),
(103, 1595868789, 1595868813, 88, 1, -1, 1),
(104, 1595870097, 1595870142, 130, 1, -1, 1),
(105, 1595870177, 1595870289, 88, 1, -1, 1),
(106, 1595870330, 1595870381, 88, 1, -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(29) NOT NULL,
  `last_name` varchar(29) NOT NULL,
  `email` varchar(59) NOT NULL,
  `password` varchar(99) NOT NULL,
  `authority_level` tinyint(1) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `authority_level`, `company_id`) VALUES
(88, 'Demo', 'Demo', 'demo@demo.com', '$2y$10$P8CTnjCrQFBP/zCqTnsOCOusnJeGvKCgpyps88dmyGhO29UQdECMm', 2, 1),
(130, 'Jake', 'Jimby', 'jj@demo.com', '$2y$10$TlqWEy6zNduxqxwN2Gq1cuC8diSFNDEsHVd8C9F0UgCe9Od90SIVK', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breaks`
--
ALTER TABLE `breaks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `timestamps`
--
ALTER TABLE `timestamps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breaks`
--
ALTER TABLE `breaks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `timestamps`
--
ALTER TABLE `timestamps`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;