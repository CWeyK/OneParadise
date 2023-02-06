<?php 
include 'adminheader.php';
include 'conn.php';
?>
<!DOCTYPE html> 
<html lang="en">
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head>  
	<title> Add Services</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body> 
<?php
        if ($_SESSION['name']=="Guest"){
            echo "<p class='marginleft'>Please log in to view this page</p>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        }else{
    ?> 
	<center>
	<?php include 'searchform.php' ?>
 <h3 class="marginleft">Upcoming Appointments</h3>
        <!--Display upcoming appointments-->
        <?php
            
            $sql ="select * from appointment where date >= CURDATE()";
            $result = mysqli_query($conn, $sql); 

            if (mysqli_num_rows($result) > 0) {
        ?>
        <table class="appointment">
        <tr>
            <th class="appointment">Date</th>
            <th class="appointment">Time Slot</th>
            <th class="appointment">Customer ID</th>
            <th class="appointment">Service</th>
            <th class="appointment">Price</th>
            <th class="appointment">Edit</th>
            <th class="appointment">Delete</th>
        </tr>
        <?php
                // output data of each row
                while($row=mysqli_fetch_assoc($result)) {   
        ?>
            <!--Display Values-->
            <tr>
                <td class="appointment"><?=$row["date"]?></td>
                <td class="appointment"><?=$row["time"]?></td>
                <td class="appointment"><?=$row["cid"]?></td>
                <td class="appointment"><?=$row["service_name"]?></td>
                <td class="appointment"><?=$row["price"]?></td>    
                <td class="appointment"><a href="edit.php?date=<?=$row['date']?>&time=<?=$row['time']?>">Edit Appointment</a></td>
                <td class="appointment"><a href="cancelling.php?date=<?=$row['date']?>&time=<?=$row['time']?>">Cancel Appointment</a></td>
            </tr>
        <?php
            }
        } else {
            echo "<p class='marginleft'>0 results</p>";
        }
?>
        </table>
        <!--Showing past appointments table-->
        <h3 class="marginleft">Past appointments</h3>
        
        <?php
            $sql ="select * from appointment where date < CURDATE()";
            $result = mysqli_query($conn, $sql); 

            if (mysqli_num_rows($result) > 0) {
        ?>
        <table class="appointment">
        <tr>
            <th class="appointment">Date</th>
            <th class="appointment">Time Slot</th>
            <th class="appointment">Customer ID</th>
            <th class="appointment">Service</th>
        </tr>
        <?php
                // output data of each row
                while($row=mysqli_fetch_assoc($result)) {   
        ?>
            <!--Display Values-->
            <tr>
                <td class="appointment"><?=$row["date"]?></td>
                <td class="appointment"><?=$row["time"]?></td>
                <td class="appointment"><?=$row["cid"]?></td>
                <td class="appointment"><?=$row["service_name"]?></td>
            </tr>
        <?php
            }
        } else {
            echo "<p class='marginleft'>0 results</p>";
        }
?>
        </table><br>
		<?php } ?>
		<br><br><br><br><br></center>
<footer>
		<?php include 'footer.php';?>
	</footer>
</body>
</html>