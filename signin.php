<?php
include 'signingin.php'; 
?>

<!DOCTYPE html>
<title>Sign in</title>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body class="signin">
        <!--Sign in-->
        <div class="wrapper">
        <div class="signin">
            <h1 class="centerheader">Sign In</h1>
            <div class="formbox">
                <form class="signinform" action="signin.php" method="post" autocomplete="off">
                    <br>
                    <!--Status display-->
                    <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    ?>
                    <label class="signin" for="email">Email:</label><br>
                    <input class="signin" type="email" name="email" placeholder="Eg: abc@mail.com" required><br>
                    <label class="signin" for="password">Password: </label><br>
                    <input class="signin" type="password" name="password" placeholder="Password" required>
                    <p class="signin">Don't have an account yet? Register <a href="register.php">here</a></p>
                    <p class="signin">Or browse as a guest <a href="home.php">here</a></p>
                    <p class="signin">Forgot your password? Click <a href="forget.php">here</a></p>
                    <p class="signin">Staff log in <a href="admin/staffsignin.php">here</a>.</p>
                    <button class="signin" type="submit" name="signin">Sign in</button>
                </form>
                <img class="formimg" src="images/icon2.png">
            </div>
        </div>
        </div>
    </body>
</html>