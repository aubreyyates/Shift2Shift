<?php  
// Start a session
session_start();

if ($_SESSION['authority_level'] < 2) {
    header("Location: ../../index.php");
    exit();
} 

// Check to make sure they are signed in
if ($_SESSION['id'] && $_POST['id']) {

    // Create a connection
    include_once 'database-connection.php';

    $company_id = $_SESSION['company_id'];

    $user_id = $_POST['id'];

    $stmt = $conn->prepare("SELECT * FROM timestamps WHERE company_id=? AND user_id=?;");

    // Put variables in
    $stmt->bind_param("ii",  $company_id, $user_id);
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
            // Get timestamp start
            'timestamp_start' => $row['timestamp_start'], 
            // Get timestamp end
            'timestamp_end' => $row['timestamp_end'],
            // Get timestamp length
            'timestamp_length' => $row['timestamp_length']
        );
    }
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