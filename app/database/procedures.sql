use newgamesdb;
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
