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
            
            <form action="posReceiptFinal.php" method="get">
            <p id="paymentText">Please Select Card Type</p>
            <select name="payment_method" id="paymentMethod">
            <option value="">-SELECT-</option>
            <option value="CREDIT_CARD">CREDIT CARD</option>
            <option value="SODEXHO">SODEXHO</option>
            <option value="SWEEP">SWEEP</option>
            <option value="DEPOSIT">DEPOSIT</option>
            <option value="TAX_WITHHELD">TAX WITHHELD</option>
            <option value="ATOME">ATOME</option>
            <option value="Globe Rewards">Globe Rewards</option>
            <option value="GCASH">GCASH</option>
            <option value="LNQR Sulit Coins">LNQR Sulit Coins</option>
            <option value="SM Online Pickup BDO EPS">SM Online Pickup BDO EPS</option>
            <option value="SM Online Pickup GCASH">SM Online Pickup GCASH</option>
            <option value="PICKAROO PAYMENT">PICKAROO PAYMENT</option>
            <option value="PAYMAYA">PAYMAYA</option>
            <option value="SM Online Pickup PAYMAYA">SM Online Pickup PAYMAYA</option>
            <option value="REBATE-Teacher Incentive">REBATE-Teacher Incentive</option>
            <option value="SM Online Pickup BDO">SM Online Pickup BDO</option>
            <option value="Sodexho Mobile App">Sodexho Mobile App</option>
            <option value="SM Online Pickup CASH">SM Online Pickup CASH</option>
            <option value="SM Online Delivery">SM Online Delivery</option>
            <option value="Shopee Pay">Shopee Pay</option>
            <option value="Customer QR Code-eWallet">Customer QR Code-eWallet</option>
            <option value="ZINGMALL">ZINGMALL</option>
            <option value="BDO Discount Promo">BDO Discount Promo</option>
            <option value="PREORDER BTS PH VOUCHER">PREORDER BTS PH VOUCHER</option>
            <option value="BTS Sorpresa Promo Voucher">BTS Sorpresa Promo Voucher</option>
            <option value="PREORDER BTS US VOUCHER">PREORDER BTS US VOUCHER</option>
            <option value="SM CO-FUNDED PROMO">SM CO-FUNDED PROMO</option>
            <option value="SM 50% OFF PROMO ONLINE">SM 50% OFF PROMO ONLINE</option>
            <option value="GCASH BTS PROMO">GCASH BTS PROMO</option>
            <option value="GCASH Discount Promo">GCASH Discount Promo</option>
            <option value="Pagibig Disc Promo">Pagibig Disc Promo</option>
            <option value="SM 50% OFF IN-STORE VOUCHER">SM 50% OFF IN-STORE VOUCHER</option>
            <option value="JCB Discount Promo">JCB Discount Promo</option>
            <option value="MAYA Disc Promo">MAYA Disc Promo</option>
            <option value="SM ONLINE DISC PROMO">SM ONLINE DISC PROMO</option>
            <option value="Promo Shopee DiscP15">Promo Shopee DiscP15</option>
            <option value="Promo Shopee DiscP10">Promo Shopee DiscP10</option>
            <option value="Shopee P20 Voucher">Shopee P20 Voucher</option>
            <option value="PLENTINA VOUCHER">PLENTINA VOUCHER</option>
            <option value="PAYMAYA Discount Promo">PAYMAYA Discount Promo</option>
            <option value="Pick a Prize Voucher">Pick a Prize Voucher</option>
            <option value="PHILSYS ID Voucher">PHILSYS ID Voucher</option>
            <option value="PASABUY Voucher">PASABUY Voucher</option>
            <option value="PEZA Discount Promo">PEZA Discount Promo</option>
            <option value="Shopee P50 Voucher">Shopee P50 Voucher</option>
            <option value="SM Online Evoucher Promo">SM Online Evoucher Promo</option>
            <option value="SM 50% OFF SUPPLIES">SM 50% OFF SUPPLIES</option>
            <option value="SM 10% OFF BOOKS">SM 10% OFF BOOKS</option>
            <option value="SM PROMO P222 VOUCHER">SM PROMO P222 VOUCHER</option>
            <option value="NBS SURF PROMO P25">NBS SURF PROMO P25</option>
            <option value="NBS SURF PROMO P50">NBS SURF PROMO P50</option>
            <option value="UNIQLO DISCOUNT PROMO">UNIQLO DISCOUNT PROMO</option>
            <option value="Vaccine Promo Voucher">Vaccine Promo Voucher</option>
                 </select> 
                 <div id="cardDetails"></div>
        </div>
        
    </div>


        <div class="bottomx">
            <div class="bottom-1x">

            </div>
            
        <div class="bottom-2xy">
            
        <button type="button" id="okButtonz" class="btn-ok2">Ok</button>
        <button type="reset" name="search" class="btn-cancel2">Cancel</button>
        <p><span id="time"></span></p>
        </div>  
        </form>
        
    </div>

    <script>
let okButtonzClickCount = 0;

document.getElementById('okButtonz').addEventListener('click', function() {
    var selectedOption = document.getElementById('paymentMethod').value;
    var cardDetailsDiv = document.getElementById('cardDetails');
    var paymentMethodSelect = document.getElementById('paymentMethod');
    var paymentMethodText = document.getElementById('paymentText');

    var swipeLabel = document.getElementById('swipeLabel');
    var swipeText = document.getElementById('swipeText');

    
    if (selectedOption === 'CREDIT_CARD') {
        okButtonzClickCount++;
        
        if (okButtonzClickCount === 1) {
            // Hide the select dropdown
            paymentMethodSelect.style.display = 'none';
            paymentMethodText.style.display = 'none';
            
            // Add initial input fields for credit card details
            cardDetailsDiv.innerHTML = `

                <label for="cardNumber" id="swipeLabel" style="display:flex; margin-left: 160px; width: 100%;">Please Swipe Credit Card</label>
                <input type="text" id="swipeText" style="display:flex; margin-left: 120px; width: 270px; height:30px;" name="cardNumber">

            `;
        } else if (okButtonzClickCount === 2) {
            swipeLabel.style.display = 'none';
            swipeText.style.display = 'none';
            // Add additional input fields for credit card details
            cardDetailsDiv.innerHTML += `
            <label for="cardHolder">Card Number:</label>
            <input type="text" id="cardHolder" name="cardHolder" required>
            </br>
            <label for="cardHolder">Card Holder:</label>
            <input type="text" id="cardHolder" name="cardHolder" >
            </br>
            <label for="cardTerminal">Card Terminal/Hypercom:</label>
            <input type="text" id="cardTerminal" name="cardTerminal">
            </br>
            <div id="fixing">
                <label for="validUntil">Valid Until:</label>
                <input type="date" id="validUntil" name="validUntil" style="width:20%; margin-left: 5px; margin-right: 10px;">
                <p style="color:red; font-size: 15px;">(YYYY-mm-dd)</p>
            </div>
                <form id="paymentForm" action="posReceiptLast2.php" method="get">
                    <label for="creditAmount">Credit Amount:</label>
                    <input type="text" name="amount" id="amount" value="<?php echo number_format($totalAmount, 2);?>"> 
                </form>
            </br>
            <label for="authCode">Authorization Code:</label>
            <input type="text" id="authCode" name="authCode">
            </br>
            <label for="salesSlipNo">Sales Slip No.:</label>
            <input type="text" id="salesSlipNo" name="salesSlipNo">
                      `;
            
            // Change the OK button to a submit button
            okButtonz.type = 'submit';
            okButtonz.name = 'search';
            okButtonz.setAttribute('onclick', 'return validateAmount()');
        }
    } else {
        // Show an alert if no valid payment method is selected
        alert("Please select a valid payment method.");
    }
});
function validateAmount() {
    const totalAmount = <?php echo $totalAmount; ?>;
    const userAmount = parseFloat(document.getElementById('amount').value);

    if (isNaN(userAmount) || userAmount < totalAmount) {
        // Redirect to posReceipt.php with userAmount as a query parameter
        window.location.href = 'posReceipt2.php?userAmount=' + encodeURIComponent(userAmount);
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}



</script>




   
<script src="js/main.js"></script>
</body>
</html>
