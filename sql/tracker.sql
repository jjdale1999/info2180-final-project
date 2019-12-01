/*  CREATION OF DATABASE*/
DROP DATABASE IF EXISTS users;
CREATE DATABASE users;
USE users;

/*  CREATION OF UserInfo Table*/
DROP TABLE IF EXISTS userInfo;
CREATE TABLE userInfo(
id VARCHAR(20)  NOT NULL PRIMARY KEY,
firstName char(40)  NOT NULL ,
lastName char(40) NOT NULL,
pword char(40) NOT NULL,
email   char(40) NOT NULL,
date_joined char(10) NOT NULL,
)



/*  CREATION OF idInfo Table*/

DROP TABLE IF EXISTS issueInfo;
CREATE TABLE issueInfo(
id char(20)  NOT NULL PRIMARY KEY,
title char(40) DEFAULT NULL,
descript char(40) DEFAULT NULL,
typ char(40) DEFAULT NULL,
pr char(40) DEFAULT NULL,
stat char(40) DEFAULT NULL,
assigned_to char(20) DEFAULT NULL,
created_by char(20) DEFAULT NULL,
created char(20) DEFAULT NULL,
updated char(20) DEFAULT NULL,
)






insert into userInfo values(1,"lol","lol",$hashedPw,'admin@bugme.com',"lol");