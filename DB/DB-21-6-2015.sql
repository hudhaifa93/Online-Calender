-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2015 at 08:54 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `calendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `birthday`
--

CREATE TABLE IF NOT EXISTS `birthday` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `createddate` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `firstname`, `lastname`, `status`, `contact1`, `contact2`, `email`, `company`) VALUES
(2, 'a', 'a', 1, 0, 0, 'a@a.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `member_birthday_map`
--

CREATE TABLE IF NOT EXISTS `member_birthday_map` (
  `id` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `birthdayid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member_password_map`
--

CREATE TABLE IF NOT EXISTS `member_password_map` (
  `memberid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_password_map`
--

INSERT INTO `member_password_map` (`memberid`, `username`, `password`, `type`) VALUES
(1, 'nf', '123', 1),
(2, 'hjhkjh', 'kjhkjhkj', 1);

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
  `createddate` date NOT NULL,
  `createdby` int(11) NOT NULL,
  `notetype` int(11) NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `subject`, `description`, `timeslotid`, `status`, `startdate`, `enddate`, `createddate`, `createdby`, `notetype`, `location`) VALUES
(1, 'Project Estimation', 'First you need to fully understand what it is you need to achieve. (Refer to my article; Project Management - Begin with the end in mind). Review the project/task in detail so that there are no "unknowns." Some difficult-to-understand, tricky problems that take the greatest amount of time to solve. The best way to review the job is to just list all component tasks in full detail.', 1, 1, '2015-06-14', '2015-06-16', '2015-06-14', 2, 1, 'NSBM, High Level Road, Nugegoda'),
(8, 'Planning', 'Planning (also called forethought) is the process of thinking about and organizing the activities required to achieve a desired goal. It involves the creation and maintenance of a plan, such as psychological aspects that require conceptual skills. There are even a couple of tests to measure someone’s capability of planning well. As such, planning is a fundamental property of intelligent behavior.', 0, 0, '2015-06-01', '2015-06-02', '2015-06-01', 2, 1, 'Colombo'),
(9, 'test1111', 'etsg', 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', 2, 1, 'test'),
(10, 'ghg', 'ghgh', 0, 0, '2015-06-25', '0000-00-00', '0000-00-00', 2, 1, 'hghgh'),
(11, 'ytuytu', 'ytuytu', 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', 2, 1, 'ytuytutyu'),
(12, '', '', 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', 2, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `note_attendies_map`
--

CREATE TABLE IF NOT EXISTS `note_attendies_map` (
  `noteid` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `note_type`
--

INSERT INTO `note_type` (`id`, `description`) VALUES
(1, 'Meeting'),
(2, 'Note');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE IF NOT EXISTS `timeslot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strattime` varchar(4) NOT NULL,
  `endtime` varchar(4) NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
