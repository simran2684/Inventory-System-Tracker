CREATE TABLE updateProduct(
MgrSSN varchar(10),
ProductNum varchar(8),
PRIMARY KEY(MgrSSN, ProductNum),
FOREIGN KEY (MgrSSN) REFERENCES employee(EmployeeID),
FOREIGN KEY (ProductNum) REFERENCES product(ProductNum)
);

INSERT INTO `updateProduct` (`MgrSSN`, `ProductNum`) VALUES
('365789', '10000'),
('365789', '00230'),
('365789', '26544');


CREATE TABLE removeProduct(
MgrSSN varchar(10),
ProductNum varchar(8),
PRIMARY KEY(MgrSSN, ProductNum),
FOREIGN KEY (MgrSSN) REFERENCES manager(MgrSSN),
FOREIGN KEY (ProductNum) REFERENCES product(ProductNum)
);

INSERT INTO `removeProduct` (`MgrSSN`, `ProductNum`) VALUES
('365789', '10002'),
('365789', '99830');


CREATE TABLE addProduct(
MgrSSN varchar(10),
ProductNum varchar(8),
PRIMARY KEY(MgrSSN, ProductNum),
FOREIGN KEY (MgrSSN) REFERENCES manager(MgrSSN),
FOREIGN KEY (ProductNum) REFERENCES product(ProductNum)
);

INSERT INTO `addProduct` (`Mgr_SSN`, `ProductNum`) VALUES
('365789', '20000'),
('365789', '67570'),
('365789', '10000'),
('365789', '00230');


CREATE TABLE clerkViewsSchedule(
ClerkID varchar(9),
ScheduleNum int
);

INSERT INTO `clerkViewsSchedule` (ID, ScheduleNum) VALUES
('657456', 101),
('657455', 114);

CREATE TABLE mgrViewsSchedule(
MgrSSN int,
ScheduleNum int
);

INSERT INTO `mgrViewsSchedule` (`Mgr_SSN`, `ScheduleNum`) VALUES
('365789', 100),
('365789', 130);