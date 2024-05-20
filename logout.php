<?php

    session_start();
    unset($_SESSION['UserLogin']);
    unset($_SESSION['Access']);
    unset($_SESSION['search_results']); // Clear the search results
    echo header("Location: index.php");

?>