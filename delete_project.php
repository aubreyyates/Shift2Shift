<?php
    // Create the connection to the database
    include 'includes/dbh.inc.php';
    // Starts a session
    session_start();
    // Check to make sure it was submitted on page
    if(isset($_POST['project_delete']) && isset($_SESSION['u_id'])) {
        // Get today's date
        $date = date('Y-m-d');
        // Get the chosen project's id
        $project_id = $_SESSION['project_id'];
        // Get the org_id
        $org_id = $_SESSION['u_org_id'];
        // Set project to deleted
        $stmt = $conn->prepare("UPDATE projects SET status = 'deleted' WHERE project_id=? AND org_id=?;");
        // Put variables into statement
        $stmt->bind_param("ii",$project_id,$org_id);
        // Execute SQL
        $stmt->execute();
        // Set the date deleted
        $stmt = $conn->prepare("UPDATE projects SET date_deleted = '$date' WHERE project_id =? AND org_id =?;");
        // Put variables into statement
        $stmt->bind_param("ii",$project_id,$org_id);
        // Execute SQL
        $stmt->execute();
        // Set a session variable 
        $_SESSION['just_deleted'] = 'true';
        // Set the date deleted
        $stmt = $conn->prepare("DELETE FROM assignment_employees WHERE project_id=?;");
        // Put variables into statement
        $stmt->bind_param("i",$project_id);
        // Execute SQL
        $stmt->execute();
        // Set the date deleted
        $stmt = $conn->prepare("DELETE FROM assignment_managers WHERE project_id=?;");
        // Put variables into statement
        $stmt->bind_param("i",$project_id);
        // Execute SQL
        $stmt->execute();
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }

