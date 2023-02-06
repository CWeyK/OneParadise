<?php
    session_start();
   
    //connect to database
    include "conn.php";

    $email="";
    $password="";

    //once signin button is clicked
    if (isset($_POST['signin'])){
        $email = (!empty($_POST["email"]))?$_POST["email"]:"";
        $password = (!empty($_POST["password"]))?$_POST["password"]:"";
        //encrypt password
        $epassword=md5($password);
    

        //check for account in database
        $query="select * from customer where '$email'=email AND '$epassword'=password";
        $query_run=mysqli_query($conn, $query);

        //log in part
        if(mysqli_num_rows($query_run)==1){
            //save data for use across sessions
            $cdata=mysqli_fetch_array($query_run);
            $cid=$cdata['cid'];
            $username=$cdata['username'];
            $_SESSION['username']=$username;
            $_SESSION['cid']=$cid;
            //debug part
            //$_SESSION['login']= "Log in successful";
            //redirect to home page
            header('location: home.php');
        }else{
            $_SESSION['login']= "<div class=error>Email or password invalid.</div>";
        }
    }

    //logout
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['cid']);
        header('location: signin.php');

    }
