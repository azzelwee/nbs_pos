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

    <?php include 'header.php'; ?>

    <div class="outer-container">
        <div class="container">
            <div class="column-1xz">
            </div>


        <div class= "main-container1">
            <h2>Choose Option</h2>
            <div class="center-container">

                <a href="posReceipt.php">
                <p>1. None</p>
                </a>

                <p>2. Laking National Card</p>
                <p>3. LNQR / LNQR PLUS </p>
            </div>

        </div>
   
        <div class="bottom-payment">
            
        </div>

<script src="js/main.js"></script>
</body>
</html>
