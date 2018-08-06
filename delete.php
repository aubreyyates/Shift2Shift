<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if(isset($_POST["id"])) {
        // Get the company id
        $org_id = $_SESSION['u_org_id'];
        // Connect to the database
        $connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // Get the event_type
        $type = $_POST['event_type'];
        // Check the type
        if ($type == 'employee') {
            // Delete the event with the id
            $query = " DELETE from events WHERE id=:id AND org_id = '$org_id';";
            // Prepare the statement
            $statement = $connect->prepare($query);
            // Run the SQL
            $statement->execute(
            // Put the given id into an array
            array (
            ':id' => $_POST['id']
            )
            );
        } else {
            // Delete the event with the id
            $query = " DELETE from company_events WHERE id=:id AND org_id = '$org_id';";
            // Prepare the statement
            $statement = $connect->prepare($query);
            // Run the SQL
            $statement->execute(
            // Put the given id into an array
            array (
            ':id' => $_POST['id']
            )
            );  
        }
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }


