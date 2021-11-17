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
                        <span id="cart-total"></span>
                    </a>
                </div>
            </div>
        </nav>
    </header>