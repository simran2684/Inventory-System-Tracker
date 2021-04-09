CREATE DATABASE inventory_system

CREATE TABLE Employees
(
EmployeeID VARCHAR(9) NOT NULL,
Name VARCHAR(50),
Position VARCHAR(50),
Country VARCHAR(50),
City VARCHAR(50),
PostalCode VARCHAR(50),
StreetName VARCHAR(50),
StoreNum INT,
PRIMARY KEY(EmployeeID),
FOREIGN KEY (StoreNum) REFERENCES Store(StoreNum)
);

CREATE TABLE PhoneNumber
(
EmployeeID VARCHAR(9) NOT NULL,
PhoneNum VARCHAR(10)
);

CREATE TABLE Dependents
(
EmployeeID VARCHAR(9) NOT NULL,
Name VARCHAR(50),
PhoneNumber VARCHAR(50),
FOREIGN KEY (E_ID) REFERENCES Employee (EmployeeID)
);

CREATE TABLE Product
(
ProductNum VARCHAR(8),
Name VARCHAR(50),
Brand VARCHAR(50),
Category VARCHAR(50),
Quantity INT,
Weight FLOAT,
InventoryNum INT,
Location VARCHAR(50),
StorageTemp DECIMAL(10,2),
PRIMARY KEY (ProductNum)
);


CREATE TABLE Supplier (
ID VARCHAR(9) NOT NULL,
Name VARCHAR(50),
PhoneNumber VARCHAR(50),
StreetName VARCHAR(50),
Country VARCHAR(50),
City VARCHAR(50),
PostalCode VARCHAR(50),
PRIMARY KEY (ID)
);


CREATE TABLE Deliveries (
InvoiceNum INT NOT NULL,
DateOrdered DATE,
TimeOrdered TIME,
DateScheduled DATE,
TimeScheduled TIME,
PRIMARY KEY (InvoiceNum)
);

CREATE TABLE Schedule (
ScheduleNum INT NOT NULL,
DeliveryInvoiceNum INT NOT NULL,
PRIMARY KEY(ScheduleNum),
FOREIGN KEY(deliveryInvoice) REFERENCES Deliveries(InvoiceNum)
);


CREATE TABLE Inventory (
InventoryNum INT NOT NULL,
StoreNum INT NOT NULL,
Capacity INT,
PRIMARY KEY (InventoryNum)
);


CREATE TABLE Customer (
CustomerNum INT NOT NULL,
PaymentMethod VARCHAR(50),
PRIMARY KEY(CustomerNum)
);

CREATE TABLE Manager(
Mgr_SSN VARCHAR(50),
ID VARCHAR(9) NOT NULL,
Store_Location VARCHAR(50),
PRIMARY KEY(Mgr_SSN),
FOREIGN KEY(ID) REFERENCES Employee (EmployeeID)
);


CREATE TABLE Clerk(
Mgr_SSN VARCHAR(50),
ID VARCHAR(9) NOT NULL,
Years_Employed INT,
Hourly_Wage FLOAT,
PRIMARY KEY(ID),
FOREIGN KEY(Mgr_SSN) REFERENCES Manager(Mgr_SSN)
);

CREATE TABLE Administrator(
Name VARCHAR(50),
Admin_SSN VARCHAR(50),
ID VARCHAR(9) NOT NULL,
StoreLocation VARCHAR(50),
PRIMARY KEY (Admin_SSN),
FOREIGN KEY(ID) REFERENCES Employee (EmployeeID)
);

CREATE TABLE Store (
StoreNum INT,
Name VARCHAR(50),
StreetName VARCHAR(50),
Country VARCHAR(50),
City VARCHAR(50),
PostalCode VARCHAR(50),
PRIMARY KEY(StoreNum)
);


CREATE TABLE SetsPrice (
ProductNum VARCHAR(8) NOT NULL,
AdminSSN VARCHAR(50),
Price DOUBLE,
PRIMARY KEY(ProductNum, AdminSSN),
FOREIGN KEY(AdminSSN) REFERENCES Employee(EmployeeID)
);

CREATE TABLE Buy (
CustomerNum INT NOT NULL,
ProductNum VARCHAR(8) NOT NULL,
PRIMARY KEY(CustomerNum, ProductNum),
FOREIGN KEY (CustomerNum) REFERENCES Customer(CustomerNum),
FOREIGN KEY (ProductNum) REFERENCES Product(ProductNum)
);

CREATE TABLE UpdateProduct(
MgrSSN VARCHAR(50),
ProductNum VARCHAR(8),
PRIMARY KEY(MgrSSN, ProductNum),
FOREIGN KEY (MgrSSN) REFERENCES Employee(EmployeeID),
FOREIGN KEY (ProductNum) REFERENCES Product(ProductNum)
);

CREATE TABLE RemovesProduct(
MgrSSN VARCHAR(50),
ProductNum VARCHAR(8),
PRIMARY KEY(MgrSSN, ProductNum),
FOREIGN KEY (MgrSSN) REFERENCES Manager(MgrSSN),
FOREIGN KEY (ProductNum) REFERENCES Product(ProductNum)
);

CREATE TABLE AddsProduct(
MgrSSN VARCHAR(50),
ProductNum VARCHAR(8),
PRIMARY KEY(MgrSSN, ProductNum),
FOREIGN KEY (MgrSSN) REFERENCES Manager(MgrSSN),
FOREIGN KEY (ProductNum) REFERENCES Product(ProductNum)
);

CREATE TABLE ClerkViewsSchedule(
ClerkID VARCHAR(9),
ScheduleNum INT
);

CREATE TABLE MgrViewsSchedule(
MgrSSN INT,
ScheduleNum INT
);


INSERT INTO Employees (EmployeeID, Name, Position, Country, City, PostalCode, StreetName, StoreNum)
VALUES (423097, 'Andrew Williams', 'Admin', 'Canada', 'Calgary', 'T3J4D4', '456  StreetX.', 1), 
   (365789, 'Matthew Smith ', 'Manager',  'Canada', 'Calgary', 'T3M4D4', '56 SomeStreet.', 1 ),
   (265078, 'Catherine Johnson', 'Clerk', 'Canada', 'Calgary', 'T5M4N6', 'StreetY', 1), 
   (255098, 'Chris Doe', 'Clerk', 'Canada', 'Calgary', 'T3MJN6', '555 StreetZ',1), 
   (287094, 'Caleb Anderson', 'Clerk', 'Canada', 'Calgary', 'T3M4N6', '72 OneTwoThree  St.', 1);

INSERT INTO PhoneNumber(EmployeeID, PhoneNum)
VALUES('423097', '1234567890'),
  ('365789', '1234567000'),
  ('265078', '7638333890'),
  ('255098', '4337683262'),
  ('287094', '1002467898');

INSERT INTO Dependents(EmployeeID, Name, PhoneNumber)
VALUES ('423097', 'Wendy Williams', '1237752560'),
   ('365789', 'Amelia Smith ', '0987625522'),
   ('265078', 'Jacob Johnson', '7634443890'), 
   ('255098', 'Jane Doe ', '5738362828'), 
   ('287094', 'Mary Anderson', '1020279878'); 


INSERT INTO Administrator(Admin_SSN, ID, Store_Location)
VALUES('365777', '123456' 'Calgary');

INSERT INTO Manager(Mgr_SSN, ID, Store_Location)
VALUES('365789', '098765', 'Calgary');

INSERT INTO Clerk(Mgr_SSN, ID, Hourly_Wage, Years_Employed)
VALUES('365789', '657456', 16.50, 2),
  ('365789', '657455', 18.00, 3);



INSERT INTO Product(ProductNum, Name, Brand, Category, Quantity, Weight, InventoryNum, Location, StorageTemp)
VALUES('10000', 'Water', 'Aquafina', 'Beverages', 300, 600, 5678, 'Drink_Aisle', 4),
('00230', 'Chocolate_milk', 'Beatrice', 'Beverages', 300, 1000 ,5678, 'Drink_Aisle', 4),
('20000', 'Doritos',  'Frito-Lay', 'Snacks', 100, 255, 5678, 'Snack_Aisle', 22),
('67570', 'KitKat',  'Nestle', 'Snacks', 100, 42, 5678, 'Candy', 22);

INSERT INTO Deliveries(InvoiceNum, DateOrdered, TimeOrdered, DateScheduled, TimeScheduled)
VALUES(42356, '2021-03-14', '13:20:06', '2021-03-21', '9:00:00'),
      (42357, '2021-04-15', '15:46:54', '2021-04-22', '7:00:00');

INSERT INTO Schedule(ScheduleNum, DeliveryInvoiceNum)
VALUES(100,'42356'),
      (101,'42357');

INSERT INTO Store(StoreNum, Name, Street_name, Country, City, PostalCode)
VALUES(1, 'CoolConvenience', '123 Sesame Street', 'Canada', 'Calgary', 'T1Y9A9');


INSERT INTO UpdatesProduct(Mgr_SSN, ProductNum)
VALUES('365789', '10000' ),
  ('365789', '00230'),
  ('365789', '26544');


INSERT INTO RemovesProduct(Mgr_SSN, ProductNum)
VALUES('365789', '10002' ),
 ('365789', '99830' );


INSERT INTO AddsProduct(Mgr_SSN, ProductNum)
VALUES('365789', '20000'),
 ('365789', '67570' ),
('365789', '10000' ),
('365789', '00230' );



INSERT INTO Inventory(StoreNum, InventoryNum, Capacity)
VALUES(1, 5678, 15 ),
	  (1, 5678, 20 ),
      (1, 5678, 33 );


INSERT INTO ClerkViewsSchedule(ID, ScheduleNum)
VALUES('657456', 101),
      ('657456', 114);


INSERT INTO MgrViewsSchedule(Mgr_SSN, ScheduleNum)
VALUES('365789', 100),
      ('365789', 130);


INSERT INTO Buy(CustomerNum, ProductNum) 
VALUES(7833, '10000'),
  (1987, '67570'),
  (1433, '00230'),
  (2987, '20000');


INSERT INTO Customer(CustomerNum, Payment_Method) 
VALUES(7833, 'Cash'),
  (1987, 'MasterCard'),
  (1433, 'Debit'),
  (2987, 'Visa');


INSERT INTO SetsPrice (ProductNum, AdminSSN, Price)
VALUES('10000', '365777', 2.50),
	  ('00230', '365777', 3.50),
	  ('20000', '365777', 5.00),
	  ('67570', '365777', 3.00);
      

INSERT INTO Supplier(Id, Name, PhoneNumber, StreetName, Country, City, PostalCode)
VALUES('344479', 'CompanyY', '4034034003', '123 Fakestreet Blvd.', 'Canada', 'Ottawa', 'H7Y3T3'),
      ('345678', 'CompanyX', '5678903333', '43 SomeStreet Close', 'Canada', 'Ottawa', 'H7Y8U7'),
      ('145978', 'CompanyZ', '0987443333', '99 StreetStreet Drive', 'Canada', 'Vancouver', 'E3Y8X9');

