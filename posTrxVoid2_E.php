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
            <h2>TRANSACTION VOID</h2>
            <div class="center-container3">
            
            <p style="margin-top: 65px;">Are you sure you want to void
            </br>this transaction?
            </p>

            <p style="color: red; font-size: 15px;margin:0;">Please press Y to continue, otherwise Press N.</p>

            <div class="thebuttons">
                <form action="handle_form.php" method="post">
                    <button type="submit" name="" class="btn-ok10" id="y">Yes</button> 
                </form>
            
                    <button type="button" id="n" name="cancelButtons" class="btn-cancel5" onclick="window.location.href = 'posResultDecoy.php';">No</button>
                    </div>
            </div>
    </div>
   
        <div class="bottom-payment">
            
        </div>
        <script>
        document.addEventListener("keydown", (event) => {
            switch(event.keyCode) {
                case 89: // Letter Y key
                event.preventDefault();
                document.getElementById('y').click();
                break;
            case 78: // Letter N key
                event.preventDefault();
                document.getElementById('n').click();
                break;
                }
        });
        </script>

<script src="js/main.js"></script>
</body>
</html>
