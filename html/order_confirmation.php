<!DOCTYPE html>
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
                                $total = 0;
                                    if (isset($_SESSION['cart'])){
                                        $produtos_ = "SELECT * FROM game";
                                        $produtos = mysqli_query($conn,$produtos_);
                                        $product_id = array_column($_SESSION['cart'], 'id_game');
                                        while ($row = mysqli_fetch_assoc($produtos)){
                                            foreach ($product_id as $id){
                                                if ($row['id_game'] == $id){
                                                    $total = $total + (float)$row['game_price'];
                                                    echo "
                                                    <tr>
                                                    <th><img src=".$row['game_img']." /></th>
                                                    <th>".$row['game_name']."</th>
                                                    <th>".$row['game_price']."</th>
                                                    <th>
                                                    <div class='counter'>
                                                    <p> </p>
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
                                        <tr>
                                        <th colspan='4'>
                                        Your order will arrive in Business days!
                                        </th>
                                        <tr>
                                        </tfoot>";
                                    }else{
                                        echo "<tr><th span='4'>Cart is Empty</th></tr>";
                                    }
                                ?>

                            </tbody>


                            
                        </table>
                        <table id="devilery">
                        <?php
                            require_once "../php/connection.php";
                            $result = NULL;
                            if (isset($_SESSION["logged"])) {
                            $query = "SELECT name,email,country, city,zip_code,neighborhood,street,number FROM users WHERE id = {$_SESSION["logged"]}";
                            $result = $conn->query($query);
                            }
                            if ($result):
                                while ($row = $result->fetch_assoc()):
                        ?>

                            <thead>
                                <tr class="delivery-information-title"> <th colspan="4">Delivery information</th></tr>
                                <tr > <th colspan="4">Name: <?php echo "".$row["name"]; ?></th></tr>
                                <tr> <th colspan="4">Email: <?php echo "".$row["email"]; ?></th></tr>
                                <tr > <th colspan="4">Adress: <?php echo "".$row["street"] . "," . $row["number"]; ?></th></tr>
                                <tr> <th colspan="2">City:  <?php echo "".$row["city"] . "," . $row["country"]; ?></th><th colspan="2">Zipcode: <?php echo "".$row["zip_code"]; ?></th></tr>
                            </thead>
                            <?php
                                 endwhile;
                                  endif;
                            ?>
                        </table>
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
