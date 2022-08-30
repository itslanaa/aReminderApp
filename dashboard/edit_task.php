<?php
include_once '../db/config.php';

if(isset($_POST['editTask'])){

    // ambil data dari formulir
    $id = $_POST['idTitle'];
    $title = $_POST['taskTitle'];
    $notes = $_POST['taskNotes'];
    $datetime = $_POST['taskDtime'];

    // buat query update
    $qryUpdate = "UPDATE tb_task SET tt_title='$title' , tt_description='$notes', tt_reminder_date='$datetime' WHERE tt_id='$id' ";
    $query = mysqli_query($conn, $qryUpdate);

    // apakah query update berhasil?
    if ($query) {
    echo "<script>alert('Task Successfuly Updated!');</script>";
    echo "<script>window.location.href='all_tasks.php';</script>";
  } else {
    echo "<script>alert('Task Failed to Update!');</script>";
  }        
}
?>

<?php

if (isset($_POST['markDone'])) {
  
  $id = $_POST['idTitle'];
  $today = date('Y-m-d H:i:s');

  $qryUpdate = "UPDATE tb_task SET tt_status='Done', tt_completed_date='$today' WHERE tt_id='$id'";
  $query = mysqli_query($conn, $qryUpdate);
    // apakah query update berhasil?
    if ($query) {
    echo "<script>alert('Task sucessfully mark as done!');</script>";
    echo "<script>window.location.href='all_tasks.php';</script>";
  } else {
    echo "<script>alert('Failed to mark as done!');</script>";
  }        

}
?>

 <?php
if (isset($_POST['Event'][0]) && isset($_POST['Event'][1])){
 
 
 $id = $_POST['Event'][0];
 $start = $_POST['Event'][1];

 $sql = "UPDATE tb_task SET  tt_reminder_date = '$start' WHERE tt_id = $id ";

 
 $query = $bdd->prepare( $sql );
 if ($query == false) {
  print_r($bdd->errorInfo());
  die ('Erreur prepare');
 }
 $sth = $query->execute();
 if ($sth == false) {
  print_r($query->errorInfo());
  die ('Erreur execute');
 }else{
  die ('OK');
 }

}
//header('Location: '.$_SERVER['HTTP_REFERER']);

 
?>