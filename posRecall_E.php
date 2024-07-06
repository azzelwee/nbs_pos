<?php
// PHP code to handle quantity input
if (!isset($_SESSION)) {
    session_start();
}

include_once("connections/connection.php");
$con = connection();


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
                <table>
                    <thead>
                        <tr>
                        <th>Transaction No.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td style="height: 25px; text-align: center;"></td>
                        </tr>
                        
                        <tr>
                        <td style="height: 25px; text-align: center;"></td>
                        </tr>
                        
                        <tr>
                        <td style="height: 25px; text-align: center;"></td>
                        </tr>
                        
                        <tr>
                        <td style="height: 25px; text-align: center;"></td>
                        </tr>
                        
                        <tr>
                        <td style="height: 25px; text-align: center;"></td>
                        </tr>
                        
                        <tr>
                        <td style="height: 25px; text-align: center;"></td>
                        </tr>
                        
                        <tr>
                        <td style="height: 25px; text-align: center;"></td>
                        </tr>
                        
                        <tr>
                        <td style="height: 25px; text-align: center;"></td>
                        </tr>
                        
                        <tr>
                        <td style="height: 25px; text-align: center;"></td>
                        </tr>
                        
                    </tbody>
                    </table>
                </div>

                <div class="reprint-buttons">
                    <div class="bottom-buttons2">
                        <h3>PRINT</h3>
                        <p>&lt;Alt-Enter&gt;</p>
                    </div>

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
            </div>

            <div class="right-reprint">
            <div class="scrollable-container">
                <div class="content">
                    <?php include 'receipt-text.php'; ?>
                 </div>
            </div>
            </div>
        </div>

        
   
        <div class="bottom-payment2">
            

            <div class="bottom-page">
            <p>Page: 1/0</p>
            </div>
        </div>
        

<script src="js/main.js"></script>
</body>
</html>
