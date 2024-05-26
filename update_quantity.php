<?php
session_start();

include_once("connections/connection.php");
$con = connection();

if (isset($_POST['quantity']) && isset($_POST['search'])) {
    $quantity = $_POST['quantity'];
    $search = $_POST['search'];

    // Update the 'qty' field in the product_list table
    $sql = "UPDATE product_list SET qty = $quantity WHERE ln = (SELECT ln FROM product_list WHERE upc = $search ORDER BY ln DESC LIMIT 1)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("is", $quantity, $search);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Update the quantity in the session data
        foreach ($_SESSION['search_results'] as &$result) {
            if ($result['upc'] == $search) {
                $result['qty'] = $quantity;
                break;
            }
        }

        // Recalculate the total amount (if needed)
        // This depends on how 'amount' is calculated in your session data

        // Optionally, you can set a success message to return to the client
        echo json_encode(['status' => 'success', 'message' => 'Quantity updated successfully']);
    } else {
        // No rows were affected, indicating the product with the given UPC was not found
        echo json_encode(['status' => 'error', 'message' => 'Product not found']);
    }
    
    $stmt->close();
} else {
    // Invalid input
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}

$con->close();
?>
