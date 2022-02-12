<?php

namespace App\Http\Middleware;

use App\Session\Client\Login as SessionClientLogin;

class RequireClientLogin{
    public function handle($request,$next){
        if(!SessionClientLogin::isLogged()){
            $request->getRouter()->redirect('/signin');
        }
       return $next($request);
    }
}