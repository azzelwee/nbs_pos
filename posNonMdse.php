<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();
$sql = "SELECT * FROM product_list";
$product = $con->query($sql) or die ($con->error);
$row = $product->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Point of Sale</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<a href="logout.php" class="logout">
        Logout
    </a>
<div class="whole-container">

    <div class="form-logo">
        <img src="img/nbslogo.png" alt="">
    </div>

    <div class= "gray">
            <div class="gray-text"> 
                <?php
                // Get the current date in mm/dd/yyyy format
                $currentDate = date("mdY");

                if(isset($_SESSION['UserLogin'])){
                    echo "Trx.: " . $currentDate . "" . $_SESSION['Trx'];
                } else {
                    echo "Trx.: " . $currentDate;
                }        
                ?>
            </div>

            <div class="gray-text">
                <?php
                if(isset($_SESSION['UserLogin'])){
                    echo "Clerk: ".$_SESSION['Name'];
                } else {
                    echo "Guest";
                }        
                ?>
            </div>

            <div class="gray-text">
                <?php
                if(isset($_SESSION['UserLogin'])){
                    echo "Str No.: 2999";
                } else {
                    echo "Str No.:";
                }        
                ?>
            </div>

            <div class="gray-text">
                <?php
                if(isset($_SESSION['UserLogin'])){
                    echo "Reg No.: 0001";
                } else {
                    echo "Reg No.:";
                }        
                ?>
            </div>

    
    <div class="gray-text">
                <span id="date"></span>
            </div>
            </div>
    <div class="outer-container">
        <div class="container">
            <div class="column-1xz">
            </div>


        <div class= "main-container1">
            <h2>NON-MERCHANDISE</h2>
            <div class="center-container5">
            <form action="posResultDecoy.php" method="post" id="">
    <div class="nonmerchant">
        </br>
        <p>Select Charge</p>
        <select id="charge" name="charge">
            <option value="SODEXHO VARIANCE">SODEXHO VARIANCE</option>
            <option value="RETURN / EXCHANGE VARIANCE">RETURN / EXCHANGE VARIANCE</option>
            <option value="PASABUY VOUCHER VARIANCE">PASABUY VOUCHER VARIANCE</option>
            <option value="NBSFI DONATION">NBSFI DONATION</option>
            <option value="COUPON VARIANCE">COUPON VARIANCE</option>
            <option value="LNQR PLUS FEE P500">LNQR PLUS FEE P500</option>
            <option value="ILLY SERVICE CHARGE">ILLY SERVICE CHARGE</option>
        </select>

        <p>Enter Price</p>
        <input type="text" name="price" id="price">
    </div>

    <button type="submit" name="login" class="btn-ok5">Ok</button>
    <button type="button" name="cancelButtons" class="btn-cancel5" onclick="window.history.back();">Back</button>

</form>

        </div>
    </div>
   
        <div class="bottom-payment">
            
        </div>

<script src="js/main.js"></script>
</body>
</html>
