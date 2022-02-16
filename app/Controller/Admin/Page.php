<?php

namespace App\Controller\Admin;

use \App\Utils\View;

class Page{

    private static $modules = [
        'home' =>[
            'label' => 'Home',
            'link' => URL.'/admin'
        ],
        'add-game' =>[
            'label' => 'Add Game',
            'link' => URL.'/admin/games/add'
        ]
    ];

    public static function getPage($title, $content, $currentModule) {
         return View::render('admin/page',[
             'title' => $title,
             'content' => $content, 
             'menu' => self::getMenu($currentModule)
         ]);
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