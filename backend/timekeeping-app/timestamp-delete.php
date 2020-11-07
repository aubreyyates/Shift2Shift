<?php
    
    // Start a session
    session_start();

    include_once 'check-authority.php';
    check_authority();
    
    //Check to make sure a proper submission was made
    if (isset($_SESSION['id']) && isset($_POST['id'])) {
        
        include_once 'database-connection.php';

        $id = $_POST['id'];

        //Insert the user into the database
        $stmt = $conn->prepare("DELETE FROM timestamps WHERE id=? AND company_id=?;");
        // Get the company id
        $company_id = $_SESSION['company_id'];
        // Put variables into the statements
        $stmt->bind_param("ii",$id,$company_id);
        // Execute the SQL
        $stmt->execute();

        // Close the connection.
        mysqli_close($conn);
        echo "success";
        exit();

    } else {
        // Send them to the home page
        header("Location: ../../index.php");
        exit();
    }
