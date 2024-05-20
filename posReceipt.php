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

    <div class="e">
    <div class="column-3z">
            <div class="reds">
                <div class="button-adjust">
                <p>Help</p>
                <p>F3</p>
                </div>
                <div class="button-adjust" style="background-color: yellow">
                <p>Cash</p>
                <p>F4</p>
                </div>
                <div class="button-adjust">
                <p>Bank Card</p>
                <p>F5</p>
                </div>
                <div class="button-adjust" style="background-color: red">
                <p>Check</p>
                <p>F6</p>
                </div>
                <div class="button-adjust">
                <p>Gift Cert.</p>
                <p>F7</p>
                </div>
                <div class="button-adjust">
                <p>Coupon</p>
                <p>F8</p>
                </div>
                <div class="button-adjust" style="background-color: red">
                <p>E-Purse</p>
                <p>F9</p>
                </div>
                <div class="button-adjust">
                <p>Credit</p>
                <p>Memo</p>
                <p>F9</span></p>
                </div>
            </div>
        </div>
    </div>
    </div>


    

    <div class="outer-container">
        <div class="container">
            <div class="column-1xz">
        </div>
        </div>

        <div class="agoy">
            <div class="receipt-container">
                <div class="journal">
                    <p>Electric Journal</p>
                </div>
        

            <div class="scrollable-container">
                <div class="content">
                    <?php include 'receipt-text.php'; ?>
                 </div>
            </div>

        </div>

        <div class="column-1a">
            <div class="compute"> 
                    <div class="textes">
                    <p>Unit</p>
                    </br>
                    <p>Sales</p>
                    </br>
                    <p>Tendered</p>
                    </div>
            <div class="units">   
            </div>

            <div class="sales">
            </div>
                    
            <div class="tendered">   
            </div>

        </div>
        <div class="payment-details">
            <p>Cash Payment Details</p>
        </div>

        <div class="try">
            <p>Enter Amount:</p>
        <input type="text" name="search" id="search" placeholder="0.00">
        </div>
    </div>


        <div class="bottomx">
            <div class="bottom-1x">

            </div>
            
        <div class="bottom-2x">
            <p>Total Sales:</p>

        </div>
       
    </div>
   
<script src="js/main.js"></script>
</body>
</html>
