<?php

if (isset($_POST['email']) && isset($_POST['pwd'])) {

    // Creates the database connection
    include_once 'dbh.inc.php';

    $uid = $_POST['email'];
    $pwd = $_POST['pwd'];

    // Prepare a statement
    $stmt = $conn->prepare("SELECT * FROM managers WHERE manager_email=? AND status=?;");
    // Set active
    $active='active';
    // Set the variables that go into the statement
    $stmt->bind_param('ss', $uid,$active); // 's' specifies the variable type => 'string'
    // Execute the statement
    $stmt->execute();
    // Put the result into $result
    $result = $stmt->get_result();        
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
        echo "False";
        exit();
    } else {
        if ($row = mysqli_fetch_assoc($result)) {
            //De-hashing the password
            $hashedPwdCheck = password_verify($pwd, $row['manager_pwd']);
            if($hashedPwdCheck == false){
                echo "False";
                exit();
            } elseif($hashedPwdCheck == true) {
                echo "True";

            }
        }
    }
}