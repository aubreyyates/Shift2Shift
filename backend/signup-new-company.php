<?php
// Make sure all posts are set that are needed.
if (isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['org'])) {

    include_once 'database-connection.php';

    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $org = $_POST['org'];


    // Removes any html elements, such as dangerous script tags, before they get submitted to the database.
    $first = filter_var($first, FILTER_SANITIZE_STRING);
    $last = filter_var($last, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pwd = filter_var($pwd, FILTER_SANITIZE_STRING);
    $org  = filter_var($org, FILTER_SANITIZE_STRING);

    //Error handlers
    //Check for empty fields
    if (empty($first) || empty($last) ||  empty($email) || empty($pwd) || empty($org)){
        // Close the connection.
        mysqli_close($conn);
        header("Location: ../signup.php?signup=empty");
        exit();
    } else {
        //Check if characters are valid
        if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last) || !preg_match("/^[a-zA-Z0-9| |&|\-]*$/", $org)){
            // Close the connection.
            mysqli_close($conn);
            header("Location: ../signup.php?signup=invalid");
            exit();
        } else {
            //Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Close the connection.
                mysqli_close($conn);
                header("Location: ../signup.php?signup=email");
                exit();
            } else {
                // Checks users for an email match
                $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?;");
                $stmt->bind_param("s",$email);
                $stmt->execute();
                $result = $stmt->get_result();        
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0){
                    // Close the connection.
                    mysqli_close($conn);
                    header("Location: ../signup.php?signup=usertaken");
                    exit();
                } else { 

                    $stmt = $conn->prepare("INSERT INTO companies (company_name) VALUES (?);");
                    $stmt->bind_param("s", $org);
                    $stmt->execute();
                    // Get the last inserted id
                    $company_id = $conn->insert_id;

                    //Hashing the password
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, authority_level, company_id) VALUES (?,?,?,?,?,?);");

                    $authority_level = 2;

                    $stmt->bind_param("ssssii", $first, $last, $email, $hashedPwd,$authority_level, $company_id);
                    $stmt->execute();
        
                    // Log in the user here since it is what they will most likely want to do next.
                    session_start();
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


                    // Close the connection.
                    mysqli_close($conn);
                    header("Location: ../index.php?signup=success");
                    exit();
               
                }
            }
        }
    }
} else {
    header("Location: ../signup.php");
    exit();
}