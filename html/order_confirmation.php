<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- Main Style -->
    <link rel="stylesheet" href="../css/order_confirmation.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../css/all.css" />
    <link rel="icon" href="../images/game-controller.ico" />
    <title>New Games</title>
</head>

<body>
    <?php include "../html/header.php"?>

    <!-- Main -->
    <main>
        <section>
            <div>
                <div>
                    <div class="container-table text_style">
                        <table id="orders" class="table-orders">
                            
                            <thead>
                                <tr class="table-title">
                                    <th colspan="4">Order Confirmation</th>
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
                                 if(isset($_SESSION['logged'])){
                                    require_once "../php/connection.php";
                                    $user = $_SESSION['logged'];
                                    $query = "SELECT * FROM users WHERE id_users = '{$user}'";
                                    $result =mysqli_query($conn,$query);
                                    $result = mysqli_fetch_assoc($result);

                                }
                                $total = 0;
                                    if (isset($_SESSION['cart'])){
                                        $produtos_ = "SELECT * FROM game";
                                        $produtos = mysqli_query($conn,$produtos_);
                                        while ($row = mysqli_fetch_assoc($produtos)){
                                            foreach ($_SESSION['cart'] as $value){
                                                if ($row['id_game'] == $value['id_game']){
                                                    $total = $total + (float)$row['game_price']  * (int)$value['item_quantity'];
                                                    echo "
                                                    <tr>
                                                    <th><img src=".$row['game_img']." /></th>
                                                    <th>".$row['game_name']."</th>
                                                    <th>".$row['game_price']."</th>
                                                    <th>
                                                    <div class='counter'>
                                                    ".$value['item_quantity']."
                                                    </div>
                                                    </th>
                                                    </tr>";
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
                                        </tr>
                                        <tr>
                                        <th colspan='4'>
                                        Your order will arrive in ".rand(1, 20)." Business days!
                                        </th>
                                        </tr>
                                        <tr>
                                        <th colspan='4'>
                                        Delivery Information
                                        </th>
                                        </tr>
                                        <tr>
                                        <th colspan='4'>
                                        Customer Name: ".$result['users_name']."
                                        </th>
                                        </tr>

                                        <tr>
                                        <th colspan='4'>
                                        Address: ".$result['users_street'].",".$result['users_number'].",".$result['users_neighborhood'].",".$result['users_zip_code'].",".$result['users_country']."
                                        </th>
                                        </tr>
                                        
                                        
                                        </tfoot>";
                                    }else{
                                        echo "<tr><th span='4'>Cart is Empty</th></tr>";
                                    }
                                ?>

                            </tbody>


                            
                        </table>
                        <form  method="post" action='../html/index.php'>
                            <button type="submit" class='btn' name='confirm_order'>Confirm</button>
                        </form>
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

    <!-- Order_confirmation Script -->
    <script src="../js/order_confirmation.js"></script>
</body>

</html>
