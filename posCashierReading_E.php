<?php
// PHP code to handle quantity input
if (!isset($_SESSION)) {
    session_start();
}

include_once("connections/connection.php");
$con = connection();

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
                <h1></h1>
            </div>
        </div>

        <div class="reprint-column">

            <div class="left-reprint2">

            <div class="cashier-journal">
                
            <button type="submit" name="search">Print <br> <span style="color: blue; font-size: 15px;">Enter</span></button>

                <button type="submit" name="search" style="background-color: red; color: white">Help
                </br><span style="color: blue; font-size: 15px;">F1</button>
                <button type="button" id="altB" onclick="window.location.href='posNextOption.php'">Back </br><span style="color: blue; font-size: 15px;"> Alt+B</button>

            </div>

            </div>

            <div class="right-reprint">
            <div class="scrollable-container">
                <div class="content">
                    <?php include 'receipt-text-sample.php'; ?>
                 </div>
            </div>
            </div>
        </div>

        
   
        <div class="bottom-payment2">
        
        </div>

        <script>
                 document.addEventListener('keydown', function(event) {
            if (event.altKey && event.keyCode === 66) { // Alt + B
                event.preventDefault();
                document.getElementById('altB').click();
            }
        });
        </script>
        

<script src="js/main.js"></script>
</body>
</html>
