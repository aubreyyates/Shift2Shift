<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was done
    if (isset($_POST['timestamp'])) {
        // Connect to the database
        include 'includes/dbh.inc.php';
        // Start submitted to now because they haven't clocked out yet
        $submitted = "no";
        // Get the employee's id
        $eid = $_SESSION['e_id']; 
        // Get the time of the start. It will be a unix time
        $timestamp = $_POST['timestamp'];
        // Get the project it is clocked for
        $project_id = $_POST['current_project'];
        // Get the job code
        $job_code = $_POST['job_code'];
        // Get the company id 
        $org_id = $_SESSION['e_org_id'];
        // Check if a job code was entered
        if ($job_code != 'none') {
            // Prepare a statement
            $stmt = $conn->prepare("SELECT * FROM projects WHERE job_code=? AND org_id=?;");
            // Set the variables that go into the statement
            $stmt->bind_param('si', $job_code,$org_id); // 's' specifies the variable type => 'string'
            // Execute the statement
            $stmt->execute();
            // Put the result into $result
            $result = $stmt->get_result(); 
            // Go through each result
            while ($row = $result->fetch_assoc()) {
                // Get the project's name
                $project_id = $row['project_id'];
            }
        } 
        // Get the currect date. It will be in YYYY-MM-DD format
        $date = date("Y-m-d");
        // Prepare a statement
        $stmt = $conn->prepare("INSERT INTO timeGeneral (date, project_id, time_start, submitted, emp_id, emp_org_id, status) VALUES (?,?,?,?,?,?,?);");
        // Set status
        $status = 'active';
        // Set the variables that go into the statement
        $stmt->bind_param('sissiis', $date,$project_id,$timestamp,$submitted,$eid,$org_id,$status); // 's' specifies the variable type => 'string'
        // Execute the statement
        $stmt->execute();
        // // Put the timestamp into the database
        // $sql = "INSERT INTO timeGeneral (date, project_id, time_start, submitted, emp_id, emp_org_id, status) VALUES ('$date','$project_id','$timestamp','$sumbitted','$eid','$emp_org_id','active');";
        // // Run the SQL
        // mysqli_query($conn, $sql);   
    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }


