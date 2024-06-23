<?php

function processPaymentGcash() {
    if (isset($_GET['gcashReferenceNo'], $_GET['amount'])) {
        $gcashReferenceNo = htmlspecialchars($_GET['gcashReferenceNo']);
        $amount = htmlspecialchars($_GET['amount']);

        // Process the form data as needed
        echo "GCASH </br>";
        echo "Amount: $amount <br>";
        echo "Reference No.: $gcashReferenceNo<br>";
        
    } else {
        echo "GCASH </br>";
        echo "Amount:  <br>";
        echo "Reference No.: <br>";
    }
}
?>