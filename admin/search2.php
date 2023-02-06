<?php
include 'adminheader.php';
include 'conn.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<center><table class = "appointment">
		<tr>
			<th class = "appointment">Customer ID</th>
			<th class = "appointment">Name</th>
			<th class = "appointment">Phone Number</th>
            <th class = "appointment">Email</th>
            <th class = "appointment">Username</th>
        </tr>

<?php
	
if(isset($_POST["submit"])){
	$search = mysqli_real_escape_string($conn, $_POST['search']);
	$sql = "SELECT * FROM customer WHERE 
			cid LIKE '%$search%' OR 
			name LIKE '%$search%' OR 
			pnumber LIKE '%$search%' OR
			email LIKE '%$search%' OR
            username LIKE '%$search%'";
	$result = mysqli_query($conn, $sql);
	$qresult = mysqli_num_rows($result);
	
	echo "<br>There are a total of ".$qresult . " result<br><br>";
	
	if($qresult > 0) {
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr><td class = 'appointment'>".$row['cid']."</td>
				<td class = 'appointment'>".$row['name']."</td>
				<td class = 'appointment'>".$row["pnumber"]."</td>
				<td class = 'appointment'>".$row['email']."</td>
                <td class = 'appointment'>".$row['username']."</td>
                </tr>";
		}
	}else {
		echo "There is no result";
	}
}
	
?>

</table>
</center><br><br><br><br><br><br><br>
</html>
<?php include 'footer.php';?>
