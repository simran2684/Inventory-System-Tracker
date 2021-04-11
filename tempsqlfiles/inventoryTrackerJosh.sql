

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
    EmployeeID varchar(9) NOT NULL,
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
    ('255098', 'Chris', 'Clerk', 'Canada', 'Calgary', 'T3MJN6', '555 StreetZ', 1), 
    ('287094', 'Caleb', 'Clerk', 'Canada', 'Calgary', 'T3M4N6', '72 OneTwoThree  St', 1);



CREATE TABLE phoneNumber (
    EmployeeID varchar(50) NOT NULL,
    PhoneNum varchar(50)
);

INSERT INTO `phoneNumber`(`EmployeeID`,`PhoneNum`) VALUES
    ('423097', '1234567890'),
    ('365789', '1234567000'),
    ('265078', '7638333890'),
    ('255098', '4337683262'),
    ('287094', '1002467898');




CREATE TABLE dependents (
    e_ID varchar(50) NOT NULL,
    Name varchar(50),
    PhoneNumber varchar(50),
    FOREIGN KEY(e_ID) REFERENCES employees(EmployeeID)
);

INSERT INTO `dependents` (`e_ID`, `Name`, `PhoneNumber`) VALUES
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
    ID varchar(9) NOT NULL,
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




