<?php
session_start();

if (isset($_POST['ln']) && isset($_POST['qty'])) {
    $ln = $_POST['ln'];
    $qty = $_POST['qty'];

    // Update the quantity in the session
    foreach ($_SESSION['search_results'] as &$product) {
        if ($product['ln'] == $ln) {
            $product['qty'] = $qty;
            break;
        }
    }
    echo 'Quantity updated';
}
?>
