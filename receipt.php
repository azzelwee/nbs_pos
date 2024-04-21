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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <div class="form-logo">
        <img src="img/nbslogo.png" alt="">
    </div>

    <div class= "gray">
            <div class ="gray-text">
                <?php
                if(isset($_SESSION['UserLogin'])){
                    echo "Trx.: ".$_SESSION['Trx'];
                } else {
                    echo "Trx.:";
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
                    echo "Str No.: 1000";
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

    </div><div class="column-3">
            <div class="reds">
                <div class="button">
                    <p>Help</p>
                    <p><span style="color: darkgray;">F3</span></p>
                    </div>
                    <div class="button">
                    <p>Payment</p>
                    <p><span style="color: darkgray;">F2</span></p>
                    </div>
                    <div class="button">
                    <p>Bank Card</p>
                    <p><span style="color: darkgray;">F3</span></p>
                    </div>
                    <div class="button">
                    <p>Check</p>
                    <p><span style="color: darkgray;">F4</span></p>
                    </div>
                    <div class="button">
                    <p>Gift Cert.</p>
                    <p><span style="color: darkgray;">F5</span></p>
                    </div>
                    <div class="button">
                    <p>Coupon</p>
                    <p><span style="color: darkgray;">F6</span></p>
                    </div>
                    <div class="button">
                    <p>E-Purse</p>
                    <p><span style="color: darkgray;">F7</span></p>
                    </div>
                    <div class="button">
                    <p>Credit Memo</p>
                    <p><span style="color: darkgray;">F8</span></p>
                    </div>
                </div>
            </div>
        </div>

    <div class="outer-container1">
        <div class="column-1x">
            <!-- this is the yellow part -->
        </div>

        <div class="agoy">
            <div class="receipt-container">
                <div class="journal">
                    <p>Electric Journal</p>
                </div>
                <div class="scrollable-container">
                    <div class="content">
                    <?php include 'receipt-text.php'; ?>
                    </div>
                </div>
            </div>

            <div class="column-1a">
                <div class="compute"> 
                        <div class="textes">
                        <p>Unit</p>
                        </br>
                        <p>Sales</p>
                        </br>
                        <p>Tendered</p>
                        </div>
                    <div class="units">
                        
                    </div>
                    <div class="sales">
                        
                    </div>
                    <div class="tendered">
                        
                    </div>
                </div>

                <div class="payment-details">
                    <p>Cash Payment Details</p>
                </div>

                <div class="amount">
                    <div class="amount-element">
                        <label>Enter Amount</label>
                        <form action="" method="get">
                        <input type="text" name="search" id="search">
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    

    <div class="green">

    </div>

    <script src="js/main.js"></script>

</body>
</html>