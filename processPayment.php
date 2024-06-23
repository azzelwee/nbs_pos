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
        echo '<div class="card-details">';
        echo "<p>Card Number:</p><p>$cardNumber</p>";
        echo "<p>Card Holder:</p><p>$cardHolder</p>";
        echo "<p>Card Terminal:</p><p>$cardTerminal</p>";
        echo "<p>Valid Until:</p><p>$validUntil</p>";
        echo "<p>Amount:</p><p>$amount</p>";
        echo "<p>Authorization Code:</p><p>$authCode</p>";
        echo "<p>Sales Slip No.:</p><p>$salesSlipNo</p>";
        echo '</div>';
    } else {
        echo "<p>Incomplete form data.</p>";
    }
}
?>
