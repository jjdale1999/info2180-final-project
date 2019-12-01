/*  CREATION OF DATABASE*/
DROP DATABASE IF EXISTS users;
CREATE DATABASE users;
USE users;

/*  CREATION OF UserInfo Table*/
DROP TABLE IF EXISTS userInfo;
CREATE TABLE userInfo (
    id VARCHAR(20) NOT NULL PRIMARY KEY,
    firstName char(40) NOT NULL ,
    lastName char(40) NOT NULL,
    pword char(40) NOT NULL,
    email char(40) NOT NULL,
    date_joined char(10) NOT NULL
);
insert into userInfo values(1,"lol","lol","password123",'admin@bugme.com',"lol");

/*  CREATION OF idInfo Table*/

DROP TABLE IF EXISTS issueInfo;
CREATE TABLE issueInfo(
id char(20)  NOT NULL PRIMARY KEY,
title char(40) DEFAULT NULL,
descript char(500) DEFAULT NULL,
typ char(40) DEFAULT NULL,
pr char(40) DEFAULT NULL,
stat char(40) DEFAULT NULL,
assigned_to char(20) DEFAULT NULL,
created_by char(20) DEFAULT NULL,
created char(20) DEFAULT NULL,
updated char(20) DEFAULT NULL

);

insert into issueInfo values("2","My home page won't load","So I'm doing this webdev project and once I click my homepage, its all code everywhere","Bug","Low","OPEN","admin@bugme.com","corey@fixme.net","12/01/2019","12/01/2019");
insert into issueInfo values(#)


/*HI MY NAME IS COREY HOW CAN I BE OF ASSISTANCE TODAY?*/
/* more dummy values the ones in the pdf */
