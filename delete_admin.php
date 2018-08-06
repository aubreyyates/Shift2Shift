<?php
    // Create the connection to the database
    include 'includes/dbh.inc.php';
    // Starts a session
    session_start();
    // Check to make sure it was submitted on page
    if(isset($_POST['admin_id']) && isset($_SESSION['u_id'])) {
        // Get today's date
        $date = date('Y-m-d');
        // Get the chosen project's id
        $admin_id = $_POST['admin_id'];
        // Get the org_id
        $org_id = $_SESSION['u_org_id'];
        // Set project to deleted
        $stmt = $conn->prepare("UPDATE users SET status = 'deleted' WHERE user_id=? AND org_id=?;");
        // Put variables into statement
        $stmt->bind_param("ii",$admin_id,$org_id);
        // Execute SQL
        $stmt->execute();
        // Set the date deleted
        $stmt = $conn->prepare("UPDATE users SET date_deleted = '$date' WHERE user_id=? AND org_id=?;");
        // Put variables into statement
        $stmt->bind_param("ii",$admin_id,$org_id);
        // Execute SQL
        $stmt->execute();
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }

