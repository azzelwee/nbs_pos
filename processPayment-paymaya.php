<?php
// paymentFunctions.php

function processPaymentPaymaya() {
    $output = "<style>
                    .label {
                        display: inline-block;
                        width: 150px; /* Adjust width as needed */
                    }
                    .value {
                        display: inline-block;
                    }
                </style>";
    
    if (isset($_GET['amount'], $_GET['paymayaReferenceNo'])) {
        $amount = htmlspecialchars($_GET['amount']);
        $paymayaRefNo = htmlspecialchars($_GET['paymayaReferenceNo']);

        // Process the form data as needed
        $output .= "<div class='label'>PAYMAYA</div> <div class='value'></div><br>";
        $output .= "<div class='label'>Reference No.</div> <div class='value'>$paymayaRefNo</div><br>";
        $output .= "<div class='label'>Amount:</div> <div class='value'>$amount</div><br>";
    } else {
        $output .= "<div class='label'>PAYMAYA</div> <div class='value'></div><br>";
        $output .= "<div class='label'>Reference No.:</div> <div class='value'></div><br>";
        $output .= "<div class='label'>Amount:</div> <div class='value'></div><br>";
    }
    
    echo $output;
}
?>
