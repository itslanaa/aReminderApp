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
    <title>Dashboard - Task Manager App</title>
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
    <link href="L_FullCalendar/fullcalendar.css" rel="stylesheet" />

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
                                <a class="" href="all_tasks.php">All Task</a>
                            </li>
                        </ul>
                    </li>    
                </ul>

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
                        <input type="text" class="form-control" name="taskTitle" maxlength="50" required>
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Notes:</label>
                        <textarea class="form-control" name="taskNotes" minlength="10" required></textarea>
                      </div>
                      <div class="form-group">
                        <label for="datetime" class="col-form-label">Set Time:</label>
                        <input type="datetime-local" name="taskDtime" id="cal" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" name="addTask" class="btn btn-info" id="addTask">Add Task</button>
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
                            <?php 
                            $time = date('H:i');

                            //set greetings using time
                                if ($time > '05:30' && $time < '12:00') {
                                    $greetings = 'Good Morning';
                                } elseif ($time >= '12:01' && $time < '18:00') {
                                    $greetings = 'Good Afternoon';
                                } else {
                                    $greetings = 'Good Night';
                                }
                            ?>
                            <h1 class="title"><?= $greetings, ', '.$_SESSION['tr_name']; ?>.</h1>
                        </div>

                        <div class="pull-right hidden-xs">
                            <ol class="breadcrumb">
                                <li>
                                    <a href="#"><i class="fa fa-home"></i>Home</a>
                                </li>
                                <li class="active">
                                    <strong>Dashboard</strong>
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="col-lg-7">
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left">Calendar</h2>
                         
                        </header>
                        <div class="content-body">
                            <div class="row">
                                <div class="col-xs-12">
                                     <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="ref-num-box statistics-box text-center mt-15">
                                <div class="mb-10">
                                    <img src="data/app-images/f1.png" class="ico-icon-o mt-10 mb-10" alt="">
                                    <?php
                                    $sessionTask = $_SESSION['tr_id'];
                                    $queryRow = mysqli_query($conn, "SELECT * FROM tb_task WHERE tt_status='On Schedule' AND tt_tr_id='$sessionTask'");
                                    $row = mysqli_num_rows($queryRow);
                                    ?>
                                    <h3 class="bold mb-10"><?php echo $row ?></h3>  
                                    <p class="mb-10">On Schedule</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="ref-num-box statistics-box text-center mt-15">
                                <div class="mb-10">
                                    <img src="data/app-images/f2.png" class="ico-icon-o mt-10 mb-10" alt="">
                                     <?php
                                    $sessionTask = $_SESSION['tr_id'];
                                    $queryRow = mysqli_query($conn, "SELECT * FROM tb_task WHERE tt_status='Done' AND tt_tr_id='$sessionTask'");
                                    $row = mysqli_num_rows($queryRow);
                                    ?>
                                    <h3 class="bold mb-10"><?php echo $row ?></h3>
                                    <p class="mb-10">Done</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="ref-num-box statistics-box text-center mt-15">
                                <div class="mb-10">
                                    <img src="data/app-images/f3.png" class="ico-icon-o mt-10 mb-10" alt="">
                                     <?php
                                    $sessionTask = $_SESSION['tr_id'];
                                    $queryRow = mysqli_query($conn, "SELECT * FROM tb_task WHERE tt_status='Late' AND tt_tr_id='$sessionTask'");
                                    $row = mysqli_num_rows($queryRow);
                                    ?>
                                    <h3 class="bold mb-10"><?php echo $row ?></h3>
                                    <p class="mb-10">Late</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="ref-num-box statistics-box text-center mt-15">
                                <div class="mb-10">
                                    <img src="data/app-images/f4.png" class="ico-icon-o mt-10 mb-10" alt="">
                                     <?php
                                    $sessionTask = $_SESSION['tr_id'];
                                    $queryRow = mysqli_query($conn, "SELECT * FROM tb_task WHERE tt_tr_id='$sessionTask'");
                                    $row = mysqli_num_rows($queryRow);
                                    ?>
                                    <h3 class="bold mb-10"><?php echo $row ?></h3>
                                    <p class="mb-10">All Tasks</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

        </div>
    </section>
    
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
    <!--<script src='fullcalendar/main.js'></script>-->
    <script src='L_FullCalendar/lib/jquery.min.js'></script>
    <script src='L_FullCalendar/lib/moment.min.js'></script>
    <script src='L_FullCalendar/fullcalendar.js'></script>
    <script>
        
      //kerjaan gua   
      $(document).ready(function(){
          var calendar = $('#calendar').fullCalendar({
          editable: true,
           header:{
                left : 'prev, next today',
                center : 'title',
                right : 'month, agendaWeek, agendaDay'
          },
          events: 'display_data.php',
          selectable : true,
          selectHelper : true,
          select: function(start, end, allDay)
    {
     var title = prompt("Enter Task Title");
     var description = prompt("Enter Task Notes");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, description:description},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete_task.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
          
    </script>
   <script>
    $('#addReminder').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      
      var modal = $(this)
      modal.find('.modal-title').text('Add a Task ')
    })
          $('#editProfile').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      
      var modal = $(this)
      modal.find('.modal-title-profile').text('Edit Profile ')
      modal.
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