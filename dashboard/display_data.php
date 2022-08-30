<?php 
session_start();
include "../db/config.php";
$json = array();
$sessionTask = $_SESSION['tr_id'];
$show = mysqli_query($conn, "SELECT * FROM tb_task WHERE tt_tr_id = '$sessionTask' ");

while($row = mysqli_fetch_assoc($show)){
    if($row['tt_title']){
        $json[] = array(
            'backgroundColor' => 'rgb(47, 245, 245)', 
            'borderColor' => 'rgb(47, 245, 245)',
            'title' => $row['tt_title'],
            'start' => $row['tt_reminder_date']
            );
    } else {
        $json[] = array(
            'title' => $row['tt_title'],
            'start' => $row['tt_reminder_date']
            );
    }
}
echo json_encode($json);

?>