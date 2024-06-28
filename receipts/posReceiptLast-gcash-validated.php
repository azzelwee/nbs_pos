<?php

if(!isset($_SESSION)){
    session_start();
}

include_once('../connections/connection.php');

$con = connection();

$sql = "SELECT * FROM product_list";
$product = $con->query($sql) or die ($con->error);
$row = $product->fetch_assoc();



// Check if the session variables are set
if (isset($_SESSION['totalAmount']) && isset($_SESSION['inputAmount']) && isset($_SESSION['remainingAmount'])) {
    $totalAmount = $_SESSION['totalAmount'];
    $inputAmount = $_SESSION['inputAmount'];
    $remainingAmount = $_SESSION['remainingAmount'];
} else {
    // Handle the case where session variables are not set
    $totalAmount = $inputAmount = $remainingAmount = 0;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Point of Sale</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="logout.php" class="logout">
        Logout
    </a>
<div class="whole-container">

    <div class="form-logo">
        <img src="../img/nbslogo.png" alt="">
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

    <div class="e">
    <div class="column-3z">
            <div class="reds">
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Help</p>
                <p>F3</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Cash</p>
                <p>F4</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Bank Card</p>
                <p>F5</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Check</p>
                <p>F6</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Gift Cert.</p>
                <p>F7</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Coupon</p>
                <p>F8</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>E-Purse</p>
                <p>F9</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Credit</p>
                <p>Memo</p>
                <p>F9</span></p>
                </div>
            </div>
        </div>
    </div>
    </div>


    

    <div class="outer-container">
        <div class="container">
            <div class="column-1xz">
        </div>
        </div>

        <div class="agoy">
            <div class="receipt-container">
                <div class="journal">
                    <p>Electric Journal</p>
                </div>
        

            <div class="scrollable-container">
                <div class="content">
                    <?php include '../receipt-text-gcash-validate.php'; ?>
                 </div>
            </div>

        </div>

        <div class="column-1a">
            <div class="compute2"> 
                    <div class="textes">
                    <p>Unit</p>
                    </br>
                    <p>Sales</p>
                    </br>
                    <p>Tendered</p>
                    </br>
                    <p>Change</p>
                    </div>

                    <?php
                // Check if the 'totalQty' cookie is set
                if (isset($_COOKIE['totalQty'])) {
                    $totalQty = $_COOKIE['totalQty'];
                } else {
                    $totalQty = 0; // Default value if the cookie is not set
                }
                
                ?>

            <div class="units">   
            <p><?php echo $totalQty; ?></p>
            </div>

            <div class="sales">
            <p><?php echo number_format($totalAmount, 2);?></p>
            </div>
                    
            <div class="tendered">   
            <p><?php echo number_format($inputAmount, 2);?></p>
            </div>

            <?php
                if (isset($_SESSION['formattedAmount'])) {
                    $storedAmount = $_SESSION['formattedAmount'];
                    // echo htmlspecialchars($storedAmount);

                } else {
                    echo '0.00';
                }

                $validatedChange = $storedAmount + $inputAmount - $totalAmount;
            ?>

            

            <div class="change">   
            <p><?php echo number_format($validatedChange, 2); ?></p>
            </div>

        </div>
        <div class="payment-details">
            
        </div>

        <div class="try2">
            <p>Please Tear-Off the OR and
            </br>
            Close the Cash Register.
            </br>
            Thank you!!
            </p>
        </div>
    </div>


        <div class="bottomx">
            <div class="bottom-1x">

            </div>
            
            <div class="bottom-2xz">
            <form action="../handle_form.php" method="post" >
                <button type="submit" name="search" class="btn-ok2">Ok</button>
                
            </form>
            <p><span id="time"></span></p>
        </div>

       
    </div>


   
<script src="../js/main.js"></script>
</body>
</html>
