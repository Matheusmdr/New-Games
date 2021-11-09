<?php

require_once "connection.php";

if (isset($_POST['email']) && isset($_POST['password'])){
    session_start();

    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $query = "SELECT id FROM users WHERE email = '{$email}' and password = '{$password}'";
    $result = $conn->query($query);
    $aux = 0;
    if($result)
            while($row = $result->fetch_assoc())
                $aux = $row['id'];

    if($aux){
        $row = $result->fetch_assoc();
        $_SESSION["logged"] = $aux;
		header("Location: ../html/index.php");

    }
    else{
        $_SESSION["error"] = true;
        header("Location: ../html/signin.php");
    }
    
}
