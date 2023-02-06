<?php
include 'header.php';
include 'conn.php';

?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="home">
        <br>
        <form action="edit.php" autocomplete="off" method="post">
            <!--Display result-->
            <?php
                if(isset($_SESSION['passwordstatus'])){
                    echo $_SESSION['passwordstatus']. "<br>";
                    unset($_SESSION['passwordstatus']);
                }
                if(isset($_SESSION['namestatus'])){
                    echo $_SESSION['namestatus']. "<br>";
                    unset($_SESSION['namestatus']);
                }
                if(isset($_SESSION['unamestatus'])){
                    echo $_SESSION['unamestatus']. "<br>";
                    unset($_SESSION['unamestatus']);
                }
                if(isset($_SESSION['pnumstatus'])){
                    echo $_SESSION['pnumstatus']. "<br>";
                    unset($_SESSION['pnumstatus']);
                }
            ?>

            <label class="marginleft" for="name">Current Name:&nbsp;<?=$_SESSION['name']?></label><br>
            <label class="marginleft" for="name">New Name:</label><br>
            <input class="signin" type="text" name="name" ><br>

            <label class="marginleft" for="name">Current Username:&nbsp;<?=$_SESSION['username']?></label><br>
            <label class="marginleft" for="name">New Username:</label><br>
            <input class="signin" type="text" name="uname" ><br>

            <label class="marginleft" for="name">Current Phone Number:&nbsp;<?=$_SESSION['pnum']?></label><br>
            <label class="marginleft" for="name">New Phone Number:</label><br>
            <input class="signin" type="text" name="pnum" ><br>

            <label class="marginleft" for="password">Please enter your password to confirm changes:</label><br>
            <input class="signin" type="password" name="password" required><br>

            <button class="signin" type="submit" name="submit">Confirm</button>
            
        </form>
        <form method="post">
                <button class="back" type="submit" name="back">Back to profile</button>
        </form>
    </body>
</html>

<?php
//if back button is pressed
if (isset($_POST['back'])){
    header('location: profile.php');
}
//editing part
if (isset($_POST['submit'])){
    $encpassword=md5($_POST['password']);
    $cid=$_SESSION['cid'];
    $sql="SELECT * FROM customer WHERE password='$encpassword' AND cid='$cid'";
    $query=mysqli_query($conn,$sql);
    
    //check if password is correct
    if(mysqli_num_rows($query)==1){
        //changing name
        if (!empty($_POST['name'])){
            $nname=$_POST['name'];
            $sqlname="UPDATE customer SET name='$nname' WHERE cid='$cid'";
            $queryname=mysqli_query($conn,$sqlname);
            $_SESSION['name']=$nname;
        }
        //changing username
        if (!empty($_POST['uname'])){
            $nuname=$_POST['uname'];
            //check for duplicate username
            $check_dup_user="SELECT username FROM customer WHERE username='$nuname'";  
            $dup1=mysqli_query($conn, $check_dup_user);
            $countdup1=mysqli_num_rows($dup1);
            if($countdup1>0){
                $_SESSION['unamestatus']= "<div class=error>Username already taken!</div>";
                header("Location: edit.php");
            }else{
                $sqluname="UPDATE customer SET username='$nuname' WHERE cid='$cid'";
                $queryuname=mysqli_query($conn,$sqluname);
                $_SESSION['username']=$nuname;
            }
        }
        //changing phone number
        if (!empty($_POST['pnum'])){
            $npnum=$_POST['pnum'];
            $sqlnpnum="UPDATE customer SET pnumber='$npnum' WHERE cid='$cid'";
            $querypnum=mysqli_query($conn,$sqlnpnum);
            $_SESSION['pnum']=$npnum;
        }
        
        if($queryuname) {
            $_SESSION['unamestatus']="<div class=success>Username changed succesfully</div>";
            header('Location: edit.php');
        }

        if($queryname) {
            $_SESSION['namestatus']="<div class=success>Name changed succesfully</div>";
            header('Location: edit.php');
        }

        if($querypnum) {
            $_SESSION['pnumstatus']="<div class=success>Phone Number changed succesfully</div>";
            header('Location: edit.php');
        }
    }else{
        $_SESSION['passwordstatus']="<div class=error>Invalid password</div>";
        header('Location: edit.php');
    }
}
 include 'footer.php' 
 ?>