<?php
    session_start();
    $name="";
    $pnumber="";
    $email="";
    $username="";
    $password="";
    $cpassword="";

    $errors=array();
    //connect to database
    include "conn.php";

    //once register button is clicked
    if (isset($_POST['register'])){
        $name = (!empty($_POST["name"]))?$_POST["name"]:"";
        $pnumber = (!empty($_POST["pnumber"]))?$_POST["pnumber"]:"";
        $email = (!empty($_POST["email"]))?$_POST["email"]:"";
        $username = (!empty($_POST["username"]))?$_POST["username"]:"";
        $password = (!empty($_POST["password"]))?$_POST["password"]:"";
        $cpassword = (!empty($_POST["cpassword"]))?$_POST["cpassword"]:"";
    
    //check for duplicate username
    $check_dup_user="SELECT username FROM customer WHERE username='$username'";  
    $dup1=mysqli_query($conn, $check_dup_user);
    $countdup1=mysqli_num_rows($dup1);

    //check for duplicate email
    $check_dup_email="SELECT email FROM customer WHERE email='$email'";  
    $dup2=mysqli_query($conn, $check_dup_email);
    $countdup2=mysqli_num_rows($dup2);
    //error if duplicate username
    if($countdup1>0){
        $_SESSION['status']= "<div class=error>Username already taken!</div>";
        header("Location: register.php");
    //error if duplicate email
    }elseif ($countdup2>0){
            $_SESSION['status']= "<div class=error>Email already in use!</div>";
            header("Location: register.php");
        }else{            
            //saving to database
            //validating password
            if ($password ==$cpassword){
                //encrypt password
                $epassword=md5($password);
                //generate random token
                $token = md5(rand());
                $query="INSERT INTO customer 
                (name,pnumber,email,username,password,token)
                VALUES
                ('$name','$pnumber','$email','$username','$epassword','$token')
                ;";

                $query_run=mysqli_query($conn, $query);

                if($query_run)  {
                    $_SESSION['status']= "<div class=success>Register successful!</div>";
                    header("Location: register.php");
                }else{
                    $_SESSION['status']="<div class=error>Register failed!</div>";
                    header("Location: register.php");
                }
            }else{
                $_SESSION['status']="<div class=error>Password mismatch!</div>";
                header("Location: register.php");
            }
        }
    }
    mysqli_close($conn);
?>

