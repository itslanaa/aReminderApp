<?php
session_start();
$conn = mysqli_connect("localhost", "yaelahka_taskmanager", "taskmanagerpwd", "yaelahka_taskmanagerdb");

if (isset($_POST['addTask'])) {
  
  $id             = $_POST['idRegister'];
  $title          = $_POST['taskTitle'];
  $notes          = $_POST['taskNotes'];
  $datetime       = $_POST['taskDtime'];
  $dateCreate     = date('Y-m-d H:i:s');

  $query = "INSERT INTO tb_task (tt_tr_id, tt_title, tt_description, tt_reminder_date, tt_status, tt_completed_date, tt_task_created_date, tt_task_created_by, tt_task_updated_date, tt_task_updated_by) VALUES (
                  '$id',
                  '$title',
                  '$notes',
                  '$datetime',
                  'On Schedule',
                  '',
                  '$dateCreate',
                  '',
                  '',
                  '')";
  $create = mysqli_query($conn, $query);
  
  if ($create) {
    echo "<script>alert('Task Successfuly Added!');</script>";
    echo "<script>window.location.href='all_tasks.php';</script>";
  } else {
    echo "<script>alert('Task Failed to Added!');</script>";
    echo "<script>window.location.href='all_tasks.php';</script>";
  }                


}


?>

// <?php
// if(isset($_POST["title"]))
// {
//  $query = "
//  INSERT INTO tb_task 
//  (title, start_event, end_event) 
//  VALUES (:title, :start_event, :end_event)
//  ";
//  $statement = $connect->prepare($query);
//  $statement->execute(
//   array(
//   ':title'  => $_POST['title'],
//   ':start_event' => $_POST['start'],
//   ':end_event' => $_POST['end']
//   )
//  );
// }
// ?>
