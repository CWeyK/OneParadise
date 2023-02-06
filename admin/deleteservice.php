<?php
  header('refresh:1; url=addservice.php');
?>

<?php
//from previous lesson
$name=$_GET["name"]??"";

//connect to database
include 'conn.php';

$sql = "SELECT picture FROM service WHERE name = '$name';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$picture = $row["picture"];

$sql = "DELETE FROM service WHERE name = '$name';";
$sqlappointment = "DELETE FROM appointment WHERE service_name='$name'";
$queryappointment=mysqli_query($conn,$sqlappointment);

	if ($result=mysqli_query($conn,$sql)) {
	if(unlink($picture)){
			echo "<script>alert('Massage and image deleted successfully');window.location.href='../admin/addservice.php'</script>";
		} else {
			echo "<script>alert('Massage deleted successfully, image not deleted');window.location.href='../admin/addservice.php'</script>"; 
		}
	}else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

mysqli_close($conn);

?>

