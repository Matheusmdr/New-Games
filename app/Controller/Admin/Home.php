<?php

namespace App\Controller\Admin;

use \App\Utils\View;


class Home extends Page{
    public static function getHome() {
        $content =  View::render('admin/home',[]);
        return parent::getPage('New Games',$content,'home');
    }
   
}