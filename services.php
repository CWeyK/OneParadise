<?php
    
    //connect to database
    include 'conn.php';
	
	if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
	
	//write query 
	$sql = "SELECT * FROM service;";	
	
	//get result 
	$result = mysqli_query($conn, $sql);
	
	//fetch the result 
	$service = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	//free the result from memory
	mysqli_free_result($result);
	
	//close connection
	mysqli_close($conn);
	
	
?>
	
<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php include 'header.php'?>
</head>
<style>

.table{
background-color: black;
color: white;
}

/* Position of preview image thumbnails */
.column{
float: left;
width: 150px;
height: 150px;
padding: 5px;
}

/* Position and size of main preview image */
.col{
float: left;
width: 480px;
padding:12px;
padding-bottom:40px;
}

/*Main preview image style*/
figure{
max-width: 400px;
margin: 0 auto 20px;
}

figure img{
display: block;
max-width: 100%;
min-width: 100%;
}

.rows{
height:600px;
}

input[type=button]{
background-color: green;
color: white;
font-family: roboto;
font-size: 16px;
padding: 15px 32px;
width: 15%;
display: inline-block;
text-align: center;
text-decoration: none;
border: none;
opacity: 0.8;
}

input[type=button]:hover {opacity:1}

.borderline{
	height:2px;
	width:90%;
	background-color:#001f54;
	margin:auto;
}


</style>

<body class="home">
<?php foreach($service as $serv){ ?>
<!--Main image of preview shown-->
	<div class="col">
		<figure>
			<img src="<?php echo 'images/'.$serv['picture'];?>" style = "width: 100px; height: 300px;">
		</figure>
	</div>	
	
	<br><h2 style = "font-family: roboto;"><?php echo htmlspecialchars($serv['name']); ?></h2>
	<p style = "font-family: roboto;"><?php echo htmlspecialchars($serv['description']); ?></p>
	<br><br><p style="font-family: roboto;">Price: RM<?php echo htmlspecialchars($serv['price']); ?></p>
	<br><input type="button" name="buy" onclick= "location.href='book.php'; "value="Book Now"></input><br><br><br>
<br><br><br><div class="borderline"></div><br><br>
		
<?php } ?>