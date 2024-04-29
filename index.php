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
        echo header("Location: pos.php");
    } else {

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="whole-container">

    <div class="form-logo">
        <img src="img/nbslogo.png" alt="">
    </div>

    <div class= "gray">
    </div>

    <div class= "yellow">
    </div>

    <div class= "main-container">
    <h2>USER LOGIN</h2>
        <div class="login-container">
            <form action="posMain.php" method="post" id="">
                <div class="form-element">
                    <label>Enter Information</label>
                </div>
                <div class="form-element">
                    <label>UserName</label>
                    <input type="username" name="username" id="username">
                </div>

                <div class="form-element">
                    <label>Password</label>
                    <input type="password" name="password" id="password">
                </div>

                <button type="submit" name="login" class="btn-ok">Ok</button>
                <button type="submit" name="cancel" class="btn-cancel">Cancel</button>
            </form>
        </div>
    </div>

        <div class="info-container">
            <div class="info-text">
            <p>
                Press [F2] for Lookup </br>
                Press [F3] for Masterfile Updates</br>
                Press [F3] for Scandos</br>
                Press [F10] to Activate E-Gift Card
            </p>
            </div>
        </div>
</div>

    <!-- <script src="js/main.js"></script> -->
</body>
</html>