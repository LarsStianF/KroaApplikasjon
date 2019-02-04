-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2019 at 03:04 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ansvarlig`
--

CREATE TABLE `ansvarlig` (
  `ID` smallint(6) NOT NULL,
  `Bar` tinyint(1) DEFAULT NULL,
  `Vakt` tinyint(1) DEFAULT NULL,
  `Crew` tinyint(1) DEFAULT NULL,
  `Teknisk` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `arrangement`
--

CREATE TABLE `arrangement` (
  `ID` smallint(6) NOT NULL,
  `Navn` varchar(50) DEFAULT NULL,
  `Dato` date DEFAULT NULL,
  `Tid_Start` varchar(10) DEFAULT NULL,
  `Tid_Slutt` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `arrangement_frivillig`
--

CREATE TABLE `arrangement_frivillig` (
  `Friv_ID` smallint(6) NOT NULL,
  `Arr_ID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crews`
--

CREATE TABLE `crews` (
  `ID` smallint(6) NOT NULL,
  `Bar` tinyint(1) DEFAULT NULL,
  `Vakt` tinyint(1) DEFAULT NULL,
  `Crew` tinyint(1) DEFAULT NULL,
  `Teknisk` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `frivillig`
--

CREATE TABLE `frivillig` (
  `ID` smallint(6) NOT NULL,
  `Fornavn` varchar(30) DEFAULT NULL,
  `Etternavn` varchar(30) DEFAULT NULL,
  `TlfNr` char(8) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Passord` varchar(20) DEFAULT NULL,
  `Enhet` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ønsket_frivillig`
--

CREATE TABLE `ønsket_frivillig` (
  `Friv_ID` smallint(6) NOT NULL,
  `Arr_ID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ansvarlig`
--
ALTER TABLE `ansvarlig`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `arrangement`
--
ALTER TABLE `arrangement`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `arrangement_frivillig`
--
ALTER TABLE `arrangement_frivillig`
  ADD PRIMARY KEY (`Friv_ID`,`Arr_ID`),
  ADD KEY `ID_idx` (`Arr_ID`);

--
-- Indexes for table `crews`
--
ALTER TABLE `crews`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `frivillig`
--
ALTER TABLE `frivillig`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ønsket_frivillig`
--
ALTER TABLE `ønsket_frivillig`
  ADD PRIMARY KEY (`Friv_ID`,`Arr_ID`),
  ADD KEY `ID_idx` (`Arr_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ansvarlig`
--
ALTER TABLE `ansvarlig`
  ADD CONSTRAINT `Ansv_ID` FOREIGN KEY (`ID`) REFERENCES `frivillig` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `arrangement_frivillig`
--
ALTER TABLE `arrangement_frivillig`
  ADD CONSTRAINT `AF_Arr_ID` FOREIGN KEY (`Arr_ID`) REFERENCES `arrangement` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `AF_Friv_ID` FOREIGN KEY (`Friv_ID`) REFERENCES `frivillig` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `crews`
--
ALTER TABLE `crews`
  ADD CONSTRAINT `Crews_ID` FOREIGN KEY (`ID`) REFERENCES `frivillig` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ønsket_frivillig`
--
ALTER TABLE `ønsket_frivillig`
  ADD CONSTRAINT `ØF_Arr_ID` FOREIGN KEY (`Arr_ID`) REFERENCES `arrangement` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ØF_Friv_ID` FOREIGN KEY (`Friv_ID`) REFERENCES `frivillig` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
