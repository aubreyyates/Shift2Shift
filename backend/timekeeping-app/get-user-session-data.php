<?php

    session_start();

    // Check to make sure a user is signed in
    if (isset($_SESSION['id'])) {
        // Creates the database connection
        include_once 'database-connection.php';
        // Prepare statement.
        $stmt = $conn->prepare("SELECT company_name FROM companies WHERE company_id=?;");
        // Put the variables in
        $stmt->bind_param("i", $_SESSION['company_id']);
        // Execute SQL
        $stmt->execute();
        // Put the result into $result
        $result = $stmt->get_result(); 
        // Go through the results
        foreach($result as $row) { 
            // Get the company name.
            $_SESSION['company_name'] = $row['company_name'];
        }
        // Close the connection.
        mysqli_close($conn);

    } else {
        header("Location: ../../index.php");
        exit();
    }