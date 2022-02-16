<?php

namespace App\Http\Middleware;

use \App\Model\Entity\Cart;

class RequireProductsInCart{
    public function handle($request,$next){
        if(Cart::totalCart() <= 0){
            $request->getRouter()->redirect('/');
        }
       return $next($request);
    }
}