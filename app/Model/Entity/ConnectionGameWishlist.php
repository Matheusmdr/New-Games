<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class ConnectionGameWishlist{
    public $id_wishlist;
    public $id_game;

    public static function getIdWishlistProducts($id_game){
        $obCon = (new Database('connection_wishlist_and_game'))->select('id_wishlist = "'.$id_game.'"',null,null,"*");
       return $obCon;
    }
}
