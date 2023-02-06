<?php
include 'staffsigningin.php'; 
?>

<!DOCTYPE html>
<title>Staff Sign In Page</title>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body class="signin">
        <!--Sign in-->
        <div class="wrapper">
        <div class="signin">
            <h1 class="centerheader">Staff Sign In Page</h1>
            <div class="formbox">
                <form class="signinform" action="staffsignin.php" method="post" autocomplete="off">
                    <br>
                    <!--debug display-->
                    <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    ?>
                    <label class="signin" for="staffid">Staff ID:</label><br>
                    <input class="signin" type="sid" name="sid" placeholder="Staff ID" required><br>
                    <label class="signin" for="password">Password: </label><br>
                    <input class="signin" type="password" name="password" placeholder="Password" required>
                    <p class="signin">If You Are Not A Staff Please Click <a href="../signin.php">here</a></p>
                    <button class="signin" type="submit" name="signin">Sign in</button>
                </form>
                <img class="formimg" src="../images/icon2.png">
            </div>
        </div>
        </div>
    </body>
</html>