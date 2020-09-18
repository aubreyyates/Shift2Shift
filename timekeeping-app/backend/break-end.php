<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was done
    if (isset($_SESSION['id'])) {
        // Create a connection
        include_once 'database-connection.php';
        // Set the submitted status as a break
        $not_submitted = 0;

        $submitted = 1;
        // Get the employee's id
        $id = $_SESSION['id'];
        // Get the time. This will be a unix time
        $timestamp = time();

        // Find the entry that hasn't been submitted
        $stmt = $conn->prepare("UPDATE breaks SET break_end=? WHERE submitted=? AND user_id=?;");
        // Put variables into the statements
        $stmt->bind_param("iii", $timestamp, $not_submitted, $id);
        // Execute the SQL
        $stmt->execute();

        // Find the entry that hasn't been submitted
        $stmt = $conn->prepare("UPDATE breaks SET submitted=? WHERE submitted=? AND user_id=?;");
        // Put variables into the statements
        $stmt->bind_param("iii",$submitted, $not_submitted, $id);
        // Execute the SQL
        $stmt->execute();

        // Close the connection.
        mysqli_close($conn);

        exit();

    } else {
        // Send them to the home page
        header("Location: ../../index.php");
        exit();     
    }