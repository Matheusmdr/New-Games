<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class OrderConfirmation extends Page{
    public static function getOrderConfirmation() {
        $content =  View::render('pages/orderConfirmation',['name' => 'Oi - oi', 'description' => 'teste']);
        return parent::getPage('Order Confirmation | New Games',$content,'orderConfirmation');
    }
   
}