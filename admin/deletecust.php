<?php
  header('refresh:1; url=addservice.php');
?>
<?php 
$cid=$_GET["cid"]??"";
//connect to database
include 'conn.php';

$sql = "DELETE FROM customer WHERE cid = '$cid';";
$sqlappointment= "DELETE FROM appointment WHERE cid='$cid';";
$queryappointment=mysqli_query($conn,$sqlappointment);

	if (mysqli_query($conn,$sql)) {
		echo "<script>alert('Customer deleted successfully');window.location.href='../admin/custlist.php'</script>";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
	mysqli_close($conn);

?>