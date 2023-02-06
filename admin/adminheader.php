<?php
include 'staffsigningin.php';
if(empty($_SESSION['name'])){
    $_SESSION['name']="Guest";
}

?>

<!DOCTYPE html>
<title>OneParadise Staff Portal</title>
<html>
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        <div class="navbar-logo">
            <div class="logo">
                <a href="home.html">
                    <img src="../images/icon2.png">
                </a>
            </div>
        </div>
        <ul class="topnav">
            <li><a href="adminhome.php">Home</a></li>	
				<li><a href="bookings.php">Check Bookings</a></li>	
				<li><a href="addservice.php">Add Services</a></li>	
				<li><a href="custlist.php">Customer List</a></li>	
				<li><a href="../home.php">Customer Site</a></li>
                <li><a href="voucher.php">Vouchers</a></li>	
            <div class ="dropdownicon">
                <button class="dropbutton"><img src="../images/profileicon.png" class="profileicon"></button>
                <div class="dropdown-content">   
                    <a href="staffsignin.php?logout='1'">Sign out</a>
                </div>
            </div>
            <p class="welcome">Welcome <?=$_SESSION['name']?></p>
        </ul>

    </body>
</html>