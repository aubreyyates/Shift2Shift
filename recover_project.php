<?php
    // Start a session
    session_start();
    // Check to make sure an admin is signed in
    if ($_POST['recover'] && $_SESSION['u_id']) {
        // Make a database connection
        $conn = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // put the session project_id into $pid
        $org_id = $_SESSION['u_org_id'];
        // Get the project id
        $project_id = $_POST['project_id'];
        // Get all of the project entries
        $sql = "UPDATE projects SET status = 'active' WHERE project_id = '$project_id';";
        // Prepare the statement
        $statement = $conn->prepare($sql);
        // Run the SQL code
        $statement->execute();

    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }