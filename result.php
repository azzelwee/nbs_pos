<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();
$search = $_GET['search'];

$sql = "SELECT * FROM product_list WHERE upc = '$search' ORDER BY ln DESC";
$product = $con->query($sql) or die ($con->error);
$row = $product->fetch_assoc()

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
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
            <?php 
            if ($product && $product->num_rows > 0) {
                foreach ($product as $row) {
            ?>
      
            <p span class="sub">Subtotal: </span> </p>
            <p span class="qty">Quantity: </span><?php echo $row['qty']; ?></p>
            <p span class="unit">Unit Price: </span> 
                <div class="price">
                    <?php echo $row['amount']; ?></p> 
                </div>

            <?php 
                    }
                } else {
                    echo "
                    <p>Subtotal: 0</p>
                    <p>Quantity: 0</p>
                    <p>Unit Price: 0</p> ";
                }
            ?>


        </div>
    </div>
        
    <div class="column-3">
            <div class="reds">
            <div class="button">
                <p>Quantity</p>
                <p> <span class="highlight">F3</span></p>
                </div>
                <a href="payment.php" class="button">
                    <p>Payment</p>
                    <p><span class="highlight">F4</span></p>
                </a>
                <div class="button">
                <p>Option</p>
                <p> <span class="highlight">F5</span></p>
                </div>
                <div class="button">
                <p>Non Mdse</p>
                <p> <span class="highlight">F6</span></p>
                </div>
                <div class="button">
                <p>Item Void</p>
                <p> <span class="highlight">F7</span></p>
                </div>
                <div class="button">
                <p>Trx Void</p>
                <p> <span class="highlight">F8</span></p>
                </div>
                <div class="button">
                <p>Suspend</p>
                <p> <span class="highlight">F9</span></p>
                </div>
                <div class="button">
                <p>Page: 1/1</p>
                </div>
            </div>
        </div>
    </div>
    
    <table class="products">
    <thead>
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

    <?php 
    if ($product && $product->num_rows > 0) {
        foreach ($product as $row) {
    ?>
            <tr>
                <td class="centered"><?php echo $row['ln']; ?></td>
                <td class="centered"><?php echo $row['upc']; ?></td>
                <td><?php echo $row['item']; ?></td>
                <td class="centered"><?php echo $row['qty']; ?></td>
                <td class="centered"><?php echo $row['srp']; ?></td>
                <td class="centered"><?php echo $row['amount']; ?></td>
                <td class="centered"><?php echo $row['type']; ?></td>
            </tr>

<?php 
        }
    } else {
        echo "<tr><td colspan='7'>No product found.</td></tr>";
    }
?>

    </tbody>
</table>

    
    <!-- <div class="gray-below">
        test
    </div> -->

    <div class="green">
        test
    </div>

    <script src="js/main.js"></script>

</body>
</html>