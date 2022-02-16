<?php

require __DIR__ . '/../../includes/app.php';

function ajaxData($class, $method, $params){
    return call_user_func_array(array($class, $method), $params);
}

$row  = ajaxData("App\Model\Entity\\".$_POST['class'], $_POST['method'], $_POST['params']);

echo json_encode($row);


exit;

