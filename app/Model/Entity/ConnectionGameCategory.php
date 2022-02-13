<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class ConnectionGameCategory{
    public $id_category;
    public $id_game;

    public static function getProductsByCategory($obCategory){
       $obCon = (new Database('connection_game_category'))->select('id_category = "'.$obCategory->id_category.'"',null,null,"*");
       return $obCon;
    }
}
