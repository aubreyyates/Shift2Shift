<?php  
// Start a session
session_start();

include_once 'check-authority.php';
check_authority();

// Check to make sure they are signed in
if ($_SESSION['id']) {

    // Create a connection
    require_once 'database-connection.php';

    $company_id = $_SESSION['company_id'];

    $stmt = $conn->prepare("SELECT timestamp_length FROM timestamps WHERE company_id=?");

    // Put variables in
    $stmt->bind_param("i",  $company_id);
    // Execute the statement
    $stmt->execute();
    // Put the result into $result
    $result = $stmt->get_result(); 

    $number_of_timestamps = mysqli_num_rows($result);

    $total_timestamp_length = 0;

    // Go through the results
    foreach($result as $row) { 

        $timestamp_length = $row['timestamp_length'];

        $total_timestamp_length += $timestamp_length;
    }

    $stmt = $conn->prepare("SELECT break_length FROM breaks WHERE company_id=?");

    // Put variables in
    $stmt->bind_param("i",  $company_id);
    // Execute the statement
    $stmt->execute();
    // Put the result into $result
    $result = $stmt->get_result(); 

    $number_of_breaks = mysqli_num_rows($result);

    $total_break_length = 0;

    // Go through the results
    foreach($result as $row) { 

        $break_length = $row['break_length'];

        $total_break_length += $break_length;
    }


    // Fill data
    $data = array(

        'total_timestamp_length' => $total_timestamp_length,

        'total_break_length' => $total_break_length,

        'number_of_timestamps' => $number_of_timestamps,

        'number_of_breaks' => $number_of_breaks

    );

    // return data in json
    echo json_encode($data);
    // Close the connection.
    mysqli_close($conn);

    exit();

} else {
    // Send them to the home page
    header("Location: ../../index.php");
    exit();
}