
<?php include 'adminheader.php';?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head>
	<title>Customer List</title> 
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
			<?php include 'searchform2.php' ?>
			<?php include 'showcustlist.php';?>
		</center>
		<?php } ?>
		<br><br><br><br><br><br><br><br>
	<footer>
		<?php include 'footer.php';?>
	</footer>
</body>
</html>
	