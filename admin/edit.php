<?php
include 'adminheader.php';
include 'conn.php';
$date=$_GET["date"]??"";
$time=$_GET["time"]??"";

if(empty($date)){
    $date=$_SESSION['date'];
}else{
    $_SESSION['date']=$date;
}
if(empty($time)){
    $time=$_SESSION['time'];
}else{
    $_SESSION['time']=$time;
}

//get details of the appointment
$detailsql="SELECT * FROM appointment WHERE date='$date' AND time='$time'";
$detailquery=mysqli_query($conn,$detailsql);
$result=mysqli_fetch_array($detailquery);
$service=$result['service_name'];
$price=$result['price'];
$cid=$result['cid'];




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
        <form action="edit.php" autocomplete="off" method="post">
            <!--Display result-->
            <?php
                if(isset($_SESSION['cidstatus'])){
                    echo $_SESSION['cidstatus']. "<br>";
                    unset($_SESSION['cidstatus']);
                }
                if(isset($_SESSION['servicestatus'])){
                    echo $_SESSION['servicestatus']. "<br>";
                    unset($_SESSION['servicestatus']);
                }
                if(isset($_SESSION['pricestatus'])){
                    echo $_SESSION['pricestatus']. "<br>";
                    unset($_SESSION['pricestatus']);
                }
            ?>

            <h2 class="marginleft">Current details:</h2>
            <p class="marginleft">Date:<?=$date?></p>
            <p class="marginleft">Time slot:<?=$time?></p>
            <p class="marginleft">Customer ID:<?=$cid?></p>
            <p class="marginleft">Service:<?=$service?></p>
            <p class="marginleft">Price:<?=$price?></p><br>
            

            <h2 class="marginleft">Edit details</h3>   
            <span class="marginleft">Change date and time </span><a href="edit2.php?date=<?=$_SESSION['date']?>&time=<?=$_SESSION['time']?>">here</a><br><br> 
            <label for="ncid" class="marginleft">Customer ID:</label><br>
            <select name="ncid" id="ncid" class="marginleft">
                <option value=''>Default</option>
                <!--Obtain cid from database-->
                <?php 
			    $querycid="SELECT * from customer";
			    $querycid_run=mysqli_query($conn,$querycid);
			    while($cdata=mysqli_fetch_array($querycid_run)){
	  			    $dcid=$cdata['cid'];
                    $duname=$cdata['username'];
	  			    echo "<option value='$dcid'>$dcid - Username: ($duname)</option>";
			    } ?>
		    </select><br> <br>

            <label for="service" class="marginleft">Service:</label><br>
            <select name="service" id="service" class="marginleft">
                <option value=''>Default</option>
                <!--Obtain services from database-->
                <?php 
			    $query="SELECT * from service";
			    $query_run=mysqli_query($conn,$query);
			    while($sdata=mysqli_fetch_array($query_run)){
	  			    $sname=$sdata['name'];
	  			    $sprice=$sdata['price'];
	  			    echo "<option value='$sname'>$sname - Price: (RM $sprice)</option>";
			    } ?>
		    </select><br> <br>

            <label for="cid" class="marginleft">Price:</label><br>
            <input class="signin" type="text" name="price" ><br>


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

        //changing cid
        if (!empty($_POST['ncid'])){
            $ncid=$_POST['ncid'];
            $sqlcid="UPDATE appointment SET cid='$ncid' WHERE date='$date' AND time='$time'";
            $querycid2=mysqli_query($conn,$sqlcid);
            if($querycid2) {
                $_SESSION['cidstatus']="<div class=success>Customer ID changed succesfully</div>";
                header("Location: edit.php");
            }
        }
        //changing service
        if (!empty($_POST['service'])){
            $nservice=$_POST['service'];
            $sqlservice="UPDATE appointment SET service_name='$nservice' WHERE date='$date' AND time='$time'";
            $queryservice=mysqli_query($conn,$sqlservice);
            if($queryservice) {
                $_SESSION['servicestatus']="<div class=success>Service changed succesfully</div>";
                header("Location: edit.php");
            }
        }
        //changing price
        if (!empty($_POST['price'])){
            $nprice=$_POST['price'];
            if(is_numeric($nprice)){
                $sqlprice="UPDATE appointment SET price='$nprice' WHERE date='$date' AND time='$time'";
                $queryprice=mysqli_query($conn,$sqlprice);
                $_SESSION['price']=$nprice;
                if($queryprice) {
                    $_SESSION['pricestatus']="<div class=success>Price changed succesfully</div>";
                    header("Location: edit.php");
                }
            }else{
                $_SESSION['pricestatus']="<div class=error>Price must be a number</div>";
                header("Location: edit.php");
            }
            
        }
        
    }

 include 'footer.php' 
 ?>