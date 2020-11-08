<?php

// start a session
session_start();

include_once 'check-authority.php';
check_authority();

// Make sure all posts are set that are needed.
if (isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['authority_level'])) {

    include_once 'config/init.php';

    $user = new User();

    $result = $user->createUser($_POST['first'], $_POST['last'], $_POST['email'], $_POST['pwd'], $_POST['authority_level'], $_SESSION['company_id']);

    echo $result;
    exit();


} else {
    header("Location: ../../index.php");
    exit();
}