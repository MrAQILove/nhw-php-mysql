-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2017 at 10:09 AM
-- Server version: 5.5.48-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cwaustra_members`
--

-- --------------------------------------------------------

--
-- Table structure for table `CWADBMembers_tblUsers`
--

CREATE TABLE IF NOT EXISTS `CWADBMembers_tblUsers` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `Members_tblState`
--

CREATE TABLE IF NOT EXISTS `Members_tblState` (
  `StateID` int(11) NOT NULL AUTO_INCREMENT,
  `State` varchar(255) NOT NULL,
  PRIMARY KEY (`StateID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `NHW_tblDesignation`
--

CREATE TABLE IF NOT EXISTS `NHW_tblDesignation` (
  `DesignationID` int(11) NOT NULL AUTO_INCREMENT,
  `Designation` varchar(255) NOT NULL,
  PRIMARY KEY (`DesignationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `NHW_tblRecipient`
--

CREATE TABLE IF NOT EXISTS `NHW_tblRecipient` (
  `RecipientID` int(11) NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(255) NOT NULL,
  `Other_Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Suburb` varchar(255) NOT NULL,
  `StateID` int(11) NOT NULL,
  `Postcode` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` int(11) NOT NULL,
  `Subscription` varchar(255) NOT NULL,
  `RegDiv_ID` int(11) DEFAULT NULL,
  `NHWArea` varchar(255) NOT NULL,
  `DesignationID` int(11) DEFAULT NULL,
  `DXAddress` varchar(255) NOT NULL,
  `Copies` int(11) NOT NULL,
  PRIMARY KEY (`RecipientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1349 ;

-- --------------------------------------------------------

--
-- Table structure for table `NHW_tblRegDiv`
--

CREATE TABLE IF NOT EXISTS `NHW_tblRegDiv` (
  `RegDiv_ID` int(11) NOT NULL AUTO_INCREMENT,
  `RegDiv_Name` varchar(255) NOT NULL,
  `RegDiv_Desc` varchar(255) NOT NULL,
  PRIMARY KEY (`RegDiv_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
