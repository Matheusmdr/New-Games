use newgamesdb;
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
