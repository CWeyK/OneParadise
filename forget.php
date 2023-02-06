<?php
session_start();
?>

<!DOCTYPE html>
<title>Sign in</title>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body class="signin">
        <!--Form for password reset-->
        <div class="wrapper">
        <div class="signin">
            <h1 class="centerheader">Reset your password</h1>
            <div class="formbox">
                <form class="signinform" action="forgetlink.php" method="post" autocomplete="off">
                    <br>
                    <!--Alert if email not found-->
                    <?php
                    if(isset($_SESSION['resetstatus'])){
                        echo $_SESSION['resetstatus'];
                        unset($_SESSION['resetstatus']);
                    }
                    ?>
                    <label class="signin" for="email">Email:</label><br>
                    <input class="signin" type="email" name="email" placeholder="Eg: abc@mail.com" required><br>

                    <p class="signin">Log in <a href="signin.php">here</a>.</p>
                    <button class="signin" type="submit" name="resetlink">Send password reset link</button>
                </form>
            </div>
        </div>
        </div>
    </body>
</html>