-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 07:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhvsu`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement_tbl`
--

CREATE TABLE `announcement_tbl` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement_tbl`
--

INSERT INTO `announcement_tbl` (`id`, `title`, `description`, `start_date`, `end_date`) VALUES
(4, 'sample 5', 'desc5', '2023-11-29 22:33:00', '2023-11-09 22:33:00'),
(5, 'sample again', 'desc2', '2001-12-11 02:01:00', '2001-12-15 04:51:00'),
(6, 'sample 3', 'desc3', '1510-02-12 12:23:00', '2051-12-05 00:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `registered_participants_tbl`
--

CREATE TABLE `registered_participants_tbl` (
  `reg_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered_participants_tbl`
--

INSERT INTO `registered_participants_tbl` (`reg_id`, `stud_id`, `event_id`) VALUES
(2, 1, 6),
(8, 3, 5),
(10, 1, 5),
(11, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `reg_accountstbl`
--

CREATE TABLE `reg_accountstbl` (
  `acc_id` int(11) NOT NULL,
  `acc_role` varchar(255) NOT NULL,
  `acc_gender` varchar(10) NOT NULL,
  `acc_fname` varchar(255) NOT NULL,
  `acc_lname` varchar(255) NOT NULL,
  `acc_mail` varchar(255) NOT NULL,
  `acc_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_accountstbl`
--

INSERT INTO `reg_accountstbl` (`acc_id`, `acc_role`, `acc_gender`, `acc_fname`, `acc_lname`, `acc_mail`, `acc_pass`) VALUES
(1, 'Student', 'Male', 'Not Joshua', 'Camon', 'joshuareuben.camon@gmail.com', '$2y$10$1pQlOeG0ikByFwTnwNP38eoEPf.Z.ssx5gKc6XSpMwMcXcNNGw07y'),
(3, 'Admin', 'Male', 'Joshua Reuben', 'Camon', 'blankz4510471@gmail.com', '$2y$10$oZQHGpa8iAAa090fSQzFK.UMjHkTRJ88CAofj10.ZPLzAUL.yjfjO');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `title`, `description`, `start_datetime`, `end_datetime`) VALUES
(1, 'Sample 101', 'This is a sample schedule only.', '2023-11-10 10:30:00', '2023-11-11 18:00:00'),
(2, 'Sample 102', 'Sample Description 102', '2023-11-08 09:30:00', '2022-01-08 11:30:00'),
(5, 'MyOwnSample3', 'MyDescription', '2023-11-26 16:11:00', '2023-11-27 17:12:00'),
(6, 'sample3', 'desc3', '2023-12-11 17:00:00', '2023-12-11 06:00:00'),
(7, 'sample 4', 'desc4', '2023-11-22 05:00:00', '2023-11-23 04:30:00'),
(8, 'sample 98', 'desc99', '2023-11-01 17:16:00', '2023-11-04 17:16:00'),
(10, 'Sample', 'desc', '2023-12-12 05:00:00', '2023-12-12 18:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement_tbl`
--
ALTER TABLE `announcement_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_participants_tbl`
--
ALTER TABLE `registered_participants_tbl`
  ADD PRIMARY KEY (`reg_id`),
  ADD KEY `fk_eventID` (`event_id`),
  ADD KEY `fk_studID` (`stud_id`);

--
-- Indexes for table `reg_accountstbl`
--
ALTER TABLE `reg_accountstbl`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement_tbl`
--
ALTER TABLE `announcement_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `registered_participants_tbl`
--
ALTER TABLE `registered_participants_tbl`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reg_accountstbl`
--
ALTER TABLE `reg_accountstbl`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registered_participants_tbl`
--
ALTER TABLE `registered_participants_tbl`
  ADD CONSTRAINT `fk_eventID` FOREIGN KEY (`event_id`) REFERENCES `schedule_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_studID` FOREIGN KEY (`stud_id`) REFERENCES `reg_accountstbl` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
