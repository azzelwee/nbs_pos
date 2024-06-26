<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("../connections/connection.php");
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
    <link rel="stylesheet" href="../css/style.css">
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
                <div class="button-adjust" id="f1">
                <p>Help</p>
                <p>F1</p>
                </div>

                <div class="button-adjust" style="background-color: #fff36b; color: black;">
                <p>Cash</p>
                <p>F2</p>
                </div>

                <a href="posBankCard.php" id="f3">
                <div class="button-adjust">
                <p>Bank Card</p>
                <p>F3</p>

                </div>
                </a>

                <div class="button-adjust" style="background-color: red; color: white;">
                <p>Check</p>
                <p>F4</p>
                </div>

                <a href="posGiftCert.php" id="f5">
                <div class="button-adjust">
                <p>Gift Cert.</p>
                <p>F5</p>
                
                </div>
                </a>

                <a href="posCoupon.php" id="f6">
                <div class="button-adjust">
                <p>Coupon</p>
                <p>F6</p>
                
                </div>
                </a>

                <div class="button-adjust" style="background-color: red; color: white;">
                <p>E-Purse</p>
                <p>F7</p>
                </div>
                
                <a href="posCreditMemo.php" id="f8">
                    <div class="button-adjust">
                    <p>Credit</p>
                    <p>Memo</p>
                    <p>F8</span></p>
                    </div>
                </a>
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
                    <?php include '../receipt-text-gcash.php'; ?>
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
        
        // Save formattedAmount in a session variable
        $_SESSION['formattedAmount'] = $formattedAmount;
        
        $formattedAmounted = number_format($formattedAmount, 2);
        echo htmlspecialchars($formattedAmounted);
    } else {
        echo '0.00'; // Default value if userAmount is not provided
    }
            ?></p>
        </div>
    

        </div>
        <div class="payment-details">
            <p>Card Payment Details</p>
        </div>

        <?php
            if (isset($totalAmount) && isset($formattedAmount) && is_numeric($totalAmount) && is_numeric($formattedAmount)) {
                $remains = $totalAmount - $formattedAmount;
            } else {
                $remains = 0; 
            }
            $remainsFormatted = number_format($remains, 2);
        ?>

            <?php
            $remainsWhole = str_replace(',', '', $remainsFormatted);
            ?>




        <div class="try">
            <p>Enter Amount:</p>
            <form id="paymentForm" action="posReceiptFinal-gcash.php" method="get">
            <input type="text" name="amount" id="amount" value="<?php echo $remainsWhole?>"> 
        </div>
        
    </div>

        <div class="bottomx">
            <div class="bottom-1x">

            </div>
            
        <div class="bottom-2xy">
            
        <button type="submit" name="search" class="btn-ok2" onclick="return validateAmount()">Ok</button>
        <button type="reset" name="search" class="btn-cancel2" onclick="window.location.href = '../posResultDecoy.php';">Cancel</button>

        <p><span id="time"></span></p>
        </div>  
        </form>

        
        <div class="unique-popup" id="popup">
            <div class="popup-content2">
            <p>Cannot perform this transaction.</br>
            Cash must be equal or higher to total transaction amount.
            </br></br>
            If you have GC, coupon, credit card, etc.,</br>
            please use this payment before tendering cash.</p>
            </div>
            <div class="closePopers">
            <button class="popup-close" onclick="closePopup()">OK</button>
            </div>
        </div>

    </div>

<script>
        document.addEventListener("keydown", (event) => {
            switch(event.keyCode) {
                case 112: // F3 key
                    event.preventDefault();
                    document.getElementById('f1').click();
                    break;
                case 114: // F3 key
                    event.preventDefault();
                    document.getElementById('f3').click();
                    break;
                case 116: 
                    event.preventDefault();
                    document.getElementById('f5').click();
                    break;
                case 117: 
                    event.preventDefault();
                    document.getElementById('f6').click();
                    break;
                case 119: 
                    event.preventDefault();
                    document.getElementById('f8').click();
                    break;
            }
    });
    
    function validateAmount() {
    const totalAmount = <?php echo $totalAmount; ?>;
    const formattedAmount = <?php echo $formattedAmount; ?>;
    const userAmount = parseFloat(document.getElementById('amount').value);

    if (isNaN(userAmount) || (userAmount + formattedAmount) < totalAmount) {
        showPopup();
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}


    function showPopup() {
        document.getElementById('popup').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }

    function getFormattedDate(date) {
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
    return year + '-' + months[monthIndex] + '-' + (day < 10 ? '0' : '') + day;
}

function updateTime() {
    var currentDate = new Date();
    var dateElement = document.getElementById("date");
    var timeElement = document.getElementById("time");

    // Get the formatted date
    var formattedDate = getFormattedDate(currentDate);

    // Update the date and time elements
    dateElement.innerHTML = formattedDate;
    timeElement.innerHTML = currentDate.toLocaleTimeString();
}

// Update time every second
setInterval(updateTime, 100);
        
</script>


</body>
</html>
