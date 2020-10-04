<?php
    // Start a session
    session_start();
    // Check to see if an employee is signed in
    if (isset($_SESSION['id'])) {
        // Create a connection
        include_once 'database-connection.php';
        // Default submitted to no
        $submitted = 0;
        // Get the employee's id
        $id = $_SESSION['id'];

        $stmt = $conn->prepare("SELECT * FROM timestamps WHERE user_id=? AND submitted=?;");
        // Put variables into the statements
        $stmt->bind_param("ii",$id, $submitted);
        // Execute the SQL
        $stmt->execute();
        
        $time_for_clock = "no start";

        $result = $stmt->get_result(); 

        $resultCheck = mysqli_num_rows($result);

        $break_start = "no break";

        // Check if there were any results
        if ( $resultCheck > 0 ) {

            $total_break_time = 0;

            // Go through the results
            while ($row = $result->fetch_assoc()) {
                // Get the start time of the entry
                $timestamp_start = $row['timestamp_start'];
                
                $timestamp_length = $row['timestamp_length'];

                $timestamp_id = $row['id'];
            }

            $submitted = 1;

            $stmt = $conn->prepare("SELECT break_length FROM breaks WHERE user_id=? AND timestamp_id=? AND submitted=?;");
            // Put variables into the statements
            $stmt->bind_param("iii",$id, $timestamp_id, $submitted);
            // Execute the SQL
            $stmt->execute();

            $result_breaks = $stmt->get_result(); 

            // Go through the results
            while ($row_breaks = $result_breaks->fetch_assoc()) {

                $total_break_time += $row_breaks['break_length'];

            } 

            $submitted = 0;
            
            $stmt = $conn->prepare("SELECT break_start FROM breaks WHERE user_id=? AND timestamp_id=? AND submitted=?;");
            // Put variables into the statements
            $stmt->bind_param("iii",$id, $timestamp_id, $submitted);
            // Execute the SQL
            $stmt->execute();

            $result_breaks = $stmt->get_result(); 

            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck != 0) {
                // Go through the results
                while ($row_breaks = $result_breaks->fetch_assoc()) {

                    $break_start = $row_breaks['break_start'];

                }
            }


            $time_for_clock = $timestamp_start + $total_break_time;
            $total_clocked_time = "no break";

            if ($break_start != 'no break') {

                $timestamp = round(microtime(true) * 1000);
                $total_clocked_time = $timestamp - $time_for_clock - ($timestamp - $break_start);
                $time_for_clock += ($timestamp - $break_start);

            }

             
        }

        // Encode json to send back
        $json = json_encode(array('time_for_clock' => $time_for_clock, 'break_start' => $break_start, 'total_clocked_time' => $total_clocked_time));
        // Return the json
        echo $json;
        // Close the connection.
        mysqli_close($conn);

        exit();
        
    } else {
        // Send them to the home page
        header("Location: ../../index.php");
        exit();
    }

