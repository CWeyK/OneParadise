<?php
include 'adminheader.php';
$vcode=$_GET["vcode"]??"";
include "conn.php";
/*Deleting part */
/*if confirm button is pressed*/
if (isset($_POST['cancelling'])){
    $sql = "DELETE  FROM voucher WHERE vcode='$vcode'";
    if (mysqli_query($conn,$sql)) {
        $_SESSION['cancel']="<div class=success>Voucher succesfully deleted.</div><p class='marginleft'>Click <a href='voucher.php'>here</a> to go back to vouchers</p>";
    } else {
        $_SESSION['cancel']="<div class=error>Something went wrong.</div>";
    }
}
/*if back button is pressed*/
if (isset($_POST['back'])){
    header('location: voucher.php');
}

?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class>
        <h1 class="marginleft">Are you sure you want to delete this voucher?</h1>
        <h2 class="marginleft">Voucher Details:</h2>
        <!--Obtain voucher details-->
        <?php
            $details="SELECT * FROM voucher WHERE vcode='$vcode'";
            $details_run=mysqli_query($conn, $details);
            if(mysqli_num_rows($details_run)==1){
                $result=mysqli_fetch_array($details_run);
                $amount=$result['amount'];
                $_SESSION['amount']=$amount;
                $status=$result['status'];
                $_SESSION['status']=$status;
            }else{
                $amount=$_SESSION['amount'];
                $status=$_SESSION['status'];
            }
        ?>
        <p class="marginleft">Voucher Code:<?=$vcode?></p>
        <p class="marginleft">Amount:<?=$amount?></p>
        <p class="marginleft">Status:<?=$status?></p>
        <!--Display status-->
        <?php
            if(isset($_SESSION['cancel'])){
                echo $_SESSION['cancel'];
                unset($_SESSION['cancel']);
            }
        ?>
        <form method="post">
            <button class="signin" type="submit" name="cancelling">Confirm</button>
            <button class="back" type="submit" name="back">No, take me back</button>
        </form>

    </body>
</html>
<?php include 'footer.php' ?>

