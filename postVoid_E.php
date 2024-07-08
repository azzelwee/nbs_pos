<?php
// PHP code to handle quantity input
if (!isset($_SESSION)) {
    session_start();
}

include_once("connections/connection.php");
$con = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $transaction_id = $_POST['transaction_id'];
    unset($_SESSION['transactions'][$transaction_id]);

    // Redirect to posRecall_E.php to refresh the list
    header('Location: postVoid_E.php');
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
            <h1>POST VOID</h1>
            </div>
        </div>

        <div class="grays2">
                    <div class="box" id="box1">
                        <img src="img/green-triangle-up.png" alt="Up">
                        <p>F11</p>
                    </div>

                    <div class="box" id="box2">
                        <img src="img/green-triangle-down.png" alt="Down">
                        <p>F12</p>
                    </div>

                    <div class="box">
                        <p>Help</p>
                        <p style="color: gray;">F1</span></p>
                    </div>

                        <div class="box">

                        </div>

                        <div class="boxLook" style="width: 2100px;">
                            
                        <label>Select Transaction:</label>
                        </div>
                   
                </div>

        <table class="products">
        <thead>
        <tr>
                <th>LN</th>
                <th>Date</th>
                <th>Reg No.</th>
                <th>Trx No.</th>
                <th>Clerk</th>
                <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $totalAmount = 0;
        $totalQty = 0;

        if (!empty($_SESSION['search_results'])) {
            foreach ($_SESSION['search_results'] as $row) {
                $totalAmount += $row['amount'];
                $totalQty += $row['qty'];
            }
        }

        setcookie('total_amount', $totalAmount, time() + (86400 * 30), "/");
        setcookie('totalQty', $totalQty, time() + 3600, "/");

        // Get the current date in mmddyyyy format
        $currentDate = date("m/d/Y");
        $currentDates = date("mdY");

        if (!empty($_SESSION['transactions'])) {
            foreach ($_SESSION['transactions'] as $transaction_id => $transaction) {
            echo "<tr>";

                echo "<td style='height: 25px; text-align: center;'>";
                echo "1";
                echo "</td>";

                echo "<td style='height: 25px; text-align: center;'>";
                echo $currentDate;
                echo "</td>";

                echo "<td style='height: 25px; text-align: center;'>";
                echo "<button type='button' class='delete-button' onclick='deleteTransaction(\"$transaction_id\")'>Delete</button>";
                echo "</td>";

                echo "<td style='height: 25px; text-align: center;'>";
                echo "" . $currentDates . $transaction_id;
                echo "</td>";

                echo "<td style='height: 25px; text-align: center;'>";
                echo "".$_SESSION['Name'];
                echo "</td>";

                echo "<td style='height: 25px; text-align: center;'>";
                echo "".$totalAmount;
                echo "</td>";

            echo "</tr>";
            }
        } else {
            // Display a row indicating no transactions are available
            echo "<tr>";
            echo "<td style='height: 25px; width: 500px; text-align: center;'>No transactions available.</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
        </tbody>
            
    </table>

    <form id="deleteForm" method="post" style="display: none;">
    <input type="hidden" name="transaction_id" id="deleteTransactionId">
    <input type="hidden" name="delete" value="1">
</form>
   
        <div class="bottom-payment2">
            
            <div class="bottom-buttons">
                <h3>OK</h3>
                <p>Alt+Enter</p>
            </div>

            <a href="posNextOption.php" id="altB">
            <div class="bottom-buttons">
                <h3>CANCEL</h3>
                <p style="color: black">Alt+B</p>
            </div>
            </a>

        </div>

        <script>

function deleteTransaction(transactionId) {
    if (confirm('Are you sure you want to delete this transaction?')) {
        var deleteForm = document.getElementById('deleteForm');
        var deleteTransactionId = document.getElementById('deleteTransactionId');
        deleteTransactionId.value = transactionId;
        deleteForm.submit();
    }
}

                 document.addEventListener('keydown', function(event) {
            if (event.altKey && event.keyCode === 66) { // Alt + B
                event.preventDefault();
                document.getElementById('altB').click();
            }
        });
        </script>

<script src="js/main.js"></script>
</body>
</html>
