<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Product;
use \App\Model\Entity\Category;
use \App\Model\Entity\ConnectionGameCategory;
use \WilliamCosta\DatabaseManager\Pagination;


class Products extends Page
{

    public static function getProductsItens($request, &$obPagination, $categoryFilter, $priceFilter,&$count)
    {
        $products = "";

        $quantTotal = Product::getProducts(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
        $queryParams = $request->getQueryParams();

        $currPage = $queryParams['page'] ?? 1;

        $obPagination = new Pagination($quantTotal, $currPage, 12);
        $result = '';

        if ($categoryFilter != '') {
            $obCategory = Category::getCategory('category_name = "' . $categoryFilter . '"')->fetchObject(Category::class);
            $ob =  ConnectionGameCategory::getProductsByCategory($obCategory);
            $id = '';
            while ($id_game = $ob->fetchObject(ConnectionGameCategory::class)) {
                $id .= ",$id_game->id_game";
            }
            $id = substr($id, 1);
            if($id == '') return Alert::getError('Empty');
            $quantTotal = Product::getProducts("id_game in ($id)", null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
            $obPagination = new Pagination($quantTotal, $currPage, 12);
            $result = Product::getProducts("id_game in ($id)", 'id_game DESC', $obPagination->getLimit());
        } else {
            $result = Product::getProducts(null, 'id_game DESC', $obPagination->getLimit());
        }


        while ($obProduct =  $result->fetchObject(Product::class)) {
            if ($obProduct->price <= $priceFilter) {
                $count++;
                $products .=  View::render('pages/templates/product', [
                    'game_name' => $obProduct->game_name,
                    'game_price' => $obProduct->price,
                    'game_img' => $obProduct->img,
                    'game_id' => $obProduct->id_game
                ]);
            }
        }
        if($count <= 0 ){
            return Alert::getError('Empty');
        }
        return $products;
    }

    public static function getCategoryItens($request)
    {
        $selected = $request->getPostVars()['select_category'] ?? 'Select Filter';

        $categorys = View::render('pages/templates/select', [
            'name' => 'Select Filter',
            'value' => '',
            'selected' => 'Select Filter' == $selected ? 'selected' : ''
        ]);

        $result = Category::getCategory(null, 'category_name ASC');

        while ($obProduct =  $result->fetchObject(Product::class)) {
            $categorys .=  View::render('pages/templates/select', [
                'name' => $obProduct->category_name,
                'value' =>  $obProduct->category_name,
                'selected' =>  $obProduct->category_name == $selected ? 'selected' : ''
            ]);
        }
        return $categorys;
    }

    public static function getPriceItens($request)
    {
        $selected = $request->getPostVars()['select_price'] ?? '999';

        $prices = View::render('pages/templates/select', [
            'name' => 'Select Filter',
            'value' => '999',
            'selected' => 'Select Filter' == $selected ? 'selected' : ''
        ]);
        $priceArray = array(10, 20, 40, 80);

        foreach ($priceArray as $valor) {
            $prices .=  View::render('pages/templates/select', [
                'name' => "Under R$$valor",
                'value' =>  $valor,
                'selected' =>  $valor == $selected ? 'selected' : ''
            ]);
        }

        return $prices;
    }

    public static function getProducts($request)
    {
        $count = 0;
        $postVars = $request->getPostVars();

        $categoryFilter = $postVars['select_category'] ?? '';
        $priceFilter = $postVars['select_price'] ?? '';

        $content =  View::render('pages/products', [
            'products' => self::getProductsItens($request, $obPagination, $categoryFilter, $priceFilter,$count),
            'pagination' => parent::getPagination($request, $obPagination),
            'categorys' => self::getCategoryItens($request),
            'prices' => self::getPriceItens($request),
            'display' => $count < 12 ? 'none' : ''
        ]);
        return parent::getPage('Products | New Games', $content, 'products');
    }
}
