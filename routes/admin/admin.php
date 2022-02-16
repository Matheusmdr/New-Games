<?php

use \App\Http\Response;
use \App\Controller\Admin;


$obRouter->get('/admin',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request){
        return new Response(200,Admin\Home::getHome($request));
    }
]);


$obRouter->get('/admin/games/add',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request){
        return new Response(200,Admin\AddGame::getAddGamePage($request));
    }
]);


$obRouter->post('/admin/games/add',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request){
        return new Response(200,Admin\AddGame::setGame($request));
    }
]);
