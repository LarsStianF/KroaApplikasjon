START TRANSACTION;
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
DROP TABLE IF EXISTS crew_type;
DROP TABLE IF EXISTS volunteer;
DROP TABLE IF EXISTS want_volunteer;
DROP TABLE IF EXISTS logs;

SET FOREIGN_KEY_CHECKS=1;

-- --------------------------------------------------------

-- Table structure for table `volunteer`

CREATE TABLE volunteer (
  ID smallint(6) NOT NULL AUTO_INCREMENT,
  Firstname varchar(30) NOT NULL,
  Lastname varchar(30) NOT NULL,
  nr char(8) NOT NULL,
  Email varchar(30) NOT NULL,
  Password varchar(100) NOT NULL,
  Unit smallint(6) DEFAULT NULL,
  CONSTRAINT volunteer_ID PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE event (
  ID smallint(6) NOT NULL AUTO_INCREMENT,
  Name varchar(50) NOT NULL,
  Date date NOT NULL,
  Time_Start varchar(10) NOT NULL,
  Time_End varchar(10) NOT NULL,
  Type char(1) NOT NULL,
  Event_text varchar(100) NOT NULL,
  CONSTRAINT eve_ID PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

CREATE TABLE crew_type (
  ID smallint(6) NOT NULL,
  type varchar(20) NOT NULL,
  CONSTRAINT crew_ID PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manager`

CREATE TABLE manager (
  vol_ID smallint(6) NOT NULL,
  crew_type_ID smallint(6) NOT NULL,
  CONSTRAINT manager_PK PRIMARY KEY (vol_ID, crew_type_ID),
  CONSTRAINT vol_ID FOREIGN KEY (vol_ID) REFERENCES volunteer (ID),
  CONSTRAINT crew_type_FK FOREIGN KEY (crew_type_ID) REFERENCES crew_type (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------



--
-- Table structure for table `event_volunteer`
--

CREATE TABLE event_volunteer (
  vol_ID smallint(6) NOT NULL,
  event_ID smallint(6) NOT NULL,
  crew_type_ID smallint(6) NOT NULL,
  manager tinyint(1) NOT NULL,
  CONSTRAINT event_vol_PK PRIMARY KEY (vol_ID, event_ID, crew_type_ID),
  CONSTRAINT event_vol_crew_type_FK FOREIGN KEY (crew_type_ID) REFERENCES crew_type (ID),
  CONSTRAINT event_vol_event_FK FOREIGN KEY (event_ID) REFERENCES event (ID),
  CONSTRAINT event_vol_vol_FK FOREIGN KEY (vol_ID) REFERENCES volunteer (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE want_volunteer (
  vol_ID smallint(6) NOT NULL,
  event_ID smallint(6) NOT NULL,
  crew_type_ID smallint(6) NOT NULL,
  CONSTRAINT want_vol_PK PRIMARY KEY (vol_ID, event_ID, crew_type_ID),
  CONSTRAINT want_vol_crew_type_FK FOREIGN KEY (crew_type_ID) REFERENCES crew_type (ID),
  CONSTRAINT want_vol_event_FK FOREIGN KEY (event_ID) REFERENCES event (ID),
  CONSTRAINT want_vol_vol_FK FOREIGN KEY (vol_ID) REFERENCES volunteer (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE logs (
  event_ID smallint(6) NOT NULL,
  crew_type varchar(30) NOT NULL,
  logs varchar(250) NOT NULL,
  CONSTRAINT log_PK PRIMARY KEY (event_ID, crew_type),
  CONSTRAINT log_FK FOREIGN KEY (event_ID) REFERENCES event (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO event (Name, Date, Time_Start, Time_End, Type, Event_text) VALUES
('Quiz', '2019-01-22', '1900', '2300', 'D', 'Dette er Quiz'),
('Hellbillies', '2019-01-27', '2000', '0230', 'A', 'Hellbillies er gøy'),
('Afterski', '2019-03-14', '1900', '0130', 'B', 'DJ Dan høster opp afterski stemning'),
('X-russ', '2019-04-04', '1900', '0130', 'A', 'På med russebuksa!'),
('Aapen Scene', '2019-04-26', '2130', '0230', 'D', 'Fremfør det du vil'),
('Sondre Justad', '2019-05-05', '2130', '0100', 'B', 'Sondre Justad kommer til Kroa og det blir gøy!'),
('Oktoberfest', '2020-10-02', '2000', '0130', 'C', 'Tysklands tradisjon kommer til å Kroa!'),
('Cezinando', '2020-10-23', '2130', '0100', 'B', 'Cezinando fremfører nytt album på storscena');

INSERT INTO Volunteer (Firstname, Lastname, nr, Email, Password, Unit) VALUES
('root', 'Sunde', 92928383, 'root@test.no', md5('Root123'), 0),
('Kari', 'Øvrebø', 83839292, 'Kari@test.no', md5('Root123'), 3),
('Kim', 'Possible', 77775555, 'Possible@test.no', md5('Root123'), 5),
('Trym', 'Host', 88884444, 'Host@test.no', md5('Root123'), 1);

INSERT INTO Crew_type (ID, type) VALUES
(1, 'Bar'),
(2, 'Security'),
(3, 'Crew'),
(4, 'Technical');

INSERT INTO Manager (vol_ID, crew_type_ID) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

INSERT INTO event_volunteer (vol_ID, event_ID, crew_type_ID, manager) VALUES
(1, 1, 1, 0),
(1, 2, 2, 0),
(2, 2, 3, 0),
(3, 1, 4, 1);

INSERT INTO want_volunteer (vol_ID, event_ID, crew_type_ID) VALUES
(1, 3, 1),
(2, 4, 2),
(3, 4 ,3);

INSERT INTO logs (event_ID, crew_type, logs) VALUES
(1, 'Security', 'Dette arrangementet gikk fint'),
(1, 'Bar', 'Vi hadde masse trøbbel'),
(2, 'Crew', 'Garderoben suger'),
(2, 'Security', 'Crew er dårlige i garderobe'),
(3, 'Bar', 'Solgte masse sprit'),
(3, 'Security', 'Folk sloss'),
(4, 'Tech', 'De nye høytalerne funka glimrende! Alt vell!'),
(5, 'Tech', 'Vi Syns dette arrangementet var kjedelig, forslag til forbedring?');