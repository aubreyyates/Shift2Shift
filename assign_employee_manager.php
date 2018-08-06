<?php

    // Start the session
    session_start();
    // Check if to make sure a proper submission was made
    if (isset($_POST['ids']) && isset($_SESSION['u_id'])) {

        // Connect to the database
        include 'includes/dbh.inc.php';
        // Get the id of the employees being assigned
        $ids = $_POST['ids'];
        // Get the manager's id that the employee is being assigned to
        $manager_id = $_SESSION['current_manager_id'];

        foreach ($ids as $id ) {
            // Prepare statement to get assignments from this manager with this employee id
            $stmt = $conn->prepare("SELECT * FROM assignment_managers WHERE manager_id=? AND emp_id=?;");
            // Put the variables in
            $stmt->bind_param("ii", $manager_id, $id);
            // Execute SQL
            $stmt->execute();
            // Put the result into $result
            $result = $stmt->get_result();   
            // Get the number of results
            $resultCheck = mysqli_num_rows($result);  
            // If more than 0 results, they were already assigned
            if ($resultCheck == 0) {
                // Prepare statement to assign employee to manager
                $stmt = $conn->prepare("INSERT INTO assignment_managers (manager_id, emp_id) VALUES (?,?);");
                // Put the variables in
                $stmt->bind_param("ii", $manager_id, $id);
                // Execute SQL
                $stmt->execute();
            }
        }
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }

