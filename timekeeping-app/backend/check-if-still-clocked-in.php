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
        // Get the company id
        // $org_id = $_SESSION['e_org_id'];
        // Default total break time to 0
        // $total_break_time = 0;
        // // Default them to not on a break
        // $on_break = 'no';
        // Find the entry that hasn't been submitted yet if there is one
        //Insert the user into the database
        $stmt = $conn->prepare("SELECT * FROM timestamps WHERE user_id=? AND submitted=?;");
        // Put variables into the statements
        $stmt->bind_param("ii",$id, $submitted);
        // Execute the SQL
        $stmt->execute();
        // Default time start to no start. No start means that they were not clocked in before the page loaded.
        $time_start = "no start";

        $result = $stmt->get_result();        
        $resultCheck = mysqli_num_rows($result);

        // Check if there were any results
        if ( $resultCheck > 0 ) {
            // Go through the results
            while ($row = $result->fetch_assoc()) {
                // // Get the project id of the entry
                // $previous_project = $row['project_id'];
                // Get the start time of the entry
                $time_start = $row['timestamp_start'];
                // // Get the time id of the entry
                // $time_id = $row['time_id'];
            }
            // // Get the unfinished breaks associated with this entry
            // $sql = "SELECT * FROM projects WHERE project_id = '$previous_project' AND org_id = '$org_id';";
            // // Put the results into $result
            // $result = mysqli_query($conn, $sql);
            // // Go through the result
            // while ($row = $result->fetch_assoc()) {
            //     // Get the project name
            //     $project_name = $row['project_name'];
            // }
            // // Find all of the finished breaks associated with this entry
            // $sql = "SELECT * FROM timeGeneral WHERE submitted = 'breakdone' AND emp_id = '$eid' AND break_id = '$time_id';";
            // // Put the result into $result
            // $result = mysqli_query($conn, $sql);
            // // Go through the result
            // while ($row = $result->fetch_assoc()) {
            //     // Find the start of the break
            //     $breakstart = $row['breakstart'];
            //     // Find the end of the break
            //     $breakend = $row['breakend'];
            //     // Add the time of the break to the total break time
            //     $total_break_time += ($breakend - $breakstart);
            // }
            // // Get the unfinished breaks associated with this entry
            // $sql = "SELECT * FROM timeGeneral WHERE submitted = 'break' AND emp_id = '$eid' AND break_id = '$time_id';";
            // // Put the results into $result
            // $result = mysqli_query($conn, $sql);
            // // Get the number of results
            // $resultCheck = mysqli_num_rows($result);
            // // Check if there were any results
            // if ( $resultCheck > 0 ) {
            //     // Go through the results
            //     while ($row = $result->fetch_assoc()) {
            //         // Get the start of the break
            //         $breakstart = $row['breakstart'];
            //         // Get the time now
            //         $time_now = time();
            //         // Add the time from the start to now to total break time
            //         $total_break_time += ($time_now - $breakstart);
            //     }
            //     // Set on break to yes
            //     $on_break = 'yes';
            // }
            // // Add total break time to time start
            // $time_start += $total_break_time;
        }
        // Encode json to send back
        $json = json_encode(array('time_start' => $time_start));
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


