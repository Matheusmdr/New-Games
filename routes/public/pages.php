<?php

use \App\Http\Response;
use \App\Controller\Pages;


$obRouter->get('/',[
    function(){
        return new Response(200,Pages\Home::getHome());
    }
]);


$obRouter->get('/shopping-cart',[
    function(){
        return new Response(200,Pages\ShoppingCart::getShoppingCart());
    }
]);


$obRouter->get('/products',[
    function($request){
        return new Response(200,Pages\Products::getProducts($request));
    }
]);


$obRouter->get('/signin',[
    function(){
        return new Response(200,Pages\signin::getSignin());
    }
]);



$obRouter->get('/signup',[
    function(){
        return new Response(200,Pages\signup::getSignup());
    }
]);

$obRouter->post('/signup',[
    function($request){
        return new Response(200,Pages\signup::insertClient($request));
    }
]);


$obRouter->get('/order-confirmation',[
    function(){
        return new Response(200,Pages\orderConfirmation::getOrderConfirmation());
    }
]);



