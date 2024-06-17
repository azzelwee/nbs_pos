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
            <h2>Choose Option</h2>
            <div class="center-container">

                <a href="posReceipt.php" id="1">
                <p>1. None</p>
                </a>

                <a href="posLakingNational.php" id="2">
                <p>2. Laking National Card</p>
                </a>

                <a href="posLNQR.php" id="3">
                <p>3. LNQR / LNQR PLUS </p>
                </a>
            </div>

        </div>
   
        <div class="bottom-payment">
            
        </div>

        <script>
        document.addEventListener("keydown", (event) => {
            switch(event.keyCode) {
                case 49: // Number 2 key
                    event.preventDefault();
                    document.getElementById('1').click();
                    break;
                case 50: // Number 3 key
                    event.preventDefault();
                    document.getElementById('2').click();
                    break;
                case 51: // Enter key
                    event.preventDefault();
                    document.getElementById('3').click();
                    break;
                }
    });
    </script>

<script src="js/main.js"></script>
</body>
</html>
