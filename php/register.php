<?php

require_once "connection.php";

if (isset($_POST['name'])) {
        $email = $_POST['email'];
        $query = "SELECT id_users FROM users WHERE users_email = '{$email}'";
        $result = $conn->query($query);
        $aux = 0;
        if($result)
            while($row = $result->fetch_assoc())
            $aux = $row['id_users'];
        if($aux){
            session_start();
            $_SESSION["error"] = true;
            header("Location: ../html/signup.php");
        }
        else{
            $row = $result->fetch_assoc();
            $password = md5($_POST['password']);
            $query = "INSERT INTO users (users_name,users_email,users_password,users_country, users_city,users_zip_code,users_neighborhood,users_street,users_number) 
                    VALUES ('{$_POST['name']}','{$_POST['email']}','{$password}','{$_POST['country']}','{$_POST['city']}','{$_POST['zipcode']}','{$_POST['neighborhood']}','{$_POST['street']}','{$_POST['house-number']}')";
            $conn->query($query);
            $query = "SELECT id_users from users WHERE users_email = '{$email}'";
            $result = $conn->query($query);
            $aux = 0;
            if($result){
                session_start();
                while($row = $result->fetch_assoc()){
                    $aux = $row['id_users'];
                    break;
                }
                $_SESSION["logged"] = $aux;
            }
            header("Location: ../html/signin.php");
        }
    }
