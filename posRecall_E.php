<?php
// PHP code to handle quantity input
if (!isset($_SESSION)) {
    session_start();
}

include_once("connections/connection.php");
$con = connection();

// Fetch quantity input if specified, default to 1 if not provided
$quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch new search results
$sql = "SELECT * FROM lookup_list WHERE sku = '$search' ORDER BY ln ASC";
$product = $con->query($sql) or die($con->error);
$results = $product->fetch_all(MYSQLI_ASSOC);


// Check if session variable for searches exists
if (!isset($_SESSION['search_results2'])) {
    $_SESSION['search_results2'] = [];
}

// Add new search results to the session variable
if ($results) {
    foreach ($results as &$result) {
        $result['qty'] = $quantity; // Add the specified quantity to each result
        $result['amount'] = $result['srp'] * $quantity; // Calculate the amount based on the quantity and SRP
    }
    $_SESSION['search_results2'] = array_merge($_SESSION['search_results2'], $results);
}

// Calculate the total amount
$totalAmount = 0;
if (!empty($_SESSION['search_results2'])) {
    foreach ($_SESSION['search_results2'] as $row) {
        $totalAmount += $row['amount'];
    }
}

$totalQty = 0;

if (!empty($_SESSION['search_results2'])) {
    foreach ($_SESSION['search_results2'] as $row) {
        $totalQty += $row['qty'];
    }
}

setcookie('total_amount', $totalAmount, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie('totalQty', $totalQty, time() + 3600, "/"); // The cookie expires in 1 hour

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
                <h1>RECALL</h1>
            </div>
        </div>

        <div class="reprint-column">

            <div class="left-reprint">

                <div class="orNo">
                <table>
                    <thead>
                        <tr>
                        <th>Transaction No.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td style="height: 25px; text-align: center;">0620202429990002000031</td>
                        </tr>
                        <tr>
                        <td style="height: 25px;"></td>
                        </tr>
                        <tr>
                        <td style="height: 25px;"></td>
                        </tr>
                    <td style="height: 25px;"></td>
                        </tr>
                    <td style="height: 25px;"></td>
                        </tr>
                    <td style="height: 25px;"></td>
                        </tr>
                    <td style="height: 25px;"></td>
                        </tr>
                    <td style="height: 25px;"></td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <div class="reprint-buttons">
                    <div class="bottom-buttons2">
                        <h3>PRINT</h3>
                        <p>&lt;Alt-Enter&gt;</p>
                    </div>

                    <div class="bottom-buttons2">
                        <h3>PREV</h3>
                        <p>&lt;Left-Arrow&gt;</p>
                    </div>

                    <div class="bottom-buttons2">
                        <h3>NEXT</h3>
                        <p>&lt;Right-Arrow&gt;</p>
                    </div>

                    <a href="posMain.php" id="altB">
                    <div class="bottom-buttons2">
                        <h3>BACK</h3>
                        <p style="color: black;">&lt;Alt-B&gt;</p>
                    </div>
                    </a>
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
            

            <div class="bottom-page">
            <p>Page: 1/0</p>
            </div>
        </div>
        

<script src="js/main.js"></script>
</body>
</html>
