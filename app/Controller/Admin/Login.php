<?php

namespace App\Controller\Admin;

use App\Utils\View;
use App\Model\Entity\Admin;
use App\Session\Admin\Login as SessionAdminLogin;
use App\controller\Admin\Alert;

class Login extends Page{


    public static function getLogin($request,$errorMessage = null){
        $status =  !is_null($errorMessage) ?  Alert::getError($errorMessage) : '';

        $content = View::render('admin/login',[
            'status' => $status
        ]);

        return parent::getPage('New Games - Admin Login', $content,'login');
    }  
    
    public static function setLogin($request){
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $password = $postVars['password'] ?? '';

        $obAdmin = Admin::getAdminByEmail($email);
        if(!$obAdmin instanceof Admin) return self::getLogin($request,'E-mail ou senha inválidos');

        if(!password_verify($password,$obAdmin->employee_password)) return self::getLogin($request,'E-mail ou senha inválidos');

        SessionAdminLogin::login($obAdmin);

        $request->getRouter()->redirect('/admin');
    }

    public static function setLogout($request){
        SessionAdminLogin::logout();
        $request->getRouter()->redirect('/admin/login');
    }
}