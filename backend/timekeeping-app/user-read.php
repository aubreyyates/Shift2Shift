<?php  
// Start a session
session_start();

include_once 'check-authority.php';
check_authority();

// Check to make sure they are signed in
if ($_SESSION['id']) {

    include_once 'config/init.php';

    $user = new User();

    $result = $user->getAll($_SESSION['company_id']);

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

    exit();

} else {
    // Send them to the home page
    header("Location: ../../index.php");
    exit();
}