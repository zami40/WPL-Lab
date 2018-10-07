-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2017 at 06:01 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cseku_wpl_2017_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `ID` varchar(40) NOT NULL,
  `ShortTitle` varchar(50) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Link` varchar(200) NOT NULL,
  `EventDate` date NOT NULL,
  `Location` varchar(30) NOT NULL,
  `IsVisible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `ID` varchar(40) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `CreationDate` date NOT NULL,
  `HappeningDate` date NOT NULL,
  `Tag` varchar(300) NOT NULL,
  `IsVisible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
