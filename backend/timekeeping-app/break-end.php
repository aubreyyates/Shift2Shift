<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was done
    if (isset($_SESSION['id'])) {
        // Create a connection
        include_once 'database-connection.php';

        $not_submitted = 0;

        $submitted = 1;
        // Get the employee's id
        $id = $_SESSION['id'];
        // Get the time. This will be a unix time
        $timestamp = round(microtime(true) * 1000);

        $stmt = $conn->prepare("SELECT break_start, timestamp_id FROM breaks WHERE user_id=? AND submitted=?;");
        // Put variables into the statements
        $stmt->bind_param("ii", $id, $not_submitted);
        // Execute the SQL
        $stmt->execute();

        $result = $stmt->get_result(); 

        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get the start time of the entry
            $break_start = $row['break_start'];

            $timestamp_id = $row['timestamp_id'];
        }
        
        $break_length = $timestamp - $break_start;

        // Find the entry that hasn't been submitted
        $stmt = $conn->prepare("UPDATE breaks SET break_end=?, break_length=?, submitted=? WHERE submitted=? AND user_id=?;");
        // Put variables into the statements
        $stmt->bind_param("iiiii", $timestamp, $break_length, $submitted = 1, $not_submitted, $id);
        // Execute the SQL
        $stmt->execute();



        // Calculate and set $timestamp_length ---------------------

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

        $stmt = $conn->prepare("SELECT timestamp_start FROM timestamps WHERE user_id=? AND id=?;");
        // Put variables into the statements
        $stmt->bind_param("ii", $id, $timestamp_id);
        // Execute the SQL
        $stmt->execute();

        $result = $stmt->get_result(); 

        // Go through the results
        while ($row = $result->fetch_assoc()) {
            $timestamp_start = $row['timestamp_start'];
        }

        // Total timestamp length
        $timestamp_length = $timestamp - $timestamp_start - $break_length;

        $stmt = $conn->prepare("UPDATE timestamps SET timestamp_length=? WHERE user_id=? AND id=?;");
        // Put variables into the statements
        $stmt->bind_param("iii",$timestamp_length, $id, $timestamp_id);
        // Execute the SQL
        $stmt->execute();

        // Close the connection.
        mysqli_close($conn);

        // Fill data
        $data = array(

            'timestamp' => $timestamp,

            'timestamp_length' => $timestamp_length

        );

        // return data in json
        echo json_encode($data);

        exit();

    } else {
        // Send them to the home page
        header("Location: ../../index.php");
        exit();     
    }