<?php
    // Start a session
    session_start();
    // Check to make sure there was a proper submission
    if (isset($_POST['timestamp'])) {
        // Create a database connection
        include 'includes/dbh.inc.php';
        // Get the employee's id
        $eid = $_SESSION['e_id'];
        // Get the time the break ended. This will be a unix time
        $timestamp = $_POST['timestamp'];
        // // Set submitted to no
        // $submitted = 'no';
        // // Prepare a statement
        // $stmt = $conn->prepare("SELECT * FROM timeGeneral WHERE submitted=? AND emp_id=?");
        // // Set the variables that go into the statement
        // $stmt->bind_param('si', $submitted,$eid); // 's' specifies the variable type => 'string'
        // // Execute the statement
        // $stmt->execute();
        // // Go through the results
        // while ($row = $result->fetch_assoc()) {
        //     // Get the time id
        //     $time_id= $row['time_id'];
        // }
        // Set submitted to break
        $submitted = 'break';
        // Prepare a statement
        $stmt = $conn->prepare("UPDATE timeGeneral SET breakend=? WHERE submitted=? AND emp_id=?;");
        // Set the variables that go into the statement
        $stmt->bind_param('ssi',$timestamp, $submitted,$eid); // 's' specifies the variable type => 'string'
        // Execute the statement
        $stmt->execute();
        // Set submitted_done
        $submitted_done = 'breakdone';
        // Prepare a statement
        $stmt = $conn->prepare("UPDATE timeGeneral SET submitted=? WHERE submitted=? AND emp_id=?");
        // Set the variables that go into the statement
        $stmt->bind_param('ssi',$submitted_done, $submitted,$eid); // 's' specifies the variable type => 'string'
        // Execute the statement
        $stmt->execute();
    } else {
        // Send them back to home page
        header("Location: ./index.php");           
    }