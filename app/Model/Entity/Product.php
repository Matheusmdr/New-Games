<?php

namespace App\Model\Entity;

use \App\Model\Entity\ConnectionGameCategory;
use \App\Model\Entity\ConnectionGameWishlist;
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
        if($id == ''){
            return null;
        }
        $id = substr($id, 1);
        return self::getProducts("id_game in ($id)",null,3);
    }

    public static function getWishlistProducts($id_user){
        $id = '';
        $ob =  new ConnectionGameWishlist();
        $ob = $ob->getIdWishlistProducts($id_user);
        while($id_game = $ob->fetchObject(ConnectionGameWishlist::class)){
            $id .= ",$id_game->id_game";
        }
        if($id == ''){
            return null;
        }
        $id = substr($id, 1);
        return self::getProducts("id_game in ($id)",null);
    }


    public static function getLibraryProducts($id_user){
        $id = '';
        $ob =  new ConnectionGameLibrary();
        $ob = $ob->getIdLibraryProducts($id_user);
        while($id_game = $ob->fetchObject(ConnectionGameLibrary::class)){
            $id .= ",$id_game->id_game";
        }
        if($id == ''){
            return null;
        }
        $id = substr($id, 1);
        return self::getProducts("id_game in ($id)",null);
    }

}