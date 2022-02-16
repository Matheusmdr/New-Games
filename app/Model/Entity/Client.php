<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Client
{
    public $id_client;
    public $client_name;
    public $email;
    public $client_password;
    public $id_lib;
    public $id_wishlist;

    public function setClient()
    {
        $query = "call add_client('$this->client_name', '$this->email', '$this->client_password');";
        $database = new Database();
        $database->execute($query);
        $this->id =  (new Database('clients'))->select('email = "' . $this->email . '"')->fetchObject(self::class)->id_client;
        return true;
    }


    public static function getClientByEmail($email)
    {
        return (new Database('clients'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
    public static function getClients($where = null, $order = null, $limit = null, $field = "*")
    {
        return (new Database('clients'))->select($where, $order, $limit, $field);
    }
}
