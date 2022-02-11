<?php

namespace App\Controller\Admin;

use \App\Utils\View;

class Alert{

    public static function getSuccess($message) {
         return View::render('admin/templates/alert',[
             'type' =>  'success',
             'message' => $message
         ]);
    }


    public static function getError($message) {
        return View::render('admin/templates/alert',[
            'type' =>  'error',
            'message' => $message
        ]);
   }
}