<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Main Style -->
    <link rel="stylesheet" href="../css/signin.css">

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
            <div class="sign_in">
                <div class="sign_up-container content">
                    <div class="second-container border-radius ">
                        <form action="../php/auth.php" method="post">
                            <p class="center_text text_style login_title">LOGIN</p>
                            <div class="container_username">
                                <i class="fa fa-user icon username_fig"></i>
                                <input type="email" name="email" placeholder="Email" required class="text_style border-radius username">
                            </div>
                            <div class="container_password">
                                <i class="fa fa-lock icon password_fig"></i>
                                <input type="password" name="password" placeholder="Password" required class="text_style border-radius username password">
                            </div>
                            <input type="submit" value="Sign In" class="text_style border-radius username login_btn">
                        </form>
                        <div class="container_signup">
                            <p class="center_text text_style question_account">Don't have a New Games account?</p>
                            <a class="signup_text" href="../html/signup.php">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <?php include "../html/footer.php" ?>

    <!--JQuery Library -->
    <script src="../js/Jquery3.4.1.min.js"></script>

    <!-- Main Script -->
    <script src="../js/script.js"></script>
</body>

</html>