<?php
    $cid="";
    $sname="";
    $date="";
    //get today's date
    $today=new DateTime();
    //connect to database
    include "conn.php";

    //once first button is clicked
    if (isset($_POST['book'])){
        $cid = (!empty($_POST["cid"]))?$_POST["cid"]:"";
        $sname = (!empty($_POST["service"]))?$_POST["service"]:"";
        $date = (!empty($_POST["date"]))?$_POST["date"]:"";
        //convert string to date
        $sdate=DateTime::createFromFormat("Y-m-d H:i:s","$date 00:00:00");
        //comparing dates
        if($sdate>$today){
            //If date is in the future
            $_SESSION['sname']=$sname;
            $_SESSION['cid']=$cid;
            $_SESSION['date']=$date;
            //check the date for available time slots
            $time1query="select * from appointment where '8AM-10AM'= time AND '$date'=date";
            $time2query="select * from appointment where '10AM-12PM'= time AND '$date'=date";
            $time3query="select * from appointment where '12PM-2PM'= time AND '$date'=date";
            $time4query="select * from appointment where '2PM-4PM'= time AND '$date'=date";
            $time5query="select * from appointment where '4PM-6PM'= time AND '$date'=date";
            $time1run=mysqli_query($conn, $time1query);
            $time2run=mysqli_query($conn, $time2query);
            $time3run=mysqli_query($conn, $time3query);
            $time4run=mysqli_query($conn, $time4query);
            $time5run=mysqli_query($conn, $time5query);
            if(mysqli_num_rows($time1run)==1){
                $_SESSION['time1']='r';
            }else{
                $_SESSION['time1']='g';
            }
            if(mysqli_num_rows($time2run)==1){
                $_SESSION['time2']='r';
            }else{
                $_SESSION['time2']='g';
            }
            if(mysqli_num_rows($time3run)==1){
                $_SESSION['time3']='r';
            }else{
                $_SESSION['time3']='g';
            }
            if(mysqli_num_rows($time4run)==1){
                $_SESSION['time4']='r';
            }else{
                $_SESSION['time4']='g';
            }
            if(mysqli_num_rows($time5run)==1){
                $_SESSION['time5']='r';
            }else{
                $_SESSION['time5']='g';
            }
            //if all slots booked
            if($_SESSION['time1']=='r' && $_SESSION['time2']=='r'&& $_SESSION['time3']=='r'&& $_SESSION['time4']=='r'&& $_SESSION['time5']=='r'){
                $_SESSION['book']="<div class=error>All slots booked on selected date</div>";
            }else{
                header('Location: book2.php');
            }
        }else{
            //Error because date is in the past
            $_SESSION['book']="<div class=error>Invalid date</div>";
        }
        

    }

    //Once second button is clicked
    if (isset($_POST['book2'])){
        $time = (!empty($_POST["time"]))?$_POST["time"]:"";
        $cid=$_SESSION['cid'];
        $date=$_SESSION['date'];
        $sname=$_SESSION['sname'];
        
        //obtain price of services
        $pricesql="SELECT price FROM service where name='$sname'";
        $pricerun=mysqli_query($conn,$pricesql);
        $result=mysqli_fetch_array($pricerun);
        $price=$result['price'];
        $vcode=$_POST['vcode'];
        if(empty($vcode)){
            $query="INSERT INTO appointment 
                (cid,service_name,date,time,price)
                VALUES
                ('$cid','$sname','$date','$time',$price)
                ;";

                $query_run=mysqli_query($conn, $query);

                if($query_run){
                    $_SESSION['book']="<div class=success>Booking successful</div><p>&nbsp; &nbsp; &nbsp;Click <a href='appointments.php'>here</a> to view your appointments</p>";
                }else{
                    $_SESSION['book']="<div class=error>Booking failed</div>";
                }
            
            //check the date for available time slots
            $time1query="select * from appointment where '8AM-10AM'= time AND '$date'=date";
            $time2query="select * from appointment where '10AM-12PM'= time AND '$date'=date";
            $time3query="select * from appointment where '12PM-2PM'= time AND '$date'=date";
            $time4query="select * from appointment where '2PM-4PM'= time AND '$date'=date";
            $time5query="select * from appointment where '4PM-6PM'= time AND '$date'=date";
            $time1run=mysqli_query($conn, $time1query);
            $time2run=mysqli_query($conn, $time2query);
            $time3run=mysqli_query($conn, $time3query);
            $time4run=mysqli_query($conn, $time4query);
            $time5run=mysqli_query($conn, $time5query);
            if(mysqli_num_rows($time1run)==1){
                $_SESSION['time1']='r';
            }else{
                $_SESSION['time1']='g';
            }
            if(mysqli_num_rows($time2run)==1){
                $_SESSION['time2']='r';
            }else{
                $_SESSION['time2']='g';
            }
            if(mysqli_num_rows($time3run)==1){
                $_SESSION['time3']='r';
            }else{
                $_SESSION['time3']='g';
            }
            if(mysqli_num_rows($time4run)==1){
                $_SESSION['time4']='r';
            }else{
                $_SESSION['time4']='g';
            }
            if(mysqli_num_rows($time5run)==1){
                $_SESSION['time5']='r';
            }else{
                $_SESSION['time5']='g';
            }
        }else{
            //apply discount
            //check if code is valid
            $vouchersql="SELECT * from voucher WHERE vcode='$vcode'";
            $voucherrun=mysqli_query($conn,$vouchersql);
            if(mysqli_num_rows($voucherrun)==1){
                //check if code is used
                $usedsql="SELECT status,amount FROM voucher WHERE vcode='$vcode'";
                $usedrun=mysqli_query($conn,$usedsql);
                $usedresult=mysqli_fetch_array($usedrun);
                $used=$usedresult['status'];
                $amount=$usedresult['amount'];
                if($used==1){
                    $fprice=$price-$amount;

                    $query="INSERT INTO appointment 
                    (cid,service_name,date,time,price)
                    VALUES
                    ('$cid','$sname','$date','$time',$fprice)
                    ;";
                    $query_run=mysqli_query($conn, $query);

                    //update voucher used status
                    $updatesql="UPDATE voucher SET status=0 WHERE vcode='$vcode'";
                    $updaterun=mysqli_query($conn,$updatesql);


                    //check the date for available time slots
                    $time1query="select * from appointment where '8AM-10AM'= time AND '$date'=date";
                    $time2query="select * from appointment where '10AM-12PM'= time AND '$date'=date";
                    $time3query="select * from appointment where '12PM-2PM'= time AND '$date'=date";
                    $time4query="select * from appointment where '2PM-4PM'= time AND '$date'=date";
                    $time5query="select * from appointment where '4PM-6PM'= time AND '$date'=date";
                    $time1run=mysqli_query($conn, $time1query);
                    $time2run=mysqli_query($conn, $time2query);
                    $time3run=mysqli_query($conn, $time3query);
                    $time4run=mysqli_query($conn, $time4query);
                    $time5run=mysqli_query($conn, $time5query);
                    if(mysqli_num_rows($time1run)==1){
                        $_SESSION['time1']='r';
                    }else{
                        $_SESSION['time1']='g';
                    }
                    if(mysqli_num_rows($time2run)==1){
                        $_SESSION['time2']='r';
                    }else{
                        $_SESSION['time2']='g';
                    }
                    if(mysqli_num_rows($time3run)==1){
                        $_SESSION['time3']='r';
                    }else{
                        $_SESSION['time3']='g';
                    }
                    if(mysqli_num_rows($time4run)==1){
                        $_SESSION['time4']='r';
                    }else{
                        $_SESSION['time4']='g';
                    }
                    if(mysqli_num_rows($time5run)==1){
                        $_SESSION['time5']='r';
                    }else{
                        $_SESSION['time5']='g';
                    }


                    if($query_run){
                        $_SESSION['book']="<div class=success>Booking successful.<br>Voucher succesfully appied.</div><p>&nbsp; &nbsp; &nbsp;Click <a href='appointments.php'>here</a> to view your appointments</p>";
                    }else{
                        $_SESSION['book']="<div class=error>Booking failed</div>";
                    }
                }else{
                    $_SESSION['book']="<div class=error>Code already used!</div>";
                }

            }else{
                $_SESSION['book']="<div class=error>Code invalid!</div>";
            }
        }
    }

?>
