<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Alert{

    public static function getSuccess($message) {
         return View::render('pages/templates/alert',[
             'type' =>  'success',
             'message' => $message
         ]);
    }


    public static function getError($message) {
        return View::render('pages/templates/alert',[
            'type' =>  'error',
            'message' => $message
        ]);
   }
}