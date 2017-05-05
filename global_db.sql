-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2016 at 01:41 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `global_db`
--
CREATE DATABASE IF NOT EXISTS `global_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `global_db`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `level` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `picture`, `level`, `status`) VALUES
(1, 'Mr. Admin', 'contact@unichronic.com', 'cc03e747a6afbbcbf8be7668acfebee5', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'UniDating'),
(2, 'system_title', 'UniDating'),
(7, 'from_email', 'contact@unichronic.com'),
(8, 'from_name', 'Unichronic Systems'),
(9, 'SITE_OFFLINE', 'NO'),
(11, 'language', 'english');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
