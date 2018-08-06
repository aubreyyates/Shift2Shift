<?php
   

    // Starts a session
    session_start();
    // Checks to make sure there was a proper submission
    if(isset($_SESSION['u_id'])) {
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // Gets the id of the message
        $id = $_POST['id'];
        // Get the company id
        $org = $_SESSION['u_org_id'];
        // Prepare a statement to update the read status to yes
        $stmt = $conn->prepare("UPDATE message SET read_status=? WHERE id=? AND org_id=?;");
        //Set read to yes
        $read = 'Yes';
        // Put variables in
        $stmt->bind_param("sii", $read, $id, $org);
        // Execute statement
        $stmt->execute();
    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }
