<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();
$sql = "SELECT * FROM product_list";
$product = $con->query($sql) or die ($con->error);


// Calculate the total amount
$totalAmount = 0;
if (!empty($_SESSION['search_results'])) {
    foreach ($_SESSION['search_results'] as $row) {
        $totalAmount += $row['amount'];
    }
}

$totalQty = 0;

if (!empty($_SESSION['search_results'])) {
    foreach ($_SESSION['search_results'] as $row) {
        $totalQty += $row['qty'];
    }
}

setcookie('total_amount', $totalAmount, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie('total_amount', $totalAmount, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Point of Sale</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="note-info-index">
    Note:
    </br>
    Scan UCP </br>
    1-30
    </br>
</div>
<a href="logout.php" class="logout">
        Logout
    </a>
<div class="whole-container">

    <div class="form-logo">
        <img src="img/nbslogo.png" alt="">
    </div>

    <?php include 'header.php'; ?>

    <div class="e">
    <div class="column-3">
            <div class="reds">

            <a href="#" id="popupButton">
                <div class="popup-button" id="f3">
                    <p>Quantity</p>
                    <p><span class="popup-highlight">F3</span></p>
                </div>
            </a>
            
                <a href="posPayment.php" id="f4">
                    <div class="button">
                    <p>Payment</p>
                    <p> <span class="highlight">F4</span></p>
                    </div>
                </a>

                <a href="posOption2.php" id="f5">
                    <div class="button">
                    <p>Option</p>
                    <p> <span class="highlight">F5</span></p>
                    </div>
                </a>

                <a href="posNonMdse2.php" id="f6">
                    <div class="button">
                    <p>Non Mdse</p>
                    <p> <span class="highlight">F6</span></p>
                    </div>
                </a>

                <a href="posItemVoid2.php" id="f7">
                    <div class="button">
                    <p>Item Void</p>
                    <p> <span class="highlight">F7</span></p>
                    </div>
                </a>

               
                <a href="posTrxVoid2.php" id="f8">
                <div class="button">
                <p>Trx Void</p>
                <p> <span class="highlight">F8</span></p>
                </div>
                </a>


                <a href="posSuspend2.php" id="f9">
                    <div class="button">
                    <p>Suspend</p>
                    <p> <span class="highlight">F9</span></p>
                    </div>
                </a>

                <div class="button2" style = "width: 120px; height: 50px;">
                <p>Page: 1/1</p>
                </div>
            </div>
        </div>
    </div>

    <div class="outer-container">
        <div class="container">
            <div class="column-1">
            <div class="scan">
                <div class="scan-element">
                    <label>Scan or Enter UPC</label>
                    <form action="posResult.php" method="get">
                        <input type="text" name="search" id="search">
                        <input type="hidden" name="quantity" id="quantityHidden">
                        <input type="submit" name="submit" style="display: none">
                    </form>
                </div>
            </div>

            <div id="popup" class="popup">
                <div class="popup-content">
                    <span class="close">&times;</span>
                    <p>Please Enter Quantity</p>
                    <input type="number" id="quantityInput">
                </div>

                <div class="popup-buttons">
                    <button id="cancelButton">Cancel</button>
                    <button id="okButton">OK</button>
                </div>
            </div>

                <div class="grays">
                    <div class="box" id="box1">
                        <img src="img/green-triangle-up.png" alt="Up">
                        <p>F11</p>
                    </div>

                    <div class="box" id="box2">
                        <img src="img/green-triangle-down.png" alt="Down">
                        <p>F12</p>
                    </div>


                    <div class="box">
                        <p id="status">CSA</br>
                        ON/OFF</br></p>
                        <p> <span class="highlight">F10</span></p>
                    </div>

                    <a href="posLookup2.php" id="f2">
                        <div class="box">
                        <p style="color: black;">Lookup</br></p>
                        <p> <span class="highlight">F2</span></p>
                    </a>
                        </div>

                </div>

            </div>  
            
                <div class="column-2">
                <p> <span style="color: rgb(47, 241, 255);">Subtotal:</span></p>
                    <p> <span class="qty">Quantity:</span></p>
                    <p> <span style="color: rgb(85, 255, 85);">Unit Price:</span> 
                    
                    <div class="unity">
                        <div class="sub">
                        <?php
                            if (isset($row['srp']) && !empty($row['srp'])) {
                                echo $row['srp'];
                            } else {
                                echo '0.00';
                            }
                        ?>

                        </div>
                        <div class="qtyy">
                        <?php
                            if (isset($row['qty']) && !empty($row['qty'])) {
                                echo $row['qty'];
                            } else {
                                echo '0';
                            }
                        ?>
                        </div>
                    </div>

            <!-- Display total amount -->
                    <div class="price">
                    <?php
                    if (isset($row['amount']) && !empty($row['amount'])) {
                        echo number_format($row['amount'], 2);
                    } else {
                        echo '0.00';
                    }
                    ?>
                </div>
            </div>     
    </div>

    
    <div class="scrollable-table-container">
    <table class="products">
        <thead>
            <tr>
                <th>LN</th>
                <th>UPC</th>
                <th>Description</th>
                <th>Qty</th>
                <th>SRP</th>
                <th>Amount</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
        <?php 
    if (!empty($_SESSION['search_results'])) {
        $counter = count($_SESSION['search_results']);
        foreach (array_reverse($_SESSION['search_results']) as $row) {
            // Check if quantity is negative
            $quantity = (float) $row['qty']; // Convert qty to float for safe comparison
            $row_class = ($quantity < 0) ? 'negative-qty' : '';

            // Output table row with appropriate class
?>
            <tr class="<?php echo $row_class; ?>" data-ln="<?php echo $row['ln']; ?>">
                <td class="centered"><?php echo $counter--; ?></td>
                <td class="centered"><?php echo $row['upc']; ?></td>
                <td><?php echo $row['item']; ?></td>
                <td class="centered qty"><?php echo $quantity; ?></td>
                <td class="centered"><?php echo $row['srp']; ?></td>
                <td class="centered"><?php echo number_format($row['amount'], 2); ?></td>
                <td class="centered"><?php echo $row['type']; ?></td>
            </tr>
<?php
        }
    }
?>
        </tbody>
    </table>

    <div class="bottom">
        <div class="bottom-1">
            <p>Total Qty</p>
                <div class="bar1">
                <?php
                    echo $totalQty;
                    ?>
                </div>

        </div>
        
        <div class="bottom-2">
            <p>Total Sales:</p>
                <div class="bar2">
                <?php echo number_format($totalAmount, 2);?>
                </div>
        </div>
        <div class="bottom-3">
        <p><span id="date"></span>  &nbsp;&nbsp;&nbsp; <span id="time"></span></p>
        </div>
    </div>

    <script>

window.onload = function() {
    document.body.style.zoom = "85%";
};


function getFormattedDate(date) {
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
    return year + '-' + months[monthIndex] + '-' + (day < 10 ? '0' : '') + day;
}

function updateTime() {
    var currentDate = new Date();
    var dateElement = document.getElementById("date");
    var timeElement = document.getElementById("time");

    // Get the formatted date
    var formattedDate = getFormattedDate(currentDate);

    // Update the date and time elements
    dateElement.innerHTML = formattedDate;
    timeElement.innerHTML = currentDate.toLocaleTimeString();
}

// Update time every second
setInterval(updateTime, 100);

function search() {
    let searchTerm = $('#searchInput').val();
    
    $.ajax({
        url: 'search.php',
        type: 'POST',
        data: { searchTerm: searchTerm },
        success: function(response) {
            $('#resultsBody').html(response);
        }
    });
}

function submitForm() {
    setTimeout(function() {
        document.getElementById("myForm").submit();
    }, 4000); // 5000 milliseconds = 5 seconds
}

// Call the submitForm function when the page loads
window.onload = submitForm;

    function closePopups() {
        // Find the closest parent element that represents the popup and hide or remove it
        var popup = document.querySelector('.message-warning');
        if (popup) {
            popup.style.display = 'none'; // or remove() if you want to completely remove it from the DOM
        }
    }

document.addEventListener('DOMContentLoaded', (event) => {
    var popupButton = document.getElementById('popupButton');
    var popup = document.getElementById('popup');
    var close = document.getElementsByClassName('close')[0];
    var okButton = document.getElementById('okButton');
    var cancelButton = document.getElementById('cancelButton');
    var quantityInput = document.getElementById('quantityInput');
    var quantityHidden = document.getElementById('quantityHidden');
    var searchForm = document.querySelector('form[action="posResult.php"]');

    popupButton.onclick = function() {
        popup.style.display = "block";
    }

    close.onclick = function() {
        popup.style.display = "none";
    }

    cancelButton.onclick = function() {
        popup.style.display = "none";
    }

    okButton.onclick = function() {
        quantityHidden.value = quantityInput.value || 1; // Set quantityHidden to input value or default to 1
        popup.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == popup) {
            popup.style.display = "none";
        }
    }

    searchForm.onsubmit = function() {
        if (!quantityHidden.value) {
            quantityHidden.value = 1; // Default quantity if not set
        }
    }
});



// No Product Found
function showNoProductPopup() {
    const popupOverlay = document.getElementById('popup-overlay-custom');
    popupOverlay.style.display = 'flex';
}

function closePopup() {
    const popupOverlay = document.getElementById('popup-overlay-custom');
    popupOverlay.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
    const noProductTrigger = document.getElementById('no-product-popup-trigger');
    if (noProductTrigger) {
        showNoProductPopup();
        // Remove the trigger element after showing the popup to reset state
        noProductTrigger.parentNode.removeChild(noProductTrigger);
    }
});

let currentIndex = -1;
const rows = document.querySelectorAll(".products tbody tr, .products2 tbody tr");

// Automatically highlight the first row if it exists
if (rows.length > 1) {
    currentIndex = 1;
    rows[currentIndex].classList.add("row-highlight");
}

// Define a function to handle the keydown event
// Function to handle row highlighting
function highlightRow(direction) {
    if (direction === 'prev' && currentIndex > 0) {
        rows[currentIndex].classList.remove("row-highlight");
        currentIndex--;
        rows[currentIndex].classList.add("row-highlight");
    } else if (direction === 'next' && currentIndex < rows.length - 1) {
        if (currentIndex >= 0) {
            rows[currentIndex].classList.remove("row-highlight");
        }
        currentIndex++;
        rows[currentIndex].classList.add("row-highlight");
    }
}

// Click event listeners for box1 and box2
document.getElementById("box1").addEventListener("click", () => {
    highlightRow('prev');
});

document.getElementById("box2").addEventListener("click", () => {
    highlightRow('next');
});








        

    document.addEventListener("DOMContentLoaded", function() {
        var statusParagraph = document.getElementById("status");

        document.addEventListener("keydown", function(event) {
            if (event.key === "F10") {
                event.preventDefault();
                // Toggle the status text
                if (statusParagraph.innerHTML.includes("ON")) {
                    statusParagraph.innerHTML = "CSA</br>OFF</br>";
                } else {
                    statusParagraph.innerHTML = "CSA</br>ON/OFF</br>";
                }
            }
        });
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
                case 112: // F1 key
                    event.preventDefault();
                    document.getElementById('f1').click();
                    break;
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
                case 116: 
                    event.preventDefault();
                    document.getElementById('f5').click();
                    break;
                case 117: 
                    event.preventDefault();
                    document.getElementById('f6').click();
                    break;
                case 118: 
                    event.preventDefault();
                    document.getElementById('f7').click();
                    break;
                case 119: 
                    event.preventDefault();
                    document.getElementById('f8').click();
                    break;
                case 120: 
                    event.preventDefault();
                    document.getElementById('f9').click();
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
    
</body>
</html>
