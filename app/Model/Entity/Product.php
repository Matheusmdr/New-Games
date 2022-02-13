<?php

namespace App\Model\Entity;

use \App\Model\Entity\ConnectionGameCategory;
use \WilliamCosta\DatabaseManager\Database;

class Product{
    public $game_name;
    public $price;
    public $img;
    public $supplier;
    public $game_category;
    public $id_game;

    public static function getProducts($where = null, $order = null, $limit = null,$field = "*"){
        return (new Database('game'))->select($where,$order,$limit,$field);
    }

    public static function getProductsByCategory($obCategory){
        $id = '';
        $ob =  new ConnectionGameCategory();
        $ob = $ob->getProductsByCategory($obCategory);
        while($id_game = $ob->fetchObject(ConnectionGameCategory::class)){
            $id .= ",$id_game->id_game";
        }
        $id = substr($id, 1);
        return self::getProducts("id_game in ($id)",null,3);
    }

}