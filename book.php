<?php include 'header.php';
include 'booking.php';?>
<!DOCTYPE HTML>
<html>
    <head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body class="home">
    <?php
        if ($_SESSION['username']=="Guest"){
            echo "<p class='marginleft'>Please log in to view this page</p>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        }else{
    ?>
        <h1>&nbsp; Book an appointment</h1>
        <br>
            <!--Status display-->
            <?php
                if(isset($_SESSION['book'])){
                    echo $_SESSION['book'];
                    unset($_SESSION['book']);
                }
            ?>
        <form class="bookingform" action="book.php" method="post" autocomplete="off">
            <!--Hidden field containing id of customer-->
            <input type="hidden" name="cid" value="<?php if(isset($_SESSION['cid'])){echo $_SESSION['cid'];} ?>">
            <label for="service">Service:</label><br>
            <select name="service" id="service">
                <!--Obtain services from database-->
                <?php 
                $conn = mysqli_connect("localhost","root","","massage", 3307);
			    $query="SELECT * from service";
			    $query_run=mysqli_query($conn,$query);
			    while($sdata=mysqli_fetch_array($query_run)){
	  			    $sname=$sdata['name'];
	  			    $price=$sdata['price'];
	  			    echo "<option value='$sname'>$sname - Price: (RM $price)</option>";
			    } ?>
		    </select><br> 

            <label for="date">Date:</label><br>
            <input type="date" name="date" required><br>
            
            <button class="signin2" type="submit" name="book">Proceed</button>
        </form>
        <?php } ?>
    </body>
</html>
<?php include 'footer.php' ?>