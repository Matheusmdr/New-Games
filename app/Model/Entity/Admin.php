<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Admin{
    public $id_employee;
    public $employee_name;
    public $email;
    public $employee_password;


    public function cadastrar(){
        $this->id = (new Database('users'))->insert([
            'employee_name' => $this->employee_name,
            'email' => $this->email,
            'employee_password' => $this->employee_password
        ]);

        return true;
    }


    public static function getAdminByEmail($email){
        return (new Database('employee'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }
}