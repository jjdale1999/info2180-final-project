/*  CREATION OF DATABASE*/
DROP DATABASE IF EXISTS users;
CREATE DATABASE users;
USE users;

/*  CREATION OF UserInfo Table*/
DROP TABLE IF EXISTS userInfo;
CREATE TABLE userInfo (
    id int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName char(40) NOT NULL ,
    lastName char(40) NOT NULL,
    pword char(40) NOT NULL,
    email char(40) NOT NULL,
    date_joined char(10) NOT NULL
);
insert into userInfo(firstName,lastName,pword,email,date_joined) values("lol","lol","password123",'admin@bugme.com',"lol");

/*  CREATION OF idInfo Table*/

DROP TABLE IF EXISTS issueInfo;
CREATE TABLE issueInfo(
id int(20)  NOT NULL  AUTO_INCREMENT PRIMARY KEY ,
title char(40) DEFAULT NULL,
descript char(255) DEFAULT NULL,
typ char(40) DEFAULT NULL,
pr char(40) DEFAULT NULL,
stat char(40) DEFAULT NULL,
assigned_to char(20) DEFAULT NULL,
created_by char(20) DEFAULT NULL,
created char(20) DEFAULT NULL,
updated char(20) DEFAULT NULL

);

insert into issueInfo(title,descript,typ,pr,stat,assigned_to,created_by,created,updated) values("My home page won't load","So I'm doing this webdev project and once I click my homepage, its all code everywhere","Bug","Low","OPEN","admin@bugme.com","corey@fixme.net","12/01/2019","12/01/2019");
insert into issueInfo(title,descript,typ,pr,stat,assigned_to,created_by,created,updated) values("XSS Vulnerability in Add User Form","XSS is highly state to the art and blah blah blah","Bug","Medium","OPEN","rahmoi.jnr@gmail.com","fixmylife@helpme.net","12/01/2019","12/01,2019");
insert into issueInfo (title,descript,typ,pr,stat,assigned_to,created_by,created,updated)values("Location Service isn't working","Well i was going to back road to get some and i wasn't entirely sure where to drive so ","Bug","OPEN","TAGM@woii.com","somewhere@something.com","12/01/2019","12/01/2019");
insert into issueInfo (title,descript,typ,pr,stat,assigned_to,created_by,created,updated)values("Setup Logger","We gonna log your setup basically","Proposal","Low","CLOSED","Marsha Brady","Tom Brady","12/01/2019","12/01/2019");

/*HI MY NAME IS COREY HOW CAN I BE OF ASSISTANCE TODAY?*/
/* more dummy values the ones in the pdf */
