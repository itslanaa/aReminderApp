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
    <title>Weekly Tasks - Task Manager App</title>
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
                                <a href="help.php">
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
                        <a href="#" data-toggle="modal" data-target="#addReminder" data-whatever="I Want to..">
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
            <!-- MAIN MENU - END -->

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
                        <input type="text" class="form-control" name="taskTitle" maxlength="50" required="">
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Notes:</label>
                        <textarea class="form-control" name="taskNotes" minlength="10" required=""></textarea>
                      </div>
                      <div class="form-group">
                        <label for="datetime" class="col-form-label">Set Time:</label>
                        <input type="datetime-local" name="taskDtime" id="cal" required="">
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
                            <h1 class="title">Weekly Tasks</h1>
                        </div>

                        <div class="pull-right hidden-xs">
                            <ol class="breadcrumb">
                                <li>
                                    <a href="#"><i class="fa fa-home"></i>Home</a>
                                </li>
                                <li class="active">
                                    <strong>Weekly Task</strong>
                                </li>
                         </ol>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <section class="box">
                        <header class="panel_header">
                            <h2 class="title pull-left"><?php echo date('l', strtotime('Today')); ?> (Today)</h2>
                        </header>
                        <div class="content-body">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="table-responsive" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table vm table-small-font no-mb table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Tasks</th>
                                                    <th>Status</th>
                                                    <th>Reminder Date</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                        
                                            $sessionTask = $_SESSION['tr_id'];
                                            $dateNow = date('Y-m-d');

                                            $qrySelect = mysqli_query($conn, "SELECT * FROM tb_task WHERE date(tt_reminder_date)='$dateNow' AND tt_tr_id ='$sessionTask'");
    
                                             while($taskRow = mysqli_fetch_array($qrySelect)){
                                             ?>
                                               <tr>
                                                    <td>
                                                        <div class="round img2">
                                                            <span class="colored-block gradient-blue"></span>
                                                        </div>
                                                        <div class="designer-info">
                                                            <h6><?php echo $taskRow['tt_title']; ?></h6>
                                                            <small class="text-muted">
                                                            <?php
                                                            $str = $taskRow['tt_description'];
                                                            if (strlen($str) > 10)
                                                            echo $str = substr($str, 0, 15) . '...';
                                                            ?>
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                     <?php
                                                    $status = $taskRow['tt_status'];
                                                        if($status == 'On Schedule'){
                                                            echo "<span class='badge badge-md w-70 round-warning'>On Schedule</span>";
                                                        }else if($status == 'Done'){
                                                            echo "<span class='badge badge-md w-70 round-success'>Done</span>";
                                                         }else if($status == 'Late'){
                                                                echo "<span class='badge badge-md w-70 round-danger'>Late</span>";
                                                        } 
                                                    ?>
                                                    </td>
                                                    <td><?php echo $taskRow['tt_reminder_date']; ?></td>
                                                    <td class="list-inline-item">
                                                        <button class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="modal" data-target="#editReminder<?php echo $taskRow['tt_id']; ?>" data-id="" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                        |
                                                        <a href="delete_task.php?id=<?php echo $taskRow['tt_id']; ?>" onclick="return confirm('Are you sure want to delete this task?');"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr>
                                                <!-- START OF EDIT TASKS - BOOTSTRAP MODAL -->
                                                <div class="modal fade" id="editReminder<?php echo $taskRow['tt_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h3 class="modal-title-edit" id="exampleModalLabel">Task Details</h3>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                              <div class="modal-body">
                                                <form action="edit_task.php" method="POST">  
                                                <?php
                                                $id = $taskRow['tt_id']; 
                                                $query_edit = mysqli_query($conn, "SELECT * FROM tb_task WHERE tt_id='$id'");
                                                while ($row = mysqli_fetch_array($query_edit)) {  
                                    
                                                    $newDate = date('m/d/Y H:i A', strtotime($row['tt_reminder_date']));

                                                ?>                                                     
                                                <div class="form-group">
                                                    <input type="hidden" name="idTitle" value="<?php echo $row['tt_id'] ?>">
                                                </div>
                                                  <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Title:</label>
                                                    <input type="text" class="form-control" name="taskTitle" maxlength="50" value="<?php echo $row['tt_title']; ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Notes:</label>
                                                    <textarea class="form-control" name="taskNotes" minlength="10"><?php echo $row['tt_description']; ?></textarea>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Set Time:</label>
                                                    <input type="datetime-local" name="taskDtime" value="<?php echo $newDate ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Task Created :<br>
                                                     <?php echo $row['tt_task_created_date']; ?></label>
                                              </div>
                                              <div class="modal-footer">
                                                 <button type="submit" name="markDone" class="btn btn-secondary">Mark as Done</button>
                                                <button type="submit" name="editTask" class="btn btn-info">Edit</button>
                                              </div>
                                                <?php 
                                                } 
                                                ?>
                                              </form>
                                            </div>
                                          </div>
                                         </div>
                                         </div>
                                        <?php
                                        }
                                        ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>

                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <section class="box">
                        <header class="panel_header">
                            <h2 class="title pull-left"><?php echo date('l', strtotime('+1 day')); ?></h2>
                        </header>
                        <div class="content-body">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="table-responsive" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table vm table-small-font no-mb table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Tasks</th>
                                                    <th>Status</th>
                                                    <th>Reminder Date</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                        
                                            $sessionTask = $_SESSION['tr_id'];
                                            $dateNow = date('Y-m-d', strtotime('+1 day'));

                                            $qrySelect = mysqli_query($conn, "SELECT * FROM tb_task WHERE date(tt_reminder_date)='$dateNow' AND tt_tr_id ='$sessionTask'");
    
                                             while($taskRow = mysqli_fetch_array($qrySelect)){
                                             ?>
                                               <tr>
                                                    <td>
                                                        <div class="round img2">
                                                            <span class="colored-block gradient-blue"></span>
                                                        </div>
                                                        <div class="designer-info">
                                                            <h6><?php echo $taskRow['tt_title']; ?></h6>
                                                            <small class="text-muted">
                                                            <?php
                                                            $str = $taskRow['tt_description'];
                                                            if (strlen($str) > 10)
                                                            echo $str = substr($str, 0, 15) . '...';
                                                            ?>
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <?php
                                                    $status = $taskRow['tt_status'];
                                                        if($status == 'On Schedule'){
                                                            echo "<span class='badge badge-md w-70 round-warning'>On Schedule</span>";
                                                        }else if($status == 'Done'){
                                                            echo "<span class='badge badge-md w-70 round-success'>Done</span>";
                                                         }else if($status == 'Late'){
                                                                echo "<span class='badge badge-md w-70 round-danger'>Late</span>";
                                                        } 
                                                    ?>
                                                    </td>
                                                    <td><?php echo $taskRow['tt_reminder_date']; ?></td>
                                                   <td class="list-inline-item">
                                                        <button class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="modal" data-target="#editReminder<?php echo $taskRow['tt_id']; ?>" data-id="" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                        |
                                                       <a href="delete_task.php?id=<?php echo $taskRow['tt_id']; ?>" onclick="return confirm('Are you sure want to delete this task?');"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr>
                                                 <!-- START OF EDIT TASKS - BOOTSTRAP MODAL -->
                                                <div class="modal fade" id="editReminder<?php echo $taskRow['tt_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h3 class="modal-title-edit" id="exampleModalLabel">Task Details</h3>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                              <div class="modal-body">
                                                <form action="edit_task.php" method="POST">  
                                                <?php
                                                $id = $taskRow['tt_id']; 
                                                $query_edit = mysqli_query($conn, "SELECT * FROM tb_task WHERE tt_id='$id'");
                                                while ($row = mysqli_fetch_array($query_edit)) {  
                                    
                                                    $newDate = date('m/d/Y H:i A', strtotime($row['tt_reminder_date']));

                                                ?>                                                     
                                                <div class="form-group">
                                                    <input type="hidden" name="idTitle" value="<?php echo $row['tt_id'] ?>">
                                                </div>
                                                  <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Title:</label>
                                                    <input type="text" class="form-control" name="taskTitle" maxlength="50" value="<?php echo $row['tt_title']; ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Notes:</label>
                                                    <textarea class="form-control" name="taskNotes" minlength="10"><?php echo $row['tt_description']; ?></textarea>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Set Time:</label>
                                                    <input type="datetime-local" name="taskDtime" value="<?php echo $newDate ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Task Created :<br>
                                                     <?php echo $row['tt_task_created_date']; ?></label>
                                              </div>
                                              <div class="modal-footer">
                                                 <button type="submit" name="markDone" class="btn btn-secondary">Mark as Done</button>
                                                <button type="submit" name="editTask" class="btn btn-info">Edit</button>
                                              </div>
                                                <?php 
                                                } 
                                                ?>
                                              </form>
                                            </div>
                                              </div>
                                             </div>
                                             </div>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                        
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <section class="box">
                        <header class="panel_header">
                            <h2 class="title pull-left"><?php echo date('l', strtotime('+2 day')); ?></h2>
                        </header>
                        <div class="content-body">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="table-responsive" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table vm table-small-font no-mb table-bordered table-striped">
                                            <thead>
                                                 <tr>
                                                    <th>Tasks</th>
                                                    <th>Status</th>
                                                    <th>Reminder Date</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 
                                        
                                            $sessionTask = $_SESSION['tr_id'];
                                            $dateNow = date('Y-m-d', strtotime('+2 day'));

                                            $qrySelect = mysqli_query($conn, "SELECT * FROM tb_task WHERE date(tt_reminder_date)='$dateNow' AND tt_tr_id ='$sessionTask'");
    
                                             while($taskRow = mysqli_fetch_array($qrySelect)){
                                             ?>
                                                 <tr>
                                                    <td>
                                                        <div class="round img2">
                                                            <span class="colored-block gradient-blue"></span>
                                                        </div>
                                                        <div class="designer-info">
                                                            <h6><?php echo $taskRow['tt_title']; ?></h6>
                                                            <small class="text-muted">
                                                            <?php
                                                            $str = $taskRow['tt_description'];
                                                            if (strlen($str) > 10)
                                                            echo $str = substr($str, 0, 15) . '...';
                                                            ?>
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                     <?php
                                                    $status = $taskRow['tt_status'];
                                                        if($status == 'On Schedule'){
                                                            echo "<span class='badge badge-md w-70 round-warning'>On Schedule</span>";
                                                        }else if($status == 'Done'){
                                                            echo "<span class='badge badge-md w-70 round-success'>Done</span>";
                                                         }else if($status == 'Late'){
                                                                echo "<span class='badge badge-md w-70 round-danger'>Late</span>";
                                                        } 
                                                    ?>
                                                    </td>
                                                    <td><?php echo $taskRow['tt_reminder_date']; ?></td>
                                                    <td class="list-inline-item">
                                                        <button class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="modal" data-target="#editReminder<?php echo $taskRow['tt_id']; ?>" data-id="" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                        |
                                                       <a href="delete_task.php?id=<?php echo $taskRow['tt_id']; ?>" onclick="return confirm('Are you sure want to delete this task?');"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr>
                                                 <!-- START OF EDIT TASKS - BOOTSTRAP MODAL -->
                                                <div class="modal fade" id="editReminder<?php echo $taskRow['tt_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h3 class="modal-title-edit" id="exampleModalLabel">Task Details</h3>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                              <div class="modal-body">
                                                <form action="edit_task.php" method="POST">  
                                                <?php
                                                $id = $taskRow['tt_id']; 
                                                $query_edit = mysqli_query($conn, "SELECT * FROM tb_task WHERE tt_id='$id'");
                                                while ($row = mysqli_fetch_array($query_edit)) {  
                                    
                                                    $newDate = date('m/d/Y H:i A', strtotime($row['tt_reminder_date']));

                                                ?>                                                     
                                                <div class="form-group">
                                                    <input type="hidden" name="idTitle" value="<?php echo $row['tt_id'] ?>">
                                                </div>
                                                  <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Title:</label>
                                                    <input type="text" class="form-control" name="taskTitle" maxlength="50" value="<?php echo $row['tt_title']; ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Notes:</label>
                                                    <textarea class="form-control" name="taskNotes" minlength="10"><?php echo $row['tt_description']; ?></textarea>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Set Time:</label>
                                                    <input type="datetime-local" name="taskDtime" value="<?php echo $newDate ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Task Created :<br>
                                                     <?php echo $row['tt_task_created_date']; ?></label>
                                              </div>
                                              <div class="modal-footer">
                                                 <button type="submit" name="markDone" class="btn btn-secondary">Mark as Done</button>
                                                <button type="submit" name="editTask" class="btn btn-info">Edit</button>
                                              </div>
                                                <?php 
                                                } 
                                                ?>
                                              </form>
                                            </div>
                                          </div>
                                         </div>
                                         </div>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                        
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <section class="box">
                        <header class="panel_header">
                            <h2 class="title pull-left"><?php echo date('l', strtotime('+3 day')); ?></h2>
                        </header>
                        <div class="content-body">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="table-responsive" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table vm table-small-font no-mb table-bordered table-striped">
                                            <thead>
                                                 <tr>
                                                    <th>Tasks</th>
                                                    <th>Status</th>
                                                    <th>Reminder Date</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 
                                        
                                            $sessionTask = $_SESSION['tr_id'];
                                            $dateNow = date('Y-m-d', strtotime('+3 day'));

                                            $qrySelect = mysqli_query($conn, "SELECT * FROM tb_task WHERE date(tt_reminder_date)='$dateNow' AND tt_tr_id ='$sessionTask'");
    
                                             while($taskRow = mysqli_fetch_array($qrySelect)){
                                             ?>
                                                 <tr>
                                                    <td>
                                                        <div class="round img2">
                                                            <span class="colored-block gradient-blue"></span>
                                                        </div>
                                                        <div class="designer-info">
                                                            <h6><?php echo $taskRow['tt_title']; ?></h6>
                                                            <small class="text-muted">
                                                            <?php
                                                            $str = $taskRow['tt_description'];
                                                            if (strlen($str) > 10)
                                                            echo $str = substr($str, 0, 15) . '...';
                                                            ?>
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                     <?php
                                                    $status = $taskRow['tt_status'];
                                                        if($status == 'On Schedule'){
                                                            echo "<span class='badge badge-md w-70 round-warning'>On Schedule</span>";
                                                        }else if($status == 'Done'){
                                                            echo "<span class='badge badge-md w-70 round-success'>Done</span>";
                                                         }else if($status == 'Late'){
                                                                echo "<span class='badge badge-md w-70 round-danger'>Late</span>";
                                                        } 
                                                    ?>
                                                    </td>
                                                    <td><?php echo $taskRow['tt_reminder_date']; ?></td>
                                                    <td class="list-inline-item">
                                                        <button class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="modal" data-target="#editReminder<?php echo $taskRow['tt_id']; ?>" data-id="" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                        |
                                                        <a href="delete_task.php?id=<?php echo $taskRow['tt_id']; ?>" onclick="return confirm('Are you sure want to delete this task?');"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr>
                                                 <!-- START OF EDIT TASKS - BOOTSTRAP MODAL -->
                                                <div class="modal fade" id="editReminder<?php echo $taskRow['tt_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h3 class="modal-title-edit" id="exampleModalLabel">Task Details</h3>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                              <div class="modal-body">
                                                <form action="edit_task.php" method="POST">  
                                                <?php
                                                $id = $taskRow['tt_id']; 
                                                $query_edit = mysqli_query($conn, "SELECT * FROM tb_task WHERE tt_id='$id'");
                                                while ($row = mysqli_fetch_array($query_edit)) {  
                                    
                                                    $newDate = date('m/d/Y H:i A', strtotime($row['tt_reminder_date']));

                                                ?>                                                     
                                                <div class="form-group">
                                                    <input type="hidden" name="idTitle" value="<?php echo $row['tt_id'] ?>">
                                                </div>
                                                  <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Title:</label>
                                                    <input type="text" class="form-control" name="taskTitle" maxlength="50" value="<?php echo $row['tt_title']; ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Notes:</label>
                                                    <textarea class="form-control" name="taskNotes" minlength="10"><?php echo $row['tt_description']; ?></textarea>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Set Time:</label>
                                                    <input type="datetime-local" name="taskDtime" value="<?php echo $newDate ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Task Created :<br>
                                                     <?php echo $row['tt_task_created_date']; ?></label>
                                              </div>
                                              <div class="modal-footer">
                                                 <button type="submit" name="markDone" class="btn btn-secondary">Mark as Done</button>
                                                <button type="submit" name="editTask" class="btn btn-info">Edit</button>
                                              </div>
                                                <?php 
                                                } 
                                                ?>
                                              </form>
                                            </div>
                                          </div>
                                         </div>
                                         </div>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                        
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <section class="box">
                        <header class="panel_header">
                            <h2 class="title pull-left"><?php echo date('l', strtotime('+4 day')); ?></h2>
                        </header>
                        <div class="content-body">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="table-responsive" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table vm table-small-font no-mb table-bordered table-striped">
                                            <thead>
                                                 <tr>
                                                    <th>Tasks</th>
                                                    <th>Status</th>
                                                    <th>Reminder Date</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 
                                        
                                            $sessionTask = $_SESSION['tr_id'];
                                            $dateNow = date('Y-m-d', strtotime('+4 day'));

                                            $qrySelect = mysqli_query($conn, "SELECT * FROM tb_task WHERE date(tt_reminder_date)='$dateNow' AND tt_tr_id ='$sessionTask'");
    
                                             while($taskRow = mysqli_fetch_array($qrySelect)){
                                             ?>
                                                <tr>
                                                    <td>
                                                        <div class="round img2">
                                                            <span class="colored-block gradient-blue"></span>
                                                        </div>
                                                        <div class="designer-info">
                                                            <h6><?php echo $taskRow['tt_title']; ?></h6>
                                                            <small class="text-muted">
                                                            <?php
                                                            $str = $taskRow['tt_description'];
                                                            if (strlen($str) > 10)
                                                            echo $str = substr($str, 0, 15) . '...';
                                                            ?>
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                     <?php
                                                    $status = $taskRow['tt_status'];
                                                        if($status == 'On Schedule'){
                                                            echo "<span class='badge badge-md w-70 round-warning'>On Schedule</span>";
                                                        }else if($status == 'Done'){
                                                            echo "<span class='badge badge-md w-70 round-success'>Done</span>";
                                                         }else if($status == 'Late'){
                                                                echo "<span class='badge badge-md w-70 round-danger'>Late</span>";
                                                        } 
                                                    ?>
                                                    </td>
                                                    <td><?php echo $taskRow['tt_reminder_date']; ?></td>
                                                    <td class="list-inline-item">
                                                        <button class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="modal" data-target="#editReminder<?php echo $taskRow['tt_id']; ?>" data-id="" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                        |
                                                        <a href="delete_task.php?id=<?php echo $taskRow['tt_id']; ?>" onclick="return confirm('Are you sure want to delete this task?');"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr>
                                                 <!-- START OF EDIT TASKS - BOOTSTRAP MODAL -->
                                                <div class="modal fade" id="editReminder<?php echo $taskRow['tt_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h3 class="modal-title-edit" id="exampleModalLabel">Task Details</h3>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                              <div class="modal-body">
                                                <form action="edit_task.php" method="POST">  
                                                <?php
                                                $id = $taskRow['tt_id']; 
                                                $query_edit = mysqli_query($conn, "SELECT * FROM tb_task WHERE tt_id='$id'");
                                                while ($row = mysqli_fetch_array($query_edit)) {  
                                    
                                                    $newDate = date('m/d/Y H:i A', strtotime($row['tt_reminder_date']));

                                                ?>                                                     
                                                <div class="form-group">
                                                    <input type="hidden" name="idTitle" value="<?php echo $row['tt_id'] ?>">
                                                </div>
                                                  <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Title:</label>
                                                    <input type="text" class="form-control" name="taskTitle" maxlength="50" value="<?php echo $row['tt_title']; ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Notes:</label>
                                                    <textarea class="form-control" name="taskNotes" minlength="10"><?php echo $row['tt_description']; ?></textarea>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Set Time:</label>
                                                    <input type="datetime-local" name="taskDtime" value="<?php echo $newDate ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Task Created :<br>
                                                     <?php echo $row['tt_task_created_date']; ?></label>
                                              </div>
                                              <div class="modal-footer">
                                                 <button type="submit" name="markDone" class="btn btn-secondary">Mark as Done</button>
                                                <button type="submit" name="editTask" class="btn btn-info">Edit</button>
                                              </div>
                                                <?php 
                                                } 
                                                ?>
                                              </form>
                                            </div>
                                          </div>
                                         </div>
                                         </div>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                        
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <section class="box">
                        <header class="panel_header">
                            <h2 class="title pull-left"><?php echo date('l', strtotime('+5 day')); ?></h2>
                        </header>
                        <div class="content-body">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="table-responsive" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table vm table-small-font no-mb table-bordered table-striped">
                                            <thead>
                                                 <tr>
                                                    <th>Tasks</th>
                                                    <th>Status</th>
                                                    <th>Reminder Date</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 
                                        
                                            $sessionTask = $_SESSION['tr_id'];
                                            $dateNow = date('Y-m-d', strtotime('+5 day'));

                                            $qrySelect = mysqli_query($conn, "SELECT * FROM tb_task WHERE date(tt_reminder_date)='$dateNow' AND tt_tr_id ='$sessionTask'");
    
                                             while($taskRow = mysqli_fetch_array($qrySelect)){
                                             ?>
                                               <tr>
                                                    <td>
                                                        <div class="round img2">
                                                            <span class="colored-block gradient-blue"></span>
                                                        </div>
                                                        <div class="designer-info">
                                                            <h6><?php echo $taskRow['tt_title']; ?></h6>
                                                            <small class="text-muted">
                                                            <?php
                                                            $str = $taskRow['tt_description'];
                                                            if (strlen($str) > 10)
                                                            echo $str = substr($str, 0, 15) . '...';
                                                            ?>
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                     <?php
                                                    $status = $taskRow['tt_status'];
                                                        if($status == 'On Schedule'){
                                                            echo "<span class='badge badge-md w-70 round-warning'>On Schedule</span>";
                                                        }else if($status == 'Done'){
                                                            echo "<span class='badge badge-md w-70 round-success'>Done</span>";
                                                         }else if($status == 'Late'){
                                                                echo "<span class='badge badge-md w-70 round-danger'>Late</span>";
                                                        } 
                                                    ?>
                                                    </td>
                                                    <td><?php echo $taskRow['tt_reminder_date']; ?></td>
                                                    <td class="list-inline-item">
                                                        <button class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="modal" data-target="#editReminder<?php echo $taskRow['tt_id']; ?>" data-id="" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                        |
                                                      <a href="delete_task.php?id=<?php echo $taskRow['tt_id']; ?>" onclick="return confirm('Are you sure want to delete this task?');"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr>
                                                 <!-- START OF EDIT TASKS - BOOTSTRAP MODAL -->
                                                <div class="modal fade" id="editReminder<?php echo $taskRow['tt_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h3 class="modal-title-edit" id="exampleModalLabel">Task Details</h3>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                              <div class="modal-body">
                                                <form action="edit_task.php" method="POST">  
                                                <?php
                                                $id = $taskRow['tt_id']; 
                                                $query_edit = mysqli_query($conn, "SELECT * FROM tb_task WHERE tt_id='$id'");
                                                while ($row = mysqli_fetch_array($query_edit)) {  
                                    
                                                    $newDate = date('m/d/Y H:i A', strtotime($row['tt_reminder_date']));

                                                ?>                                                     
                                                <div class="form-group">
                                                    <input type="hidden" name="idTitle" value="<?php echo $row['tt_id'] ?>">
                                                </div>
                                                  <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Title:</label>
                                                    <input type="text" class="form-control" name="taskTitle" maxlength="50" value="<?php echo $row['tt_title']; ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Notes:</label>
                                                    <textarea class="form-control" name="taskNotes" minlength="10"><?php echo $row['tt_description']; ?></textarea>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Set Time:</label>
                                                    <input type="datetime-local" name="taskDtime" value="<?php echo $newDate ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Task Created :<br>
                                                     <?php echo $row['tt_task_created_date']; ?></label>
                                              </div>
                                              <div class="modal-footer">
                                                 <button type="submit" name="markDone" class="btn btn-secondary">Mark as Done</button>
                                                <button type="submit" name="editTask" class="btn btn-info">Edit</button>
                                              </div>
                                                <?php 
                                                } 
                                                ?>
                                              </form>
                                            </div>
                                          </div>
                                         </div>
                                         </div>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                        
                </div>
                 <div class="clearfix"></div>
                <div class="col-lg-12">
                    <section class="box">
                        <header class="panel_header">
                            <h2 class="title pull-left"><?php echo date('l', strtotime('+6 day')); ?></h2>
                        </header>
                        <div class="content-body">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="table-responsive" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table vm table-small-font no-mb table-bordered table-striped">
                                            <thead>
                                                 <tr>
                                                    <th>Tasks</th>
                                                    <th>Status</th>
                                                    <th>Reminder Date</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php 
                                        
                                            $sessionTask = $_SESSION['tr_id'];
                                            $dateNow = date('Y-m-d', strtotime('+6 day'));

                                            $qrySelect = mysqli_query($conn, "SELECT * FROM tb_task WHERE date(tt_reminder_date)='$dateNow' AND tt_tr_id ='$sessionTask'");
    
                                             while($taskRow = mysqli_fetch_array($qrySelect)){
                                             ?>
                                               <tr>
                                                    <td>
                                                        <div class="round img2">
                                                            <span class="colored-block gradient-blue"></span>
                                                        </div>
                                                        <div class="designer-info">
                                                            <h6><?php echo $taskRow['tt_title']; ?></h6>
                                                            <small class="text-muted">
                                                            <?php
                                                            $str = $taskRow['tt_description'];
                                                            if (strlen($str) > 10)
                                                            echo $str = substr($str, 0, 15) . '...';
                                                            ?>
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td>
                                                    <?php
                                                    $status = $taskRow['tt_status'];
                                                        if($status == 'On Schedule'){
                                                            echo "<span class='badge badge-md w-70 round-warning'>On Schedule</span>";
                                                        }else if($status == 'Done'){
                                                            echo "<span class='badge badge-md w-70 round-success'>Done</span>";
                                                         }else if($status == 'Late'){
                                                                echo "<span class='badge badge-md w-70 round-danger'>Late</span>";
                                                        } 
                                                    ?>                                                    </td>
                                                    <td><?php echo $taskRow['tt_reminder_date']; ?></td>
                                                    <td class="list-inline-item">
                                                        <button class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="modal" data-target="#editReminder<?php echo $taskRow['tt_id']; ?>" data-id="" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                        |
                                                       <a href="delete_task.php?id=<?php echo $taskRow['tt_id']; ?>" onclick="return confirm('Are you sure want to delete this task?');"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                                                    </td>
                                                </tr>
                                                <!-- START OF EDIT TASKS - BOOTSTRAP MODAL -->
                                                <div class="modal fade" id="editReminder<?php echo $taskRow['tt_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h3 class="modal-title-edit" id="exampleModalLabel">Task Details</h3>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                              <div class="modal-body">
                                                <form action="edit_task.php" method="POST">  
                                                <?php
                                                $id = $taskRow['tt_id']; 
                                                $query_edit = mysqli_query($conn, "SELECT * FROM tb_task WHERE tt_id='$id'");
                                                while ($row = mysqli_fetch_array($query_edit)) {  
                                    
                                                    $newDate = date('m/d/Y H:i A', strtotime($row['tt_reminder_date']));

                                                ?>                                                     
                                                <div class="form-group">
                                                    <input type="hidden" name="idTitle" value="<?php echo $row['tt_id'] ?>">
                                                </div>
                                                  <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Title:</label>
                                                    <input type="text" class="form-control" name="taskTitle" maxlength="50" value="<?php echo $row['tt_title']; ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Notes:</label>
                                                    <textarea class="form-control" name="taskNotes" minlength="10"><?php echo $row['tt_description']; ?></textarea>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Set Time:</label>
                                                    <input type="datetime-local" name="taskDtime" value="<?php echo $newDate ?>">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="datetime" class="col-form-label">Task Created :<br>
                                                     <?php echo $row['tt_task_created_date']; ?></label>
                                              </div>
                                              <div class="modal-footer">
                                                 <button type="submit" name="markDone" class="btn btn-secondary">Mark as Done</button>
                                                <button type="submit" name="editTask" class="btn btn-info">Edit</button>
                                              </div>
                                                <?php 
                                                } 
                                                ?>
                                              </form>
                                            </div>
                                          </div>
                                         </div>
                                         </div>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                        
                </div>
                <div class="clearfix"></div>
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
    <script>
    $('#addReminder').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
  
        var modal = $(this)
  modal.find('.modal-title').text('Add a Task ')
    })
      $('#editReminder').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
  
        var modal = $(this)
      modal.find('.modal-title-edit').text('Task Details')
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