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
                <div class="button-adjust" style="background-color: #fff36b; color: black;">
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
                <div class="button-adjust" style="background-color: red; color: white;">
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
                <p>0.00</p>
            

            </div>

        </div>
        <div class="payment-details">
            <p>Card Payment Details</p>
        </div>

        <div class="try3">
    <form id="paymentForm" method="get">
        <p id="paymentText">Please Select Card Type</p>
        <select name="payment_method" id="paymentMethod">
            <option value="">-SELECT-</option>
            <option value="CREDIT_CARD">CREDIT CARD</option>
            <option value="GCASH">GCASH</option>
            <option value="PAYMAYA">PAYMAYA</option>
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
let gcashClickCount = 0;
let paymayaClickCount = 0;

document.getElementById('okButtonz').addEventListener('click', function() {
    var selectedOption = document.getElementById('paymentMethod').value;
    var cardDetailsDiv = document.getElementById('cardDetails');
    var paymentMethodSelect = document.getElementById('paymentMethod');
    var paymentMethodText = document.getElementById('paymentText');
    var form = document.getElementById('paymentForm');

    if (selectedOption === 'CREDIT_CARD') {
        okButtonzClickCount++;
        if (okButtonzClickCount === 1) {
            paymentMethodSelect.style.display = 'none';
            paymentMethodText.style.display = 'none';
            cardDetailsDiv.innerHTML = `
                <label for="cardNumber" id="swipeLabel" style="display:flex; margin-left: 160px; width: 100%;">Please Swipe Credit Card</label>
                <input type="text" id="swipeText" style="display:flex; margin-left: 120px; width: 270px; height:30px;" name="cardNumber">
            `;
        } else if (okButtonzClickCount === 2) {
            document.getElementById('swipeLabel').style.display = 'none';
            document.getElementById('swipeText').style.display = 'none';
            cardDetailsDiv.innerHTML += `
                <label for="cardNumber">Card Number:</label>
                <input type="text" id="cardNumber" name="cardNumber" required>
                <br>
                <label for="cardHolder">Card Holder:</label>
                <input type="text" id="cardHolder" name="cardHolder">
                <br>
                <label for="cardTerminal">Card Terminal/Hypercom:</label>
                <input type="text" id="cardTerminal" name="cardTerminal">
                <br>
                <div id="fixing">
                    <label for="validUntil">Valid Until:</label>
                    <input type="date" id="validUntil" name="validUntil" style="width:20%; margin-left: 5px; margin-right: 10px;">
                    <p style="color:red; font-size: 15px;">(dd-mm-YYYY)</p>
                </div>
                <label for="creditAmount">Credit Amount:</label>
                <input type="text" name="amount" id="amount" value="<?php echo number_format($totalAmount, 2);?>">
                <br>
                <label for="authCode">Authorization Code:</label>
                <input type="text" id="authCode" name="authCode">
                <br>
                <label for="salesSlipNo">Sales Slip No.:</label>
                <input type="text" id="salesSlipNo" name="salesSlipNo">
            `;
            okButtonz.type = 'submit';
            form.action = 'posReceiptLast2.php';
            okButtonz.setAttribute('onclick', 'return validateCreditCardAmount()');
        }
        
    } else if (selectedOption === 'GCASH') {
        gcashClickCount++;
        if (gcashClickCount === 1) {
            paymentMethodSelect.style.display = 'none';
            paymentMethodText.style.display = 'none';

            cardDetailsDiv.innerHTML = `
                <label for="gcashAmount">Amount:</label>
                <input type="text" id="amount" name="amount" value="<?php echo number_format($totalAmount, 2);?>">
                <br>
                <label for="gcashReferenceNo">Reference No.:</label>
                <input type="text" id="gcashReferenceNo" name="gcashReferenceNo" required>
            `;
            okButtonz.setAttribute('onclick', 'return validateGcashAmount()');
        } else if (gcashClickCount === 2) {
            form.action = 'posReceiptFinal-gcash.php';
            okButtonz.type = 'submit';
            
        }
    } else if (selectedOption === 'PAYMAYA') {
        paymayaClickCount++;
        if (paymayaClickCount === 1) {
            paymentMethodSelect.style.display = 'none';
            paymentMethodText.style.display = 'none';

            cardDetailsDiv.innerHTML = `
                <label for="paymayaAmount">Amount:</label>
                <input type="text" id="amount" name="amount" value="<?php echo number_format($totalAmount, 2);?>" required>
                <br>
                <label for="paymayaReferenceNo">Reference No.:</label>
                <input type="text" id="paymayaReferenceNo" name="paymayaReferenceNo" required>
            `;
            okButtonz.setAttribute('onclick', 'return validatePaymayaAmount()');
        } else if (paymayaClickCount === 2) {
            form.action = 'posReceiptFinal-paymaya.php';
            okButtonz.type = 'submit';
            
        }
    } else {
        alert("Please select a valid payment method.");
    }
});

function validateCreditCardAmount() {
    const totalAmount = <?php echo $totalAmount; ?>;
    const userAmount = parseFloat(document.getElementById('amount').value);

    if (isNaN(userAmount) || userAmount < totalAmount) {
        window.location.href = 'posReceipt3.php?userAmount=' + encodeURIComponent(userAmount);
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
