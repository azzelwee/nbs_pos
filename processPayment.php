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
        echo "Card Number: XXXXXXXXXXXX<br>";
        echo "Card Holder: $cardHolder<br>";
        echo "Card Terminal: $cardTerminal<br>";
        echo "Valid Until: XXXX-XX-XX<br>";
        echo "Amount: $amount<br>";
        echo "Authorization Code: $authCode<br>";
        echo "Sales Slip No.: $salesSlipNo<br>";
    } else {
        echo "Card Number: XXXXXXXXXXXX<br>";
        echo "Card Holder: <br>";
        echo "Card Terminal: <br>";
        echo "Valid Until: XXXX-XX-XX<br>";
        echo "Amount: <br>";
        echo "Authorization Code:<br>";
        echo "Sales Slip No.:<br>";
    }
}
?>