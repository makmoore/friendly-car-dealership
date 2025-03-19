CREATE DATABASE FriendlyCarDealership;
USE FriendlyCarDealership;

CREATE TABLE Customers (
    cusID INT(5) AUTO_INCREMENT PRIMARY KEY,
    cusFirstName VARCHAR(20) NOT NULL,
    cusLastName VARCHAR(20) NOT NULL,
    street VARCHAR(50),
    city VARCHAR(15),
    state CHAR(2),
    zip CHAR(5),
    cusEmail VARCHAR(50),
    cusPhone VARCHAR(14),
    cusNotes MEDIUMTEXT
);

CREATE TABLE PriceSticker (
    vehicleID CHAR(6) PRIMARY KEY,
    capacity INT(2),
    color ENUM('Black','White','Silver','Red','Blue','Green','Gray','Yellow','Orange','Brown', 'Other') NOT NULL,
    model VARCHAR(20),
    dateOfManufacture DATE,
    placeOfManufacture VARCHAR(20),
    deliveryDate DATE NOT NULL,
    mileageAtDelivery INT(6) NOT NULL,
    numCylinders INT(2),
    numDoors INT(1) DEFAULT 4,
    weight INT(4),
    otherOptions MEDIUMTEXT
);


CREATE TABLE BillOfSale (
    BillofSaleID CHAR(8) PRIMARY KEY,
    CopyRetained BOOLEAN NOT NULL,
    CurrentMileage VARCHAR(7) NOT NULL,
    Delivery DATE NOT NULL,
    FinancingInfo MEDIUMTEXT,
    NewOrUsed ENUM('New', 'Used'),
    Price INT(9) NOT NULL,
    SalespersonName VARCHAR(50) NOT NULL,
    Specifications MEDIUMTEXT,
    WarrantyInfo MEDIUMTEXT,
    vehicleID CHAR(6),
    cusID INT(5),
    CONSTRAINT BoS_vID_FK FOREIGN KEY (vehicleID) REFERENCES PriceSticker(vehicleID),
	CONSTRAINT BoS_cID_FK FOREIGN KEY (cusID) REFERENCES Customers(cusID)
);

CREATE TABLE InsuranceAndTax (
    LPnum VARCHAR(7) PRIMARY KEY,
    DateReleasedToOwner DATE NOT NULL,
    LicenseFee INT(5) DEFAULT 0,
    proofOfInsurance VARCHAR(100),
    StateSalesTax VARCHAR(10),
    BillofSaleID CHAR(8) NOT NULL,
	CONSTRAINT IaT_BoSID_FK FOREIGN KEY (BillofSaleID) REFERENCES BillOfSale(BillofSaleID)
);
    
CREATE TABLE SalesReport (
    ReportID VARCHAR(6) PRIMARY KEY,
    CommissionEarned INT(10) DEFAULT 0,
    ReportFrequency VARCHAR(10),
    SalesData MEDIUMTEXT,
    cusID INT(5),
    BillofSaleID CHAR(8),
	CONSTRAINT SR_cID_FK FOREIGN KEY (cusID) REFERENCES Customers(cusID),
	CONSTRAINT SR_BoSID_FK FOREIGN KEY (BillofSaleID) REFERENCES BillOfSale(BillofSaleID)
);

CREATE TABLE Survey (
    SurveyTime DATETIME,
    Recipient VARCHAR(25),
    SurveyContent LONGTEXT,
    cusID INT(5),
	CONSTRAINT PRIMARY KEY (cusID, SurveyTime),
	CONSTRAINT S_cID_FK FOREIGN KEY (cusID) REFERENCES Customers(cusID) ON DELETE CASCADE
);
