<?php include 'signingin.php'?>

<!DOCTYPE html>
<title>OneParadise</title>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="navbar-logo">
            <div class="logo">
                <a href="home.php">
                    <img src="images/icon2.png">
                </a>
            </div>
        </div>
     <!--Nav bar section-->
<ul class="topnav">
  <li><a href="home.php">Home</a></li>
  <li><a href="services.php">Services</a></li>
    <!-- <div class="dropdown">
                <button class="dropbutton">Services</button>
                <div class="dropdown-content">
                    <a href="back.html">Back</a>
                    <a href="legs.html">Legs</a>
                    <a href="arms.html">Arms</a>
                    <a href="body.html">Full-Body</a>
                </div> 
            </div> -->
  <li><a href="book.php">Book an Appointment</a></li>
  <li><a href="appointments.php">My Appointments</a></li> 
    <!--If anonymous login-->
    <?php if(empty($_SESSION['username'])){
                $_SESSION['username']="Guest";
            }
            ?>
  <li class="right"><div class ="dropdownicon">
                <button class="dropbutton"><img src="images/profileicon.png" class="profileicon"></button>
                <div class="dropdown-content">
                    <a href="profile.php">My Profile</a>
                    <a href="signin.php?logout='1'">Sign out</a>
                </div>
            </div>
      
            <p class="welcome">Welcome <?=$_SESSION['username']?></p>
</li>   
</ul>
</body>
</html>