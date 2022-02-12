<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use App\Model\Entity\Client;
use App\Session\Client\Login as SessionClientLogin;
use App\controller\Pages\Alert;


class Signin extends Page{
    public static function getSignin($request,$errorMessage = null) {
        $status =  !is_null($errorMessage) ?  Alert::getError($errorMessage) : '';

        $content = View::render('pages/signin',[
            'status' => $status
        ]);

        return parent::getPage('Sign In | New Games',$content,'signin');
    }


     
    public static function setSignin($request){
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $password = $postVars['password'] ?? '';

        $obClient = Client::getClientByEmail($email);
    
        if(!$obClient instanceof Client) return self::getSignin($request,'E-mail ou senha inválidos');

        if(!password_verify($password,$obClient->client_password)) return self::getSignin($request,'E-mail ou senha inválidos');

        SessionClientLogin::login($obClient);

        $request->getRouter()->redirect('/');
    }

    public static function setLogout($request){
        SessionClientLogin::logout();
        $request->getRouter()->redirect('/signin');
    }
   
}