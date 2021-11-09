<?php

require_once "connection.php";

if (isset($_POST['name'])) {
        $email = $_POST['email'];
        $query = "SELECT id FROM users WHERE email = '{$email}'";
        $result = $conn->query($query);
        $aux = 0;
        if($result)
            while($row = $result->fetch_assoc())
            $aux = $row['id'];
        if($aux){
            session_start();
            $_SESSION["error"] = true;
            header("Location: ../html/signup.php");
        }
        else{
            $row = $result->fetch_assoc();
            $password = md5($_POST['password']);
            $query = "INSERT INTO users (name,email,password,country, city,zip_code,neighborhood,street,number) 
                    VALUES ('{$_POST['name']}','{$_POST['email']}','{$password}','{$_POST['country']}','{$_POST['city']}','{$_POST['zipcode']}','{$_POST['neighborhood']}','{$_POST['street']}','{$_POST['house-number']}')";
            $conn->query($query);
            $query = "SELECT id from users WHERE email = '{$email}'";
            $result = $conn->query($query);
            $aux = 0;
            if($result){
                session_start();
                while($row = $result->fetch_assoc()){
                    $aux = $row['id'];
                    break;
                }
                $_SESSION["logged"] = $aux;
            }
            header("Location: ../html/signin.php");
        }
    }
