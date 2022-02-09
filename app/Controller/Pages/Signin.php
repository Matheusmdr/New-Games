<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Signin extends Page{
    public static function getSignin() {
        $content =  View::render('pages/signin',['name' => 'Oi - oi', 'description' => 'teste']);
        return parent::getPage('New Games - Sign In',$content);
    }
   
}