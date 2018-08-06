<?php  
    // Start a session
    session_start();
    // Check to make sure a proper submit was done
    if (isset($_SESSION['project_id'])) {
        // Create database connection
        include 'includes/dbh.inc.php';
        // put the session project_id into $pid
        $pid = $_SESSION['project_id'];
        // Get the company id
        $org_id = $_SESSION['m_org_id'];
        // Prepare statement to assign project to manager
        $stmt = $conn->prepare("SELECT * FROM timeGeneral WHERE project_id=? AND emp_org_id=? AND status=?;");
        // Set active status
        $status = 'active';
        // Put the variables in
        $stmt->bind_param("iis", $pid, $org_id, $status);
        // Execute SQL
        $stmt->execute();
        // Put the result into $result
        $result = $stmt->get_result(); 
        // create an empty array
        $data = array();
        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get the employee id
            $emp_id = $row['emp_id'];
            // Prepare statement to assign project to manager
            $stmt = $conn->prepare("SELECT * FROM employees WHERE emp_id=?;");
            // Put the variables in
            $stmt->bind_param("i", $emp_id);
            // Execute SQL
            $stmt->execute();
            // Put the result into $result
            $result2 = $stmt->get_result(); 
            // Get the start time of the entry
            $start_time = $row['time_start'];
            // Get the end time of the entry
            $end_time = $row['time_end'];
            // Go through the results
            while ($row2 = $result2->fetch_assoc()) {
                // Get the first name
                $first = $row2['emp_first'];
                //Get the last name
                $last = $row2['emp_last'];
            }
            
            // Get the description
            $description = $row['des'];
        
            // Fill the array
            $data[] = array(
                // Get the entry id
                'id' => $row['time_id'], 
                // Get the employee first name
                'first' => $first,
                // Get the employee last name
                'last' => $last,
                // Get the employee date
                'date' => $row['date'],
                // Format the start time to a 12 hour clock hour and mintues
                'start' => date("g:i",$start_time),
                // Get the AM/PM of the start time
                'startdiem' => date("A",$start_time),
                // Format the end time to a 12 hour clock hour and mintues
                'end' => date("g:i",$end_time),
                // Get the AM/PM of the end time
                'enddiem' => date("A",$end_time),
                // Get the employee length 
                'time' => $row["time"],
                // Get the description
                'description' => $description
            );
        }
        // return events in json
        echo json_encode($data);
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }


