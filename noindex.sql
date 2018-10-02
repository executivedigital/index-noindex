-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2018 at 06:24 PM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noindex`
--

-- --------------------------------------------------------

--
-- Table structure for table `live_sites`
--

CREATE TABLE `live_sites` (
  `live_id` int(5) NOT NULL,
  `live_url` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `live_sites`
--

INSERT INTO `live_sites` (`live_id`, `live_url`, `status`) VALUES
(1, 'https://www.wellaway.com', 1),
(2, 'http://accordbusinesscoaching.com/', 1),
(3, 'https://www.americordblood.com/', 1),
(4, 'https://www.ampfloracel.com/', 1),
(5, 'https://arizonalandpartners.com/', 1),
(6, 'https://www.az420card.com/', 1),
(7, 'https://www.badhabitstattoos.com/', 1),
(8, 'https://boqueriarestaurant.com/', 1),
(9, 'https://bruceturkel.com/', 1),
(10, 'https://burgermeistermia.com/', 1),
(13, 'sfsdfsdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stage_sites`
--

CREATE TABLE `stage_sites` (
  `stage_id` int(5) NOT NULL,
  `stage_url` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stage_sites`
--

INSERT INTO `stage_sites` (`stage_id`, `stage_url`, `status`) VALUES
(1, 'http://wellawaystage.wpengine.com', 1),
(2, 'http://accordbusiness.staging.wpengine.com/', 1),
(3, 'https://americordblood.wpengine.com/', 1),
(4, 'http://ampfloracel.staging.wpengine.com/', 1),
(5, 'http://arizonalandpar.staging.wpengine.com/', 1),
(6, 'http://az420card.staging.wpengine.com/', 1),
(7, 'http://bhabitstattoo.staging.wpengine.com/', 1),
(8, 'http://boqueria.staging.wpengine.com/', 1),
(9, 'http://bruceturkel.staging.wpengine.com/', 1),
(10, 'https://phoenixtowingservice.com/', 1),
(11, 'sdfsdf', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `live_sites`
--
ALTER TABLE `live_sites`
  ADD PRIMARY KEY (`live_id`);

--
-- Indexes for table `stage_sites`
--
ALTER TABLE `stage_sites`
  ADD PRIMARY KEY (`stage_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `live_sites`
--
ALTER TABLE `live_sites`
  MODIFY `live_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `stage_sites`
--
ALTER TABLE `stage_sites`
  MODIFY `stage_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
