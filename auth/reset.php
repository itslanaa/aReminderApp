<?php
include_once '../db/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Task Manager App - Register Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!--===============================================================================================-->
</head>

<body>
<!-- <div class="loader_bg">
        <div class="loader"></div>
    </div> -->
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                            <span class="login100-pic-title">
                            Reminder the task
                            </span>
                            <span class="login100-pic-subtitle">
                            help remind the task you will do in the future
                            </span>

                            <img class="d-block w-100 mb-5" src="../images/img.png" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                            <span class="login100-pic-title">
                            Date and time accuracy
                            </span>
                            <span class="login100-pic-subtitle">
                            task reminder guaranteed on schedule
                            </span>
                            <img class="d-block w-100 mb-5" src="../images/img2.png" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
                        </ol>
                            <span class="login100-pic-title">
                            Security system
                            </span>
                            <span class="login100-pic-subtitle">
                            ensure the security of your personal data
                            </span>
                            <img class="d-block w-100 mb-5" src="../images/img3.png" alt="Third slide">
                        </div>
                    </div>
                </div>
            </div>
            <div style="height: auto; width: 2px; background-color: #fff;"></div>

            <?php

              if(!isset($_GET['key'])){
                echo "Can't find page";
                
              }
              $token = $_GET['key'];

              $query = mysqli_query($conn, "SELECT tp_rt_email FROM tb_password_reset_tmp WHERE tp_rt_token = '$token' ");
          
              $row = mysqli_fetch_array($query);
 

        if(isset($_POST["resetPassword"])){
            $new_password           = $_POST['new_password'];
            $confirm_new_password   = $_POST['confirm_new_password'];
                if($new_password == $confirm_new_password){
                    $email = $_POST['Email'];
                    $new_password   = md5($new_password);

                    $query = mysqli_query($conn, "UPDATE tb_register SET tr_password = '$new_password' WHERE tr_email = '$email'");
                    echo "<script>alert('Password Successfully updated!, Please signin using your new password.'); </script>";
                    header("Location:signin.php");
                    
                    } else {
                            echo "<script>alert('confirm password does not match');</script>";
                    }

                    if($query){
                         mysqli_query($conn, "DELETE FROM tb_password_reset_tmp WHERE tp_rt_email = '$email'");
                    }
                    
                }
        ?>
                <form class="login100-form validate-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <span class="login100-form-title">
                        Reset Password
                    </span>
                    
                    <div class="wrap-input100 validate-input" data-validate = "Please enter your password!">
                        <input class="input100" type="password" name="new_password" placeholder="New Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                      <div class="wrap-input100 validate-input" data-validate = "Please enter your confirm password!">
                        <input class="input100" type="password" name="confirm_new_password" placeholder="Confirm New Password">
                        <input type="hidden" value="<?php echo $row['tp_rt_email']; ?>" name="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn" name="resetPassword">
                            Reset
                        </button>
                    </div>

                    <div class="text-center p-t-136">
                        <span class="txt1">
                        Go back to <a class="txt2" href="signin.php">
                        sign in </a>  page →
                        </span>
                    </div>
                </form>

            </div>
        </div>
    </div>



    <!--===============================================================================================-->
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="../vendor/bootstrap/js/popper.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="../vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="../vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="../js/main.js"></script>
    <script>
        setTimeout(function () {
            $('.loader_bg').fadeToggle();
        }, 1500);
    </script>

</body>

</html>