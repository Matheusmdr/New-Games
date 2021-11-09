CREATE DATABASE newgamesdb;

USE newgamesdb;

create TABLE users (
    id int not null AUTO_INCREMENT,
    name varchar(200) not null,
    email varchar(50) not null,
    password varchar(80) not null,
    country varchar(80) not null,
    city varchar(80) not null,
    zip_code char(8) not null,
    neighborhood varchar(80) not null,
    street varchar(80) not null,
    number int not null,
    primary key (id)
);
