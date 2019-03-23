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
    "Benjamin",
    "Ng",
    "123A blk b Signature Park",
    543216,
    "asdasdasd@gmail.com",
    81863873,
    "I like dogs herp derp accept my application",
    1,
    1,
    0
);