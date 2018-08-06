<?php  
    // Start a session
    session_start();
    // Check to make sure an admin is signed in
    if ($_SESSION['u_id']) {
        // Create database connection
        include 'includes/dbh.inc.php';
        // put the session project_id into $pid
        $org_id = $_SESSION['u_org_id'];
        // Prepare statement to assign project to manager
        $stmt = $conn->prepare("SELECT * FROM managers WHERE manager_org_id=? and status=?;");
        // Set active status
        $status = 'active';
        // Put the variables in
        $stmt->bind_param("is", $org_id, $status);
        // Execute SQL
        $stmt->execute();
        // Put the result into $result
        $result = $stmt->get_result(); 
        // create an empty array
        $data = array();
        // Go through the results
        foreach($result as $row) { 
            // Fill the array
            $data[] = array(
                // Get the manager id
                'id' => $row['manager_id'], 
                // Get the manager's first name
                'first' => $row['manager_first'],
                // Get the manager's last name
                'last' => $row['manager_last'],
                // Get the project name
                'email' => $row['manager_email']
            );
        }
        // return events in json
        echo json_encode($data);
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }