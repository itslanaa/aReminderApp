<?php
date_default_timezone_set("Asia/Jakarta");
session_start();
    include_once "../db/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile - Task Manager App</title>
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />
    <!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" href="assets/images/apple-touch-icon-57-precomposed.png">
    <!-- For iPhone 4 Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/apple-touch-icon-114-precomposed.png">
    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/apple-touch-icon-72-precomposed.png">
    <!-- For iPad Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/apple-touch-icon-144-precomposed.png">
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/fonts/webfont/cryptocoins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.1.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="fullcalendar/main.css" rel="stylesheet" />

</head>
<body class="">
<?php

  if (empty($_SESSION['login'])) {
    header("Location:../auth/signin.php?m=no_session");
}
?>
    <div class='page-topbar'>
        <a href="index.php"><div class='logo-area'>

        </div></a>
        <div class='quick-area'>
            <div class='pull-left'>
                <ul class="info-menu left-links list-inline list-unstyled">
                    <li class="sidebar-toggle-wrap">
                        <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class='pull-right'>
                <ul class="info-menu right-links list-inline list-unstyled">
                    <li class="profile">
                         <?php 
                            $loginSession = $_SESSION['tr_id'];
                            $qrySelect = mysqli_query($conn, "SELECT * FROM tb_register WHERE tr_id='$loginSession'");
                            while ($row = mysqli_fetch_array($qrySelect)) {
                            ?>
                        <a href="#" data-toggle="dropdown" class="toggle">
                            <img src="data/profile/<?php echo $row['tr_images'] ?>" alt="user-image" class="img-circle img-inline">
                            <span><?php  echo $row["tr_name"]; ?> <i class="fa fa-angle-down"></i></span>
                        <?php } ?>
                        </a>
                        <ul class="dropdown-menu profile animated fadeIn">
                            <li>
                                <a href="profile.php">
                                    <i class="fa fa-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-info"></i> Help
                                </a>
                            </li>
                            <li class="last">
                                <a href="../auth/logout.php">
                                    <i class="fa fa-sign-out"></i> Sign Out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

    </div>
    <div class="page-container row-fluid container-fluid">

        <div class="page-sidebar fixedscroll">
            <div class="page-sidebar-wrapper" id="main-menu-wrapper">

                <ul class='wraplist'>
                    <li class='menusection'>Main</li>
                    <li class="open">
                        <a href="index.php">
                            <i class="fa fa-th-large"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    
        
                    <li class='menusection'>Applications</li>
                    <li class="title">
                        <a href="#" data-toggle="modal" data-target="#addReminder">
                            <i class="fa fa-plus"></i>
                            <span class="title">Add Task</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="javascript:;">
                            <i class="fa fa-share-square"></i>
                            <span class="title">Shortcuts</span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="" href="today_tasks.php">Today</a>
                            </li>
                            <li>
                                <a class="" href="weekly_tasks.php">Weekly Task</a>
                            </li>
                            <li>
                                <a class="" href="all_tasks.php">All Tasks</a>
                            </li>
                        </ul>
                    </li>    
                </ul>

            </div>
        </div>
    </div>
        </div>
         <!-- START OF ADD TASKS - BOOTSTRAP MODAL -->
        <div class="modal fade" id="addReminder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Add a Task</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                  <div class="modal-body">
                    <form action="add_task.php" method="POST">  
                    <div class="form-group">
                        <input type="hidden" name="idRegister" value="<?= $_SESSION["tr_id"]; ?>">
                    </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" name="taskTitle" maxlength="50">
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Notes:</label>
                        <textarea class="form-control" name="taskNotes" minlength="10"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="datetime" class="col-form-label">Set Time:</label>
                        <input type="datetime-local" name="taskDtime" id="cal">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" name="addTask" class="btn btn-info">Add Task</button>
                  </div>
                  </form>
                </div>
              </div>
        </div>
        <!-- END OF ADD TASKS - BOOTSTRAP MODAL -->
        <section id="main-content" class="">
            <div class="wrapper main-wrapper row" style="">

                <div class="col-xs-12">
                    <div class="page-title">

                        <div class="pull-left">
                            <h1 class="title">My Profile</h1>
                        </div>

                        <div class="pull-right hidden-xs">
                            <ol class="breadcrumb">
                                <li>
                                    <a href="#"><i class="fa fa-home"></i>Home</a>
                                </li>
                                <li class="active">
                                    <strong>Profile</strong>
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>

                <div class="clearfix"></div>


                <div class="container bootstrap snippets bootdey">

                    <div class="row">

                    <form action="profile_action.php" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                      <!-- left column -->
                      <div class="col-md-3">
                        <div class="text-center">
                         <?php
                          $id = $_SESSION['tr_id'];
                          $qrySelect = mysqli_query($conn, "SELECT * FROM tb_register WHERE tr_id = '$id'");
                          while ($rowImages = mysqli_fetch_array($qrySelect)) {
                              
                          ?>
                          <img src="data/profile/<?php echo $rowImages['tr_images'] ?>
                          " class="avatar img-circle" alt="avatar">
                          <h6>Only ext: .jpg .jpeg .png</h6>
                         
                          <input type="hidden" name="profilePhoto" value="<?php echo $rowImages['tr_images']; ?>">
                      <?php } ?>
                          <input type="file" name="profilePhoto" class="form-control">
                        </div>
                      </div>
                    <div class="alert alert-warning alert-dismissible col-lg-7 " role="alert">
                   <i class="fa fa-exclamation-circle" aria-hidden="true"></i> 
                    <strong>Attention!</strong> just enter the old password if you don't want to change the password!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                      
                      <!-- edit form column -->
                      <div class="col-md-7">
                        <h4>
                        <strong>Personal info</strong>
                        <?php
                        $tr_id = $_SESSION['tr_id'];
                        $qrySelect = mysqli_query($conn, "SELECT * FROM tb_register WHERE tr_id='$tr_id'");
                        while ($rowProfile = mysqli_fetch_assoc($qrySelect)) {
                        
                        ?>
                        </h4>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Full name:</label>
                            <div class="col-lg-8">
                              <input class="form-control" type="text" name="full_name" value="<?php echo $rowProfile['tr_name'];?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">E-mail:</label>
                            <div class="col-lg-8">
                              <input class="form-control" type="email" name="email" value="<?php echo $rowProfile['tr_email'];?>" disabled>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">New Password:</label>
                            <div class="col-lg-8">
                              <input class="form-control" type="password" name="new_password">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Confirm New password:</label>
                            <div class="col-lg-8">
                              <input class="form-control" type="password" name="confirm_new_password">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="reset" id="submit" name="profileReset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" id="submit" name="profileEdit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    <?php } ?>
                      </div>
                  </div>
                </div>

            <div class="clearfix"></div>

        </div>
    </section>
    
 
    <div class="chatapi-windows ">

    </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/pace/pace.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/plugins/viewport/viewportchecker.js"></script>
    <script>
        window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>');
    </script>
    <script src="assets/plugins/icheck/icheck.min.js"></script>
    <script src="assets/plugins/chartjs-chart/Chart.min.js"></script>
    <script src="assets/plugins/morris-chart/js/raphael-min.js"></script>
    <script src="assets/plugins/morris-chart/js/morris.min.js"></script>
    <script src="assets/js/app-dashboard.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src='fullcalendar/main.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>
   <script>
    $('#addReminder').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  
  var modal = $(this)
  modal.find('.modal-title').text('Add a Task ')
})
</script>
<script>
    window.addEventListener('load', () => {
  const now = new Date();
  now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
  document.getElementById('cal').value = now.toISOString().slice(0, -8);
  document.getElementById("cal").min = now.toISOString().slice(0, -8);
});
</script>
</body>
</html>