<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_SESSION['id'])) {

        // Create a connection
        include_once 'database-connection.php';
        // Get the employee's id
        $id = $_SESSION['id']; 
        // Get the time of the end. It will be a unix time
        $timestamp = time();
        // Prepare statement
        $stmt = $conn->prepare("UPDATE timestamps SET timestamp_end=? WHERE submitted=? AND user_id=?;");
        // Set not submitted.
        $not_submitted = 0;
        // Set submitted.
        $submitted = 1;
        // Set the variables that go into the statement
        $stmt->bind_param('iii', $timestamp, $not_submitted, $id);
        // Execute the statement
        $stmt->execute();
        // Prepare a statement
        $stmt = $conn->prepare("UPDATE timestamps SET submitted=? WHERE submitted=? AND user_id=?;");
        // Set the variables that go into the statement
        $stmt->bind_param('iii', $submitted, $not_submitted, $id); // 's' specifies the variable type => 'string'
        // Execute the statement
        $stmt->execute();
        // Close the connection
        mysqli_close($conn);

        exit();
    } else {
        // Send them back to home page
        header("Location: ../../index.php");
        exit();
    }