<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use App\Session\Client\Login as SessionClientLogin;

class Page{
    private static $modules = [
        'home' =>[
            'label' => 'Home',
            'link' => URL
        ],
        'products' =>[
            'label' => 'Products',
            'link' => URL.'/products'
        ],
        'contact' =>[
            'label' => 'Contact',
            'link' => URL
        ],
        'help' =>[
            'label' => 'Help',
            'link' => URL
        ],
    ];

    private static function getFooter() {
        return View::render('pages/footer');
    }

    public static function getPagination($request,$obPagination){
        $pages = $obPagination->getPages();

        if(count($pages) <= 1) return '';
        $links = '';

        $url = $request->getRouter()->getCurrentUrl();

        $queryParams = $request->getQueryParams();

        foreach($pages as $page){
            $queryParams['page'] = $page['page'];
            $link = $url.'?'.http_build_query($queryParams);

            $links .=  View::render('pages/pagination/links',[
                'link' => $link,
                'page' => $page['page'],
                'active' => $page['current'] ? 'active' : ''
            ]);
        }

        $firstPage = reset($pages);
        $lastPage = end($pages);
        $queryParams['page'] = $firstPage['page'];
        $firstPageLink =  $url.'?'.http_build_query($queryParams);
        $queryParams['page'] = $lastPage['page'];
        $lastPageLink =  $url.'?'.http_build_query($queryParams);


        return View::render('pages/pagination/box',[
            'links' => $links,
            'first' => $firstPageLink,
            'last' => $lastPageLink
        ]);

    }

    public static function getPage($title, $content,$currentModule) {
         return View::render('pages/page',[
             'title' => $title,
             'header' => self::getMenu($currentModule),
             'content' => $content,
             'footer' => self::getFooter()
         ]);
    }

    public static function getErrorPage($title, $content){
        return View::render('pages/error',[
            'title' => $title,
            'content' => $content,
        ]);
    }

    private static function getMenu($currentModule){
        $links = '';
        $userName = SessionClientLogin::getLoginName();
        $account = "<a href='".URL."/signin' class='icon-item'>
        <i class='fas fa-user'></i></a>";

        if(SessionClientLogin::isLogged()){
            $account = "<a href='".URL."/signout' class='icon-item'>Olá ".$userName."
            <i class='fas fa-sign-out-alt'></i></a>";
        }

        foreach(self::$modules as $hash=>$module){
                $links .= View::render('pages/templates/links',[
                    'label' => $module['label'],
                    'link' => $module['link'],
                    'current' => $hash == $currentModule ? 'active' : ''
                ]);
        }
        return View::render('pages/header',[
            'links' => $links,
            'account' => $account
        ]);
    }
}