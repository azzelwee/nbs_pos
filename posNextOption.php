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
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Cash</br>Count</p>
                <p><span class="popup-highlight">F3</span></p>
                </div>

                <a href="posTrxJournal.php" id="f4">
                <div class="button-adjust">
                <p>Trx</br>Journal</p>
                <p><span class="popup-highlight">F4</span></p>
                </div>
            </a>

                <a href="posLastOption.php" id="f5">
                <div class="button-adjust">
                <p>Next</br>Option</p>
                <p><span class="popup-highlight">F5</span></p>
                </div>
                </a>

                <a href="posSalesJournal.php" id="f6">
                <div class="button-adjust">
                <p>Sales</br>Journal</p>
                <p><span class="popup-highlight">F6</span></p>
                </div>
                </a>

                <a href="posScanAndGo.php" id="f7">
                <div class="button-adjust">
                <p>Scan</br>and Go</p>
                <p><span class="popup-highlight">F7</span></p>
                </div>
                </a>

                <a href="posCashierReading.php" id="f8">
                <div class="button-adjust">
                <p>Cashier</br>Reading</p>
                <p><span class="popup-highlight">F8</span></p>
                </div>
                </a>

                <a href="#" id="popupButton">
                    <div class="button-adjust" id="f9">
                        <p>Terminal</br>Reading</p>
                        <p><span class="popup-highlight">F9</span></p>
                    </div>
                </a>

                <div id="popup" class="popup">
                    <div class="popup-content">
                        </br>
                        <p style="font-size: 18px;">Please Perform SDV.</p>
                        <div class="popup-buttons">
                            <button id="cancelButton">OK</button> <!-- Added okButton here -->
                        </div>
                    </div>
                </div>

                
                <div class="button-adjust" id="f10">
                <p>SDV</p>
                <p><span class="popup-highlight">F10</span></p>
                </div>

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

                    <a href="postVoid.php" id="f2">
                    <div class="box">
                        <p>Post</br>Void</p>
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
                $counter = count($_SESSION['search_results']);
                foreach (array_reverse($_SESSION['search_results']) as $row) {
            ?>
                <tr data-ln="<?php echo $row['ln']; ?>">
                    <td class="centered"><?php echo $counter--; ?></td>
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
        document.addEventListener("keydown", (event) => {
            if (event.key === 'F11') {
                highlightRow('prev');
                event.preventDefault();
            } else if (event.key === 'F12') {
                highlightRow('next');
                event.preventDefault();
            }
            switch(event.keyCode) {
                case 113: // F2 key
                    event.preventDefault();
                    document.getElementById('f2').click();
                    break;
                case 115: 
                    event.preventDefault();
                    document.getElementById('f4').click();
                    break;
                case 116: 
                    event.preventDefault();
                    document.getElementById('f5').click();
                    break;
                case 117: 
                    event.preventDefault();
                    document.getElementById('f6').click();
                    break;
                case 118: 
                    event.preventDefault();
                    document.getElementById('f7').click();
                    break;
                case 119: 
                    event.preventDefault();
                    document.getElementById('f8').click();
                    break;
                case 120: 
                    event.preventDefault();
                    document.getElementById('f9').click();
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
