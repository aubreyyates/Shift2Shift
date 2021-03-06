<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was done
    if (isset($_SESSION['id'])) {
        // Create a connection
        require_once 'database-connection.php';
        // Start submitted to no because they haven't clocked out yet
        $submitted = 0;
        // Get the employee's id
        $id = $_SESSION['id']; 
        // Get the time of the start. It will be a unix time
        $timestamp = microtime(true) * 1000;
        // Find if entry that has been not submitted.
        $stmt = $conn->prepare("SELECT * FROM timestamps WHERE user_id=? AND submitted=?;");
        // Put variables into the statements
        $stmt->bind_param("ii",$id, $submitted);
        // Execute the SQL
        $stmt->execute();

        $result = $stmt->get_result();        
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck != 0) {
            // Close the connection
            mysqli_close($conn);
            echo "Error. A timestamp has still not been submitted before.";
            exit();
        }

        // Get the project it is clocked for
        $project_id = -1;
        // Get the company id 
        $company_id = $_SESSION['company_id'];
        // Prepare a statement
        $stmt = $conn->prepare("INSERT INTO timestamps (timestamp_start, user_id, company_id, project_id, submitted) VALUES (?,?,?,?,?);");
        // Set the variables that go into the statement
        $stmt->bind_param('iiiii', $timestamp, $id, $company_id, $project_id, $submitted);
        // Execute the statement
        $stmt->execute(); 
        // Close the connection
        mysqli_close($conn);
        // Return the time that they clocked in
        
        $calibration = $_POST['calibration'];

        $calibration = $timestamp - $calibration;

        $json = json_encode(array('timestamp' => sprintf('%f', $timestamp), 'calibration' => $calibration));

        echo $json;

        exit();
    } else {
        // Send them back to home page
        header("Location: ../../index.php");
        exit();
    }


