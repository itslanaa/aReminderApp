<?php
    $conn = mysqli_connect("localhost","yaelahka_taskmanager","taskmanagerpwd","yaelahka_taskmanagerdb");
     
    if (mysqli_connect_errno()){
        echo "Failed Connect to Database : " . mysqli_connect_error();
    }
?>