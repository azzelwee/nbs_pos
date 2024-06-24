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

    <div class="e">
    <div class="column-3z">
            <div class="reds">
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Help</p>
                <p>F1</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: black;">
                <p>Cash</p>
                <p>F2</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Bank Card</p>
                <p>F3</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Check</p>
                <p>F4</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Gift Cert.</p>
                <p>F5</p>
                </div>
                <div class="button-adjust" style="background-color: #fff36b; color: black;">
                <p>Coupon</p>
                <p>F6</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>E-Purse</p>
                <p>F7</p>
                </div>
                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Credit</p>
                <p>Memo</p>
                <p>F8</span></p>
                </div>
            </div>
        </div>
    </div>
    </div>


    

    <div class="outer-container">
        <div class="container">
            <div class="column-1xz">
        </div>
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

                    <?php
                // Check if the 'totalQty' cookie is set
                if (isset($_COOKIE['totalQty'])) {
                    $totalQty = $_COOKIE['totalQty'];
                } else {
                    $totalQty = 0; // Default value if the cookie is not set
                }
                ?>
            <div class="units">   
                <p><?php echo $totalQty; ?></p>
            </div>

            <div class="sales">
            <p><?php echo number_format($totalAmount, 2);?></p>
            </div>
                    
            <div class="tendered">
            <p><?php
                // Retrieve and display userAmount from query parameter
                if (isset($_GET['userAmount'])) {
                    // Convert userAmount to float and format it to 2 decimal places
                    $formattedAmount = number_format((float)$_GET['userAmount'], 2, '.', '');
                    echo htmlspecialchars($formattedAmount);
                } else {
                    echo '0.00'; // Default value if userAmount is not provided
                }
            ?></p>
        </div>


        </div>
        <div class="payment-details">
            <p>Coupon Payment Details</p>
        </div>

        <div class="try3">
        <form id="gcForm" method="get">
        <p id="gcText">Please select type</p>
        <select name="gc_method" id="gcMethod">
                <option value="">-SELECT-</option>
                <option value="without_series">Without Series</option>
                <option value="with_series">With Series</option>
                
            </select>
                    <div id="cardDetails"></div>
            </div>

    </div>


        <div class="bottomx">
            <div class="bottom-1x">

            </div>
            
<div class="bottom-2xy">
            
        <button type="button" id="okButtonz" class="btn-ok2">Ok</button>
        <button type="reset" name="search" class="btn-cancel2" onclick="window.location.href = 'posResultDecoy.php';">Cancel</button>
        <p><span id="time"></span></p>
        </div>  
        </form>
    </div>

    <script>
        
let okButtonzClickCount = 0;
let wseriesClickCount = 0;
let ssgcClickCount = 0;

document.getElementById('okButtonz').addEventListener('click', function() {
    var selectedOption = document.getElementById('gcMethod').value;
    var cardDetailsDiv = document.getElementById('cardDetails');
    var gcMethodSelect = document.getElementById('gcMethod');
    var gcMethodText = document.getElementById('gcText');
    var form = document.getElementById('gcForm');

    if (selectedOption === 'without_series') {
        okButtonzClickCount++;
        if (okButtonzClickCount === 1) {
            gcMethodSelect.style.display = 'none';
            gcMethodText.style.display = 'none';
            cardDetailsDiv.innerHTML = `
             <label for="cardNumber">Coupon Type:</label>
                <input type="text" id="gcCertNo" name="gcCertNo" required>
                <br>
                <label for="salesSlipNo">Coupon Number:</label>
                <input type="text" id="salesSlipNo" name="salesSlipNo">
                <br>
                <label for="salesSlipNo">Coupon Denomination:</label>
                <input type="text" id="salesSlipNo" name="salesSlipNo">
                <br>
                <label for="salesSlipNo">Avail Amount:</label>
                <input type="text" id="salesSlipNo" name="salesSlipNo">
                <div id="fixing">
                    <label for="validUntil">Redemption Date:</label>
                    <input type="date" id="validUntil" name="validUntil" style="width:20%; margin-left: 5px; margin-right: 10px;">
                    <p style="color:red; font-size: 15px;">(dd-mm-YYYY)</p>
                </div>
                <label for="salesSlipNo">Valid Until:</label>
                <input type="date" id="validUntil" name="validUntil">
            `;
        } else if (okButtonzClickCount === 2) {
            okButtonz.type = 'submit';
            form.action = 'posReceiptLast2-gc.php';
            okButtonz.setAttribute('onclick', 'return validateCreditCardAmount()');
        }
        
    } else if (selectedOption === 'with_series') {
        wseriesClickCount++;
        if (wseriesClickCount === 1) {
            gcMethodSelect.style.display = 'none';
            gcMethodText.style.display = 'none';

            cardDetailsDiv.innerHTML = `
             <label for="cardNumber">Coupon Type:</label>
                <input type="text" id="gcCertNo" name="gcCertNo" required>
                <br>
                <label for="salesSlipNo">Coupon Number:</label>
                <input type="text" id="salesSlipNo" name="salesSlipNo">
                <br>
                <label for="salesSlipNo">Coupon Denomination:</label>
                <input type="text" id="salesSlipNo" name="salesSlipNo">
                <br>
                <label for="salesSlipNo">Avail Amount:</label>
                <input type="text" id="salesSlipNo" name="salesSlipNo">
                <div id="fixing">
                    <label for="validUntil">Redemption Date:</label>
                    <input type="date" id="validUntil" name="validUntil" style="width:20%; margin-left: 5px; margin-right: 10px;">
                    <p style="color:red; font-size: 15px;">(dd-mm-YYYY)</p>
                </div>
                <label for="salesSlipNo">Valid Until:</label>
                <input type="date" id="validUntil" name="validUntil">
            `;
            okButtonz.setAttribute('onclick', 'return validateGcashAmount()');
        } else if (wseriesClickCount === 2) {
            form.action = 'posReceiptLast2-gc.php';
            okButtonz.type = 'submit';
            
        }
    } else {
        alert("Please select a valid gc method.");
    }
});

function validateCreditCardAmount() {
    const totalAmount = <?php echo $totalAmount; ?>;
    const userAmount = parseFloat(document.getElementById('amount').value);

    if (isNaN(userAmount) || userAmount < totalAmount) {
        window.location.href = 'posReceipt.php?userAmount=' + encodeURIComponent(userAmount);
        return false;
    }
    return true;
}

function validateGcashAmount() {
    const totalAmount = <?php echo $totalAmount; ?>;
    const userAmount = parseFloat(document.getElementById('amount').value);

    if (isNaN(userAmount) || userAmount < totalAmount) {
        window.location.href = 'posReceipt3-gcash.php?userAmount=' + encodeURIComponent(userAmount);
        return false;
    }
    return true;
}

function validatePaymayaAmount() {
    const totalAmount = <?php echo $totalAmount; ?>;
    const userAmount = parseFloat(document.getElementById('amount').value);

    if (isNaN(userAmount) || userAmount < totalAmount) {
        window.location.href = 'posReceipt3-paymaya.php?userAmount=' + encodeURIComponent(userAmount);
        return false;
    }
    return true;
}

</script>

   
<script src="js/main.js"></script>
</body>
</html>
