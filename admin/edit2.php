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
            <label for="newdate" class="marginleft">Date:</label><br>
            <input type="date" name="newdate" class="marginleft" required><br><br><br><br><br>
            
            <button class="signin" type="submit" name="submit">Proceed</button>
        </form>
            
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
    
    //saving value
    $newdate=$_POST['newdate'];
    $_SESSION['newdate']=$newdate;
    //Verify date
    //convert string to date
    $sdate=DateTime::createFromFormat("Y-m-d H:i:s","$newdate 00:00:00");
    $today=new DateTime();
    //comparing dates
    if($sdate>$today){
        //If date is in the future
        //check the date for available time slots
        $time1query="select * from appointment where '8AM-10AM'= time AND '$newdate'=date";
        $time2query="select * from appointment where '10AM-12PM'= time AND '$newdate'=date";
        $time3query="select * from appointment where '12PM-2PM'= time AND '$newdate'=date";
        $time4query="select * from appointment where '2PM-4PM'= time AND '$newdate'=date";
        $time5query="select * from appointment where '4PM-6PM'= time AND '$newdate'=date";
        $time1run=mysqli_query($conn, $time1query);
        $time2run=mysqli_query($conn, $time2query);
        $time3run=mysqli_query($conn, $time3query);
        $time4run=mysqli_query($conn, $time4query);
        $time5run=mysqli_query($conn, $time5query);
        if(mysqli_num_rows($time1run)==1){
            $_SESSION['time1']='r';
        }else{
            $_SESSION['time1']='g';
        }
        if(mysqli_num_rows($time2run)==1){
            $_SESSION['time2']='r';
        }else{
            $_SESSION['time2']='g';
        }
        if(mysqli_num_rows($time3run)==1){
            $_SESSION['time3']='r';
        }else{
            $_SESSION['time3']='g';
        }
        if(mysqli_num_rows($time4run)==1){
            $_SESSION['time4']='r';
        }else{
            $_SESSION['time4']='g';
        }
        if(mysqli_num_rows($time5run)==1){
            $_SESSION['time5']='r';
        }else{
            $_SESSION['time5']='g';
        }
        //if all slots booked
        if($_SESSION['time1']=='r' && $_SESSION['time2']=='r'&& $_SESSION['time3']=='r'&& $_SESSION['time4']=='r'&& $_SESSION['time5']=='r'){
            $_SESSION['book']="<div class=error>All slots booked on selected date</div>";
            header ("Location: edit2.php");
        }else{
            
            header('Location: edit3.php');
        }
    }else{
        //Error because date is in the past
        $_SESSION['book']="<div class=error>Invalid date</div>";
        header ("Location: edit2.php");
    }
        
}

 include 'footer.php' 
 ?>