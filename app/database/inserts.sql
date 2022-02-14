use newgamesdb;
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
insert into game(game_name, price, img, supplier) values("Persona 5 Strikers",59.99,"Persona5S.jpg",1,0);
insert into game(game_name, price, img, supplier) values("Resident Evil Village",79.99,"RESIDENT-EVIL-8-1.jpg",2,1);
insert into game(game_name, price, img, supplier) values("Cyberpunk 2077",47.99,"cyberpunk.jpg",3,1);
insert into game(game_name, price, img, supplier) values("Dark Souls 3",59.99,"darksouls3.jpg",4,0);
insert into game(game_name, price, img, supplier) values("The Witcher 3: Wild Hunt",7.99,"the-witcher-3-wild-hunt.jpg",3,0);
insert into game(game_name, price, img, supplier) values("Devil May Cry 5",24.99,"devil-may-cry-5.jpg",2,1);
insert into game(game_name, price, img, supplier) values("Nioh 2",39.99,"nioh2.jpg",5,0);
insert into game(game_name, price, img, supplier) values("Red Dead Redemption 2",14.99,"ReadDeadRedemption_2.jpg",6,0);
insert into game(game_name, price, img, supplier) values("Sekiro: Shadows Die Twice",59.99,"Sekiro-Shadows-Die-Twice.jpg",7,0);
insert into game(game_name, price, img, supplier) values("KINGDOM HEARTS III + Re Mind",59.99,"EGS_KINGDOMHEARTSIIIReMindDLC.jpg",8,0);
insert into game(game_name, price, img, supplier) values("Hollow Knight",14.99,"hollowknight.jpg",9,0);
insert into game(game_name, price, img, supplier) values("Sonic Mania",9.99,"SonicMania.jpg",1,0);
insert into game(game_name, price, img, supplier) values("Dead Cells",24.99,"DeadCells.jpg",10,0);
insert into game(game_name, price, img, supplier) values("Super Bomberman R Online",9.99,"Super-Bomberman-R.jpg",11,0);
insert into game(game_name, price, img, supplier) values("Rocket League",9.99,"rocketleague.jpg",12,0);

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

