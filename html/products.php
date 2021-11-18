<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
   if(isset($_POST['select_price'])){
    if(isset($_SESSION['price_selected'])){
        $price_select = $_POST['select_price'];
        $_SESSION['price_selected'] = $price_select;
    }
    else{
    
        $_SESSION['price_selected'] ='999';
    }
}
else{
    $_SESSION['price_selected'] = '999';
}



if(isset($_POST['select_category'])){
    if(isset($_SESSION['category_selected'])){
        $category_select = $_POST['select_category'];
        $_SESSION['category_selected'] = $category_select;
    }
    else{
        $_SESSION['category_selected'] ='-1';
    }
}
else{
    $_SESSION['category_selected'] = '-1';
}


?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Main Style -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="icon" href="../images/game-controller.ico" />
    <title>New Games</title>
</head>

<body>
    <?php include "../html/header.php"?>
    <?php include_once "../php/connection.php"?>
    <!-- Main -->
    <main>
        <section>
            <div class="products-list container">
                <div class="col-1">
                    <div>
                        <div>
                            <h3>Category</h3>
                        </div>
                        <form method="post" action=''>
                            <select id="Category" name="select_category" onchange="this.form.submit()">
                                <option <?php if( $_SESSION['category_selected'] == '-1') echo "selected";?> value="-1">All</option>
                                <option <?php if( $_SESSION['category_selected'] == '0') echo "selected";?> value="0">RPG</option>
                                <option <?php if( $_SESSION['category_selected'] == '1') echo "selected";?> value="1">Survival horror</option>
                                <option <?php if( $_SESSION['category_selected'] == '2') echo "selected";?> value="2">Action</option>
                                <option <?php if( $_SESSION['category_selected'] == '3') echo "selected";?> value="3">Platform</option>
                                <option <?php if( $_SESSION['category_selected'] == '4') echo "selected";?> value="4">Multiplayer</option>
                            </select>
                        
                        <h3>Price</h3>

                        <select id="Price" name="select_price"onchange="this.form.submit()">
                            <option <?php if( $_SESSION['price_selected'] == '999') echo "selected";?> value="999">Select Filter</option>
                            <option <?php if( $_SESSION['price_selected'] == '10') echo "selected";?> value="10">Under $10.00</option>
                            <option <?php if( $_SESSION['price_selected'] == '20') echo "selected";?> value="20">Under $20.00</option>
                            <option <?php if( $_SESSION['price_selected'] == '40') echo "selected";?> value="40">Under $40.00</option>
                            <option <?php if( $_SESSION['price_selected'] == '80') echo "selected";?> value="80">Under $80.00</option>
                        </select>
                        </form>
                    </div>
                </div>
                <div class="col-2">
                    <h3>Products</h3>
                    <div class="list"  data-aos="fade-in" data-aos-delay="200">
                        <div>
                            <div id="productsListDiv" class="game-list">
                            <?php
                            if( $_SESSION['category_selected']== '-1'){
                                $produtos_ = "SELECT * FROM game
                                WHERE (game_price Between 0 and '{$_SESSION['price_selected']}')
                                ORDER By game_price Asc ";
                            }
                            else{
                            $produtos_ = "SELECT * FROM game WHERE game_category = '{$_SESSION['category_selected']}' and (game_price Between 0 and '{$_SESSION['price_selected']}')
                            ORDER By game_price Asc ";
                            }
                            $produtos = mysqli_query($conn,$produtos_);
                            while($row_game = mysqli_fetch_assoc($produtos)){
                                echo "<div class='game-content' id=".$row_game['id_game'].">
                                <div>
                                <img src=".$row_game['game_img']."></img>
                                </div>
                                <a>".$row_game['game_name']."</a>
                                <span>$".$row_game['game_price']."</span>
                                <form action='../html/products.php' method='post'>
                                <button class='btn' type='submit' name='add'>Add to Cart</button>
                                <input type='hidden' name='id_game' value=".$row_game['id_game'].">
                                <input type='hidden' name='quantity' value='1'>
                                </form>
                                </div>";
                            }
                            
                            ?>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <?php include "../html/footer.php" ?>


    <a href="#" class="goto-top scroll-link">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!--JQuery Library -->
    <script src="../js/Jquery3.4.1.min.js"></script>
    
    <!--Products Data-->
    <script src="../data/products.js"></script>

    <!--Script Cart Total-->
    <script src="../js/cartNum.js"></script>

    <!--Some important functions-->
    <script src="../js/util.js"></script>

    <!--Main Script-->
    <script src="../js/script.js"></script>
</body>

</html>
