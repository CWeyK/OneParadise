<?php
session_start();
include "conn.php";
//phpmailer to send email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

//creating password mailing function
function sendreset($name,$demail,$token){
    
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                         //Send using SMTP
    $mail->SMTPAuth   = true;    
    
    
    $mail->Host       = 'smtp.gmail.com';                    //Set the SMTP server to send through                               //Enable SMTP authentication
    $mail->Username   = '[gmail here]';              //SMTP username
    $mail->Password   = '[password here]';                  //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;;     //Enable implicit TLS encryption
    $mail->Port       = 587;                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('[gmail here]', $name);
    $mail->addAddress($demail);                             //Add a recipient  
    
    $mail->isHTML(true);                                    //Set email format to HTML
    $mail->Subject = 'Password reset link';

    //Email format;
    $email_template= "<h2>Hello</h2>
    <h3>This is the password reset link for your account.</h3>
    <br>
    <a href='http://localhost/WebDev/resetlink.php?token=$token&email=$demail'>Click here to be redirected</a>";

    
    $mail->Body    = $email_template;

    $mail->send();

}



//once reset button is clicked
if(isset($_POST['resetlink'])){
    $email = (!empty($_POST["email"]))?$_POST["email"]:"";
    //generate random token
    $token = md5(rand());
    //look for email in database
    $checkemail="SELECT * FROM customer WHERE email='$email'";
    $query=mysqli_query($conn, $checkemail);

    //if email found in database
    if(mysqli_num_rows($query)>0){
        $cdata = mysqli_fetch_array($query);
        $name=$cdata['name'];
        $demail=$cdata['email'];

        $updatetoken="UPDATE customer SET token='$token' WHERE email='$demail'";
        $tokenquery=mysqli_query($conn, $updatetoken);
        //if reset token succesful
        if($tokenquery){
            //sending email
            sendreset($name,$demail,$token);
            $_SESSION['resetstatus']="<div class=success>Password reset link sent</div>";
            header('Location: forget.php');
        }else{
            $_SESSION['resetstatus']="<div class=error>Something went wrong</div>";
            header('Location: forget.php');
        }

    }else{
        //no email found in database
            $_SESSION['resetstatus']="<div class=error>Email not found</div>";
            header('Location: forget.php');
    }
}
//changing password section
//once change password button is clicked
if(isset($_POST['change'])){
    $email = (!empty($_POST["email"]))?$_POST["email"]:"";
    $npassword = (!empty($_POST["npassword"]))?$_POST["npassword"]:"";
    $cpassword = (!empty($_POST["cpassword"]))?$_POST["cpassword"]:"";

    $token = (!empty($_POST["token"]))?$_POST["token"]:"";

    //check token
    if(!empty($token)){
        $checktoken="SELECT token FROM customer WHERE token='$token' ";
        $tokenquery=mysqli_query($conn, $checktoken);
        if(mysqli_num_rows($tokenquery)>0){
            //password validation
            if($npassword == $cpassword){
                //encrypt password before sending 
                $epassword=md5($npassword);
                $updatepassword="UPDATE customer SET password='$epassword' WHERE token='$token'";
                $updatequery=mysqli_query($conn, $updatepassword);

                //if success
                if($updatequery){
                    $_SESSION['changestatus']="<div class=success>Password changed</div>";
                    header("Location: resetlink.php");
                    //change token
                    $newtoken=md5(rand());
                    $updatetoken="UPDATE customer SET token='$newtoken' WHERE token='$token'";
                    $tokenquery=mysqli_query($conn, $updatetoken);
                }else{
                    $_SESSION['changestatus']="<div class=error>Password could not update</div>";
                    header("Location: resetlink.php?token=$token&email=$email");
                }
            }else{
                $_SESSION['changestatus']="<div class=error>Password does not match</div>";
                header("Location: resetlink.php?token=$token&email=$email");
            }
        }else{
            $_SESSION['changestatus']="<div class=error>Invalid token</div>";
            header("Location: resetlink.php?token=$token&email=$email");
        }

    }else{
        $_SESSION['changestatus']="<div class=error>No token available</div>";
        header('Location: resetlink.php');
    }
}
?>