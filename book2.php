<?php include 'header.php';
include 'booking.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body class="home">
        <h1>&nbsp; Book an appointment</h1>
        <form class="bookingform" action="book2.php" method="post" autocomplete="off">
            <br>
            <!--Display chosen date-->
            <p>&nbsp; &nbsp; &nbsp;Chosen date: <?=$_SESSION['date']?></p>
            <p>&nbsp; &nbsp; &nbsp;Choose a time slot: Green-Available, Red-Taken, Blue-Selected</p>
            <!--Status display-->
            <?php
                if(isset($_SESSION['book'])){
                    echo $_SESSION['book'];
                    unset($_SESSION['book']);
                }
            ?>
            <br>
            <!--Radio buttons for time-->
                <div class="radio">
                    <input class="<?=$_SESSION['time1']?>radio_input" type="radio" value="8AM-10AM" name="time" id="8AM-10AM">
                    <label class="<?=$_SESSION['time1']?>radio_label" for="8AM-10AM">8AM-10AM</label>
                    <input class="<?=$_SESSION['time2']?>radio_input" type="radio" value="10AM-12PM" name="time" id="10AM-12PM">
                    <label class="<?=$_SESSION['time2']?>radio_label" for="10AM-12PM">10AM-12PM</label>
                    <input class="<?=$_SESSION['time3']?>radio_input" type="radio" value="12PM-2PM" name="time" id="12PM-2PM">
                    <label class="<?=$_SESSION['time3']?>radio_label" for="12PM-2PM">12PM-2PM</label>
                    <input class="<?=$_SESSION['time4']?>radio_input" type="radio" value="2PM-4PM" name="time" id="2PM-4PM">
                    <label class="<?=$_SESSION['time4']?>radio_label" for="2PM-4PM">2PM-4PM</label>
                    <input class="<?=$_SESSION['time5']?>radio_input" type="radio" value="4PM-6PM" name="time" id="4PM-6PM">
                    <label class="<?=$_SESSION['time5']?>radio_label" for="4PM-6PM">4PM-6PM</label>
                </div><br>
                <br>
            <label class="marginleft" for="discount">Voucher Code(Optional):</label><br>
            <input class="signin" type="text" name="vcode"><br>
            <button class="signin" type="submit" name="book2">Confirm</button>
        </form>
    </body>
</html>
<?php include 'footer.php' ?>