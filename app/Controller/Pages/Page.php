<?php

namespace App\Controller\Pages;

use \App\Utils\View;


class Page{
    private static function getHeader() {
        return View::render('pages/header');
    }

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

    public static function getPage($title, $content) {
         return View::render('pages/page',[
             'title' => $title,
             'header' => self::getHeader(),
             'content' => $content,
             'footer' => self::getFooter()
         ]);
    }
}