<?php
// processPayment.php

function processPayment() {
    if (isset($_GET['cardNumber'], $_GET['cardHolder'], $_GET['cardTerminal'], $_GET['validUntil'], $_GET['amount'], $_GET['authCode'], $_GET['salesSlipNo'])) {
        $cardNumber = htmlspecialchars($_GET['cardNumber']);
        $cardHolder = htmlspecialchars($_GET['cardHolder']);
        $cardTerminal = htmlspecialchars($_GET['cardTerminal']);
        $validUntil = htmlspecialchars($_GET['validUntil']);
        $amount = htmlspecialchars($_GET['amount']);
        $authCode = htmlspecialchars($_GET['authCode']);
        $salesSlipNo = htmlspecialchars($_GET['salesSlipNo']);

        // Process the form data as needed
        echo "Card Number: $cardNumber<br>";
        echo "Card Holder: $cardHolder<br>";
        echo "Card Terminal: $cardTerminal<br>";
        echo "Valid Until: $validUntil<br>";
        echo "Amount: $amount<br>";
        echo "Authorization Code: $authCode<br>";
        echo "Sales Slip No.: $salesSlipNo<br>";
    } else {
        echo "Incomplete form data.";
    }
}
?>

<p>Card Number:</p>
<p><?php echo $cardNumber?></p>