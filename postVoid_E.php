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
        <tr >
                <th>LN</th>
                <th>Date</th>
                <th>Reg No.</th>
                <th>Trx No.</th>
                <th>Clerk</th>
                <th>Total</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
            
    </table>
   
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
