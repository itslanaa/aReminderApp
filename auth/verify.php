<?php 
include_once "../db/config.php";
date_default_timezone_set("Asia/Jakarta");

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

    

    <div class="limiter">
        <div class="container-forgot-password100">
            <div class="wrap-forgot-password100">
                <div class="wrap-forgot-password">
                    <?php

                    $token = $_GET['t'];
                    $sql_check  = mysqli_query($conn,"SELECT * FROM tb_register WHERE tr_token='".$token."' and tr_status='Unverified'");
                    $total_data = mysqli_num_rows($sql_check);
                    if ($total_data>0) {
                    //update data user to verified

                    $datetimeVerify = date('Y-m-d H:i:s');
                 mysqli_query($conn,"UPDATE tb_register SET tr_status='Verified', tr_verification_date='".$datetimeVerify."'WHERE tr_token='".$token."' and tr_status='Unverified'");
                 echo '<div class"textsmall-verify100 m-auto>
                           Your account has been successfully activate. Go back to <a style="text-decoration:none;" href="signin.php">sign in </a>page.
                            </div>';
             }else{
                        //data not found
                         echo '<div class="textsmall-verify100 m-auto">
                            Invalid Token!
                            </div>';
                       }
        ?>
                </div>
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
    <script src="js/main.js"></script>
    <script>
        setTimeout(function () {
            $('.loader_bg').fadeToggle();
        }, 1500);
    </script>

</body>

</html>