<?php

    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_POST['message'])) {
        // Creates Connection
        include 'includes/dbh.inc.php';
        // Get the new date
        $date = $_POST['date'];
        // Get the time 
        $time = $_POST['time'];
        // Get the message the employee sent
        $message = $_POST['message'];
        // Get the diem AM/PM
        $diem = $_POST['diem'];
        // Get the new date and time to string
        $new_date = $date.' '.$time.' '.$diem;
        // Get the employee's company id
        $org_id = $_SESSION['e_org_id'];
        // Get the employee's id
        $emp_id = $_SESSION['e_id'];
        // Get the event id 
        $event_id = $_POST['event_id'];
        // Set read_status
        $read = 'No';
        // Create a prepare statement
        $stmt = $conn->prepare("INSERT INTO message ( emp_id, read_status, message , new_date, event_id, org_id) VALUES (?,?,?,?,?,?);");
        // Put things into prepared statement
        $stmt->bind_param("isssii",$emp_id,$read,$message,$new_date,$event_id,$org_id);
        // Execute prepared statement
        $stmt->execute();
    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }
