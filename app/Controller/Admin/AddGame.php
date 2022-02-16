<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Model\Entity\Product;


class AddGame extends Page
{
    public static function getAddGamePage()
    {
        $content =  View::render('admin/addGame', []);
        return parent::getPage('New Games', $content, 'add-game');
    }

    public static function setGame($request)
    {
        $postVars = $request->getPostVars();
        $name = $postVars['name'] ?? '';
        $email = $postVars['email'] ?? '';
        $sec_email = $postVars['sec-email'] ?? '';
        $phone = $postVars['phone'] ?? '';
        $sec_phone = $postVars['sec-phone'] ?? '';
        $website = $postVars['website'] ?? '';
        $fee = $postVars['fee'] ?? '';
        $cat_name = $postVars['category'] ?? '';
        $cat_desc = $postVars['category-desc'] ?? '';
        $obGame = new Product();
        $obGame->game_name = $postVars['game_name'] ?? '';
        $obGame->price = $postVars['price'] ?? '';
        if (!isset($postVars['feature'])) {
            $obGame->feature = '0';
        } else {
            $obGame->feature = '1';
        }
        $obGame->img = $postVars['image'] ?? '';


        //$obGame->setProduct($name, $phone, $sec_phone, $email, $sec_email, $website, $fee, $cat_name, $cat_desc);
    
        $uploaddir = '/../../app/Resources/images';
        $uploadfile = $uploaddir . basename($_FILES['image']);
        echo '<pre>';print_r( $uploadfile);echo '</pre>';exit;
        if (move_uploaded_file($_POST['image']['tmp_name'], $uploadfile)) {
            echo "Arquivo válido e enviado com sucesso.\n";
        } else {
            echo "Possível ataque de upload de arquivo!\n";
        }
    }
}
