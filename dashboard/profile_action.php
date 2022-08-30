<?php
session_start();
// memanggil file koneksi.php untuk melakukan koneksi database
include '../db/config.php';

	// membuat variabel untuk menampung data dari form
  $id = $_SESSION['tr_id'];
 $full_name				= $_POST['full_name'];
 $new_password			= $_POST['new_password'];
 $confirm_new_password	= $_POST['confirm_new_password'];
 $image = $_FILES['profilePhoto']['name'];
 
 if($new_password == $confirm_new_password){
					$new_password 	= md5($new_password);
  //cek dulu jika merubah gambar produk jalankan coding ini
  if($image != "") {
    $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $image); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['profilePhoto']['tmp_name'];   
    $rand_no     = rand(1,999);
    $new_img_name = $rand_no.'-'.$image; //menggabungkan angka acak dengan nama file sebenarnya
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'data/profile/'.$new_img_name); //memindah file gambar ke folder gambar
                      
                    // jalankan query UPDATE berdasarkan ID yang sedang login
                   $query  = "UPDATE tb_register SET tr_name = '$full_name', tr_password = '$new_password', tr_images = '$new_img_name'";
                    $query .= "WHERE tr_id = '$id'";
                    $result = mysqli_query($conn, $query);
                    // periska query apakah ada error
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
                    } else {
                      //tampil alert dan akan redirect ke halaman profile.php
                      echo "<script>alert('Data berhasil diubah.');window.location='profile.php';</script>";
                    }
              } else {     
               //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='profile.php';</script>";
              }
    } else {
      // jalankan query UPDATE berdasarkan ID yang sedang login
      $query  = "UPDATE tb_register SET tr_name = '$full_name', tr_password = '$new_password', tr_images = '$new_img_name'";
                    $query .= "WHERE tr_id = '$id'";
      $result = mysqli_query($conn, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
      } else {
        //tampil alert dan akan redirect ke halaman profile.php
          echo "<script>alert('Data berhasil diubah.');window.location='profile.php';</script>";
      }
    } 
    }
    else {
         echo "<script>alert('Password does not match!');window.location='profile.php';</script>";
    }
