<?php
	include 'conn.php';
?>
<br>
<form action="search.php" method="POST">
<input type="text" name="search" placeholder="Search">
<button type="submit" name="submit">Search</button>
</form>

<?php
	$sql = "SELECT * FROM appointment";
	$result = mysqli_query($conn, $sql);
	$qresult = mysqli_num_rows($result);
	
		?>
</body>
<html>