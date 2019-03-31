-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2019 at 05:22 AM
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
-- Database: `csv_db`
--
CREATE DATABASE IF NOT EXISTS `dogs` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dogs`;

-- --------------------------------------------------------

--
-- Table structure for table `doginfo`
--

DROP TABLE IF EXISTS `doginfo`;
CREATE TABLE IF NOT EXISTS `doginfo` (
  `id` int(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `age` varchar(5) NOT NULL,
  `breed` varchar(30) NOT NULL,
  `size` varchar(10) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `status` varchar(6) NOT NULL,
  `altered` varchar(7) NULL,
  `hasShots` varchar(8) NULL,
  `houseTrained` varchar(12) DEFAULT NULL,
  `dateAdded` date DEFAULT NULL,
  `description` varchar(20000),
  `pic1` varchar(100) NULL,
  `pic2` varchar(100) NULL,
  Primary KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doginfo`
--

INSERT INTO `doginfo` (`id`, `name`, `age`, `breed`, `size`, `sex`, `status`, `altered`, `hasShots`, `houseTrained`,`dateAdded` ,`description`, `pic1`, `pic2`) VALUES
(43391433, 'Beemer', '6', 'Singapore Special', 'Medium', 'Male', 'A', 'Yes', 'Yes', 'Yes', '2019/01/09', 'Beemer used to be from Pulau Ubin, but due to complaints, his entire pack had to be removed. Our volunteers who frequent the island were boggled, as these dogs were so happy-go-lucky and in no way posed any nuisance or threat to humans. Thor and his pack were caught separately and impounded, and when they were reunited at shelter, it was such a sight to behold. Their faces instantly lit up, and tails started wagging, when they realised they are back together. Being new at shelter, this pack is still very unsure about the leash, and human contact – especially after their capture. Volunteers are working on gaining their trust again, but we’re sure they’ll come around soon, and be the lovable and carefree dogs that we know Ubin dogs always are!', 'https://sosd.org.sg/wp-content/uploads/2018/02/Beemer.jpg', 'https://sosd.org.sg/wp-content/uploads/2018/02/Beemer2.jpg'),
(43674141, 'Bindi', '7', 'Mixed Breed', 'Large', 'Female', 'A', 'Yes', 'Yes', 'Yes', '2019/03/01', 'Bindi has come a long way. When we brought Bindi in to treat her leg, she was aggressive like anything, growling at anyone who approaches, threatening to attack in fear. How things has changed. Bindi now enjoys going for walks, and enjoys the affection and company of the humans she has come to know. However, she is not good with toddlers, and would do well in a small family with no young children.', 'https://sosd.org.sg/wp-content/uploads/2014/11/Bindi.jpg', 'https://sosd.org.sg/wp-content/uploads/2014/11/Bindi3.jpg'),
(43674230, 'Harley', '8', 'Singapore Special', 'Medium', 'Male', 'A', 'Yes', 'Yes', 'Yes', '2019/01/12', 'Harley used to be from Pulau Ubin, but due to complaints, his entire pack had to be removed. Our volunteers who frequent the island were boggled, as these dogs were so happy-go-lucky and in no way posed any nuisance or threat to humans. Thor and his pack were caught separately and impounded, and when they were reunited at shelter, it was such a sight to behold. Their faces instantly lit up, and tails started wagging, when they realised they are back together. Being new at shelter, this pack is still very unsure about the leash, and human contact – especially after their capture. Volunteers are working on gaining their trust again, but we’re sure they’ll come around soon, and be the lovable and carefree dogs that we know Ubin dogs always are!', 'https://sosd.org.sg/wp-content/uploads/2018/02/Harley.jpg', 'https://sosd.org.sg/wp-content/uploads/2018/02/Harley.jpg'),
(43943559, 'Skippy', '10', 'Singapore Special', 'Medium', 'Female', 'A', 'Yes', 'Yes', 'Yes', '2019/01/14', 'By far the most affectionate dog in the shelter, Skippy charms every volunteer not just with her loving gaze but also with her smooth and wavy locks of fur. As she was born and raised in shelter, shelter is the only place she feels safe in. Besides, in the first 3 years of her life, Skippy was never taken out for walks out of her kennel. In turn, she is terrified of rainy days, and displayed fear aggression in apartment-living, when we first sent her to an adopter. We hope that she will be adopted someday, but that would require lots of work from all members of the adopters family, to gain her trust, so that she feels safe in their company, despite being in a foreign place.', 'https://sosd.org.sg/wp-content/uploads/2015/08/DSC_4180.jpg', 'https://sosd.org.sg/wp-content/uploads/2015/01/Skippy2.jpg'),
(43762912, 'Thor', '7', 'Singapore Special', 'Medium', 'Male', 'A', 'Yes', 'Yes', 'Yes', '2019/01/22', 'Thor used to be from Pulau Ubin, but due to complaints, his entire pack had to be removed. Our volunteers who frequent the island were boggled, as these dogs were so happy-go-lucky and in no way posed any nuisance or threat to humans. Thor and his pack were caught separately and impounded, and when they were reunited at shelter, it was such a sight to behold. Their faces instantly lit up, and tails started wagging, when they realised they are back together.', 'https://sosd.org.sg/wp-content/uploads/2018/02/Thor.jpg', 'https://sosd.org.sg/wp-content/uploads/2018/02/Thor2.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
