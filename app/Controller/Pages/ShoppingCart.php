<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Session\Client\Login as SessionClientLogin;
use \App\Model\Entity\Cart;

class ShoppingCart extends Page
{


    public static function getShoppingCart()
    {
        $message = SessionClientLogin::isLogged() ? "<a href='../html/order_confirmation.php'><button id='confirm-button' type='submit' value='Buy now!'
        class='btn' style='width:50%; margin-left:25%;'>Buy now!</button></a>" : "<h2>you are not logged in</h2><a href=" . URL . "/signin'><button id='confirm-button' type='submit'
        value='Buy now!' class='btn' style='width:50%; margin-left:25%;'>Login</button></a>";
        $content =  View::render('pages/shoppingCart', [
            'content' => self::getCartItems(),
            'message' => $message
        ]);
        return parent::getPage('Cart | New Games', $content, 'cart');
    }

    public static function getCartItems()
    {
        $cart = Cart::getCartItems();
        $content = '';
        while ($product =  $cart->fetchObject(Cart::class)) {
            $content .=  View::render('pages/templates/cartTable', [
                'game_name' => $product->game_name,
                'game_price' => $product->game_price,
                'game_img' => $product->game_image,
                'game_id' => $product->id_game
            ]);
        }

        if ($content == '') {
            $content = "<tr>
            <th colspan='4'>Cart is Empty</th>
        </tr>";
        }

        return $content;
    }
}
