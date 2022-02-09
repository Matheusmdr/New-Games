<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Client{
    public $id;
    public $client_name;
    public $email;
    public $client_password;


    public function cadastrar(){
        $this->id = (new Database('users'))->insert([
            'users_name' => $this->client_name,
            'users_email' => $this->email,
            'users_password' => $this->client_password
        ]);

        return true;
    }


    public static function getClientByEmail($email){
        return (new Database('users'))->select('users_email = "'.$email.'"')->fetchObject(self::class);
    }
}