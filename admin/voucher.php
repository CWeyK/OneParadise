<?php
include 'adminheader.php';
include 'conn.php';

if (isset($_POST['generate'])){
    $vcode=$_POST['vcode'];
    $amount=$_POST['amount'];
    //check if code already exists
    $sql="SELECT * FROM voucher WHERE vcode='$vcode'";
    $query=mysqli_query($conn,$sql);
    if(mysqli_num_rows($query)==1){
        $_SESSION['vstatus']="<div class=error>Code already exists!</div>";
    }else{
        //check if amount is number
        if(is_numeric($amount)){
            $sqlvoucher="INSERT INTO voucher 
            (vcode,amount,status)
            VALUES
            ('$vcode',$amount,1)
            ;";
            if(mysqli_query($conn,$sqlvoucher)){
                $_SESSION['vstatus']="<div class=success>Voucher succesfully generated!</div>";
            }else{
                $_SESSION['vstatus']="<div class=error>Something went wrong!</div>";
            }

        }else{
            $_SESSION['vstatus']="<div class=error>Amount must be a number!</div>";
        }
    }

}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <h1 class="marginleft">Generate a voucher</h1>
        <form method="post" autocomplete="off">
            <!--Display notification-->
            <?php
                if(isset($_SESSION['vstatus'])){
                    echo $_SESSION['vstatus'];
                    unset($_SESSION['vstatus']);
                }
            ?>
            <label for="vcode" class="marginleft">Voucher Code:</label><br>
            <input class="signin" type="text" name="vcode" required maxlength="30"><br>
            <label for="amount" class="marginleft">Amount discounted:</label><br>
            <input class="signin" type="text" name="amount" required><br>

            <button class="signin" type="submit" name="generate">Generate</button>
        </form>
        <h1 class="marginleft">List of vouchers:</h1>
        <h3 class="marginleft">Unused Vouchers</h1>
        <!--Display unused vouchers table-->
        <?php
            $sqlretrieve ="select * from voucher where status=1";
            $result = mysqli_query($conn, $sqlretrieve); 
            if (mysqli_num_rows($result) > 0) {
        ?>
        <table class="voucher">
        <tr>
            <th class="voucher">Voucher Code</th>
            <th class="voucher">Amount Discounted</th>
            <th class="voucher">Status</th>
            <th class="voucher">Action</th>
        </tr>
        <?php
            // output data of each row
            while($row=mysqli_fetch_assoc($result)) {   
        ?>
            <!--Display Values-->
            <tr>
                <td class="voucher"><?=$row["vcode"]?></td>
                <td class="voucher"><?=$row["amount"]?></td>
                <td class="voucher"><?=$row["status"]?></td>
                <td class="voucher"><a href="deletevoucher.php?vcode=<?=$row['vcode']?>">Delete Voucher</a></td>
            </tr>
        <?php
            }
        } else {
            echo "<p class='marginleft'>0 results</p>";
        }
        ?>
        </table>
        <!--Display used vouchers-->
        <h3 class="marginleft">Used vouchers</h3>
        <!--Display used vouchers table-->
        <?php
            $sqlretrieve ="select * from voucher where status=0";
            $result = mysqli_query($conn, $sqlretrieve); 
            if (mysqli_num_rows($result) > 0) {
        ?>
        <table class="voucher">
        <tr>
            <th class="voucher">Voucher Code</th>
            <th class="voucher">Amount Discounted</th>
            <th class="voucher">Status</th>
            <th class="voucher">Action</th>
        </tr>
        <?php
            // output data of each row
            while($row=mysqli_fetch_assoc($result)) {   
        ?>
            <!--Display Values-->
            <tr>
                <td class="voucher"><?=$row["vcode"]?></td>
                <td class="voucher"><?=$row["amount"]?></td>
                <td class="voucher"><?=$row["status"]?></td>
                <td class="voucher"><a href="deletevoucher.php?vcode=<?=$row['vcode']?>">Delete Voucher</a></td>
            </tr>
        <?php
            }
        } else {
            echo "<p class='marginleft'>0 results</p>";
        }
?>
        
        </table>
        <br>
    </body>
</html>

<?php


include 'footer.php';

?>