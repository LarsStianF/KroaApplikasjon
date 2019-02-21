INSERT INTO Arrangement (Navn, Dato, Tid_Start, Tid_Slutt) VALUES
('Quiz', '2019-01-22', '1900', '2300'),
('Hellbillies', '2019-01-27', '2000', '0230'),
('Afterski', '2019-03-14', '1900', '0130'),
('X-russ', '2019-04-04', '1900', '0130');

INSERT INTO Frivillig (Fornavn, Etternavn, TlfNr, Email, Passord, Enhet) VALUES
('Per', 'Sunde', 92928383, 'Sunde@test.no', '12345', 0),
('Kari', 'Øvrebø', 83839292, 'Kari@test.no', 'password', 3),
('Kim', 'Possible', 77775555, 'Possible@test.no', '56789', 5),
('Trym', 'Host', 88884444, 'Host@test.no', '1337', 1);

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
