<?php

session_start();

// Make sure all posts are set that are needed.
if (isset($_POST['email']) && isset($_POST['pwd'])) {

    // Creates the database connection
    include_once 'database-connection.php';

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    // Removes any html elements, such as dangerous script tags, before they get submitted to the database.
    $email  = filter_var($email , FILTER_SANITIZE_STRING);
    $pwd = filter_var($pwd, FILTER_SANITIZE_STRING);

    //Error handlers
    //Check if inputs are empty
    if (empty($email) || empty($pwd)) {
        // Close the connection.
        mysqli_close($conn);
        header("Location: ../index.php?login=empty");
        exit();
    } else {
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
            header("Location: ../index.php?login=error");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)){
                //De-hashing the password
                $hashedPwdCheck = password_verify($pwd, $row['password']);
                if($hashedPwdCheck == false){
                    // Close the connection.
                    mysqli_close($conn);
                    header("Location: ../index.php?login=error");
                    exit();
                } elseif($hashedPwdCheck == true) {
                    //Log in the user here
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['company_id'] = $row['company_id'];
                    $_SESSION['authority_level'] = $row['authority_level']; 
                    // Close the connection.
                    mysqli_close($conn);                   
                    header("Location: ../index.php?login=success");
                    exit();
                }

                
            }
        }

    }
} else {
    header("Location: ../index.php");
    exit();
}