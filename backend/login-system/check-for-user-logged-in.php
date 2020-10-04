<?php
    
    session_start();

    // Check if someone is signed in
    if (isset($_SESSION['id'])) {
        // if signed in, send them home.
        header('Location:index.php');
        
        exit;
    }

    