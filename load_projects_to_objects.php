<?php  
    // Start a session
    session_start();
    // Check to make sure an admin is signed in
    if ($_SESSION['u_id']) {
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // put the session project_id into $pid
        $org_id = $_SESSION['u_org_id'];
        // Set status
        $status = 'active';
        // Create a prepare statement
        $stmt = $conn->prepare("SELECT * FROM projects WHERE org_id=? and status=?;");
        // Put things into prepared statement
        $stmt->bind_param("is",$org_id,$status);
        // Execute prepared statement
        $stmt->execute();
        // Put the result into $result2
        $result = $stmt->get_result(); 
        // create an empty array
        $data = array();
        // Go through the results
        foreach($result as $row) { 
            // Fill the array
            $data[] = array(
                // Get the project id
                'id' => $row['project_id'], 
                // Get the employee date
                'date' => $row['date'],
                // Get the description
                'description' => $row['description'],
                // Get the project name
                'project_name' => $row['project_name'],
                // Get the job code
                'job_code' => $row['job_code']
            );
        }
        // return events in json
        echo json_encode($data);
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }