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
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Help</p>
                <p>F1</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: black;">
                <p>Cash</p>
                <p>F2</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Bank Card</p>
                <p>F3</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Check</p>
                <p>F4</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Gift Cert.</p>
                <p>F5</p>
                </div>
                <div class="button-adjust" style="background-color: #fff36b; color: black;">
                <p>Coupon</p>
                <p>F6</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>E-Purse</p>
                <p>F7</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Credit</p>
                <p>Memo</p>
                <p>F8</span></p>
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
            <p><?php echo $totalAmount = $_COOKIE['total_amount'];?></p>
            </div>
                    
            <div class="tendered">   
            

            </div>

        </div>
        <div class="payment-details">
            <p>Coupon Payment Details</p>
        </div>

        <div class="try3">
            <p>Please select type</p>
            <form action="posReceiptFinal.php" method="get">
                 <select name="" id="">
                    <option value="">-SELECT-</option>
                    <option value="">Without Series</option>
                    <option value="">With Series</option>
                    <option value="">Specialty Store GC</option>
                 </select> 
        </div>
    </div>


        <div class="bottomx">
            <div class="bottom-1x">

            </div>
            
        <div class="bottom-2xy">
            
        <button type="submit" name="search" class="btn-ok2">Ok</button>
        <button type="reset" name="search" class="btn-cancel2">Cancel</button>
        <p><span id="time"></span></p>
        </div>  
        </form>
    </div>
   
<script src="js/main.js"></script>
</body>
</html>
