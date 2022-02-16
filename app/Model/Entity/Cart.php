<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Cart
{
    public $id_cart;
    public $game_name;
    public $game_price;
    public $game_image;
    public $id_game;



    public static function getCartItems($where = null, $order = null, $limit = null, $field = "*")
    {
        return (new Database('cart'))->select($where, $order, $limit, $field);
    }


    public static function addToCart($data)
    {

        $obCart = ((new Database('cart'))->select('id_game = "' . $data['id_game'] . '"'))->fetchObject(self::class);
        if (!$obCart) {
            return (new Database('cart'))->insert([
                'game_name' => $data['game_name'],
                'game_price' => $data['game_price'],
                'game_image' => $data['game_image'],
                'id_game' => $data['id_game'],
            ]);
        }
        return null;
    }


    public static function removeFromCart($id)
    {
        $id_game = $id['id_game'];
        return (new Database('cart'))->delete('id_game = "' . $id_game . '"');
    }

    public static function deleteCart()
    {
        $query = 'TRUNCATE TABLE cart;';
        $database = new Database();
        $database->execute($query);
        return true;
    }


    public static function totalCart()
    {
        $count = (new Database('cart'))->select()->rowCount();
        return $count;
    }

    public static function getTotalAmount(){
        $total = 0;
        $result = self::getCartItems();
        while ($obCart =  $result->fetchObject(self::class)) {
           $total += $obCart->game_price;
        }
        return $total;
    }

}
