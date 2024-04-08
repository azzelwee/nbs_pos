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
    <title>Access</title>
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
    </div>

<div class="outer-container">
    <div class="container">
        <div class="column-1">
            <div class="scan">
                <div class="scan-element">
                    <label>Scan or Enter UPC</label>
                    <form action="result.php" method="get">
                    <input type="text" name="search" id="search">
                    <button type="submit">Search</button>
                    </form>
                </div>
            </div>
            <div class="grays">
                <div class="box">
                    <p>F11</p>
                </div>
                <div class="box">
                    <p>F12</p>
                </div>
                <div class="box">
                    <p>CSA</br>
                    ON/OFF</br>
                    F10</p>
                </div>
                <div class="box">
                    <p>Lookup</br>
                    F2</p>
                </div>
            </div>
        </div>   

        <div class="column-2">
            <p>Subtotal: </p>
            <p>Quantity: </p>
            <p>Unit Price: </p>
        </div>
    </div>

        
        <div class="column-3">
            <div class="reds">
                <div class="button">
                <p>test</p>
                </div>
                <div class="button">
                <p>test</p>
                </div>
                <div class="button">
                <p>test</p>
                </div>
                <div class="button">
                <p>test</p>
                </div>
                <div class="button">
                <p>test</p>
                </div>
                <div class="button">
                <p>test</p>
                </div>
                <div class="button">
                <p>test</p>
                </div>
            </div>
        </div>
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
            <?php do{ ?>
            <tr>
            <td class="centered"><?php echo $row['ln']; ?></td>
            <td class="centered"><?php echo $row['upc']; ?></td>
            <td><?php echo $row['item']; ?></td>
            <td class="centered"><?php echo $row['qty']; ?></td>
            <td class="centered"><?php echo $row['srp']; ?></td>
            <td class="centered"><?php echo $row['amount']; ?></td>
            <td class="centered"><?php echo $row['type']; ?></td>
            </tr>
            <?php }while($row = $product->fetch_assoc()); ?>
            </tbody>
        
    </table>
    
    <!-- <div class="gray-below">
        test
    </div>

    <div class="green">
        test
    </div> -->

    <script src="js/main.js"></script>

</body>
</html>