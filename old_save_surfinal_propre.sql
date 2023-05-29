-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 24, 2020 at 12:25 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oldbdd`
--

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `idSave` int(11) NOT NULL,
  `nomSave` varchar(100) NOT NULL,
  `passSave` varchar(100) NOT NULL,
  `idGroupeSaveEtre` int(11) NOT NULL,
  `idEtre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deskEtre`
--

CREATE TABLE `deskEtre` (
  `idDesk` int(11) NOT NULL,
  `nomDesk` varchar(1000) NOT NULL,
  `idEtre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deskEtre`
--

INSERT INTO `deskEtre` (`idDesk`, `nomDesk`, `idEtre`) VALUES
(1, 'Le menu du debut', 100);

-- --------------------------------------------------------

--
-- Table structure for table `etre`
--

CREATE TABLE `etre` (
  `idEtre` int(11) NOT NULL,
  `nomEtre` varchar(100) NOT NULL,
  `groupeParent` int(11) DEFAULT NULL,
  `groupeEnfant` int(11) DEFAULT NULL,
  `groupeSite` int(11) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etre`
--

INSERT INTO `etre` (`idEtre`, `nomEtre`, `groupeParent`, `groupeEnfant`, `groupeSite`, `type`) VALUES
(100, 'menu', 100, 100, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groupeCom`
--

CREATE TABLE `groupeCom` (
  `idGroupeCom` int(11) NOT NULL,
  `idCom` int(11) NOT NULL,
  `nomCom` varchar(1000) NOT NULL,
  `idEtreEmeteru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groupeEnfant`
--

CREATE TABLE `groupeEnfant` (
  `idGroupeEnfant` int(11) NOT NULL,
  `idEtre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groupeHash`
--

CREATE TABLE `groupeHash` (
  `idGroupeHash` int(11) NOT NULL,
  `idHash` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groupeParent`
--

CREATE TABLE `groupeParent` (
  `idGroupeParent` int(11) NOT NULL,
  `idEtre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groupeSaveEtre`
--

CREATE TABLE `groupeSaveEtre` (
  `idGroupeSaveEtre` int(11) NOT NULL,
  `idEtre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groupeSite`
--

CREATE TABLE `groupeSite` (
  `idGroupeSite` int(11) NOT NULL,
  `idSite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hash`
--

CREATE TABLE `hash` (
  `idHash` int(11) NOT NULL,
  `nomHash` varchar(100) NOT NULL,
  `idGroupeCom` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `idSite` int(11) NOT NULL,
  `idGroupeHash` int(11) DEFAULT NULL,
  `nomAdresse` varchar(1000) NOT NULL,
  `nomSite` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`idSave`);

--
-- Indexes for table `deskEtre`
--
ALTER TABLE `deskEtre`
  ADD PRIMARY KEY (`idDesk`);

--
-- Indexes for table `etre`
--
ALTER TABLE `etre`
  ADD PRIMARY KEY (`idEtre`);

--
-- Indexes for table `groupeCom`
--
ALTER TABLE `groupeCom`
  ADD PRIMARY KEY (`idCom`);

--
-- Indexes for table `hash`
--
ALTER TABLE `hash`
  ADD PRIMARY KEY (`idHash`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`idSite`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `idSave` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deskEtre`
--
ALTER TABLE `deskEtre`
  MODIFY `idDesk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `etre`
--
ALTER TABLE `etre`
  MODIFY `idEtre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `groupeCom`
--
ALTER TABLE `groupeCom`
  MODIFY `idCom` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hash`
--
ALTER TABLE `hash`
  MODIFY `idHash` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `idSite` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
