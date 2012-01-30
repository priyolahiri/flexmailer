-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 29, 2012 at 11:06 AM
-- Server version: 5.5.19
-- PHP Version: 5.3.9-1~lucid+2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `flexmailer`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `jobname` varchar(16) NOT NULL,
  `campaignname` varchar(16) NOT NULL,
  `status` varchar(16) NOT NULL DEFAULT 'created',
  `schedule` int(12) NOT NULL DEFAULT '0',
  `candidates` int(12) NOT NULL,
  `sent` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `maillists`
--

CREATE TABLE IF NOT EXISTS `maillists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listname` varchar(255) NOT NULL,
  `candidates` int(12) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(40) NOT NULL,
  `last_activity` int(10) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `last_activity`, `data`) VALUES
('aekIivQfTMZFPFuhEop2H3o0YM8A09i6k39djCSM', 1327834743, 'a:5:{s:5:":new:";a:0:{}s:5:":old:";a:0:{}s:10:"csrf_token";s:40:"C8UEko2QnYtStr4Yq6MAHYW4M9Xz5TelbLvfhad0";s:15:"laravel_user_id";s:1:"1";s:12:"campaignname";s:5:"test1";}'),
('DSnY00l62JhkMQNxmOiQS44utlqivNJHv7pdLymv', 1327863673, 'a:7:{s:5:":new:";a:0:{}s:5:":old:";a:0:{}s:10:"csrf_token";s:40:"vuc0tA9Pd6BfKPBBnDy6RW2wiay4ePNVopaQVgNO";s:15:"laravel_user_id";s:1:"1";s:12:"campaignname";s:9:"wikipedia";s:8:"uploadid";s:1:"1";s:10:"uploadlist";s:55:"/var/www/flexmailer/public/upload/admin_email_fwid.xlsx";}'),
('Gjd1mxLD6McJbWybzWugeRNRSrADmovGxpMdF0Wa', 1327855390, 'a:4:{s:5:":new:";a:0:{}s:5:":old:";a:0:{}s:10:"csrf_token";s:40:"TUZ7nqe3KVTKVocLBfXzA7fcvm45RaIEx95kdN8O";s:15:"laravel_user_id";s:1:"1";}'),
('kjMsOzI4tqSxBLiENJPK0FqtMKYzcCvQy8SQjDmA', 1327834447, 'a:3:{s:5:":new:";a:0:{}s:5:":old:";a:0:{}s:10:"csrf_token";s:40:"qIGR8U8EgmczRqZ3D3IeJXNbTogzbK4uQW1DSwur";}'),
('KQwfX4NS0eUqajtpDcChq2eLtLHhV1m2xab5EE2A', 1327846930, 'a:4:{s:5:":new:";a:0:{}s:5:":old:";a:0:{}s:10:"csrf_token";s:40:"uf1XjtEyyaJsPH8X8RlT3BCTGSbTlvNEKpJr2VA2";s:15:"laravel_user_id";s:1:"1";}'),
('zk3woEIpqrls7bIKhokka96a24OLJVlCPJBw6yM8', 1327853388, 'a:3:{s:5:":new:";a:0:{}s:5:":old:";a:0:{}s:10:"csrf_token";s:40:"paMDsA1FbpaMKyuEGyyBPoUIeIaR9Pxw0XjKSr83";}');

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE IF NOT EXISTS `shares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `maillist_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(6) NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'ce91658b92c0365faa7376c17cbb67d0', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
