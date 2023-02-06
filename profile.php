<?php
include 'header.php';
include 'conn.php';

if ($_SESSION['username']=="Guest"){

}else{


$cid=$_SESSION['cid'];
$sql="SELECT * FROM customer WHERE cid='$cid'";
$query=mysqli_query($conn, $sql);
if(mysqli_num_rows($query)==1){
    $result=mysqli_fetch_array($query);
    $name=$result['name'];
    $pnum=$result['pnumber'];
    $email=$result['email'];
    $uname=$_SESSION['username'];
    
    $_SESSION['name']=$name;
    $_SESSION['pnum']=$pnum;

}else{
    echo "Error fetching customer data";
}
}
?>

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
        <h1 class="marginleft">My Profile</h1> 
        <h3 class="marginleft">Email: <?=$email?></h3>
        <h3 class="marginleft">Name: <?=$name?></h3>
        <h3 class="marginleft">Username: <?=$uname?></h3>
        <h3 class="marginleft">Phone Number: <?=$pnum?></h3>
        <span class="marginleft">Edit your information</span> <a href="edit.php?id=<?=$cid?>">here</a><br>
        <span class="marginleft">Change your password</span> <a href="edit2.php?id=<?=$cid?>">here</a>
    </body>
    <?php } ?>
</html>
<?php include 'footer.php' ?>