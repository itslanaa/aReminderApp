<?php 
// session activation
session_start();
 
// destroy all session
session_destroy();
 
// redirect to sign in page
header("location:signin.php?m=signout");
?>