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
            <h2>ITEM VOID</h2>
            <div class="center-container3">
            </br></br></br></br>

            <form action="posResultDecoyItemVoid.php" method="post">
            <label for="" style="font-weight: bold; ">Select a Reason</label>
            <select name="" id="" style="width: 200px;">
                <option value="" style="text-align: center;">Wrong Author</option>
                <option value="" style="text-align: center;">Wrong Size</option>
                <option value="" style="text-align: center;">Exchange</option>
                <option value="" style="text-align: center;">Wrong Product</option>
                <option value="" style="text-align: center;">Changed Mind</option>
                <option value="" style="text-align: center;">Double Purchase</option>
                <option value="" style="text-align: center;">Wrong Color</option>
                <option value="" style="text-align: center;">Wrong Edition</option>
                <option value="" style="text-align: center;">Wrong Title</option>
                <option value="" style="text-align: center;">Wrong Price</option>
            </select>

            <p style="color: red; font-size: 15px; margin: 0; margin-top: 38px;">Please press Alt+Enter to continue, otherwise</br>
                ESC.</p>

            <div class="thebuttons">
                
                    <button type="submit" name="" class="btn-ok10" id="altEnter">Yes</button> 
                </form>
            
                    <button type="button" name="cancelButtons" class="btn-cancel5" onclick="window.location.href = 'posResultDecoy.php';" id="escButton">No</button>
                    </div>
            </div>
    </div>
   
        <div class="bottom-payment">
            
        </div> 

        <script>
    document.addEventListener('keydown', function(event) {
        if (event.altKey && event.keyCode === 13) { // Alt + Enter
            event.preventDefault();
            document.getElementById('altEnter').click();
        } else if (event.keyCode === 27) { // Escape key
            event.preventDefault();
            document.getElementById('escButton').click(); // Replace 'escButton' with your actual element ID
        }
    });
</script>


<script src="js/main.js"></script>
</body>
</html>
