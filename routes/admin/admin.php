<?php

use \App\Http\Response;
use \App\Controller\Admin;


$obRouter->get('/admin/home',[
    'middlewares' => [
        'required-admin-login'
    ],
    function($request){
        return new Response(200,Admin\Home::getHome($request));
    }
]);
