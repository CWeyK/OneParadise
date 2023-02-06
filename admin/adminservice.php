<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<h3>List Of Massages</h3>
	<table class="appointment">
	<tr><th class='appointment'>No</th>
	<th class='appointment'>Name</th>
	<th class='appointment'>Description</th>
	<th class='appointment'>Price</th>
	<th class='appointment'>Image directory</th>
	<th class='appointment'>Image</th>
	<th class='appointment'>Edit</th>
	<th class='appointment'>Delete</th></tr>

<?php

//connect to database
include 'conn.php';

$sql = "SELECT * FROM service;";
$result = mysqli_query($conn, $sql);
$i=0;

  // output data of each row
  while($row=mysqli_fetch_assoc($result)) {
	  
	  $name = $row['name'];
	  $description = $row['description'];
	  $price = $row['price'];
	  $picture = $row['picture'];
	  $i++;
	  
	  echo 
	  "<tr>
		  <td class='appointment'>$i</td>
		  <td class='appointment'>$name</td>
		  <td class='appointment'>$description</td>
		  <td class='appointment'>$price</td>
		  <td class='appointment'>$picture</td>
		  <td class='appointment'><img src= '$picture' class='serviceimage'></td>
		  <td class='appointment'><a href='editservice.php?name=".$name."'>edit</a></td>
		  <td class='appointment'><a href='deleteservice.php?name=".$name."'>delete</a></td>
	  </tr>";
  }

  
?>
	</table>
	</body>
</html>

