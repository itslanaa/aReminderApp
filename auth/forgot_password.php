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
<div class="loader_bg">
        <div class="loader"></div>
    </div>
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
            include "../db/config.php";

            if(isset($_POST["forgotPassword"]) && (!empty($_POST["Email"])) ){
                $email = $_POST["Email"];
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                $token = md5( rand(0,1000));
            if (!$email) {
                $error .="<p>Invalid email address please type a valid email address!</p>";
            }else{
                $qrySelect = "SELECT * FROM tb_register WHERE tr_email='".$email."'";
                $results = mysqli_query($conn, $qrySelect);
                $row = mysqli_num_rows($results);
            if ($row==""){
                echo "<script>alert('No user is registered with this email address!');</script>";
                } else {
                    $qryInsert = mysqli_query($conn,"INSERT INTO tb_password_reset_tmp VALUES ('','$email','$token')");
                    include("sentmail_forgot.php");
                }
            }
        }
                                 

            ?>

                <form class="login100-form validate-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <span class="login100-form-title">
                        Forgot Password
                    </span>
                     <div class="alert alert-warning alert-dismissible col-lg-15 " role="alert">
                   <i class="fa fa-exclamation-circle" aria-hidden="true"></i> 
                    <strong>Attention!</strong> We will sent you an email with a link to reset your password.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="Email" id="Email" placeholder="Email Address">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn" name="forgotPassword">
                            Submit
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