-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2013 at 04:06 AM
-- Server version: 5.5.30-30.1
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `deltanit_tamil`
--

-- --------------------------------------------------------

--
-- Table structure for table `tamil_questions`
--

CREATE TABLE IF NOT EXISTS `tamil_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `levelname` varchar(110) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `question` varchar(110) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `images` text NOT NULL,
  `answer` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tamil_questions`
--

INSERT INTO `tamil_questions` (`id`, `level`, `levelname`, `question`, `images`, `answer`) VALUES
(1, 0, 'zero1', 'à®¯à®¾à®°à¯ à®‡à®µà®©à¯ ?', '0.jpg', 'à®¤à®®à®¿à®´à¯'),
(2, 1, 'one', '18.9398 à®µ 72.8355 à®•à®¿', '01b.jpg,01.jpg', 'à®°à®œà®¿à®©à®¿à®•à®¾à®¨à¯à®¤à¯'),
(3, 2, 'two', 'à®¤à¯‡à®Ÿà®²à¯', '02.jpg,02b.jpg,02d.jpg', 'à®•à¯‚à®•à®¿à®³à¯'),
(4, 3, 'à®‰à®±à¯ˆà®¯à¯‚à®°à¯', '', '3/1.jpg,3/2.jpg', 'à®•à®¿à®³à®¿à®µà®²à®µà®©à¯'),
(5, 4, 'four', 'à®®à®©à¯à®±à®®à¯', '4/1.jpg,4/2.jpg,4/3.jpg', 'à®à®±à¯à®¤à®´à¯à®µà®²à¯'),
(6, 5, 'five', '', '5/1.jpg,5/2.jpg,5/3.jpg', 'à®Ÿà®¿à®²à¯à®²à®¿ '),
(7, 6, 'six', '', '6/1.jpg,6/2.jpg,6/3.jpg', 'à®•à®°à®¿à®•à®¾à®²à®©à¯'),
(8, 7, 'seven', '', '7/1.jpg,7/2.jpg', 'à®®à®¾à®¤à®™à¯à®•à®¿'),
(9, 8, 'à®Žà®Ÿà¯à®Ÿà¯', '', '8/1.jpg,8/2.jpg,8/3.jpg,8/4.jpg', 'à®Žà®Ÿà¯à®Ÿà¯à®¤à¯Šà®•à¯ˆ'),
(10, 9, 'nine', '', '9/1.jpg,9/2.jpg,9/3.jpg,9/4a.jpg,9/4b.jpg,9/4c.jpg', 'à®ªà®šà¯à®ªà®¤à®¿');

-- --------------------------------------------------------

--
-- Table structure for table `tamil_submits`
--

CREATE TABLE IF NOT EXISTS `tamil_submits` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `correct` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tamil_submits`
--

INSERT INTO `tamil_submits` (`id`, `level`, `time`, `correct`) VALUES
(2, 1, '0000-00-00 00:00:00', 0),
(2, 1, '2013-08-28 10:54:01', 0),
(2, 1, '2013-08-28 10:59:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tamil_users`
--

CREATE TABLE IF NOT EXISTS `tamil_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `type` varchar(5) NOT NULL DEFAULT 'cms',
  `level` int(11) NOT NULL DEFAULT '0',
  `0` int(11) NOT NULL DEFAULT '0',
  `1` int(11) NOT NULL DEFAULT '0',
  `2` int(11) NOT NULL DEFAULT '0',
  `3` int(11) NOT NULL DEFAULT '0',
  `4` int(11) NOT NULL DEFAULT '0',
  `5` int(11) NOT NULL DEFAULT '0',
  `6` int(11) NOT NULL DEFAULT '0',
  `7` int(11) NOT NULL DEFAULT '0',
  `8` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tamil_users`
--

INSERT INTO `tamil_users` (`id`, `name`, `email`, `phone`, `pass`, `type`, `level`, `0`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`) VALUES
(1, 'para', 'pass', '654', 'd41d8cd98f00b204e9800998ecf8427e', 'cms', 5, 1, 8, 1, 1, 1, 0, 0, 0, 0),
(2, 'test', 'test@test.com', '654', 'd41d8cd98f00b204e9800998ecf8427e', 'cms', 2, 2, 3, 2, 0, 0, 0, 0, 0, 0),
(3, 'hello', 'hello@hello.com', '234', 'd41d8cd98f00b204e9800998ecf8427e', 'cms', 2, 1, 1, 0, 0, 0, 0, 0, 0, 0),
(4, 'asdf', 'asdf@asdf.com', '987', 'd41d8cd98f00b204e9800998ecf8427e', 'cms', 9, 1, 1, 1, 1, 1, 1, 2, 1, 1),
(5, 'qwer', 'qwer@qwer.com', '98', 'd41d8cd98f00b204e9800998ecf8427e', 'cms', 9, 1, 1, 1, 1, 1, 2, 1, 1, 1),
(6, 'tamil', 'tamilarasan21@outlook.com', '9600704202', 'd41d8cd98f00b204e9800998ecf8427e', 'cms', 2, 1, 3, 0, 0, 0, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
