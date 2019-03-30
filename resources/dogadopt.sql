DROP DATABASE IF EXISTS Dog_Application;

CREATE DATABASE Dog_Application;

CREATE TABLE Dog_Application.DOG_ADOPT (
  Application_ID varchar(255) PRIMARY KEY,
    FirstName varchar(255),
    LastName varchar(255),
    Address varchar(255),
    PostalCode int(6),
    Email varchar(255) UNIQUE,
    PhoneNo int(8),
    Reason TEXT,
    DogID int(25),
    Application_Status varchar(25), #See if application is approved, pending or rejected
    Payment_Status varchar(25) #paid or payment due
);

INSERT INTO Dog_Application.DOG_ADOPT VALUES (
    "123abc",
    "Lum",
    "Eng Kit",
    "SMU Information System, Room 80-04-056",
    178902,
    "eklum@smu.edu.sg",
    68280278,
    "I am the co-instructor of IS213, Enterprise Solution Development.",
    43674230,
    "Pending",
    "Approved"
), (
    "321xyz",
    "Venky",
    "Shankararaman",
    "SMU Information System, Room 80-05-024",
    178902,
    "venky@smu.edu.sg",
    68280931,
    "I am the instructor of IS213, Enterprise Solution Development",
    43674230,
    "Pending",
    "Approved"
), (
    "321abc",
    "Jane",
    "Seah Hing Kid",
    "Somewhere in SMU",
    178902,
    "jane.seah.2016@smu.edu.sg",
    87654321,
    "I am the slave of IS213 class G1, I like dogs",
    43943559,
    "Pending",
    "Approved"
);
