<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM pos_users WHERE
    username = '$username' AND password = '$password'";
    $user = $con->query($sql) or die ($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    if($total > 0){
        $_SESSION['UserLogin'] = $row['username'];
        $_SESSION['Name'] = $row['name'];
        $_SESSION['Trx'] = $row['trx'];
        $_SESSION['Access'] = $row['access'];
        echo header("Location: posSalesJournal_E.php");
    } else {
        echo "<div class='message-warning'> <p>Access Denied!</p>
        <div class='closePopers'>
            <button class='popup-closed' onclick='closePopups()'>OK</button>
            </div>
        </div>";
    }
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
            </div>


        <div class= "main-container1">
            <h2>MANAGER OVERRIDE</h2>
            <div class="center-container4">
            <form action="" method="post" id="">
            
            <p>Sorry, you dont have permission to do this
            </br>operation. Please perform Manager Override.
            </p>

            <div class="form-element">
                    <label>Username</label>
                    <input type="username" name="username" id="username">
                </div>

                <div class="form-element">
                    <label>Password</label>
                    <input type="password" name="password" id="password">
                </div>
      
                    <button type="submit" name="login" class="btn-ok5">Yes</button>
                    <button type="button" name="cancelButtons" class="btn-cancel5" onclick="window.location.href = 'posResultDecoy.php';">No</button>
       
            </form>
            </div>
    </div>
   
        <div class="bottom-payment">
            
        </div>

<script src="js/main.js"></script>
</body>
</html>
