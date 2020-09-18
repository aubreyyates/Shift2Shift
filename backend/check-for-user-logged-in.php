<?php
    // Check if someone is signed in
    if (isset($_SESSION['u_id'])) {
        // if signed in, send them home.
        header('Location:index.php');

        exit;
    }