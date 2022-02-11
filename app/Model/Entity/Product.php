<?php

namespace App\Model\Entity;

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
}