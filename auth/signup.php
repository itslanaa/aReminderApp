<?php
ini_set('date.timezone', 'Asia/Jakarta');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Task Manager App - Sign Up Page</title>
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
              if (isset($_POST['register'])) {
                  //ambil data dari form
                  $Name=$_POST['Name'];   
                  $Email = $_POST['Email'];
                  $Password = md5($_POST['Password']);
                  $dateRegister = date($_POST['dateRegister']);
                  //create token activation
                  $token = md5( rand(0,1000) );
                  //cek user terdaftar
                  $sql_check = mysqli_query($conn,"SELECT * FROM tb_register WHERE tr_email='".$Email."'");
                  $r_cek=mysqli_num_rows($sql_check);
                  if ($r_cek>0) {
                    echo "<script>alert('Email already been registered!');
                          </script>";
                  }else{
                    //jika data kosong maka insert ke tabel;
                    //aktif =0 user belum aktif
                    $insert = mysqli_query($conn,"INSERT INTO tb_register(tr_name,tr_email,tr_password,tr_register_date,tr_verification_date,tr_status,tr_token) VALUES('".$Name."','".$Email."','".$Password."','".$dateRegister."','','Unverified','".$token."')");
                    //include kirim email
                    include("sentmail.php");

                    if ($insert) {
                        echo '<script>window.location.href = "signin.php"</script>';
                    }

                  }                  
              }

            ?>
				<form class="login100-form validate-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<span class="login100-form-title">
						Sign up
					</span>
					<div class="wrap-input100 validate-input" data-validate="Name is required">
						<input class="input100" type="text" name="Name" id="Name" placeholder="Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="Email" id="Email" placeholder="Email Address">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="Password" id="Password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<input type="hidden" name="dateRegister" value="<?php echo date('Y-m-d H:i:s'); ?>" />
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" name="register">
							register
						</button>
					</div>

					<div class="text-center p-t-136">
						<span class="txt1">
							Already have an account?
						</span>
						<a class="txt2" href="signin.php">
							Sign in
						</a>
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
	<!--===============================================================================================-->
	<script src="../vendor/sweetalert/sweetalert.min.js"></script>
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