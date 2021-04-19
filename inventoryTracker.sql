CREATE TABLE store (
    storeNum int(11),
    name varchar(50),
    streetName varchar(50),
    country varchar(50),
    city varchar(50),
    postalCode varchar(50),
    PRIMARY KEY(storeNum)
);

INSERT INTO `store` (`storeNum`, `name`, `streetName`, `country`, `city`, `postalCode`) VALUES
    (1, 'CoolConvenience', '123 Sesame Street', 'Canada', 'Calgary', 'T1Y 9A9');


CREATE TABLE employees (
    employeeId varchar(6) NOT NULL,
    name varchar(50),
    position varchar(50),
    country varchar(50),
    city varchar(50),
    postalCode varchar(50),
    streetName varchar(50),
    storeNum int(11),
    PRIMARY KEY(employeeId),
    FOREIGN KEY(storeNum) REFERENCES store(storeNum)
);

INSERT INTO `employees` (`employeeId`, `name`, `position`, `country`, `city`, `postalCode`, `streetName`, `storeNum`) VALUES 
   ('423097', 'Andrew Williams', 'Admin', 'Canada', 'Calgary', 'T3J4D4', '456  StreetX.', 1), 
   ('365789', 'Matthew Smith ', 'Manager',  'Canada', 'Calgary', 'T3M4D4', '56 SomeStreet.', 1 ),
   ('265078', 'Catherine Johnson', 'Clerk', 'Canada', 'Calgary', 'T5M4N6', 'StreetY', 1), 
   ('255098', 'Chris Doe', 'Clerk', 'Canada', 'Calgary', 'T3MJN6', '555 StreetZ',1), 
   ('287094', 'Caleb Anderson', 'Clerk', 'Canada', 'Calgary', 'T3M4N6', '72 OneTwoThree  St.', 1);

CREATE TABLE manager(
    mgrSSN varchar(10) NOT NULL,
    id varchar(6) NOT NULL,
    storeLocation varchar(50),
    PRIMARY KEY (mgrSSN),
    FOREIGN KEY(id) REFERENCES employees (employeeId) ON DELETE CASCADE
);

INSERT INTO `manager` (`mgrSSN`, `id`, `storeLocation`)
VALUES('333333333', '365789', 'Calgary');



CREATE TABLE clerk(
    mgrSSN varchar(10),
    id varchar(6) NOT NULL,
    yearsEmployed int,
    hourlyWage float,
    PRIMARY KEY (id),
    FOREIGN KEY(mgrSSN) REFERENCES manager (mgrSSN) ON DELETE CASCADE
);

INSERT INTO `clerk` (`mgrSSN`, `id`, `hourlyWage`, `yearsEmployed`)
VALUES('333333333', '657456', 16.50, 2),
      ('333333333', '657455', 18.00, 3);


CREATE TABLE administrator(
	adminSSN varchar(10),
    id varchar(6) NOT NULL,
    storeLocation varchar(50),
    PRIMARY KEY (adminSSN),
    FOREIGN KEY(id) REFERENCES employees (employeeId) ON DELETE CASCADE
);

INSERT INTO `administrator` (`adminSSN`, `id`, `storeLocation`)
VALUES('444444444', '423097', 'Calgary');


CREATE TABLE phoneNumber (
    employeeId varchar(6) NOT NULL,
    phoneNum varchar(10),
	FOREIGN KEY (employeeId) REFERENCES employees (employeeId) ON DELETE CASCADE
);

INSERT INTO `phoneNumber`(`employeeId`,`phoneNum`) VALUES
    ('423097', '1234567890'),
    ('365789', '1234567000'),
    ('265078', '7638333890'),
    ('255098', '4337683262'),
    ('287094', '1002467898');




CREATE TABLE dependents (
    employeeId varchar(6) NOT NULL,
    name varchar(50),
    phoneNumber varchar(50),
	PRIMARY KEY (employeeId, name),
    FOREIGN KEY(employeeId) REFERENCES employees(employeeId) ON DELETE CASCADE
);

INSERT INTO `dependents` (`employeeId`, `name`, `phoneNumber`) VALUES
    ('255098', 'Wendy Williams', '1237752560'),
    ('287094', 'Mary Anderson', '1020279878'); 


CREATE TABLE product(
    productNum varchar(50),
    name varchar(50),
    brand varchar(50),
    category varchar(50),
    quantity int(11),
    weight float(50),
    inventoryNum int(11),
    location varchar(100),
    storageTemp decimal(10,2),
    PRIMARY KEY(productNum)
);


INSERT INTO `product` (`productNum`, `name`, `brand`, `category`, `quantity`, `weight`, `inventoryNum`, `location`, `storageTemp`) VALUES
    ('10000', 'Water', 'Aquafina', 'Beverages', 300, 600, 5678, 'Drink_Aisle', 4),
    ('00230', 'Chocolate_milk', 'Beatrice', 'Beverages', 300, 1000 ,5678, 'Drink_Aisle', 4),
    ('20000', 'Doritos',  'Frito-Lay', 'Snacks', 100, 255, 5678, 'Snack_Aisle', 22),
    ('67570', 'KitKat',  'Nestle', 'Snacks', 100, 42, 5678, 'Candy', 22);




CREATE TABLE supplier(
    id varchar(6) NOT NULL,
    name varchar(50),
    phoneNumber varchar(50),
    streetName varchar(50),
    country varchar(50),
    city varchar(50),
    postalCode varchar(50),
    PRIMARY KEY (id)
);

INSERT INTO `supplier` (`id`, `name`, `phoneNumber`, `streetName`, `country`, `city`, `postalCode`) VALUES
    ('344479', 'CompanyY', '4034034003', '123 Fakestreet Blvd.', 'Canada', 'Ottawa', 'H7Y3T3'),
    ('345678', 'CompanyX', '5678903333', '43 SomeStreet Close', 'Canada', 'Ottawa', 'H7Y8U7'),
    ('145978', 'CompanyZ', '0987443333', '99 StreetStreet Drive', 'Canada', 'Vancouver', 'E3Y8X9');


CREATE TABLE deliveries(
    invoiceNum int(100) NOT NULL,
    dateOrdered DATE,
    timeOrdered TIME,
    dateScheduled DATE,
    timeScheduled TIME,
    PRIMARY KEY (invoiceNum)
);


INSERT INTO `deliveries` (`invoiceNum`, `dateOrdered`, `timeOrdered`, `dateScheduled`, `timeScheduled`) VALUES
    (42356, '2021-03-14', '13:20:06', '2021-03-21', '9:00:00'),
    (42357, '2021-04-15', '15:46:54', '2021-04-22', '7:00:00');


CREATE TABLE schedule (
    scheduleNum int(100) NOT NULL,
    deliveryInvoiceNum int(100) NOT NULL,
    PRIMARY KEY(scheduleNum) 
);

INSERT INTO `schedule` (`scheduleNum`, `deliveryInvoiceNum`) VALUES
    (100,'42356'),
    (101,'42357');

CREATE TABLE inventory (
    inventoryNum int(100) NOT NULL,
    storeNum int(100) NOT NULL,
    capacity int(255),
    PRIMARY KEY(inventoryNum)
);

INSERT INTO `inventory` (`inventoryNum`, `storeNum`, `capacity`) VALUES
    (1, 5678, 200),
    (2, 5678, 200),
    (3, 5678, 200);

CREATE TABLE customer(
    customerNum int NOT NULL,
    paymentMethod varchar(50),
    PRIMARY KEY (customerNum)
);

INSERT INTO `customer`(`customerNum`, `paymentMethod`) 
VALUES(7833, 'cash'),
      (1987, 'masterCard'),
      (1433, 'debit'),
      (2987, 'visa');

CREATE TABLE setsPrice(
    productNum varchar(8) NOT NULL,
    adminSSN varchar(10),
    price double,
    PRIMARY KEY (productNum, adminSSN),
    FOREIGN KEY(productNum) REFERENCES product (productNum) ON DELETE CASCADE,
    FOREIGN KEY(adminSSN) REFERENCES administrator (adminSSN) ON DELETE CASCADE
);

INSERT INTO `setsPrice` (`productNum`, `adminSSN`, `price`)
VALUES('10000', '444444444', 2.50),
	  ('00230', '444444444', 3.50),
	  ('20000', '444444444', 5.00),
	  ('67570', '444444444', 3.00);


CREATE TABLE buy(
    productNum varchar(8) NOT NULL,
    customerNum int NOT NULL,
    PRIMARY KEY (productNum, customerNum),
    FOREIGN KEY(productNum) REFERENCES product (productNum) ON DELETE CASCADE,
    FOREIGN KEY(customerNum) REFERENCES customer (customerNum) 
);


INSERT INTO `buy` (`customerNum`, `productNum`) 
VALUES(7833, '10000'),
      (1987, '67570'),
      (1433, '00230'),
      (2987, '20000');

CREATE TABLE addProduct(
mgrSSN varchar(10),
productNum varchar(8),
PRIMARY KEY(mgrSSN, productNum),
FOREIGN KEY (mgrSSN) REFERENCES manager(mgrSSN) ON DELETE CASCADE,
FOREIGN KEY (productNum) REFERENCES product(productNum) ON DELETE CASCADE
);

INSERT INTO `addProduct` (`mgrSSN`, `productNum`) VALUES
('333333333', '20000'),
('333333333', '67570'),
('333333333', '10000'),
('333333333', '00230');


CREATE TABLE updateProduct(
mgrSSN varchar(10),
productNum varchar(8),
PRIMARY KEY(mgrSSN, productNum),
FOREIGN KEY (mgrSSN) REFERENCES manager (mgrSSN) ON DELETE CASCADE,
FOREIGN KEY (productNum) REFERENCES product (productNum) ON DELETE CASCADE
);

INSERT INTO `updateProduct` (`mgrSSN`, `productNum`) VALUES
('333333333', '10000'),
('333333333', '00230'),
('333333333', '67570');


CREATE TABLE removeProduct(
mgrSSN varchar(10),
productNum varchar(8),
PRIMARY KEY(mgrSSN, productNum) ,
FOREIGN KEY (mgrSSN) REFERENCES manager (mgrSSN) ON DELETE CASCADE
);

INSERT INTO `removeProduct` (`mgrSSN`, `productNum`) VALUES
('333333333', '10002'),
('333333333', '99830');


CREATE TABLE clerkViewsSchedule(
clerkId varchar(6) NOT NULL,
scheduleNum int NOT NULL, 
PRIMARY KEY (clerkId, scheduleNum),
FOREIGN KEY (clerkId) REFERENCES employees(employeeId) ON DELETE CASCADE,
FOREIGN KEY (scheduleNum) REFERENCES schedule(scheduleNum) ON DELETE CASCADE
);

INSERT INTO `clerkViewsSchedule` (clerkID, scheduleNum) VALUES
('265078', 100),
('255098', 100);

CREATE TABLE mgrViewsSchedule(
mgrSSN varchar(10) NOT NULL,
scheduleNum int NOT NULL,
PRIMARY KEY (mgrSSN, scheduleNum),
FOREIGN KEY (mgrSSN) REFERENCES manager(mgrSSN) ON DELETE CASCADE,
FOREIGN KEY (scheduleNum) REFERENCES schedule(scheduleNum) ON DELETE CASCADE
);

INSERT INTO `mgrViewsSchedule` (`mgrSSN`, `scheduleNum`) VALUES
('333333333', 100),
('333333333', 101);