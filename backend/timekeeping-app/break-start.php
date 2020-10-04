<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was done
    if (isset($_SESSION['id'])) {
        // Create a connection
        include_once 'database-connection.php';
        // Set the submitted status as a break
        $submitted = 0;
        // Get the employee's id
        $id = $_SESSION['id'];
        // Get the time of the start of the break. This will be a unix time
        $timestamp = microtime(true) * 1000;

        // Find if any break has been not submitted.
        $stmt = $conn->prepare("SELECT * FROM breaks WHERE user_id=? AND submitted=?;");
        // Put variables into the statements
        $stmt->bind_param("ii",$id, $submitted);
        // Execute the SQL
        $stmt->execute();

        $result = $stmt->get_result();        
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck != 0) {
            // Close the connection
            mysqli_close($conn);
            echo "Error. A break has still not been submitted before.";
            exit();
        }



        // Find the entry that hasn't been submitted
        $stmt = $conn->prepare("SELECT * FROM timestamps WHERE user_id=? AND submitted=?;");
        // Put variables into the statements
        $stmt->bind_param("ii",$id, $submitted);
        // Execute the SQL
        $stmt->execute();

        $result = $stmt->get_result();        
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck != 1) {
            // Close the connection
            mysqli_close($conn);
            echo "Error. Clocked in timestamps is not equal to one.";
            exit();
        }

        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get the start of the timestamp
            $timestamp_start = $row['timestamp_start'];
            // Get the entry time id that hasn't been submitted
            $timestamp_id= $row['id'];
        }





        

    
        $company_id = $_SESSION['company_id'];
        
        $stmt = $conn->prepare("INSERT INTO breaks (break_start, timestamp_id, user_id, company_id, submitted) VALUES (?,?,?,?,?);");
        // Put variables in
        $stmt->bind_param("iiiii", $timestamp, $timestamp_id, $id, $company_id, $submitted);
        // Execute the statement
        $stmt->execute();
        // Close the connection.
        mysqli_close($conn);
        // Send back time break was started.
        echo sprintf('%f', $timestamp);

        

        

        exit();
    } else {
        // Send them to the home page
        header("Location: ../../index.php");
        exit();     
    }