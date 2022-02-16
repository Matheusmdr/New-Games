<?php

namespace App\Session\Client;

class Cart
{

    private static function init()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
    public static function returnCart()
    {
        self::init();
        $CartItems = null;
        if(isset($_SESSION['cart'])){
            $CartItems = $_SESSION['cart'];
        }
        return $CartItems;
    }   
}
