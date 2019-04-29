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

-- Table structure for table `user_type`

CREATE TABLE user_type (
  ID smallint(6) NOT NULL,
  user_type varchar(20) NOT NULL,
  CONSTRAINT user_type_PK PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  user_type smallint(6),
  CONSTRAINT volunteer_ID PRIMARY KEY (ID),
  CONSTRAINT user_type_FK FOREIGN KEY (user_type) REFERENCES user_type (ID)
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
  Event_text varchar(100) NOT NULL,
  Event_sec tinyint(1) NOT NULL,
  Event_bar tinyint(1) NOT NULL,
  Event_crew tinyint(1) NOT NULL,
  Event_tech tinyint(1) NOT NULL,
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
  crew_type_ID smallint(6) NOT NULL,
  logs varchar(250) NOT NULL,
  CONSTRAINT log_PK PRIMARY KEY (event_ID, crew_type_ID),
  CONSTRAINT log_event_id_FK FOREIGN KEY (event_ID) REFERENCES  event (ID),
  CONSTRAINT log_crew_type_id_FK FOREIGN KEY (crew_type_ID) REFERENCES crew_type (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO user_type (ID, user_type) VALUES
(1, 'Root'),
(2, 'Daglig Leder'),
(3, 'Volunteer Coordinator'),
(4, 'Event Manager'),
(5, 'Manager'),
(6, 'Volunteer');

INSERT INTO event (Name, Date, Time_Start, Time_End, Event_text, Event_sec, Event_bar, Event_crew, Event_tech) VALUES
('Open mic', '2019-01-15', '2130', '0230', 'Come show us what you got!', 2, 4, 0, 2),
('Quiz', '2019-01-27', '1900', '2300', 'Quiznight tonight!', 2, 3, 3, 2),
('Hellbillies', '2019-02-12', '2000', '0230', 'Hellbillies arrives at Kroa!', 12, 8, 5, 4),
('Afterski', '2019-02-20', '1900', '0130', 'Longing for more trips to the mountain? We got you covered', 13, 8, 5, 2),
('X-russ', '2019-03-04', '1900', '0130', 'Norway`s tradition is back!', 15, 8, 5, 4),
('Sondre Justad', '2019-03-16', '2130', '0100', 'Sondre Justad comes out with a new album!', 11, 8, 4, 3),
('Cezinando', '2019-03-28', '2130', '0100', 'Cezinando takes the stage!', 10, 7, 4, 4),
('Quiz', '2019-04-02', '1900', '2300', 'New Quizmaster tonight!', 2, 3, 3, 2),
('Open mic', '2019-04-09', '2130', '0230', 'Come show us what you got!', 2, 4, 0, 2),
('Vassendgutane', '2019-04-20', '2000', '0230', 'Vassendgutane brings country to Kroa!', 12, 8, 5, 4),
('Togaparty', '2019-08-15', '2130', '0230', 'Show us how ancient romans celebrated!', 13, 8, 5, 2),
('KlubbKroa', '2019-08-30', '2130', '0130', 'Themeparty at Kroa', 5, 4, 2, 3),
('Karpe', '2019-09-10', '2130', '0000', 'Karpe is coming to Kroa!', 14, 8, 5, 4),
('Kroaelection 2019', '1900', '2300', 'Election for new board members!', 0, 2, 2, 2),
('Octoberfest', '2019-10-20', '2000', '0130', 'Germany`s tradition comes to Kroa!', 15, 8, 5, 4);

INSERT INTO Volunteer (Firstname, Lastname, nr, Email, Password, Unit, user_type) VALUES
('Per', 'Sunde', 92928383, 'root@test.no', md5('Root123'), 0, 1),
('David', 'Goliat', 76544567, 'Goliat@test.no', md5('Root123'), 10, 2),
('Frida', 'Erdinger', 12345665, 'Coordinator@test.no', md5('Root123'), 4, 3),
('Jon', 'Snow', 66665555, 'Snow@test.no', md5('Root123'), 4, 4),
('Kari', 'Vik', 83839292, 'Kari@test.no', md5('Root123'), 3, 5),
('Kim', 'Possible', 77775555, 'Possible@test.no', md5('Root123'), 5, 5),
('Trym', 'Host', 88884444, 'Host@test.no', md5('Root123'), 6, 5),
('Torger', 'Napp', 84284444, 'Napp@test.no', md5('Root123'), 3, 5),
('Helene', 'Humle', 88884624, 'Humle@test.no', md5('Root123'), 2, 5),
('Michel', 'Swanson', 72534444, 'Michel@test.no', md5('Root123'), 0, 5),
('Ola', 'Nordmann', 12344321, 'Ola@test.no', md5('Root123'), 0, 6),
('Emma', 'Huby', 09877890, 'Huby@test.no', md5('Root123'), 2, 6),
('Ahmad', 'Sola', 76555567, 'Sola@test.no', md5('Root123'), 1, 6),
('Jurgen', 'Klopp', 38520542, 'Klopp@test.no', md5('Root123'), 2, 6),
('Manuel', 'Ernzt', 48274259, 'Ernzt@test.no', md5('Root123'), 7, 6),
('Frøydis', 'Humle', 48275259, 'Frøydis@test.no', md5('Root123'), 1, 6),
('Maghda', 'Ernzt', 48274259, 'Maghda@test.no', md5('Root123'), 6, 6),
('Eivind', 'Underhaug', 48272953, 'Under@test.no', md5('Root123'), 8, 6),
('Eric', 'Ernzt', 48270520, 'Eric@test.no', md5('Root123'), 7, 6),
('Stuart', 'Hill', 48270003, 'Hill@test.no', md5('Root123'), 0, 6),
('Margaret', 'Hill', 48274006, 'MarHill@test.no', md5('Root123'), 1, 6),
('Susanne', 'Haug', 48271114, 'Haug@test.no', md5('Root123'), 5, 6),
('Nils', 'Nilsen', 48264259, 'Nils@test.no', md5('Root123'), 2, 6),
('Espen', 'Torgersen', 48274159, 'Espen@test.no', md5('Root123'), 3, 6),
('Michael', 'Swanson', 47274259, 'Michael@test.no', md5('Root123'), 5, 6);

INSERT INTO Crew_type (ID, type) VALUES
(1, 'Bar'),
(2, 'Security'),
(3, 'Crew'),
(4, 'Technical');

INSERT INTO Manager (vol_ID, crew_type_ID) VALUES
(5, 1),
(6, 2),
(7, 3),
(8, 1),
(9, 4),
(10, 2);

INSERT INTO event_volunteer (vol_ID, event_ID, crew_type_ID, manager) VALUES
(5, 1, 1, 1),
(6, 1, 2, 1),
(7, 1, 3, 1),
(9, 1, 4, 1),
(11, 1, 1, 0),
(12, 1, 2, 0),
(13, 1, 3, 0),
(14, 1, 4, 0),
(8, 2, 1, 1),
(10, 2, 2, 1),
(7, 2, 3, 1),
(9, 2, 4, 1),
(15, 2, 1, 0),
(16, 2, 2, 0),
(17, 2, 4, 0),
(5, 3, 1, 1),
(6, 3, 2, 1),
(7, 3, 3, 1),
(9, 3, 4, 1),
(18, 3, 1, 0),
(19, 3, 2, 0),
(8, 4, 1, 1),
(10, 4, 2, 1),
(7, 4, 3, 1),
(9, 4, 4, 1),
(20, 4, 1, 0),
(21, 4, 4, 0),
(22, 4, 3, 0),
(5, 5, 1, 1),
(6, 5, 2, 1),
(7, 5, 3, 1),
(9, 5, 4, 1),
(23, 5, 1, 0),
(24, 5, 2, 0),
(25, 5, 4, 0),
(5, 6, 1, 1),
(6, 6, 2, 1),
(7, 6, 3, 1),
(9, 6, 4, 1),
(11, 6, 1, 0),
(12, 6, 2, 0),
(13, 6, 3, 0),
(14, 6, 4, 0),
(8, 7, 1, 1),
(10, 7, 2, 1),
(7, 7, 3, 1),
(9, 7, 4, 1),
(15, 7, 1, 0),
(16, 7, 2, 0),
(17, 7, 4, 0),
(5, 8, 1, 1),
(6, 8, 2, 1),
(7, 8, 3, 1),
(9, 8, 4, 1),
(18, 8, 1, 0),
(19, 8, 2, 0),
(8, 9, 1, 1),
(10, 9, 2, 1),
(7, 9, 3, 1),
(9, 9, 4, 1),
(20, 9, 1, 0),
(21, 9, 4, 0),
(22, 9, 3, 0),
(5, 10, 1, 1),
(6, 10, 2, 1),
(7, 10, 3, 1),
(9, 10, 4, 1),
(23, 10, 1, 0),
(24, 10, 2, 0),
(25, 10, 4, 0);

INSERT INTO want_volunteer (vol_ID, event_ID, crew_type_ID) VALUES
(11, 11, 1),
(12, 11, 2),
(13, 11, 3),
(14, 11, 4),
(15, 12, 1),
(16, 12, 2),
(17, 12, 3),
(18, 12, 4),
(19, 13, 1),
(20, 13, 2),
(21, 13, 3),
(22, 13, 4),
(23, 14, 1),
(24, 14, 2),
(25, 14, 3),
(11, 14, 4);

INSERT INTO logs (event_ID, crew_type_ID, logs) VALUES
(1, 1, 'We had loads of trouble'),
(1, 2, 'This event went nicely for us'),
(1, 3, 'All well'),
(1, 4, 'New speakers worked exceptionally'),
(2, 1, 'This event went smooth'),
(2, 2, 'Alot of drunk people, few fights'),
(2, 3, 'Tickets didnt scan'),
(2, 4, 'Nice and calm'),
(3, 1, '1 keg left of beer'),
(3, 2, 'Trained a new security manager today'),
(3, 3, 'We want candy in the crewdesk'),
(3, 4, 'We tought this was boring'),
(4, 1, 'Smooth event'),
(4, 2, 'Kicked a guy out'),
(4, 3, 'We struggled to get volunteers'),
(4, 4, 'We had a tetris battle at work, I won'),
(5, 1, 'We want Carlsberg back on as draft'),
(5, 2, 'This event went nicely'),
(5, 3, 'No wardrobe today'),
(5, 4, 'All good'),
(6, 1, 'We had loads of trouble'),
(6, 2, 'This event went nicely for us'),
(6, 3, 'All well'),
(6, 4, 'New speakers worked exceptionally'),
(7, 1, 'This event went smooth'),
(7, 2, 'Alot of drunk people, few fights'),
(7, 3, 'Tickets didnt scan'),
(7, 4, 'Nice and calm'),
(8, 1, '1 keg left of beer'),
(8, 2, 'Trained a new security manager today'),
(8, 3, 'We want candy in the crewdesk'),
(8, 4, 'We tought this was boring'),
(9, 1, 'Smooth event'),
(9, 2, 'Kicked a guy out'),
(9, 3, 'We struggled to get volunteers'),
(9, 4, 'We had a tetris battle at work, I won'),
(10, 1, 'We want Carlsberg back on as draft'),
(10, 2, 'This event went nicely'),
(10, 3, 'No wardrobe today'),
(10, 4, 'All good');