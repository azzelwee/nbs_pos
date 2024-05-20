<?php
session_start();

// Store the session variables you want to keep
$userLogin = $_SESSION['UserLogin'];
$name = $_SESSION['Name'];
$trx = $_SESSION['Trx'];
$access = $_SESSION['Access'];

// Reset the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Start a new session and restore the variables
session_start();
$_SESSION['UserLogin'] = $userLogin;
$_SESSION['Name'] = $name;
$_SESSION['Trx'] = $trx;
$_SESSION['Access'] = $access;

// Redirect to posMain.php
header("Location: posMain.php");
exit();
?>
