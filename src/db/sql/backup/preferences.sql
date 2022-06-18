-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 12:02 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `preference_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `value` varchar(100) NOT NULL,
  `comments` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`preference_id`, `name`, `type`, `value`, `comments`) VALUES
(1, 'SYSTEM_BOMS', 'STRING', 'BOM-100,BOM-101,BOM-104', 'Controls the system scope BOM display'),
(2, 'gantt_end', 'DATE', '2022-08-01', 'how far out the gantt chart should be displayed?'),
(3, 'gantt_start', 'DATE', '2018-08-01', 'start date for the gantt chart '),
(4, 'gantt_status', 'STRING', '\'Active\', \'Build Env Avail\', \'Build/Kit Avail\', \'Cancelled\', \'Completed\', \'Draft\', \'Released\', \'Requ', '\'Active\', \'Completed\', \'Draft\', \'Released\''),
(5, 'gantt_type', 'STRING', '\'Major\', \'Minor\'', '\'Async\', \'Major\', \'Minor\', \'Patch\'');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`preference_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
