<?php

    // Start a session
    session_start();

    include_once 'check-authority.php';
    check_authority();

    //Check to make sure a proper submission was made
    if (isset($_SESSION['id']) && isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email']) && isset($_POST['id'])) {

        include_once 'config/init.php';

        $user = new User();

        $result = $user->updateUser($_POST['id'], $_POST['first'], $_POST['last'], $_POST['email'], $_SESSION['company_id']);

        echo $result;
        exit();

    } else {
        // Send them to the home page
        header("Location: ../../index.php");
        exit();
    }