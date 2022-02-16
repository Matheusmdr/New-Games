<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Session\Client\Login as SessionClientLogin;
use \App\Model\Entity\Cart;

class ShoppingCart extends Page
{


    public static function getShoppingCart()
    {
        $message = SessionClientLogin::isLogged() ? "<a href='" . URL . "/checkout'><button id='confirm-button' type='submit' value='Buy now!'
        class='btn' style='width:50%; margin-left:25%;'>Buy now!</button></a>" : "<h2>you are not logged in</h2><a href=" . URL . "/signin><button id='confirm-button' type='submit'
        value='Buy now!' class='btn' style='width:50%; margin-left:25%;'>Login</button></a>";
        if(SessionClientLogin::isLogged() &&  Cart::totalCart() == 0){
            $message = "<h2>your cart is empty</h2><a href=" . URL . "><button id='confirm-button' type='submit'
        value='Buy now!' class='btn' style='width:50%; margin-left:25%;'>Buy Now</button></a>";
        }
        $content =  View::render('pages/shoppingCart', [
            'content' => self::getCartItems(),
            'message' => $message
        ]);
        return parent::getPage('Cart | New Games', $content, 'cart');
    }

    public static function getCartItems()
    {
        $total = 0;
        $cart = Cart::getCartItems();
        $content = '';
        while ($product =  $cart->fetchObject(Cart::class)) {
            $total+=$product->game_price;
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
        else{
            $content .= "<tr>
            <th colspan='2'>Total:</th>
            <th  colspan='2'>R$:$total</th>
        </tr>";
        }

        return $content;
    }
}
