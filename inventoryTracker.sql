CREATE TABLE store (
    StoreNum int(11),
    Name varchar(50),
    StreetName varchar(50),
    Country varchar(50),
    City varchar(50),
    PostalCode varchar(50),
    PRIMARY KEY(StoreNum)
);

INSERT INTO `store` (`StoreNum`, `Name`, `StreetName`, `Country`, `City`, `PostalCode`) VALUES
    (1, 'CoolConvenience', '123 Sesame Street', 'Canada', 'Calgary', 'T1Y 9A9');


CREATE TABLE employees (
    EmployeeID varchar(6) NOT NULL,
    Name varchar(50),
    Position varchar(50),
    Country varchar(50),
    City varchar(50),
    PostalCode varchar(50),
    StreetName varchar(50),
    StoreNum int(11),
    PRIMARY KEY(EmployeeID),
    FOREIGN KEY(StoreNum) REFERENCES Store(StoreNum)
);

INSERT INTO `employees` (`EmployeeID`, `Name`, `Position`, `Country`, `City`, `PostalCode`, `StreetName`, `StoreNum`) VALUES 
   ('423097', 'Andrew Williams', 'Admin', 'Canada', 'Calgary', 'T3J4D4', '456  StreetX.', 1), 
   ('365789', 'Matthew Smith ', 'Manager',  'Canada', 'Calgary', 'T3M4D4', '56 SomeStreet.', 1 ),
   ('265078', 'Catherine Johnson', 'Clerk', 'Canada', 'Calgary', 'T5M4N6', 'StreetY', 1), 
   ('255098', 'Chris Doe', 'Clerk', 'Canada', 'Calgary', 'T3MJN6', '555 StreetZ',1), 
   ('287094', 'Caleb Anderson', 'Clerk', 'Canada', 'Calgary', 'T3M4N6', '72 OneTwoThree  St.', 1);

CREATE TABLE manager(
    MgrSSN varchar(10) NOT NULL,
    ID varchar(6) NOT NULL,
    StoreLocation varchar(50),
    PRIMARY KEY (MgrSSN),
    FOREIGN KEY(ID) REFERENCES employees (EmployeeID) ON DELETE CASCADE
);

INSERT INTO `manager` (`MgrSSN`, `ID`, `StoreLocation`)
VALUES('333333333', '365789', 'Calgary');



CREATE TABLE clerk(
    MgrSSN varchar(10),
    ID varchar(6) NOT NULL,
    YearsEmployed int,
    HourlyWage float,
    PRIMARY KEY (ID),
    FOREIGN KEY(MgrSSN) REFERENCES manager (MgrSSN) ON DELETE CASCADE
);

INSERT INTO `clerk` (`MgrSSN`, `ID`, `HourlyWage`, `YearsEmployed`)
VALUES('333333333', '657456', 16.50, 2),
      ('333333333', '657455', 18.00, 3);


CREATE TABLE administrator(
	AdminSSN varchar(10),
    ID varchar(6) NOT NULL,
    StoreLocation varchar(50),
    PRIMARY KEY (AdminSSN),
    FOREIGN KEY(ID) REFERENCES employees (EmployeeID) ON DELETE CASCADE
);

INSERT INTO `administrator` (`AdminSSN`, `ID`, `StoreLocation`)
VALUES('444444444', '423097', 'Calgary');


CREATE TABLE phoneNumber (
    EmployeeID varchar(6) NOT NULL,
    PhoneNum varchar(10),
	FOREIGN KEY (EmployeeID) REFERENCES employees (EmployeeID) ON DELETE CASCADE
);

INSERT INTO `phoneNumber`(`EmployeeID`,`PhoneNum`) VALUES
    ('423097', '1234567890'),
    ('365789', '1234567000'),
    ('265078', '7638333890'),
    ('255098', '4337683262'),
    ('287094', '1002467898');




CREATE TABLE dependents (
    EmployeeID varchar(6) NOT NULL,
    Name varchar(50),
    PhoneNumber varchar(50),
	PRIMARY KEY (EmployeeID, Name),
    FOREIGN KEY(EmployeeID) REFERENCES employees(EmployeeID) ON DELETE CASCADE
);

INSERT INTO `dependents` (`EmployeeID`, `Name`, `PhoneNumber`) VALUES
    ('255098', 'Wendy Williams', '1237752560'),
    ('287094', 'Mary Anderson', '1020279878'); 


CREATE TABLE product(
    ProductNum varchar(50),
    Name varchar(50),
    Brand varchar(50),
    Category varchar(50),
    Quantity int(11),
    Weight float(50),
    InventoryNum int(11),
    Location varchar(100),
    StorageTemp decimal(10,2),
    PRIMARY KEY(ProductNum)
);


INSERT INTO `product` (`ProductNum`, `Name`, `Brand`, `Category`, `Quantity`, `Weight`, `InventoryNum`, `Location`, `StorageTemp`) VALUES
    ('10000', 'Water', 'Aquafina', 'Beverages', 300, 600, 5678, 'Drink_Aisle', 4),
    ('00230', 'Chocolate_milk', 'Beatrice', 'Beverages', 300, 1000 ,5678, 'Drink_Aisle', 4),
    ('20000', 'Doritos',  'Frito-Lay', 'Snacks', 100, 255, 5678, 'Snack_Aisle', 22),
    ('67570', 'KitKat',  'Nestle', 'Snacks', 100, 42, 5678, 'Candy', 22);




CREATE TABLE supplier(
    ID varchar(6) NOT NULL,
    Name varchar(50),
    PhoneNumber varchar(50),
    StreetName varchar(50),
    Country varchar(50),
    City varchar(50),
    PostalCode varchar(50),
    PRIMARY KEY (ID)
);

INSERT INTO `supplier` (`ID`, `Name`, `PhoneNumber`, `StreetName`, `Country`, `City`, `PostalCode`) VALUES
    ('344479', 'CompanyY', '4034034003', '123 Fakestreet Blvd.', 'Canada', 'Ottawa', 'H7Y3T3'),
    ('345678', 'CompanyX', '5678903333', '43 SomeStreet Close', 'Canada', 'Ottawa', 'H7Y8U7'),
    ('145978', 'CompanyZ', '0987443333', '99 StreetStreet Drive', 'Canada', 'Vancouver', 'E3Y8X9');


CREATE TABLE deliveries(
    InvoiceNum int(100) NOT NULL,
    DateOrdered DATE,
    TimeOrdered TIME,
    DateScheduled DATE,
    TimeScheduled TIME,
    PRIMARY KEY (InvoiceNum)
);


INSERT INTO `deliveries` (`InvoiceNum`, `DateOrdered`, `TimeOrdered`, `DateScheduled`, `TimeScheduled`) VALUES
    (42356, '2021-03-14', '13:20:06', '2021-03-21', '9:00:00'),
    (42357, '2021-04-15', '15:46:54', '2021-04-22', '7:00:00');



CREATE TABLE schedule (
    ScheduleNum int(100) NOT NULL,
    DeliveryInvoiceNum int(100) NOT NULL,
    PRIMARY KEY(ScheduleNum) 
);

INSERT INTO `schedule` (`ScheduleNum`, `DeliveryInvoiceNum`) VALUES
    (100,'42356'),
    (101,'42357');



CREATE TABLE inventory (
    InventoryNum int(100) NOT NULL,
    StoreNum int(100) NOT NULL,
    Capacity int(255),
    PRIMARY KEY(InventoryNum)
);

INSERT INTO `inventory` (`InventoryNum`, `StoreNum`, `Capacity`) VALUES
    (1, 5678, 200),
    (2, 5678, 200),
    (3, 5678, 200);

CREATE TABLE customer(
    CustomerNum int NOT NULL,
    PaymentMethod varchar(50),
    PRIMARY KEY (CustomerNum)
);

INSERT INTO `customer`(`CustomerNum`, `PaymentMethod`) 
VALUES(7833, 'Cash'),
      (1987, 'MasterCard'),
      (1433, 'Debit'),
      (2987, 'Visa');



CREATE TABLE setsPrice(
    ProductNum varchar(8) NOT NULL,
    AdminSSN varchar(10),
    Price double,
    PRIMARY KEY (ProductNum, AdminSSN),
    FOREIGN KEY(ProductNum) REFERENCES product (ProductNum) ON DELETE CASCADE,
    FOREIGN KEY(AdminSSN) REFERENCES administrator (AdminSSN) ON DELETE CASCADE
);

INSERT INTO `setsPrice` (`ProductNum`, `AdminSSN`, `Price`)
VALUES('10000', '444444444', 2.50),
	  ('00230', '444444444', 3.50),
	  ('20000', '444444444', 5.00),
	  ('67570', '444444444', 3.00);


CREATE TABLE buy(
    ProductNum varchar(8) NOT NULL,
    CustomerNum int NOT NULL,
    Price double,
    PRIMARY KEY (ProductNum, CustomerNum),
    FOREIGN KEY(ProductNum) REFERENCES product (ProductNum) ON DELETE CASCADE,
    FOREIGN KEY(CustomerNum) REFERENCES customer (CustomerNum)
);


INSERT INTO `buy` (`CustomerNum`, `ProductNum`) 
VALUES(7833, '10000'),
      (1987, '67570'),
      (1433, '00230'),
      (2987, '20000');

CREATE TABLE addProduct(
MgrSSN varchar(10),
ProductNum varchar(8),
PRIMARY KEY(MgrSSN, ProductNum),
FOREIGN KEY (MgrSSN) REFERENCES manager(MgrSSN) ON DELETE CASCADE,
FOREIGN KEY (ProductNum) REFERENCES product(ProductNum) ON DELETE CASCADE
);

INSERT INTO `addProduct` (`MgrSSN`, `ProductNum`) VALUES
('333333333', '20000'),
('333333333', '67570'),
('333333333', '10000'),
('333333333', '00230');


CREATE TABLE updateProduct(
MgrSSN varchar(10),
ProductNum varchar(8),
PRIMARY KEY(MgrSSN, ProductNum),
FOREIGN KEY (MgrSSN) REFERENCES manager (MgrSSN) ON DELETE CASCADE,
FOREIGN KEY (ProductNum) REFERENCES product (ProductNum) ON DELETE CASCADE
);

INSERT INTO `updateProduct` (`MgrSSN`, `ProductNum`) VALUES
('333333333', '10000'),
('333333333', '00230'),
('333333333', '67570');


CREATE TABLE removeProduct(
MgrSSN varchar(10),
ProductNum varchar(8),
PRIMARY KEY(MgrSSN, ProductNum),
FOREIGN KEY (MgrSSN) REFERENCES manager (MgrSSN) ON DELETE CASCADE
);

INSERT INTO `removeProduct` (`MgrSSN`, `ProductNum`) VALUES
('333333333', '10002'),
('333333333', '99830');


CREATE TABLE clerkViewsSchedule(
ClerkID varchar(6) NOT NULL,
ScheduleNum int NOT NULL, 
PRIMARY KEY (ClerkID, ScheduleNum),
FOREIGN KEY (ClerkID) REFERENCES employees(EmployeeID) ON DELETE CASCADE,
FOREIGN KEY (ScheduleNum) REFERENCES schedule(ScheduleNum) ON DELETE CASCADE
);

INSERT INTO `clerkViewsSchedule` (ClerkID, ScheduleNum) VALUES
('265078', 100),
('255098', 100);

CREATE TABLE mgrViewsSchedule(
MgrSSN varchar(10) NOT NULL,
ScheduleNum int NOT NULL,
PRIMARY KEY (MgrSSN, ScheduleNum),
FOREIGN KEY (MgrSSN) REFERENCES manager(MgrSSN) ON DELETE CASCADE,
FOREIGN KEY (ScheduleNum) REFERENCES schedule(ScheduleNum) ON DELETE CASCADE
);

INSERT INTO `mgrViewsSchedule` (`MgrSSN`, `ScheduleNum`) VALUES
('333333333', 100),
('333333333', 101);




