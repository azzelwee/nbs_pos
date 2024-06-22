<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();
$sql = "SELECT * FROM product_list";
$product = $con->query($sql) or die ($con->error);
$row = $product->fetch_assoc();


?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

                <div class="button" style="background-color: red; color: white;">
                <p>Payment</p>
                <p> <span class="highlight">F4</span></p>
                </div>
                
                <a href="posOption.php" id="f5">
                    <div class="button">
                    <p>Option</p>
                    <p> <span class="highlight">F5</span></p>
                    </div>
                </a>

                <a href="posNonMdse.php" id="f6">
                    <div class="button">
                    <p>Non Mdse</p>
                    <p> <span class="highlight">F6</span></p>
                    </div>
                </a>

                <div class="button" style="background-color: red; color: white;">
                <p>Item Void</p>
                <p> <span class="highlight">F7</span></p>
                </div>
                
                <div class="button" style="background-color: red; color: white;">
                <p>Trx Void</p>
                <p> <span class="highlight">F8</span></p>
                </div>

                <div class="button" style="background-color: red; color: white;">
                <p>Suspend</p>
                <p> <span class="highlight">F9</span></p>
                </div>
                <div class="button2" style = "width: 120px; height: 50px;">
                <p>Page: 0/0</p>
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

                <div class="grays">
                    <div class="box" id="f11">
                        <img src="img/green-triangle-up.png" alt="Triangle">
                        <p>F11</p>
                    </div>

                    <div class="box">
                        <img src="img/green-triangle-down.png">
                        <p>F12</p>
                    </div>

                    <div class="box" id="f10">
                        <p id="status">CSA</br>ON/OFF</br></p>
                        <p> <span class="highlight">F10</span></p>
                    </div>


                    <a href="posLookup.php" id="f2">
                    <div class="box">
                        <p>Lookup</br></p>
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
                            0.00 
                    </div>
                    <div class="qtyy">
                            0
                    </div>
</div>
                    <div class="price">
                            0.00
                    </div>
            </div> 



            <!-- <div class="thelefty">
                asd
            </div> -->          
    </div>



    <table>
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
            ?>
                <tr data-ln="<?php echo $row['ln']; ?>">
                    <td class="centered"><?php echo $counter--; ?></td>
                    <td class="centered"><?php echo $row['upc']; ?></td>
                    <td><?php echo $row['item']; ?></td>
                    <td class="centered qty"><?php echo $row['qty']; ?></td>
                    <td class="centered"><?php echo $row['srp']; ?></td>
                    <td class="centered"><?php echo $row['amount']; ?></td>
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
                    0
                </div>

        </div>
        
        <div class="bottom-2">
            <p>Total Sales:</p>
                <div class="bar2">
                        0.00
                </div>
        </div>
        <div class="bottom-3">
        <p><span id="date"></span>  &nbsp;&nbsp;&nbsp; <span id="time"></span></p>
        </div>
    </div>
    <script>
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
                case 115: // F4 key
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
<script src="js/main.js"></script>
</body>
</html>
