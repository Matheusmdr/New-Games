
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Main Style -->
    <link rel="stylesheet" href="../css/shopping_cart.css">

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
            <div>
                <div>
                    <div class="container-table text_style">
                        <table id="orders" class="table-orders">
                            <thead>
                                <tr class="table-title">
                                    <th colspan="4">Orders</th>
                                </tr>
                                <tr class="table-subtitle">
                                    <th>Game</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="orders" class="table-rows">
                                <?php
                                $total = 0;
                                    if (isset($_SESSION['cart'])){
                                        $produtos_ = "SELECT * FROM game";
                                        $produtos = mysqli_query($conn,$produtos_);

                                        while ($row = mysqli_fetch_assoc($produtos)){
                                            foreach ($_SESSION['cart'] as $key=>$value){
                                                if ($row['id_game'] == $value['id_game']){
                                                    $total = $total + (float)$row['game_price'] * (int)$value['item_quantity'];
                                                    echo "
                                                    <tr>
                                                    <th><img src=".$row['game_img']." /></th>
                                                    <th>".$row['game_name']."</th>
                                                    <th>".$row['game_price'] * $value['item_quantity']."</th>
                                                    <th>
                                                    <div class='counter'>
                                                    <form method='post' action=''>
                                                    <input type='number' name='quantity_cart' value=". $value['item_quantity']." min='0' max='99' onchange='this.form.submit()'/>
                                                    <input type='hidden' name='id_game' value=".$row['id_game'].">
                                                    </form>
                                                    </div>
                                                    </th>
                                                    </tr>
                                                    
                                                    
                                                    ";
                                                }
                                            }
                                        }
                                        echo "<tfoot>
                                        <tr>
                                        <th colspan='3'>
                                        TOTAL
                                        </th>
                                        <th colspan='1'>
                                        ".$total."
                                        </th>
                                        <tr>
                                        </tfoot>";
                                    }else{
                                        echo "<tr><th span='4'>Cart is Empty</th></tr>";
                                    }
                                ?>

                            </tbody>
                        </table>
                        <?php if(isset($_SESSION['logged'])): ?>
                            <a href="../html/order_confirmation.php" ><button id="confirm-button" type="submit" value="Buy now!" class="btn" style="width:50%; margin-left:25%;" onclick="getForm()">Buy now!</button></a>
                         <?php 
                            else :
                                echo "<h2>you are not logged in</h2><a href='../html/signin.php' ><button id='confirm-button' type='submit' value='Buy now!' class='btn' style='width:50%; margin-left:25%;' onclick='getForm()'>Login</button></a>";
                             endif;
                        ?>
                       
                    </div>
                    <div id="content-form-div" class="container-adress-information">
                        
                           
                                              
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


    <!-- Main Script -->
    <script src="../js/script.js"></script>

    <!-- Shopping_cart Script -->
    <script src="../js/shopping_cart.js"></script>
</body>

</html>