<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Product;
use \WilliamCosta\DatabaseManager\Pagination;


class Products extends Page{

    public static function getProductsItens($request,&$obPagination){
        $products = ""; 

        $quantTotal = Product::getProducts(null,null,null,'COUNT(*) as qtd')->fetchObject()->qtd;
        $queryParams = $request->getQueryParams();

        $currPage = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantTotal,$currPage,12);
        $result = Product::getProducts(null,'id_game DESC',$obPagination->getLimit());

        while($obProduct =  $result->fetchObject(Product::class)){
            $products .=  View::render('pages/templates/product',[
                'game_name' => $obProduct->game_name,
                'game_price' =>$obProduct->price,
                'game_img' =>$obProduct->img,
                'game_id' => $obProduct->id_game
            ]);
        }
        return $products;
    } 
    public static function getProducts($request) {
        $content =  View::render('pages/products',[
            'products' => self::getProductsItens($request,$obPagination),
            'pagination' => parent::getPagination($request,$obPagination)
        ]);
        return parent::getPage('New Games - Products',$content);
    }
   
}