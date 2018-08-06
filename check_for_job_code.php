<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was done
    if (isset($_POST['job_code']) && isset($_SESSION['e_id'])) {
        // Connect to the database
        include 'includes/dbh.inc.php';
        // Get the entered job code
        $job_code = $_POST['job_code'];
        // Get the company id 
        $org_id = $_SESSION['e_org_id'];
        // Get all of the project entries
        $stmt = $conn->prepare("SELECT * FROM projects WHERE job_code=? AND org_id=? AND status=?;");
        // Set active
        $active = 'active';
        // Put variables in
        $stmt->bind_param("sis", $job_code, $org_id, $active);
        // Execute the statement
        $stmt->execute();
        // Put the result into $result
        $result = $stmt->get_result(); 
        // Get the number of results
        $result_check = mysqli_num_rows($result);
        // Send back result
        if ($result_check > 0) {
            // Go through result
            while ($row = $result->fetch_assoc()) {
                // Get the project name 
                $project_name = $row['project_name'];
            }
            // Fill the array
            $data[] = array(
                // Get number of results
                'number' => $result_check, 
                // Get project name
                'project_name' => $project_name
            );
            // Send back data
            echo json_encode($data);
        } else {
            // Fill the array
            $data[] = array(
                // Get number of results
                'number' => $result_check
            );
            // Send back data
            echo json_encode($data);
        }


    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }