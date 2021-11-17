
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.theme.min.css">

    <!-- AOS Library -->
    <link rel="stylesheet" href="../css/aos.css">

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
        <section id="bannerSite">
            <!-- Hero -->
            <div class="hero">
                <div class="glide" id="glide_1">
                    <div class="glide__track" data-glide-el="track" data-aos="fade-right" data-aos-delay="200">
                        <ul class="glide__slides">
                            <li class="glide__slide">
                                <div class="hero__center">
                                    <div class="hero__left">
                                        <h1>Sonic Mania</h1>
                                        <p>Sonic Mania is an all-new adventure with Sonic, Tails, and Knuckles full of
                                            unique bosses, rolling 2D landscapes, and fun classic gameplay.</p>
                                        <a href="../html/products.html"><button class="hero__btn">SHOP NOW</button></a>
                                    </div>
                                    <div class="hero__right">
                                        <div class="hero__img-container">
                                            <img class="banner_01" src="../images/SonicMania.jpg" alt="banner1" />
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="glide__slide">
                                <div class="hero__center">
                                    <div class="hero__left">
                                        <h1>Dead Cells</h1>
                                        <p>Dead Cells is a rogue-lite, metroidvania inspired, action-platformer. You'll
                                            explore a sprawling, ever-changing castle... assuming you're able to fight
                                            your way past its keepers in 2D souls-lite combat. No checkpoints. Kill,
                                            die, learn, repeat.</p>
                                        <a href="../html/products.html"><button class="hero__btn">SHOP NOW</button></a>
                                    </div>
                                    <div class="hero__right">
                                        <img class="banner_02" src="../images/DeadCells.jpg" alt="banner2" />
                                    </div>
                                </div>
                            </li>
                            <li class="glide__slide">
                                <div class="hero__center">
                                    <div class="hero__left">
                                        <h1>Resident Evil Village</h1>
                                        <p>Experience survival horror like never before in the 8th major installment in
                                            the Resident Evil franchise.</p>
                                        <a href="../html/products.html"><button class="hero__btn">SHOP NOW</button></a>
                                    </div>
                                    <div class="hero__right">
                                        <img class="banner_03" src="../images/RESIDENT-EVIL-8-1.jpg" alt="banner3" />
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="glide__bullets" data-glide-el="controls[nav]">
                        <button class="glide__bullet" data-glide-dir="=0"></button>
                        <button class="glide__bullet" data-glide-dir="=1"></button>
                        <button class="glide__bullet" data-glide-dir="=2"></button>
                    </div>

                    <div class="glide__arrows" data-glide-el="controls">
                        <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </button>
                        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>

                </div>
            </div>
        </section>
        <!--Most Popular-->
        <section id="Most-Popular">
            <div class="post">
                <div class="container" data-aos="fade-in" data-aos-delay="200">
                    <h2>MOST POPULAR</h2>
                    <div id="popularDivPost" class="game-post">
                    <?php 
                            $produtos_ = "SELECT * FROM game where game_situation='Popular'";
                            $produtos = mysqli_query($conn,$produtos_);
                            while($row_game = mysqli_fetch_assoc($produtos)){
                                echo "<div class='game-content' id=".$row_game['id_game'].">
                               
                                <div>
                                <img src=".$row_game['game_img']."></img>
                                </div>
                                <div class='game-title'>
                                <h3>".$row_game['game_name']."</h3>
                                <h4>$".$row_game['game_price']."</h4>
                                <form method='post'>
                                <button class='btn' type='submit' name='add'>Add to Cart</button>
                                <input type='hidden' name='id_game' value=".$row_game['id_game'].">
                                </form>
                                </div>
                                </div>";
                            }
                            
                            ?>
                    </div>
                </div>
            </div>
        </section>
        <!--New Products-->
        <section id="New Products">
            <div class="products">
                <div class="container"  data-aos="fade-right" data-aos-delay="200">
                    <h2>NEW PRODUCTS</h2>
                    <div id="newProductsDiv" class="game-post">
                    <?php 
                            $produtos_ = "SELECT * FROM game where game_situation='New'";
                            $produtos = mysqli_query($conn,$produtos_);
                            while($row_game = mysqli_fetch_assoc($produtos)){
                                echo "<div class='game-content' id=".$row_game['id_game'].">
                                <div>
                                <img src=".$row_game['game_img']."></img>
                                </div>
                                <a>".$row_game['game_name']."</a>
                                <span>$".$row_game['game_price']."</span>

                                <form method='post'>
                                <button class='btn' type='submit' name='add'>Add to Cart</button>
                                <input type='hidden' name='id_game' value=".$row_game['id_game'].">
                                </form>
                                </div>";
                            }
                            
                            ?>
                    </div> 
                </div>
            </div>
        </section>
        <!--Sale-->
        <section id="Sale">
            <div class="sale">
                <div class="container" data-aos="fade-left" data-aos-delay="200">
                    <h2>SALE</h2>
                    <div id="saleDiv" class="game-post">
                    <?php 
                            $produtos_ = "SELECT * FROM game where game_situation='Sale'";
                            $produtos = mysqli_query($conn,$produtos_);
                            while($row_game = mysqli_fetch_assoc($produtos)){
                                echo "<div class='game-content' id=".$row_game['id_game'].">
                                <div>
                                <img src=".$row_game['game_img']."></img>
                                </div>
                                <a>".$row_game['game_name']."</a>
                                <span>$".$row_game['game_price']."</span>
                                <form method='post'>
                                <button class='btn' type='submit' name='add'>Add to Cart</button>
                                <input type='hidden' name='id_game' value=".$row_game['id_game'].">
                                </form>
                                </div>";
                            }
                            
                            ?>
                    </div> 
                </div>
            </div>
        </section>
    </main>

    <?php include "../html/footer.php" ?>

    <a href="#" class="goto-top scroll-link">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Glide Carousel Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/glide.min.js"></script>

    <!--JQuery Library -->
    <script src="../js/Jquery3.4.1.min.js"></script>

    <!-- AOS js Library -->
    <script src="../js/aos.js"></script>

    <!-- Glide Configs -->
    <script src="../js/glide.js"></script>

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