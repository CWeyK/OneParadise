<?php
include 'adminheader.php';
$date=$_GET["date"]??"";
$time=$_GET["time"]??"";
include "conn.php";
/*Deleting part */
/*if confirm button is pressed*/
if (isset($_POST['cancelling'])){
    $sql = "DELETE  FROM appointment WHERE date='$date' AND time='$time'";
    if (mysqli_query($conn,$sql)) {
        $_SESSION['cancel']="<div class=success>Appointment succesfully cancelled.</div><p class='marginleft'>Click <a href='bookings.php'>here</a> to go back to my appointments</p>";
    } else {
        $_SESSION['cancel']="<div class=error>Something went wrong.</div>";
    }
}
/*if back button is pressed*/
if (isset($_POST['back'])){
    header('location: bookings.php');
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
        <h1 class="marginleft">Are you sure you want to cancel this appointment?</h1>
        <h2 class="marginleft">Appointment Details:</h2>
        <!--Obtain appointment details-->
        <?php
            $details="SELECT * FROM appointment WHERE date='$date' AND time='$time'";
            $details_run=mysqli_query($conn, $details);
            if(mysqli_num_rows($details_run)==1){
                $result=mysqli_fetch_array($details_run);
                $service=$result['service_name'];
                $_SESSION['service']=$service;
                $price=$result['price'];
                $_SESSION['price']=$price;
            }else{
                $service=$_SESSION['service'];
                $price=$_SESSION['price'];
            }
        ?>
        <p class="marginleft">Date:<?=$date?></p>
        <p class="marginleft">Time:<?=$time?></p>
        <p class="marginleft">Service:<?=$service?></p>
        <p class="marginleft">Price:<?=$price?></p>
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

