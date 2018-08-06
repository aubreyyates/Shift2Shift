<?php 
    // Start a session
    session_start();
    // Check to make sure there was a proper submission 
    if(isset($_POST['project_edit'])){
        // Get the company id
        $org_id = $_SESSION['u_org_id'];
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // Get the description that was given
        $description = $_POST['description'];
        // Get the new project name that was given
        $new_project_name = $_POST['project_name'];
        // Get the project id of the project being edited
        $pid = $_POST['project_id'];
        // Get the new date of the project
        $new_date = $_POST['date'];
        // Get the new job code
        $new_job_code = $_POST['job_code'];

        if (empty($new_project_name) || !preg_match("/^[a-zA-Z0-9| ]*$/", $new_project_name) || !preg_match("/^[0-9]*$/", $pid) || strlen($new_project_name) > 100 || strlen($new_job_code) > 100) {
            // Send them back to home page
            header("Location: ./index.php");    
            // Exit code
            exit();
        }
        // // Check for script, empty out string if it there is any
        // if (strpos($description, '<script>') == true || strpos($description, '</script>') == true ) {
        //     $description = '';
        // }
        // if (strpos($job_code, '<script>') == true || strpos($job_code, '</script>') == true ) {
        //     $job_code = '';
        // }
        // Update the name
        $stmt = $conn->prepare("UPDATE projects SET project_name=? WHERE project_id = '$pid' AND org_id=?;");
        // Put variables into statement
        $stmt->bind_param("si",$new_project_name,$org_id);
        // Execute SQL
        $stmt->execute();
        // Update the date
        $stmt = $conn->prepare("UPDATE projects SET date=? WHERE project_id = '$pid' AND org_id=?;");
        // Put variables into statement
        $stmt->bind_param("si",$new_date,$org_id);
        // Execute SQL
        $stmt->execute();   
        // Update the description
        $stmt = $conn->prepare("UPDATE projects SET description=? WHERE project_id = '$pid' AND org_id=?;");
        // Put variables into statement
        $stmt->bind_param("si",$description,$org_id);
        // Execute SQL
        $stmt->execute();      
        // Update the job code
        $stmt = $conn->prepare("UPDATE projects SET job_code=? WHERE project_id = '$pid' AND org_id=?;");
        // Put variables into statement
        $stmt->bind_param("si",$new_job_code,$org_id);
        // Execute SQL
        $stmt->execute();     
        
    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }