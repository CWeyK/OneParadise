<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<h3>List Of Registered Customers</h3>
<table class="appointment">
<tr>
<th class="appointment">Customer ID</th>
<th class="appointment">Name</th>
<th class="appointment">Phone Number</th>
<th class="appointment">Email</th>
<th class="appointment">Username</th>
<th class="appointment">Delete</th>
</tr>
	<?php
	//connect to database
	include 'conn.php';
	
	$sql = "SELECT * from customer ORDER BY cid";
	$result = mysqli_query($conn, $sql);
	$i=0;
		while($row = mysqli_fetch_array($result)) {
			$cid=$row['cid'];
			$name=$row['name'];
			$pnumber=$row['pnumber'];
			$email=$row['email'];
			$username=$row['username'];
			$i++;
			
			echo
			"<tr>
				<td class='appointment'>$cid</td>
				<td class='appointment'>$name</td>
				<td class='appointment'>$pnumber</td>
				<td class='appointment'>$email</td>
				<td class='appointment'>$username</td>
				<td class='appointment'><a href='deletecust.php?cid=".$cid."'>delete</a></td>
			</tr>";
		}	
		mysqli_close($conn);
?>
</table><br><br><br>
</body>
</html>
				
	