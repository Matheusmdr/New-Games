<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Category{
    public $id_category;
    public $category_name;
    public $category_description;
    
    public static function getCategory($where = null, $order = null, $limit = null,$field = "*"){
        return (new Database('category'))->select($where,$order,$limit,$field);
    }
}