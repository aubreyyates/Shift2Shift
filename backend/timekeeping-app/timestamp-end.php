<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_SESSION['id'])) {

        // Create a connection
        include_once 'database-connection.php';
        // Get the employee's id
        $id = $_SESSION['id']; 
        // Set not submitted.
        $not_submitted = 0;
        // Set submitted.
        $submitted = 1;
        // Get the time of the end. It will be a unix time
        $timestamp = microtime(true) * 1000;

        $stmt = $conn->prepare("SELECT id, timestamp_start FROM timestamps WHERE user_id=? AND submitted=?;");
        // Put variables into the statements
        $stmt->bind_param("ii", $id, $not_submitted);
        // Execute the SQL
        $stmt->execute();

        $result = $stmt->get_result(); 

        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get id
            $timestamp_id = $row['id'];
            // Get start
            $timestamp_start = $row['timestamp_start'];
        }

        $stmt = $conn->prepare("SELECT break_length FROM breaks WHERE user_id=? AND timestamp_id=?;");
        // Put variables into the statements
        $stmt->bind_param("ii", $id, $timestamp_id);
        // Execute the SQL
        $stmt->execute();

        $result = $stmt->get_result(); 

        $break_length = 0;

        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get length of entry
            $break_length += $row['break_length'];
        }
        // Total timestamp length
        $timestamp_length = $timestamp - $timestamp_start - $break_length;
        
        // Prepare statement
        $stmt = $conn->prepare("UPDATE timestamps SET timestamp_end=?, timestamp_length=?, submitted=? WHERE submitted=? AND user_id=?;");
        // Set the variables that go into the statement
        $stmt->bind_param('iiiii', $timestamp, $timestamp_length, $submitted, $not_submitted, $id);
        // Execute the statement
        $stmt->execute();
        // Close the connection
        mysqli_close($conn);
        // Send back the clock out time.
        echo sprintf('%f', $timestamp);

        exit();
    } else {
        // Send them back to home page
        header("Location: ../../index.php");
        exit();
    }