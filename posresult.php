<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once("connections/connection.php");
$con = connection();
$search = $_GET['search'];

$sql = "SELECT * FROM product_list WHERE upc = '$search' ORDER BY ln DESC";
$product = $con->query($sql) or die($con->error);
$results = $product->fetch_all(MYSQLI_ASSOC);

// Check if session variable for searches exists
if (!isset($_SESSION['search_results'])) {
    $_SESSION['search_results'] = [];
}

// Add new search results to the session variable
if ($results) {
    $_SESSION['search_results'] = array_merge($_SESSION['search_results'], $results);
}

// Calculate the total amount
$totalAmount = 0;
if (!empty($_SESSION['search_results'])) {
    foreach ($_SESSION['search_results'] as $row) {
        $totalAmount += $row['amount'];
    }
}

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
    The range of UPC scan on DB is 1-30. </br>
    Test scan only.
</div>
<a href="logout.php" class="logout">
        Logout
    </a>
<div class="whole-container">

    <div class="form-logo">
        <img src="img/nbslogo.png" alt="">
    </div>

    <?php include 'header.php'; ?>

    <div class="e">
    <div class="column-3">
            <div class="reds">
                <div class="button">
                <p>Quantity</p>
                <p> <span class="highlight">F3</span></p>
                </div>

                <a href="posPayment.php">
                    <div class="button">
                    <p>Payment</p>
                    <p> <span class="highlight">F4</span></p>
                    </div>
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
                    <p> <span style="color: green;">Unit Price: </span> 
                    
            <!-- Display total amount -->
                    <div class="price">
                    <?php echo $totalAmount; ?>
                </div>
            </div> 



            <!-- <div class="thelefty">
                asd
            </div> -->          
    </div>



    <div class="scrollable-table-container">
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
            if (!empty($_SESSION['search_results'])) {
                foreach ($_SESSION['search_results'] as $row) {
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
</div>

    
    <div class="bottom">
        <div class="bottom-1">
            <p>Total Qty</p>
                <div class="bar1">
                    
                </div>

        </div>
        
        <div class="bottom-2">
            <p>Total Sales:</p>
                <div class="bar2">
                <?php echo $totalAmount; ?>
                </div>
        </div>
        <div class="bottom-3">
        <p><span id="date"></span>  &nbsp;&nbsp;&nbsp; <span id="time"></span></p>
        </div>
    </div>

    <script src="js/main.js"></script>
    
</body>
</html>
