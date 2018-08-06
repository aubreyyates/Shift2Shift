<?php  
    // Start a session
    session_start();
    // Check to make sure a proper submit was done
    if (isset($_SESSION['u_id'])) {
        // put the session project_id into $pid
        $eid = $_SESSION['current_emp_id'];
        // Create database connection
        include 'includes/dbh.inc.php';
        // put the session project_id into $pid
        $org_id = $_SESSION['u_org_id'];
        // Prepare statement to assign project to manager
        $stmt = $conn->prepare("SELECT * FROM timeGeneral WHERE emp_id=? AND emp_org_id=? AND status=?;");
        // Set active status
        $status = 'active';
        // Put the variables in
        $stmt->bind_param("iis", $eid, $org_id, $status);
        // Execute SQL
        $stmt->execute();
        // Put the result into $result
        $result = $stmt->get_result(); 
        // create an empty array
        $data = array();
        // Go through the results
        foreach($result as $row) { 
            // Get the project_id
            $project_id = $row['project_id'];
            // See if there was no project clocked to or not
            if (!$project_id == 0 ) {
                // Prepare statement to assign project to manager
                $stmt = $conn->prepare("SELECT * FROM projects WHERE project_id=? AND org_id=?;");
                // Put the variables in
                $stmt->bind_param("ii", $project_id, $org_id);
                // Execute SQL
                $stmt->execute();
                // Put the result into $result
                $result2 = $stmt->get_result();
                // Go through the results
                foreach($result2 as $row2) {
                    // Get the project name
                    $project_name = $row2['project_name'];
                }
            } else {
                // Set name to No Project
                $project_name = "---- No Project ----";
            }
            // Get the start time of the entry
            $start_time = $row['time_start'];
            // Get the end time of the entry
            $end_time = $row['time_end'];

            if ( $row['des'] != null ) {
                // Get the description
                $description = $row['des'];
            } else {
                // Set description to an empty string
                $description = '';
            }
            // Fill the array
            $data[] = array(
                // Get the entry id
                'id' => $row['time_id'], 
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
                // Get the project name
                'project_name' => $project_name,
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