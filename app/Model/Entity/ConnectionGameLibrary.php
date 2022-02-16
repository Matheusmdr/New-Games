<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class ConnectionGameLibrary{
    public $id_lib;
    public $id_game;

    public static function getIdLibraryProducts($id_game){
        $obCon = (new Database('connection_lib_and_game'))->select('id_lib = "'.$id_game.'"',null,null,"*");
       return $obCon;
    }
}
