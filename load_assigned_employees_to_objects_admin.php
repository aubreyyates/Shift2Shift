<?php  
    // Start a session
    session_start();
    // Check to make sure an admin is signed in
    if ($_SESSION['u_id']) {
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // put the session project_id into $pid
        $org_id = $_SESSION['u_org_id'];
        // put the session project_id into $pid
        $m_id = $_SESSION['current_manager_id'];
        // Get all of the project entries
        $stmt = $conn->prepare("SELECT * FROM assignment_managers WHERE manager_id=?;");
        // Put variables in
        $stmt->bind_param("i", $m_id);
        // Execute the statement
        $stmt->execute();
        // Put the result into $result
        $result = $stmt->get_result(); 
        // create an empty array
        $data = array();
        // Go through the results
        foreach($result as $row) { 
            // Get the assigned project
            $emp_id = $row['emp_id'];
            // Check if there is a project in this row
            if ($emp_id != '') {
                // Get all of the project entries
                $stmt = $conn->prepare("SELECT * FROM employees WHERE emp_org=? AND status = 'active' AND emp_id=?;");
                // Put variables in
                $stmt->bind_param("ii", $org_id,$emp_id);
                // Execute the statement
                $stmt->execute();
                // Put the result into $result2
                $result2 = $stmt->get_result(); 
                // Go through the results
                foreach($result2 as $row2) { 
                    // Fill the array
                    $data[] = array(
                        // Get the employee id
                        'id' => $row2['emp_id'], 
                        // Get the employee first name
                        'first' => $row2['emp_first'],
                        // Get the employee last name
                        'last' => $row2['emp_last'],
                        // Get the employee email
                        'email' => $row2['emp_email']
                    );
                }
            }
        }
        // return events in json
        echo json_encode($data);
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }