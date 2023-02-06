<?php
$name=(!empty($_POST["name"]))?$_POST["name"]:"";
$description=(!empty($_POST["description"]))?$_POST["description"]:"";
$price=(!empty($_POST["price"]))?$_POST["price"]:"";

if (isset($_POST['submit']) && $_POST['submit'] == 'submit')
{
  if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['fileUpload']['tmp_name'];
    $fileName = $_FILES['fileUpload']['name'];
    $fileSize = $_FILES['fileUpload']['size'];
    $fileType = $_FILES['fileUpload']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
 
    //sanitize file-name (to generate new file name avoiding data redundancy / clashing)
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
 
    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'webp','docx');
 
    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = "../images/";
	  
      //$dest_path = $uploadFileDir . $fileName;
	  $dest_path = $uploadFileDir . $newFileName;
	  
	  
      if(move_uploaded_file($fileTmpPath,$dest_path)) 
      {
		  
        $message ='File is successfully uploaded.';

        //connect to database
		include 'conn.php';

        $sql="INSERT INTO service (name, description, price, picture) 
		VALUES ('$name', '$description', '$price','$dest_path');";

        if(mysqli_query($conn,$sql)){
			echo "<script>alert('massage added successfully!');window.location.href='../admin/addservice.php'</script>";
			
        }else{
            echo "Error:" . $sql . "<br>" . mysqli_error($conn);
			header('refresh:1; url=addservice.php');
        }
        mysqli_close($conn);
		
	}else{
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
	  header('refresh:1; url=addservice.php');
    }
  }
  else
  {
    echo "<script>alert('Please upload an image');window.location.href='../admin/addservice.php'</script>";
  }
  echo  $message;
	}	
	
?>