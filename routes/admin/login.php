<?php

use \App\Http\Response;
use \App\Controller\Admin;

$obRouter->get('/admin/login',[
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request){
        return new Response(200,Admin\Login::getLogin($request));
    }
]);


$obRouter->post('/admin/login',[
    
    function($request){
        return new Response(200,Admin\Login::setLogin($request));
    }
]);


$obRouter->get('/admin/logout',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request){
        return new Response(200,Admin\Login::setLogout($request));
    }
]);