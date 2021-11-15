create database if not exists newgamesdb;

use newgamesdb;

-- SET FOREIGN_KEY_CHECKS=0;
-- SET GLOBAL FOREIGN_KEY_CHECKS=0;


-- Criação do banco ----------------------------------------------
-- tabelas ----------------------------------------------
create table if not exists game(
    id_game int auto_increment,
    game_name varchar(120) not null,
    game_category int not null,
    game_price decimal(6,2),
    game_img varchar(120) not null,
    
    primary key(id_game)
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

create table if not exists users (
    id_users int not null auto_increment,
    users_name varchar(200) not null,
    users_email varchar(50) not null,
    users_password varchar(80) not null,
    users_country varchar(80) not null,
    users_city varchar(80) not null,
    users_zip_code char(8) not null,
    users_neighborhood varchar(80) not null,
    users_street varchar(80) not null,
    users_number int not null,
    id_lib int not null,
    id_wishlist int not null,
    
    primary key (id_users),
    foreign key(id_lib) references library(id_lib),
    foreign key(id_wishlist) references wishlist(id_wishlist)
);

-- Triggers ---------------------------------------------------------
/*Inicializa uma biblioteca de jogos para cada usuário criado. Caso apresente algum erro, a mesma já elimina a biblioteca criada*/
delimiter $$
create trigger user_before_insert before insert on users
for each row
begin
	begin
		declare id_library int;
    
		declare exit handler for sqlexception
		begin
			delete from library where id_lib = id_library;
		end;
    
		insert into library(id_lib) values(null);
		select last_insert_id() into id_library;
    
		set new.id_lib = id_library;
	end;
    
	begin
		declare id_wishl int;
    
		declare exit handler for sqlexception
		begin
			delete from wishlist where id_wishlist = id_wishl;
		end;
    
		insert into wishlist(id_wishlist) values(null);
		select last_insert_id() into id_wishl;
    
		set new.id_wishlist = id_wishl;
	end;
    
    if new.users_name = null then
        signal sqlstate '45000' set message_text = 'no username', mysql_errno = 1364;
    end if;

    if new.users_email = null then
        signal sqlstate '45000' set message_text = 'no email', mysql_errno = 1364;
    end if;

    if new.users_password = null then
        signal sqlstate '45000' set message_text = 'no password', mysql_errno = 1364;
    end if;    
    
    if new.users_country = null then
        signal sqlstate '45000' set message_text = 'no country', mysql_errno = 1364;
    end if;   

    if new.users_city = null then
        signal sqlstate '45000' set message_text = 'no city', mysql_errno = 1364;
    end if;       
    
    if new.users_zip_code = null then
        signal sqlstate '45000' set message_text = 'no zip code', mysql_errno = 1364;
    end if;    
    
    if new.users_neighborhood = null then
        signal sqlstate '45000' set message_text = 'no neighborhood', mysql_errno = 1364;
    end if;     
    
    if new.users_street = null then
        signal sqlstate '45000' set message_text = 'no street', mysql_errno = 1364;
    end if;     
    
    if new.users_number = null then
        signal sqlstate '45000' set message_text = 'no number', mysql_errno = 1364;
    end if;     
end$$
delimiter ;

-- ----------------------------------------------------------------------------

-- inserção do banco ----------------------------------------------
-- inserindo jogos
insert into game(game_name,game_category,game_price,game_img) values("Persona 5 Strikers",0,59.99,"Persona5S.jpg");
insert into game(game_name,game_category,game_price,game_img) values("Dark Souls 3",0,59.99,"darksouls3.jpg");
insert into game(game_name,game_category,game_price,game_img) values("Devil May Cry 5",2,24.99,"devil-may-cry-5.jpg");
insert into game(game_name,game_category,game_price,game_img) values("Cyberpunk 2077",0,47.99,"cyberpunk.jpg");
insert into game(game_name,game_category,game_price,game_img) values("Super Bomberman R Online",4,9.99,"Super-Bomberman-R.jpg");
insert into game(game_name,game_category,game_price,game_img) values("Sekiro: Shadows Die Twice",2,59.99,"Sekiro-Shadows-Die-Twice.jpg");
insert into game(game_name,game_category,game_price,game_img) values("KINGDOM HEARTS III + Re Mind",0,59.99,"EGS_KINGDOMHEARTSIIIReMindDLC.jpg");
insert into game(game_name,game_category,game_price,game_img) values("Rocket League",4,9.99,"rocketleague.jpg");
insert into game(game_name,game_category,game_price,game_img) values("Nioh 2",2,39.99,"nioh2.jpg");
insert into game(game_name,game_category,game_price,game_img) values("The Witcher 3: Wild Hunt",0,7.99,"the-witcher-3-wild-hunt.jpg");
insert into game(game_name,game_category,game_price,game_img) values("Red Dead Redemption 2",2,14.99,"ReadDeadRedemption 2.jpg");
insert into game(game_name,game_category,game_price,game_img) values("Hollow Knight",3,14.99,"hollowknight.jpg");
insert into game(game_name,game_category,game_price,game_img) values("Sonic Mania",3,9.99,"SonicMania.jpg");
insert into game(game_name,game_category,game_price,game_img) values("Dead Cells",3,24.99,"DeadCells.jpg");
insert into game(game_name,game_category,game_price,game_img) values("Resident Evil Village",1,79.99,"RESIDENT-EVIL-8-1.jpg");

-- select * from game;

-- inserindo usuário
insert into users(users_name,users_email,users_password,users_country,users_city,users_zip_code,users_neighborhood,users_street,users_number) 
    values("Maria Antônia Silva","maria.ant@gmail.com",md5("senha123"),"Brazil","São Paulo","1000000","Bairro teste","Rua teste",158);

insert into users(users_name,users_email,users_password,users_country,users_city,users_zip_code,users_neighborhood,users_street,users_number) 
    values("Antônio","ant.ant@gmail.com",md5("senha123"),"Brazil","São Paulo","1000000","Bairro teste","Rua teste",158);

insert into users(users_name,users_email,users_password,users_country,users_city,users_zip_code,users_neighborhood,users_street,users_number) 
    values("Joana","joana@gmail.com",md5("senha123"),"Brazil","São Paulo","1000000","Bairro teste","Rua teste",158);

-- testes
-- add game na lib
insert into connection_lib_and_game(id_game,id_lib) values(2,1);

-- delete from users where id_users = 4;

-- drop table users;
select * from users;
select * from game;
select * from library;
select * from wishlist;
select * from connection_lib_and_game;
select * from connection_wishlist_and_game;
-- drop schema newgamesdb;
