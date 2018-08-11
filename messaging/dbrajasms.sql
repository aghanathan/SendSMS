-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 10, 2018 at 07:28 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbrajasms`
--

-- --------------------------------------------------------

--
-- Table structure for table `messagelog`
--

DROP TABLE IF EXISTS `messagelog`;
CREATE TABLE IF NOT EXISTS `messagelog` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `toNumber` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `sendDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messagelog`
--

INSERT INTO `messagelog` (`ID`, `toNumber`, `message`, `sendDate`, `status`) VALUES
(201, '6285216427652', 's', '2018-08-10 19:19:04', 'ApiKey not register'),
(200, '6285216427652', '4', '2018-08-10 19:17:44', 'ApiKey not register');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `apiKey` varchar(100) NOT NULL,
  `ipServer` varchar(100) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`ID`, `apiKey`, `ipServer`, `phoneNumber`) VALUES
(1, 'API Key', 'http://45.76.156.114', '6285216427652');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
