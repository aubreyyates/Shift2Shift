<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_POST['project'])) {
        // Connect to the database
        include 'includes/dbh.inc.php';
        // Get the project id of the project being deassigned
        $project = mysqli_real_escape_string($conn, $_POST['project']);
        // Get the manager id
        $manager_id = $_SESSION['current_manager_id'];
        // Deassign that project from that manager
        $stmt = $conn->prepare("DELETE FROM assignment_managers WHERE project_id=? AND manager_id =?;");
        // Put things into prepared statement
        $stmt->bind_param("ii",$project,$manager_id);
        // Execute prepared statement
        $stmt->execute();
        // Send them back to the select_manager page to view a specific manager
        header("Location: ./select_manager.php");
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }


