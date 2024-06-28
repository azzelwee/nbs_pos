<?php
// paymentFunctions.php

function processPaymentGcash() {
    $output = "<style>
                    .label {
                        display: inline-block;
                        width: 150px; /* Adjust width as needed */
                    }
                    .value {
                        display: inline-block;
                    }
                </style>";
    
    if (isset($_GET['amount'], $_GET['gcashReferenceNo'])) {
        $amount = htmlspecialchars($_GET['amount']);
        $gcashRefNo = htmlspecialchars($_GET['gcashReferenceNo']);

        // Process the form data as needed
        $output .= "<div class='label'>GCASH</div> <div class='value'></div><br>";
        $output .= "<div class='label'>Reference No.</div> <div class='value'>$gcashRefNo</div><br>";
        $output .= "<div class='label'>Amount:</div> <div class='value'>$amount</div><br>";
    } else {
        $output .= "<div class='label'>GCASH</div> <div class='value'></div><br>";
        $output .= "<div class='label'>Reference No.:</div> <div class='value'></div><br>";
        $output .= "<div class='label'>Amount:</div> <div class='value'></div><br>";
    }
    
    echo $output;
}
?>
