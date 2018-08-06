<?php

//insert.php

session_start();

if (isset($_SESSION['u_id'])) {
    // Create connection
    $connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');

    $start = $_POST['start'];
    $end = $_POST['end'];

    for ($x = 0; $x<count($start); $x++) {
        
        $query = "
        INSERT INTO events 
        (title, start_event, end_event, location, project_id, description, emp_id, org_id ) 
        VALUES (:title, :start_event, :end_event, :location, :project_id, :description, :emp_id, :org_id)
        ";
        
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':title'  => $_POST['title'],
                ':start_event' => $start[$x],
                ':end_event' => $end[$x],
                ':location' => $_POST['location'],
                ':project_id' => $_POST['project_id'],
                ':description' => $_POST['description'],
                ':emp_id' => $_POST['emp_id'],
                ':org_id' => $_SESSION['u_org_id']
            )
        );
    } 
}





  // if(isset($_POST["title"]))
  // {
    
  //  $query = "
  //  INSERT INTO events 
  //  (title, start_event, end_event, emp_id, location, project_id, description, dow, org_id ) 
  //  VALUES (:title, :start_event, :end_event, :emp_id, :location, :project_id, :description, :dow, :org_id)
  //  ";
  //  $statement = $connect->prepare($query);
  //  $statement->execute(
  //   array(
  //       ':title'  => $_POST['title'],
  //       ':start_event' => $_POST['start'],
  //       ':end_event' => $_POST['end'],
  //       ':location' => $_POST['location'],
  //       ':project_id' => $_POST['project_id'],
  //       ':description' => $_POST['description'],
  //       ':dow' => $_POST['dow'],
  //       ':emp_id' => $_POST['submit'],
  //       ':org_id' => $_SESSION['u_org_id']
  //     )
  //   );
  // }
// }




?>