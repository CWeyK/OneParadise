<?php
include 'adminheader.php';

$name=$_GET["name"]??"";

//connect to database
include 'conn.php';

$sql = "SELECT * FROM service WHERE name='$name';";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	// output data of each row
  while($row = mysqli_fetch_assoc($result)) {
	 
	$name=$row["name"];
	$description=$row["description"];
	$price=$row["price"];
	$picture=$row["picture"];
	
  }
	
mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<body>
<?php
        if ($_SESSION['name']=="Guest"){
            echo "<p class='marginleft'>Please log in to view this page</p>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        }else{
    ?> 
	<br><br><br><center>
	<h1>EDIT SERVICE</H1>
	<form id="massage" name="massage" action="editservice2.php" method="POST" enctype="multipart/form-data">
		<label for="name">Massage Name</label>
		<input type="text" size="30" id="name" name="name" 
		maxlength="30" readonly value="<?=$name?>"><br><br>
		
		<label for="description">Description</label>
		<input type="text" size="30" id="description" name="description" 
	    value="<?=$description?>"><br><br>
		
		<label for="price">Price</label>
		<input type="text" size="30" id="price" name="price" 
		maxlength="30" value="<?=$price?>"><br><br>
		
		<label for="fileUpload">Select image to upload: </label>
		<input type="file" name="fileUpload" id="fileUpload" value="<?=$picture?>"> <br><br>
		
		<input type="submit" value="submit" id="submit" name="submit">
		
	</form></center>
	<br><br><br><br><br><br><br><br><br><br><br><br>
	
		<?php } ?>
</body>
</html>
		
<?php		
include 'footer.php';
?>
		
		
		
		