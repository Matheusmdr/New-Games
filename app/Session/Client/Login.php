<?php

namespace App\Session\Client;

class Login{

    private static function init(){
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }
    public static function login($obUser){
        self::init();
        $_SESSION['client']['user'] = [
            'id' => $obUser->id_client,
            'name' => $obUser->client_name,
            'email' => $obUser->email
        ];
        return true;
    }

    public static function logout(){
        self::init();
        unset($_SESSION['client']['user']);
        return true;
    }

    public static function isLogged(){
        self::init();
        return (isset($_SESSION['client']['user']['id']));
    }

    public static function getLoginName() {
        self::init();
        $client_name = '';
        if (self::isLogged()){
            $client_name = $_SESSION['client']['user']['name'];
        }
        $xClientName = explode(' ', $client_name);
        return $xClientName[0];
    }

    public static function getLoginId() {
        self::init();
        $id_client = '';
        if (self::isLogged()){
            $id_client = $_SESSION['client']['user']['id'];
        }
        return $id_client;
    }
}