<?php 
include 'registration.php';
?>



<!DOCTYPE html>
<title>Register</title>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body class="register">
        <!--Register in-->
        <div class="wrapper" >
        <div class="register">
            <h1 class="centerheader">Register</h1>
            <div class="formbox">
                <form class="signinform" action="registration.php" method="post" autocomplete="off">
                    <!--Display if register successful-->
                    <?php
                    if(isset($_SESSION['status'])){
                        echo $_SESSION['status'];
                        unset($_SESSION['status']);
                    }
                    ?>
                    <!--Form component-->
                    <label class="signin" for="name">Full Name:</label><br>
                    <input class="register" type="text" name="name" required><br>

                    <label class="signin" for="pnumber">Phone Number:</label><br>
                    <input class="register" type="text" name="pnumber" required><br>

                    <label class="signin" for="email">Email:</label><br>
                    <input class="register" type="email" name="email" required><br>

                    <label class="signin" for="username">Username:</label><br>
                    <input class="register" type="text" name="username" required><br>

                    <label class="signin" for="password">Password: </label><br>
                    <input class="register" type="password" name="password" required><br>

                    <label class="signin" for="cpassword">Confirm Password: </label><br>
                    <input class="register" type="password" name="cpassword" required>

                    <p class="signin">Already have an account? Sign in <a href="signin.php">here</a></p>
                    <button class="signin" type="submit" name="register">Register</button>
                </form>
                <img class="registerimg" src="images/icon2.png">
            </div>
        </div>
        </div>
    </body>
</html>