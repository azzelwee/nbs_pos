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
                <h1>Transaction Journal</h1>
            </div>
        </div>

        <div class="reprint-column">

            <div class="left-reprint2">

            <div class="trx-journal">
                <label for="" style="font-weight: bold">Date</label>
                <select name="" id="">
                    <option value="">2024</option>
                </select>

                <select name="" id="">
                    <option value="">Jun</option>
                </select>

                <select name="" id="">
                    <option value="">26</option>
                </select>
            </br>
            </br>
                <button type="submit" name="search" style="width: 80px;">View</button>
                <button type="submit" name="search" style="width: 80px;">Print</button>
                <button type="button" onclick="window.location.href='posNextOption.php'" style="width: 80px;">Cancel</button>

            </div>

            </div>

            <div class="right-reprint">
            <div class="scrollable-container">
                <div class="content">
                    <!-- <?php include 'receipt-text-sample.php'; ?> -->
                 </div>
            </div>
            </div>
        </div>

        
   
        <div class="bottom-payment2">
        
        </div>
        

<script src="js/main.js"></script>
</body>
</html>
