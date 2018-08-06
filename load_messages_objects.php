<?php

// Start a session
session_start();
// Connect to the database
include 'includes/dbh.inc.php';
// Check if proper submission
if (isset($_SESSION['u_id'])) {
    // Get the company id
    $org_id = $_SESSION['u_org_id'];  
    // Prepare a statement
    $stmt = $conn->prepare("SELECT * FROM message WHERE org_id =?;");
    // Set the variables that go into the statement
    $stmt->bind_param('i',$org_id); // 's' specifies the variable type => 'string'
    // Execute the statement
    $stmt->execute();
    // Put the result into $result
    $result = $stmt->get_result();   
    // create an empty array
    $data = array();
    // Go through the results
    foreach($result as $row) { 
        // Get read status
        $read = $row['read_status'];
        // Get the event id
        $event_id = $row['event_id'];
        // Get the id of message
        $id = $row['id'];
        // Get the message
        $message = $row['message'];
        // Get the new date
        $new_date = $row['new_date'];
        // Prepare a statement
        $stmt = $conn->prepare("SELECT * FROM events WHERE id=? AND org_id=?");
        // Set the variables that go into the statement
        $stmt->bind_param('ii',$event_id,$org_id); // 's' specifies the variable type => 'string'
        // Execute the statement
        $stmt->execute();
        // Put the result into $result
        $result2 = $stmt->get_result(); 
        // Go through the results
        foreach($result2 as $row2) { 
            // Get the event start
            $start = $row2['start_event'];
            // Get the event end
            $end = $row2['end_event'];
        }
        // Get the assigned project
        $emp_id = $row['emp_id'];
        // Set active
        $active = 'active';
        // Prepare a statement
        $stmt2 = $conn->prepare("SELECT * FROM employees WHERE emp_org =? AND status =? AND emp_id =?");
        // Set the variables that go into the statement
        $stmt2->bind_param('isi',$org_id,$active,$emp_id); // 's' specifies the variable type => 'string'
        // Execute the statement
        $stmt2->execute();
        // Put the result into $result
        $result4 = $stmt2->get_result(); 
        // Go through the results
        foreach($result4 as $row4) { 
            // Fill the array
            $data[] = array(
                // Get the employee email
                'email' => $row4['emp_email'],
                // Get the message
                'message' => $message,
                // Put event start
                'start' => $start,
                // Get the new date
                'new_date' => $new_date,
                // Put event end
                'end' => $end,
                // Put read status
                'read'=> $read,
                // Get the message id
                'id' => $id
            );
        }     
    }
    // return events in json
    echo json_encode($data);
}



?>