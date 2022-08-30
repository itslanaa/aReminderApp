<?php
include_once "../db/config.php";

$id = $_GET['id'];
 
$qryDelete = mysqli_query($conn, "DELETE FROM tb_task WHERE tt_id='$id'");
 
echo "<script>alert('task sucessfully deleted!');</script>";
header("location:today_tasks.php");
?>


<?php

//delete.php

if(isset($_POST["id"]))
{
$qryDelete = mysqli_query($conn, "DELETE FROM tb_task WHERE tt_id='$id'");
 $statement = $conn->prepare($qryDelete);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>