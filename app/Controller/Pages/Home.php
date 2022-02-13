<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Product;
use \App\Model\Entity\Category;


class Home extends Page
{
    public static function getHome($request)
    {
        $content =  View::render('pages/home', [
            'featured' => self::getFeaturedProducts($request),
            'newProducts' => self::getNewProducts($request),
            'categoryList' => self::getProductsbyCategory($request)
        ]);
        return parent::getPage('New Games', $content, 'home');
    }

    public static function getFeaturedProducts($request)
    {
        $featured = '';
        $result = Product::getProducts("feature = '1'", 'id_game ASC', '3');

        while ($obProduct =  $result->fetchObject(Product::class)) {
            $featured .=  View::render('pages/templates/featured', [
                'game_id' => $obProduct->id_game,
                'game_name' => $obProduct->game_name,
                'game_price' => $obProduct->price,
                'game_img' => $obProduct->img
            ]);
        }
        return $featured;
    }

    public static function getNewProducts($request)
    {
        $newGames = '';
        $result = Product::getProducts(null, 'id_game DESC', '3');

        while ($obProduct =  $result->fetchObject(Product::class)) {
            $newGames .=  View::render('pages/templates/productsList', [
                'game_id' => $obProduct->id_game,
                'game_name' => $obProduct->game_name,
                'game_price' => $obProduct->price,
                'game_img' => $obProduct->img
            ]);
        }
        return $newGames;
    }

    public static function getProductsByCategory($request){
        $result = Category::getCategory(null,'id_category ASC');
        $contentPage = '';
        
        while ($obCategory = $result->fetchObject(Category::class)){
            $resultProduct = Product::getProductsByCategory($obCategory);
            $content = '';
            while ($obProduct =  $resultProduct->fetchObject(Product::class)) {
                $content .=  View::render('pages/templates/productsList', [
                    'game_id' => $obProduct->id_game,
                    'game_name' => $obProduct->game_name,
                    'game_price' => $obProduct->price,
                    'game_img' => $obProduct->img
                ]);
            }
            $contentPage .=  View::render('pages/templates/gameByCategory',[
                'category_name' => $obCategory->category_name,
                'products' => $content
            ]);
        }
        return $contentPage;
    }
}
