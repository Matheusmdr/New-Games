<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Cart;
use \App\Model\Entity\Client;
use \App\Model\Entity\Purchase;
use \App\Session\Client\Login as SessionClientLogin;

class OrderConfirmation extends Page{
    public static function getOrderConfirmation() {
        $content =  View::render('pages/checkout',[
            'content' => self::getCartItems()
        ]);
        return parent::getPage('Order Confirmation | New Games',$content,'orderConfirmation');
    }


    public static function getCartItems()
    {
        $total = 0;
        $cart = Cart::getCartItems();
        $content = '';
        while ($product =  $cart->fetchObject(Cart::class)) {
            $total+=$product->game_price;
            $content .=  View::render('pages/templates/checkoutTable', [
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

    public static function setOrder($request){
        $postVars = $request->getPostVars();
        $date = date('Y/m/d H:i:s');
        $date_time = $date;
        $cost = Cart::getTotalAmount();
        $discount = 0;
        $payment_method = $postVars['payment-method'];
        $payment_installments = 0;
        $id_client = SessionClientLogin::getLoginId();

        $obClient = Client::getClients('id_client = "' .  SessionClientLogin::getLoginId() . '"',null)->fetchObject(Client::class);
        $obCart = Cart::getCartItems();
        $idLib = $obClient->id_lib;
  
        while ($product =  $obCart->fetchObject(Cart::class)) {
            Purchase::setOrder($date_time,$cost,$discount,$payment_method,$payment_installments,$id_client,$product->id_game,$idLib);
        }
        Cart::deleteCart();
        $request->getRouter()->redirect('/');
    }
   
}