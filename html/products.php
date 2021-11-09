<!DOCTYPE html>
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


    <!-- Main -->
    <main>
        <section>
            <div class="products-list container">
                <div class="col-1">
                    <div>
                        <div>
                            <h3>Category</h3>
                        </div>
                        <select id="Category" name="select" onclick="Filter()">
                            <option selected value="-1">All</option>
                            <option value="0">RPG</option>
                            <option value="1">Survival horror</option>
                            <option value="2">Action</option>
                            <option value="3">Platform</option>
                            <option value="4">Multiplayer</option>
                        </select>
                        <h3>Price</h3>
                        <select id="Price" name="select" onclick="Filter()">
                            <option selected value="999">Select Filter</option>
                            <option value="10">Under $10.00</option>
                            <option value="20">Under $20.00</option>
                            <option value="40">Under $40.00</option>
                            <option value="80">Under $80.00</option>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <h3>Products</h3>
                    <div class="list"  data-aos="fade-in" data-aos-delay="200">
                        <div>
                            <div id="productsListDiv" class="game-list"></div>     
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

    <!--Load Products in products page-->
    <script src="../js/LoadProducts.js"></script>

    <!--Some important functions-->
    <script src="../js/util.js"></script>

    <!--Main Script-->
    <script src="../js/script.js"></script>
</body>

</html>
