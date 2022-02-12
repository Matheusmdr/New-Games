<?php

use \App\Http\Response;
use \App\Controller\Pages;


$obRouter->get('/',[
    function($request){
        return new Response(200,Pages\Home::getHome($request));
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
    'middlewares' => [
        'required-client-logout'
    ],
    function($request){
        return new Response(200,Pages\signin::getSignin($request));
    }
]);

$obRouter->post('/signin',[
    function($request){
        return new Response(200,Pages\signin::setSignin($request));
    }
]);


$obRouter->get('/signup',[
    'middlewares' => [
        'required-client-logout'
    ],
    function($request){
        return new Response(200,Pages\signup::getSignup($request));
    }
]);

$obRouter->post('/signup',[
    function($request){
        return new Response(200,Pages\signup::insertClient($request));
    }
]);


$obRouter->get('/signout',[
    'middlewares' => [
        'required-client-login'
    ],
    function($request){
        return new Response(200,Pages\Signin::setLogout($request));
    }
]);


$obRouter->get('/order-confirmation',[
    function(){
        return new Response(200,Pages\orderConfirmation::getOrderConfirmation());
    }
]);



