<?php
    session_start();
   
    //connect to database
	include 'conn.php';

    $sid="";
    $password="";

    //once signin button is clicked
    if (isset($_POST['signin'])){
        $sid = (!empty($_POST["sid"]))?$_POST["sid"]:"";
        $password = (!empty($_POST["password"]))?$_POST["password"]:"";

    

        //check for account in database
        $query="select * from staff where '$sid'=sid AND '$password'=password";
        $query_run=mysqli_query($conn, $query);

        //log in part
        if(mysqli_num_rows($query_run)==1){
            //save data for use across sessions
            $sdata=mysqli_fetch_array($query_run);
            $sid=$sdata['sid'];
            $name=$sdata['name'];
            $_SESSION['name']=$name;
            $_SESSION['sid']=$sid;
            //debug part
            //$_SESSION['login']= "Log in successful";
            //redirect to home page
            header('location: adminhome.php');
        }else{
            $_SESSION['login']= "<div class=error>Staff id or password invalid.</div>";
        }
    }

    //logout
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['name']);
        unset($_SESSION['sid']);
        header('location: staffsignin.php');

    }