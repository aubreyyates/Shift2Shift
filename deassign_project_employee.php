<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_POST['id']) && isset($_SESSION['u_id'])) {
        // Connect to the database
        include 'includes/dbh.inc.php';
        // Get the project id of the project being deassigned
        $id = $_POST['id'];
        // Get the manager id
        $manager_id = $_SESSION['current_emp_id'];
        // Prepare statement to delete the assignment
        $stmt = $conn->prepare("DELETE FROM assignment_employees WHERE emp_id =? AND project_id =?;");
        // Put the variables in
        $stmt->bind_param("ii", $manager_id, $id);
        // Execute SQL
        $stmt->execute();
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }


