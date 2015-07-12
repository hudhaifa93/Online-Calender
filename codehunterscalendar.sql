
CREATE database IF NOT EXISTS `codehunterscalendar`;
use `codehunterscalendar`;
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
(1, 'Project Estimation', '', 1, 1, '2015-06-14', '2015-06-16', 0, 0, '2015-06-14', 2, 1, 0),
(8, 'Planning', '', 0, 0, '2015-06-01', '2015-06-02', 0, 0, '2015-06-01', 2, 1, 0),
(9, 'test1111', 'etsg', 0, 0, '0000-00-00', '0000-00-00', 0, 0, '0000-00-00', 2, 2, 0),
(10, 'ghg', 'ghgh', 0, 0, '2015-06-25', '0000-00-00', 0, 0, '0000-00-00', 2, 1, 0),
(11, 'ytuytu', 'ytuytu', 0, 0, '0000-06-25', '0000-00-00', 0, 0, '0000-00-00', 2, 3, 0),
(12, '', '', 0, 0, '0000-00-00', '0000-00-00', 0, 0, '0000-00-00', 2, 1, 0),
(13, 'GGGG', 'ghghghg', 0, 1, '2015-06-02', '2015-06-02', 0, 0, '2015-07-11', 2, 2, 0),
(14, 'XXXXXXXXXXXXXXXX', 'mnbmnbmbnm', 0, 1, '2015-07-01', '2015-07-01', 0, 0, '2015-07-12', 2, 2, 0),
(15, 'Nifakjk  ', '', 0, 1, '2015-07-12', '2015-07-12', 0, 0, '2015-07-12', 2, 3, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `note_type`
--

INSERT INTO `note_type` (`id`, `description`) VALUES
(1, 'Meeting'),
(2, 'Note'),
(3, 'BirthDay');