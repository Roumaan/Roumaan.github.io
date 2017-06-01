-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2017 at 02:15 PM
-- Server version: 5.5.25
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projectbd`
--

-- --------------------------------------------------------

--
-- Table structure for table `animations`
--

CREATE TABLE IF NOT EXISTS `animations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `styleFile` text NOT NULL,
  `author` text NOT NULL,
  `rate` int(11) NOT NULL DEFAULT '0',
  `animationsCount` int(11) NOT NULL DEFAULT '1',
  `time` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `animations`
--

INSERT INTO `animations` (`ID`, `name`, `styleFile`, `author`, `rate`, `animationsCount`, `time`) VALUES
(1, 'Набор анимаций №1', '..\\animations\\anim1.css', 'Admin', 2159, 3, '2017-06-01 13:11:52'),
(2, 'Набор анимаций №2', '..\\animations\\anim2.css', 'Admin', 731, 4, '2017-06-01 13:12:03'),
(3, 'Набор анимаций №3', '..\\animations\\anim3.css', 'Admin', 993, 3, '2017-06-01 13:12:11');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
