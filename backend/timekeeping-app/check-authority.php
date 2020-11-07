<?php
    function check_authority($level=2) {
        if ($_SESSION['authority_level'] < $level) {
            header("Location: ../../index.php");
            exit();
        } 
    }