<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');

if(isset($_POST["id"])) {

$type = $_POST['event_type'];

if ($type == 'employee') {
    {
        $query = "
        UPDATE events 
        SET title=:title, start_event=:start_event, end_event=:end_event 
        WHERE id=:id
        ";
            $statement = $connect->prepare($query);
            $statement->execute(
            array(
            ':title'  => $_POST['title'],
            ':start_event' => $_POST['start'],
            ':end_event' => $_POST['end'],
            ':id'   => $_POST['id']
            )
        );
    }
} else {
    $query = "
    UPDATE company_events 
    SET title=:title, start_event=:start_event, end_event=:end_event 
    WHERE id=:id
    ";
        $statement = $connect->prepare($query);
        $statement->execute(
        array(
        ':title'  => $_POST['title'],
        ':start_event' => $_POST['start'],
        ':end_event' => $_POST['end'],
        ':id'   => $_POST['id']
        )
    );
    
}
}
?>
