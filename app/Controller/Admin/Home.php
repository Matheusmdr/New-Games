<?php

namespace App\Controller\Admin;

use \App\Utils\View;


class Home extends Page{
    public static function getHome() {
        $content =  View::render('admin/modules/home',[]);
        return parent::getPanel('New Games',$content,'home');
    }
   
}