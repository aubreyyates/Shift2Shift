<?php  
    // Start a session
    session_start();
    // Check to make sure an admin is signed in
    if ($_SESSION['u_id']) {
        // Make a database connection
        $conn = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // Get the company id
        $org_id = $_SESSION['u_org_id'];
        // Get all of the clocked entries
        $sql = "SELECT * FROM timeGeneral WHERE emp_org_id = '$org_id' and submitted = 'no';";
        // Prepare the statement
        $statement = $conn->prepare($sql);
        // Run the SQL code
        $statement->execute();
        // Put the result into $result
        $result = $statement->fetchAll();
        // create an empty array
        $data = array();
        // Go through results
        foreach($result as $row) { 
            // Get the employee id
            $emp_id = $row['emp_id'];
            // Get the employee with $emp_id
            $sql2 = "SELECT * FROM employees WHERE emp_id = '$emp_id' AND emp_org = '$org_id' AND status='active';";
            // Prepare the statement
            $statement2 = $conn->prepare($sql2);
            // Run the SQL code
            $statement2->execute();
            // Put the result into $result
            $result2 = $statement2->fetchAll();     
            // Go through the results
            foreach($result2 as $row2) { 
                
                // Fill the array
                $data[] = array(
                    // Get the manager id
                    'id' => $emp_id, 
                    // Get the manager's first name
                    'first' => $row2['emp_first'],
                    // Get the manager's last name
                    'last' => $row2['emp_last'],
                    // Get the project name
                    'email' => $row2['emp_email']
                );
            }
        }   

        // return events in json
        echo json_encode($data);
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }