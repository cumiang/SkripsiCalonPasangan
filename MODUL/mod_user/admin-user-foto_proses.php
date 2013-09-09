<?php

include "../../CLASS/user.class.php";
include "../../FUNGSI/fungsi.php";
session_start();



if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
    echo '<link href="style/bootstrap.css" rel="stylesheet">';
    echo "<link href='style/style.css' rel='stylesheet'>";
    echo "</head><body><div class='admin-form'><div class='hero-unit'>
              <div align='center'>
              <h2>ANDA TIDAK MENDAPATKAN AKSES</h2>
              <img src='img/lock.png' class='offset'>
              <p>Untuk mengakses aplikasi, Anda harus login terlebih dahulu</p>
              <p><a class='btn btn-primary btn-large' href='admin-login.php'>Ulangi Lagi</a></p></div>
              </div></div>";
} else {

    if ($_SESSION['leveluser'] == 'admin') {

        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $_POST['txtID'];
            $nama_upload =$_FILES['imgProfil']['name'];
            $size_upload = $_FILES['imgProfil']['size'];
            $tmp_upload = $_FILES['imgProfil']["tmp_name"];
            $db = new user();
            //validasi format gambar
            $nama = strtolower(stripslashes($nama_upload));
            $nama_ext = strtolower(getExtension($nama));
            if (($nama_ext != "jpg") && ($nama_ext != "jpeg") && ($nama_ext != "png") && ($nama_ext != "gif")) {
              echo "format gambar tidak diizinkan kecuali (jpg,jpeg,png,gif)";
              exit();
            }


            $path_upload = "../../" . "USER_SPACE/" . $id . "/";
            $foto_upload = $path_upload . $nama;

            if (strlen($nama)) {
                if ($size_upload < (1024 * 200)) {
                    if (move_uploaded_file($tmp_upload, $foto_upload)) {
                        $db->set_foto_profil($nama);
                        $db->update_foto_profil($id);
                            if($nama_ext=="jpg" || $nama_ext=="jpeg" ){
                                $sumber = imagecreatefromjpeg($foto_upload);
                            }else if($nama_ext=="png"){
                                $sumber = imagecreatefrompng($foto_upload);
                            }else if($nama_ext=="gif"){
                                $sumber = imagecreatefromgif($foto_upload);
                            }
                            //mengambil ukuran tinggi dan lebar file
                            list($lebar,$tinggi)=  getimagesize($foto_upload);
                            //ukuran gambar 160x160 pixel
                            $lebar_new = 160;
                            $tinggi_new = ($tinggi/$lebar)*$lebar_new;
                            $tmp = imagecreatetruecolor($lebar_new, $tinggi_new);
                            //ukuran gambar 160x160 pixel
                            $lebar_new1 = 50;
                            $tinggi_new1 = ($tinggi/$lebar)*$lebar_new1;
                            $tmp1 = imagecreatetruecolor($lebar_new1, $tinggi_new1);
                            
                            imagecopyresampled($tmp,$sumber,0,0,0,0,$lebar_new,$tinggi_new,$lebar,$tinggi);
                            imagecopyresampled($tmp1,$sumber,0,0,0,0,$lebar_new1,$tinggi_new1,$lebar,$tinggi);
                            
                            //simpan gambar
                            if($nama_ext=="jpg" || $nama_ext=="jpeg" ){
                                imagejpeg($tmp, $path_upload.getName($nama)."_160x160.".$nama_ext);
                                imagejpeg($tmp1, $path_upload.getName($nama)."_50x50.".$nama_ext);
                            }else if($nama_ext=="png"){
                                imagepng($tmp, $path_upload.getName($nama)."_160x160.".$nama_ext);
                                imagepng($tmp1, $path_upload.getName($nama)."_50x50.".$nama_ext);
                            }else if($nama_ext=="gif"){
                                imagegif($tmp, $path_upload.getName($nama)."_160x160.".$nama_ext);
                                imagegif($tmp1, $path_upload.getName($nama)."_50x50.".$nama_ext);
                            }
                            //bebaskan variabel dr memori
                            imagedestroy($sumber);
                            imagedestroy($tmp);
                            imagedestroy($tmp1);  
                       echo "<script>
                            alert('sukses mengupload foto sampul');
                            window.location.href = '../../admin.php';
                          </script>";
                            //header("Location: ../../admin.php");
                    }
                } else {
                       echo "<script>
                            alert('Ukuran file gambar anda melebihi 200kb');
                            window.location.href = '../../admin.php';
                          </script>";
                    //echo "Ukuran file gambar anda melebihi 200kb";
                }
            } else {
                       echo "<script>
                            alert('Pilih dulu gambarnya..');
                            window.location.href = '../../admin.php';
                          </script>";                
               // echo "Pilih dulu gambarnya..";
            }
        } else {
            echo "ada kesalahan";
        }
    }
}
?>