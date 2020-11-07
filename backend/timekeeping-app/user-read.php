<?php  
// Start a session
session_start();

include_once 'check-authority.php';
check_authority();

// Check to make sure they are signed in
if ($_SESSION['id']) {

    // Create a connection
    include_once 'database-connection.php';

    $company_id = $_SESSION['company_id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE company_id=?");

    // Put variables in
    $stmt->bind_param("i",  $company_id);
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
            // Get the first name
            'first_name' => $row['first_name'],
            // Get the last name
            'last_name' => $row['last_name'],
            // Get the email
            'email' => $row['email'],
            // Get the id
            'id' => $row['id'] 
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