

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




 -- DROP DATABASE IF IT EXISTS:
DROP DATABASE IF EXISTS group11;




-- CREATE DATABASE:
CREATE DATABASE group11 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;








-- ###########################################################################
-- DELETE ALL EXISTING TABLES
-- ###########################################################################

-- DROP ALL TABLES IF THEY EXIST:
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS ansvarlig;
DROP TABLE IF EXISTS arrangement;
DROP TABLE IF EXISTS arrangement_frivillig;
DROP TABLE IF EXISTS crews;
DROP TABLE IF EXISTS frivillig;
DROP TABLE IF EXISTS ønsket_frivillig;

SET FOREIGN_KEY_CHECKS=1;

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
  `Passord` varchar(100) DEFAULT NULL,
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arrangement`
--
ALTER TABLE `arrangement`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frivillig`
--
ALTER TABLE `frivillig`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ansvarlig`
--
ALTER TABLE `ansvarlig`
  ADD CONSTRAINT `Ansv_ID` FOREIGN KEY (`ID`) REFERENCES `frivillig` (`ID`);

--
-- Constraints for table `arrangement_frivillig`
--
ALTER TABLE `arrangement_frivillig`
  ADD CONSTRAINT `AF_Arr_ID` FOREIGN KEY (`Arr_ID`) REFERENCES `arrangement` (`ID`),
  ADD CONSTRAINT `AF_Friv_ID` FOREIGN KEY (`Friv_ID`) REFERENCES `frivillig` (`ID`);

--
-- Constraints for table `crews`
--
ALTER TABLE `crews`
  ADD CONSTRAINT `Crews_ID` FOREIGN KEY (`ID`) REFERENCES `frivillig` (`ID`);

--
-- Constraints for table `ønsket_frivillig`
--
ALTER TABLE `ønsket_frivillig`
  ADD CONSTRAINT `ØF_Arr_ID` FOREIGN KEY (`Arr_ID`) REFERENCES `arrangement` (`ID`),
  ADD CONSTRAINT `ØF_Friv_ID` FOREIGN KEY (`Friv_ID`) REFERENCES `frivillig` (`ID`);


INSERT INTO Arrangement (Navn, Dato, Tid_Start, Tid_Slutt) VALUES
('Quiz', '2019-01-22', '1900', '2300'),
('Hellbillies', '2019-01-27', '2000', '0230'),
('Afterski', '2019-03-14', '1900', '0130'),
('X-russ', '2019-04-04', '1900', '0130');

INSERT INTO Frivillig (Fornavn, Etternavn, TlfNr, Email, Passord, Enhet) VALUES
('root', 'Sunde', 92928383, 'root@test.no', md5('Root123'), 0),
('Kari', 'Øvrebø', 83839292, 'Kari@test.no', md5('Root123'), 3),
('Kim', 'Possible', 77775555, 'Possible@test.no', md5('Root123'), 5),
('Trym', 'Host', 88884444, 'Host@test.no', md5('Root123'), 1);

INSERT INTO Crews (ID, Bar, Vakt, Crew, Teknisk) VALUES
(1, 0, 1, 0, 1),
(2, 1, 0, 1, 0),
(3, 1, 0, 0, 1),
(4, 0, 1, 1, 0);

INSERT INTO Ansvarlig (ID, Bar, Vakt, Crew, Teknisk) VALUES
(1, 0, 1, 0, 0),
(2, 1, 0, 0, 0),
(3, 0, 0, 0, 1),
(4, 0, 0, 1, 0);

INSERT INTO Arrangement_Frivillig (Friv_ID, Arr_ID) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 1);

INSERT INTO ønsket_frivillig (Friv_ID, Arr_ID) VALUES
(1, 3),
(2, 4),
(3, 4),
(4, 3);
COMMIT;