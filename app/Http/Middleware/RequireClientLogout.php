<?php

namespace App\Http\Middleware;

use App\Session\Client\Login as SessionClientLogin;

class RequireClientLogout{
    public function handle($request,$next){
        if(SessionClientLogin::isLogged()){
            $request->getRouter()->redirect('/');
        }
       return $next($request);
    }
}