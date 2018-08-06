<?php

//insert.php

session_start();

//$org_name = $_SESSION['u_org_name'];


$connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');

// $submit = $_POST['submit'];

if ($_POST['submit'] == 'company') {

    $org_id = $_SESSION['u_org_id'];



    
      $query = "
      INSERT INTO company_events 
      (title, start_event, end_event, location, project_id, description, color, org_id ) 
      VALUES (:title, :start_event, :end_event, :location, :project_id, :description, :color, :org_id)
      ";
      $statement = $connect->prepare($query);
      $statement->execute(
      array(
          ':title'  => $_POST['title'],
          ':start_event' => $_POST['start'],
          ':end_event' => $_POST['end'],
          ':location' => $_POST['location'],
          ':project_id' => $_POST['project_id'],
          ':description' => $_POST['description'],
          ':color' => 'red',
          ':org_id' => $_SESSION['u_org_id']
        )
      );
    

} else {


  if(isset($_POST["title"]))
  {
   $query = "
   INSERT INTO events 
   (title, start_event, end_event, emp_id, location, project_id, description, dow, org_id ) 
   VALUES (:title, :start_event, :end_event, :emp_id, :location, :project_id, :description, :dow, :org_id)
   ";
   $statement = $connect->prepare($query);
   $statement->execute(
    array(
        ':title'  => $_POST['title'],
        ':start_event' => $_POST['start'],
        ':end_event' => $_POST['end'],
        ':location' => $_POST['location'],
        ':project_id' => $_POST['project_id'],
        ':description' => $_POST['description'],
        ':dow' => $_POST['dow'],
        ':emp_id' => $_POST['submit'],
        ':org_id' => $_SESSION['u_org_id']
      )
    );
  }
}




?>