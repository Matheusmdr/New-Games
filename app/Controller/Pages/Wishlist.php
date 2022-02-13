<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Product;
use App\Session\Client\Login as SessionClientLogin;
use App\controller\Pages\Alert;

class Wishlist extends Page
{
    public static function getWishlist($request)
    {
        $contentWishlist = self::getWishlistProducts($request);
        $empty_wishlist = '';
        if(is_null($contentWishlist)){
            $empty_wishlist = 'empty_wishlist';
            $contentWishlist =  Alert::getError('Your Wishlist is Empty');
        }
        $content =  View::render('pages/wishlist', [
            'products' => $contentWishlist,
            'empty_wishlist' => $empty_wishlist
        ]);
        return parent::getPage('Wishlist | New Games', $content, 'wishlist');
    }

    public static function getWishlistProducts($request)
    {
        $id_user = SessionClientLogin::getLoginId();
        $wishlist = '';
        $result = Product::getWishlistProducts($id_user);
        if (!is_null($result)) {
            while ($obProduct =  $result->fetchObject(Product::class)) {
                $wishlist .=  View::render('pages/templates/product', [
                    'game_id' => $obProduct->id_game,
                    'game_name' => $obProduct->game_name,
                    'game_price' => $obProduct->price,
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
