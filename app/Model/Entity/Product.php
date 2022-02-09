<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Product{
    public $game_name;
    public $game_price;
    public $game_img;
    public $game_supplier;
    public $game_situation;
    public $game_category;
    public $game_id;

    public static function getProducts($where = null, $order = null, $limit = null,$field = "*"){
        return (new Database('game'))->select($where,$order,$limit,$field);
    }
}