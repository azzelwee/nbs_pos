<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <div class="form-logo">
        <img src="img/nbslogo.png" alt="">
    </div>

    <div class= "gray">
        <div class ="trx-number">
            <?php
            if(isset($_SESSION['UserLogin'])){
                echo "Trx.: ".$_SESSION['Trx'];
            } else {
                echo "Trx: None";
            }        
            ?>
        </div>

        <div class="clerk">
            <?php
            if(isset($_SESSION['UserLogin'])){
                echo "Clerk: ".$_SESSION['Name'];
            } else {
                echo "Guest";
            }        
            ?>
        </div>

        <div class="str">
            <?php
            if(isset($_SESSION['UserLogin'])){
                echo "Str No.: 1000";
            } else {
                echo "Str No.:";
            }        
            ?>
        </div>

        <div class="reg">
            <?php
            if(isset($_SESSION['UserLogin'])){
                echo "Reg No.: 0001";
            } else {
                echo "Reg No.:";
            }        
            ?>
        </div>

    </div>

    <div class= "yellow-index">
            <label>Scan or Enter UPC: </label>
            <input type="scan" name="scan" id="scan">
    </div>
    
    <div class="green">
    </div>

    <!-- <script src="js/main.js"></script> -->

</body>
</html>