<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Product;
use \WilliamCosta\DatabaseManager\Database;


class Home extends Page{
    public static function getHome($request) {
        $content =  View::render('pages/home',[
            'featured' => self::getFeaturedProducts($request)
        ]);
        return parent::getPage('New Games',$content, 'home');
    }

    public static function getFeaturedProducts() {
        $featured = '';
        $result = Product::getProducts("feature = '1'",'id_game ASC', '3');

        while($obProduct =  $result->fetchObject(Product::class)){
            $featured .=  View::render('pages/templates/featured',[
                'game_id' => $obProduct->id_game,
                'game_name' => $obProduct->game_name,
                'game_price' => $obProduct->price,
                'game_img' => $obProduct->img
            ]);
        }
        return $featured;
    }
   
}