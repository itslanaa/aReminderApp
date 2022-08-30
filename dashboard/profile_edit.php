<?php
include_once "../db/config.php";
session_start();
if(isset($_POST['profileEdit'])){
		
		$full_name				= $_POST['full_name'];
		$old_password			= $_POST['old_password'];
		$new_password			= $_POST['new_password'];
		$confirm_new_password	= $_POST['confirm_new_password'];
		// $photo     = $_POST['photo'];
		// $filename = $_FILES['profilePhoto']['name'];
		// $tmp_name = $_FILES['profilePhoto']['tmp_name'];

		
		$old_password	= md5($old_password);
		$check 			= $conn->query("SELECT tr_password FROM tb_register WHERE tr_password='$old_password'");
		
		if($check->num_rows){
			
			if(strlen($new_password) >= 5){
				
				if($new_password == $confirm_new_password){
					$new_password 	= md5($new_password);
					$tr_id 		= $_SESSION['tr_id']; //ini dari session saat login

					// if ($filename != '') {

					// 	$type1 = explode('.', $filename);
					// 	$type2 = $type1[1];

					// 	$newname = 'profile'.time().'.'.$type2;
					// 	$extAllowed = array('jpg', 'jpeg', 'png', 'gif');

					// 	if (!in_array($type2, $extAllowed)) {
					// 		//jika format file tidak ada di dalam type yang di izinkan
					// 		echo '<script>alert("Format File Tidak Di Izinkan")</script>';
					// 	}else{
					// 		 move_uploaded_file($tmp_name, './data/profile/'.$newname);
					// 		 $pictName = $newname;

					// 	}


					// 	}else{
					// 		//if photo not changed
					// 		$pictName = $photo;

					// 	}
					
						$qryUpdate 		= $conn->query("UPDATE tb_register SET tr_name='$full_name', tr_password='$new_password' WHERE tr_id='$tr_id'");

						
					}
					if($qryUpdate){
						echo "<script>window.location.href = 'profile.php'</script>";
						echo "<script>alert('Profile sucessfully updated!');</script>";
					}else{
						echo "<script>window.location.href = 'profile.php'</script>";
						echo "<script>alert('Failed to change password!');</script>";
					}					
				}else{
					echo "<script>window.location.href = 'profile.php'</script>";
					echo "<script>alert('Confirm new password does not match!');</script>";
				}
			}else{
				echo "<script>window.location.href = 'profile.php'</script>";
				echo '<script>Minimum new password is 5 characters!</script>';
			}
		}else{
			echo "<script>window.location.href = 'profile.php'</script>";
			echo '<script>Old password does not match!</script>';
		}
	?>