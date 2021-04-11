CREATE TABLE customer(
    CustomerNum int() NOT NULL,
    PaymentMethod varchar(50),
    PRIMARY KEY (CustomerNum)
);

INSERT INTO `customer`(`CustomerNum`, `PaymentMethod`) 
VALUES(7833, 'Cash'),
      (1987, 'MasterCard'),
      (1433, 'Debit'),
      (2987, 'Visa');


CREATE TABLE manager(
    MgrSSN varchar(10),
    ID varchar(9) NOT NULL,
    StoreLocation varchar(50),
    PRIMARY KEY (MgrSSN),
    FOREIGN KEY(ID) REFERENCES employee (EmployeeID)
);

INSERT INTO `manager` (`MgrSSN`, `ID`, `StoreLocation`)
VALUES('365789', '098765', 'Calgary');



CREATE TABLE clerk(
    MgrSSN varchar(10),
    ID varchar(9) NOT NULL,
    YearsEmployed int(),
    HourlyWage float(),
    PRIMARY KEY (ID),
    FOREIGN KEY(MgrSSN) REFERENCES manager (MgrSSN)
);

INSERT INTO `clerk` (`MgrSSN`, `ID`, `HourlyWage`, `YearsEmployed`)
VALUES('365789', '657456', 16.50, 2),
      ('365789', '657455', 18.00, 3);


CREATE TABLE administrator(
    Name varchar(50),
    AdminSSN varchar(10),
    ID varchar(9) NOT NULL,
    StoreLocation varchar(50),
    PRIMARY KEY (Admin_SSN),
    FOREIGN KEY(ID) REFERENCES employee (EmployeeID)
);

INSERT INTO `administrator` (`AdminSSN`, `ID`, `StoreLocation`)
VALUES('365777', '123456', 'Calgary');


CREATE TABLE setsPrice(
    ProductNum varchar(8) NOT NULL,
    AdminSSN varchar(10),
    Price double(),
    PRIMARY KEY (ProductNum, AdminSSN),
    FOREIGN KEY(ProductNum) REFERENCES product (ProductNum),
    FOREIGN KEY(AdminSSN) REFERENCES administrator (AdminSSN)
);

INSERT INTO `setsPrice` (`ProductNum`, `AdminSSN`, `Price`)
VALUES('10000', '365777', 2.50),
	  ('00230', '365777', 3.50),
	  ('20000', '365777', 5.00),
	  ('67570', '365777', 3.00);


CREATE TABLE buy(
    ProductNum varchar(8) NOT NULL,
    CustomerNum int() NOT NULL,
    Price double(),
    PRIMARY KEY (ProductNum, CustomerNum),
    FOREIGN KEY(ProductNum) REFERENCES product (ProductNum),
    FOREIGN KEY(CustomerNum) REFERENCES customer (CustomerNum)
);


INSERT INTO `buy` (`CustomerNum`, `ProductNum`) 
VALUES(7833, '10000'),
      (1987, '67570'),
      (1433, '00230'),
      (2987, '20000');





