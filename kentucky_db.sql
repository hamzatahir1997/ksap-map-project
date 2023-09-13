-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2023 at 11:59 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kentucky_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_data`
--

CREATE TABLE `admin_data` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(256) NOT NULL,
  `admin_email` varchar(256) NOT NULL,
  `admin_password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_data`
--

INSERT INTO `admin_data` (`id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@gmail.com', 'KYadmin@#2021'),
(2, 'superadmin', 'superadmin@gmail.com', 'KYsuperadmin@#2021');

-- --------------------------------------------------------

--
-- Table structure for table `map_data`
--

CREATE TABLE `map_data` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `floor_id` varchar(256) NOT NULL,
  `color_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `guid` varchar(256) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `insertedOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `school_floor`
--

CREATE TABLE `school_floor` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `floorlevel` varchar(256) NOT NULL,
  `url` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `insertedOn` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `school_map`
--

CREATE TABLE `school_map` (
  `id` int(11) NOT NULL,
  `sname` varchar(256) NOT NULL,
  `s_type` text NOT NULL,
  `agency` varchar(256) NOT NULL,
  `school_code` varchar(256) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `insertedOn` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `survey_data`
--

CREATE TABLE `survey_data` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `grade` text NOT NULL,
  `gender` text NOT NULL,
  `d_gender` text NOT NULL,
  `religion` text NOT NULL,
  `d_religion` text NOT NULL,
  `race` text NOT NULL,
  `d_race` text NOT NULL,
  `S_orient` text NOT NULL,
  `d_S_orient` text NOT NULL,
  `guid` varchar(256) NOT NULL,
  `insertedOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_data`
--

CREATE TABLE `teacher_data` (
  `id` int(11) NOT NULL,
  `uname` varchar(256) NOT NULL,
  `email` text NOT NULL,
  `agency` varchar(256) NOT NULL,
  `code` varchar(256) NOT NULL,
  `upassword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_data`
--
ALTER TABLE `admin_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map_data`
--
ALTER TABLE `map_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_guid_floor` (`guid`,`floor_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_floor`
--
ALTER TABLE `school_floor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_map`
--
ALTER TABLE `school_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_data`
--
ALTER TABLE `survey_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_guid` (`guid`);

--
-- Indexes for table `teacher_data`
--
ALTER TABLE `teacher_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_data`
--
ALTER TABLE `admin_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `map_data`
--
ALTER TABLE `map_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_floor`
--
ALTER TABLE `school_floor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_map`
--
ALTER TABLE `school_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_data`
--
ALTER TABLE `survey_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_data`
--
ALTER TABLE `teacher_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
