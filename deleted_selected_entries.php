<?php

// Creates database connection
include 'includes/dbh.inc.php';
// Check to make sure a proper submission is made
if (isset($_POST['delete_set'])){
    // Get the array of entries selected to delete
    $box = $_POST['arr'];
    // Get today's date
    $date = date('Y-m-d');
    // Go throught the list of selected entries
    while (list ($key, $val) = @each ($box)){ 
        // Create a prepared statement
        $stmt = $conn->prepare("UPDATE timeGeneral SET status =? WHERE time_id =? ;");
        // Set status
        $status = 'deleted';
        // Put things into prepared statement
        $stmt->bind_param("si",$status,$val);
        // Execute prepared statement
        $stmt->execute();
        // Create a prepared statement
        $stmt = $conn->prepare("UPDATE timeGeneral SET date_deleted=? WHERE time_id=?");
        // Put things into prepared statement
        $stmt->bind_param("si",$date,$val);
        // Execute prepared statement
        $stmt->execute();
    } 
}