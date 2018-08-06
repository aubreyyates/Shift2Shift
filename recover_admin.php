<?php
    // Start a session
    session_start();
    // Check to make sure an admin is signed in
    if ($_POST['recover'] && $_SESSION['u_id']) {
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // put the session project_id into $pid
        $org_id = $_SESSION['u_org_id'];
        // Get the time id
        $id = $_POST['id'];
        // Create a prepare statement
        $stmt = $conn->prepare("UPDATE users SET status = 'active' WHERE user_id =?;");
        // Put things into prepared statement
        $stmt->bind_param("i",$id);
        // Execute prepared statement
        $stmt->execute();

    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }