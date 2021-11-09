<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Main Style -->

    <link rel="stylesheet" href="../css/register.css">

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
            <div class="sign_up">
                <div>
                    <div class="form-container">
                        <form action="../php/register.php" method="POST">
                            <p>Sign Up</p>
                            <div class="container_username">
                                <i class="fa fa-user icon username_fig"></i>
                                <input type="text" name="name" placeholder="Full Name" required  onkeypress="return username(event)"/>
                            </div>
                            <div class="container_email">
                                <i class="fa fa-envelope icon envelope_fig"></i>
                                <input type="text" name="email" placeholder="Email" required>
                            </div>
                            <div class="container_password">
                                <i class="fa fa-lock icon password_fig"></i>
                                <input type="password" name="password" placeholder="Password" required >
                            </div>

                            <p class="center_text text_style login_title adress-information-center adress-information-title">Add Delivery Information</p>
                            <div class="delivery-inform">
                                <input type="text" name="street" id="street" placeholder="Street" required class="text_style border-radius username password adress-information-center insert-street"onkeypress="return onlyLetterKey(event)"/>
                                <input type="text" name="neighborhood" id="neighborhood" placeholder="Neighborhood" required class="text_style border-radius username password adress-information-center insert-neighborhood"onkeypress="return onlyLetterKey(event)"/>
                                <input type="text" name="city" id="city" placeholder="City" required class="text_style border-radius username password adress-information-center insert-city"onkeypress="return onlyLetterKey(event)"/>
                                <input type="text" name="zipcode" id="zipcode" placeholder="Zip code" required class="text_style border-radius username password adress-information-center insert-zipcode" onkeypress="return onlyNumberKey(event)"/>
                                <input type="text" name="house-number" id="house-number" placeholder="Number" required class="text_style border-radius username password adress-information-center house-number" onkeypress="return onlyNumberKey(event)"/>                                
                            </div>          
                               
                                <input type="text" name="country" id="country"  placeholder="Country" required class="text_style border-radius username password adress-information-center insert-country"onkeypress="return onlyLetterKey(event)"/>
                            <button class="btn" type="submit" value="Sign Up" onclick="ValidateEmail(document.form.email)">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
   
    <?php include "../html/footer.php" ?>

    <!--JQuery Library -->
    <script src="../js/Jquery3.4.1.min.js"></script>

     <!-- Shopping_cart Script -->
     <script src="../js/shopping_cart.js"></script>

    <!-- Main Script -->
    <script src="../js/script.js"></script>
</body>

</html>