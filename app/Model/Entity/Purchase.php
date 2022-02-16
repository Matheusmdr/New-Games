<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Purchase
{
    public $date_time;
    public $cost;
    public $discount;
    public $payment_method;
    public $payment_installments;
    public $id_client;



    public static function setOrder($date_time, $cost, $discount,$payment_method,$payment_installments,$idClient,$idGame,$idLib){
        $query = "call buy_game('$date_time', '$cost', '$discount','$payment_method','$payment_installments','$idClient','$idGame','$idLib');";
        $database = new Database();
        $database->execute($query);
    }


}
