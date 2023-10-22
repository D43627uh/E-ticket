-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2018 at 02:11 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `onpoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `username` varchar(10) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `secretword` varchar(15) NOT NULL,
  `dateadded` date NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`username`, `firstname`, `password`, `secretword`, `dateadded`) VALUES
('syd', 'Sydney', 'cabdbb2cfac64b083b527a7821276143', 'AmSydney', '2015-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `movieID` int(15) NOT NULL AUTO_INCREMENT,
  `moviedate` date NOT NULL,
  `moviename` varchar(30) NOT NULL,
  `charges` int(5) NOT NULL,
  `description` text NOT NULL,
  `venuename` varchar(20) NOT NULL,
  `restriction` varchar(15) NOT NULL,
  `showtime` varchar(50) NOT NULL,
  PRIMARY KEY (`movieID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieID`, `moviedate`, `moviename`, `charges`, `description`, `venuename`, `restriction`, `showtime`) VALUES
(38, '2015-12-22', 'Hey Mama', 0, 'Love, hate and sex', 'Hall A', 'OVER18', '13:00:00,19:00:00'),
(39, '2015-12-22', 'Sensei', 0, 'War', 'Hall C', 'OVER18', '13:00:00,19:00:00'),
(40, '2015-12-16', 'Spectre', 250, 'Violence', 'Hall A', 'OVER18', '13:00:00'),
(41, '2016-01-12', 'King Kong', 300, 'Hello', 'Hall B', 'OVER18', '13:00:00,19:00:00'),
(42, '2015-12-09', '12 years a slave', 400, 'Lupita', 'Hall B', 'PG', '13:00:00,16:00:00'),
(43, '2015-12-16', 'Spectre one', 250, 'Description', 'Hall B', 'PG', '13:00:00'),
(44, '2016-09-14', '24', 200, 'ghgjhgjh', 'Hall B', 'PG', '13:00:00'),
(45, '2017-07-02', 'the november man', 50, 'gvajax;sclsdkj', 'Hall B', 'PG', '16:00:00'),
(46, '2017-07-02', 'Denof thieves', 50, 'gfhjjk', 'Hall A', 'PG', '19:00:00'),
(47, '2017-07-02', 'Deuces', 50, 'fygiu', 'Hall D', 'PG', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `transactionID` varchar(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  PRIMARY KEY (`transactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`transactionID`, `amount`, `phone`) VALUES
('12345', 400, '0717429885'),
('etrruyiuh', 250, '5547689'),
('JBE323', 300, '0706670225'),
('JBE324', 300, '0706670225'),
('jdfhdfk', 744, '0712447304'),
('JJKE', 250, '0717429885'),
('JQUERY453', 500, '0717646894'),
('JQUERYERYH', 300, '+0717429885');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_purchase`
--

CREATE TABLE IF NOT EXISTS `ticket_purchase` (
  `transac_id` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `payment_date` datetime NOT NULL,
  `qty` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  PRIMARY KEY (`transac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_purchase`
--

INSERT INTO `ticket_purchase` (`transac_id`, `username`, `phone`, `payment_date`, `qty`, `total_amount`) VALUES
('12345', 'stano', '0717429885', '2015-12-01 12:07:38', 1, 0),
('hkdkd', 'madillu', '+254727429885', '2015-12-01 03:00:52', 0, 0),
('J02YTRA', 'madillu', '+2547174299885', '2015-12-01 03:10:33', 1, 0),
('JBE323', 'madillu', '0706670225', '2015-12-01 10:17:49', 1, 0),
('JDJFSSF', 'madillu', '0727635423', '2015-12-01 03:28:59', 0, 0),
('JJKE', 'madillu', '0717429885', '2015-12-01 10:37:13', 1, 0),
('JKDHDF', 'madillu', '0717429885', '2015-12-01 00:00:00', 0, 0),
('JKISFASF', 'madillu', '04920492', '2015-12-01 03:24:54', 1, 7),
('JKLMANdhs', 'madillu', '+254727429885', '2015-12-01 02:59:36', 0, 0),
('JKLMANOA', 'madillu', '+254727429885', '2015-12-01 02:58:09', 0, 0),
('JQUERYWTE', 'madillu', '+2547174299885', '2015-12-01 03:06:45', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(15) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` datetime NOT NULL,
  `secretword` varchar(15) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `firstname`, `lastname`, `phone`, `email`, `password`, `registration_date`, `secretword`) VALUES
('cheruz', 'CHERUIYOT', 'BRAMWEL', '0725932460', 'bramwelcheruiyot4@gm', '9606624e790238e4cb511e2d4a347eec', '2017-07-03 04:21:50', ''),
('Deno', 'dennis', 'bett', '345465576', 'fdygukj', 'ef29638a76ef0fb4c6c9eb175163ce99', '2017-07-02 04:34:25', ''),
('for', 'xffcg', 'fhgf', '54546', 'ghfhjjk', '3e590eb856e76a973257133e0dfb171a', '2017-07-02 02:35:39', ''),
('jbi22', 'Jane', 'Bitutu', '0727942145', 'jbitutu@yahoo.com', '1afe69ac482181b35995b918a77d4d32', '2015-11-29 15:14:32', ''),
('jos', 'jos', 'nkxcvmkls', '845834934', '42342352', '16c3cdcfdc7df6ab9163aafac8bfdff6', '2016-09-17 17:07:31', ''),
('madillu', 'Sydney', 'Aranga', '+254717429885', 'sydneyarangomondi@gm', 'cabdbb2cfac64b083b527a7821276143', '2015-12-01 02:54:19', ''),
('MORG', 'MORGAN', 'ROTICH', '3567', 'FTHYH', '052e597470d30d47c5377f53ac2fb84f', '2017-03-29 16:20:14', ''),
('stano', 'Stanley', 'Wanjau', '0704568952', 'stanwanjau@gmail.com', 'c7656ce3fbb462c82bad4e11fc7f4165', '2015-12-01 12:00:17', ''),
('vee', 'Vera ', 'Sidika', '079836367', 'veravee@sidika.com', '0951ba11ae1427612d3de66ed5dafacc', '2015-11-29 16:26:22', '');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE IF NOT EXISTS `venues` (
  `venueID` int(15) NOT NULL AUTO_INCREMENT,
  `venuename` varchar(15) NOT NULL,
  `capacity` int(10) NOT NULL,
  `address` varchar(15) NOT NULL,
  PRIMARY KEY (`venueID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
