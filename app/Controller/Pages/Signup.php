<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Client;


class Signup extends Page
{
    public static function getSignup()
    {
        $content =  View::render('pages/signup', []);
        return parent::getPage('New Games - Sign Up', $content,'signup');
    }

    public static function insertClient($request)
    {
        $postVars = $request->getPostVars();
        $obClient = new Client();

        $obClient->client_name = $postVars['name'];
        $obClient->email= $postVars['email'];
        $obClient->client_password=$postVars['password'];

        $obClient->cadastrar();
        return self::getSignup();
    }
}
