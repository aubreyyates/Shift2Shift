<?php

// start a session
session_start();

include_once 'check-authority.php';
check_authority();

// Make sure all posts are set that are needed.
if (isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['authority_level'])) {

    // Create a connection
    include_once 'database-connection.php';

    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $authority_level = $_POST['authority_level'];

    // Removes any html elements, such as dangerous script tags, before they get submitted to the database.
    $first = filter_var($first, FILTER_SANITIZE_STRING);
    $last = filter_var($last, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pwd = filter_var($pwd, FILTER_SANITIZE_STRING);
    $authority_level  = filter_var($authority_level, FILTER_SANITIZE_STRING);

// Error handlers
if ($authority_level < 0 || $authority_level > 2) {
    // Close the connection.
    mysqli_close($conn);
    echo "error";
    exit();
}



//Check for empty fields
if (empty($first) || empty($last) || empty($email) || empty($pwd)){
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
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?;");
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $result = $stmt->get_result();        
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                // Close the connection.
                mysqli_close($conn);
                echo "error";
                exit();
            } else {
                //Hashing the password
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                //Insert the user into the database
                $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, authority_level, company_id) VALUES (?,?,?,?,?,?);");
                // Get the company id
                $company_id = $_SESSION['company_id'];
                // Put variables into the statements
                $stmt->bind_param("ssssii",$first,$last,$email,$hashedPwd,$authority_level,$company_id);
                // Execute the SQL
                $stmt->execute();

                $last_id = $conn->insert_id;
                // Send them back to the last page
                // Close the connection.
                mysqli_close($conn);
                echo $last_id;
                exit();
            }
        }
    }
}

} else {
    header("Location: ../../index.php");
    exit();
}