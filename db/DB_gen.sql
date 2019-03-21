@@ -6,24 +6,14 @@ START TRANSACTION;
SET time_zone = "+00:00";




 -- DROP DATABASE IF IT EXISTS:
DROP DATABASE IF EXISTS group11;




-- CREATE DATABASE:
CREATE DATABASE group11 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- DROP ALL TABLES IF THEY EXIST:
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS manager;
DROP TABLE IF EXISTS event;
DROP TABLE IF EXISTS event_volunteer;
DROP TABLE IF EXISTS crew;
DROP TABLE IF EXISTS volunteer;
DROP TABLE IF EXISTS want_volunteer;

SET FOREIGN_KEY_CHECKS=1;

-- --------------------------------------------------------

-- Table structure for table `volunteer`

CREATE TABLE volunteer (
  ID smallint(6) NOT NULL AUTO_INCREMENT,
  Firstname varchar(30) DEFAULT NULL,
  Lastname varchar(30) DEFAULT NULL,
  nr char(8) DEFAULT NULL,
  Email varchar(30) DEFAULT NULL,
  Password varchar(100) DEFAULT NULL,
  Unit smallint(6) DEFAULT NULL,
  CONSTRAINT volunteer_ID PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE event (
  ID smallint(6) NOT NULL AUTO_INCREMENT,
  Name varchar(50) DEFAULT NULL,
  Date date DEFAULT NULL,
  Time_Start varchar(10) DEFAULT NULL,
  Time_End varchar(10) DEFAULT NULL,
  CONSTRAINT eve_ID PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `manager`

CREATE TABLE manager (
  ID smallint(6) NOT NULL,
  Bar tinyint(1) DEFAULT NULL,
  Security tinyint(1) DEFAULT NULL,
  Crew tinyint(1) DEFAULT NULL,
  Tech tinyint(1) DEFAULT NULL,
  CONSTRAINT man_ID PRIMARY KEY (ID),
  CONSTRAINT volunt_ID FOREIGN KEY (ID) REFERENCES volunteer (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

CREATE TABLE crew (
  ID smallint(6) NOT NULL,
  Bar tinyint(1) DEFAULT NULL,
  Security tinyint(1) DEFAULT NULL,
  Crew tinyint(1) DEFAULT NULL,
  Tech tinyint(1) DEFAULT NULL,
  CONSTRAINT crew_ID PRIMARY KEY (ID),
  CONSTRAINT manager_ID FOREIGN KEY (ID) REFERENCES volunteer (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_volunteer`
--

CREATE TABLE event_volunteer (
  vol_ID smallint(6) NOT NULL,
  event_ID smallint(6) NOT NULL,
  CONSTRAINT evevo_ID PRIMARY KEY (vol_ID, event_ID),
  CONSTRAINT AF_eve_ID FOREIGN KEY (event_ID) REFERENCES event (ID),
  CONSTRAINT AF_vol_ID FOREIGN KEY (vol_ID) REFERENCES volunteer (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE want_volunteer (
  vol_ID smallint(6) NOT NULL,
  event_ID smallint(6) NOT NULL,
  CONSTRAINT evevo_ID PRIMARY KEY (vol_ID, event_ID),
  CONSTRAINT WA_eve_ID FOREIGN KEY (event_ID) REFERENCES event (ID),
  CONSTRAINT WA_vol_ID FOREIGN KEY (vol_ID) REFERENCES volunteer (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO event (Name, Date, Time_Start, Time_End) VALUES
('Quiz', '2019-01-22', '1900', '2300'),
('Hellbillies', '2019-01-27', '2000', '0230'),
('Afterski', '2019-03-14', '1900', '0130'),
('X-russ', '2019-04-04', '1900', '0130');

INSERT INTO Volunteer (Firstname, Lastname, nr, Email, Password, Unit) VALUES
('root', 'Sunde', 92928383, 'root@test.no', md5('Root123'), 0),
('Kari', 'Øvrebø', 83839292, 'Kari@test.no', md5('Root123'), 3),
('Kim', 'Possible', 77775555, 'Possible@test.no', md5('Root123'), 5),
('Trym', 'Host', 88884444, 'Host@test.no', md5('Root123'), 1);

INSERT INTO Crew (ID, Bar, Security, Crew, Tech) VALUES
(1, 0, 1, 0, 1),
(2, 1, 0, 1, 0),
(3, 1, 0, 0, 1),
(4, 0, 1, 1, 0);

INSERT INTO Manager (ID, Bar, Security, Crew, Tech) VALUES
(1, 0, 1, 0, 0),
(2, 1, 0, 0, 0),
(3, 0, 0, 0, 1),
(4, 0, 0, 1, 0);

INSERT INTO event_volunteer (vol_ID, event_ID) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 1);

INSERT INTO want_volunteer (vol_ID, event_ID) VALUES
(1, 3),
(2, 4),
(3, 4);