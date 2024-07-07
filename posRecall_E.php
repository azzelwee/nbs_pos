<?php
// PHP code to handle quantity input
if (!isset($_SESSION)) {
    session_start();
}

include_once("connections/connection.php");
$con = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reprint'])) {
    $transaction_id = $_POST['transaction_id'];
    $_SESSION['search_results'] = $_SESSION['transactions'][$transaction_id];

    // Redirect to posResult.php
    header('Location: posResultDecoy.php');
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Point of Sale</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<a href="logout.php" class="logout">
        Logout
    </a>
<div class="whole-container">

    <div class="form-logo">
        <img src="img/nbslogo.png" alt="">
    </div>

    <div class= "gray">
            <div class="gray-text"> 
                <?php
                // Get the current date in mm/dd/yyyy format
                $currentDate = date("mdY");

                if(isset($_SESSION['UserLogin'])){
                    echo "Trx.: " . $currentDate . "" . $_SESSION['Trx'];
                } else {
                    echo "Trx.: " . $currentDate;
                }        
                ?>
            </div>

            <div class="gray-text">
                <?php
                if(isset($_SESSION['UserLogin'])){
                    echo "Clerk: ".$_SESSION['Name'];
                } else {
                    echo "Guest";
                }        
                ?>
            </div>

            <div class="gray-text">
                <?php
                if(isset($_SESSION['UserLogin'])){
                    echo "Str No.: 2999";
                } else {
                    echo "Str No.:";
                }        
                ?>
            </div>

            <div class="gray-text">
                <?php
                if(isset($_SESSION['UserLogin'])){
                    echo "Reg No.: 0001";
                } else {
                    echo "Reg No.:";
                }        
                ?>
            </div>

    
    <div class="gray-text">
                <span id="date"></span>
            </div>
            </div>
    <div class="outer-container">
        <div class="container">
            <div class="column-1xz">
                <h1>RECALL</h1>
            </div>
        </div>

        <div class="reprint-column">

            <div class="left-reprint">

                <div class="orNo">
                <form method="post">
               <table>
            <thead>
                <tr>
                    <th>Transaction No.</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (!empty($_SESSION['transactions'])) {
                    foreach ($_SESSION['transactions'] as $transaction_id => $transaction) {
                        echo "<tr>";
                        echo "<td style='height: 25px; text-align: center;'>";
                        echo "<input type='radio' name='transaction_id' value='$transaction_id' onclick='previewTransaction(\"$transaction_id\")'> $transaction_id";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
                </div>

                <div class="reprint-buttons">

                <button type="submit" name="reprint" class="bottom-buttons2">
                    <h3>REPRINT</h3>
                    <p>&lt;Alt-Enter&gt;</p>
                </button>

                    <div class="bottom-buttons2">
                        <h3>PREV</h3>
                        <p>&lt;Left-Arrow&gt;</p>
                    </div>

                    <div class="bottom-buttons2">
                        <h3>NEXT</h3>
                        <p>&lt;Right-Arrow&gt;</p>
                    </div>

                    <a href="posMain.php" id="altB">
                    <div class="bottom-buttons2">
                        <h3>BACK</h3>
                        <p style="color: black;">&lt;Alt-B&gt;</p>
                    </div>
                    </a>
                </div>

                </form>
            </div>


            <div class="right-reprint">
            <div class="scrollable-container">

<div class="content">
    <?php 
    // Suppress warnings and notices
    error_reporting(0);
    
    // Start output buffering
    ob_start(); 
    include 'receipt-text-preview.php'; // Include the PHP file
    $output = ob_get_clean(); // Get the buffered output and clean buffer
    
    // Restore error reporting
    error_reporting(E_ALL);
    
    // Check for errors in the output
    if (strpos($output, 'Undefined array key') === false) {
        // Display output if no error found
        echo $output;
    }
    ?>
</div>

            </div>
            </div>
        </div>

        
   
        <div class="bottom-payment2">
            

            <div class="bottom-page">
            <p>Page: 1/0</p>
            </div>
        </div>
        
<script>
    function previewTransaction(transactionId) {
    var transactions = <?php echo json_encode($_SESSION['transactions']); ?>;
    var transaction = transactions[transactionId];

    var previewSection = document.getElementById('previewSection');
    previewSection.innerHTML = '';

    if (transaction) {
        transaction.forEach(function(row) {
            var productReceipt = document.createElement('div');
            productReceipt.className = 'productReceipt';

            var columnReceipt1 = document.createElement('div');
            columnReceipt1.className = 'columnReceipt1';
            columnReceipt1.innerText = row['qty'] + '';

            var columnReceipt2 = document.createElement('div');
            columnReceipt2.className = 'columnReceipt2';
            columnReceipt2.innerHTML = row['upc'] + ' @ ' + row['srp'] + '<br>' + row['item'].substring(0, 20);

            var columnReceipt3 = document.createElement('div');
            columnReceipt3.className = 'columnReceipt3';
            columnReceipt3.innerHTML = '<p>' + Number(row['amount']).toFixed(2) + ' ' + row['type'] + '</p>';

            productReceipt.appendChild(columnReceipt1);
            productReceipt.appendChild(columnReceipt2);
            productReceipt.appendChild(columnReceipt3);

            previewSection.appendChild(productReceipt);
        });
    }
}
</script>
<script src="js/main.js"></script>
</body>
</html>
