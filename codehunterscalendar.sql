-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2015 at 06:30 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codehunterscalendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `contact1` int(11) NOT NULL,
  `contact2` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `firstname`, `lastname`, `status`, `contact1`, `contact2`, `email`, `company`) VALUES
(2, 'a', 'a', 1, 0, 0, 'a@a.com', ''),
(3, 'Nifal', 'Nizar', 1, 0, 0, 'nifal.nizar@hotmail.com', ''),
(4, 'nifal', 'nizar', 1, 0, 0, 'nifal@hotmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `member_password_map`
--

CREATE TABLE IF NOT EXISTS `member_password_map` (
  `memberid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_password_map`
--

INSERT INTO `member_password_map` (`memberid`, `username`, `password`, `type`) VALUES
(1, 'nf', '123', 1),
(2, 'hjhkjh', 'kjhkjhkj', 1),
(3, 'nifal.nizar@hotmail.', 'f03112971b8547bdf1bf', 1),
(99999, 'jhjhjhjh', 'hhhhhhhhhhhhhhhhhhhh', 8),
(4, 'nifal@hotmail.com', '76419c58730d9f35de7ac538c2fd6737', 1);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `timeslotid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `starttime` int(4) NOT NULL,
  `endtime` int(4) NOT NULL,
  `createddate` date NOT NULL,
  `createdby` int(11) NOT NULL,
  `notetype` int(11) NOT NULL,
  `location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `subject`, `description`, `timeslotid`, `status`, `startdate`, `enddate`, `starttime`, `endtime`, `createddate`, `createdby`, `notetype`, `location`) VALUES
(1, 'Project Estimation', 'June to July', 1, 1, '2015-06-14', '2015-07-16', 1100, 1245, '2015-06-14', 2, 1, 0),
(2, 'Planning', 'Two days', 0, 1, '2015-06-01', '2015-06-02', 0, 0, '2015-06-01', 2, 1, 0),
(3, 'Hidhaifa Bday', '', 0, 1, '0000-07-15', '0000-07-15', 0, 0, '0000-00-00', 2, 3, 0),
(4, 'WorkShop', '5Days - 7 Hours', 1, 1, '2015-06-25', '2015-06-30', 1000, 1700, '0000-00-00', 2, 1, 0),
(5, 'Thwaraka Yogarajah', '', 0, 1, '2015-07-12', '2015-07-12', 0, 0, '0000-00-00', 2, 3, 0),
(6, 'Deleted Event', '', 0, 0, '2015-07-01', '2015-07-14', 0, 0, '0000-00-00', 2, 1, 0),
(7, 'Shared Event', '', 0, 3, '2015-07-13', '2015-07-13', 0, 0, '2015-07-11', 2, 2, 0),
(8, 'Sprint 3 Meeting', 'Sprint 3 Meeting Description', 1, 1, '2015-07-12', '2015-07-12', 1000, 1100, '2015-07-12', 2, 2, 0),
(9, 'Nifal Nizar', '', 0, 1, '2015-07-13', '2015-07-13', 0, 0, '2015-07-12', 2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `note_attendies_map`
--

CREATE TABLE IF NOT EXISTS `note_attendies_map` (
  `noteid` int(11) NOT NULL,
  `attendieemail` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `note_host_map`
--

CREATE TABLE IF NOT EXISTS `note_host_map` (
  `noteid` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `note_image_map`
--

CREATE TABLE IF NOT EXISTS `note_image_map` (
  `noteid` int(11) NOT NULL,
  `imageid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `note_type`
--

CREATE TABLE IF NOT EXISTS `note_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `note_type`
--

INSERT INTO `note_type` (`id`, `description`) VALUES
(1, 'Meeting'),
(2, 'Note'),
(3, 'BirthDay'),
(4, 'Anniversary'),
(5, 'Other');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
