<?php

namespace App\Controller\Admin;

use \App\Utils\View;

class Page{

    private static $modules = [
        'home' =>[
            'label' => 'Home',
            'link' => URL.'/admin/home'
        ],
    ];

    public static function getPage($title, $content) {
         return View::render('admin/page',[
             'title' => $title,
             'content' => $content
         ]);
    }

    public static function getPanel($title, $content, $currentModule){
        $contentPanel = View::render('admin/panel',[
            'menu' => self::getMenu($currentModule),
            'content' => $content
        ]);
        return self::getPage($title,$contentPanel);   
    }


    private static function getMenu($currentModule){
        $links = '';

        foreach(self::$modules as $hash=>$module){
                $links .= View::render('admin/templates/links',[
                    'label' => $module['label'],
                    'link' => $module['link'],
                    'current' => $hash == $currentModule ? 'active' : ''
                ]);
        }
        return View::render('admin/templates/box',[
            'links' => $links
        ]);
    }
}