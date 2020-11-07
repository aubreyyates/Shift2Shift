<?php

    // Start a session
    session_start();

    include_once 'check-authority.php';
    check_authority();

    //Check to make sure a proper submission was made
    if (isset($_SESSION['id']) && isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email']) && isset($_POST['id'])) {

        // Creates the database connection
        include_once 'database-connection.php';
        // Get first name
        $first = $_POST['first'];
        // Get last name
        $last = $_POST['last'];
        // Get email
        $email = $_POST['email'];
        // Get user id
        $id = $_POST['id'];

        $first = filter_var($first, FILTER_SANITIZE_STRING);
        $last = filter_var($last, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        //Check for empty fields
        if (empty($first) || empty($last) || empty($email) || empty($id)){
            // Close the connection.
            mysqli_close($conn);
            echo "error";
            exit();
        } else {
            //Check if characters are valid
            if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
                // Close the connection.
                mysqli_close($conn);
                echo "error";
                exit();
            } else {
                //Check if email is valid
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Close the connection.
                    mysqli_close($conn);
                    echo "error";
                    exit();
                } else {
                    // Checks employees for an email match
                    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND id<>?;");
                    $stmt->bind_param("si",$email, $id);
                    $stmt->execute();
                    $result = $stmt->get_result();        
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0) {
                        // Close the connection.
                        mysqli_close($conn);
                        echo "error";
                        exit();
                    } else {
                        //Insert the user into the database
                        $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, email=? WHERE id=? AND company_id=?;");
                        // Get the company id
                        $company_id = $_SESSION['company_id'];
                        // Put variables into the statements
                        $stmt->bind_param("sssii",$first,$last,$email,$id,$company_id);
                        // Execute the SQL
                        $stmt->execute();

                        // Close the connection.
                        mysqli_close($conn);
                        echo "success";
                        exit();
                    }
                }
            }
        } 

    } else {
        // Send them to the home page
        header("Location: ../../index.php");

        exit();
    }