<?php if(empty($_POST['submit'])){?>
<html>
<body> 
<head>
</head>
<form action="uploadfile.php" method="POST" enctype="multipart/form-data">
		<center><br>
		<label>Massage Name:</label>
		<input type="text" name="name" placeholder="Standard Massage"><br><br>
		<label>Description:</label>
		<input type="text" name="description"><br><br>
		<label>Price:</label>
		<input type="text" name="price"><br><br>
		Select image to upload: 
		<input type="file" name="fileUpload" id="fileUpload"> <br><br> 
		<input type="submit" name="submit" value="submit"><br><br>
		</center>
</form>
</body>
</html>
<?php }else{
	
	$name=$_POST['name'];
	$description=$_POST['description'];
	$price=$_POST['price'];
	$picture=$_POST['picture'];
	
	//connect to database
	include 'conn.php';
	
	$query="INSERT INTO service (name, description, price, picture) VALUES ('$name', '$description', '$price', '$picture')";

	$add=mysqli_query($conn,$query);
	if($add){
		echo "<br><center>Massage Successfully Added!</center><br><br>";
		header('refresh:1; url=addservice.php');
	}else{
		echo "<center><br>Massage Failed To Add Please Try Again.<br><br></center>";
		header('refresh:1; url=addservice.php');
	}
	
}

?>