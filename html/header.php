<?php
    session_start();
    
    if(isset($_SESSION['error'])){
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['logged'])){
        require_once "../php/connection.php";
        $user = $_SESSION['logged'];
        $query = "SELECT users_name FROM users WHERE id_users = '{$user}'";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) $name = $row['users_name'];
        $name = explode(' ',$name,15);
    }


    if (isset($_POST['add'])){
        if(isset($_SESSION['cart'])){
            $item_array_id = array_column($_SESSION['cart'], "id_game");
            if(in_array($_POST['id_game'], $item_array_id)){
                echo "<script>alert('Product is already added in the cart..!')</script>";
            }else{
    
                $count = count($_SESSION['cart']);
                $item_array = array(
                    'id_game' => $_POST['id_game'],
                    'item_quantity' =>1,
                );
                $_SESSION['cart'][$count] = $item_array;
            }
        }else{
            $item_array = array(
                    'id_game' => $_POST['id_game'],
                    'item_quantity' => 1,
            );
            $_SESSION['cart'][0] = $item_array;
        }
    }

    
    if (isset($_POST['quantity_cart'])){
        $quantity = (int)$_POST['quantity_cart'];
  
        if (isset($_SESSION['cart'])){    
            foreach ($_SESSION['cart'] as $key=>$value){
            if ($value['id_game'] === $_POST['id_game']){
                $_SESSION['cart'][$key]['item_quantity'] = $quantity;
            }
        }  
        }
    }

    if(isset($_POST['select_price'])){
        if(isset($_SESSION['price_selected'])){
            $price_select = $_POST['select_price'];
            $_SESSION['price_selected'] = $price_select;
        }
        else{
        
            $_SESSION['price_selected'] ='999';
            $price_select = '999';
        }
    }
    else{
        $_SESSION['price_selected'] = '999';
        $price_select = '999';
    }


    
    if(isset($_POST['select_category'])){
        if(isset($_SESSION['category_selected'])){
            $category_select = $_POST['select_category'];
            if( $category_select == '-1'){
                $produtos_ = "SELECT * FROM game
                WHERE (game_price Between 0 and '{$price_select}')
                ORDER By game_price Asc ";
            }
            else{
            $produtos_ = "SELECT * FROM game WHERE game_category = '{$category_select}' and (game_price Between 0 and '{$price_select}')
            ORDER By game_price Asc ";
            }

            $_SESSION['category_selected'] = $category_select;
        }
        else{
        
            $produtos_ = "SELECT * FROM game
            WHERE (game_price Between 0 And '{ $price_select}')
            ORDER By game_price Asc ";
            $_SESSION['category_selected'] ='-1';
        }
    }
    else{
        $_SESSION['category_selected'] = '-1';
    }

    
?>




<!-- Header -->
<header>
        <!-- Navigation -->
        <nav class="nav">
            <div class="nav-menu flex">
                <div class="nav-brand">
                    <img src="../images/game-controller.png" alt="joystick brand icon" id="joystick-brand-icon" />
                    <a href="../html/index.php">New Games</a>
                </div>
                <div class="toggle-collapse">
                    <div class="toggle-icons">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
                <div>
                    <ul class="nav-items">
                        <li class="nav-link">
                            <a href="../html/index.php">HOME</a>
                        </li>
                        <li class="nav-link">
                            <a href="../html/products.php">PRODUCTS</a>
                        </li>
                        <li class="nav-link">
                            <a href="#">HELP</a>
                        </li>
                        <li class="nav-link">
                            <a href="#">CONTACT</a>
                        </li>
                    </ul>
                </div>

                <div class="nav-icons">
                    <a href="#" class="icon-item">
                        <i class="fas fa-search"></i>
                    </a>
                    <?php if(!isset($_SESSION['logged'])): ?>
                    <a href="../html/signin.php" class="icon-item">
                        <i class="fas fa-user"></i>            
                    </a>
                    <?php 
                        else :
                            echo "<a class='icon-item' style='font-size:1.2rem; padding-bottom:1.2rem;' href='../php/logout.php?token=".md5(session_id())."' >
                                <i class='fas fa-sign-out-alt'></i>
                            </a> ";
                        endif;
                    ?>
                    <?php
                        if(isset($_SESSION['logged'])) 
                            echo "<p style='font-size:1.3rem; color:#FFF;'> Welcome {$name[0]} !</p>"; 
                    ?>
                    <a href="../html/shopping_cart.php" onclick="setCart()" class="icon-item">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cart-total">
                        <?php

                            if (isset($_SESSION['cart'])){
                                $count = count($_SESSION['cart']);
                                echo $count;
                            }else{
                                echo "0";
                            }

                         ?>
                        </span>
                    </a>
                </div>
            </div>
        </nav>
    </header>