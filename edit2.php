<?php
include 'header.php';
include 'conn.php';

?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="home">
        <br>
        <form action="edit2.php" autocomplete="off" method="post">
            <?php
                if(isset($_SESSION['changep'])){
                    echo $_SESSION['changep'];
                    unset($_SESSION['changep']);
                }
            ?>
            <label class="marginleft" for="newp">New password:</label><br>
            <input class="signin" type="password" name="newp" required><br>

            <label class="marginleft" for="cnewp">Confirm new password:</label><br>
            <input class="signin" type="password" name="cnewp" required><br>

            <label class="marginleft" for="oldp">Please enter your current password to confirm:</label><br>
            <input class="signin" type="password" name="oldp" required><br>

            <button class="signin" type="submit" name="submit">Confirm</button>

        </form>
        <form method="post">
                <button class="back" type="submit" name="back">Back to profile</button>
        </form>
    </body>
</html>

<?php
//if back button is pressed
if (isset($_POST['back'])){
    header('location: profile.php');
}
//if submit button is pressed
if (isset($_POST['submit'])){
    $newp=$_POST['newp'];
    $cnewp=$_POST['cnewp'];
    $oldp=$_POST['oldp'];
    $cid=$_SESSION['cid'];
    //check if the two passwords match
    if($newp==$cnewp){
        //check if current password is correct
        $encoldp=md5($oldp);
        $sql="SELECT * FROM customer WHERE password='$encoldp' AND cid='$cid';";
        $query=mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($query)==1){
            $encnewp=md5($newp);
            $cid=$_SESSION['cid'];
            $changep="UPDATE customer SET password='$encnewp' WHERE cid='$cid'";
            $query=mysqli_query($conn,$changep);
            $_SESSION['changep']= "<div class=success>Password changed succesfully!</div>";
            header("Location: edit2.php");

        }else{
            $_SESSION['changep']= "<div class=error>Your current password is incorrect!</div>";
            header("Location: edit2.php");
        }
    }else{
        $_SESSION['changep']= "<div class=error>The two passwords do not match!</div>";
        header("Location: edit2.php");
    }
}
include 'footer.php' ?>