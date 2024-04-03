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
            <div class ="trx">
                <?php
                if(isset($_SESSION['UserLogin'])){
                    echo "Trx.: ".$_SESSION['Trx'];
                } else {
                    echo "Trx.:";
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
    <div class="main-cont">
        <div class="input-container">
            <div class="input-container-left">
                <div class= "yellow-index">
                    <label>Scan or Enter UPC: </label>
                    <input type="scan" name="scan" id="scan">
                </div>

                <div class="button-container">
                    <div class="button1">
                        F11
                    </div>
                    <div class="button2">
                        F12
                    </div>
                    <div class="button3">
                        CSA</br>
                        ON/OFF</br>
                        F10
                    </div>
                    <div class="button4">
                        Lookup</br>
                        F2</h2>
                    </div>
                </div>
            </div>
            

            <div class="input-container-right">
                <div class="black-index">
                    <div class="subtotal">
                        <p>Subtotal: </p>
                    </div>

                    <div class="quantity">
                        <p>Quantity: </p>
                    </div>

                    <div class="unit-price">
                        <p>Unit Price: </p>
                    </div>
                </div>
                
            </div>
            
        
            <div class="input-container-rightmost">
                <div class="gray-index">
                    <div class="container1">
                    test
                    </div>
                    <div class="container2">
                    test
                    </div>
                    <div class="container3">
                    test
                    </div>
                    <div class="container4">
                    test
                    </div>
                    <div class="container5">
                    test
                    </div>
                    <div class="container6">
                    test
                    </div>
                    <div class="container7">
                    test
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    
    </div>


    <!-- <div class="green">
    </div> -->

    <!-- <script src="js/main.js"></script> -->

</body>
</html>