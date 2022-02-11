use newgamesdb;
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