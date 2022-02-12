<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Client;
use \App\Controller\Pages\Alert;


class Signup extends Page
{
    public static function getSignup($request,$message = null)
    {
        $status = '';
        if($message == 'error'){
            $status =   Alert::getError('Usuário já está cadastrado');
        }
        if($message == 'success'){
            $status =   Alert::getSuccess('Usuário cadastrado com sucesso');
        }

        $content = View::render('pages/signup',[
            'status' => $status
        ]);

        return parent::getPage('Sign Up | New Games', $content,'signup');
    }

    public static function insertClient($request)
    {
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $password = $postVars['password'] ?? '';
        $name = $postVars['name'] ?? '';
        $obClient = new Client();

        $obClient = Client::getClientByEmail($email);
        if($obClient instanceof Client) return self::getSignup($request, 'error');

        $obClient = new Client();
        $obClient->client_name = $name;
        $obClient->email= $email;
        $obClient->client_password= password_hash($password,PASSWORD_DEFAULT);

        $obClient->setClient();
        $request->getRouter()->redirect('/signin');
    }
}
