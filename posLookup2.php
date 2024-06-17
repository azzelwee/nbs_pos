<?php
// PHP code to handle quantity input
if (!isset($_SESSION)) {
    session_start();
}

include_once("connections/connection.php");
$con = connection();

// Fetch quantity input if specified, default to 1 if not provided
$quantity = isset($_GET['quantity']) ? (int)$_GET['quantity'] : 1;
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch new search results
$sql = "SELECT * FROM lookup_list WHERE sku = '$search' ORDER BY ln ASC";
$product = $con->query($sql) or die($con->error);
$results = $product->fetch_all(MYSQLI_ASSOC);


// Check if session variable for searches exists
if (!isset($_SESSION['search_results2'])) {
    $_SESSION['search_results2'] = [];
}

// Add new search results to the session variable
if ($results) {
    foreach ($results as &$result) {
        $result['qty'] = $quantity; // Add the specified quantity to each result
        $result['amount'] = $result['srp'] * $quantity; // Calculate the amount based on the quantity and SRP
    }
    $_SESSION['search_results2'] = array_merge($_SESSION['search_results2'], $results);
}

// Calculate the total amount
$totalAmount = 0;
if (!empty($_SESSION['search_results2'])) {
    foreach ($_SESSION['search_results2'] as $row) {
        $totalAmount += $row['amount'];
    }
}

$totalQty = 0;

if (!empty($_SESSION['search_results2'])) {
    foreach ($_SESSION['search_results2'] as $row) {
        $totalQty += $row['qty'];
    }
}

setcookie('total_amount', $totalAmount, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie('totalQty', $totalQty, time() + 3600, "/"); // The cookie expires in 1 hour

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
                <h2>LOOK UP SKU / BARCODE</h2>
                    <div class="in">
                    <p>[F1] Help</p>
                    <p>[F5] On-hand</p>
                    </div>
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

                    <div class="box" style="background-color: #fff36b;">
                        <p>SKU/</br>
                        BARCODE</br></p>
                        <p> <span class="highlight">F2</span></p>
                    </div>

                        <div class="box">
                            <p>Description</br></p>
                            <p class="highlight">F3</p>
                        </div>
                    

                    
                        <div class="box">
                            <p>Down</br>Payment</p>
                            <p class="highlight">F4</p>
                        </div>
                    

                        <div class="boxLook" style="width: 2100px;">
                            
                        <label>Look for:</label>
                        <form action="" method="get">
                            <input type="text" name="search" id="search">
                        </form>
                        </div>
                   
                </div>

        <table class="products">
        <thead>
        <tr >
            <th style="font-weight: bold; border-right: 1px solid white; font-size:22px;">SKU</th>
            <th style="font-weight: bold; border-right: 1px solid white; font-size:22px;">DESCRIPTION</th>
            <th style="font-weight: bold; border-right: 1px solid white; font-size:22px;">AUTHOR</th>
            <th style="font-weight: bold; border-right: 1px solid white; font-size:22px;">SRP</th>
            <th style="font-weight: bold; border-right: 1px solid white; font-size:22px;">PROMO</th>
        </tr>
        </thead>
        <tbody>
        <?php 
            if (!empty($_SESSION['search_results2'])) {
                $counter = count($_SESSION['search_results2']);
                foreach (array_reverse($_SESSION['search_results2']) as $row) {
            ?>
                <tr data-ln="<?php echo $row['ln']; ?>">    
                    <td class="centered"><?php echo $row['sku']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td class="centered"><?php echo $row['srp']; ?></td>
                    <td><?php echo $row['promo']; ?></td>
                </tr>
            <?php 
                }
            } 
        ?>
        </tbody>
            
    </table>
   
        <div class="bottom-payment2">
            
            <div class="bottom-buttons">
                <h3>OK</h3>
                <p>&lt;Alt-Enter&gt;</p>
            </div>

            <div class="bottom-buttons">
                <h3>PREV</h3>
                <p>&lt;Left-Arrow&gt;</p>
            </div>

            <div class="bottom-buttons">
                <h3>NEXT</h3>
                <p>&lt;Right-Arrow&gt;</p>
            </div>

            <a href="posResultDecoy.php" id="altB">
            <div class="bottom-buttons">
                <h3>CANCEL</h3>
                <p style="color: black;">&lt;Alt-B&gt;</p>
            </div>
            </a>

            <div class="bottom-page">
            <p>Page: 1/0</p>
            </div>
        </div>
        
        <script>

            // JavaScript to handle session clearing on page exit
window.addEventListener('beforeunload', function() {
    fetch('clear_session.php', {
        method: 'GET',
        keepalive: true // Ensures the request is sent even when the user navigates away
    });
});


function redirectToPosResult() {
            window.location.href = 'posLookup2.php';
        }

        // Check if the page is being refreshed
        if (performance.navigation.type === 1) {
            redirectToPosResult(); // Call the redirect function
        }

     document.addEventListener('keydown', function(event) {
            if (event.altKey && event.keyCode === 66) { // Alt + B
                event.preventDefault();
                document.getElementById('altB').click();
            }
        });

        document.addEventListener("keydown", (event) => {
            if (event.key === 'F11') {
                highlightRow('prev');
                event.preventDefault();
            } else if (event.key === 'F12') {
                highlightRow('next');
                event.preventDefault();
            }
            switch(event.keyCode) {
                case 113: // F2 key
                    event.preventDefault();
                    document.getElementById('f2').click();
                    break;
                case 114: // F3 key
                    event.preventDefault();
                    document.getElementById('f3').click();
                    break;
                case 115: 
                    event.preventDefault();
                    document.getElementById('f4').click();
                    break;

                case 27:
                    cancelButton.click();
                    document.getElementById('esc').click();
                    break;
                case 13:
                    okButton.click();
                    document.getElementById('enter').click();
                    break;
                
            }
    });
    </script>

<script src="js/main.js"></script>
</body>
</html>
