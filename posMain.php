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
<div class="note-info">
    Note:
    </br>
    Scan UPC 1-30 Only </br>
</div>

    <a href="logout.php" class="logout">
        Logout
    </a>

<div class="whole-container">

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

    </div>

    <div class="e">
    <div class="column-3">
            <div class="reds">
                <div class="button">
                <p>Quantity</p>
                <p> <span class="highlight">F3</span></p>
                </div>
                <div class="button" style="background-color: red">
                <p>Payment</p>
                <p> <span class="highlight">F4</span></p>
                </div>
                <div class="button">
                <p>Option</p>
                <p> <span class="highlight">F5</span></p>
                </div>
                <div class="button">
                <p>Non Mdse</p>
                <p> <span class="highlight">F6</span></p>
                </div>
                <div class="button" style="background-color: red">
                <p>Item Void</p>
                <p> <span class="highlight">F7</span></p>
                </div>
                <div class="button" style="background-color: red">
                <p>Trx Void</p>
                <p> <span class="highlight">F8</span></p>
                </div>
                <div class="button" style="background-color: red">
                <p>Suspend</p>
                <p> <span class="highlight">F9</span></p>
                </div>
                <div class="button" style = "width: 120px; height: 50px;">
                <p>Page: 0/1</p>
                </div>
            </div>
        </div>
    </div>

    <div class="outer-container">
        <div class="container">
            <div class="column-1">
                <div class="scan">
                    <div class="scan-element">
                        <label>Scan or Enter UPC</label>
                        <form action="posResult.php" method="get">
                        <input type="text" name="search" id="search">
                        </form>
                    </div>
                </div>

                <div class="grays">
                    <div class="box">
                        <img src="img/green-triangle-up.png">
                        <p>F11</p>
                    </div>

                    <div class="box">
                        <img src="img/green-triangle-down.png">
                        <p>F12</p>
                    </div>

                    <div class="box">
                        <p>CSA</br>
                        ON/OFF</br></p>
                        <p> <span class="highlight">F10</span></p>
                    </div>

                    <div class="box">
                        <p>Lookup</br></p>
                        <p> <span class="highlight">F2</span></p>
                    </div>
                </div>

            </div>  
            
                <div class="column-2">
                    <p> <span style="color: blue;">Subtotal:</span></p>
                    <p> <span class="qty">Quantity:</span></p>
                    <p> <span style="color: green;">Unit Price:</span> 
                    <div class="price">
                            0.00</p> 
                </div>
            </div> 



            <!-- <div class="thelefty">
                asd
            </div> -->          
    </div>



    <table>
        <tr>
            <th>LN</th>
            <th>UPC</th>
            <th>Description</th>
            <th>Qty</th>
            <th>SRP</th>
            <th>Amount</th>
            <th>Type</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        </tr>
        </tbody>
            
    </table>

    <div class="bottom">
        <div class="bottom-1">
            <p>Total Qty</p>
                <div class="bar1">
                    
                </div>

        </div>
        
        <div class="bottom-2">
            <p>Total Sales:</p>
                <div class="bar2">
                        
                </div>
        </div>
        <div class="bottom-3">
        <p><span id="date"></span>  &nbsp;&nbsp;&nbsp; <span id="time"></span></p>
        </div>
    </div>

<script src="js/main.js"></script>
</body>
</html>
