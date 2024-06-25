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
            <h2>PRICE CHANGE</h2>
            <div class="center-container4">
        
            <p><?php 
            if (!empty($_SESSION['search_results'])) {
                // Reverse the array
                $reversed_results = array_reverse($_SESSION['search_results']);
                
                // Check if there are any results after reversing
                if (!empty($reversed_results)) {
                    // Display the first item
                    $row = $reversed_results[0];
                    echo '<p>' . htmlspecialchars($row['item']) . '</p>';
                    
                }
            }
            
            ?></p>


            <div class="price-changer">
                <div class="price-change">
                    <label>Current Price</label>
                    <input type="text" name="current_price" id="current-price" 
                    value="<?php echo htmlspecialchars($row['srp']);?> " readonly>
                </div>

                <div class="price-change">
                    <label>Enter Price</label>
                    <input type="text" name="new_price" id="new-price">
                </div>
            </div>

            <div class="change-reason">
                <label for="">Select a Reason</label>
                <select name="" id="">
                    <option value="">Wrong Author</option>
                    <option value="">Wrong Size</option>
                    <option value="">Exchange</option>
                    <option value="">Wrong Product</option>
                    <option value="">Changed Mind</option>
                    <option value="">Double Purchase</option>
                    <option value="">Wrong Color</option>
                    <option value="">Wrong Edition</option>
                    <option value="">Wrong Title</option>
                    <option value="">Wrong Price</option>
                    <option value="">Promo</option>
                </select>
            </div>
      
                <button type="submit" name="login" class="btn-ok5" onclick="window.location.href = 'posResultDecoy.php';">Yes</button>
                <button type="button" name="cancelButtons" class="btn-cancel5" onclick="window.location.href = 'posResultDecoy.php';">No</button>
       
            </div>
    </div>
   
        <div class="bottom-payment">
            
        </div>

        

<script src="js/main.js"></script>
</body>
</html>
