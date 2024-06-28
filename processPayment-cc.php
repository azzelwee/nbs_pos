<?php
// paymentFunctions.php

function processPayment() {
    $output = "<style>
                    .label {
                        display: inline-block;
                        width: 150px; /* Adjust width as needed */
                    }
                    .value {
                        display: inline-block;
                    }
                </style>";
    
    if (isset($_GET['cardNumber'], $_GET['cardHolder'], $_GET['cardTerminal'], $_GET['validUntil'], $_GET['amount'], $_GET['authCode'], $_GET['salesSlipNo'])) {
        $cardNumber = htmlspecialchars($_GET['cardNumber']);
        $cardHolder = htmlspecialchars($_GET['cardHolder']);
        $cardTerminal = htmlspecialchars($_GET['cardTerminal']);
        $validUntil = htmlspecialchars($_GET['validUntil']);
        $amount = htmlspecialchars($_GET['amount']);
        $authCode = htmlspecialchars($_GET['authCode']);
        $salesSlipNo = htmlspecialchars($_GET['salesSlipNo']);

        // Process the form data as needed
        $output .= "<div class='label'>$cardTerminal</div> <div class='value'></div><br>";
        $output .= "<div class='label'>Card Number:</div> <div class='value'>XXXXXXXXXXXX</div><br>";
        $output .= "<div class='label'>Card Holder:</div> <div class='value'>$cardHolder</div><br>";
        $output .= "<div class='label'>Expiry Date:</div> <div class='value'>XXXX-XX-XX</div><br>";
        $output .= "<div class='label'>Authorization Code:</div> <div class='value'>$authCode</div><br>";
        $output .= "<div class='label'>Sales Slip #:</div> <div class='value'>$salesSlipNo</div><br>";
        $output .= "<div class='label'>Credit Amt:</div> <div class='value'>$amount</div><br>";
    } else {
        $output .= "<div class='label'>Card Number:</div> <div class='value'>XXXXXXXXXXXX</div><br>";
        $output .= "<div class='label'>Card Holder:</div> <div class='value'></div><br>";
        $output .= "<div class='label'>Expiry Date:</div> <div class='value'>XXXX-XX-XX</div><br>";
        $output .= "<div class='label'>Authorization Code:</div> <div class='value'></div><br>";
        $output .= "<div class='label'>Sales Slip #:</div> <div class='value'></div><br>";
        $output .= "<div class='label'>Credit Amt:</div> <div class='value'></div><br>";
    }
    
    echo $output;
}
?>
