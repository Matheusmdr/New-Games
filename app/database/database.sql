/*
	O arquivo está organizado como: 
		1 - TABELAS
        2 - PROCEDURES
        3 - FUNCTIONS
        4 - TRIGGERS 
        5 - INSERÇÕES
*/

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

-- ---------------------------------------------------------------
-- 							PROCEDURES
-- ---------------------------------------------------------------

/*atualiza o registro de orçamento da empresa */
delimiter $$
create procedure update_budget(id int)
begin
	declare temp float;
	set temp = compute_yeld_single_purchase(id);
	insert into budget(input,output,date_time, transation_description)
		values(temp,0.00, (select date_time from purchase where id_purchase = id),concat("purchase ", id) );
end$$
delimiter ;
-- ----------------------------------------------------------------------------
/*Faz a compra de um jogo (cliente) */
delimiter $$
create procedure buy_game(date_t datetime,cost_ decimal(10,2),disc decimal(6,2),pay_m varchar(120),pay_inst tinyint,id_cl int, id_g int, lib int)
begin
	insert into purchase(date_time,cost,discount,payment_method,payment_installments,id_client) values(date_t,cost_,disc,pay_m,pay_inst,id_cl);
	insert into connection_purchase_game(id_game,id_purchase) values(id_g, (select id_purchase from purchase where id_client = id_cl and date_time = date_t) );
    call update_budget((select id_purchase from purchase where id_client = id_cl and date_time = date_t));
    insert into connection_lib_and_game(id_game,id_lib) values(id_g,lib);
end$$
delimiter ;
-- call buy_game('2023-10-21 23:59:59',9.99,0.99,"credit card",1,1,8,1);

-- ----------------------------------------------------------------------------
/*adiciona um novo jogo na loja*/
delimiter $$
create procedure add_game(sup_name varchar(120), p_phone varchar(120), sec_phone varchar(120), p_email varchar(120), sec_email varchar(120),  website varchar(120), fee float, g_name varchar(200), price decimal(6,2), img_path varchar(200), cate_name varchar(120), cate_desc varchar(200), feature_status enum('0','1'))
begin
	if ( (select count(1) from supplier where supplier_name = sup_name) = 0) then
		insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values(sup_name,p_phone,sec_phone,p_email,sec_email,website,fee);
    end if;
	
	insert into game(game_name, price, img, supplier,feature) values(g_name,price,img_path, (select id_supplier from supplier where supplier_name = sup_name),feature_status);
    
    if ( (select count(1) from category where category_name = cate_name) = 0) then
		insert into category(category_name,category_description) values(cate_name, cate_desc);
    end if;
    
    insert into connection_game_category(id_game,id_category) values((select id_game from game where game_name = g_name), (select id_category from category where category_name = cate_name) );
end$$
delimiter ;
-- call add_game("teste","+08551130068215","+1952137062215","psyonix1@gmail.com", "psyonix2@gmail.com","https://www.psyonix.com/",0.51,"Cuy2077",47.99,"cyberpunk.jpg", "RPG", "No description.");

-- ----------------------------------------------------------------------------
/*adiciona um novo cliente no sistema */
delimiter $$
create procedure add_client(name_ varchar(200),mail varchar(50),psw varchar(255))
begin
	insert into clients(client_name,email,client_password) values(name_,mail,psw);
end$$
delimiter ;

-- ----------------------------------------------------------------------------
/*adiciona funcionários*/
delimiter $$
create procedure add_employee(name_ varchar(200),mail varchar(50),psw varchar(255))
begin
	insert into employee(employee_name,email,employee_password) values(name_,mail, psw);
end$$
delimiter ;

-- -------------------------------------------------------------------------------------------------------
/*código da compra, nome de quem realizou a compra, quando, o que foi comprado, id_game e para qual lib*/
delimiter $$
create procedure all_purchase_info()
begin
	select purchase.id_purchase, clients.client_name, purchase.date_time, game.game_name, game.id_game, clients.id_lib
		from game 
			inner join connection_purchase_game on game.id_game = connection_purchase_game.id_game
			inner join purchase on connection_purchase_game.id_purchase = purchase.id_purchase
			inner join clients on purchase.id_client = clients.id_client;
end$$
delimiter ;

-- call add_employee("JoAo Antônio Soares","joao_intonio@gmail.com","senha123");
-- call add_client("JoAo Antônio Soares","joao_intonio@gmail.com","senha123");


-- call add_employee("JoAo Antônio Soares","joao_intonio@gmail.com","senha123");
-- call add_client("JoAo Antônio Soares","joao_intonio@gmail.com","senha123");

-- ---------------------------------------------------------------
-- 							TRIGGERS
-- ---------------------------------------------------------------

/*Inicializa uma biblioteca de jogos para cada usuário criado. Caso apresente algum erro, a mesma já elimina a biblioteca criada*/
delimiter $$
create trigger user_before_insert before insert on clients
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
    
    if new.client_name = null then
        signal sqlstate '45000' set message_text = 'no username', mysql_errno = 1364;
    end if;

    if new.email = null then
        signal sqlstate '45000' set message_text = 'no email', mysql_errno = 1364;
    end if;

    if new.client_password = null then
        signal sqlstate '45000' set message_text = 'no password', mysql_errno = 1364;
    end if;    
       
end$$
delimiter ;

-- ----------------------------------------------------------------------------
/*deleta a lib e wishlist do usuário, para elas n existirem qnd ele for deletado*/
delimiter $$
create trigger user_after_delete after delete on clients
for each row
begin
	delete from library where id_lib = old.id_lib;
    delete from connection_lib_and_game where id_lib = old.id_lib;
    delete from wishlist where id_wishlist = old.id_wishlist;
    delete from connection_wishlist_and_game where id_wishlist = old.id_wishlist;
end$$
delimiter ;

-- ---------------------------------------------------------------
-- 							FUNÇÕES
-- ---------------------------------------------------------------

/*verifica se o usuário já tem o game*/
delimiter $$
create function verify_game_existence_into_client_lib(id_lib_ int, id_game_ int)
returns boolean
begin
	declare flag boolean;
    declare test int;
    set flag = false;
 
    if ((select count(1) from connection_lib_and_game where (id_lib = id_lib_ and id_game = id_game_)) = 1) then
		set flag = true;
	end if;
    
    return flag;
end$$
delimiter ;
-- ----------------------------------------------------------------------------
/*calcula o quanto a New Games receberá por aquela compra*/
delimiter $$
create function compute_yeld_single_purchase(purchase int)
returns float
begin
	declare result float;
    
	select sum((1-supplier.fee)*game.price) into result
	from connection_purchase_game
		inner join game on connection_purchase_game.id_game = game.id_game
        inner join supplier on game.supplier = id_supplier
	where connection_purchase_game.id_purchase = purchase;
    
    return result;
end$$
delimiter ;
-- ----------------------------------------------------------------------------
/*calcula o orçamento*/
delimiter $$
create function compute_total_yeld()
returns double
begin
	declare result float;
    
	select sum(input) into result from budget;
    
    return result;
end$$
delimiter ;

-- select compute_total_yeld();


-- ---------------------------------------------------------------
-- 							INSERÇÕES
-- ---------------------------------------------------------------

-- inserindo funcionários 
insert into employee(employee_name,email,employee_password) values("Rodrigo Araújo Neto","rodrigo_araujo@gmail.com",MD5("senha123"));

-- inserindo fornecedores
insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values("SEGA","+551139068215","+551137062215","sega1@gmail.com", "sega2@gmail.com","https://www.sega.com",0.50);
insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values("CAPCOM","+551139068635","+551137002150","capcom1@gmail.com", "capcom2@gmail.com","https://www.capcom.com/",0.66);
insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values("CD PROJEKT RED","+551139068005","+55113700205","cdprojektred1@gmail.com", "cdprojektred2@gmail.com","https://en.cdprojektred.com/",0.80);
insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values("BANDAI NAMCO","+551139000215","+551137062255","bandai1@gmail.com", "bandai2@gmail.com","https://www.bandainamcoent.com/pt-br/",0.90);
insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values("KOEI TECMO","+551139068215","+551137062215","koeitecmo1@gmail.com", "koeitecmo2@gmail.com","https://www.koeitecmo.co.jp/e/company/",0.33);
insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values("Rockstar Games","+551130068215","+552137062215","rockstar1@gmail.com", "rockstar2@gmail.com","https://www.rockstargames.com/",0.25);
insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values("方块游戏 (CubeGame)","+5551130068215","+5552137062215","cubegame1@gmail.com", "cubegame2@gmail.com","https://www.cubejoy.com/",0.258);
insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values("SQUARE ENIX","+5551130068215","+5552137062215","square_enix1@gmail.com", "square_enix2@gmail.com","https://square-enix-games.com/pt_BR/home",0.89);
insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values("Team Cherry","+8551130068215","+5952137062215","teamcherry1@gmail.com", "teamcherry2@gmail.com","https://www.teamcherry.com.au/",0.55);
insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values("Motion Twin","+9551130068215","+7952137062215","motiontwin1@gmail.com", "motiontwin2@gmail.com","http://motion-twin.com/en/",0.48);
insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values("KONAMI","+2551130068215","+3952137062215","konami1@gmail.com", "konami2@gmail.com","https://www.konami.com/en/",0.39);
insert into supplier(supplier_name,primary_phone,secondary_phone,primary_email, secondary_email,website,fee) values("PSYONIX","+08551130068215","+1952137062215","psyonix1@gmail.com", "psyonix2@gmail.com","https://www.psyonix.com/",0.51);

-- inserindo categoria dos jogos
insert into category(category_name, category_description) values("RPG","Game genre in which players advance through a story quest, and often many side quests, for which their character or party of characters gain experience that improves various attributes and abilities.");
insert into category(category_name, category_description) values("Survival horror","No description.");
insert into category(category_name, category_description) values("Action","No description.");
insert into category(category_name, category_description) values("Platform","No description.");
insert into category(category_name, category_description) values("Multiplayer","No description.");

-- inserindo jogos
insert into game(game_name, price, img, supplier) values("Persona 5 Strikers",59.99,"Persona5S.jpg",1);
insert into game(game_name, price, img, supplier) values("Resident Evil Village",79.99,"RESIDENT-EVIL-8-1.jpg",2);
insert into game(game_name, price, img, supplier) values("Cyberpunk 2077",47.99,"cyberpunk.jpg",3);
insert into game(game_name, price, img, supplier) values("Dark Souls 3",59.99,"darksouls3.jpg",4);
insert into game(game_name, price, img, supplier) values("The Witcher 3: Wild Hunt",7.99,"the-witcher-3-wild-hunt.jpg",3);
insert into game(game_name, price, img, supplier) values("Devil May Cry 5",24.99,"devil-may-cry-5.jpg",2);
insert into game(game_name, price, img, supplier) values("Nioh 2",39.99,"nioh2.jpg",5);
insert into game(game_name, price, img, supplier) values("Red Dead Redemption 2",14.99,"ReadDeadRedemption_2.jpg",6);
insert into game(game_name, price, img, supplier) values("Sekiro: Shadows Die Twice",59.99,"Sekiro-Shadows-Die-Twice.jpg",7);
insert into game(game_name, price, img, supplier) values("KINGDOM HEARTS III + Re Mind",59.99,"EGS_KINGDOMHEARTSIIIReMindDLC.jpg",8);
insert into game(game_name, price, img, supplier) values("Hollow Knight",14.99,"hollowknight.jpg",9);
insert into game(game_name, price, img, supplier) values("Sonic Mania",9.99,"SonicMania.jpg",1);
insert into game(game_name, price, img, supplier) values("Dead Cells",24.99,"DeadCells.jpg",10);
insert into game(game_name, price, img, supplier) values("Super Bomberman R Online",9.99,"Super-Bomberman-R.jpg",11);
insert into game(game_name, price, img, supplier) values("Rocket League",9.99,"rocketleague.jpg",12);

-- inserindo conexão entre jogo e categoria
insert into connection_game_category(id_game,id_category) values(1,1);
insert into connection_game_category(id_game,id_category) values(2,2);
insert into connection_game_category(id_game,id_category) values(3,1);
insert into connection_game_category(id_game,id_category) values(4,1);
insert into connection_game_category(id_game,id_category) values(5,1);
insert into connection_game_category(id_game,id_category) values(6,3);
insert into connection_game_category(id_game,id_category) values(7,3);
insert into connection_game_category(id_game,id_category) values(8,3);
insert into connection_game_category(id_game,id_category) values(9,3);
insert into connection_game_category(id_game,id_category) values(10,1);
insert into connection_game_category(id_game,id_category) values(11,4);
insert into connection_game_category(id_game,id_category) values(12,4);
insert into connection_game_category(id_game,id_category) values(13,4);
insert into connection_game_category(id_game,id_category) values(14,5);
insert into connection_game_category(id_game,id_category) values(15,5);

-- inserindo cliente ---------------------------------------------------
insert into clients(client_name,email,client_password) values("João Antônio Soares","joao_antonio@gmail.com",MD5("senha123"));
insert into clients(client_name,email,client_password) values("Maria Joana Costa","maria_joana@gmail.com",MD5("senha123"));
insert into clients(client_name,email,client_password) values("Augusto Pereira Silva","augusto_pereira@gmail.com",MD5("senha123"));

select * from library; -- lib e wishlist são criadas automaticamente ao inserir cliente

-- Compra ------------------------------------------------------------------------------------------
-- Setando Timezone correta (Brasil/São Paulo)
SET @@global.time_zone = '+03:00';
SET GLOBAL time_zone = '+3:00';

-- registrando compra
insert into purchase(date_time,cost,discount,payment_method,payment_installments,id_client) values('2021-09-01 23:59:59',9.99,0.99,"credit card",1,1);
insert into purchase(date_time,cost,discount,payment_method,payment_installments,id_client) values('2021-09-02 20:50:59',14.99,0.99,"credit card",1,1);
insert into purchase(date_time,cost,discount,payment_method,payment_installments,id_client) values('2021-10-05 14:50:59',24.98,0.00,"credit card",1,2);
insert into purchase(date_time,cost,discount,payment_method,payment_installments,id_client) values('2021-10-05 21:10:08',39.99,0.00,"credit card",1,3);

-- registrando o que foi comprado e em qual registro de compra
insert into connection_purchase_game(id_game,id_purchase) values(12,1);
insert into connection_purchase_game(id_game,id_purchase) values(8,1);
insert into connection_purchase_game(id_game,id_purchase) values(11,2);
insert into connection_purchase_game(id_game,id_purchase) values(11,3);
insert into connection_purchase_game(id_game,id_purchase) values(12,3);
insert into connection_purchase_game(id_game,id_purchase) values(7,4);

-- inserindo games comprados nas libs
insert into connection_lib_and_game(id_game,id_lib) values(12,1);
insert into connection_lib_and_game(id_game,id_lib) values(8,1);
insert into connection_lib_and_game(id_game,id_lib) values(11,1);
insert into connection_lib_and_game(id_game,id_lib) values(11,2);
insert into connection_lib_and_game(id_game,id_lib) values(12,2);
insert into connection_lib_and_game(id_game,id_lib) values(7,3);

select verify_game_existence_into_client_lib(3,7);

-- games na wishlist --------------------------------
insert into connection_wishlist_and_game(id_game,id_wishlist) values(3,1);
insert into connection_wishlist_and_game(id_game,id_wishlist) values(1,1);
insert into connection_wishlist_and_game(id_game,id_wishlist) values(2,2);
insert into connection_wishlist_and_game(id_game,id_wishlist) values(9,3);
insert into connection_wishlist_and_game(id_game,id_wishlist) values(3,2);
insert into connection_wishlist_and_game(id_game,id_wishlist) values(10,1);

