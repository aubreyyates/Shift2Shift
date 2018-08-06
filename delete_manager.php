<?php
    // Starts a session
    session_start();
    // Check to make sure it was submitted on page
    if(isset($_POST['manager_delete']) && isset($_SESSION['u_id'])) {
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // Get the chosen project's id
        $manager_id = $_SESSION['current_manager_id'];
        // Set status
        $status = 'deleted';
        // Create a prepare statement
        $stmt = $conn->prepare("UPDATE managers SET status=? WHERE manager_id=?;");
        // Put things into prepared statement
        $stmt->bind_param("si",$status,$manager_id);
        // Execute prepared statement
        $stmt->execute();
        // Set a session variable 
        $_SESSION['just_deleted_manager'] = 'true';
        // Create a prepare statement
        $stmt3 = $conn->prepare("DELETE FROM assignment_managers WHERE manager_id=? ;");
        // Put things into prepared statement
        $stmt3->bind_param("i",$manager_id);
        // Execute prepared statement
        $stmt3->execute(); 
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }