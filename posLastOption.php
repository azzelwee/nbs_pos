<?php
// PHP code to handle quantity input
if (!isset($_SESSION)) {
    session_start();
}

include_once("connections/connection.php");
$con = connection();


// Fetch new search results
$sql = "SELECT * FROM product_list";
$product = $con->query($sql) or die ($con->error);


// Calculate the total amount
$totalAmount = 0;
if (!empty($_SESSION['search_results'])) {
    foreach ($_SESSION['search_results'] as $row) {
        $totalAmount += $row['amount'];
    }
}

$totalQty = 0;

if (!empty($_SESSION['search_results'])) {
    foreach ($_SESSION['search_results'] as $row) {
        $totalQty += $row['qty'];
    }
}

setcookie('totalQty', $totalQty, time() + 3600, "/"); // The cookie expires in 1 hour
setcookie('total_amount', $totalAmount, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<!-- Only add the trigger if no new search results were found -->

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

    <div class="e">
    <div class="column-3z">
            <div class="reds">

                <a href="posTrxComment.php" id="f3">
                <div class="button-adjust">
                <p>Trx</br>Comment</p>
                <p><span class="popup-highlight">F3</span></p>
                </div>
                </a>


                <a href="posNonSales.php" id="f4">
                <div class="button-adjust">
                <p>Non</br>Sales</p>
                <p><span class="popup-highlight">F4</span></p>
                </div>
                </a>

                <a href="posCustomer.php" id="f5">
                <div class="button-adjust">
                <p>Customer</p>
                <p><span class="popup-highlight">F5</span></p>
                </div>
                </a>

                <div class="button-adjust"  style="background-color: red; color: white;">
                <p>Store</br>Opening</p>
                <p><span class="popup-highlight">F6</span></p>
                </div>

                <a href="posZeroRated.php" id="f7">
                <div class="button-adjust">
                <p>Zero</br>Rated</p>
                <p><span class="popup-highlight">F7</span></p>
                </div>
                </a>

                <a href="posReturn2.php" id="f8">
                <div class="button-adjust">
                <p>Return</p>
                <p><span class="popup-highlight">F8</span></p>
                </div>
                </a>

                <div class="button-adjust"  style="background-color: red; color: white;">
                <p>Reserved</br>Trx</p>
                <p><span class="popup-highlight">F9</span></p>
                </div>

                <a href="posRefund.php" id="f10">
                <div class="button-adjust">
                <p>Refund</p>
                <p><span class="popup-highlight">F10</span></p>
                </div>
                </a>

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
                    <input type="text" name="search" id="search" disabled>  
                    
                    <div id="popup" class="popup">
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <p>Please Enter Quantity</p>
                            <input type="number" id="quantityInput">
                            <div class="popup-buttons">
                                <button id="">Cancel</button>
                                <button id="">OK</button>
                            </div>
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

                    <div class="box" style="background-color: red; color: white;">
                        <p>
                        Help</br></p>
                        <p> <span class="highlight">F1</span></p>
                    </div>

                    <div class="box">
                        <p>BONUS</br>BUY</p>
                        <p> <span class="highlight">F2</span></p>
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
                    <div class="price2">
                    <?php
                    if (isset($row['amount']) && !empty($row['amount'])) {
                        echo number_format($row['amount'], 2);
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
                <?php
                    echo $totalQty;
                    ?>
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
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var statusParagraph = document.getElementById("status");

        document.addEventListener("keydown", function(event) {
            if (event.key === "F10") {
                event.preventDefault();
                // Toggle the status text
                if (statusParagraph.innerHTML.includes("ON")) {
                    statusParagraph.innerHTML = "CSA</br>OFF</br>";
                } else {
                    statusParagraph.innerHTML = "CSA</br>ON/OFF</br>";
                }
            }
        });
    });
        document.addEventListener("keydown", (event) => {
            if (event.key === 'F11') {
                highlightRow('prev');
                event.preventDefault();
            } else if (event.key === 'F12') {
                highlightRow('next');
                event.preventDefault();
            }
            switch(event.keyCode) {
                case 114: // F3 key
                    event.preventDefault();
                    document.getElementById('f3').click();
                    break;
                case 115: // F3 key
                    event.preventDefault();
                    document.getElementById('f4').click();
                    break;
                case 116: 
                    event.preventDefault();
                    document.getElementById('f5').click();
                    break;
                case 118: 
                    event.preventDefault();
                    document.getElementById('f7').click();
                    break;
                case 119: 
                    event.preventDefault();
                    document.getElementById('f8').click();
                    break;
                case 121: 
                    event.preventDefault();
                    document.getElementById('f10').click();
                    break;
            }
    });
    </script>

    <script src="js/main.js"></script>
    
</body>
</html>
