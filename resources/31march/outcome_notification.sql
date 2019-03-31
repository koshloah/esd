-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 16, 2019 at 01:55 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `outcome_notification`
--
CREATE DATABASE IF NOT EXISTS `outcome_notification` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `outcome_notification`;

-- --------------------------------------------------------

--
-- Table structure for table `outcome_notification`
--

DROP TABLE IF EXISTS `outcome_notification`;
CREATE TABLE IF NOT EXISTS `outcome_notification` (
  `application_id` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `chat_id` int(9) NOT NULL,
  `telegram_username` varchar(32) NOT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `outcome_notification`
--

INSERT INTO `outcome_notification` (`application_id`, `email`, `chat_ID`, `telegram_username`) VALUES
('123abc', 'xuesi.sim.2017@sis.smu.edu.sg', 233472680, 'xuesiiii'),
('321xyz', 'keith.loh.2017@sis.smu.edu.sg', 443941427, 'keithloh');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;