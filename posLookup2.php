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
                <h2>LOOK UP SKU / BARCODE</h2>
                    <div class="in">
                    <p>[F1] Help</p>
                    <p>[F5] On-hand</p>
                    </div>
            </div>
        </div>

        <div class="grays2">
                    <div class="box">
                        <img src="img/green-triangle-up.png">
                        <p>F11</p>
                    </div>

                    <div class="box">
                        <img src="img/green-triangle-down.png">
                        <p>F12</p>
                    </div>

                    <div class="box" style="background-color: #fff36b;">
                        <p>SKU/</br>
                        BARCODE</br></p>
                        <p> <span class="highlight">F2</span></p>
                    </div>

                        <div class="box">
                            <p>Description</br></p>
                            <p class="highlight">F3</p>
                        </div>
                    

                    
                        <div class="box">
                            <p>Down</br>Payment</p>
                            <p class="highlight">F4</p>
                        </div>
                    

                        <div class="boxLook" style="width: 2100px;">
                        <label>Look for:</label>
                        <form action="" method="get">
                        <input type="text" name="search" id="search">
                        </form>
                        </div>
                   
                </div>

        <table>
        <tr >
            <th style="font-weight: bold; border-right: 1px solid white; font-size:22px;">SKU</th>
            <th style="font-weight: bold; border-right: 1px solid white; font-size:22px;">DESCRIPTION</th>
            <th style="font-weight: bold; border-right: 1px solid white; font-size:22px;">AUTHOR</th>
            <th style="font-weight: bold; border-right: 1px solid white; font-size:22px;">SRP</th>
            <th style="font-weight: bold; border-right: 1px solid white; font-size:22px;">PROMO</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        </tr>
        </tbody>
            
    </table>
   
        <div class="bottom-payment2">
            
            <div class="bottom-buttons">
                <h3>OK</h3>
                <p>&lt;Alt-Enter&gt;</p>
            </div>

            <div class="bottom-buttons">
                <h3>PREV</h3>
                <p>&lt;Left-Arrow&gt;</p>
            </div>

            <div class="bottom-buttons">
                <h3>NEXT</h3>
                <p>&lt;Right-Arrow&gt;</p>
            </div>

            <a href="posMain.php">
            <div class="bottom-buttons">
                <h3>CANCEL</h3>
                <p style="color: black;">&lt;Alt-B&gt;</p>
            </div>
            </a>

            <div class="bottom-page">
            <p>Page: 1/0</p>
            </div>
        </div>

<script src="js/main.js"></script>
</body>
</html>
