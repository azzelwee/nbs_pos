<?php
// PHP code to handle quantity input
if (!isset($_SESSION)) {
    session_start();
}

include_once("connections/connection.php");
$con = connection();

// Fetch quantity input if specified, default to 1 if not provided
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
$search = $_GET['search'];

// Fetch new search results
$sql = "SELECT * FROM product_list WHERE upc = '$search' ORDER BY ln DESC";
$product = $con->query($sql) or die($con->error);
$results = $product->fetch_all(MYSQLI_ASSOC);

// Check if session variable for searches exists
if (!isset($_SESSION['search_results'])) {
    $_SESSION['search_results'] = [];
}

// Add new search results to the session variable
if ($results) {
    foreach ($results as &$result) {
        $result['qty'] = $quantity; // Add the specified quantity to each result
        $result['amount'] = $result['srp'] * $quantity; // Calculate the amount based on the quantity and SRP
    }
    $_SESSION['search_results'] = array_merge($_SESSION['search_results'], $results);
}

// Calculate the total amount
$totalAmount = 0;
if (!empty($_SESSION['search_results'])) {
    foreach ($_SESSION['search_results'] as $row) {
        $totalAmount += $row['amount'];
    }
}

setcookie('total_amount', $totalAmount, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<!-- Only add the trigger if no new search results were found -->
<?php if (empty($results)): ?>
    <span id="no-product-popup-trigger"></span>
<?php endif; ?>


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

            <a href="#" id="popupButton">
                <div class="popup-button">
                    <p>Quantity</p>
                    <p><span class="popup-highlight">F3</span></p>
                </div>
            </a>
            
                <a href="posPayment.php">
                    <div class="button">
                    <p>Payment</p>
                    <p> <span class="highlight">F4</span></p>
                    </div>
                </a>

                <a href="posOption.php">
                    <div class="button">
                    <p>Option</p>
                    <p> <span class="highlight">F5</span></p>
                    </div>
                </a>

                <a href="posNonMdse.php">
                    <div class="button">
                    <p>Non Mdse</p>
                    <p> <span class="highlight">F6</span></p>
                    </div>
                </a>

                <a href="posItemVoid.php">
                    <div class="button">
                    <p>Item Void</p>
                    <p> <span class="highlight">F7</span></p>
                </a>

                </div>
                <div class="button">
                <p>Trx Void</p>
                <p> <span class="highlight">F8</span></p>
                </div>
                <div class="button">
                <p>Suspend</p>
                <p> <span class="highlight">F9</span></p>
                </div>
                <div class="button2" style = "width: 120px; height: 50px;">
                <p>Page: 1/1</p>
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
                    <input type="submit" name="submit" style="display: none">
                    
                    <div id="popup" class="popup">
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <p>Please Enter Quantity</p>
                            <input type="number" id="quantityInput">
                        </div>
                        <div class="popup-buttons">
                            <button id="cancelButton">Cancel</button>
                            <button id="okButton">OK</button>
                        </div>
                    </div>

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

                    <a href="posLookup.php">
                        <div class="box">
                        
                            <p style="color: black;">Lookup</br></p>
                            <p> <span class="highlight">F2</span></p>
                        </a>
                        </div>
                </div>

            </div>  
            
                <div class="column-2">
                <p> <span style="color: rgb(47, 241, 255);">Subtotal:</span></p>
                    <p> <span class="qty">Quantity:</span></p>
                    <p> <span style="color: rgb(85, 255, 85);">Unit Price:</span> 
                    
                    <div class="unity">
                        <div class="sub">
                        <?php
                            if (isset($row['srp']) && !empty($row['srp'])) {
                                echo $row['srp'];
                            } else {
                                echo '0.00';
                            }
                        ?>

                        </div>
                        <div class="qtyy">
                        <?php
                            if (isset($row['qty']) && !empty($row['qty'])) {
                                echo $row['qty'];
                            } else {
                                echo '0';
                            }
                        ?>
                        </div>
                    </div>

            <!-- Display total amount -->
                    <div class="price">
                    <?php
                            if (isset($row['amount']) && !empty($row['amount'])) {
                                echo $row['amount'];
                            } else {
                                echo '0.00';
                            }
                        ?>
                </div>
            </div>     
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
            <tr data-ln="<?php echo $row['ln']; ?>">
                <td class="centered"><?php echo $row['ln']; ?></td>
                <td class="centered"><?php echo $row['upc']; ?></td>
                <td><?php echo $row['item']; ?></td>
                <td class="centered qty"><?php echo $row['qty']; ?></td>
                <td class="centered"><?php echo $row['srp']; ?></td>
                <td class="centered"><?php echo $row['amount']; ?></td>
                <td class="centered"><?php echo $row['type']; ?></td>
            </tr>
        <?php 
            }
        } 
        ?>
        </tbody>
    </table>
    
    <div id="popup-overlay-custom" class="popup-overlay-custom">
        <div class="popup-content-custom">
            <p>Item[] Not Found!</p>
            <button onclick="closePopup()">OK</button>
        </div>
    </div>
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
