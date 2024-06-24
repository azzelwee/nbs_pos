<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();
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

setcookie('total_amount', $totalAmount, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie('total_amount', $totalAmount, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Point of Sale</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="note-info-index">
    Note:
    </br>
    Scan UCP </br>
    1-30
    </br>
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
                <div class="popup-button" style="background-color: red; color: white;">
                    <p>Quantity</p>
                    <p style="color: gray;">F3</span></p>
                </div>
            </a>
            
                <a href="posPayment.php">
                    <div class="button" style="background-color: red; color: white;">
                    <p>Payment</p>
                    <p style="color: gray;">F4</span></p>
                    </div>
                </a>

                <a href="posOption2.php">
                    <div class="button" style="background-color: red; color: white;">
                    <p>Option</p>
                    <p style="color: gray;">F5</span></p>
                    </div>
                </a>

                <a href="posNonMdse2.php">
                    <div class="button" style="background-color: red; color: white;">
                    <p>Non Mdse</p>
                    <p style="color: gray;">F6</span></p>
                    </div>
                </a>

                <a href="posItemVoid2.php">
                    <div class="button" style="background-color: #fff36b; color: black;">
                    <p>Item Void</p>
                    <p style="color: gray;">F7</span></p>
                    </div>
                </a>

               
                <a href="posTrxVoid2.php">
                <div class="button" style="background-color: red; color: white;">
                <p>Trx Void</p>
                <p style="color: gray;">F8</span></p>
                </div>
                </a>


                <a href="posSuspend2.php">
                    <div class="button" style="background-color: red; color: white;">
                    <p>Suspend</p>
                    <p style="color: gray;">F9</span></p>
                    </div>
                </a>

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
                    <label>Void SKU</label>
                    <form action="posResultDecoyItemVoidNegative.php" method="get">
                        <input type="text" name="search" id="search">
                        <input type="hidden" name="quantity" id="quantityHidden">
                        <input type="submit" name="submit" style="display: none">
                    </form>
                </div>
            </div>

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

                <div class="grays">
                    <div class="box" id="box1">
                        <img src="img/green-triangle-up.png" alt="Up">
                        <p>F11</p>
                    </div>

                    <div class="box" id="box2">
                        <img src="img/green-triangle-down.png" alt="Down">
                        <p>F12</p>
                    </div>


                    <div class="box">
                        <p id="status">CSA</br>
                        ON/OFF</br></p>
                        <p> <span class="highlight">F10</span></p>
                    </div>

                    <a href="posLookup2.php">
                        <div class="box" style=" background-color: red;">
                        <p style="color: white;">Lookup</br></p>
                        <p style="color: gray;">F2</span></p>
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
                <th>SKU</th>
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
        $counter = count($_SESSION['search_results']);
        foreach (array_reverse($_SESSION['search_results']) as $row) {
            // Check if quantity is negative
            $quantity = (float) $row['qty']; // Convert qty to float for safe comparison
            $row_class = ($quantity < 0) ? 'negative-qty' : '';

            // Output table row with appropriate class
?>
            <tr class="<?php echo $row_class; ?>" data-ln="<?php echo $row['ln']; ?>">
                <td class="centered"><?php echo $counter--; ?></td>
                <td class="centered"><?php echo $row['upc']; ?></td>
                <td><?php echo $row['item']; ?></td>
                <td class="centered qty"><?php echo $quantity; ?></td>
                <td class="centered"><?php echo $row['srp']; ?></td>
                <td class="centered"><?php echo number_format($row['amount'], 2); ?></td>
                <td class="centered"><?php echo $row['type']; ?></td>
            </tr>
<?php
        }
    }
?>
        </tbody>
    </table>

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
                <?php echo number_format($totalAmount, 2);?>
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

                case 27:
                    cancelButton.click();
                    document.getElementById('esc').click();
                    break;
                case 13:
                    okButton.click();
                    document.getElementById('enter').click();
                    break;
                
            }
    });
    </script>

    <script src="js/main.js"></script>
    
</body>
</html>
