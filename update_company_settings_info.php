<?php

    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_SESSION['u_id'])) {
        // Get company name entered
        $org = $_POST['company_name'];
        // Get the color
        $color = $_POST['company_color'];
        // Get the website
        $website = $_POST['company_name'];
        // Get the company id
        $org_id = $_SESSION['u_org_id'];
        // Check to make sure company name is valid
        if (!preg_match("/^[a-zA-Z0-9| |&|\-]*$/", $org) || strlen($org) > 99 || !preg_match("/^[a-zA-Z0-9|#]*$/", $color)){
            // Leave the code
            exit();
        }
        // Creates the database connect
        include 'includes/dbh.inc.php';
        // Get all of the project entries
        $stmt = $conn->prepare("UPDATE company_info_and_settings SET org_name=?, org_website=?, org_color=? WHERE org_id=?;");
        // Put variables in
        $stmt->bind_param("sssi", $org, $website, $color, $org_id);
        // Execute the statement
        $stmt->execute();
        
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }