<?php
session_start();
?>

<!DOCTYPE html>
<title>Password Change</title>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body class="signin">
        <!--Password change-->
        <div class="wrapper">
        <div class="signin">
            <h1 class="centerheader">Password Change</h1>
            <div class="formbox">
                <form class="signinform" action="forgetlink.php" method="post" autocomplete="off">
                    <br>
                    <!--Alert if error-->
                    <?php
                    if(isset($_SESSION['changestatus'])){
                        echo $_SESSION['changestatus'];
                        unset($_SESSION['changestatus']);
                    }
                    ?>
                    <!--Hidden token field-->
                    <input type="hidden" name="token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">

                    <label class="signin" for="email">Email:</label><br>
                    <input class="signin" type="email" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" required><br>
                    <label class="signin" for="password">New Password: </label><br>
                    <input class="signin" type="password" name="npassword"  required><br>
                    <label class="signin" for="password">Confirm New Password: </label><br>
                    <input class="signin" type="password" name="cpassword"  required><br>
                    <p class="signin">Sign in <a href="signin.php">here</a></p>
                    <button class="signin" type="submit" name="change">Change Password</button>
                    
                </form>
            </div>
        </div>
        </div>
    </body>
</html>