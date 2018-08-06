<?php

    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    // 
    if (isset($_SESSION['u_id']) && isset($_POST['update'])) {
        // Get the company id
        $org_id = $_SESSION['u_org_id'];
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // Get first name
        $first = $_POST['first'];
        // Get last name
        $last = $_POST['last'];
        // Get email
        $email = $_POST['email'];
        // Get the id of employee
        $id= $_SESSION['current_manager_id'];
        // Check to make sure company name is valid
        if (!preg_match("/^[a-zA-Z]*$/", $first) || strlen($first) > 29 || strlen($first) == 0){
            // Leave the code
            exit();
        }
        // Check to make sure company name is valid
        if (!preg_match("/^[a-zA-Z]*$/", $last) || strlen($last) > 29 || strlen($last) == 0){
            // Leave the code
            exit();
        }
        // Check to make sure company name is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) == 0){
            // Leave the code
            exit();
        }
        
        // Checks admins for an email match
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ? ;");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();        
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            echo "taken";
            exit();
        } 
        
        // Checks managers for an email match
        $stmt = $conn->prepare("SELECT * FROM managers WHERE manager_email = ? AND manager_id !=? ;");
        $stmt->bind_param("s",$email,$id);
        $stmt->execute();
        $result = $stmt->get_result();        
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0){
            echo "taken";
            exit();
        } 


        // Checks employees for an email match
        $stmt = $conn->prepare("SELECT * FROM employees WHERE emp_email = ?;");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();        
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            echo "taken";
            exit();
        }

        // Update the name
        $stmt = $conn->prepare("UPDATE managers SET manager_first=? WHERE manager_id=? AND manager_org_id=?;");
        // Put variables into statement
        $stmt->bind_param("sii",$first,$id,$org_id);
        // Execute SQL
        $stmt->execute();
        // Update the date
        $stmt = $conn->prepare("UPDATE managers SET manager_last=? WHERE manager_id=? AND manager_org_id=?;");
        // Put variables into statement
        $stmt->bind_param("sii",$last,$id,$org_id);
        // Execute SQL
        $stmt->execute();   
        // // Update the date
        $stmt = $conn->prepare("UPDATE managers SET manager_email=? WHERE manager_id=? AND manager_org_id=?;");
        // Put variables into statement
        $stmt->bind_param("sii",$email,$id,$org_id);
        // Execute SQL
        $stmt->execute(); 
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }