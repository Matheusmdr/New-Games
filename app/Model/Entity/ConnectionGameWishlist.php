<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class ConnectionGameWishlist{
    public $id_wishlist;
    public $id_game;

    public static function getIdWishlistProducts($id_user){
        $obCon = (new Database('connection_wishlist_and_game'))->select('id_wishlist = "'.$id_user.'"',null,null,"*");
       return $obCon;
    }
}
