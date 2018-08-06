<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_POST['timestamp'])) {
        // Create a database connection
        include 'includes/dbh.inc.php';
        // Get the employee's id
        $eid = $_SESSION['e_id'];
        // Get the time of the end. It will be a unix time
        $timestamp = $_POST['timestamp'];
        // Get the length of the entry
        $time = $_POST['time'];
        // Prepare a statement
        $stmt = $conn->prepare("UPDATE timeGeneral SET time_end=? WHERE submitted=? AND emp_id =?;");
        // Set up submitted
        $submitted = 'no';
        // Set the variables that go into the statement
        $stmt->bind_param('ssi', $timestamp,$submitted,$eid); // 's' specifies the variable type => 'string'
        // Execute the statement
        $stmt->execute();
        // Prepare a statement
        $stmt = $conn->prepare("UPDATE timeGeneral SET time='$time' WHERE submitted='no' AND emp_id = '$eid';");
        // Set the variables that go into the statement
        $stmt->bind_param('ssi', $time,$submitted,$eid); // 's' specifies the variable type => 'string'
        // Execute the statement
        $stmt->execute();
        // Prepare a statement
        $stmt = $conn->prepare("UPDATE timeGeneral SET submitted='yes' WHERE submitted='no' AND emp_id = '$eid';");
        // Set up submitted
        $submitted_yes = 'yes';
        // Set the variables that go into the statement
        $stmt->bind_param('ssi', $submitted_yes,$submitted,$eid); // 's' specifies the variable type => 'string'
        // Execute the statement
        $stmt->execute();
    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }