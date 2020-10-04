<?php

// Make sure all posts are set that are needed.
if (isset($_POST['email'])) {

    // Creates the database connection
    include_once 'database-connection.php';

    $email = $_POST['email'];

    // Removes any html elements, such as dangerous script tags, before they get submitted to the database.
    $email  = filter_var($email , FILTER_SANITIZE_STRING);

    // Prepare a statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    // Set the variables that go into the statement
    $stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
    // Execute the statement
    $stmt->execute();
    // Put the result into $result
    $result = $stmt->get_result();        
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
        // Close the connection.
        mysqli_close($conn);
        echo "False";
        exit();
    } else {
        // Close the connection.
        mysqli_close($conn);
        echo "True";
        exit();
    }
} else {
    header("Location: ../../index.php");
    exit();
}