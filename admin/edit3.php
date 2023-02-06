<?php
include 'adminheader.php';
include 'conn.php';

?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <br>
        <h1 class="marginleft">Edit Date and Time</h1>
        <br>
        <?php
                if(isset($_SESSION['book'])){
                    echo $_SESSION['book']. "<br>";
                    unset($_SESSION['book']);
                }
        ?>
        <form class="bookingform" method="post" autocomplete="off">
        <p class="marginleft">Current date: <?=$_SESSION['date']?>
        <p class="marginleft">Chosen date: <?=$_SESSION['newdate']?></p>
        <p class="marginleft">Choose a time slot: Green-Available, Red-Taken, Blue-Selected</p>
            <br>
            <!--Radio buttons for time-->
                <div class="radio">
                    <input class="<?=$_SESSION['time1']?>radio_input" type="radio" value="8AM-10AM" name="newtime" id="8AM-10AM">
                    <label class="<?=$_SESSION['time1']?>radio_label" for="8AM-10AM">8AM-10AM</label>
                    <input class="<?=$_SESSION['time2']?>radio_input" type="radio" value="10AM-12PM" name="newtime" id="10AM-12PM">
                    <label class="<?=$_SESSION['time2']?>radio_label" for="10AM-12PM">10AM-12PM</label>
                    <input class="<?=$_SESSION['time3']?>radio_input" type="radio" value="12PM-2PM" name="newtime" id="12PM-2PM">
                    <label class="<?=$_SESSION['time3']?>radio_label" for="12PM-2PM">12PM-2PM</label>
                    <input class="<?=$_SESSION['time4']?>radio_input" type="radio" value="2PM-4PM" name="newtime" id="2PM-4PM">
                    <label class="<?=$_SESSION['time4']?>radio_label" for="2PM-4PM">2PM-4PM</label>
                    <input class="<?=$_SESSION['time5']?>radio_input" type="radio" value="4PM-6PM" name="newtime" id="4PM-6PM">
                    <label class="<?=$_SESSION['time5']?>radio_label" for="4PM-6PM">4PM-6PM</label>
                </div><br>
                <br>
            <button class="signin" type="submit" name="submit">Confirm</button>
        </form>

        <form method="post">
                <button class="back" type="submit" name="back">Back to bookings</button>
        </form>
    </body>
</html>

<?php
//if back button is pressed
if (isset($_POST['back'])){
    header('location: bookings.php');
}
//editing part
if (isset($_POST['submit'])){
    $date=$_SESSION['date'];
    $time=$_SESSION['time'];
    $newdate=$_SESSION['newdate'];
    $newtime=$_POST['newtime'];
    $sql="UPDATE appointment SET date='$newdate',time='$newtime' WHERE date='$date' AND time='$time'";
    $query=mysqli_query($conn,$sql);
    if($query){
        $_SESSION['book']="<div class=success>Date and time succesfully changed</div>";
        header ("Location: edit3.php");
    }
        
}

 include 'footer.php' 
 ?>