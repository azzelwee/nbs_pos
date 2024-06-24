<?php

function processPaymentPaymaya() {
    if (isset($_GET['paymayaReferenceNo'], $_GET['amount'])) {
        $paymayaReferenceNo = htmlspecialchars($_GET['paymayaReferenceNo']);
        $amount = htmlspecialchars($_GET['amount']);

        // Process the form data as needed
        echo "PAYMAYA: </br>";
        echo "Amount: $amount <br>";
        echo "Reference No.: $paymayaReferenceNo<br>";
        
    } else {
        echo "PAYMAYA: </br>";
        echo "Amount:  <br>";
        echo "Reference No.: <br>";
    }
}
?>