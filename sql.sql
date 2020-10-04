-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 04, 2020 at 10:46 AM
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
  `break_length` int(11) NOT NULL,
  `timestamp_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `submitted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `breaks`
--

INSERT INTO `breaks` (`id`, `break_start`, `break_end`, `break_length`, `timestamp_id`, `user_id`, `company_id`, `submitted`) VALUES
(34, 1601798788154, 1601798801227, 13073, 219, 97, 5, 1);

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
(5, 'Demo Company');

-- --------------------------------------------------------

--
-- Table structure for table `timestamps`
--

CREATE TABLE `timestamps` (
  `id` int(11) UNSIGNED NOT NULL,
  `timestamp_start` bigint(16) NOT NULL,
  `timestamp_end` bigint(16) NOT NULL DEFAULT '-1',
  `timestamp_length` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `submitted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timestamps`
--

INSERT INTO `timestamps` (`id`, `timestamp_start`, `timestamp_end`, `timestamp_length`, `user_id`, `company_id`, `project_id`, `submitted`) VALUES
(218, 1601798751585, 1601798764035, 12450, 97, 5, -1, 1),
(219, 1601798785128, 1601798806605, 8404, 97, 5, -1, 1);

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
(97, 'Jim', 'Brooks', 'demo@demo.com', '$2y$10$ib7eyZtNXcVwFo35HCT8NOkIgmbkWephRZE6VZNoDCNKN9kVvZs2m', 2, 5);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `timestamps`
--
ALTER TABLE `timestamps`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;