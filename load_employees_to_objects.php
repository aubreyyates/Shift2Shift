<?php  
    // Start a session
    session_start();
    // Check to make sure an admin is signed in
    if ($_SESSION['u_id']) {
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // put the session project_id into $pid
        $org_id = $_SESSION['u_org_id'];
        // Get all of the project entries
        $stmt = $conn->prepare("SELECT * FROM employees WHERE emp_org=? AND status=?;");
        // Set active
        $active = 'active';
        // Put variables in
        $stmt->bind_param("is", $org_id, $active);
        // Execute the statement
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
                'id' => $row['emp_id'], 
                // Get the manager's first name
                'first' => $row['emp_first'],
                // Get the manager's last name
                'last' => $row['emp_last'],
                // Get the project name
                'email' => $row['emp_email']
            );
        }
        // return events in json
        echo json_encode($data);
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }