<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Product;
use App\Session\Client\Login as SessionClientLogin;
use App\controller\Pages\Alert;

class Library extends Page{
    public static function getLibrary($request)
    {
        $contentWishlist = self::getLibraryProducts($request);
        $empty_library= '';
        if(is_null($contentWishlist)){
            $empty_library = 'empty_wishlist';
            $contentWishlist =  Alert::getError('Your Library is Empty');
        }
        $content =  View::render('pages/library', [
            'products' => $contentWishlist,
            'empty_library' => $empty_library
        ]);
        return parent::getPage('Library | New Games', $content, 'wishlist');
    }

    public static function getLibraryProducts($request)
    {
        $id_user = SessionClientLogin::getLoginId();
        $wishlist = '';
        $result = Product::getLibraryProducts($id_user);
        if (!is_null($result)) {
            while ($obProduct =  $result->fetchObject(Product::class)) {
                $wishlist .=  View::render('pages/templates/libraryProducts', [
                    'game_id' => $obProduct->id_game,
                    'game_name' => $obProduct->game_name,
                    'game_img' => $obProduct->img
                ]);
            }
        }
        else{
            $wishlist = null;
        }
        return  $wishlist;
    }
}