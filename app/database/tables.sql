create database if not exists newgamesdb;
use newgamesdb;

SET GLOBAL log_bin_trust_function_creators = 1;
SET FOREIGN_KEY_CHECKS=0;
SET GLOBAL FOREIGN_KEY_CHECKS=0;

-- ---------------------------------------------------------------
-- 							TABELAS
-- ---------------------------------------------------------------

create table if not exists supplier(
	id_supplier int not null auto_increment,
    supplier_name varchar(120) not null,
    primary_phone varchar(120) not null,
    secondary_phone varchar(120),
    primary_email varchar(120) not null,
    secondary_email varchar(120),
    website varchar(120),
    fee float not null,
    
    primary key(id_supplier)
);

create table if not exists category(
	id_category int auto_increment,
    category_name varchar(120) not null,
    category_description varchar(200),
    
    primary key(id_category)
);

create table if not exists game(
	id_game int auto_increment,
    game_name varchar(120) not null unique,
    price decimal(6,2) not null,
    img varchar(120) not null,
    supplier int not null,
    feature enum('0','1') not null,
    
    primary key(id_game),
    foreign key(supplier) references supplier(id_supplier)
);

CREATE TABLE cart ( 
    id_cart int(11) NOT NULL AUTO_INCREMENT, 
    game_name varchar(120) NOT NULL, 
    game_price decimal(6,2) NOT NULL, 
    game_image varchar(120) NOT NULL, 
    total_amount varchar(100) NOT NULL, 
    id_game int(11) NOT NULL, 
    PRIMARY KEY(id_cart), 
    FOREIGN KEY(id_game) references game(id_game) 
);

create table if not exists connection_game_category(
	id_game int not null,
    id_category int not null,
    
    foreign key(id_game) references game(id_game),
    foreign key(id_category) references category(id_category)
);

create table if not exists library(
	id_lib int not null auto_increment,
    
    primary key(id_lib)
);

create table if not exists connection_lib_and_game(
	id_game int not null,
    id_lib int not null,
    
    foreign key(id_game) references game(id_game),
    foreign key(id_lib) references library(id_lib)
);

create table if not exists wishlist(
	id_wishlist int not null auto_increment,
    
    primary key(id_wishlist)
);

create table if not exists connection_wishlist_and_game(
	id_game int not null,
    id_wishlist int not null,
    
    foreign key(id_game) references game(id_game),
    foreign key(id_wishlist) references wishlist(id_wishlist)
);


create table if not exists clients (
    id_client int not null auto_increment,
    client_name varchar(200) not null,
    email varchar(50) not null unique,
    client_password varchar(255) not null,
    id_lib int not null,
    id_wishlist int not null,
    
    primary key (id_client),
    foreign key(id_lib) references library(id_lib),
    foreign key(id_wishlist) references wishlist(id_wishlist)
);

create table if not exists purchase(
	id_purchase int not null auto_increment,
    date_time datetime not null,
    cost decimal(10,2) not null,
    discount decimal(6,2),
    payment_method varchar(120) not null,
    payment_installments tinyint not null,
    id_client int not null,
    
    primary key(id_purchase),
    foreign key(id_client) references clients(id_client)
);

create table if not exists connection_purchase_game(
	id_game int not null,
    id_purchase int not null,
    
    
    foreign key(id_game) references game(id_game),
    foreign key(id_purchase) references purchase(id_purchase)
);

create table if not exists employee(
	id_employee int not null auto_increment,
    employee_name varchar(200) not null,
    email varchar(200) not null unique,
    employee_password varchar(255) not null,
    adress int not null,
    
    primary key(id_employee)
);

create table if not exists budget(
	input float not null,
    output double not null,
    date_time datetime not null,
    transation_description varchar(200) not null
);